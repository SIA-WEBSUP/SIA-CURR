<?php

$atts = array (
    'root'    => isset($_GET['dir']) ? $_GET['dir'] : 'https://suffolkny-aa.org',
    'dir'     => isset($_GET['dir']) ? $_GET['dir'] : 'docs/bulletins',
    'prefix'  => isset($_GET['dir']) ? $_GET['dir'] : 'SIA Bulletin ',
    'class'   => isset($_GET['dir']) ? $_GET['dir'] : 'bulletin',
    'header1' => isset($_GET['dir']) ? $_GET['dir'] : 'HEADER 1',
    'header2' => isset($_GET['dir']) ? $_GET['dir'] : 'HEADER 2',
);

echo list_directory($atts);

function print_array($array)
{
    echo "<pre>";
    print_r($array);
    echo "<pre/>";
}

function list_directory(&$atts)
{
    $html = '';
//    $html .= '<table><tr><td>'.$atts['dir'].'</td></tr><tr><td>'.$atts['prefix'].'</td></tr><tr><td>'.$atts['class'].'</td></tr></table>';

    if (is_dir($atts['dir']) === false) {
        return $html .= sprintf('<br><br></br>ERROR! Bad directory : %s', $atts['dir']);
    }

    $all_files = scandir($atts['dir']);
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
}