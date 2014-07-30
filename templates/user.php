<!DOCTYPE html>
<html>
<head>
<?php header("Content-type: text/html; charset=utf-8");  ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.css">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>


<script>  
        $(document).on("pagecreate", function(){  
            <!-- 利用ajax提交数据，不刷新整个页面 -->

  		$("#fav").click(function()
  		{
  			xmlhttp=new XMLHttpRequest();
	
			xmlhttp.onreadystatechange=function()
		  	{
		  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    	{
		    		document.getElementById("fav").innerHTML="点赞"+xmlhttp.responseText;
		    	}
		 	}
		 	xmlhttp.open("GET", "view.php?fav=1", true);
		 	
			
			xmlhttp.send();
		});

	$("#col").click(function(){
	    	xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()
	  		{
	  			if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    		{
	    			alert(xmlhttp.responseText);
	    		}
	  		}
	  		xmlhttp.open("GET", "view.php?col=1", true);
			xmlhttp.send();
	  });
        });  

    </script>  

</head>
<body>
	<div data-role="page" id="user">
		<div data-role="header">
			<a href="index.php" class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left " >返回</a>
			<h1>个人中心</h1>
			<a href="logout.php" class="ui-btn-right ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-minus">注销</a>
		</div>

		<div role="main" class="ui-content">
			<ul data-role="listview" data-inset="true" >
				<li>
					<?php

						echo '<img src="',$user['cover'],'">
							<h2>用户名：',$user['name'],'</h2>
								<p></p>'
					?>
					</a>
				</li>
				<li>
					<a href="listview.php?rep_new=1">
						<h3>新的回复<span class="ui-li-count"><?php echo $reply_new ?></span></h3>
					</a>
				</li>
				<li>
					<a href="listview.php?rep=1">
						<h3>收到的回复<span class="ui-li-count"><?php echo $reply ?></span></h3>
					</a>
				</li>
				<li >
					<a href="listview.php?post=1">
						<h3>我发表的逗贴<span class="ui-li-count"><?php echo $post; ?></span></h3>
					</a>
				</li>
				<li>
					<a href="listview.php?col=1">
						<h3>我收藏的逗贴<span class="ui-li-count"><?php echo $collect ?></span></h3>
					</a>
				</li>
				
			</ui>
		</div>

</body>

</html>