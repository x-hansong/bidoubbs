<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');
	//获取最新文章
	//计算帖子总数
	$count_result = mysql_query("SELECT count(*) as count FROM articles");
	$count_array = mysql_fetch_array($count_result);

	//计算总的页数
	$pagenum=ceil($count_array['count']/$pagesize);
	//确定当前页数 $p 参数
	$p = $_GET['p']?$_GET['p']:1;
	//数据指针
	$offset = ($p-1)*$pagesize;
	$sql="select * from articles  ORDER BY edittime DESC LIMIT $offset, $pagesize";
	$query=mysql_query($sql);
		//Chromephp::log($query);
		//Chromephp::log($pagesize);


	//获取热门文章
	$sql="select * from articles where visible = 2 ORDER BY edittime DESC ";
	$query2=mysql_query($sql);
	//Chromephp::log($query2);

	//获取板块分类及文章数量
	$sql="select * from categories";
	$query3=mysql_query($sql);



	include('templates/index.php');


?>