<?php
$file_name = $_GET['name'];

$file_read = fopen($file_name, "r");
$contents = fread($file_read, filesize($file_name));
fclose($file_read);


?>
<?php include('functions.php');?>
<html>
<link rel="stylesheet" type="text/css" href="styleserver.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script  src="functions.js"></script>
<body>
<div id="header">

</div><!--header-->
<div id="container">
<div id="content">
<center>
<?php notification();?>
</center><br></br>
<center>
<IMG SRC="Image/edit.gif" width="600" height="300"/><br></br><br></br>

<form action="edit_file.php"  "<?php submitForm();  ?>" method="POST">
	<textarea name="edit" cols="100" rows="20"><?php echo $contents;  ?></textarea><p>
	<input type="hidden" name="file_name" value="<?php echo $file_name;   ?>">
	<input type="submit" name="submit" id="submit"  value="Save">
</form>
</center>

</div><!--content-->
</div><!--container-->

<div id="footer">

</div><!--footer-->
</body>

</html>