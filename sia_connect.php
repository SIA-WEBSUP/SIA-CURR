<?php
session_start();
//for production
	$username = 'suffolk_director';
	$password = 'WmR8nu4p';
//for development
	//$username = 'root';
	//$password = 'root';

try {
    //for production
    $handler = new PDO('mysql:host=localhost;dbname=suffolk_meeting', $username, $password);
    //for development
    //$handler = new PDO('mysql:host=localhost;dbname=meeting', $username, $password);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    die();
}
	//echo "CONNECTION SUCCESSFUL";
// This is the MySQL connect file
//$dbhost = 'localhost';
//$dbuser = 'suffolk_director';
//$dbpass = 'WmR8nu4p';
//$dbname = 'suffolk_meeting';

	$sql=("SELECT * FROM meeting WHERE  locationCity <> :city AND lastUpdate < :last");
				$query = $handler->prepare($sql);
				$query->execute(array(
					':city' => "MOSCOW",
					':last' => "2015-01-01"));
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				//print_r($results[0]['group_name']);
				echo(json_encode($results));



?>


