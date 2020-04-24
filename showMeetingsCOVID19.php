<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<meta name="Author" content="SIA of AA">
<title>Meetings</title>
<link href="/css/suffolk-sia.css" rel="stylesheet" type="text/css">
<style>
 tr.notUpdated {background-color:#242424; color:#333333;}
 div.notUpdated {background-color:#242424; color:#333333;}

 
</style>
</HEAD>
<body>

<table width="900"cellpadding="0" cellspacing="0">

<tr>
  <td width="135" rowspan="2" valign="top"><?php readfile("menu.php"); ?></td>
  <TD width="10" rowspan="2" valign=top>&nbsp;&nbsp;&nbsp;</td>
  <TD valign=top>&nbsp;</td>
</tr>
<TD valign=top>
<table width="805"  border="1" cellspacing="1" bordercolorlight="#808080" bordercolordark="#808080" bgcolor="#99CCF">

<TR>
<TD>
<?php
// retrieve form data values from meeting search page
/*
$b = $_POST["ddTown"];
$c = $_POST["ddDay"];
$g = $_POST["ddGroup"];
// used to have a link passing the variable for the town. this way we only have one page to use for towns.
$a = $_GET["town"];

if ($g == 'Choose Group')
$g = "";
*/
include 'process/sql-connect.php';
include 'process/sql-open.php';


$query = "SELECT * FROM `meeting` WHERE `locationNotes` LIKE '%SUSPENDED%'";
/*
// Determine which query to use
if (!empty($g))
$query = sprintf("SELECT * FROM `meeting` WHERE group_name = \"$g\" and lastUpdate > '2014-12-31'");
else if (!empty($a))
$query = sprintf( "SELECT * FROM `meeting` WHERE town = '$a' and lastUpdate > '2014-12-31' order by town");
elseif (($c != 'Choose Day') && ($b == 'Choose Town'))
$query = sprintf( "SELECT * FROM meeting where $c is not null and lastUpdate > '2014-12-31' order by town, group_name");
elseif (($b != 'Choose Town') && ($c != 'Choose Day'))
$query = sprintf( "SELECT * FROM `meeting` WHERE town = '$b' AND $c is not null and lastUpdate > '2014-12-31' order by town");
else
$query = sprintf( "SELECT * FROM `meeting` WHERE town = '$b' and lastUpdate > '2014-12-31' order by town");
*/
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
   echo "Could not successfully run query ($sql) from DB: " . mysql_error();
   exit;
}

if (mysql_num_rows($result) == 0) {
   echo '<div class="generalTextBold" align="center">';
   echo "No Meetings found please try again.<BR>";
// echo $query."<BR>";
  // echo $a.$b.$c."a=";
echo '<a href="javascript: history.go(-1)">Back to Meeting Search Form</a></div>';
   exit;
}
// Convert value of $c to actual day name for display
if ($c == 'MN')
$d = "Monday";
if ($c == 'TU')
$d = "Tuesday";
if ($c == 'TH')
$d = "Thursday";
if ($c == 'FR')
$d = "Friday";
if ($c == 'SA')
$d = "Saturday";
if ($c == 'WD')
$d = "Wednesday";
if ($c == 'SU')
$d = "Sunday";
// if town or day is not chosen in drop down but day is then we need to set $b and $c to nothing
if ($b == 'Choose Town')
$b = "";
if ($c == 'Choose Day')
$c = "";
//echo "g = ". $g."<BR>";

// Determine if user choose more than just a group.
if (!empty($g) && !empty($c))
{
echo '<div align="center">You cannot choose Day and Group.  If you want to search for a particular group choose only the group name.</div>';
echo '<div align="center"><a href="javascript: history.go(-1)">Back to Meeting Search Form</a></div>';
exit;
}
if (!empty($g) && !empty($b))
{
echo '<div align="center">You cannot choose Town and Group.  If you want to search for a particular group choose only the group name.</div>';
echo '<div align="center"><a href="javascript: history.go(-1)">Back to Meeting Search Form</a></div>';
exit;
}
// BEGIN display title of search results

//---------------------------------------------------------------------------------------------------------
//added by GSD
echo "<div align=center style='size:8px'>Gray background indicates information is older than one year and might not be accurate. The Annual Update Form and Instructions can be found at this link:<br><a href='http://www.suffolkny-aa.org/forms/forms_for_groups.php'>Update Form</a></div>";
//---------------------------------------------------------------------------------------------------------
if (!empty($g) && empty($a) && empty($c))

echo "<div class=generalHeading align=center>All meetings SUSPENDED DUE TO COVID-19 CONCERNS</div><div class=tblMeetHead align=center>All meetings are PM unless otherwise noted.</div><div class=tblMeetHead align=center>All meetings are NON-Smoking unless otherwise noted.</div>";
/*

echo "<div class=generalHeading align=center>All meetings for $g.</div><div class=tblMeetHead align=center>All meetings are PM unless otherwise noted.</div><div class=tblMeetHead align=center>All meetings are NON-Smoking unless otherwise noted.</div>";
else if (!empty($a))
echo "<div class=generalHeading align=center>All meetings for $a.</div><div class=tblMeetHead align=center>All meetings are PM unless otherwise noted.</div><div class=tblMeetHead align=center>All meetings are NON-Smoking unless otherwise noted.</div>";
elseif (empty($c))
echo "<div class=generalHeading align=center>All meetings for $b.</div><div class=tblMeetHead align=center>All meetings are PM unless otherwise noted.</div><div class=tblMeetHead align=center>All meetings are NON-Smoking unless otherwise noted.</div>";
elseif (empty($b))
echo "<div class=generalHeading align=center>All meetings on $d.</div><div class=tblMeetHead align=center>All meetings are PM unless otherwise noted.</div><div class=tblMeetHead align=center>All meetings are NON-Smoking unless otherwise noted.</div>";
else
echo "<div class=generalHeading align=center>All meetings for $b on $d.</div><div class=tblMeetHead align=center>All meetings are PM unless otherwise noted.</div><div class=tblMeetHead align=center>All meetings are NON-Smoking unless otherwise noted.</div>";
// END Display tile of search results
*/
?></TD>
</TR>
<TR>
  
<?php
// If statements to determine how to display list of meetings
if ( 1 )
{
/////////////////////////////////
// Begin Display table for town
/////////////////////////////////
echo "<TD>";
echo "<table width=805 border=1 cellspacing=1 id=meetingTable>";
echo "<tr><th>&nbsp;</th><th>Group and Location</th><th>Note</th><TH>SUN</TH><TH>MON</TH><TH>TUE</TH><TH>WED</TH><TH>THU</TH><TH>FRI</TH><TH>SAT</TH></tr>";

// keeps getting the next row until there are no more to get
while($row = mysql_fetch_array( $result )) {foreach($row as $field => $value)
   if (empty($value))
      $row[$field] = '&nbsp;';
	 //you can change the value from "space" to whatever
// Print out the contents of each row into a table
// Check to see if handicap row = Yes; if it does then display handicap image otherwise just display a space
$checkforyes = $row['hc'];
	if ($checkforyes == "Yes")
 		$hcimage = '<IMG SRC="/images/hcaccess.gif" width="20" height="20">';
	else
		$hcimage = '&nbsp;';
// obtain data for creating link to mapquest
$groupName = $row['group_name'];
$oldAddress = $row['address'];
$LocName = $row['locationName'];
$LocNotes = $row['locationNotes'];
$LocAddress = $row['locationAddress'];
$LocCity = ucwords(strtolower($row['locationCity']));
$LocZip = $row['locationZip'];
date_default_timezone_set('America/New_York');  //added 1-12-15 by GSD due to server error message
$thisYear = date(Y);
$thisMonth = date(m);
$dateCreated = $row['dateCreated'];
$createdYear = substr($dateCreated,0,4);
$createdMonth = substr($dateCreated, 5, 2);
if ($thisYear == $createdYear && $createdMonth >= $thisMonth - 2)
{
	$isNew = '<IMG SRC="/images/new.gif">';
}
//-------------------------------------------------------------------------------------
//added by GSD 7-15-2015 to modify CSS for groups that have not submitted annual update
$updateClass = '';
$cutoff = "2015-01-01";
$lastcontact = $row["yearlyContact"];
$lastupdate = $row["lastUpdate"];
$datetime1 = new DateTime($lastupdate);
$datetime2 = new DateTime($cutoff);
//print_r($datetime1);
//print_r($datetime2);
$interval = $datetime2->diff($datetime1);
$interval = $interval->format('%R%a days');
if($interval <=0) {
	$updateClass = 'notUpdated';


};

//-------------------------------------------------------------------------------------- 
$googleMap = "http://maps.google.com/maps?q=$LocAddress $LocCity "."NY"." $LocZip";
$map = "http://www.mapquest.com/maps/map.adp?&address=".$LocAddress."&city=".$LocCity."&state=NY&zipcode=".$LocZip."&country=US&cid=1fmaplink";
$mapLink = "<a href=\"".$googleMap."\" target=\"new\" >Map</a>";

echo "<tr class=$updateClass><td width=\"20\">";
echo $hcimage;
echo "<br>";
echo $isNew;
echo "</td><td  width=\"180\">";

//---------------------------------------------------------------------------------------
//first echo statement commented out by GSD 10-5-2014 and replaced by second echo statement

  //echo "<div id=\"GroupName\">".$groupName."</div>";
  echo "<div  id=GroupName class=".$updateClass.">".$groupName."</div>";
//---------------------------------------------------------------------------------------
if (($LocAddress != "nomap") and ($LocName != "&nbsp;")) {echo "<div id=\"LocName\">".$LocName."</div>";}
if ($LocAddress != "nomap") 
{
echo "<div id=\"LocAddress1\">".$LocAddress."</div>";
echo "<div id=\"LocCity\">".$LocCity.",&nbsp;NY&nbsp;".$LocZip."</div>";

//---------------------------------------------------------------------------------------
//added by GSD 10-5-2014 for testing only
//echo "<div> updated: ".$lastupdate."</div>";
//echo "<div>".$cutoff."</div>";
//echo "<div>".$interval."</div>";
//---------------------------------------------------------------------------------------
}
else 
{
echo "<div id=\"LocOldAddress\">".$oldAddress."</div>";
}
if ($LocNotes != "&nbsp;" )
{
echo "<div id=\"LocNotes\">".$LocNotes."</div>";
}
//---------------------------------------------------------------------------------------
//added by GSD 7-15-2015
//
if ($interval <= 0) {
     echo "<a href='forms/forms_for_groups.php'>Not Updated</a>";
     }
else {
     echo "Updated:".$datetime1->format("Y-m-d");
     };
//
//---------------------------------------------------------------------------------------
if ($LocAddress != "nomap")
{
echo "<div>".$mapLink."</div>";
}
echo "</td><td width=\"75\">";
echo $row['note'];
echo "</td><td width=\"75\">";
echo $row['SU'];
echo "</td><td width=\"75\">";
echo $row['MN'];
echo "</td><td width=\"75\">";
echo $row['TU'];
echo "</td><td width=\"75\">";
echo $row['WD'];
echo "</td><td width=\"75\">";
echo $row['TH'];
echo "</td><td width=\"75\">";
echo $row['FR'];
echo "</td><td width=\"75\">";
echo $row['SA'];
echo "</td></tr>";
}
echo "</table>";
mysql_close($conn);
}
/////////////////////////////////
// END Display table for town
/////////////////////////////////
else
{
////////////GOOD JUST SHOWS TOWN FOR EVERY MEETING///////////////////
// BEGIN Display table for day of week or town and day of week
/////////////////////////////////
$num=mysql_numrows($result);
echo "<td align=center>Total number of meetings found $num</td></tr><td>";
for ($i = 0; $i < $num; $i++) {
// $i = 0 is the first record returned we always want a town header.
if ($i == 0 ) {
$lastTown = mysql_result($result,0,"town");
$currentTown = mysql_result($result,0,"town");
echo "<div id=townName>$currentTown<BR></div>";
//echo "<br>";
}
else {
// $lastTown will be the previous record's town
$currentTown = mysql_result($result,$i,"town");
$lastTown = mysql_result($result,$i-1,"town");
}
$town=mysql_result($result,$i,"town");
$group_name=mysql_result($result,$i,"group_name");
$note=mysql_result($result,$i,"note");
$LocName=mysql_result($result,$i,"locationName");
$LocAddress=mysql_result($result,$i,"locationAddress");
$LocCity=mysql_result($result,$i,"locationCity");
$LocZip=mysql_result($result,$i,"locationZip");
$LocNotes=mysql_result($result,$i,"locationNotes");
$oldAddress=mysql_result($result,$i,"address");
$dayName=mysql_result($result,$i,"$c");
$hc=mysql_result($result,$i,"hc");
$address=mysql_result($result,$i,"address");
$googleMap = "http://maps.google.com/maps?q=$LocAddress $LocCity "."NY"." $LocZip";
$map = "http://www.mapquest.com/maps/map.adp?&address=".$LocAddress."&city=".$LocCity."&state=NY&zipcode=".$LocZip."&country=US&cid=1fmaplink";
$mapLink = "<a href=\"".$googleMap."\" target=\"new\" >Map</a>";
$checkforyes = $hc;
	if ($checkforyes == "Yes")
 		$hcimage = '<IMG SRC="/images/hcaccess.gif" width="20" height="20">';
	else
		$hcimage = '&nbsp;';
$thisYear = date(Y);
$thisMonth = date(m);
$dateCreated = mysql_result($result,$i,"dateCreated");
//-------------------------------------------------
//added by GSD 11-24
$lastUpdate = mysql_result($result,$i, "lastUpdate");
$lastContact = mysql_result($result,$i, "yearlyContact");
//-------------------------------------------------
$createdYear = substr($dateCreated,0,4);
$createdMonth = substr($dateCreated, 5, 2);
if ($thisYear == $createdYear && $createdMonth >= $thisMonth - 2)
{
	$isNew = '<IMG SRC="/images/new.gif">';
}
else
{
	unset($isNew);
}

//-------------------------------------------------------------------------------------
//added by GSD 11-24-2014 to modify CSS for groups that have not submitted annual update
$updateClass = '';
$cutoff = "2014-02-28";
$datetime1 = new DateTime($lastUpdate);
$datetime2 = new DateTime($cutoff);
//print_r($datetime1);
//print_r($datetime2);
$interval = $datetime2->diff($datetime1);
$interval = $interval->format('%R%a days');
if($interval <= 0) {
	$updateClass = 'notUpdated';
};

//-------------------------------------------------------------------------------------- 


// dipslays results without town heading
if ($lastTown == $currentTown){


//--------------------------------------------------------------
//added by GSD 11-24-2014

echo "<div class=".$updateClass.">";
//--------------------------------------------------------------

echo "<hr>";
echo "&nbsp;&nbsp;<b>Group Name: </b>$group_name";
echo "<br>";
if (($LocAddress != "nomap") and ($LocName != "&nbsp;")) {
echo "<div id=\"LocName\">&nbsp;&nbsp;<b>Location:</b>&nbsp;".$LocName."</div>";}
if (!empty($LocNotes)) {
echo "<div id=\"LocNotes\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$LocNotes."</div>";}
if ($LocAddress != "nomap") {
echo "<div id=\"LocAddress\">&nbsp;&nbsp;<b>Address:</b>&nbsp;".$LocAddress."</div><div>&nbsp;&nbsp;".$mapLink."</div>";} 
else 
{echo "<div id=\"LocOldAddress\">&nbsp;&nbsp;<b>Address:</b>&nbsp;".$oldAddress."</div>";}
echo "<div id=\"LocAddress\">";
echo "&nbsp;&nbsp;<b>$d: </b>$dayName";
echo "<br>";
echo "&nbsp;&nbsp;<b>Notes: </b>".$note."&nbsp;&nbsp;".$hcimage.$isNew;
echo "<br>";
echo "<br>";
//----------------------------------------------------------------
//added by GSD 11-24
echo "<br>";
if($interval <= 0) {
  echo "<div style='color:red'>Last Update: ".$lastContact."</div>";		
}
 else {
	echo "<div style='color:red'>Last Update: ".$lastUpdate."</div>";
	}
	echo "<br>";

//----------------------------------------------------------------
echo "</div>";
echo "</div>";

}
else {
// displays results with town heading


//echo "<br>";
echo "<div id=townName>$currentTown</div>";
//echo "<br>";
//--------------------------------------------------------------
//added by GSD 11-24-2014

echo "<div class=".$updateClass.">";
//--------------------------------------------------------------

echo "&nbsp;&nbsp;<b>Group Name: </b>$group_name";
echo "<br>";
if (($LocAddress != "nomap") and ($LocName != "&nbsp;")) {echo "<div id=\"LocName\">&nbsp;&nbsp;<b>Location:</b>&nbsp;".$LocName."</div>";}
if ($LocAddress != "nomap") {echo "<div id=\"LocAddress\">&nbsp;&nbsp;<b>Address:</b>&nbsp;".$LocAddress."</div>";} else {echo "<div id=\"LocOldAddress\">&nbsp;&nbsp;<b>Address:</b>&nbsp;".$oldAddress."</div>";}
//if ($LocNotes != "&nbsp;" ) {echo "<div id=\"LocNotes\">".$LocNotes."</div>";}
if ($LocAddress != "nomap") {echo "<div>&nbsp;&nbsp;".$mapLink."</div>";}
//echo "&nbsp;&nbsp;<b>Address: </b>$LocAddress";
//echo "<br>";
echo "<div id=\"LocAddress\">";
echo "&nbsp;&nbsp;<b>$d: </b>$dayName";
echo "<br>";
echo "&nbsp;&nbsp;<b>Notes: </b>".$note."&nbsp;&nbsp;".$LocNotes."&nbsp;&nbsp;".$hcimage.$isNew;
//----------------------------------------------------------------
echo "<br>";
if($interval <= 0) {
  echo "<div style='color:red'>Last Update: ".$lastContact."</div>";	
}
  else {
	echo "<div style='color:red'>Last Update: ".$lastUpdate."</div>";
	}
	echo "<br>";
//----------------------------------------------------------------
echo "</div>";
echo "</div>";
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
}
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