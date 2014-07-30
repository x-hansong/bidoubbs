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

	<div data-role="page" id="view">
		
		<div data-role="header">
			<a  class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left "  data-rel="back" >返回</a>
			<h1><?php echo $article['title'] ?></h1>
			<?php 
				if($uid != $article['uid'])
					echo '<a href="dialog.php?a=',$aid,'&touid=',$article['uid'],'" class="ui-btn-right ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-comment">评论</a>';
				else
					echo '<a href="edit.php?a=',$aid,'" class="ui-btn-right ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-edit">编辑</a>';



			 ?>
			
		</div>

		<div role="main" class="ui-content">

			<?php 
				$edittime=showtime($article['addtime']);
				echo '<p><pre>',$article['content'],'</pre></p>
				<div style="text-align: center"><img style="width: 90%" src="',$article['img_path'],'"></div>
				<p>发布于',$edittime,'</p>';
			?>

			<button data-inline="true" data-mini="true" id="fav" >点赞<?php echo $fav; ?></button>
			<button data-inline="true" data-mini="true" id="col" >收藏</button>

			<ul data-role="listview" data-inset="true" >
				<li data-role="list-divider">逗论</li>
				<?php 
					while ($comment_=mysql_fetch_array($query))
					{
						$touid=$comment_['touid'];
						$query1=mysql_query("select name from users where id='$touid'");
						$toname=mysql_fetch_array($query1);
						
						Chromephp::log($comment_);
						$ctime=showtime($comment_['addtime']);
						echo '<li>
								<img src="',$comment_['cover'],'"><p>',$comment_['name'],' 回复 ',$toname['name'],': 
								',$comment_['content'],'</p>
								<p>',$ctime,' </p>
								<div>
								<a href="dialog.php?a=',$aid,'&touid=',$comment_['uid'],'" class="ui-btn ui-btn-inline ui-mini ui-icon-comment ui-btn-right ui-btn-icon-right ">回复</a>
								</div>
							</li>';

					}
					mysql_free_result($query);
				?>

			</ul>
			<?php if ($p <= $pagenum-1)
			{
				# code...
				// Chromephp::log("评论页数".$pagenum);
				$p += 1;
				echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="comment.php?a=',$aid,'&p=',$p,'" >更多评论</a>';
			} 
			?>
			<form method="POST"  <?php echo 'action="view.php?a=',$_GET['a'],'&touid=',$article['uid'],'"' ?>>
				<div data-role="fieldcontain">
					<?php echo '<textarea placeholder="回复',$aname['name'],': " name="comment"></textarea>' ?>
    				<input type="submit" value='提交' id="btn_comment"/>

				</div>
			</form>
		</div>

		


	</div>

	
</body>

</html>