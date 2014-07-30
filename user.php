<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');
	//使用会话内存储的变量值之前必须先开启会话
	session_start();
	// Chromephp::log($_SESSION['uid']);
	// Chromephp::log($_SESSION['name']);
	//如果会话没有被设置，查看是否设置了cookie
	if(!isset($_SESSION['uid']))
	{
	    if(isset($_COOKIE['uid'])&&isset($_COOKIE['name']))
	    {
	        //用cookie给session赋值
	        $_SESSION['uid']=$_COOKIE['uid'];
	        $_SESSION['name']=$_COOKIE['name'];
   		}
   		else
   		{
   			header("Location: login.php");
   			exit();
   		}
	}
	$uid=$_SESSION['uid'];
	//获取用户信息
	$query=mysql_query("select * from users where id='$uid'");
	$user=mysql_fetch_array($query);

	//获取用户发表文章数量
	$query=mysql_query("select count(*) as count from articles where uid='$uid'");
	$posts=mysql_fetch_array($query);
	$post=$posts['count'];

	//获取用户收藏文章数量
	$query=mysql_query("select count(*) as count from collects where uid='$uid'");
	$collects=mysql_fetch_array($query);
	$collect=$collects['count'];
	
	//用户收到的全部回复
	$query=mysql_query("select count(*) as count from comments where touid='$uid'");
	$replies=mysql_fetch_array($query);
	$reply=$replies['count'];

	//新的回复
	$query=mysql_query("select count(*) as count from comments where touid='$uid' and view =0");
	$replies_new=mysql_fetch_array($query);
	$reply_new=$replies_new['count'];

	include("templates/user.php");
?>