<?php


$edit = $_POST['edit'];

$file_name = $_POST['file_name'];

$file = fopen($file_name, 'w');

fwrite($file,$edit);

fclose($file);


echo "File Saved! <a href='server.php'> Click here to continue</a>";

?>