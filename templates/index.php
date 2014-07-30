<!DOCTYPE html>
<html>
<head>
<?php header("Content-type: text/html; charset=utf-8");  ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="http://114.215.210.157/bidoubbs/js/jquery.mobile-1.4.3.min.css">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://114.215.210.157/bidoubbs/js/jquery.mobile-1.4.3.min.js"></script>


 
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
	<div data-role="page" id="all">
		<div data-role="header">
			<a href="create.php" class="ui-btn-left ui-icon-plus ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ">发帖</a>
			<h1>比逗社区</h1>
			 <a href="user.php" class="ui-btn-right ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-user">用户</a>
			<div data-role="navbar"  > 
				<ul>
					<li><a href="#hot" data-icon="star" >发现</a></li>
					<li><a href="#all" data-icon="home" >全部</a></li>
					<li><a href="#classfic" data-icon="grid" >分类</a></li>
			</div>
		</div>

		<div role="main" class="ui-content">
			<div class="content-primary">	
				<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="比逗一下">
					<li data-role="list-divider">逗贴集结号</li>
					<?php
					// Chromephp::log($article);
						while ($article=mysql_fetch_array($query))
						{
							$uid=$article['uid'];
							$query1=mysql_query("select * from users where id='$uid'");
							$user=mysql_fetch_array($query1);
							$time=showtime($article['edittime']);
							echo '<li><a href="view.php?a=',$article['id'],'">
							<img src="',$user['cover'],'">
							<h3>',$article['title'],'</h3>
							<p>',$user['name'],'</p>
							<p>',$time,'</p>
							</a>
							</li>';
							// Chromephp::log($article);
						}
						mysql_free_result($query);

					?>
				</ul>
				<?php 
					if ($p <= $pagenum-1)
					{
						# code...
						$p += 1;
						echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="index.php?p=',$p,'" >下一页</a>';
					} 
				?>
			</div>

		</div>
	</div>


	<div data-role="page" id="hot">

		<div data-role="header">
			<a href="create.php" class="ui-btn-left ui-icon-plus ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ">发帖</a>
			<h1>比逗社区</h1>
			 <a href="user.php" class="ui-btn-right ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-user">用户</a>

			<div data-role="navbar"  > 
				<ul>
					<li><a href="#hot" data-icon="star" >发现</a></li>
					<li><a href="#all" data-icon="home" >全部</a></li>
					<li><a href="#classic" data-icon="grid" >分类</a></li>
			</div>


		</div>

		<div role="main" class="ui-content">
			<div class="content-primary">	
				<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="比逗一下">
					<li data-role="list-divider">热门逗贴</li>
					<?php
					// Chromephp::log($article);
						while ($article=mysql_fetch_array($query2))
						{
							echo '<li><a href="view.php?a=',$article['id'],'">
							<img src="">
							<p>',$article['title'],'</p>
							</a></li>';
							// Chromephp::log($article);
						}
						mysql_free_result($query2);
					?>
				</ul>
			</div>	
		</div>
	</div>


	<div data-role="page" id="classfic">
		<div data-role="header">
			<a href="create.php" class="ui-btn-left ui-icon-plus ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ">发帖</a>
			<h1>比逗社区</h1>
			 <a href="user.php" class="ui-btn-right ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-user">用户</a>
			<div data-role="navbar"  > 
				<ul>
					<li><a href="#hot" data-icon="star" >发现</a></li>
					<li><a href="#all" data-icon="home" >全部</a></li>
					<li><a href="#classfic" data-icon="grid" >分类</a></li>
			</div>
		</div>

		<div role="main" class="ui-content">
			<div class="content-primary">	
				<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="比逗一下">
					<li data-role="list-divider">逗贴分类</li>
					<?php
					while ($node=mysql_fetch_assoc($query3)) 
					{
                    echo '<li><a href="listview.php?c=',$node['id'],'" >',$node['name'],'<span class="ui-li-count">',$node['articles'],'</span></a></li>';
                }
                ?>
				</ul>
			</div>	
		</div>
	</div>
</body>