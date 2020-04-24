<?php
include 'process/sql-connect.php';
include 'process/sql-open.php';

$mid = mysql_real_escape_string($_REQUEST["mid"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AA Meeting - Map</title>
<style type="text/css">
<!--
body 
{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAACCKI3hEvJkcHQwuo0LYKKRS3GpGLeVyg2Dmf1ND0JFbm7uTpHRQLZKnHEW-tRzYyxDfM_7omB2N1dw" type="text/javascript"></script>
<script type="text/javascript">
 
  var map = null;
  var geocoder = null;
 
  function initialize() {
    if (GBrowserIsCompatible()) {
      map = new GMap2(document.getElementById("map_canvas"));
      //map.setCenter(new GLatLng(37.4419, -122.1419), 13);
      geocoder = new GClientGeocoder();
    }
  }
 
  function showAddress(address,meeting) {
    if (geocoder) {
      geocoder.getLatLng(
        address,
        function(point) {
          if (!point) {
            alert(address + " not found");
          } else {
            map.setCenter(point, 13);
            var marker = new GMarker(point);
            map.addOverlay(marker);
	    map.addControl(new GSmallMapControl());
 
	    var info = meeting + "<br>" + address.replace(/,/,"<br>");
            marker.openInfoWindowHtml(info);
          }
        }
      );
    }
  }
  </script>

</head>
<?php
$query30 = "SELECT * FROM getmeetings WHERE status = '1' AND mid = '$mid'";
$result30 = mysql_query($query30);
while($row30 = mysql_fetch_array($result30))
{
	$locname = strtoupper($row30["name"]);
	$groupname = str_replace("'","`",strtoupper($row30["groupname"]));
	$dayname = strtoupper($row30["dayname"]);
	$location_notes = strtoupper($row30["location_notes"]);
	$meeting_notes = strtoupper($row30["meeting_notes"]);
	$start_time = $row30["start_time"];
	$address = strtoupper($row30["address"]);
	$city = strtoupper($row30["city"]);
	$zip = $row30["zip"];
	$notes = strtoupper($row30["notes"]);
	$map = $row30["map"];
	$alltypeids = $row30["typeid"];
}

$query0 = "SELECT * FROM aa_meetingtypes";
$result0 = mysql_query($query0);
while($row0 = mysql_fetch_array($result0))
{
	$allmeetingtypes[] = $row0["recid"]."-".$row0["typecode"]."-".$row0["typename"];
}



$alltypeids = explode(",", $alltypeids);
foreach($alltypeids as $value0 => $typeid)
{
	foreach($allmeetingtypes as $value => $value2)
	{
		$allmeetings = explode("-", $value2);
		$all_typeid = $allmeetings[0];  
		$all_typecode = $allmeetings[1];
		$all_typename = $allmeetings[2];
		
		if($typeid == $all_typeid)
		{
			$totaltypes_hover .= $all_typename.", ";
		}
	}
}

$totaltypes_hover = strtoupper(substr($totaltypes_hover,0,-2)); //trim trailing comma
?>
<body onload="initialize(); showAddress('<?php echo $address; ?>,<?php echo $city; ?>, NY <?php echo $zip; ?>','<b><?php echo $groupname; ?><br><?php echo $dayname." ".$start_time;?></b>'); return false" onunload="GUnload()">

<table width="800" border="0" align="center" cellpadding="0" cellspacing="4">
  <tr>
    <td height="27" colspan="2" align="left"><span style="font-size: 14px">Map for <i><strong><?php echo $groupname; ?></strong></i> at <i><strong><?php echo $locname; ?></strong></i></span></td>
    </tr>
  <tr>
    <td width="600" align="left">
<?php if($map == "2"){?>
<table width="600" border="0" cellspacing="1" cellpadding="0" bgcolor="#999999">
<tr>
<td height="300" align="center" valign="middle" bgcolor="#CCCCCC" style="color: #666; font-weight: bold; font-family: Verdana;">Sorry, Map is Unavailable For This Listing</td>
</tr>
</table>
<?php }else{ ?>
<div id="map_canvas" style="width: 600px; height: 500px; font-weight: bold; color: #666;"></div>
<?php } ?>

</td>
    <td width="188" align="left" valign="top">
    <p>
        <strong>Meeting Info</strong>
        <br /><?php echo $dayname." ".$start_time; ?>
        <br /><?php echo $totaltypes_hover; ?>
    </p>
    <p>
        <strong>Meeting Notes</strong>
        <br /><?php echo $meeting_notes; ?>
    </p>
    <p>
        <strong>Location Notes</strong>
        <br /><?php echo $location_notes; ?>
    </p>
    <p>
        <strong>Location Address</strong>
        <?php $addresscoded = urlencode("$address $city $state $zip"); ?>
        <br /><a href="http://maps.google.com/maps?q=<?php echo $addresscoded; ?>" target="_blank">Get Directions</a><br /><?php echo $address; ?><br /><?php echo $city; ?>, NY <?php echo $zip; ?>
    </p>
    </td>
  </tr>
  <tr>
    <td align="center"><?php echo "</br>";
	echo "<strong><a href=\"javascript: history.go(-1)\">Back to Meeting Search Form</a></strong>";?></td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  </table>
</body>
</html>
