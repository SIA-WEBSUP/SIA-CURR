<?php 
// SQL Connect scripts
include ("../process/sql-connect-bulletin.php");
include ("../process/sql-open.php");
//
$query = "SELECT bulletinFileName, bulletinTitle FROM bulletin WHERE bulletinEnabled = '1' AND bulletinPastIssue = '1' order by dateCreated desc";
// Get all the data from the "example" table
$result = mysql_query($query) or die(mysql_error());  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<meta name="Author" content="SIA of AA">
<title>Bulletin Past Issues</title>

<body>
<TABLE>
        <TR>
          <td valign="top">
        </TR>
        <TR>
          <td align="center" valign="top" class="pageHeading">Past Issues of the Bulletin 
        </TR>
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
	  echo '<div align="center"><a href="/bulletins/'.$bulletinFileName.'" target="_blank">'.$bulletinTitle.'</a></div>';
	  echo "</td></tr>";
	  }
?>
        
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read December 2005 Bulletin - Not available</td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read November 2005 Bulletin - Not available</td> 
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read Octber 2005 Bulletin - Not available</td> 
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read September 2005 Bulletin - <a href="/bulletins/sept_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read August 2005 Bulletin - <a href="/bulletins/aug_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read July 2005 Bulletin - <a href="/bulletins/july_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read June 2005 Bulletin - <a href="/bulletins/june_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read May 2005 Bulletin - <a href="/bulletins/may_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read April 2005 Bulletin - <a href="/bulletins/april_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read March 2005 Bulletin - <a href="/bulletins/mar_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read February 2005 Bulletin - <a href="/bulletins/feb_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read January 2005 Bulletin - <a href="/bulletins/jan_05/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read December 2004 Bulletin - <a href="/bulletins/dec_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read November 2004 Bulletin - <a href="/bulletins/nov_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read October 2004 Bulletin - <a href="/bulletins/oct_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read September 2004 Bulletin - <a href="/bulletins/sept_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read August 2004 Bulletin - <a href="/bulletins/aug_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read July 2004 Bulletin - <a href="/bulletins/july_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read June 2004 Bulletin - <a href="/bulletins/june_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read May 2004 Bulletin - <a href="/bulletins/may_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read April 2004 Bulletin - <a href="/bulletins/apr_04/index.html">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read March 2004 Bulletin - <a href="/bulletins/mar_04/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read February 2004 Bulletin - <a href="/bulletins/feb_04/index.html">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText">Click here to read December 2003 Bulletin - <a href="/bulletins/dec_03/index.html" target="_blank">Print Version</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText"><a href="/bulletins/BulletinNov03.pdf" target="_blank">November 2003</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText"><a href="/bulletins/BulletinOct03.pdf" target="_blank">October 2003</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText"><a href="/bulletins/BulletinSep03.pdf" target="_blank">September 2003</a> </td>
        </TR>
        <TR>
          <td><hr></td> 
        </TR>
        <TR>
          <td align="center" valign="top" class="generalText"><a href="/bulletins/BulletinAug03.pdf" target="_blank">August 2003</a> </td>
        </TR>
        <TR>
          <td><hr></td>
        </TR>
      </TABLE><?php include('../Scripts/googleAnalytics.php'); ?>
</body>
</html>
