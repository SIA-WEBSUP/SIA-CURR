<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<meta name="Author" content="SIA of AA">
<title>Institutional AA Meetings</title>
<link href="/css/suffolk-sia.css" rel="stylesheet" type="text/css">
<link href="/css/instMeetings.css" rel="stylesheet" type="text/css">
</HEAD>
<body>
<table width="900"cellpadding="0" cellspacing="0">

<tr>
  <td width="135" rowspan="2" valign="top"><?php readfile("menu.php"); ?></td>
  <TD width="10" rowspan="2" valign=top>&nbsp;&nbsp;&nbsp;</td>
  <TD valign=top>&nbsp;</td>
</tr>
<TD valign=top>
<table  border="1" cellspacing="1" bordercolorlight="#808080" bordercolordark="#808080" bgcolor="#99CCFF">
<TR>
<TD>
<?php

include 'process/sql-connect-instMeetings.php';
include 'process/sql-open.php';

// Determine which query to use
$query = 'select `Groups`.`GroupName` AS `GroupName`,`Location`.`LocName` AS `LocName`,`Location`.`LocAddress` AS `LocAddress`,`Location`.`LocZip` AS `LocZip`,`Location`.`LocHC` AS `LocHC`,`Location`.`LocNotes` AS `LocNotes`,`Location`.`LocMap` AS `LocMap`,`Meetings`.`StartTime` AS `StartTime`,`Meetings`.`EndTime` AS `EndTime`,`Meetings`.`MeetingNotes` AS `MeetingNotes`,`ZipCode`.`city` AS `city`,`States`.`state_prefix` AS `state_prefix`,`TypesOfMeetings`.`TypeDescription` AS `TypeDescription`,`DaysOfWeek`.`DayOfWeek` AS `DayOfWeek` from (((((((`TypesOfMeetings` join `MeetingType` on((`TypesOfMeetings`.`TypeCode` = `MeetingType`.`TypeCode`))) join `Groups`) join `DaysOfWeek`) join `Location`) join `Meetings` on(((`Location`.`LocID` = `Meetings`.`LocID`) and (`DaysOfWeek`.`DayID` = `Meetings`.`DayID`) and (`Groups`.`GroupID` = `Meetings`.`GroupID`)))) join `ZipCode` on((`Location`.`LocZip` = `ZipCode`.`zip_code`))) join `States` on(((`ZipCode`.`state_prefix` = `States`.`state_prefix`) and (`MeetingType`.`MeetingID` = `Meetings`.`MeetingID`)))) order by `DaysOfWeek`.`DayID`,`Meetings`.`StartTime`,`ZipCode`.`city`;';
// Perform Query
$result = mysql_query($query);

// Check result
// This shows the actual query sent to MySQL, and the error. Useful for debugging.
if (!$result) {
   $messnote  = 'Invalid query: ' . mysql_error() . "\n";
   $messnote .= 'Whole query: ' . $query;
   die($messnote);
}

if (!$result) {
   echo "Could not successfully run query ($query) from DB: " . mysql_error();
   exit;
}

if (mysql_num_rows($result) == 0) {
   echo '<div class="generalTextBold" align="center">';
   echo "No Meetings found please try again.<BR>";
 /*  echo $query."<BR>";
   echo $a.$b.$c."a=";*/
echo '<a href="javascript: history.go(-1)">Back to Meeting Search Form</a></div>';
   exit;
}
echo "<div class=generalHeading align=center>All meetings for institutions.</div><div class=tblMeetHead align=center>All meetings are PM unless otherwise noted.</div><div class=tblMeetHead align=center>All meetings are NON-Smoking unless otherwise noted.</div>";
echo '<div id="disclaimer" align="center"">A.A. is NOT affiliated with nor does it endorse any of the organizations listed.</div>';
// END Display tile of search results

?></TD>
</TR>
<TR>
  
<?php
// If statements to determine how to display list of meetings
////////////GOOD JUST SHOWS TOWN FOR EVERY MEETING///////////////////
// BEGIN Display table for day of week or town and day of week
/////////////////////////////////
$num=mysql_numrows($result);
echo "<td align=center>Total number of meetings found $num</td></tr><td>";
for ($i = 0; $i < $num; $i++) {
// $i = 0 is the first record returned we always want a town header.
if ($i == 0 ) {
$lastTown = mysql_result($result,0,"city");
$currentTown = mysql_result($result,0,"city");
echo "<div id=townName>$currentTown<BR></div>";
//echo "<br>";
}
else {
// $lastTown will be the previous record's town
$currentTown = mysql_result($result,$i,"city");
$lastTown = mysql_result($result,$i-1,"city");
}
// dipslays results without town heading
if ($lastTown == $currentTown){
$town = ucwords(strtolower(mysql_result($result,$i,"city")));
$LocZip=mysql_result($result,$i,"LocZip");
$LocNotes=mysql_result($result,$i,"LocNotes");
$LocMap=mysql_result($result,$i,"LocMap");
$StartTime=mysql_result($result,$i,"StartTime");
$TypeDescription=mysql_result($result,$i,"TypeDescription");
$LocName=mysql_result($result,$i,"LocName");
$MeetingNotes=mysql_result($result,$i,"MeetingNotes");
$DayOfWeek=mysql_result($result,$i,"DayOfWeek");
$hc=mysql_result($result,$i,"LocHC");
$LocAddress=mysql_result($result,$i,"LocAddress");
if (empty($LocNotes)) { $LocNotes = '&nbsp;';}
	// extract first two characters which is HH
		$h = substr($StartTime,0,2);
		// extract MM
		$m = substr($StartTime,3,2);
	$StartTime = date('g:i A',mktime($h, $m));
$checkforyes = $hc;
	if ($checkforyes == "1")
 		$hcimage = '<IMG SRC="/images/hcaccess.gif" width="20" height="20">';
	else
		$hcimage = '&nbsp;';
$map = "http://www.mapquest.com/maps/map.adp?title=".$LocName." ".$DayOfWeek." ".$StartTime."&address=".$LocAddress."&city=".$town."&state=ny&zipcode=".$LocZip."&country=US&cid=1fmaplink";
$mapLink = "<a href=\"".$map."\" target=\"new\" >MAP</a>";

if ( $i > '0' ) echo "<hr>";
echo '<table width="530" border="0">';
echo  '<tr>';
echo  '<td width="63"><b>Location:</b></td>';
  echo  '<td width="229">'.$LocName.'</td>';
  echo  '<td width="53"><b>Day:</b></td>';
  echo  '<td width="125">'.$DayOfWeek.'</td>';
  echo  '<td align="left" width="58">'.$hcimage.'</td>';
 echo '</tr>';
 echo  '<tr>';
echo  '<td><b>Address:</b></td>';
  echo  '<td>'.$LocAddress.'<br>'.$town.',&nbsp;NY&nbsp;&nbsp;'.$LocZip.'</td>';
  echo  '<td><b>Time:</b></td>';
  echo  '<td>'.$StartTime.'</td>';
  echo  '<td>&nbsp;</td>';
 echo '</tr>';
 echo  '<tr>';
echo  '<td>&nbsp;</td>';
  echo  '<td>'.$mapLink.'</td>';
  echo  '<td><b>Format:</b></td>';
  echo  '<td>'.$TypeDescription.'</td>';
  echo  '<td>&nbsp;</td>';
 echo '</tr>';
  echo  '<tr>';
echo  '<td><b>Notes:</b></td>';
  echo  '<td>'.$LocNotes.'</td>';
  echo  '<td>&nbsp;</td>';
  echo  '<td>&nbsp;</td>';
  echo  '<td>&nbsp;</td>';
 echo '</tr>';

echo '</table>';
}
else {
// displays results with town heading
$town = ucwords(strtolower(mysql_result($result,$i,"city")));
$LocZip=mysql_result($result,$i,"LocZip");
$LocNotes=mysql_result($result,$i,"LocNotes");
$LocMap=mysql_result($result,$i,"LocMap");
$StartTime=mysql_result($result,$i,"StartTime");
$TypeDescription=mysql_result($result,$i,"TypeDescription");
$LocName=mysql_result($result,$i,"LocName");
$MeetingNotes=mysql_result($result,$i,"MeetingNotes");
$DayOfWeek=mysql_result($result,$i,"DayOfWeek");
$hc=mysql_result($result,$i,"LocHC");
$LocAddress=mysql_result($result,$i,"LocAddress");
if (empty($LocNotes)) { $LocNotes = '&nbsp;';}
	// extract first two characters which is HH
		$h = substr($StartTime,0,2);
		// extract MM
		$m = substr($StartTime,3,2);
	$StartTime = date('g:i A',mktime($h, $m));
$checkforyes = $hc;
	if ($checkforyes == "1")
 		$hcimage = '<IMG SRC="/images/hcaccess.gif" width="20" height="20">';
	else
		$hcimage = '&nbsp;';
$map = "http://www.mapquest.com/maps/map.adp?title=".$LocName." ".$DayOfWeek." ".$StartTime."&address=".$LocAddress."&city=".$town."&state=ny&zipcode=".$LocZip."&country=US&cid=1fmaplink";
$mapLink = "<a href=\"".$map."\" target=\"new\" >MAP</a>";

//echo "<br>";
echo "<div id=townName>$currentTown<BR></div>";
echo '<table width="530" border="0">';
echo  '<tr>';
echo  '<td width="63"><b>Location:</b></td>';
  echo  '<td width="229">'.$LocName.'</td>';
  echo  '<td width="53"><b>Day:</b></td>';
  echo  '<td width="125">'.$DayOfWeek.'</td>';
  echo  '<td align="left" width="58">'.$hcimage.'</td>';
 echo '</tr>';
 echo  '<tr>';
echo  '<td><b>Address:</b></td>';
  echo  '<td>'.$LocAddress.'<br>'.$town.',&nbsp;NY&nbsp;&nbsp;'.$LocZip.'</td>';
  echo  '<td><b>Time:</b></td>';
  echo  '<td>'.$StartTime.'</td>';
  echo  '<td>&nbsp;</td>';
 echo '</tr>';
 echo  '<tr>';
echo  '<td>&nbsp;</td>';
  echo  '<td>'.$mapLink.'</td>';
  echo  '<td><b>Format:</b></td>';
  echo  '<td>'.$TypeDescription.'</td>';
  echo  '<td>&nbsp;</td>';
 echo '</tr>';
  echo  '<tr>';
echo  '<td><b>Notes:</b></td>';
  echo  '<td>'.$LocNotes.'</td>';
  echo  '<td>&nbsp;</td>';
  echo  '<td>&nbsp;</td>';
  echo  '<td>&nbsp;</td>';
 echo '</tr>';
echo '</table>';
}
}


/*
$i=0;
while ($i < $num) {
if ($i=0) {
$lastTown = mysql_result($result,0,"town");
$town = mysql_result($result,0,"town");
}
else {
$lastTown = mysql_result($result,$i-1,"town");
}

if (($town) == ($lastTown)) {
$town=mysql_result($result,$i,"town");
$group_name=mysql_result($result,$i,"group_name");
$note=mysql_result($result,$i,"note");
$dayName=mysql_result($result,$i,"$c");
$hc=mysql_result($result,$i,"hc");
$address=mysql_result($result,$i,"address");

echo "<hr>";
echo "<BR>TOWN = $town";
echo "<BR>LASTTOWN = $lastTown";
echo "<BR>I = $i<BR>";
echo "&nbsp;&nbsp;<b>Town Name: </b>$town";
echo "<br>";
echo "&nbsp;&nbsp;<b>Group Name: </b>$group_name";
echo "<br>";
echo "&nbsp;&nbsp;<b>Address: </b>$address";
echo "<br>";
echo "&nbsp;&nbsp;<b>$d: </b>$dayName";
echo "<br>";
echo "&nbsp;&nbsp;<b>Notes: </b>$note";

}
$i++;

}  */
mysql_close($conn);

/////////////////////////////////
// End Display table for day of week or town and day of week
/////////////////////////////////
?>
 </TR>
 <tr>
 <TD align="center" valign="middle"><div class="generalTextBold"><a href="javascript: history.go(-1)">Back to Meeting Search Form</a></div></TD>
  </TR>
 <tr>
  <td height="22" align="center"><?php readfile("key.php"); ?></td>
  </tr>
   </TABLE>   </td>
    </tr>
</table>
<?php
///////// Uncomment below for debugging only /////////////
/*  
echo "<BR>";
echo "a=$a";
echo "<BR>";
echo "b=$b";
echo "<BR>";
echo "c=$c";
echo "<BR>";
echo "d=$d";
echo "<BR>";
echo "e=$e";
echo "<BR>";
echo "f=$f";
echo "<BR>";
echo "query=$query"; 

 *///////////////////////////////////////////////////////
?>


<?php include('Scripts/googleAnalytics.php'); ?>
</body>
</HTML>
