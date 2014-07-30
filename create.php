<?php 
	include('conn.php');
	include('lib.php');
	 include('ChromePhp.php');
	//获取分类目录

	 session_start();
	// Chromephp::log($_SESSION['uid']);
	// Chromephp::log($_SESSION['name']);
	//如果会话没有被设置，查看是否设置了cookie
	$error="";
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
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$sql="select id, name from categories";
		$query=mysql_query($sql);
		while ($node=mysql_fetch_assoc($query)) {
			$category[$node['id']]=$node['name'];
		}
		unset($node);
		mysql_free_result($query);

		include("templates/create.php");
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$title=format($_POST['title']);
		$content=format($_POST['content']);
		$classic=format($_POST['classic']);
		//ChromePhp::log($classic); 
		//更新分类文章数量
		if(empty($title) || empty($content) || empty($classic))
		{
			$sql="select id, name from categories";
			$query=mysql_query($sql);
			while ($node=mysql_fetch_assoc($query)) {
				$category[$node['id']]=$node['name'];
			}
			unset($node);
			mysql_free_result($query);
			$error="请把信息补充完整.";
			include("templates/create.php");
			exit();
		}
		$sql="update categories set articles = articles+1 where name = '$classic'";
		$query=mysql_query($sql);

		//ChromePhp::log($query); 
		$time=time();

		
		$uid=$_SESSION['uid'];
		//上传图片
		if ($_FILES['img']['error'] ==0 && ($_FILES['img']['type']=="image/gif"
			|| $_FILES['img']['type']=="image/jpeg" || $_FILES['img']['type']=="image/pjpeg"
			|| $_FILES['img']['type']=="image/png"
			))
		{
		//判断错误代码，=0则上传成功，！=0则上传失败  
			  
			//处理上传过程  
			// ChromePhp::log("开始上传"); 
			$img = $_FILES['img'];  
			//header("Location: templates/error.php") ;
			//exit;
			//拼接文件路径  
			$path ='upload/'.mk_dir().'/'.randName(). '.' .getExt($img['name']);  
			// ChromePhp::log($path); 
			//移动  
			if(move_uploaded_file($img['tmp_name'],$path)) {  
				mysql_query("INSERT INTO articles (uid,title, content, category, addtime, edittime, img_path) 
				VALUES ('$uid', '$title', '$content', '$classic', '$time', '$time', '$path')");

				$query=mysql_query("select id from articles where title = '$title'");
				$result=mysql_fetch_array($query);
				$aid=$result['id'];
				header("Location: view.php?a=".$aid);

			    // ChromePhp::log($title); 

			    exit();
			} else{  
			   // ChromePhp::log("上传失败"); 
			}  
		}else
		{
			
			mysql_query("INSERT INTO articles (uid, title, content, category, addtime, edittime) 
			VALUES ('$uid','$title', '$content', '$classic', '$time', '$time')");
			// $url = "http://blog.csdn.net/abandonship";  
			// echo "<script type='text/javascript'>";  
			// echo "window.location.href='$url'";  
			// echo "</script>";
			$query=mysql_query("select id from articles where title = '$title'");
				$result=mysql_fetch_array($query);
				$aid=$result['id'];
				header("Location: view.php?a=".$aid);
				exit();
			// ChromePhp::log($_FILES['img']['error']); 
		}
	}
	 ?>

