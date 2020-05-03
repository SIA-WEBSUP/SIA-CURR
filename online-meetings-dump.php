<?php

include('myutil.php');

function dd($obj) {
    echo '<pre>';
    print_r($obj);
   // exit;
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
    'A'     => 'Agnostic',
    'ABSI'  => 'As Bill Sees It',
    'BE'    => 'Beginners',
    'B'     => 'Big Book',
    'D'     => 'Discussion',
    'C'     => 'Closed',
    'DR'    => 'Daily Reflections',
    'LGBTQ' => 'LGBTQ',
    'Lit'   => 'Literature',
    'LS'    => 'Living Sober',
    'M'     => 'Mens',
    'MED'   => 'Meditation',
    'S'     => 'Step',
    'T'     => 'Traditions',
    'TOPIC' => 'Topic',
    'W'     => 'Womens',
    'YP'    => 'Young People',
);
$type_keys = array_keys($type_lookup);

//dd($meetings);
//echo '<h2>Phone Access to Online Meetings</h2>';

$meetings = file_get_contents("https://suffolkny-aa.org/meeting-guide.php");
$meetings = json_decode($meetings, true);
$day_lookup = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$TSLMRoot = "https://2020.suffolkny-aa.org/meetings/";
echo '<table style=\"width:100%\"><tr>';

echo "<tr></tr><th>Day</th><th>Time</th><th>Name</th><th>Type</th><th>Region</th><th>Notes</th></tr>";
$online_meetings = array();
foreach ($meetings as  $meeting) {
    if ($meeting['conference_phone']) {
        $online_meetings[] = $meeting;
    }
}

$meetings = $online_meetings;

usort($meetings,function ($a, $b) {
    if ($a['day'] == $b['day']){
        return ($a['time'] < $b['time']) ? -1 : 1;
    } else {
        return ($a['day'] < $b['day']) ? -1 : 1;
    }
});

foreach ($meetings as $meeting) {
        // Get long names of types
        $types = array_filter($meeting['types'], function($type) use ($type_keys) {
            return in_array($type, $type_keys);
        });
        $types = array_map(function($type) use ($type_lookup) {
            return $type_lookup[$type];
        }, $types);
        $types = array_flatten($types);

        $notes = $meeting['notes'];
        $delimiter = "To join by phone dial:\n\r  ";
        $notes = substr($notes,strpos($meeting['notes'],$delimiter)+strlen($delimiter), strlen($notes));

        echo "<tr>";
        printf("<td>%s</td>", $day_lookup[$meeting['day']]);
        printf("<td>%s</td>", $meeting['time']); //date("h:i A", $meeting['time']));
        printf("<td><a href=" . $TSLMRoot . $meeting['slug'] . " target='_blank'>%s</a></td>", $meeting['name']);
        printf("<td>%s</td>", implode($types,'<br>'));
        printf("<td>%s</td>", $meeting['region']);
        printf("<td>%s</td>", $notes);
        echo "</tr>";
}
echo "</table>";