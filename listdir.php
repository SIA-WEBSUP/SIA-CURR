<?php

$dir = isset($_GET['dir']) ? $_GET['dir'] : '.';

$files = scandir($dir);
print_r($files);
