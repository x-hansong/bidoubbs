<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');

	$uid=0;
	//获取用户信息
	$query=mysql_query("select * from users where uid='$uid'");
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