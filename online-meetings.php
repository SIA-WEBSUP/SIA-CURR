<?php

$online_mtgs = array( // Most groups have one URL for all meetings, some have both group level URL and meeting URLs
    // 'GROUPID'  => array("conf_URL","conf_telephone","mtg_id", "pwd"), // GROUP NAME
    '12'  => array("//us04web.zoom.us/j/284511426?pwd=OW01N1gxMHR2OE5LV1FCc2VQemJ1dz09"   , NULL, NULL, NULL),  // MASSAPEQUA AT AMITYVILLE BOTTOM LINE GROUP
    '20'  => array("//us02web.zoom.us/j/86070647539?pwd=M1lzbjhYTDZOMnRpRVpPK1pYSlFEUT09"  , NULL, "860 7064 7539", "bridge"),  // BABYLON BRIDGE TO SOBRIETY
    '28'  => array("//us02web.zoom.us/j/81839874568?pwd=YlRjeVBObk04eit0dkZrcDlSUzBHdz09", NULL, "818 3987 4568", "stlukes"),   // 12 STEPS OF HOPE
    '37'  => array("//zoom.us/j/6052451111?pwd=UmpvbWJEcHhzbFpzckNnRGJLVjRuUT09", "(929) 205-6099 Passcode: 2043231","605 245 1111", "Sunrise"), // BAY SHORE SUNRISE SOBRIETY
    '40'  => array("//us02web.zoom.us/j/364969933?pwd=RUUzbW9nWWJtU2dJMFRxcmJETVpvQT09"  ,"(929) 205-6099", "364 969 933", "422921"),   // BELLPORT GROUP
    '49'  => array("//zoom.us/j/4925480677" ,"(646) 558-8656", "492 548 0677", NULL),      // BRENTWOOD LADIES GROUP
    '60'  => array("//us02web.zoom.us/j/214128575?pwd=ZlBoZU9RQm83aUUvQUQzRFJmVUNnUT09", "(929) 205-6099", "214 128 575", "05856123"), // BROOKHAVEN WOMEN'S GROUP
    '61'  => array("//zoom.us/j/482418696" , NULL, "482 418 696", "406883"),               // BROOKHAVEN HAPPY HOUR
    '061.WD.00'  => array("//zoom.us/j/571032502" , NULL, "571032502", "951700"),          // BROOKHAVEN HAPPY HOUR WED BEG
    '64'  => array("//zoom.us/j/92333840941?pwd=Y0liOWNzZ0ZTQ29IT3kyVXR2eHgvZz09", NULL, NULL, NULL), // CENTEREACH GROUP
    '69'  => array("//zoom.us/j/316148225", NULL, "316 148 225", "157363"),                // CENTEPORT NOON GROUP
    '82'  => array("//zoom.us/j/6311431023" ,"(631) 766-3661", "631 143 1023", "Cutchogue"), // CUTCHOGUE SUNDAY
//    '83'  => array("//zoom.us/j/94672171612?pwd=Y3owSW9Iaks2dHVZbTNDSk16RmQ4dz09", "(929) 205-6099", "946 7217 1612", "cutchogue"), // CUTCHOGUE STEP GROUP
    '85'  => array("//zoom.us/j/86589024896"  , NULL, "865 8902 4896", "438051"),          // HOME FOR DINNER
    '88'  => array("//zoom.us/j/4234489821?pwd=eTlJRHpWa2tJNUVjS0gzRFArNlovQT09", NULL, "423 448 9821", "21212"), // DIX HILLS SUNDAY SOBRIETY
    '92'  => array("//zoom.us/j/97702600345?pwd=MTJneE1OSG1CVE9mWFFaMFJ2L2lkQT09", "(929) 436-2866", "977 0260 0345", "bonac"), // SPRINGS FIREPLACE GROUP
    '105' => array(NULL ,"(712) 432-7900 Passcode: 793461", NULL, NULL),                   // E NORTHPORT BIG BOOK GROUP
    '107' => array("//zoom.us/j/609004671"  ,"(929) 205-6099", "609 004 671", NULL),       // VALLEY 8 O'CLOCK
    '108' => array("//us02web.zoom.us/j/93791458968?pwd=SXI4cUpNYUZBVUJhenR2cTVHalhldz09", "(929) 436-2866 Passcode: 81153151", "937 9145 8968", "Cedar164"), // EAST NORTHPORT SERENITY
    '121' => array("//us02web.zoom.us/j/81839410326?pwd=RUd5YjdNMUFxZzRPQ2twaFRmWWxYZz09", NULL, "818 3941 0326", "164164"), // FORT SALONGA WORKSHOP
    '143' => array("//zoom.us/j/84592881281", NULL,"845 9288 1281", NULL),                 // HOLBROOK LOVE N' SHARE
    '126' => array("//zoom.us/j/253179384?pwd=MUlYaGVQZ2lLczcvd1FnWFVRTWkyUT09", "(929) 436-2866", "253 179 384", "777"),    // HUNTINGTON STA NEW LIFE
    '142' => array("//zoom.us/j/7354181748?pwd=KzNvWnkwSXlPVGI0T01lL3JJOUFHUT09" , NULL, "735 418 1748", "HAUPPAUGE"), // TOUCHSTONES GROUP
    '145' => array("//zoom.us/j/5922356616", NULL, "592 2356 616", NULL),                  // HUNTINGTON GROUP
    '152' => array("//zoom.us/j/99621492360?pwd=cytGbFZmVjRNUjYySlFHVnBwdmNTUT09" , "(929) 436-2866", "996 2149 2360", "letmein"), // MELVILLE HIGH NOON
    '157' => array("//zoom.us/j/851329515?pwd=STFwM1dOQUZUZXdrTlFZK1hIMDlnUT09","(646) 876-9923", "851 329 515", "DIY"), // DOING IT YOUNG
    '160' => array("//zoom.us/j/9664942327", NULL, "966 494 2327", NULL),                  // ISLIP TERRACE GROUP
    '165' => array("//zoom.us/j/928611989", NULL, "928 611 989", "729964"),                // KINGS PARK GROUP
    '168' => array("//zoom.us/j/85068453181","(646) 558-8656 Passcode: 535388", "850 6845 3181", "asolution"), // LAKE RONKONKOMA GROUP
    '172' => array("//zoom.us/j/318848962", NULL, "318 848 962", "freedom"),               // LINDENHURST FREEDOM GROUP
    '173' => array("//us02web.zoom.us/j/699580490?pwd=YWwwUURkVTlENkl5ejBRc3NtbkZ0UT09"  , NULL, "699 580 490", "014700"), // LINDENHURST GROUP
    '176' => array("//meet.google.com/gbi-rsmn-odo","(502) 430-2829","389 359 014", NULL), // NEIGHBORHOOD SOBRIETY
    '178' => array("//us02web.zoom.us/j/4614019987?pwd=VnhYaEQwenBIOVhibGd6akwrcjIyQT09","(929) 205-6099 Passcode: 59241764","461 401 9987","SERENITY"),  // THE ONLY REQUIREMENT
    '188' => array("//zoom.us/j/3503026373", NULL, "350 302 6373", "688768"),              // MEDFORD STEPS TO LIFE
    '185' => array("//us02web.zoom.us/j/6819531957?pwd=MTBlalRTVGNRN3lvaGEwS1FZNnVldz09", NULL, "681 953 1957", "800330"),   // MELVILLE GROUP
    '198' => array("//zoom.us/j/4666501565?pwd=V1FuTFJnMG1tcmVVdmxyaDhZbHNpdz09", "(929) 205-6099", "466 650 1565","595631"),// NORTH BABYLON JUST FOR TODAY
    '204' => array("//zoom.us/j/98973931417", "(929) 205-6099", "989 7393 1417","532292"), // NORTHPORT TRINITY GROUP
    '215' => array("//us02web.zoom.us/j/6913867484?pwd=Q1FGRTZCenM4OVJhR0o3bWwzcCs5UT09", "(646) 876 9923", "691 386 7484", "350155"), // PATCHOGUE GROUP
    '218' => array(NULL, "(978) 990-5000 Access Code: 817 579", NULL, NULL),               // PATCHOGUE MORNING GROUP
    '224' => array("//zoom.us/j/82893053985", NULL, "828 9305 3985", "522423"),            // PORT JEFF BIG BOOK
    '228' => array("//zoom.us/j/5274153100", NULL, "527 415 3100", NULL),                  // PORT JEFF SOBRIETY FIRST
    '230' => array("//us02web.zoom.us/j/9177565845?pwd=MDBGQnNDdDhIazZrRURTWnkwaWJodz09", NULL, "917 756 5845", "767066"),              // PORT JEFF INTO ACTION
    '235' => array("//zoom.us/j/230755324", NULL, "230 755 324", "097235"),                // WESTHAMPTON MEN'S TELL IT LIKE IT IS
    '237'      => array("//zoom.us/j/699794136?pwd=cktiMmxXT3RpV2phZ3E2VXdPWmxCZz09", "(929) 436-2866", "699 794 136", "809363"), // REMSENBURG BASIC SOBRIETY
    '237.WD.0' => array("//zoom.us/j/409580451?pwd=Vk1OZXFuOEpRUVFxY01heHpoMTY3UT09", "(929) 436-2866", "409 580 451", "497252"), // REMSENBURG BASIC SOBRIETY
    '239' => array("//zoom.us/j/3572366731?pwd=amlwY1RQdjlsUHFZUDFZeVk3SFowUT09", NULL, "357 236 6731", "1234"), // AQUEBOGUE FREEDOM GROUP
    '240' => array("//zoom.us/j/4176066161?pwd=Z2Y3cnM4SjJ6dTVXN0RLUVllejJydz09","(646) 558 8656 ","417 606 6161","6318754849"), // REFLECTIONS '90
    '248' => array("//zoom.us/j/829531250","(646) 558 8656","829 531 250","150362"),       // ROCKY POINT SERENITY AT SHOREHAM
    '252' => array("//us04web.zoom.us/j/181483609?pwd=Z3FvZEMrejhZRUtmWXpNU3JIWFhOdz09", NULL, NULL, NULL), // RONKONKOMA BREAKFAST CLUB
    '265' => array("//meet.google.com/vgb-qmdb-wxw","(540) 835-0174","364 002 227", NULL), // THE LITTLE RED SCHOOLHOUSE
    '266' => array("//meet.google.com/oop-cugb-edz","(858) 345-6725","612 896 653", NULL), // ST JAMES GROUP
    '267' => array(NULL, "(605) 313-5315 Access Code: 266443#", NULL, NULL),               // ST JAMES SUNRISE REFLECTIONS
    '278' => array("//us02web.zoom.us/j/85230470449", "(646) 558 8656", "852 3047 0449",NULL), // SHELTER ISLAND GROUP
    '279' => array("//us02web.zoom.us/j/5205564408",  "(646) 558 8656", "520 556 4408", NULL), // SHELTER ISLAND NEW BEGINNINGS
    '280' => array(NULL, "(978) 990-5000 Access Code: 891 721", NULL, NULL),               // SHELTER ISLAND KEEP IT SIMPLE
    '285' => array("//zoom.us/j/380514478", "(929) 436 2866", "380 514 478", "918048"),    // SOBRIETY UNLIMITED
    '286' => array("//zoom.us/j/9134002353", NULL, "913 400 2353", "Smithtown1"),          // SMITHTOWN AFTERNOON GROUP
    '287' => array("//us02web.zoom.us/j/5973540591?pwd=dS9sZnp2ZXRuMHlubnlFUFNBWkplQT09", NULL, "597 354 0591", "hope364"),      // SMITHTOWN GROUP
    '289' => array("//zoom.us/j/4313933180?pwd=aU1lS2lXbXlNcUprZW5TdVN0T0Z1dz09", "(929) 436-2866 Passcode: 88959231", "431 393 3180", "serenity"), // SMITHTOWN SERENITY
    '315' => array("//us02web.zoom.us/j/8727414086?pwd=SmtrT0Q2NzBWYW1xZFdESXJ1K0dMUT09", NULL, "872 741 4086", "381491"), // WADING RIVER GROUP
    '316' => array("//zoom.us/j/4427989869?pwd=dEw4eG1FUnFHbVFHczVBZ1lCVmpaZz09a", "(929) 205-6099 Passcode: 543559", "442 798 9869", "BillW"), // 11th STEP MEDITATION WORKSHOP
    '324' => array("//us02web.zoom.us/j/173718981?pwd=eDg1NDRmOXJ0WkdPVmdRWFJpcTBUdz09", NULL, "173 718 981", "088492"),       // WEST ISLIP GOOD SOBRIETY
    '331' => array("//us02web.zoom.us/j/428908754", NULL, "428 908 754", "girls@whb"),     // WESTHAMPTON WOMEN'S DISCUSSION
    '351' => array("//us02web.zoom.us/j/86239050147?pwd=NmhOSkxLbXdMYlVYV1BDclhSOG50dz09", "(646) 558-8656", "862 3905 0147","502128"), // SOUTHAMPTON MONDAY CLOSED DISCUSSION GROUP
    '356' => array("//zoom.us/j/299922586", NULL, "299 922 586", "Home"),                  // MATTITUCK MEN'S GROUP
    '366' => array("//zoom.us/j/2888620729", NULL, "288 862 0729", "main"),                // NORTHPORT COW HARBOR
    '375' => array("//zoom.us/join", NULL, "617 988 572","For Password please text\n\r  DeeAnn (631) 495-4912 or\n\r  Besty (631) 525-1828"), // A NEW BEGINNING (WOMEN"S GROUP)
    '395' => array("//zoom.us/j/9014766046", NULL, "901 476 6046", "45196aa"),             // MANORVILLE SOUTH STREET SOBRIETY
//    '417' => array("//meet.google.com/zrf-ugcr-tfx", NULL, NULL, NULL),                    // BAY SHORE FREETHINKERS
    '425' => array("//zoom.us/j/81599541140", NULL, "815 9954 1140","Godcalling"),         // GOD CALLING
    '437' => array("//us02web.zoom.us/j/909301594?pwd=U1c1eU9WQzhFUjVXb3hPYmM0VGh6QT09", NULL, "909 301 594","799633"), // THE ONE AND ONLY
    '447' => array("//zoom.us/j/2596701737", NULL, "259 670 1737","silkworth"),            // 10 AM GROUP
    '495' => array("//zoom.us/j/201969569", NULL, "201 969 569","164164"),                 // COMMACK NEW SOIL
    '499' => array("//meet.google.com/dqe-eerp-zgv","(570) 554-0159","614 095 850", NULL), // SPIRITUAL CIRCLE
    '526' => array("//us02web.zoom.us/j/88919781896?pwd=cGdqS3hDV2wxODJiSnA2QlFQcGNjQT09","(929) 205-6099","889 1978 1896", "504797"), // SAT EVE LIVING WITH SOBRIETY
    '530' => array("//us02web.zoom.us/j/84350888563?pwd=MGZnaGNiYnEvQVRCT2RLZXdtVC8vdz09","(929) 436-2866","843 5088 8563", "297082"), // STONY BROOK FREETHINKERS
    '535' => array("//zoom.us/j", NULL, NULL, NULL), // FISHER ISLAND
    '538' => array("//us02web.zoom.us/j/3238843983?pwd=Y0c2V21LUnVQTkRTOUM1U3lPWGNvQT09", NULL, "323 884 3983", "592340"), // SELDEN ONE DAY AT A TIME
    '551' => array("//us02web.zoom.us/j/83782979137?pwd=dXpvZjJxdEZobENnaEtSUjFxMk9ZZz09", "(929) 205-6099", "837 8297 9137", "403409 "), // SAYVILLE SUNLIGHT OF THE SPIRIT
    '581' => array("//zoom.us/j/504706298", "(929) 205-6099", "504 706 298", NULL),        // FREEDOM FROM FEAR
    '572' => array("//zoom.us/j/2830231736", NULL, "283 023 1736", "253666"),              // HUNTINGTON STA WE CAN RECOVER
    '601' => array("//zoom.us/j/92838849973", NULL, "928 3884 9973", "164"),               // CONNECT THE DOTS
    '601.SA.OO' =>array("//zoom.us/j/99440850855?pwd=S0UxeUlPVG5DRkV6VUtTNzBzaFZrUT09", NULL, "994 4085 0855", "164"),  // CONNECT THE DOTS
    '606' => array("//zoom.us/j/98067219186",NULL,"980 6721 9186", "Serenity"), // PORT JEFF TRUE FRIENDS WOMENS
//    '695' => array("//zoom.us/j/4458142615",NULL,"445 814 2615", "766504"),                // YOUNG AT HEART IN ISLIP
    '698' => array("//meet.google.com/bpy-aijb-aqi","(301) 845-5176","836 521 984", NULL), // SIA HOSTED
    '699' => array("//meet.google.com/ikn-poem-eba","(978) 435-0386","470 509 931", NULL), // WOMEN'S BACK TO BASICS
    '701' => array("//us02web.zoom.us/j/661443978?pwd=TDZMV2xkMjZuOUNDYkFpVnVBK2l3Zz09", "(646) 558-8656 Passcode: 356622327","661 443 978", "spiritual"), // THE SOLUTIONS GROUP ONLINE
//    '702' => array("//zoom.us/j/500561044", NULL,"500 561 044", "12steps"),                // SUFFOLK ONLINE
    '704' => array("//zoom.us/j/96853910721?pwd=L1R5bmFDdVoyUFM2Szh5dUZXZU10UT09","(929) 436-2866","968 5391 0721","521231"), // EYE OPENER
    '704.SU.00' => array("//zoom.us/j/98293111250?pwd=N3orUFNBNFpSVjZiV1JTM0Y5TVNZZz09","(929) 436-2866", "982 9311 1250", "521231"), // EYE OPENER - MENS
    '704.SU.01' => array("//zoom.us/j/94537387870?pwd=TWhvbjcxTzJzM2VhakQ2bEIydmFqZz09","(929) 436-2866", "945 3738 7870", "788615"), // EYE OPENER - WOMENS
    '705'      => array("//zoom.us/j/691630673","(646) 558-8656","691 630 673", "850366"), // CENTER MORICHES SUNRISE SOBRIETY -
    '710' => array("//zoom.us/j/99111309723?pwd=dXlHcUU1SEIya0pjSEV5NVU3NVJadz09","(929) 436-2866 ","991 1130 9723", "0188"), // A MOMENT OF CLARITY
    '717' => array("//zoom.us/j/9224960248" ,"(929) 205-6099", "922 496 0248", NULL),      // DEER PARK ZOOM INTO ACTION
    '720' => array("//us02web.zoom.us/j/84653368848?pwd=aGoxbnFETngwT2ZFVWZiVmlLMThCZz09", "(929) 205-6099", "846 5336 8848", "893172"), // PATCHOGUE WOMEN IN RECOVERY
    '725' => array("//us02web.zoom.us/j/89098266160?pwd=NkhZWjM3UjNHdHE4QUFscUM1NTR3Zz09", "(929) 205-6099", "890 9826 6160", "538517"), // PORT JEFF WELCOME AS YOU ARE
    '726' => array("//us02web.zoom.us/j/817779951?pwd=byt3dHJrQ2UzMnFnTU1ZbVFWbkNtdz09", "(646) 558-8656", "817 779 951", "11782"), // CHERRY GROVE OFF-ISLAND GROUP (LGBTQ+)
    '728' => array("//us02web.zoom.us/j/2095091328", NULL, "209 509 1328", "sober2"),      // OUR COMMON JOURNEY
    '729' => array("//us02web.zoom.us/j/2387900906?pwd=V1Fhbm1sYVBQdzVCM1E5amVpZ0E1UT09", NULL, "238 7900 906", "e-mail GRAPEVINESTORYHOUR@gmail.com for Password"), // GRAPEVINE STORY HOUR
    '730' => array("//zoom.us/j/95532435350", "(929) 205-6099", "955 3243 5350", "777"),   // HUNTINGTON STA LIVING SOBER
    '732' => array("//zoom.us/j/5011015434", "(646) 876-9923", "501 101 5434", "448049"), // MELVILLE EARLY BIRD REFLECTIONS
    '733' => array("//zoom.us/j/83225774908?pwd=Y3NjVitPdXpEd3ZPUHo4Sm1POEJodz09", NULL, "832 2577 4908", "PICKLES"),            // DIX HILLS ALIVE AGAIN
    '734' => array("//zoom.us/j/5011015434?pwd=ZWJJVUZNc0RIaW53bVcvQVNUNTFiQT09", "(646) 876-9923", "501 101 5434", "448049"),  // MELVILLE EARLY BIRD REFLECTIONS
    '736' => array("//zoom.us/j/98973931417?pwd=RFc1YlRoT0cwUGxXMHB6VWF6ZGlRQT09", NULL, "989 7393 1417", "532292"), // WE STAY SOBER TOGETHER
    '737' => array(NULL, "(978) 990-5000", "817579", NULL),                                // MEDFORD RULE 62

    // Some meetings have different URLs per meeting
    '024.MN.00' => array("//us02web.zoom.us/j/86978146496?pwd=N2ppWFVzWndFcjZYSE5CMlVKK0Jidz09", NULL, "869 7814 6496", "456143"), // MIDDLE RD - Monday 06:45 PM - Beginners
    '024.MN.01' => array("//us02web.zoom.us/j/82701536190?pwd=RTlidzcwVHB2MU9TaWNvQjlUK29oQT09", NULL, "827 0153 6190", "414151"), // MIDDLE RD - Monday 08:00 PM - Step
    '024.TU.00' => array("//us02web.zoom.us/j/82122611427?pwd=MTR5OW0yZlR3ZEUwRE5xd1lSWmkwdz09", NULL, "821 2261 1427", "504987"), // MIDDLE RD - Tuesday 01:00 PM - Big Book
    '024.FR.00' => array("//us02web.zoom.us/j/76390266462?pwd=SmtWOTBUN2NJVnNCaFBZQUFkK05CUT09", NULL, "763 9026 6462", "790124"), // MIDDLE RD - Friday 06:45 PM - Young Peoples
    '024.FR.01' => array("//us02web.zoom.us/j/85739902972?pwd=SnB5VFVVVGtjR1g2NFV0YVU3QmYwUT09", NULL, "857 3990 2972", "947275"), // MIDDLE RD - Friday 08:00 PM - Open Discussion
    '074.TU.00' => array("//zoom.us/j/989277427?pwd=TDkyNktpdUtycC9aMkt4L1ZYVm1XQT09", NULL, "989 277 427", "154332"),     // COLD SPRING HARBOR GROUP
    '074.WD.00' => array("//zoom.us/j/85268084017?pwd=bGFickxMZEN3UGlQS3hydFFqSHJwQT09", NULL, "852 6808 4017", "803083"), // COLD SPRING HARBOR GROUP
    '074.FR.00' => array("//zoom.us/j/923882817?pwd=SUgzSXYwVTRvUXZEODg0RnVtTkZBdz09", NULL, "923 882 817", "673790"),     // COLD SPRING HARBOR GROUP
    '070.MN.01' => array("//zoom.us/j/897671585", NULL,"897 671 585", "123456"),        // CENTERPORT UNITY AT GREENLAWN
    '070.TH.00' => array("//zoom.us/j/145730967", NULL,"145 730 967", "123456"),        // CENTERPORT UNITY AT GREENLAWN
    '070.SA.00' => array("//zoom.us/j/696332623", NULL,"696 332 623", "123456"),        // CENTERPORT UNITY AT GREENLAWN
//    '125.TU.01' => array("//meet.google.com/cyn-npse-mto","(347) 773-0220", "266 098 222", NULL), // GREENLAWN HUNTINGTON STATION
    '125.TH.00' => array("//meet.google.com/cyn-npse-mto","(347) 773-0220", "266 098 222", NULL), // GREENLAWN HUNTINGTON STATION
    '149.MN.00' => array("//zoom.us/j/93114868696" , NULL, "931 1486 8696", "980540"),  // SOBRIETY HILL
    '149.FR.00' => array("//zoom.us/j/86872399413" , NULL, "868 7239 9413", "578572"),  // SOBRIETY HILL
    '181.WD.01' => array("//zoom.us/j/682689475?pwd=Rzl1L0RRQmc2bEdaTjdkVzgzS0k4QT09", "(646) 558 8656", "682 689 475", "mattituck"), // MATTITUCK MID WEEK
    '187.SU.01' => array("//zoom.us/j/71228734268", NULL, "712 2873 4268", "serenity"),   // MELVILLE SWEET AIR - SUN DR
    '187.WD.01' => array("//zoom.us/j/71228734268", NULL, "712 2873 4268", "serenity"), // MELVILLE SWEET AIR - WED BE
    '187.TH.00' => array("//zoom.us/j/9278322441", NULL, "927 8322 441", "YS650"),      // MELVILLE SWEET AIR - THU MED
    '189.TU.00' => array("//zoom.us/j/852561412?pwd=dEttYmp6UXplYzVxUEF5YWttdUxaZz09", NULL, "852 561 412", "12345"), // LONGWOOD LOVE & SERVICE
    '189.TH.00' => array("//zoom.us/j/604011879?pwd=T2dsZy9IYlphQVlmUm1VSk5VMk5EUT09", NULL, NULL, NULL), // LONGWOOD LOVE & SERVICE
//    '203.SU.00' => array("//zoom.us/j/414657828", NULL, "414 657 828", "northport"),    // NORTHPORT FREE AT LAST
//    '203.TH.00' => array("//zoom.us/j/575115331", NULL, "575 115 331", "northport"),    // NORTHPORT FREE AT LAST
//    '203.SA.00' => array("//zoom.us/j/855934327", NULL, "855 934 327", "northport"),    // NORTHPORT FREE AT LAST
    '250.SU.00' => array("//zoom.us/j/513760537?pwd=NzM1RGlNa05mL0lCSmloK09yUWNuZz09", NULL, "513 760 537", "bigbook"), // CLEARY SCHOOL
    '250.TH.00' => array("//zoom.us/j/500561044?pwd=UEV4NnF6LzhpYVFvK3FqSUJrcDVNQT09", NULL, "500 561 044", "12steps"), // CLEARY SCHOOL
    '304.WD.00' => array("//zoom.us/j/5907152081", NULL, "590 715 2081", "524283" ),    // SOUTHOLD SETTLERS
    '304.TH.00' => array("//zoom.us/j/5907152081", NULL, "590 715 2081", "524283" ),    // SOUTHOLD SETTLERS
    '422.FR.00' => array("//meet.google.com/wno-mhit-zmk","(402) 824-0258","705 336 354", NULL),  // ROCKY POINT UNITY GRP
//  '422.SA.00' => array("//meet.google.com/wno-mhit-zmk","(402) 824-0258","705 336 354", NULL),  // ROCKY POINT UNITY GRP
    '591.MN.00' => array("//zoom.us/j/531387530", NULL, "531 387 530", "cowharbor"),    // NORTHPORT COW HARBOR

    // East End Meetings:
    '2'  => array("//zoom.us/j/6554056699",          NULL,"655 405 6699", NULL),        // Ammagansett AM
    '3'  => array("//zoom.us/j/992780763",	         NULL,"992 780 763", "mensroom"),   // Ammagansett The Mens Room
    '7'  => array("//zoom.us/j/479172809",	         NULL,"479 172 809", "916836"),     // Ammagansett ROUND ROBIN
    '500'  => array("//zoom.us/j/84454518684",	     NULL,"844 5451 8684", "505622"),   // Ammagansett Happy Hour
    '56'  => array("//us02web.zoom.us/j/378504990?pwd=YkYrNUJVRTY0UVBSNDNOWERVVjVVUT09", NULL,"378 504 990", "236746"),  // Bridgehampton Hayground Keep It Simple
    '91'  => array("//zoom.us/j/7914635469","(929) 205-6099","791 463 5469", NULL),     // East Hampton Group
    '96'  => array("//zoom.us/j/625731737",	"(929) 436-2866","625 731 737", NULL),      // Sunday Step
    '97'  => array("//zoom.us/j/489358693",	         NULL,"489 358 693", "email the group at soberwomenseast@yahoo.com"), // Sober Woman's East
//    '303'  => array("//zoom.us/j/219568346",	     NULL,"219 568 346", NULL),         // SOUTHOLD WEEKENDERS
    '365'  => array("//zoom.us/j/279125585",	     NULL,"279 125 585", "KISS"),       // East Hampton Keep It Simple
    '418'  => array("//zoom.us/j/361007173",	     NULL,"361 007 173", "b2b001"),     // East Hampton Back to Basics
    '094.SA.00'  => array("//zoom.us/j/997866134",   NULL,"997 866 134", "Green123"),   // East Hampton Keep it Green
    '094.SU.00'  => array("//zoom.us/j/876167885",   NULL,"876 167 885", "Green123"),   // East Hampton Keep it Green
    '094.WD.00'  => array("//zoom.us/j/94867360733", NULL,"948 6736 0733", "Green123"), // East Hampton Keep it Green
    '392' => array("//zoom.us/j/995319793",	         NULL,"995 319 793", "#girlsrule"), // Hampton Bays Women's Group
//    '433' => array("//zoom.us/join",	             NULL,"483 772 9818", "980165"),    // Hampton Bays	Spiritual Awakening West - 11th Step Meditation Mtg
//    '573'  => array("//zoom.us/j/207160635",	 NULL,"207 160 635", "sobriety#1"), // Hampton Bays Hampton Bay Sunday Night Group
    '573'  => array("//zoom.us/j/8270857742", "(646) 558-8656 Passcode: 3402171338", "827 085 7742", "sobriety#1"), // Hampton Bays Hampton Bay Sunday Night Group
    '700'  => array("//zoom.us/j/889817053?pwd=eFhpbkk0VEZFN0M2dndMcTdqSFJBZz09",	NULL,"889 817 053", "MTK1212"), // Montauk Montauk Group (ONLINE ONLY)
    '190.SA.00'  => array("//zoom.us/j/532272602",	"(929) 436-2866 Passcode: 556423","532 272 602", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.TH.00'  => array("//zoom.us/j/377870869",	"(929) 436-2866 Passcode: 240613","377 870 869", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.TU.00'  => array("//zoom.us/j/116733466",	"(929) 436-2866 Passcode: 370982","116 733 466", "Wilson1212"), // Montauk The Smith-Wilson Group
    '190.WD.00'  => array("//zoom.us/j/115649907",	"(929) 436-2866 Passcode: 692971","115 649 907", "Wilson1212"), // Montauk The Smith-Wilson Group
    '580' => array("//zoom.us/j/845720420",	        NULL,"845 720 420", "#geekinout"),  // Riverhead Back to Books
//    '262' => array(NULL, "(515) 604-9094","790 452 210", NULL),                         // Sag Harbor Spiritual Solution
    '262' => array("//zoom.us/j/94193591147?pwd=SmxYVFFhUFN5L1dITWpJOURpRW5ldz09", "(929) 205-6099 Passcode: 80642895","941 9359 1147", "sssh1994"), // Sag Harbor Spiritual Solution M-F
    '262.SA.00' => array("//zoom.us/j/94699728008?pwd=NXB0aVBiSmNjRml0WXVCS1NPL1I0UT09", "(929) 205-6099 Passcode: 71091234","946 9972 8008", "sssh1994"), // Sag Harbor Spiritual Solution SATURDAY
    '317.MN.00'  => array("//zoom.us/j/553131814",	"929 436 2866 Passcode: 860059","553 131 814", "letmein"), // Wainscott	Lincoln & Lee
    '317.WD.00'  => array("//zoom.us/j/553131814",	"929 436 2866 Passcode: 860059","553 131 814", "letmein"), // Wainscott	Lincoln & Lee
    '378' => array("//zoom.us/j/175307047",           NULL,"175 307 047", NULL),         // Wainscott MIRACLES HAPPEN
    '439' => array("//zoom.us/j/697601579",           NULL,"697 601 579", NULL),         // Water Mill WATER MILL SUNDAY NIGHT BEGINNER'S
    '692' => array("//zoom.us/j/4837729818",	      NULL,"483 772 9818", "980165"),    // On Awakening 11th Step Meditation Beach Meeting
    '711' => array("//zoom.us/j/6312831935",	      NULL,"631 283 1935", "1935"),      // Southampton First Things First (ONLINE)
);