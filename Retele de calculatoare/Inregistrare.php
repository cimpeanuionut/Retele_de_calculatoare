<?php require_once('../Connections/User_Information.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "registration")) {
  $insertSQL = sprintf("INSERT INTO users (username, password, email) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_User_Information, $User_Information);
  $Result1 = mysql_query($insertSQL, $User_Information) or die(mysql_error());

  $insertGoTo = "Login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_User_Information, $User_Information);
$query_User_Request = "SELECT * FROM users";
$User_Request = mysql_query($query_User_Request, $User_Information) or die(mysql_error());
$row_User_Request = mysql_fetch_assoc($User_Request);
$totalRows_User_Request = mysql_num_rows($User_Request);
?>
<?php include ('header.php'); ?>

<div id="container">
<div id="content">
<center><h3>Inregistrare</h3></center><br></br>
<center>
	<form method="POST" action="<?php echo $editFormAction; ?>" name="registration">
	<label>Username:</label><br/>
	<input type="text" name="username" required="required"> <br/><br></br>
	<label>Password:</label><br/>
	<input type="password" name="password" required="required"><br/><br></br>
	<label>Email:</label><br/>
	<input type="email" name="email" required="required"><br/><br></br>
	<input type="submit" value="Inregistrare">
	<input type="hidden" name="MM_insert" value="registration">
	
	</form><br></br><br>
	Already have an account? <br></br><br></br><ul><li><a href ="Login.php">Login</a></ul></li>
</center>
</div><!--content-->
</div><!--container-->



<?php include ('footer.php'); ?>


</body>
</html>
<?php
mysql_free_result($User_Request);
?>