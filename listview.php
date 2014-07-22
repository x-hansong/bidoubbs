<?php 

	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');

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
		

	}

 ?>