<?php


include('./sql-connect.php');

//$fGetStats = isset($_GET['stats']);
//$fUnknown = isset($_GET['unk']) ? ($_GET['unk']=='true') : false;
//$fDebug = isset($_GET['debug']) ? ($_GET['debug']=='true') : false;

// online meetings in separate file
include('./online-meetings.php');

// old table headers


// new table headers
// note that if you make any edits to this list you must make
// corresponding change to SQL state in create_new_table_PDO()
global $headers;
$headers = ['id','vm_id','vm_pw','vm_phone','vm_phone_pw','vm_url','vm_notes'];

include "myutil.php";

//connect to database
try {
    $pdo = new PDO('mysql:charset=UTF8;dbname=' . $dbname . ';host=' . $dbhost, $dbuser, $dbpass);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

//error handling
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql_create_new_table = <<<SQL_CREATE_NEW_TABLE
    DROP TABLE IF EXISTS `virtual_meeting`;
    CREATE TABLE IF NOT EXISTS `virtual_meeting` (
      `id` text,
      `vm_id` text,
      `vm_pw` text,
      `vm_phone` text,
      `vm_phone_pw` text,
      `vm_url` varchar(100) DEFAULT NULL,
      `vm_notes` varchar(250) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL_CREATE_NEW_TABLE;
try {
    $result = $pdo->exec($sql_create_new_table);
} catch (PDOException $e) {
    die('Error creating new meeting table: ' . $e->getMessage());
}

//prepare PDO statement for insert into new table
// note that sql INSERT query is built using new_headers!!
try {
    $pdo_stmt_new_table = $pdo->prepare("INSERT INTO virtual_meeting (".
        implode(',', $headers).
        ') values (:'.
        implode(',:', $headers).');');
} catch (PDOException $e) {
    die('Failed to prepare statement for insert into new table: ' . $e->getMessage());
}

//$online_mtgs_keys = array_keys($online_mtgs);

foreach ($online_mtgs as $key=>$mtg) {
    $new_row['id']          = $key;
    $new_row['vm_id']       = $mtg[2];
    $new_row['vm_pw']       = $mtg[3];
    $new_row['vm_phone']    = $mtg[1];
    $new_row['vm_phone_pw'] = $mtg[3];
    $new_row['vm_url']       = $mtg[0];

    // pull access code out from number field

    if ($new_row['vm_phone']) {
        $access_num = strpos($new_row['vm_phone'], "Passcode:");
        if ($access_num) {
            // grab numeric passcode if it exists
            $t = substr($new_row['vm_phone'], 0, $access_num - 1);
            $new_row['vm_phone_pw'] = substr($new_row['vm_phone'], $access_num + strlen("Passcode:"), strlen($new_row['vm_phone']) - 1);
            $new_row['vm_phone'] = $t;
        }
    }

    // null out
    $vm_notes = "no virtual meeting notes";

    // add meeting ID and password to notes in human readable format
    if ($new_row['vm_id']) {
        if (strpos($new_row['vm_url'], "zoom")) {
            $vm_notes = "ZOOM Meeting ID: " . $new_row['vm_id'];
        } else {
            // grab everything after first forward slash
            if (preg_match('@^.*/(.*)$@', $new_row['vm_url'], $mtgID)) {
                $vm_notes = "Google Meeting ID: " . $mtgID[1];
            }
        }

        if ($new_row['vm_pw']) {
            $vm_notes .= "\n\r" . "PWD: " . $new_row['vm_pw'];
        }
    }

    // append phone information to notes
    if ($new_row['vm_phone']) {
        $vm_notes .= "\n\rTo join by phone dial:\n\r  " . $new_row['vm_phone'];
        if ($new_row['vm_id']) {
            $vm_notes .= "\n\rDial-in Meeting ID: " . $new_row['vm_id'] . "#";
        }
        // append pwd to meeting notes
        if ($new_row['vm_phone_pw']) {
            // use phone access number / password if available
            $vm_notes .= "\n\rPasscode: " . $new_row['vm_phone_pw'] . "#";
        }
    }
    $new_row['vm_notes'] = $vm_notes;

    print_array($new_row);
    try {
        $pdo_stmt_new_table->execute($new_row);
    } catch (PDOException $e) {
        die(sprintf("Failed to insert %s into new table : %s", $key, $e->getMessage()));
    }
}

