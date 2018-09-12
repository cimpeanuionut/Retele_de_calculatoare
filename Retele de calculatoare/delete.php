<?php
$file = $_GET['name'];

unlink($file);

echo "File Deleted! <a href='server.php'>  Click here to continue</a>";


?>