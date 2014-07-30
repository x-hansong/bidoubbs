<?php 
	include('conn.php');
	include('lib.php');
	include('ChromePhp.php');
	/**同时注销session和cookie的页面*/
	//即使是注销时，也必须首先开始会话才能访问会话变量
	session_start();
	//使用一个会话变量检查登录状态
	if(isset($_SESSION['uid'])){
	    //要清除会话变量，将$_SESSION超级全局变量设置为一个空数组
	    $_SESSION = array();
	    //使用内置session_destroy()函数调用撤销会话
	    session_destroy();
	}
	//同时将各个cookie的到期时间设为过去的某个时间，使它们由系统删除，时间以秒为单位
	setcookie('uid','',time()-3600);
	setcookie('name','',time()-3600);
	//location首部使浏览器重定向到另一个页面
	$home_url = 'index.php';
	header('Location:'.$home_url);
?>