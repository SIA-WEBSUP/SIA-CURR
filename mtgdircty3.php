<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>- Meeting Directory -</title>

<script type="text/javascript" language="javascript">
<!-- //
function ClearForm(){
    document.meetingSearch.reset();
}
// -->
</script>
</head>
<body onload="ClearForm()">

<table align="center" border="0">
 
      <tr valign="top">
        <td align="center"><div class="extraLarge">A.A. Meetings</div>
          <div class="generalText">In</div>
       
              <div class="extraLarge">Suffolk County, New York</div></td>
      </tr>
      <tr valign="top">
        <td align="right"><div class="interestFont">Today is&nbsp;
              <?php  
              	date_default_timezone_set('America/New_York'); //added 1-12-15 by GSD due to server error message
              	echo( date("l, F jS Y") );?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
      </tr>
      <tr valign="top">
     <td><table border="3" cellspacing="2" cellpadding="1" bordercolorlight="#808080" bordercolordark="#808080" id="townTable">
      <form action="showMeeting3.php" method="post" name="meetingSearch" id="meetingSearch">
	  <tr align="center">
          <TD colspan="6" VALIGN="middle" nowrap="nowrap" bordercolor="#0000FF">Select Town
            <?php
			// SQL Connect scripts
	include ("process/sql-connect.php");
	include ("process/sql-open.php");
		//
/* Dynamic list box maker for towns */
function townList($table, $selected, $boxname, $displayfield){
    $sql = "SELECT DISTINCT $displayfield FROM $table order by $displayfield";
    $result = mysql_query($sql) or die("dynamic list box query failed.");
    $boxcode = '<select name="'.$boxname.'"'.' class="generalText" id="ddTown">';
	$boxcode .= "<option>Choose Town</option>";
    while ($row = mysql_fetch_array($result)){
        list ($i) = $row;
		$boxcode .= '<option value="'.ucwords(strtolower($i)).'"';
        if(ucwords(strtolower($i)) == $selected) $boxcode .= " selected";
        $boxcode .= ">".ucwords(strtolower($i))."</option>";
    }
    $boxcode .= "</select>";
    return $boxcode;
}
// this function is called using
$boxcode = townList('meeting', 'Choose Town', 'ddTown', 'town'); 
// and displayed using 
echo $boxcode;
/* Dynamic list box maker for groups */
function groupList($gtable, $gselected, $gboxname, $gdisplayfield){
    $gsql = "SELECT DISTINCT $gdisplayfield FROM $gtable order by $gdisplayfield";
    $gresult = mysql_query($gsql) or die("dynamic list box query failed.");
    $gboxcode = '<select name="'.$gboxname.'"'.' class="generalText" id="ddGroup">';
	$gboxcode .= "<option>Choose Group</option>";
    while ($grow = mysql_fetch_array($gresult)){
        list ($j) = $grow;
		$gboxcode .= '<option value="'.ucwords(strtolower($j)).'"';
        if(ucwords(strtolower($j)) == $gselected) $gboxcode .= " selected";
        $gboxcode .= ">".ucwords(strtolower($j))."</option>";
    }
    $gboxcode .= "</select>";
    return $gboxcode;
//	mysql_close();
}
// this function is called using
$gboxcode = groupList('meeting', 'Choose Group', 'ddGroup', 'group_name'); 
?>
&nbsp;And/Or Choose Day of Week
      <select name="ddDay" class="generalText" id="ddDay">
        <option>Choose Day</option>
        <option value="SU">Sunday</option>
        <option value="MN">Monday</option>
        <option value="TU">Tuesday</option>
        <option value="WD">Wednesday</option>
        <option value="TH">Thursday</option>
        <option value="FR">Friday</option>
        <option value="SA">Saturday</option>
        </select>
        
          </tr>
	  <tr align="center">
	    <TD colspan="6" VALIGN="middle" nowrap="nowrap" bordercolor="#0000FF">
          Or Search by Group Name: <?php echo $gboxcode;?>
          &nbsp;
        <input type="submit" name="Submit" value="Submit"/>
        &nbsp;
        <input name="Reset" type="reset" id="Reset" value="Reset" /></TD>
	     </TD>
	   </tr> 
	  <tr align="center">
	    <TD colspan="6" VALIGN="middle" nowrap="nowrap" bordercolor="#0000FF"><div><a href="/instMeetings.php" class="generalTextBold">Follow this link for institutional meetings</a></div></TD>
	    </tr>
   </form>   
<tr>
<?php
// code to display towns in table from database.  This way if a town is added or deleted from the database the change will automatically show here.
// so when someone adds a meeting in a new town the only thing that needs to be done is add the meeting to the database.
$query = "SELECT DISTINCT town FROM meeting order by town";
$result = mysql_query($query) or die ("Table query failed.");
$num=mysql_numrows($result);
//echo "found $num towns";
for ($i = 1; $i <= $num; $i++) {
$town = mysql_result($result,$i-1,"town");
$town = ucwords(strtolower($town));
$townLink = '<a href="showMeeting3.php?town='.$town.'">'.$town.'</a>';
echo '<td nowrap="nowrap" align="center">';
echo $townLink;
echo "</td>";
if ($i % 6 == 0)
{
echo '</tr>
	<tr>';
}

}

mysql_close($conn);

?>
  </tr>
  <TR>
    <TD colspan="6" align="center" VALIGN="middle" nowrap="nowrap" bordercolor="#0000FF">Please respect our request to NOT use this directory for mailings under any circumstances.</TD>
    </TR>
  <TR>
    <TD colspan="6" align="center" VALIGN="middle" nowrap="nowrap" bordercolor="#0000FF"></TD>
    </TR>
  <TR>
    <TD colspan="6" align="center" VALIGN="middle" nowrap="nowrap" bordercolor="#0000FF"><a href="otherareas.php">Meeting information in areas outside of Suffolk County</a></TD>
    </TR>
      </form>
	  <script>
document.forms['meetingSearch'].reset()
</script>
    
</table></td>
      </tr>
    </table>
      




<?php include('Scripts/googleAnalytics.php'); ?>
</body>
</html>