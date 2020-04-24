<?php


include('./process/sql-connect.php');

// use david v's credentials
$dbuser		= isset($_GET['jdv']) ? 'suffolk_testing': $dbuser;
$dbpass 	= isset($_GET['jdv']) ? 'WEstaging2aa47' : $dbpass;

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
try {
	$result = $pdo->query('SELECT * FROM `new_meeting`');
} catch (PDOException $e) {
	die('SQL query failed: ' . $e->getMessage());
}

function dd($obj) {
	echo '<pre>';
	print_r($obj);
	exit;
}

function array_flatten($array, $return=array()) {
	for ($x = 0; $x <= count($array); $x++) {
		if (isset($array[$x])) {
			if (is_array($array[$x])) {
				$return = array_flatten($array[$x], $return);
			} else {
				$return[] = $array[$x];
			}
		}
	}
	return $return;
}

$type_lookup = array(
	'SA' => 'A',
	'ASL' => 'ASL', // ​American Sign Language
	'ABSI' => 'ABSI', // As Bill Sees It
	'ABSIT' => 'ABSI', // As Bill Sees It
	'B' => 'BE', // Newcomer
	'BB' => 'B', // Big Book
	'BBOD' => array('B', 'O', 'D'), // Big Book, Open, Discussion
	'BYOC' => 'C', // Bring Your Own Closed
	'C' => 'C', // Closed
	'CD' => array('C', 'D'), // Closed, Discussion
	'DR' => 'DR', // Daily Reflections
	'GV' => 'GR', // Grapevine
	'GLBT' => 'LGBTQ', // GLBT
	'LIT' => 'LIT', // Literature
	'LS' => 'LS', // Living Sober
	'M' => 'M', // Mens
	'MC' => array('M', 'C'), // Mens, Closed
	'MED' => array('MED','11'), // Meditation
//	'MEDITATION' => 'MED', // Meditation
	'O' => 'O', // Open
	'OB' => array('O', 'BE'), // Open, Newcomer
	'OBB' => array('O', 'B'), // Open, Big Book
	'OD' => array('O', 'D'), // Open, Discussion
	'ODB' => array('O', 'D', 'BE'), // Open, Discussion, Newcomer
    'ONL' => 'ONL', // Temp Online Meeting
	'OS' => array('O', 'ST'), // Open, Step Meeting
	//[24] => PROMISES = Promises
	'S' => 'ST', // Step
	'SP' => 'S', // Spanish
	'T' => 'TR', // Tradition
    'TC' => 'TC', // Temp Closure
	'TOPIC' => 'D', // Topic
	'W' => 'W', // Womens
	'WC' => array('W', 'C'), // Womens, Closed
	'WCD' => array('W', 'C', 'D'), // Womens, Closed, Discussion
	'WS' => array('W', 'ST'), // Womens, Step Meeting
	'YP' => 'Y', // Young People
	'X' => 'X', // Handicap
);

$type_keys = array_keys($type_lookup);

$day_lookup = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

$all_types = array();

$online_mtgs = array(
                    '37'  => array('//zoom.us/j/6052451111',	NULL),                                  // SUNRISE SOBRIETY
                    '49'  => array('//zoom.us/my/profnorton',	'(646) 558-8656 PIN: 832-489-8304'),    // LADIES GROUP
                    '82'  => array('//zoom.us/j/6311431023',	'(631) 766-3661 PIN: 631 143 1023'),    // CUTCHOGUE SUNDAY
                    //'85'  => array('//us04web.zoom.us/j/742133476',	NULL),                              // HOME FOR DINNER
                    '176' => array('//meet.google.com/gbi-rsmn-odo',	'(502) 430-2829‬ PIN: ‪389 359 014‬#'), // NEIGHBORHOOD SOBRIETY
                    '179' => array('//meet.google.com/nrp-ipeq-utg',	'(240) 397-5311‬ PIN: ‪541 313 006‬#'), // THE ONLY REQUIREMENT
                    '265' => array('//meet.google.com/vgb-qmdb-wxw',	'(540) 835-0174‬ PIN: ‪364 002 227‬#'), // THE LITTLE RED SCHOOLHOUSE
                    '307' => array('//meet.google.com/sps-xjqn-uiu',	'(614) 602-6125‬ PIN: ‪848 749 635‬#'), // UNITY GROUP
                    '375' => array('//nyintergroup.zoom.us/j/617988572?pwd=OG1IcFpqTmwxc3dxSjRycjBJOGJrZz09',
                                                                        '(929) 436 2866 PIN: 617 988 572#'), // A NEW BEGINNING (WOMEN'S GROUP)
                    '463' => array('//meet.google.com/vkh-sgbs-mdd',	'(540) 835-0196 PIN: 855 547 358#'), // BOHO
                    '698' => array('//meet.google.com/bpy-aijb-aqi',    '(301) 845-5176‬ PIN: ‪836 521 984‬#'), // SIA HOSTED
    );


//fetch data
$return = array();
foreach ($result as $row) {
	//types
	$row['types'] = str_replace(array(',', ';', ':'), ' ', strtoupper($row['types']));
	$types = explode(' ', $row['types']);

    //online meetings
    $conference_url = $conference_phone = NULL;
    if ( in_array("TC",$types)) {
        //$group_id = substr($meeting_id,0,3);
        if (array_key_exists($row['group_id'],$online_mtgs)) {
            $types[]='ONL';
            $conference_url = $online_mtgs[$row['group_id']][0];
            $conference_phone = $online_mtgs[$row['group_id']][1];
        }
    }

	//$all_types = array_merge($all_types, $types);
	$types = array_filter($types, function($type) use ($type_keys) {
		return in_array($type, $type_keys);
	});
	$types = array_map(function($type) use ($type_lookup) {
		return $type_lookup[$type];
	}, $types);
	$types = array_flatten($types);

	//add C whenever meeting is not O
	//if (!in_array($types, 'O')) $types[] = 'C';


	//build array
	$return[] = array(
		'slug' => $row['meeting_id'],
		'day' => array_search($row['day'], $day_lookup),
		'time' => date('H:i', strtotime($row['time'])),
		'name' => $row['group_name'],
		'types' => $types,
		'location' => $row['locationName'],
		'address' => $row['locationAddress'],
		'city' => $row['locationCity'],
		'state' => $row['locationState'],
		'postal_code' => $row['locationZip'],
		'country' => 'US',
		'region'=> $row['town'],
		'notes' => $row['notes'],
		'location_notes' => $row['locationNotes'],
		'updated' => $row['lastUpdate'],
		'conference_url' => $conference_url,
		'conference_phone' => $conference_phone
	);
}

/*
$all_types = array_unique($all_types);
sort($all_types);
dd($all_types);
*/

//encode JSON
$return = json_encode($return);
if (json_last_error()) {
	die('JSON error: ' . json_last_error_msg());
}

//make sure headers haven't already been sent, will cause error
if (headers_sent()) {
	die('Error: headers already sent!');
}

//output
header('Content-type: application/json; charset=utf-8');
echo $return;
