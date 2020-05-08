<?php

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

header('Content-type: application/html; charset=utf-8');
echo get_online_meetings_phone_list();
function get_online_meetings_phone_list() {
    $type_lookup = array(
        'A'     => 'Agnostic',
        'ABSI'  => 'As Bill Sees It',
        'BE'    => 'Beginners',
        'B'     => 'Big Book',
    //    'D'     => 'Discussion',
    //    'C'     => 'Closed',
        'DR'    => 'Daily Reflections',
        'LGBTQ' => 'LGBTQ',
        'Lit'   => 'Literature',
        'LS'    => 'Living Sober',
        'M'     => 'Mens',
        'MED'   => 'Meditation',
        'S'     => 'Step',
        'T'     => 'Traditions',
        'TOPIC' => 'Topic',
        'W'     => 'Women\'s',
        'YP'    => 'Young People',
    );
    $day_lookup = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $type_keys = array_keys($type_lookup);

    $meetings = file_get_contents("https://suffolkny-aa.org/meeting-guide.php");
    $meetings = json_decode($meetings, true);
    $TSMLRoot = "https://2020.suffolkny-aa.org/meetings/";

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

    $return = '<table class="phone-table" style="width:100%"><tr>';
    $return .= "<tr></tr><th>Day</th></th><th>Name</th><th>Type</th></tr>";
    $return .= "<tr></tr><th>Time</th></th><th>Phone</th><th>Region</th></tr>";
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

            $return .= "<tr></tr><td>" . $day_lookup[$meeting['day']]. "</td>" ;
            $return .= "<td><a href=" . $TSMLRoot . $meeting['slug'] . " target='_blank'>" . $meeting['name'] . "%s</a></td>";
            $return .= "<td> " . implode($types,' ') . " </td>" ;
            $return .= "</tr><tr><td>". date("h:i A", strtotime($meeting['time'])) ."</td>";
            $return .= "<td>" . $notes . "</td>";
            $return .= "<td>" . $meeting['region']. "</td></tr>";
    }
    $return .=  "</table>";
    return $return;
}