<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "Login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "acces_denied.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
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
<?php notification();?><br></br>
</center>

<center>
<IMG SRC="Image/server.gif" width="600" height="300"/><br></br><br></br>
<form action="create_file.php"  "<?php submitForm();  ?>" method="POST">
	File Name: <input type="text" id="name" name="name"><p>
	<input type="submit" name="submit" id="submit" value="Create File">
</form>
<p>
<h2>Files</h2>
<?php

$full_path=".";

$dir =@opendir($full_path) or die("Unable to open directory");

while($file= readdir($dir))
{

if($file == "." || $file == ".." || $file == "server.php" || $file == "create_file.php" || $file == "edit_file.php" || $file == "edit.php" || 
$file == "delete.php" || $file == "styleserver.css" || $file == "header.php" || $file == "Login.php" || $file == "footer.php" || $file == "Inregistrare.php"
|| $file == "index.php" || $file == "acces_denied.php" || $file == "style.css" || $file == "Image" || $file == "functions.php" || $file == "functions.js")
	continue;
echo "<a href='$file'>$file</a>.....<a href='edit.php?name=$file'>Edit</a>.....<a href='delete.php?name=$file'>Delete</a><br>";
}

closedir($dir);


?>
<br/>
<a href="<?php echo $logoutAction ?>">Logout</a>
</center>
</div><!--content-->
</div><!--container-->

<div id="footer">

</div><!--footer-->
</body>
</html>

