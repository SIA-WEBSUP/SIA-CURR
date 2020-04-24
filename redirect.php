<?php
$redirectURL = $_GET["rurl"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Refresh" content="20;URL=http://<?php echo $redirectURL;?>" />
<title>Leaving Suffolk Intergroup Assocation Web Site</title>
<link href="/css/suffolk-sia.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="contentRedirect">
  <p><span class="extraLarge">ATTENTION!!</span><br />
    <span class="generalTextBold">You are now   exiting the Suffolk Intergroup Association of A.A. Web site.</span><br />
  </p>
  <p>Our links do not constitute   or indicate review, endorsement, or approval. Thank you for visiting the   Suffolk Intergroup Association of A.A. Web site. We appreciate your interest and hope that you have found the   information you were seeking.<br />
    <br />
    You will now be entering the   site:<br />
    <a href="http://<?php echo $redirectURL;?>" class="generalTextBold"> http://<?php echo $redirectURL;?></a><br />
    <br />
    If   your browser does not automatically go to the site within 20 seconds, please   click on the underlined URL above to go to the site.</p>
</div><?php include('Scripts/googleAnalytics.php'); ?>
</body>
</html>
