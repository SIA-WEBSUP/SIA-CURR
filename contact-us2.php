<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>How to Contact Us</title>
<link href="/css/suffolk-sia.css" rel="stylesheet" type="text/css">
</head>
<body>
<script src="/Scripts/hideEmail.js"></script>
<script src="/Scripts/hideEmailDropDown.js"></script>
     <table>
        <form action="../process/process2.php" method="post">
          <tr>
            <td>&nbsp;</td>
            <td align="left" valign="top" class="generalText">Send this message to:</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="left" valign="top">
            <input type="text" name="mailto" value="webmaster" class="generalText">
            
<?php

@extract($_POST);
//$mailto="webmaster";
//$mailto = stripslashes($mailto);
echo "<script>hideDD(".$mailto.");</script>";

?>
            </select>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="left" valign="top" class="generalText">Your Name:
              <input type="text" name="name" size="20" maxlength="20">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="left" valign="top" class="generalText">Your Email:
              <input type="text" name="email" size="30" maxlength="30">
            if you want a reply</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="left" valign="top" class="generalText">Subject:
              <input type="text" name="subject" size="30" maxlength="30">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="left" valign="top" class="generalText"><textarea name="text" cols="50" rows="10"></textarea>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="left" valign="top" class="generalText"><input type="submit" name="submit" value="Send">
            </td>
            <td>&nbsp;</td>
          </tr>
        </form>



    </table>
</body>
</html>