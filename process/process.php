<head>

<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.suffolkny-aa.org/thank_you.php">

</head>



<?php

@extract($_POST);

$name = stripslashes($name);

$email = stripslashes($email);

$subject = stripslashes($subject);

$text = stripslashes($text);

mail('webmaster@suffolkny-aa.org',$subject,$text,"From: $name <$email>");

?>

