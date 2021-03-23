<?php
/**
 * Created: David V
 * User: dvein
 * Date: 2/24/2019
 *
 *
 * This script has various utility functions used by newMeetingTable.php
 *
 **
 */

global $fDebug;
$fDebug = isset($_GET['debug']);

global $array_note_delimiter;
$array_note_delimiter= ['****','***','**','*','##', '#'];

global $day_short2long_lookup;
$day_short2long_lookup = array(
    'SU'=>'Sunday',
    'MN'=>'Monday',
    'TU'=>'Tuesday',
    'WD'=>'Wednesday',
    'TH'=>'Thursday',
    'FR'=>'Friday',
    'SA'=>'Saturday');

function print_array($array) {
    echo "<pre>";
    print_r($array);
    echo "<pre/>";

}

function print_headers($headers) {
    echo '<table style=\"width:100%\"><tr>';
    foreach ($headers as $heading) {
        printf("<th>[%s]</th>", $heading);
    }
    echo "</tr></table>";
}

function print_as_table($table) {
    echo '<table style=\"width:100%\"><tr>';
    foreach (array_keys($table[0]) as $heading) {
        printf("<th>[%s]</th>", $heading);
    }
    echo "</tr><tr>";
    foreach($table as $row) {
        foreach($row as $field)
            printf("<td>%s</td>", $field);
        echo "</tr><tr>";
    }
    echo "</table>";
}

// check against null otherwise we'll be replacing nulls with empty strings !!
function remove_newlines($str) {
    $str = $str === null ? null : str_replace(array("\n", "\r"), ' ', $str);
    return $str;
}

function array_meetings_from_old_listing($mtgs, $array_notes) {
    global $array_note_delimiter;

    // get array of array of mtg elements
    $mtgs = preprocessmtgs($mtgs);

    $return = array();
    foreach ($mtgs as $mtg) {
        $notes  = array_intersect($mtg,$array_note_delimiter);
        $time   = array_filter($mtg, 'is_time_part');
        $types  = array_diff($mtg, $time, $notes);

        $time   = get_meeting_time($time);
        $types  = implode(' ', $types);
        $notes = notes_full($array_notes, $notes);

        $return[] = array("time"=>$time, "types"=>$types, "notes"=>$notes);
    }
    return $return;
}


//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
// workhorse function
//
// INPUT :  1 or more mtg listings as a single string with note delimiters, times, types
// OUTPUT:  an array of meetings, each meeting is in turn an array of it's components
//
// note that one oddity is if there is only one meeting, the normal case,
// all note delimiters and types belong to that one meeting even if they occur after the time
//
// in the less common case where there are multiple meetings, any note delimiters or types
// following the last meeting time belong to that last meeting
//
//    "*B - NOON**"             => [ ['*','B','12','**'] ]
//    "* B - 9:30**"            => [ ['*','B','9',':','30','**'] ]
//    "* ***8:00 AM ***C-7:00"  => [ ['*','***','8',':','00','AM'] , ['***','7',':','00'] ]
//    "*CD-Noon"                => [ ['*','CD','12'] ]
//    "B-1:00#"                 => [ ['B','1',':','00','#'] ]
//    "** ## S - 6"             => [ ['**','##','S','6'] ]
//    "*C&S-8:00"               => [ ['C','*','8',':','00'] , ['S','*','8',':','00'] ]
//    "M&W-7:00 *S-8:30"        => [ ['M','7',':','00'] , ['W','7',':','00'] , ['S','*','8',':','30'] ]
//    *CD-10:00 AM B&BB-10:00 AM=> [ ['*','CD',10',':','00','AM'] , ['B','10',':','00','AM'] , ['BB','10',':','00','AM'] ]

function preprocessmtgs($mtgs){
    // clean up and normalize
    $mtgs = strtoupper($mtgs);

    // find places where ';' is placed in a tim,e instead of ':'
    $mtgs = preg_replace('/([0-9]);([0-9])/', '$1:$2', $mtgs);

    $mtgs = str_replace(array(',', ';','-','/'), ' ', $mtgs);

    // force a space bet note delimiter and following/preceding character
    $mtgs = preg_replace('/([\*#])([A-Z0-9])/', '$1 $2', $mtgs);
    $mtgs = preg_replace('/([A-Z0-9])([\*#])/', '$1 $2', $mtgs);
    // forece a space between digit and 'A' or "P'
    $mtgs = preg_replace('/([0-9])([AP])/', '$1 $2', $mtgs);

    // let's keep the colon and add some spaces
    $mtgs = str_replace(':', ' : ',$mtgs);

    // special case NOON
    $mtgs = str_replace("NOON", "12", $mtgs);

    // turn into array, trim any extra spaces and re-index array
    $mtgs = explode(' ',$mtgs);
    $mtgs = array_values(array_filter(array_map('trim', $mtgs)));

    global $array_note_delimiter;

    // put meeting separator after time portion, unless it's the only meeting left
    $return = array();
    $fFoundTime = false;
    for($i =0;$i<count($mtgs);$i++) {
        $chunk = $mtgs[$i];
        if (is_time_part($chunk)) {
            $fFoundTime = True;
        } else {
            // if we're at the end of a time and there is another time still to process
            // mark this as the end of this mtg listing
            if ($fFoundTime &&
                array_sum(array_map('is_numeric', array_slice($mtgs,$i+1)))) {
                $return[]= '¤';
                $fFoundTime = false; // reset this flag
            }
        }
        $return[] = $chunk;
    }

    // make sure we end on a mtg delimiter
    if ($return[count($return)-1] != '¤') $return[]= '¤';

    $return = implode(' ',$return); // back to string
    $return = explode('¤', $return); // split at mtg delimiter

    $mtgs = array_filter($return); // we end up with a pesky empty array at end, trim off
    $return = array();
    foreach ($mtgs as $mtg){
        $return[] = array_filter(explode(' ',$mtg));
    }

    // handle '&'
    $return = split_ampersand_listed_meetings($return);

    return $return; // returns array of array of meetings !!!
}


// walk through array of mtgs and
// split '&' joined meetings into 2 separate mtgs
// [ ['C&S','*','8',':','00'] ]     => [ ['C','*','8',':','00'] , ['S','*','8',':','00'] ]
// [ ['B&BB','10',':','00','AM'] ]  => [ ['B','10',':','00','AM'] , ['BB','10',':','00','AM'] ]
function split_ampersand_listed_meetings($mtgs) {
    global $fDebug; // output some extra debuggin info

    $mtg1 = $mtg2 = null;
    $mtgs2 = array(); // build new array of meetings

    foreach ($mtgs as $mtg){
        foreach ($mtg as $chunk) {
            if (($i = strpos($chunk, '&')) !== false) {
                assert($i > 0 && ($i + 1) < strlen($chunk)); // better not be at beginning of ending of chunk
                $mtg1 = substr($chunk, 0, $i);
                $mtg2 = substr($chunk, $i + 1, strlen($chunk - $i - 1));
                $mtg_remainder = array_diff($mtg, [$chunk]);
            }
        }
        if ($mtg1 == null) {
            $mtgs2[] = $mtg;
        } else {
            $mtgs2[] = array_merge([$mtg1], $mtg_remainder);
            $mtgs2[] = array_merge([$mtg2], $mtg_remainder);
            if ($fDebug) {
                printf("Found '%s' = > '%s' & '%s'<br>",
                    implode(' ', $mtg),
                    implode(' ', $mtgs2[count($mtgs2) - 2]),
                    implode(' ', $mtgs2[count($mtgs2) - 1]));
            }
            $mtg1 = $mtg2 = null;
        }
    }
    return $mtgs2;
}


// convert time to meeting start time
// make the time PM if there is no "AM" or "PM"
function get_meeting_time($time) {
    $fAM = in_array('A',$time) || in_array('AM', $time);
    $fPM = in_array('P',$time) || in_array('PM', $time);
    $time = implode('', $time);

    if (!$fAM && !$fPM) $time = $time." PM";
    $time = strtotime($time);
    $time = date("H:i", $time);
    return $time;
}

function is_time_part($t) {
    return   is_numeric($t) || $t == ":" ||
                        $t == "A" || $t == "AM" ||
                        $t == "P" || $t == "PM";
}



// return array of 'delimiter'=>'note' pairing
function array_notes($notes) {
    global $array_note_delimiter;
    $return = array();
    foreach ($array_note_delimiter as $delimiter) {
        $d_len = strlen($delimiter);
        if (($i = strpos($notes, $delimiter)) !== false) {
            $n1 = strpos(substr($notes,$i+$d_len ),"*");    //find next '*'
            $n2 = strpos(substr($notes,$i+$d_len ),"#");    //find next '#'
            $n1 = ($n1 === false) ? PHP_INT_MAX : $n1;
            $n2 = ($n2 === false) ? PHP_INT_MAX : $n2;
            $j = min($n1, $n2);                                         //offset to next note
            $note = substr($notes,$i+$d_len,$j);                  //note including delimiter
            $notes = str_replace($delimiter.$note,'',$notes); //remove delimiter
            $return[$delimiter] = $note; //build array of ['delimiter' => 'note'] pairing
        }
    }
    // Add whatever is left to the ALL slot
    $notes = trim($notes);
    if (strlen($notes)>0)
        $return['ALL'] =  $notes;
    return $return;
}

// return single string with all delimiters and notes that apply
// check $notes for delimiters that apply
// grab full note text from $array_notes
function notes_full($array_notes, $notes){
    $notes_full = '';
    // add ALL element if it exists
    if ((count($array_notes) > 0) && array_key_exists('ALL',$array_notes)) {
        $notes_full = $array_notes['ALL'] . '<br>' ;
    }

    foreach ($notes as $note) {
        if (array_key_exists($note, $array_notes))
            $notes_full = $notes_full . $note . $array_notes[$note] . ' ';
    }
    return trim($notes_full);

//   FANCIER WAY = BUT ULTIMATELY LESS READABLE
//    // filter on only the the needed notes
//    $notes_full = array_filter($array_notes,
//                              function($k) use ($notes) { return in_array($k, $notes); },
//                         ARRAY_FILTER_USE_KEY);
//    // combine delimiter and note
//    $notes_full = array_map(function($k, $v) { return $k.$v;},
//                            array_keys($notes_full), array_values($notes_full));
//    // add ALL element if it exists
//    if (array_key_exists('ALL',$array_notes)) {
//        $notes_full[] = $array_notes['ALL'];
//    }
//
//    // reverse to have * before ** before **, etc.
//    $notes_full = array_reverse($notes_full);
//
//    // return as one string
//    return implode(' ',$notes_full);
}

