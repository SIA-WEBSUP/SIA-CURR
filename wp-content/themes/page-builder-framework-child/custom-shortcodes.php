<?php

function get_formatted_date_function($atts = array()) {

	// set up default parameters
	$atts = shortcode_atts(array(
		'date' => 'today',
		'time' => '',
		'format' => 'D, M jS @ gA'
	), $atts);

	// add placeholder for supscripting ordinal suffixes
	$atts['format'] = str_replace('S','{S}',$atts['format']);

	$d = strtotime($atts['date'] . $atts['time']);
	if ($d){
		if ($d < time()) {
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