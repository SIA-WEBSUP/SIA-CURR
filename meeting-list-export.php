<?php
$format= isset($_GET['format']) ? $_GET['format'] : 'html';
$download= isset($_GET['download']);

switch ($_GET['county']) {
    case 'suffolk' :
        $file = 'https://suffolkny-aa.org/wp-admin/admin-ajax.php?action=meetings&key=157b22d8b2f797a7dcc8d4ae6aeb55cd';
        break;
    case 'nassau' :
        $file = 'https://nassauaa.org/wp-admin/admin-ajax.php?action=meetings&key=b0c9aabf228cc07c1c60884ae915c8e3';
        break;
    case 'queens' :
        $file = 'https://www.queensaa.org/wp-admin/admin-ajax.php?action=meetings';
        break;
    case 'brooklyn' :
        $file = 'https://brooklynintergroup.org/brooklyn/wp-admin/admin-ajax.php?action=meetings&key=fb04b40a559571c96147ec5a630f0b30';
        break;
    default :
        echo 'Unsupported county';
        exit(0);
}

//header('Content-type: application/html; charset=utf-8');

//$headers = ['id','name','slug','notes','updated','location_id','url',
//            'day','time','time_formatted','conference_url','types',
//            'location','location_notes','location_url','formatted_address',
//            'approximate','latitude','longitude','region_id',
//            'region','group_id','group','district','district_id',
//            'last_contact','contact_1_name','contact_1_email','contact_1_phone',
//            'contact_2_name','contact_2_email','contact_3_name','contact_3_email',
//            'attendance_option'];


$headers = ['id','attendance_option',
            'name','slug','notes',
            'day','time','types',
            'location', 'location_notes', 'formatted_address',
            'region','group','district',
            'url','location_url','conference_url',
            'last_contact','updated'];

$meetings = file_get_contents($file);
$meetings = json_decode($meetings, true);

//$meetings = array_intersect_key($meetings, array_flip($headers));

if ($format == 'html') {
    echo '<div>';
    echo '<table style=\"width:100%\"><tr>';

    foreach ($headers as $heading) {
        printf('<th>[%s]</th>', $heading);
    }
    echo '</tr><tr>';
    foreach($meetings as $meeting) {
        foreach($headers as $key) {
            $value = $meeting[$key];
            if ($value && $key == 'types') {
                $value = implode(',',$value);
            }
            printf('<td>%s</td>', $value);
        }
        echo '</tr><tr>';
    }

    echo '</table></div>';
} else {

    if ($download)
    {
        $filename = 'meeting-list-' . date('Ymd') .'_' . date('His');
        // Output CSV-specific headers
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment;filename=\"$filename.csv\";" );
        //header("Content-Transfer-Encoding: binary");
    }

    $buffer = fopen('php://output', 'W');
    //$buffer = fopen('php://memory', 'w');

    $h2=array();
    foreach($headers as $header){$h2[]='['.$header.']';}
    //array_walk($headers,function($v) use($h2) {$h2[]='['.$v.']';});
    fputcsv($buffer, $h2);

    $row = array();
    foreach($meetings as $meeting) {
        foreach($headers as $key) {
            $value = $meeting[$key];
            if ($value && $key == 'types') {
                $value = implode(',',$value);
            }
            $row[$key] = $value;
        }
        fputcsv($buffer, $row);
    }

    //rewind($buffer);
    $csv = fgets($buffer);
    fclose($buffer);

    if ($fdownload) {
        fpassthru($csv);
    } else {
        echo $csv;
    }
}

