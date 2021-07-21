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
$headers = ['id','vm_url','vm_id','vm_pw','vm_phone',];

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
        SET SQL_MODE='ALLOW_INVALID_DATES';
        DROP TABLE IF EXISTS `virtual_meeting`;
        CREATE TABLE `virtual_meeting` (
        `id` CHAR(10) NOT NULL,
        `vm_id` VARCHAR(100) DEFAULT NULL,
        `vm_pw` VARCHAR(100) DEFAULT NULL,
        `vm_phone` VARCHAR(100) DEFAULT NULL,
        `vm_url` VARCHAR(100) DEFAULT NULL,
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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

foreach ($online_mtgs as $row) {
    try {
        $pdo_stmt_new_table->execute($row);
    } catch (PDOException $e) {
        die(sprintf("Failed to insert %s into new table : %s", $meeting_id, $e->getMessage()));
    }
}


