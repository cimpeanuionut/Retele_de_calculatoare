<?php
if(!isset($_SESSION)){
session_start();
}
function submitForm()
{
	if (isset($_POST['submit']))
	{
		notify('positive', 'Salut, a fost creat/modificat fisierul  '  .$_POST['name']);
		
	}
	
		
}
function notify($type = 'nuetral', $message = 'Hello Word')
{
	$_SESSION['notify']['type'] = $type; 
	$_SESSION['notify']['message'] = $message;
	

}

function notification()
{
	if(isset($_SESSION['notify']))
	{
		$type = $_SESSION['notify']['type'];
		$message = $_SESSION['notify']['message'];
		
		$html = '<div class="notify '.$type.'">'.$message.'</div>';
		
		echo $html;
		
		//unset($_SESSION['notify']);
		
		
	}
	
}



?>
