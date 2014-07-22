<?php 

	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');
	if($_GET['fav']==1)
	{
		$aid=$_GET['a'];
		//点赞数增加
		mysql_query("update articles set favorites = favorites+1 where id = '$aid'");
		$query=mysql_query("select favorites from articles where id = '$aid'");

		$result=mysql_fetch_assoc($query);
	
		$fav=$result['favorites'];
		echo '('.$fav.')';
	}
?>