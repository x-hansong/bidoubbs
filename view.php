<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');

	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$aid=$_GET['a'];
		//获取文章
		$sql="select * from articles where id = $aid";
		$query=mysql_query($sql);
		$article=mysql_fetch_assoc($query);
		//获取评论
		//分页代码
		//计算留言总数
		$count_result = mysql_query("SELECT count(*) as count FROM comments where articleid='$aid'");
		$count_array = mysql_fetch_array($count_result);

		//计算总的页数
		$pagenum=ceil($count_array['count']/$pagesize);
		ChromePhp::log($count_array['count']);
		//确定当前页数 $p 参数
		$p = $_GET['p']?$_GET['p']:1;
		//数据指针
		$offset = ($p-1)*$pagesize;

		
		$sql="select * from comments where articleid = '$aid' ORDER BY addtime DESC LIMIT  $offset , $pagesize";
		$query=mysql_query($sql);
		while ($comment_exist=mysql_fetch_array($query))
		{
			$comments[$comment_exist['addtime']]=$comment_exist['content'];
		}
		mysql_free_result($query);

		//获取点赞数
		$fav=$article['favorites'];
		if($fav==0)
			$fav="";	
		else
			$fav='('.$fav.')';		
		// ChromePhp::log($pagenum);
		 ChromePhp::log($comments);

		include("templates/view.php");
	}
	

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$aid=$_GET['a'];
		$sql="select * from articles where id = $aid";
		$query=mysql_query($sql);
		$article=mysql_fetch_assoc($query);
		
		//数据库插入评论
		$time=time();
		$comment=format($_POST['comment']);
		$sql="insert into comments (articleid, addtime, content) values('$aid', '$time', '$comment')";
		mysql_query($sql);

		//更新编辑时间
		mysql_query("update articles set edittime='$time' where id = '$aid'");

		unset($comment);
		unset($conments);
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

		$aid=$article['id'];
		$sql="select * from comments where articleid = '$aid' ORDER BY addtime DESC LIMIT  $offset, $pagesize";
		$query=mysql_query($sql);
		while ($comment_exist=mysql_fetch_array($query))
		{
			$comments[$comment_exist['addtime']]=$comment_exist['content'];
		}
		mysql_free_result($query);



		include("templates/view.php");
		// ChromePhp::log($pagenum);
		// ChromePhp::log($comments);
	}


?>