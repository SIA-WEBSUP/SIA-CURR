<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'page-builder-framework' for SIA WP Theme
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

include('custom-shortcodes.php');

/*
function php_execute($html){
    if(strpos($html,"<"."?php")!==false){ 
        ob_start();
        eval("?".">".$html);
        //eval($html."?".">");
        $html=ob_get_contents();
        ob_end_clean();
        }
    return $html;
}
add_filter('widget_text','php_execute',100);
*/

/* Custom Function for TSML Plugin */

if (function_exists('tsml_custom_flags')) {
    tsml_custom_flags(array('M', 'W', 'ONL', 'BE', 'ST', 'B', 'A', 'MED', 'Y',
        'TR', 'LGBTQ', 'GV', 'LS', 'DR', 'LIT', // do we really want these?
        'TC', 'UNK', 'HY',
	    'O','S','SP',));
}

if (function_exists('tsml_custom_types')) {
    tsml_custom_types(array(
        //'UNK' => 'COVID Reopen Status Unknown',
        //'ROPN' => 'COVID Reopen Confirmed',
        'HY' => 'Hybrid',
        'BE' => 'Beginners',
        'TPC' => 'Topic',
        'LGBTQ' => 'LGBTQ+'
    ));
}


if (function_exists('tsml_custom_types')) {
    tsml_custom_addresses(array(
        '5 Avenue Anatole France, 75007 Paris, France' => array(
            'formatted_address' => '5 Avenue Anatole France, 75007 Paris, France',
            'city' => 'Paris',
            'latitude' => 48.858372,
            'l75007ongitude' => 2.294481,
        ),
        '625 Belmont Ave, 11703, USA' => array(
	        'formatted_address' => 'Belmont Lake State Park',
	        'city' => 'North Babylon',
	        'latitude' => 40.737415,
	        'longitude' => -73.337733,
        ),
        'Pond Ln, Southampton, NY 11968, USA' => array(
            'formatted_address' => 'Monument at Agawam Park',
            'city' => 'Southampton',
            'latitude' => 40.881939,
            'longitude' => -72.392385,
        ),
        ));
}
