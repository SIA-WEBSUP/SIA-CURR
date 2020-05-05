<?php

$online_mtgs = array( // Most groups have one URL for all meetings, some have both group level URL and meeting URLs
    // 'GROUPID'  => array("conf_URL",	NULL,"mtg_id", "pwd"), // GROUP NAME
    '37'  => array("//zoom.us/j/6052451111?pwd=c085c0o15V1RWWWlBNkFYTmNVUE93UT09",	"(929) 205-6099","605 245 1111", "428 950"), // BAY SHORE SUNRISE SOBRIETY
    '50'  => array("//us02web.zoom.us/j/89908618777?pwd=bTQ1V1BHdkp3WWt2MWppTytXL1ppUT09",	"(646) 876 9923 ","899 0861 8777", "162 994"), // BRENTWOOD GRATITUDE
    '67'  => array("//zoom.us/j/691630673         ","(646) 558-8656","691 630 673","850 366"), // SUNRISE SOBRIETY - 6:45AM
    '82'  => array("//zoom.us/j/6311431023        ","(631) 766-3661","631 143 1023", "Cutchogue"),     // CUTCHOGUE SUNDAY
    //'85'  => array("//us04web.zoom.us/j/742133476", NULL, NULL, NULL),                              // HOME FOR DINNER
    '104' => array("//nyintergroup.zoom.us/j/96853910721?pwd=L1R5bmFDdVoyUFM2Szh5dUZXZU10UT09","(929) 436-2866", "968 5391 0721", "521231"), // EYE OPENER
    '104.SU.0' => array("//nyintergroup.zoom.us/j/98293111250?pwd=N3orUFNBNFpSVjZiV1JTM0Y5TVNZZz09","(929) 436-2866", "982 9311 1250", "521231"), // EYE OPENER - MENS
    '104.SU.1' => array("//zoom.us/j/93088948413","(929) 436-2866", "930 8894 8413", "788615"), // EYE OPENER - WOMENS
    '126' => array("//nyintergroup.zoom.us/j/253179384", "(929) 436-2866", "253 179 384", "777"),      // HUNTINGTON STA NEW LIFE
    '157' => array("//zoom.us/j/851329515?pwd=STFwM1dOQUZUZXdrTlFZK1hIMDlnUT09","(646) 876-9923", "851 329 515", NULL), // DOING IT YOUNG
    '176' => array("//meet.google.com/gbi-rsmn-odo","(502) 430-2829","389 359 014", NULL), // NEIGHBORHOOD SOBRIETY
    '178' => array("//meet.google.com/nrp-ipeq-utg","(240) 397-5311","541 313 606",NULL),  // THE ONLY REQUIREMENT
    '230' => array("//zoom.us/j/9177565845", NULL, "917 756 5845", "767066"), // PORT JEFF INTO ACTION
    '240' => array("//zoom.us/j/4176066161?pwd=Z2Y3cnM4SjJ6dTVXN0RLUVllejJydz09","(417) 606-6161","417 606 6161","631 875 4849"), // REFLECTIONS '90
    '265' => array("//meet.google.com/vgb-qmdb-wxw","(540) 835-0174","364 022 227", NULL), // THE LITTLE RED SCHOOLHOUSE
    '266' => array("//meet.google.com/oop-cugb-edz","(858) 345-6725","612 896 653", NULL), // ST JAMES GROUP
    '267' => array(NULL,	                        "(605) 313-5315","266 443", NULL),     // ST JAMES SUNRISE REFLECTIONS
    '289' =>      array("//us02web.zoom.us/j/6312588292?pwd=WXF4d05ST0g1RUFtMU9LMnQxMW5mQT09", "(929) 205-6099", "631 258 8292", "665312"), // SMITHTOWN SERENITY
    '289.MN.0' => array("//us02web.zoom.us/j/7173450094", "(929) 205-6099", "717 345 0094", NULL), // SMITHTOWN SERENITY - MONDAY STEP
    '315' => array("//us04web.zoom.us/j/8727414086", NULL, NULL, "381 491"),               // WADING RIVER GROUP
    '375' => array("//zoom.us/join", NULL, "617 988 572","For Password please text\n\r  DeeAnn (631) 495-4912 or\n\r  Besty (631) 525-1828"), // A NEW BEGINNING (WOMEN"S GROUP)
    '437' => array("//zoom.us/join", NULL, "909 301 594","799 633"),                                   // THE ONE AND ONLY
    '463' => array("//meet.google.com/vkh-sgbs-mdd","(540) 835-0196","855 547 358", NULL), // BOHO
    '499' => array("//meet.google.com/dqe-eerp-zgv","(570) 554-0159","614 095 850", NULL), // SPIRITUAL CIRCLE
    '553' => array("//zoom.us/j/755341289?pwd",	    NULL, NULL, NULL),                     // AS BILL SEES IT
    '695' => array("//zoom.us/j/4458142615",NULL,"445 814 2615", "766 504"),               // YOUNG AT HEART IN ISLIP
    '698' => array("//meet.google.com/bpy-aijb-aqi","(301) 845-5176","836 521 984", NULL), // SIA HOSTED
    '699' => array("//meet.google.com/ikn-poem-eba","(978) 435-0386","470 509 931", NULL), // WOMEN'S BACK TO BASICS
    // Some meetings have different URLs per meeting
    '024.MN.0' => array("//stonybrook.zoom.us/j/477350958?pwd=K3FLd2IyMTRKaWVaUnNoYUdNV3N0dz09", NULL, NULL, NULL), // MIDDLE RD - Monday 06:45 PM - Beginners
    '024.MN.1' => array("//stonybrook.zoom.us/j/393171818?pwd=elFCTFBkSEUxZC9NK3pURUdsQ2YvQT09", NULL, NULL, NULL), // MIDDLE RD - Monday 08:00 PM - Step
    '024.TU.0' => array("//stonybrook.zoom.us/j/887653372?pwd=b1p3Tnp1QmZJd0M2ekNBQ2V6S1dtQT09", NULL, NULL, NULL), // MIDDLE RD - Tuesday 01:00 PM - Big Book
    '024.FR.0' => array("//stonybrook.zoom.us/j/101771471?pwd=QmdDUWxIamNMa2x0bHNXNVphYzNVdz09", NULL, NULL, NULL), // MIDDLE RD - Friday 06:45 PM - Young Peoples
    '024.FR.1' => array("//stonybrook.zoom.us/j/364409520?pwd=TFZNWXJqYzRLdm9vaGkxcjFKT2gxQT09", NULL, NULL, NULL), // MIDDLE RD - Friday 08:00 PM - Open Discussion
    '024.SA.0' => array("//stonybrook.zoom.us/j/272876168?pwd=bTVEd2ZKK0VkaW4xeXYxaUhWQ2xzUT09", NULL, NULL, NULL), // MIDDLE RD - Saturday 08:00 AM - As Bill Sees It
    '067.TU.1' => array("//zoom.us/j/369437303","(646) 558-8656","369 437 303", "039 778"), // SUNRISE SOBRIETY - 6:45AM
    '067.SA.1' => array("//zoom.us/j/678316314","(646) 558-8656","678 316 314", "003 597"), // SUNRISE SOBRIETY - 6:45AM
    '067.SU.1' => array("//zoom.us/j/202548779","(646) 558-8656","202 548 779", "889 048"), // SUNRISE SOBRIETY - 6:45AM
    '125.TU.0' => array("//meet.google.com/cyn-npse-mto","(347) 773-0220", "266 098 222", NULL), // GREENLAWN HUNTINGTON STATION
    '125.TH.0' => array("//meet.google.com/cyn-npse-mto","(347) 773-0220", "266 098 222", NULL), // GREENLAWN HUNTINGTON STATION
    '189.TU.0' => array("//zoom.us/j/852561412?pwd=dEttYmp6UXplYzVxUEF5YWttdUxaZz09", NULL, NULL, NULL), // LONGWOOD LOVE & SERVICE
    '189.TH.0' => array("//zoom.us/j/604011879?pwd=T2dsZy9IYlphQVlmUm1VSk5VMk5EUT09", NULL, NULL, NULL), // LONGWOOD LOVE & SERVICE
    '238.TU.1' => array("//meet.google.com/mmz-ovzq-xqj","(515) 882-0190", "543 939 006", NULL), // RIVERHEAD GROUP - BB
    '238.FR.0' => array("//meet.google.com/mmz-ovzq-xqj","(515) 882-0190", "543 939 006", NULL), // RIVERHEAD GROUP - BE
    '307.TH.0' => array("//meet.google.com/sps-xjqn-uiu","(614) 602-6125","848 749 635", NULL), // STONY BROOK UNITY GRP
    '422.FR.0' => array("//meet.google.com/wno-mhit-zmk","(402) 824-0258","705 336 354", NULL), // ROCKY POINT UNITY GRP
    '422.SA.0' => array("//meet.google.com/wno-mhit-zmk","(402) 824-0258","705 336 354", NULL), // ROCKY POINT UNITY GRP
    //'584.TH.0' => array("//meet.google.com/mpt-bxbd-syv","(573) 667-3257","961 358 515", NULL), // OPEN BOOKS
    //'049.SU.0' => array("//zoom.us/j/604823002", "(646) 558-8656","604 823 002", NULL), // LADIES GROUP - Sun CD
    //'049.WD.0' => array("//zoom.us/j/667893124", "(646) 558-8656","667 893 124", NULL), // LADIES GROUP - Wed Step

    // East End Meetings:
    '1'  => array("//zoom.us/j/812452820",	            NULL,"812 452 820", NULL),      // Ammagansett Sunday Beginners
    '2'  => array("//nyintergroup.zoom.us/j/6554056699", NULL,"655 405 6699", NULL),    // Ammagansett AM
    '3'  => array("//nyintergroup.zoom.us/j/992780763",	NULL,"992 780 763", "mensroom"),// Ammagansett The Mens Room
    '7'  => array("//zoom.us/j/479172809",	            NULL, "479 172 809", "916836"), // Ammagansett	ROUND ROBIN
    '500'  => array("//zoom.us/j/231147035",	        NULL,"231 147 035", "505622"),  // Ammagansett Happy Hour
    '56'  => array("//zoom.us/j/378504990",         	NULL,"378 504 990", "236746"),  // Bridgehampton Haygroup Keep It Simple
    '58'  => array("//nyintergroup.zoom.us/j/99572734568",	NULL,"995 7273 4568", "130529"), // Bridgehampton East End Young People
    '91'  => array("//zoom.us/j/7914635469",	        NULL,"791 463 5469", NULL),     // East Hampton Group
    '92'  => array("//zoom.us/j/8483284889",	        NULL,"848 328 4889", "bonac"),  // SPRINGS FIREPLACE GROUP
    '96'  => array("//zoom.us/j/625731737",	"(929) 436-2866","625 731 737", NULL),      // Sunday Step
    '97'  => array("//zoom.us/j/489358693",	                NULL,"489 358 693", "email the group at soberwomenseast@yahoo.com"), // Sober Woman's East
    '365'  => array("//zoom.us/j/279125585",	        NULL,"279 125 585", "KISS"),    // East Hampton Keep It Simple
    '418'  => array("//zoom.us/j/361007173",	        NULL,"361 007 173", "b2b001"),  // East Hampton Back to Basics
    '094.SA.0'  => array("//zoom.us/j/997866134",	    NULL,"997 866 134", "Green123"), // East Hampton Keep it Green
    '094.SU.0'  => array("//zoom.us/j/876167885",	    NULL,"876 167 885", "Green123"), // East Hampton Keep it Green
    '094.WD.0'  => array("//nyintergroup.zoom.us/j/94867360733",	NULL,"948 6736 0733", "Green123"), // East Hampton Keep it Green
    '392'  => array("//zoom.us/j/361007173",	        NULL,"995 319 793", "#girlsrule"), // Hampton Bays Women's Group
    '433'  => array("//zoom.us/join",	                NULL,"483 772 9818", "980165"),  // Hampton Bays	Spiritual Awakening West - 11th Step Meditation Mtg
    '573.SU.1'  => array("//zoom.us/j/207160635",	        NULL,"207 160 635", "sobriety#1"), // Hampton Bays Hampton Bay Sunday Night Group
    '192'  => array("//nyintergroup.zoom.us/j/889817053",	NULL,"889 817 053", "MTK1212"), // Montauk Montauk Group
    '190.SA.0'  => array("//zoom.us/j/532272602",	"(929) 436-2866 Access #: 556423","532 272 602", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.TH.0'  => array("//zoom.us/j/377870869",	"(929) 436-2866 Access #: 240613","377 870 869", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.TU.0'  => array("//zoom.us/j/116733466",	"(929) 436-2866 Access #: 370982","116 733 466", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.WD.0'  => array("//zoom.us/j/115649907",	"(929) 436-2866 Access #: 692971","115 649 907", "Wilson1212"), // Montauk The Smith-Wilson Group
    '580'  => array("//zoom.us/j/845720420",	        NULL,"845 720 420", "#geekinout"), // Riverhead Back to Books
    '262'  => array(NULL, "(515) 604-9094","790 452 210", NULL),                        // Sag Harbor Spiritual Solution
    '301'  => array("//zoom.us/j/175307047",	"(646) 568-7788","175 307 047", NULL),  // Southampton Friday Night Group (Our Lady of Poland)
    '346'  => array("//zoom.us/j/6312831935",	        NULL,"631 283 1935", NULL),     // Southampton First Things First
    '317.MN.0'  => array("//nyintergroup.zoom.us/j/553131814",	"929 436 2866 Access #: 860059","553 131 814", "letmein"), // Wainscott	Lincoln & Lee
    '317.WD.0'  => array("//nyintergroup.zoom.us/j/553131814",	"929 436 2866 Access #: 860059","553 131 814", "letmein"), // Wainscott	Lincoln & Lee
    '378'  => array("//zoom.us/j/175307047",            NULL,"175 307 047", NULL),      // Wainscott MIRACLES HAPPEN
    '439'  => array("//zoom.us/j/697601579",            NULL,"697 601 579", NULL),      // Water Mill WATER MILL SUNDAY NIGHT BEGINNER'S
);



function online_meeting_info($group_id, $meeting_id)
{
    $notes = NULL;
    $URL = NULL;
    $phone = NULL;
    $access_num = NULL;
    $mtgID = NULL;
    $pwd = NULL;

    $conference_info = NULL;
    $access_num = NULL;
    $conference_notes = NULL;

    // meeting_id entry takes precedence over group_id;
    if (array_key_exists($meeting_id,$online_mtgs)) {
        $conference_info = $online_mtgs[$meeting_id];
    } else if (array_key_exists($group_id,$online_mtgs)) {
        $conference_info = $online_mtgs[$group_id];
    }

    if ($conference_info) {
        $URL =  $conference_info[0] ? "https:" . $conference_info[0]  : NULL;
        $phone =  $conference_info[1];
        $mtgID = $conference_info[2];
        $pwd = $conference_info[3];

        // append mtgID to meeting notes
        if ($mtgID && strpos($URL, "zoom.")) {
            // Display the ZOOM meeting ID for ALL ZOOM meetings to handle
            // the rare case where the group doesn't want a direct link to meeting
            // TODO: remove this now that meeting finder supports connect via zoom button
            $notes .= "ZOOM Meeting ID: " . $mtgID . "\n\r\n\r";

            // append PWD if it exists
            if ($pwd) {
                if (strpos(strtoupper($pwd), "PASSWORD")==false) {
                    $notes .= "PWD: "; // if password isn't spelled out, prepend "PWD:"
                }
                $notes .= $pwd . "\n\r\n\r";
            }
        }
        // append phone number to meeting notes
        if ($phone) {
            $access_num = strpos($phone, "Access #:");
            if ($access_num) {
                // grab access pin if it exists
                // when access number exists, use it in pace of pwd in phone$
                $t = substr($phone, 0, $access_num-1);
                $access_num = substr($phone, $access_num+strlen("Access #:"), strlen($phone)-1);
                $phone = $t;
            }
            $notes .= "To join by phone dial:\n\r  ". $phone;
            if ($mtgID)
                $notes .= " PIN: " . $mtgID .  "#";
            $notes .= "\n\r\n\r";

            // encode phone with meeting ID and password for one tap number
            // should look like +12125551212,,123456789#,,#,,444444#
            $phone = "+1" . $phone . ",," . $mtgID . "#";
            if ($access_num) {
                $phone .= ",,#,," . $access_num . "#"; // append access no if it exists
            } else if ($pwd){
                $phone .= ",,#,," . $pwd . "#"; // append pwd if necessary
            }
            $phone = str_replace(array('(', ')','-',' '), '', $phone); //strip unnecessary chars
        }

        // append acces_num to meeting notes
        if ($access_num) {
            $notes .= " ACCESS#: " . $access_num .  "#";
        } else if ($pwd) {
            $notes .= " PWD: " . $pwd .  "#";
        }
    }
    return array('notes' => $notes, 'conference_url'=>$URL, 'conference_phone'=>$phone)
}
