<?php

function get_formatted_date_function($atts = array()) {

	// set up default parameters
	$atts = shortcode_atts(array(
		'date' => 'today',
		'time' => '',
		'format' => 'D,  M jS @ gA'
	), $atts);

	// add placeholder for supscripting ordinal suffixes
	$atts['format'] = str_replace('S','{S}',$atts['format']);

	$d = strtotime($atts['date'] . $atts['time']);
	if ($d){
		if ($d < strtotime("today")) {
			$d = strtotime( str_replace( 'this', 'next', $atts['date'] ) );
		}
		$d = date($atts['format'],$d);
	} else {
			return "ERROR getting date from " . $atts['date'];
		}

	// superscript ordinal suffixes
	return str_replace(
		['{','}'],
		['<sup>','</sup>'],
		$d );
}
add_shortcode('get_date', 'get_formatted_date_function');


function get_current_time ( $atts = array()) {
	// set up default parameters
	$atts = shortcode_atts(array(
		'date' => 'today',
		'time' => '',
		'format' => 'D,  M jS @ gA'
	), $atts);

	if ($atts['time'] == '')
		$atts['time'] = time();

	return date($atts['format'],$atts['time']);
}
add_shortcode('get_current_time', 'get_current_time');


function get_all_phone_meetings () {
    return file_get_contents("https://suffolkny-aa.org/phone-meetings-dump.php");
}
add_shortcode('get_all_phone_meetings', 'get_all_phone_meetings');

function list_bulletins() {
    $atts = array (
        'root'    => 'https://suffolkny-aa.org',
        'dir'     => 'docs/bulletins',
        'prefix'  => 'SIA Bulletin ',
        'class'   => 'bulletin',
        'header1' => 'Issue Num',
        'header2' => 'Issue Title',
    );
    return html_table_from_directory($atts);
}
add_shortcode('list_bulletins', 'list_bulletins');


function html_table_from_directory(&$atts)
{
    $html = '';
//    $html .= '<table><tr><td>'.$atts['dir'].'</td></tr><tr><td>'.$atts['prefix'].'</td></tr><tr><td>'.$atts['class'].'</td></tr></table>';

    $full_dir = '../suffolkny-aa.org/'.$atts['dir'];
    if (is_dir($full_dir) === false) {
        return $html .= sprintf('<br><br></br>ERROR! Bad directory : %s', $full_dir);
    }

    $all_files = scandir($full_dir);
    $files = array_filter($all_files, function($f) {
        return preg_match("/.*[_\-][0-9]+[_\-][0-9][0-9]\.*.*$/",$f);
    });
    arsort($files);
    //print_array($files);

    $rows = array();
    foreach($files as $file) {
        $f = preg_split("/[_\-\.]/",$file,0,PREG_SPLIT_NO_EMPTY);
        if ($f[2]<2000) $f[2]=$f[2]+2000; // make sure year is in the right range
        $d = date('F Y', mktime(0,0,0,$f[3],1,$f[2]));

        if (is_dir($atts['dir']."/".$file)) {
            $file = $file . '/index.html';
        }

        $a = sprintf('<a href="%s/%s/%s">%s %s</a>',$atts['root'],$atts['dir'],$file,$atts['prefix'],$d);
        $row = array (
            'year'  => $f[2], // year
            'month' => $f[3], // month
            'link'  => $a,
        );
        array_push($rows,$row);
//        $rows[] = sprintf('<a href="https:/%s/%s">%s %s</a>',$atts['dir'],$file,$atts['prefix'],$d);
    }

    array_multisort(array_column($rows, 'year'), SORT_DESC,
        array_column($rows, 'month'),      SORT_ASC,
        $rows);

    $html .= '<table class="' . $atts['class'] .'">';

    $year = 0;
    $index = 0;
    foreach($rows as $row) {
        if ($year<>$row['year']) {
            $year = $row['year'];
            $html .= '</table><table class="' . $atts['class'] .'">';
            $html .= sprintf("<tr class='%s-year'><td colspan='2'>%s</td></tr>",$atts['class'],$year);
            $html .= sprintf("<tr class='%s-header'><td class='%s-col-1'>%s</td><td class='%s-col-2'>%s</td></tr>"
                ,$atts['class'],$atts['class'],$atts['header1'],$atts['class'],$atts['header2']);
            $index = 0;
        }
        $row_class = ($index++ % 2) == 1 ? 'odd' : 'even';
        $html .= sprintf("<tr class='%s'><td class='%s-col-1'>%s.%s</td><td class='%s-col-2'>%s</td></tr>",
            $atts['class'].'-'.$row_class,$atts['class'],$row['year'],$row['month'],$atts['class'],$row['link']);
    }
    $html .= '</table>';
    return $html;
} // html_table_from_directory