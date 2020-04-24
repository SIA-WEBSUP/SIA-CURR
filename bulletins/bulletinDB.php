<?php 
// php page encoding
mb_http_input("iso-8859-1");
mb_http_output("iso-8859-1");
// php page encoding

// username, password and database for bulletin administration
$username="bulletin";
$password="100605";
$database="suffolk_mtng";
//

// connect
mysql_connect(localhost,$username,$password);
//

//open
@mysql_select_db($database) or die( "Unable to select database");
//
$query = "SELECT bulletinFileName, bulletinTitle FROM bulletin WHERE bulletinEnabled = '1' order by dateCreated desc";
// Get all the data from the "example" table
$result = mysql_query($query) or die(mysql_error());  
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<meta name="Author" content="SIA of AA">
<title>Bulletin</title>
<link href="../css/suffolk-sia.css" rel="stylesheet" type="text/css">
<body>
<table width="800" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
    <td width="135" rowspan="2" valign="top"><? readfile("../menu.php"); ?></td>
    <TD rowspan="2" valign=top>&nbsp;</TD>
    <TD valign=top>&nbsp;</TD>
  </tr>
  <tr>
    <TD valign=top>
<table width="500" border="0" align="left">
<tr>
        <td align="center" class="generalHeading">The Bulletin</td>
      </tr>
<?php
     while($row = mysql_fetch_array( $result )) {
	 $bulletinFileName = $row['bulletinFileName'];
	 $bulletinTitle = $row['bulletinTitle'];
	// Print out the contents of each row
	//echo "query = ".$query; 

 
	  echo "<tr><td>";
      echo '<img src="http://www.suffolkny-aa.org/images/acnvrule.gif" width="600" height="10">';
	  echo "</td></tr>";
	  echo '<tr><td class="generalText">';
	  echo '<a href="/bulletins/'.$bulletinFileName.'" target="_blank">'.$bulletinTitle.'</a>';
	  echo "</td></tr>";
	  }
?>
      
	  <tr>
        <td><img src="http://www.suffolkny-aa.org/images/acnvrule.gif" width="600" height="10"></td>
      </tr>
      
      <tr>
        <td>Older issues are viewable by going to our past issues page.<br>
          Click this link to get there.<BR><a href="/bulletins/bulletin_past.php">Past Issues</a></td>
        </tr>
      <tr>
        <td><img src="http://www.suffolkny-aa.org/images/acnvrule.gif" width="600" height="10"></td>
        </tr>
      <tr>
        <td>To read PDF files you will need Adobe Acrobat Reader. This can be downloaded for free at <a href="../redirect.php?rurl=http://www.adobe.com/products/acrobat/readstep2.html" target="_blank">www.adobe.com</a></td>
        </tr>
    </table></TD>
  </tr>
</table>
</body>
</html>
