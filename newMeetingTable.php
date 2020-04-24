<?php
/**
 * Created: David V
 * User: dvein
 * Date: 2/24/2019
 *
 *
 * This script creates a new meeting table from the data in old table.
 *
 * where the old table has multiple meetings per row and uses note delimiters
 * embedded in the meeting listing, the new table has one row per meeting.
 *
 * thus the new meeting table has fewer columns and more rows
 *
 * note that tables names are hard coded
 *      old_table = 'meeting'
 *      new_table = 'new_meeting'
 *
 * note that this script hard codes both the old table headings and
 * the new table headings !!!!
 *
 * note that this scripts adds rows to new table one at a time
 * but does collect all new rows into one big array so uses lots of memory
 *
 */

include('./process/sql-connect.php');

// use david v's credentials
$dbuser		= isset($_GET['jdv']) ? 'suffolk_testing': $dbuser;
$dbpass 	= isset($_GET['jdv']) ? 'WEstaging2aa47' : $dbpass;

// old table headers
global $old_headers;
$old_headers = ['group_id','hc','group_name',
                'note','note1','note2','note3',
                'town','zone', 'address','locationName','locationNotes',
                'locationAddress','locationCity', 'locationState','locationZip',
                'SU','MN','TU','WD','TH','FR','SA',
                'yearlyContact','dateCreated','lastUpdate','print_town_name'];

// new table headers
// note that if you make any edits to this list you must make
// corresponding change to SQL state in create_new_table_PDO()
global $new_headers;
$new_headers = ['group_id','meeting_id','hc','group_name',
                'day','time','types','notes',
                'town','zone', 'address','locationName','locationNotes',
                'locationAddress','locationCity', 'locationState','locationZip',
                'yearlyContact','dateCreated','lastUpdate','print_town_name'];

//make sure errors are being reported
error_reporting(E_ALL);

// set up a couple of counters to know what's added
$newMedMtgs = 0;
$newHCMtgs = 0;

include "myutil.php";

//connect to database
try {
    $pdo = new PDO('mysql:charset=UTF8;dbname=' . $dbname . ';host=' . $dbhost, $dbuser, $dbpass);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

//error handling
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//create new output table in DB
create_new_table_PDO($pdo);

//prepare PDO statement for insert into new table
// note that sql INSERT query is built using new_headers!!
try {
    $pdo_stmt_new_table = $pdo->prepare("INSERT INTO new_meeting (".
                                    implode(',', $new_headers).
                                    ') values (:'.
                                    implode(',:', $new_headers).');');
} catch (PDOException $e) {
    die('Failed to prepare statement for insert into new table: ' . $e->getMessage());
}

//grab all rows from old table
//resorted to fetchALL to be able to request PDO::FETCH_ASSOC instead of the default of PDO::FETCH_BOTH
try {
    $old_table = $pdo->query('SELECT * FROM `meeting`')->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Failed to load old data: ' . $e->getMessage());
}

// init $new_row, this isn't really necessary
// but this will get the keys in prettier order
$new_row = array_flip($new_headers);

foreach ($old_table as $recnum=>$row) {

    // remove CR/LF from all fields
    // $row = array_map('remove_newlines', $row);
    // this seems to be unnecessary at this point! we don't seem to be
    // getting any problematic CR/LF as before

    AssertOldTableHeaders($row);

    // copy data iff headers exist in old and new table
    foreach ($new_headers as $k) {
        if (in_array($k,$old_headers)) {
            $new_row[$k] = $row[$k];
        }
    }

    // get notes as an array of 'note delimiter' => 'note' for this row
    $array_notes = array_notes($row['note']);

    // loop through all days from SU to SA
    foreach ($day_short2long_lookup as $dayShort => $dayLong) {
        $mtgs = $row[$dayShort];
        if ($mtgs<>'' and $mtgs<>'NULL') {
            $mtgs = array_meetings_from_old_listing($mtgs, $array_notes);
            foreach ($mtgs as $imtg => $mtg) {

                // construct meeting_id from group_id, dayShort, and index of meeting for this day
                $meeting_id = sprintf("%03d.%s.%d", $new_row['group_id'], $dayShort, $imtg);

                // if 'meditation' occurs in notes or group name, add MED to types
                if ((strpos(strtoupper($mtg['notes']), "MEDITATION") !== false) ||
                    (strpos(strtoupper($new_row['group_name']), "MEDITATION") !== false)) {
                    $newMedMtgs++;
                    $mtg['types'] .= " MED";
                }

                // if 'hc'=='yes', add X to types
                if (strtoupper($new_row['hc']) == 'YES') {
                    $newHCMtgs++;
                    $mtg['types'] .= " X";
                }

                $new_row['meeting_id'] = $meeting_id;
                $new_row['day'] = $dayLong;
                $new_row['time'] = $mtg['time'];
                $new_row['types'] = $mtg['types'];
                $new_row['notes'] = $mtg['notes'];

                $fDebug ? var_dump($new_row) : 0;
                $return[] = $new_row;

                try {
                    $pdo_stmt_new_table->execute($new_row);
                } catch (PDOException $e) {
                    die(sprintf("Failed to insert %s into new table : %s", $meeting_id, $e->getMessage()));
                }
            }
        }
    }
}

if (!isset($old_table) || count($old_table)==0) {
    die('Empty return set - something has gone terrible wrong');
}

if ($fDebug) {
    print_headers(array_keys($row));
    print_headers(array_keys($new_row));
}

/*// if everything has gone well to this point, rename temp table to 'new_meeting'
try {
    $pdo->query('DROP TABLE IF EXISTS `new_meeting_old`');
    $pdo->query('RENAME TABLE `new_meeting` to `new_meeting_old`');
    $pdo->query('RENAME TABLE `new_meeting_temp` to `new_meeting`');
} catch (PDOException $e) {
    die('Failed to rename temp table: ' . $e->getMessage());
}

*/

// output new table
echo '<br><h1>Success!!</h1>';

// how many new MED and X meetings were added
printf("added <b>%d</b> new meditation meetings<br>",$newMedMtgs);
printf("added <b>%d</b> new handicap accessible meetings<br>",$newHCMtgs);
printf("converted <b>%d</b> group rows to <b>%d</b> meeting rows<br>", count($old_table), count($return));

print_as_table($return);

function create_new_table_PDO($pdo) {
    $sql_create_new_table = <<<SQL_CREATE_NEW_TABLE
            SET SQL_MODE='ALLOW_INVALID_DATES';
            DROP TABLE IF EXISTS `new_meeting`;
            CREATE TABLE `new_meeting` (
            `group_id` INT(4) NOT NULL,
            `meeting_id` CHAR(8) NOT NULL,
            `hc` CHAR(3) DEFAULT NULL COMMENT 'If HC then use Yes, If not then check NULL box.',
            `group_name` VARCHAR(100) NOT NULL DEFAULT '',
            `day` CHAR(10) NOT NULL,
            `time` TIME NOT NULL,
            `types` VARCHAR(25) DEFAULT NULL,
            `notes` VARCHAR(100) DEFAULT NULL,
            `town` VARCHAR(255) NOT NULL,
            `zone` INT(2) DEFAULT NULL,
            `address` VARCHAR(150) DEFAULT NULL,
            `locationName` VARCHAR(255) DEFAULT NULL,
            `locationNotes` VARCHAR(255) DEFAULT NULL,
            `locationAddress` VARCHAR(255) DEFAULT NULL,
            `locationCity` VARCHAR(255) DEFAULT NULL,
            `locationState` VARCHAR(255) DEFAULT 'NY',
            `locationZip` VARCHAR(10),
            `yearlyContact` DATE NOT NULL DEFAULT '0000-00-00' COMMENT 'This is the date that the has contacted us for the year.',
            `dateCreated` DATE NOT NULL DEFAULT '0000-00-00' COMMENT 'Use this only when adding a new meeting.',
            `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Do not edit this field.  This will automatically be updated any time a meeting is changed.',
            `print_town_name` VARCHAR(4) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SQL_CREATE_NEW_TABLE;

    try {
        $result = $pdo->exec($sql_create_new_table);
    } catch (PDOException $e) {
        die('Error creating new meeting table: ' . $e->getMessage());
    }
}

function AssertOldTableHeaders($row) {
    global $old_headers;
    static $fCheckOnlyOnce;
    if (!$fCheckOnlyOnce){
        $fCheckOnlyOnce = true;
        //var_dump(array_diff($old_headers, array_keys($row)));
        assert(count(array_diff($old_headers, array_keys($row)))==0);
    }
}