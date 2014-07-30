<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');

	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//得到被回复者的名字
		$touid=$_GET['touid'];
		$query=mysql_query("select name from users where id='$touid'");
		$toname=mysql_fetch_array($query);
		
		include("templates/dialog.php");
	}

?>