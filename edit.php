<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');
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
	//获取分类目录
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$aid=$_GET['a'];
		$sql="select id, name from categories";
		$query=mysql_query($sql);
		while ($node=mysql_fetch_assoc($query)) {
			$category[$node['id']]=$node['name'];
		}
		
		$query=mysql_query("select * from articles where id='$aid'");
		$article=mysql_fetch_array($query);
		ChromePhp::log($article); 
		include("templates/edit.php");
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//header("Location: index.php") ;
		//print_r($category);
		$aid=$_GET['a'];

		$title=format($_POST['title']);
		$content=format($_POST['content']);
		$classic=format($_POST['classic']);
		//ChromePhp::log($classic); 
		//更新分类文章数量
		$sql="update categories set articles = articles+1 where name = '$classic'";
		$query=mysql_query($sql);

		//ChromePhp::log($query); 
		$time=time();

	//	ChromePhp::log($aid); 

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
				mysql_query("update articles set title='$title', content='$content', category='$classic', edittime='$time', img_path='$path' where id='$aid'");
  
				header("Location: view.php?a=".$aid);
			   

			    exit();
			} else{  
			    ChromePhp::log("上传失败"); 
			}  
		}else
		{
		
			mysql_query("update articles set title='$title', content='$content', category='$classic', edittime='$time', img_path='$path' where id='$aid'");
			// $url = "http://blog.csdn.net/abandonship";  
			// echo "<script type='text/javascript'>";  
			// echo "window.location.href='$url'";  
			// echo "</script>";
			
				header("Location: view.php?a=".$aid);
				exit();
			// ChromePhp::log($_FILES['img']['error']); 
		}
	}
?>

