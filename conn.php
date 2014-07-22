<?php 
	//连接数据库
	$con=mysql_connect("localhost", "root", "569621285");
	if(!$con)
	{
		die("Could not connect: " .mysql_error());
	}
	//设定字符集
	mysql_query("set character set 'utf8'");//读库 
	mysql_query("set names 'utf8'");//写库 
	//选择数据库
	$db_selected = mysql_select_db("bidoubbs", $con);

	if (!$db_selected)
 	{
  		die ("Can\'t use bidoubbs : " . mysql_error());
  	}
  	
 ?>	