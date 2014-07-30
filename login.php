<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');

	session_start();
	$error="";
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$name=format($_POST['name']);
		$pwd=format($_POST['pwd']);
		Chromephp::log($name);
		Chromephp::log($pwd);
		if(!empty($name) && !empty($pwd))
		{
			$query=mysql_query("select * from users where name='$name' and pwd='$pwd'");
			if(mysql_num_rows($query)==1)
			{
				$user=mysql_fetch_array($query);
				$_SESSION['uid']=$user['id'];
				$_SESSION['name']=$user['name'];
				setcookie('uid', $user['id'], time()+3600);
				setcookie('name', $user['name'], time()+3600);
				header("Location: user.php");
				exit();
			}
			else
			{
				$error="用户名或密码错误";
				include('templates/login.php');
			}
		}
		else
		{
			$error="用户名或密码不能为空";
			include('templates/login.php');
		}
	}
	include('templates/login.php');
		

?>