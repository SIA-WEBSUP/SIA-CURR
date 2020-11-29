<?php

include('./sql-connect.php');

$fGetStats = isset($_GET['stats']);
$fUnknown = isset($_GET['unk']) ? ($_GET['unk']=='true') : false;

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
    'UNK' => 'UNK', // COVID Reopen Status Unknown
su    'ROPN' => 'ROPN', // COVID Reopen Status Confirmed
    'HY' => 'HY', // COVID Hybrid
);

$type_keys = array_keys($type_lookup);

$day_lookup = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

$all_types = array();

$cOnlineMeetings=0;

$online_mtgs = array( // Most groups have one URL for all meetings, some have both group level URL and meeting URLs
    // 'GROUPID'  => array("conf_URL","conf_telephone","mtg_id", "pwd"), // GROUP NAME
    '20'  => array("//us02web.zoom.us/j/86070647539?pwd=M1lzbjhYTDZOMnRpRVpPK1pYSlFEUT09"  , NULL, "860 7064 7539", "bridge"),  // BABYLON BRIDGE TO SOBRIETY
    '37'  => array("//zoom.us/j/6052451111?pwd=UmpvbWJEcHhzbFpzckNnRGJLVjRuUT09", "(929) 205-6099 Passcode: 2043231","605 245 1111", "Sunrise"), // BAY SHORE SUNRISE SOBRIETY
    '40'  => array("//zoom.us/j/364969933"  ,"(929) 205-6099", "364 969 933", "422921"),   // BELLPORT GROUP
    '49'  => array("//zoom.us/j/4925480677" ,"(646) 558-8656", "492 548 0677", NULL),      // BRENTWOOD LADIES GROUP
    '60'  => array("//zoom.us/j/214128575" , NULL, "214 128 575", "05856123"),             // BROOKHAVEN WOMEN'S GROUP
    '61'  => array("//zoom.us/j/482418696" , NULL, "482 418 696", "406883"),               // BROOKHAVEN HAPPY HOUR
    '061.WD.01'  => array("//zoom.us/j/571032502" , NULL, "571032502", "951700"),          // BROOKHAVEN HAPPY HOUR WED BEG
    '82'  => array("//zoom.us/j/6311431023" ,"(631) 766-3661", "631 143 1023", "Cutchogue"), // CUTCHOGUE SUNDAY
    '83'  => array("//zoom.us/j/94672171612?pwd=Y3owSW9Iaks2dHVZbTNDSk16RmQ4dz09", "(929) 205-6099", "946 7217 1612", "cutchogue"), // CUTCHOGUE STEP GROUP
    '85'  => array("//zoom.us/j/86589024896"  , NULL, "865 8902 4896", "438051"),          // HOME FOR DINNER
    '88'  => array("//zoom.us/j/4234489821?pwd=eTlJRHpWa2tJNUVjS0gzRFArNlovQT09", NULL, "423 448 9821", "21212"), // DIX HILLS SUNDAY SOBRIETY
    '92'  => array("//nyintergroup.zoom.us/j/97702600345?pwd=MTJneE1OSG1CVE9mWFFaMFJ2L2lkQT09", "(929) 436-2866", "977 0260 0345", "bonac"), // SPRINGS FIREPLACE GROUP
    '107' => array("//zoom.us/j/609004671"  ,"(929) 205-6099", "609 004 671", NULL),       // VALLEY 8 O'CLOCK
    '108' => array("//nyintergroup.zoom.us/j/93791458968", "(929) 436-2866", "937 9145 8968", NULL), // EAST NORTHPORT SERENITY
    '121' => array("//us02web.zoom.us/j/81839410326?pwd=RUd5YjdNMUFxZzRPQ2twaFRmWWxYZz09", NULL, "818 3941 0326", "164164"), // FORT SALONGA WORKSHOP
    '126' => array("//nyintergrioup.zoom.us/j/253179384?pwd=MUlYaGVQZ2lLczcvd1FnWFVRTWkyUT09", "(929) 436-2866", "253 179 384", "777"),   // HUNTINGTON STA NEW LIFE
    '125' => array("//meet.google.com/cyn-npse-mto", "(347) 773-0220", "266 098 222", NULL), // GREENLAWN HUNTINGTON STATION
    '142' => array("//zoom.us/j/7354181748" , NULL, "735 418 1748", "HAUPPAUGE"),          // TOUCHSTONES GROUP
    '157' => array("//zoom.us/j/851329515?pwd=STFwM1dOQUZUZXdrTlFZK1hIMDlnUT09","(646) 876-9923", "851 329 515", "DIY"), // DOING IT YOUNG
    '168' => array("//zoom.us/j/85068453181","(646) 558-8656 Passcode: 535388", "850 6845 3181", "asolution"), // LAKE RONKONKOMA GROUP
    '173' => array("//zoom.us/j/699580490"  , NULL, "699 580 490", "014700"),              // LINDENHURST GROUP
    '176' => array("//meet.google.com/gbi-rsmn-odo","(502) 430-2829","389 359 014", NULL), // NEIGHBORHOOD SOBRIETY
    '178' => array("//meet.google.com/nrp-ipeq-utg","(240) 397-5311","541 313 606",NULL),  // THE ONLY REQUIREMENT
    '181' => array("//nyintergroup.zoom.us/j/682689475?pwd=Rzl1L0RRQmc2bEdaTjdkVzgzS0k4QT09", NULL, "682 689 475", "mattituck"), // MATTITUCK MID WEEK
    '198' => array("//zoom.us/j/4666501565?pwd=V1FuTFJnMG1tcmVVdmxyaDhZbHNpdz09", "(929) 205-6099", "466 650 1565","595631"),    // NORTH BABYLON JUST FOR TODAY
    '215' => array("//us02web.zoom.us/j/6913867484?pwd=Q1FGRTZCenM4OVJhR0o3bWwzcCs5UT09", "(646) 876 9923", "691 386 7484", "350155"), // PATCHOGUE GROUP
    '228' => array("//zoom.us/j/5274153100", NULL, "527 415 3100", NULL),                  // PORT JEFF SOBRIETY FIRST
    '230' => array("//us02web.zoom.us/j/9177565845?pwd=MDBGQnNDdDhIazZrRURTWnkwaWJodz09", NULL, "917 756 5845", "767066"),              // PORT JEFF INTO ACTION
    '237'      => array("//nyintergroup.zoom.us/j/699794136?pwd=cktiMmxXT3RpV2phZ3E2VXdPWmxCZz09", "(929) 436-2866", "699 794 136", "809363"), // REMSENBURG BASIC SOBRIETY
    '237.WD.0' => array("//nyintergroup.zoom.us/j/409580451?pwd=Vk1OZXFuOEpRUVFxY01heHpoMTY3UT09", "(929) 436-2866", "409 580 451", "497252"), // REMSENBURG BASIC SOBRIETY
//  '239' => array("//zoom.us/j/500051173", NULL, "500 051 173", "1234"),                  // AQUEBOGUE FREEDOM GROUP
    '239' => array("//zoom.us/j/3572366731?pwd=amlwY1RQdjlsUHFZUDFZeVk3SFowUT09", NULL, "357 236 6731", "1234"), // AQUEBOGUE FREEDOM GROUP
    '240' => array("//zoom.us/j/4176066161?pwd=Z2Y3cnM4SjJ6dTVXN0RLUVllejJydz09","(646) 558 8656 ","417 606 6161","6318754849"), // REFLECTIONS '90
    '248' => array("//zoom.us/j/829531250","(646) 558 8656","829 531 250","150362"),      // ROCKY POINT SERENITY AT SHOREHAM
    '252' => array("//us04web.zoom.us/j/181483609?pwd=Z3FvZEMrejhZRUtmWXpNU3JIWFhOdz09", NULL, NULL, NULL), // RONKONKOMA BREAKFAST CLUB
    '265' => array("//meet.google.com/vgb-qmdb-wxw","(540) 835-0174","364 002 227", NULL), // THE LITTLE RED SCHOOLHOUSE
    '266' => array("//meet.google.com/oop-cugb-edz","(858) 345-6725","612 896 653", NULL), // ST JAMES GROUP
    '267' => array(NULL, "(605) 313-5315 Access Code: 266443#", NULL, NULL, NULL),         // ST JAMES SUNRISE REFLECTIONS
    '278' => array("//us02web.zoom.us/j/88572542344", "(646) 558 8656", "885 7254 2344",NULL), // SHELTER ISLAND GROUP
    '279' => array("//us02web.zoom.us/j/5205564408",  "(646) 558 8656", "520 556 4408", NULL), // SHELTER ISLAND NEW BEGINNINGS
    '280' => array(NULL, "(978) 990-5000 Passcode: 891 721", NULL, NULL),                  // SHELTER ISLAND KEEP IT SIMPLE
    '287' => array("//zoom.us/j/5973540591", NULL, "597 354 0591", "hope364"),             // SMITHTOWN GROUP
    '289' => array("//nyintergroup.zoom.us/j/4313933180?pwd=aU1lS2lXbXlNcUprZW5TdVN0T0Z1dz09", "(929) 436-2866", "431 393 3180", "serenity"), // SMITHTOWN SERENITY
    '315' => array("//us02web.zoom.us/j/8727414086?pwd=SmtrT0Q2NzBWYW1xZFdESXJ1K0dMUT09", NULL, "872 741 4086", "381491"), // WADING RIVER GROUP
    '316' => array("//nyintergroup.zoom.us/j/4427989869?pwd=dEw4eG1FUnFHbVFHczVBZ1lCVmpaZz09", NULL, "442 798 9869", "BillW"), // 11th STEP MEDITATION WORKSHOP
    '324' => array("//us02web.zoom.us/j/173718981", NULL, "173 718 981", "088492"),        // WEST ISLIP GOOD SOBRIETY
    '351' => array("//us02web.zoom.us/j/86239050147?pwd=NmhOSkxLbXdMYlVYV1BDclhSOG50dz09", "(646) 558-8656", "862 3905 0147","502128"), // SOUTHAMPTON MONDAY CLOSED DISCUSSION GROUP
    '356' => array("//zoom.us/j/299922586", NULL, "299 922 586", "Home"),                  // MATTITUCK MEN'S GROUP
    '375' => array("//zoom.us/join", NULL, "617 988 572","For Password please text\n\r  DeeAnn (631) 495-4912 or\n\r  Besty (631) 525-1828"), // A NEW BEGINNING (WOMEN"S GROUP)
//    '417' => array("//meet.google.com/ivi-ugdp-hhm","(530) 425-6625‬","447 762 087", NULL), // BAY SHORE FREETHINKERS
    '437' => array("//zoom.us/join", NULL, "909 301 594","799633"),                        // THE ONE AND ONLY
    '447' => array("//zoom.us/j/5100430468", NULL, "510 043 0468","154618"),               // 10 AM GROUP
    '499' => array("//meet.google.com/dqe-eerp-zgv","(570) 554-0159","614 095 850", NULL), // SPIRITUAL CIRCLE
    '526' => array("//meet.google.com/xxe-yqte-sgs","(225) 681-3343","466 412 473", NULL), // SAT EVE LIVING WITH SOBRIETY
    '530' => array("//us02web.zoom.us/j/84350888563?pwd=MGZnaGNiYnEvQVRCT2RLZXdtVC8vdz09","(929) 436-2866","843 5088 8563", "297082"), // STONY BROOK FREETHINKERS
    '535' => array("//zoom.us/j", NULL, NULL, NULL), // FISHER ISLAND
    '538' => array("//us02web.zoom.us/j/3238843983?pwd=Y0c2V21LUnVQTkRTOUM1U3lPWGNvQT09", NULL, "323 884 3983", "592340"), // SELDEN ONE DAY AT A TIME
    '581' => array("//zoom.us/j/504706298", "(929) 205-6099", "504 706 298", NULL),        // FREEDOM FROM FEAR
    '572' => array("//zoom.us/j/2830231736", NULL, "283 023 1736", "253666"),              // HUNTINGTON STA WE CAN RECOVER
    '601' => array("//zoom.us/j/98558565837", NULL, "985 5856 5837", "631740"),            // CONNECT THE DOTS
    '606' => array("//zoom.us/j/86781747581",NULL,"867 8174 7581", "Text for password access: 631-388-0876 or 631-889-1613"), // PORT JEFF TRUE FRIENDS WOMENS
    '695' => array("//zoom.us/j/4458142615",NULL,"445 814 2615", "766504"),                // YOUNG AT HEART IN ISLIP
    '698' => array("//meet.google.com/bpy-aijb-aqi","(301) 845-5176","836 521 984", NULL), // SIA HOSTED
    '699' => array("//meet.google.com/ikn-poem-eba","(978) 435-0386","470 509 931", NULL), // WOMEN'S BACK TO BASICS
    '548' => array("//zoom.us/j/661443978?pwd=YUtRYS9nM3U5dnJtaGZTbld0ZkMvZz09", "(646) 558-8656 Passcode: 480959897","661 443 978", "solutions"), // T-DAY BIG BOOK MEET-A-THON
    '701' => array("//zoom.us/j/661443978?pwd=YUtRYS9nM3U5dnJtaGZTbld0ZkMvZz09", "(646) 558-8656 Passcode: 480959897","661 443 978", "solutions"), // THE SOLUTIONS GROUP ONLINE
    '702' => array("//zoom.us/j/500561044", NULL,"500 561 044", "12steps"),                // SUFFOLK ONLINE
    '703' => array("//zoom.us/j/84592881281", NULL,"845 9288 1281", "sober2020"),          // HOLBROOK LOVE N' SHARE (ONLINE)
    '704' => array("//nyintergroup.zoom.us/j/96853910721?pwd=L1R5bmFDdVoyUFM2Szh5dUZXZU10UT09","(929) 436-2866","968 5391 0721","521231"), // EYE OPENER
    '704.SU.0' => array("//nyintergroup.zoom.us/j/98293111250?pwd=N3orUFNBNFpSVjZiV1JTM0Y5TVNZZz09","(929) 436-2866", "982 9311 1250", "521231"), // EYE OPENER - MENS
    '704.SU.1' => array("//nyintergroup.zoom.us/j/94537387870?pwd=TWhvbjcxTzJzM2VhakQ2bEIydmFqZz09","(929) 436-2866", "945 3738 7870", "788615"), // EYE OPENER - WOMENS
    '705'      => array("//zoom.us/j/691630673","(646) 558-8656","691 630 673", "850366"), // SUNRISE SOBRIETY -
//    '707' => array(NULL, "(605) 313-5315 Access Code: 266443#", NULL, NULL, NULL),         // ST JAMES SUNRISE REFLECTIONS
    '710' => array("//nyintergroup.zoom.us/j/99111309723?pwd=dXlHcUU1SEIya0pjSEV5NVU3NVJadz09","(929) 436-2866 ","991 1130 9723", "0188"), // A MOMENT OF CLARITY
    '717' => array("//zoom.us/j/9224960248" ,"(929) 205-6099", "922 496 0248", NULL),      // DEER PARK ZOOM INTO ACTION
    '720' => array("//us02web.zoom.us/j/84653368848?pwd=aGoxbnFETngwT2ZFVWZiVmlLMThCZz09#success" , NULL, "846 5336 8848", "893172"), // PATCHOGUE WOMEN IN RECOVERY

    // Some meetings have different URLs per meeting
    '024.MN.00' => array("//us02web.zoom.us/j/86978146496?pwd=N2ppWFVzWndFcjZYSE5CMlVKK0Jidz09", NULL, "869 7814 6496", "456143"), // MIDDLE RD - Monday 06:45 PM - Beginners
    '024.MN.01' => array("//us02web.zoom.us/j/82701536190?pwd=RTlidzcwVHB2MU9TaWNvQjlUK29oQT09", NULL, "827 0153 6190", "414151"), // MIDDLE RD - Monday 08:00 PM - Step
    '024.TU.00' => array("//us02web.zoom.us/j/82122611427?pwd=MTR5OW0yZlR3ZEUwRE5xd1lSWmkwdz09", NULL, "821 2261 1427", "504987"), // MIDDLE RD - Tuesday 01:00 PM - Big Book
    '024.FR.00' => array("//us02web.zoom.us/j/76390266462?pwd=SmtWOTBUN2NJVnNCaFBZQUFkK05CUT09", NULL, "763 9026 6462", "790124"), // MIDDLE RD - Friday 06:45 PM - Young Peoples
    '024.FR.01' => array("//us02web.zoom.us/j/85739902972?pwd=SnB5VFVVVGtjR1g2NFV0YVU3QmYwUT09", NULL, "857 3990 2972", "947275"), // MIDDLE RD - Friday 08:00 PM - Open Discussion
    '024.SA.00' => array("//us02web.zoom.us/j/85817619607?pwd=OWlsWXRsaC9lNmQwdEJMQ1g4aXBKdz09", NULL, "858 1761 9607", "218029"), // MIDDLE RD - Saturday 08:00 AM - As Bill Sees It
    '070.MN.00' => array("//zoom.us/j/897671585", NULL,"897 671 585", "123456"),        // CENTERPORT UNITY AT GREENLAWN
    '070.TH.00' => array("//zoom.us/j/145730967", NULL,"145 730 967", "123456"),        // CENTERPORT UNITY AT GREENLAWN
    '070.SA.00' => array("//zoom.us/j/696332623", NULL,"696 332 623", "123456"),        // CENTERPORT UNITY AT GREENLAWN
//    '125.TU.00' => array("//meet.google.com/cyn-npse-mto","(347) 773-0220", "266 098 222", NULL), // GREENLAWN HUNTINGTON STATION
//    '125.TH.00' => array("//meet.google.com/cyn-npse-mto","(347) 773-0220", "266 098 222", NULL), // GREENLAWN HUNTINGTON STATION
    '145.TU.00' => array("//zoom.us/j/5922356616", NULL, "592 2356 616", NULL),         // HUNTINGTON GROUP
    '149.MN.00' => array("//zoom.us/j/93114868696" , NULL, "931 1486 8696", "980540"),  // SOBRIETY HILL
    '149.FR.00' => array("//zoom.us/j/81871381919" , NULL, "818 7138 1919", "056887"),  // SOBRIETY HILL
    '152.SU.01' => array("//nyintergroup.zoom.us/j/99621492360?pwd=cytGbFZmVjRNUjYySlFHVnBwdmNTUT09" , "(929) 436-2866", "996 2149 2360", "letmein"), // MELVILLE HIGH NOON
    '152.MN.01' => array("//nyintergroup.zoom.us/j/99621492360?pwd=cytGbFZmVjRNUjYySlFHVnBwdmNTUT09" , "(929) 436-2866", "996 2149 2360", "letmein"), // MELVILLE HIGH NOON
    '152.TU.01' => array("//nyintergroup.zoom.us/j/99621492360?pwd=cytGbFZmVjRNUjYySlFHVnBwdmNTUT09" , "(929) 436-2866", "996 2149 2360", "letmein"), // MELVILLE HIGH NOON
    '152.WD.02' => array("//nyintergroup.zoom.us/j/99621492360?pwd=cytGbFZmVjRNUjYySlFHVnBwdmNTUT09" , "(929) 436-2866", "996 2149 2360", "letmein"), // MELVILLE HIGH NOON
    '152.TH.01' => array("//nyintergroup.zoom.us/j/99621492360?pwd=cytGbFZmVjRNUjYySlFHVnBwdmNTUT09" , "(929) 436-2866", "996 2149 2360", "letmein"), // MELVILLE HIGH NOON
    '152.FR.01' => array("//nyintergroup.zoom.us/j/99621492360?pwd=cytGbFZmVjRNUjYySlFHVnBwdmNTUT09" , "(929) 436-2866", "996 2149 2360", "letmein"), // MELVILLE HIGH NOON
    '152.SA.01' => array("//nyintergroup.zoom.us/j/99621492360?pwd=cytGbFZmVjRNUjYySlFHVnBwdmNTUT09" , "(929) 436-2866", "996 2149 2360", "letmein"), // MELVILLE HIGH NOON
    '187.SU.01' => array("//zoom.us/j/91048231165", NULL, "910 4823 1165", "070984"),   // MELVILLE SWEET AIR - SUN DR
    '187.WD.00' => array("//zoom.us/j/71228734268", NULL, "712 2873 4268", "serenity"), // MELVILLE SWEET AIR - WED BE
    '187.TH.00' => array("//zoom.us/j/9278322441", NULL, "927 8322 441 ", "YS650"),     // MELVILLE SWEET AIR - THU BB
    '189.TU.00' => array("//zoom.us/j/852561412?pwd=dEttYmp6UXplYzVxUEF5YWttdUxaZz09", NULL, NULL, NULL), // LONGWOOD LOVE & SERVICE
    '189.TH.00' => array("//zoom.us/j/604011879?pwd=T2dsZy9IYlphQVlmUm1VSk5VMk5EUT09", NULL, NULL, NULL), // LONGWOOD LOVE & SERVICE
    '203.SU.00' => array("//zoom.us/j/414657828", NULL, "414 657 828", "northport"),    // NORTHPORT FREE AT LAST
    '203.TH.00' => array("//zoom.us/j/414657828", NULL, "575 115 331", "northport"),    // NORTHPORT FREE AT LAST
    '203.SA.00' => array("//zoom.us/j/414657828", NULL, "855 934 327", "northport"),    // NORTHPORT FREE AT LAST
    '238.TU.01' => array("//nyintergroup.zoom.us/j/98985905907?pwd=dDZPUGlxRk14WmdCTUY2Z2d6WHY5dz09","(515) 882-0190", "989 8590 5907", "869937"), // RIVERHEAD GROUP - BB
    '238.FR.00' => array("//nyintergroup.zoom.us/j/95971144125?pwd=R0Fud3h5bGQvRjFCdnN3SGdjYjBJUT09","(929) 436-2866", "959 7114 4125", "023267"), // RIVERHEAD GROUP - BE
    '250.SU.00' => array("//zoom.us/j/513760537", NULL, "513 760 537", "bigbook"),      // CLEARY SCHOOL
    '250.TH.00' => array("//zoom.us/j/500561044", NULL, "500 561 044", "12steps"),      // CLEARY SCHOOL
    '285.MN.01' => array("//zoom.us/j/380514478", "(929) 436 2866", "380 514 478", "918048"),    // SOBRIETY UNLIMITED
    '285.FR.00' => array("//zoom.us/j/380514478", "(929) 436 2866", "380 514 478", "918048"),    // SOBRIETY UNLIMITED
    '286.MN.00' => array("//zoom.us/j/9134002353", NULL, "913 400 2353", "Smithtown1"), // SMITHTOWN AFTERNOON GROUP
    '286.TU.00' => array("//zoom.us/j/397655961",  NULL, "397 655 961",  "letitgo"),    // SMITHTOWN AFTERNOON GROUP
    '286.WD.00' => array("//zoom.us/j/9134002353", NULL, "913 400 2353", "Smithtown1"), // SMITHTOWN AFTERNOON GROUP
    '286.TH.00' => array("//zoom.us/j/397655961",  NULL, "397 655 961",  "letitgo"),    // SMITHTOWN AFTERNOON GROUP
    '286.FR.00' => array("//zoom.us/j/9134002353", NULL, "913 400 2353", "Smithtown1"), // SMITHTOWN AFTERNOON GROUP
    '286.SA.00' => array("//zoom.us/j/9134002353", NULL, "913 400 2353", "Smithtown1"), // SMITHTOWN AFTERNOON GROUP
    '304.WD.00' => array("//zoom.us/j/5907152081", NULL, "590 715 2081", "524283" ),    // SOUTHOLD SETTLERS
    '304.TH.00' => array("//zoom.us/j/5907152081", NULL, "590 715 2081", "524283" ),    // SOUTHOLD SETTLERS
    '366.SU.00' => array("//zoom.us/j/790355954", NULL, "790 355 954", "cowharbor"),    // NORTHPORT COW HARBOR
    '366.TU.00' => array("//zoom.us/j/751707060", NULL, "751 707 060", "cowharbor"),    // NORTHPORT COW HARBOR
    '366.SA.00' => array("//zoom.us/j/360801140", NULL, "360 801 140", "cowharbor"),    // NORTHPORT COW HARBOR
    '422.FR.00' => array("//meet.google.com/wno-mhit-zmk","(402) 824-0258","705 336 354", NULL),  // ROCKY POINT UNITY GRP
//  '422.SA.00' => array("//meet.google.com/wno-mhit-zmk","(402) 824-0258","705 336 354", NULL),  // ROCKY POINT UNITY GRP
    '591.MN.00' => array("//zoom.us/j/531387530", NULL, "531 387 530", "cowharbor"),    // NORTHPORT COW HARBOR

    // East End Meetings:
//  '1'  => array("//zoom.us/j/812452820",	            NULL,"812 452 820", NULL),      // Ammagansett Sunday Beginners
    '2'  => array("//nyintergroup.zoom.us/j/6554056699", NULL,"655 405 6699", NULL),    // Ammagansett AM
    '3'  => array("//nyintergroup.zoom.us/j/992780763",	NULL,"992 780 763", "mensroom"),// Ammagansett The Mens Room
    '7'  => array("//zoom.us/j/479172809",	            NULL, "479 172 809", "916836"), // Ammagansett	ROUND ROBIN
    '500'  => array("//zoom.us/j/231147035",	        NULL,"231 147 035", "505622"),  // Ammagansett Happy Hour
    '56'  => array("//us02web.zoom.us/j/378504990?pwd=YkYrNUJVRTY0UVBSNDNOWERVVjVVUT09", NULL,"378 504 990", "236746"),  // Bridgehampton Hayground Keep It Simple
    '58'  => array("//nyintergroup.zoom.us/j/99572734568",	NULL,"995 7273 4568", "130529"), // Bridgehampton East End Young People
    '91'  => array("//zoom.us/j/7914635469","(929) 205-6099","791 463 5469", NULL),     // East Hampton Group
    '96'  => array("//zoom.us/j/625731737",	"(929) 436-2866","625 731 737", NULL),      // Sunday Step
    '97'  => array("//zoom.us/j/489358693",	                NULL,"489 358 693", "email the group at soberwomenseast@yahoo.com"), // Sober Woman's East
    '365'  => array("//zoom.us/j/279125585",	        NULL,"279 125 585", "KISS"),    // East Hampton Keep It Simple
    '418'  => array("//zoom.us/j/361007173",	        NULL,"361 007 173", "b2b001"),  // East Hampton Back to Basics
    '094.SA.00'  => array("//zoom.us/j/997866134",	    NULL,"997 866 134", "Green123"), // East Hampton Keep it Green
    '094.SU.00'  => array("//zoom.us/j/876167885",	    NULL,"876 167 885", "Green123"), // East Hampton Keep it Green
    '094.WD.00'  => array("//nyintergroup.zoom.us/j/94867360733",	NULL,"948 6736 0733", "Green123"), // East Hampton Keep it Green
    '392'  => array("//zoom.us/j/995319793",	        NULL,"995 319 793", "#girlsrule"), // Hampton Bays Women's Group
    '433'  => array("//zoom.us/join",	                NULL,"483 772 9818", "980165"),  // Hampton Bays	Spiritual Awakening West - 11th Step Meditation Mtg
    '573.SU.02'  => array("//zoom.us/j/207160635",	        NULL,"207 160 635", "sobriety#1"), // Hampton Bays Hampton Bay Sunday Night Group
    '700'  => array("//nyintergroup.zoom.us/j/889817053",	NULL,"889 817 053", "MTK1212"), // Montauk Montauk Group (ONLINE ONLY)
    '190.SA.00'  => array("//zoom.us/j/532272602",	"(929) 436-2866 Passcode: 556423","532 272 602", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.TH.00'  => array("//zoom.us/j/377870869",	"(929) 436-2866 Passcode: 240613","377 870 869", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.TU.00'  => array("//zoom.us/j/116733466",	"(929) 436-2866 Passcode: 370982","116 733 466", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.WD.00'  => array("//zoom.us/j/115649907",	"(929) 436-2866 Passcode: 692971","115 649 907", "Wilson1212"), // Montauk The Smith-Wilson Group
    '580'  => array("//zoom.us/j/845720420",	        NULL,"845 720 420", "#geekinout"), // Riverhead Back to Books
    '262'  => array(NULL, "(515) 604-9094","790 452 210", NULL),                        // Sag Harbor Spiritual Solution
//  '   301'  => array("//zoom.us/j/175307047",	"(646) 568-7788","175 307 047", NULL),  // Southampton Friday Night Group (Our Lady of Poland)
    '317.MN.00'  => array("//nyintergroup.zoom.us/j/553131814",	"929 436 2866 Passcode: 860059","553 131 814", "letmein"), // Wainscott	Lincoln & Lee
    '317.WD.00'  => array("//nyintergroup.zoom.us/j/553131814",	"929 436 2866 Passcode: 860059","553 131 814", "letmein"), // Wainscott	Lincoln & Lee
    '378'  => array("//zoom.us/j/175307047",            NULL,"175 307 047", NULL),      // Wainscott MIRACLES HAPPEN
    '439'  => array("//zoom.us/j/697601579",            NULL,"697 601 579", NULL),      // Water Mill WATER MILL SUNDAY NIGHT BEGINNER'S
    '711'  => array("//zoom.us/j/6312831935",	        NULL,"631 283 1935", "1935"),   // Southampton First Things First (ONLINE)
);

//fetch data
$return = array();
foreach ($result as $row) {
	//types
	$row['types'] = str_replace(array(',', ';', ':'), ' ', strtoupper($row['types']));
	$types = explode(' ', $row['types']);

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

            // append mtgID to meeting notes
            if ($conference_mtgID && strpos($conference_url, "zoom.")) {
                // Display the ZOOM meeting ID for ALL ZOOM meetings to handle
                // the rare case where the group doesn't want a direct link to meeting
                $row['notes'] .= "ZOOM Meeting ID: " . $conference_mtgID . "\n\r\n\r";
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
                    $row['notes'] .= "\n\r\n\rMtg ID: " . $conference_mtgID . "#";
                }
            }
            // append pwd to meeting notes
            if ($access_num) {
                $row['notes'] .= "\n\r\n\rPasscode: " . $access_num .  "#";
            }

            // encode phone with meeting ID and password for one tap number
            // should look like +12125551212,,123456789#,,,,,,0#,,444444#
            if ($conference_phone) {
                $conference_phone = "+1" . $conference_phone . ",," . $conference_mtgID . "#,,,,,,0#";
                if ($access_num) {
                    $conference_phone .= ",," . $access_num . "#"; // append access no if it exists
                } else if ($conference_pwd){
                    $conference_phone .= ",," . $conference_pwd . "#"; // append pwd if necessary
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


	//build array
	$return[] = array(
		'slug' => $row['meeting_id'],
		'day' => array_search($row['day'], $day_lookup),
		'time' => date('H:i', strtotime($row['time'])),
		'name' => $row['group_name'],
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
