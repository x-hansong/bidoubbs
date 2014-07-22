<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');

		$aid=$_GET['a'];

		//获取评论
		//计算留言总数
		$count_result = mysql_query("SELECT count(*) as count FROM comments where articleid='$aid'");
		$count_array = mysql_fetch_array($count_result);

		//计算总的页数
		$pagenum=ceil($count_array['count']/$pagesize);
		

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

		include('templates/comment.php')
?>