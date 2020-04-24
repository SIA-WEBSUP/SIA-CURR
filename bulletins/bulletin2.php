<?php 
// SQL Connect scripts
include ("../process/sql-connect-bulletin.php");
include ("../process/sql-open.php");
//
$query = "SELECT bulletinFileName, bulletinTitle FROM bulletin WHERE bulletinEnabled = '1' AND bulletinPastIssue = '0' order by dateCreated desc";
// Get all the data from the "example" table
$result = mysql_query($query) or die(mysql_error());  
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<meta name="Author" content="SIA of AA">
<title>Bulletin</title>
<body>
<table width="300">
<tr>
        <td align="center" class="pageHeading">The Bulletin</td>
  </tr>
<?php
     while($row = mysql_fetch_array( $result )) {
	 $bulletinFileName = $row['bulletinFileName'];
	 $bulletinTitle = $row['bulletinTitle'];
	// Print out the contents of each row
	//echo "query = ".$query; 

 
	  echo "<tr><td>";
      echo '<hr>';
	  echo "</td></tr>";
	  echo '<tr><td class="generalText">';
	  echo '<a href="/bulletins/'.$bulletinFileName.'" target="_blank">'.$bulletinTitle.'</a>';
	  echo "</td></tr>";
	  }
?>
      
	  <tr>
        <td><hr></td>
      </tr>
      
      <tr>
        <td>Older issues are viewable by going to our past issues page.<br>
          Click this link to get there.<BR><a href="/bulletins/bulletin_past2.php">Past Issues</a></td>
  </tr>
      <tr>
        <td><hr></td>
  </tr>
      <tr>
        <td>To read PDF files you will need Adobe Acrobat Reader. This can be downloaded for free at <a href="../redirect.php?rurl=http://www.adobe.com/products/acrobat/readstep2.html" target="_blank">www.adobe.com</a></td>
  </tr>
    </table><?php include('../Scripts/googleAnalytics.php'); ?>
</body>
</html>
