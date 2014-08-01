<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');
		//使用会话内存储的变量值之前必须先开启会话
	session_start();
	// Chromephp::log($_SESSION['uid']);
	// Chromephp::log($_SESSION['name']);

	//每次打开帖子都记录当前打开的帖子id
	if(isset($_GET['a']))//如果打开新的帖子刷新cookie
		setcookie('cur_aid', $_GET['a'], time()+3600);
		//如果会话没有被设置，查看是否设置了cookie
	if(!isset($_SESSION['uid']))
	{
	    if(isset($_COOKIE['uid'])&&isset($_COOKIE['name']))
	    {
	        //用cookie给session赋值
	        $_SESSION['uid']=$_COOKIE['uid'];
	        $_SESSION['name']=$_COOKIE['name'];
	        
   		}
	}
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//处理收藏事件，处理完结束脚本
		if ($_GET['col']==1) 
		{
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
			   			echo "请先登陆";
			   			exit();
			   		}
				}
			$aid=$_COOKIE['cur_aid'];
			$uid=$_SESSION['uid'];
			//判断用户是否已经收藏过
			ChromePhp::log($aid);
			ChromePhp::log($uid);
			$query=mysql_query("select count(*) as count from collects where aid='$aid' and uid='$uid'");
			$count=mysql_fetch_array($query);
			if($count['count']==1)
			{
				echo '你已经收藏过了';
				exit();
			}
			$time=time();
			if(mysql_query("insert into collects (uid, aid, time) values('$uid', '$aid', '$time')"))
				echo "收藏成功";
			else
				echo "收藏失败，请重试";
			exit();
		}

		if($_GET['fav']==1)
		{
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
			   			exit();
			   		}
				}
			$aid=$_COOKIE['cur_aid'];
			$uid=$_SESSION['uid'];
			ChromePhp::log($aid);
			ChromePhp::log($uid);
			$query=mysql_query("select count(*) as count from favorites where aid='$aid' and uid='$uid'");
			$count=mysql_fetch_array($query);
			//如果用户已赞过
			if($count['count']==1)
			{
				$query=mysql_query("select count(*) as count from favorites where aid ='$aid'");
				$result=mysql_fetch_array($query);
				$fav=$result['count'];
				echo '('.$fav.')';
				exit();
			}
		
			//点赞数增加
			if(mysql_query("insert into favorites (uid, aid) values('$uid', '$aid')"))
			{
				$query=mysql_query("select count(*) as count from favorites where aid ='$aid'");
				$result=mysql_fetch_array($query);
				$fav=$result['count'];
				echo '('.$fav.')';
				exit();
			}
		}

		//获取文章作者名字
		$uid=$_SESSION['uid'];
		$aid=$_GET['a'];
		$query=mysql_query("select users.name from articles,users where articles.id='$aid' and articles.uid=users.id");
		$aname=mysql_fetch_array($query);


		//获取文章
		$sql="select * from articles where id = $aid";
		$query=mysql_query($sql);
		$article=mysql_fetch_assoc($query);
		//获取评论
		//分页代码
		//计算留言总数
		$count_result = mysql_query("SELECT count(*) as count FROM comments where aid='$aid'");
		$count_array = mysql_fetch_array($count_result);

		//计算总的页数
		$pagenum=ceil($count_array['count']/$pagesize);
		//ChromePhp::log($count_array['count']);
		//确定当前页数 $p 参数
		$p = $_GET['p']?$_GET['p']:1;
		//数据指针
		$offset = ($p-1)*$pagesize;

		//获取点赞数
		$query=mysql_query("select count(*) as count from favorites where aid ='$aid'");
		$result=mysql_fetch_assoc($query);
		$fav=$result['count'];
		if($fav==0)
			$fav="";	
		else
			$fav='('.$fav.')';		
		// ChromePhp::log($pagenum);
		// ChromePhp::log($comments);


		$sql="select * from comments ,users where comments.aid = '$aid' and comments.uid = users.id ORDER BY addtime ASC LIMIT  $offset, $pagesize";
		$query=mysql_query($sql);
		include("templates/view.php");
	}
	

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
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
		//得到被回复者的名字
		$aid=$_GET['a'];
		$touid=$_GET['touid'];
		$query=mysql_query("select name from users where id='$touid'");
		$toname=mysql_fetch_array($query);
		//获取文章
		$aid=$_GET['a'];
		$sql="select * from articles where id = $aid";
		$query=mysql_query($sql);
		$article=mysql_fetch_assoc($query);
		
		//数据库插入评论
		$time=time();
		$comment=format($_POST['comment']);
		$sql="insert into comments (uid, touid, aid, addtime, content) values('$uid', '$touid', '$aid', '$time', '$comment')";
		mysql_query($sql);

		//更新编辑时间
		mysql_query("update articles set edittime='$time' where id = '$aid'");

		// ChromePhp::log($sql);

		//获取评论
		//分页代码
		//计算留言总数
		$count_result = mysql_query("SELECT count(*) as count FROM comments");
		$count_array = mysql_fetch_array($count_result);

		//计算总的页数
		$pagenum=ceil($count_array['count']/$pagesize);

		//确定当前页数 $p 参数
		$p = $_GET['p']?$_GET['p']:1;
		//数据指针
		$offset = ($p-1)*$pagesize;

		$sql="select * from comments ,users where comments.aid = '$aid' and comments.uid = users.id ORDER BY addtime ASC LIMIT  $offset, $pagesize";
		$query=mysql_query($sql);
		
		include("templates/view.php");
		// ChromePhp::log($pagenum);
		// ChromePhp::log($comments);
	}


?>