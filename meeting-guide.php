<?php

include('./sql-connect.php');

$fGetStats = isset($_GET['stats']);
$fUnknown = isset($_GET['unk']) ? ($_GET['unk']=='true') : false;
$fDebug = isset($_GET['debug']) ? ($_GET['debug']=='true') : false;

// printf("<br>fGetStats =  %s" , ($fGetStats==true)  ? "TRUE" : "FALSE");
// printf("<br>fUnknown =  %s" , ($fUnknown==true)  ? "TRUE" : "FALSE");
//exit;

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
    'TT' => '12x12', // 12 Steps & 12 Traditions
	'SA' => 'A', // Secular
	'ASL' => 'ASL', // ​American Sign Language
	'ABSI' => 'ABSI', // As Bill Sees It
	'ABSIT' => 'ABSI', // As Bill Sees It
	'B' => 'BE', // Newcomer
	'BB' => 'B', // Big Book
	'BBOD' => array('B', 'O', 'D'), // Big Book, Open, Discussion
	'BYOC' => 'C', // Bring Your Own Closed
	'C' => 'C', // Closed
    'CAN' => 'CAN', // Candlelight
	'CD' => array('C', 'D'), // Closed, Discussion
	'DR' => 'DR', // Daily Reflections
	'GV' => 'GR', // Grapevine
	'LGBTQ' => 'LGBTQ', // GLBT
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
    'OUT' => 'OUT', // Outdoor
	//[24] => PROMISES = Promises
	'S' => 'ST', // Step
    'SPAN' => 'S', // Speaker
	'SP' => 'SP', // Speaker
	'T' => 'TR', // Tradition
    'TC' => 'TC', // Temp Closure
    'TOP' => 'TPC', // Topic - custom type
	'TOPIC' => 'TPC', // Topic - custom type
    'TPC' => 'TPC', // Topic - custom type
 	'W' => 'W', // Womens
	'WC' => array('W', 'C'), // Womens, Closed
	'WCD' => array('W', 'C', 'D'), // Womens, Closed, Discussion
	'WS' => array('W', 'ST'), // Womens, Step Meeting
	'YP' => 'Y', // Young People
	'X' => 'X', // Handicap
    'UNK' => 'UNK', // COVID Reopen Status Unknown
    'ROPN' => 'ROPN', // COVID Reopen Status Confirmed
    'HY' => 'HY', // COVID Hybrid
);

$type_keys = array_keys($type_lookup);

$day_lookup = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

$all_types = array();

// online meetings in separate file
include('./online-meetings.php');
$cOnlineMeetings=0;

// fetch data
$return = array();
foreach ($result as $row) {
	//types
	$row['types'] = str_replace(array(',', ';', ':'), ' ', strtoupper($row['types']));
	$types = explode(' ', $row['types']);

	if ($fDebug){
	    var_dump($row);
	    echo '<br';
    }

    // replace <br> with '/n/r'
    $row['notes'] = str_replace( '<br>', "\n\r", $row['notes']);
    $row['locationNotes'] = str_replace( '<br>', "\n\r", $row['locationNotes']);

    //online meetings
    $conference_url = $conference_phone = $conference_mtgID = $conference_pwd = NULL;
    $conference_info = NULL;
    $access_num = NULL;

    if ( in_array("TC",$types) || in_array("ONL",$types) || in_array("HY",$types) ) {
        // meeting_id entry takes precedence over group_id;
        if (array_key_exists($row['meeting_id'],$online_mtgs)) {
            $conference_info = $online_mtgs[$row['meeting_id']];
        } else if (array_key_exists($row['group_id'],$online_mtgs)) {
            $conference_info = $online_mtgs[$row['group_id']];
        }

        if ($conference_info) {
            if (!in_array("ONL",$types)) $types[]='ONL'; // TC or HYBRID case
            if (!in_array("TC",$types)) {
                if ((strpos($row['status'], 'ONLINE ONLY') == false) &&  // if it's ONLINE meeting, marks it as
                    (strpos($row['status'], 'HYBRID') === false))        // TC, unless it's HYBRID or it's ONLINE ONLY
                    $types[]='TC';
           }
            $cOnlineMeetings++;
            $conference_url = $conference_info[0] ? "https:" . $conference_info[0]  : NULL;
            $conference_phone = $conference_info[1];
            $conference_mtgID = $conference_info[2];
            $conference_pwd = $conference_info[3];

            if (strlen($row['notes'])>0) $row['notes'] .= "\n\r\n\r"; // Assume we'll be appending something

            // append mtgID and PWD to meeting notes
            if ($conference_mtgID) {
                // Display the meeting ID
                if(strpos($conference_url, "zoom")) {
                    $row['notes'] .= "ZOOM Meeting ID: " . $conference_mtgID . "\n\r\n\r";
                } else
                {
                    if (preg_match('@^.*/(.*)$@',$conference_url,$mtgID)) {
                    $row['notes'] .=  "Google Meeting ID: " . $mtgID[1] . "\n\r\n\r";
                    }
                }

                if ($conference_pwd) {
                    if (strpos($conference_pwd, "Password"))
                        // Special Instructions for password
                        $row['notes'] .= $conference_pwd . "\n\r\n\r";
                    else
                        $row['notes'] .= "PWD: " . $conference_pwd . "\n\r\n\r";
                }
            }
            // append phone number to meeting notes
            if ($conference_phone) {
                $access_num = strpos($conference_phone, "Passcode:");
                if ($access_num) {
                    // grab numeric passcode if it exists
                    $t = substr($conference_phone, 0, $access_num-1);
                    $access_num = substr($conference_phone, $access_num+strlen("Passcode:"), strlen($conference_phone)-1);
                    $conference_phone = $t;
                }
                $row['notes'] .= "To join by phone dial:\n\r  ". $conference_phone;
                if ($conference_mtgID) {
                    $row['notes'] .= "\n\r\n\rDial-in Meeting ID: " . $conference_mtgID . "#";
                }
            }
            // append pwd to meeting notes
            if ($access_num) {
                $row['notes'] .= "\n\r\n\rPasscode: " . $access_num .  "#";
            }

            // encode phone with meeting ID and password for one tap number
            // should look like +12125551212,,123456789#,,,,,,0#,,444444#
            if ($conference_phone) {
                if (strpos($conference_phone, "Access Code: "))
                {
                    $conference_phone =  "+1" . str_replace("Access Code: ",",,,", $conference_phone) . "#";
                } else {
                    $conference_phone = "+1" . $conference_phone . ",," . $conference_mtgID . "#,,,,,,0#";
                    if ($access_num) {
                        $conference_phone .= ",," . $access_num . "#"; // append access no if it exists
                    } else if ($conference_pwd){
                        $conference_phone .= ",," . $conference_pwd . "#"; // append pwd if necessary
                    }
                }
                $conference_phone = str_replace(array('(', ')','-',' '), '', $conference_phone); //strip unnecessary chars

            }
        } else  if (in_array("ONL",$types)) {
            // meeting marked as ONL but no online connection info provided
            // ONL meeting type will be stripped by plugin since no connection info provided
            $row['notes'] .= " ERROR - missing online meeting connection info - contact websup@suffolkny-aa.org\n\r\n\r";
        }

    } else if ( in_array("ROPN",$types) ) {
//        no longer needed now that STATUS UNKNOWN meetings are no longer being pushed to meeting guide app
//        $row['group_name'] .= ' (REOPENED CONFIRMED)';
    }

    // mark all UNK meetings as TC also
    if (!$fUnknown) {
        if ( in_array("UNK",$types) ) {
            $types[] = "TC";
            if ($fGetStats)
                printf("<br> %s %s UNK->TC",$row['meeting_id'], $row['group_name']);
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

	// append OUTDOOR to outdoor meetings
	$meeting_name  = $row['group_name'];
	$meeting_name .= (strpos($row['notes'], "OUTDOOR")!=false) ? " (OUTDOOR)" : "";

	//build array
	$return[] = array(
		'slug' => $row['meeting_id'],
		'day' => array_search($row['day'], $day_lookup),
		'time' => date('H:i', strtotime($row['time'])),
		'name' => $meeting_name,
//		'group' => $row['group_name'],
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

// dump some stats instead of the JSON
if ($fGetStats) {
    $online_groups=array();
    foreach (array_keys($online_mtgs) as $mtgID) {
        $groupID = explode('.',$mtgID);
        $online_groups[$groupID[0]] = isset($online_groups[$groupID[0]]) ? $online_groups[$groupID[0]]+1 : 1;
    }

    $types_stats=array();
    $TC = 0;
    foreach ($return as $meeting) {
        if (in_array("TC",$meeting['types']) && !in_array("ONL",$meeting['types']) )
            $TC++;
        foreach($meeting['types'] as $type) {
            $types_stats[$type] = isset($types_stats[$type]) ? $types_stats[$type]+1 : 1;
        }
    }
    echo "Total Online Meetings = " . $cOnlineMeetings;
    echo "<br><br>Total Online Groups = " . count($online_groups);
    echo "<br><br>True TC count (TC but not ONL) = " . $TC;
    echo "<br><br>";

    echo '<table style=\"width:100%\"><tr>';
    echo "</tr><tr>";
    foreach($types_stats as $t=>$c) {
        printf("<td>%s</td><td>%s</td>>", $t, $c);
        echo "</tr><tr>";
    }
    echo "</table>";
    exit;
}


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
