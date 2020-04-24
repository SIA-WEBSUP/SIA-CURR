<head>

<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.suffolkny-aa.org/thank_you.php">

</head>



<?php

@extract($_POST);

$mailto = stripslashes($mailto);

$name = stripslashes($name);

$email = stripslashes($email);

$subject = stripslashes($subject);

$text = stripslashes($text);

mail($mailto,$subject,$text,"From: $name <$email>");

?>

