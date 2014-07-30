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

	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if($_GET['c'])
		{

			//获取板块分类及文章数量
			$c=$_GET['c'];
			$sql="select name from categories where id='$c'";
			$query=mysql_query($sql);
			$node=mysql_fetch_assoc($query);
			$from=$node['name'];

			$count_result = mysql_query("SELECT count(*) as count FROM articles where category = '$from'");
			$count_array = mysql_fetch_array($count_result);

			//计算总的页数
			$pagenum=ceil($count_array['count']/$pagesize);
			//确定当前页数 $p 参数
			$p = $_GET['p']?$_GET['p']:1;
			//数据指针
			$offset = ($p-1)*$pagesize;
			$sql="select * from articles where category = '$from' ORDER BY edittime DESC  LIMIT $offset, $pagesize ";
			$query2=mysql_query($sql);
			//Chromephp::log($query2);
			include('templates/listview.php');
		}
		
		if ($_GET['post']==1)
		{
			//获取用户发表文章列表
		
			$from="我发表的逗贴";
			$count_result = mysql_query("SELECT count(*) as count FROM articles where uid='$uid'");
			$count_array = mysql_fetch_array($count_result);

			//计算总的页数
			$pagenum=ceil($count_array['count']/$pagesize);
			//确定当前页数 $p 参数
			$p = $_GET['p']?$_GET['p']:1;
			//数据指针
			$offset = ($p-1)*$pagesize;
			$sql="select * from articles where uid='$uid' ORDER BY edittime DESC  LIMIT $offset, $pagesize ";
			$query2=mysql_query($sql);
			//Chromephp::log($query2);
			include('templates/listview.php');
		}

		if ($_GET['col']==1)
		{
			//获取用户收藏文章列表
	
			$from="我收藏的逗贴";
			$count_result = mysql_query("SELECT count(*) as count FROM collects where uid='$uid'");
			$count_array = mysql_fetch_array($count_result);

			//计算总的页数
			$pagenum=ceil($count_array['count']/$pagesize);
			//确定当前页数 $p 参数
			$p = $_GET['p']?$_GET['p']:1;
			//数据指针
			$offset = ($p-1)*$pagesize;
			$sql="select articles.id, articles.title from articles, collects where articles.uid=collects.uid and collects.uid='$uid' ORDER BY collects.time DESC  LIMIT $offset, $pagesize ";
			$query2=mysql_query($sql);
			//Chromephp::log($query2);
			include('templates/listview.php');
		}
		
		if ($_GET['rep']==1)
		{
			//获取用户回复列表
		
			$from="收到的回复";
			$count_result = mysql_query("select count(*) as count from comments where touid='$uid'");
			$count_array = mysql_fetch_array($count_result);

			//计算总的页数
			$pagenum=ceil($count_array['count']/$pagesize);
			//确定当前页数 $p 参数
			$p = $_GET['p']?$_GET['p']:1;
			//数据指针
			$offset = ($p-1)*$pagesize;
			//获取对用户的回复和回复者的信息
			$sql="select * from comments where touid = '$uid' ORDER BY addtime ASC LIMIT  $offset, $pagesize";
			$query2=mysql_query($sql);
			//Chromephp::log($query2);
			include('templates/listview.php');
		}

		if ($_GET['rep_new']==1)
		{
			//获取用户回复列表
	
			$from="新的回复";
			$count_result = mysql_query("select count(*) as count from comments where touid='$uid' and view=0");
			$count_array = mysql_fetch_array($count_result);

			//计算总的页数
			$pagenum=ceil($count_array['count']/$pagesize);
			//确定当前页数 $p 参数
			$p = $_GET['p']?$_GET['p']:1;
			//数据指针
			$offset = ($p-1)*$pagesize;
			$sql="select * from comments where touid = '$uid' ORDER BY addtime ASC LIMIT  $offset, $pagesize";
			$query2=mysql_query($sql);
			//Chromephp::log($query2);
			include('templates/listview.php');
		}


	}

 ?>