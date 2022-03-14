<?php

include('./sql-connect.php');

$format= isset($_GET['format']) ? $_GET['format'] : 'html';
$download= isset($_GET['download']);

$table = isset($_GET['table']) ? $_GET['table'] : 1;
$dbname = isset($_GET['db']) ? $_GET['db'] : $dbname;
$table_type = isset($_GET['type']) ? $_GET['type'] : $table;

switch ($table_type){
    case 1:
        $table = isset($_GET['table']) ? $_GET['table'] : "meeting";
    case 'meeting':
    default:
        $headers = ['group_id','hc','group_name',
            'note','note1','note2','note3','status',
            'town','zone', 'address','locationName','locationNotes',
            'locationAddress','locationCity', 'locationState','locationZip',
            'SU','MN','TU','WD','TH','FR','SA',
            'yearlyContact','dateCreated','lastUpdate','print_town_name'];
        break;
    case 2:
        $table =  isset($_GET['table']) ? $_GET['table'] : "new_meeting";
    case 'new_meeting':
        $headers = ['group_id','meeting_id','hc','group_name',
            'day','time','types','notes','status',
            'town','zone', 'address','locationName','locationNotes',
            'locationAddress','locationCity', 'locationState','locationZip',
            'yearlyContact','dateCreated','lastUpdate','print_town_name'];
        break;
    case 3:
        $table =  isset($_GET['table']) ? $_GET['table'] : "virtual_meeting";
    case 'virtual_meeting':
        $headers =['id','vm_id','vm_pw','vm_phone','vm_phone_pw','vm_url'];
        break;
    case 'showtables':
        $headers =['tables in '.$dbname];
        break;
}

//make sure errors are being reported
error_reporting(E_ALL);

//connect to database
try {
	$pdo = new PDO('mysql:charset=UTF8;dbname=' . $dbname . ';host=' . $dbhost, $dbuser, $dbpass);
} catch (PDOException $e) {
	die('Database connection failed: ' . $e->getMessage());
}

//error handling
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//select data
if ($table == 'showtables')
{
    try {
        $sql = "SHOW TABLES";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $tables = $statement->fetchAll(PDO::FETCH_NUM);
    } catch (PDOException $e) {
        die('SQL query failed: ' . $e->getMessage());
    }

    // cheap CSV dump to screen only
    foreach($tables as $table)
        printf("%s,", $table[0]);
    echo "\n";

} else {
    try {
        $result = $pdo->query('SELECT * FROM `' . $table . '`');
    } catch (PDOException $e) {
        die('SQL query failed: ' . $e->getMessage());
    }
} // select * from 'table'

if ($format == 'html') {
    echo '<table style=\"width:100%\"><tr>';
    foreach ($headers as $h) {
        printf("<th>%s</th>", $h);
    }
    echo "</tr><tr>";
    foreach($result as $row) {
        foreach($headers as $h)
            printf("<td>%s</td>", $row[$h]);
        echo "</tr><tr>";
    }
    echo "</table>";
} else {

    if ($download) {
        $filename = $table  . '_dump_' . date('Ymd') .'_' . date('His');
        // Output CSV-specific headers
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment;filename=\"$filename.csv\";" );
        //header("Content-Transfer-Encoding: binary");
    }

    $buffer = fopen('php://output', 'W');
    //$buffer = fopen('php://memory', 'w');

    $h2=array();
    foreach($headers as $header){$h2[]='['.$header.']';}
    //array_walk($headers,function($v) use($h2) {$h2[]='['.$v.']';});
    fputcsv($buffer, $h2);

    $row = array();
    $row2 = array();
    foreach($result as $row) {
        foreach($headers as $key) {
            if ($row[$key] && $key == 'types' && is_array($row[$key]) ) {
                $row[$key] = implode(',',$row[$key]);
            }
            $row2[$key] = $row[$key];
        }
        fputcsv($buffer, $row2);
    }

    //rewind($buffer);
    $csv = fgets($buffer);
    fclose($buffer);

    if ($download) {
        fpassthru($csv);
    } else {
        echo $csv;
    }
}