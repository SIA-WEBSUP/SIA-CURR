<?php
include 'process/sql-connect.php';
include 'process/sql-open.php';

echo "working";
$cutoff = "2014-02-28";
$query = ( "SELECT * FROM `meeting` WHERE town = 'AMITYVILLE'");
$result = mysql_query($query);
while($row = mysql_fetch_array( $result )) {
	
	echo $row["lastUpdate"];
	$datetime1 = new DateTime($row["lastUpdate"]);
	$datetime2 = new DateTime($cutoff);
	//print_r($datetime1);
	//print_r($datetime2);
	$interval = $datetime2->diff($datetime1);
	$interval = $interval->format('%R%a days');
	if($interval > 0) {
		echo $interval;
	}
	};

?>