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
			$query=mysql_query("select * from users where name='$name'");
			
			$time=time();
			if(mysql_num_rows($query)==0)
			{
				mysql_query("insert into users (name, pwd, cover, regtime) values ('$name', '$pwd', '$default_cover', '$time')");
				$query=mysql_query("select * from users where name='$name'");
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
				$error="用户名已存在";
				include('templates/signup.php');
			}
		}
		else
		{
			$error="用户名或密码不能为空";
			include('templates/signup.php');
		}
	}
	include('templates/signup.php');
		

?>