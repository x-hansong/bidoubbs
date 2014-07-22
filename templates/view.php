<!DOCTYPE html>
<html>
<head>
<?php header("Content-type: text/html; charset=utf-8");  ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>


<script type="text/javascript">
	<!-- 利用ajax提交数据，不刷新整个页面 -->
	function favor()
	{
		xmlhttp=new XMLHttpRequest();
	
		xmlhttp.onreadystatechange=function()
	  	{
	  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    	{
	    		document.getElementById("fav").innerHTML="点赞"+xmlhttp.responseText;
	    	}
	 	}
	 	<?php echo 'xmlhttp.open("GET", "fav.php?a=',$aid,'&fav=1", true);' ?>
		
		xmlhttp.send();
	}

	function collect()
	{
		xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET", "fav_or_col.php?col=1", true);
		xmlhttp.send();
	}
	

</script>
</head>

<body>

	<div data-role="page" id="view">
		<div data-role="header">
			<a  class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left "  data-rel="back" >返回</a>
			<h1><?php echo $article['title'] ?></h1>
			<a <?php echo 'href="templates/dialog.php?a=',$aid,'"'; ?> class="ui-btn-right ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-comment">评论</a>
		</div>

		<div role="main" class="ui-content">

			<?php 
				$edittime=showtime($article['edittime']);
				echo '<p><pre>',$article['content'],'</pre></p>
				<p><img src="',$article['img_path'],'"></p>
				<p>发布于',$edittime,'</p>';

			?>

			<button data-inline="true" data-mini="true" id="fav" onclick="favor()">点赞<?php echo $fav; ?></button>
			<button data-inline="true" data-mini="true" id="col" onclick="collect()">收藏<?php echo $col; ?></button>

			<ul data-role="listview" data-inset="true" >
				<li data-role="list-divider">逗论</li>
				<?php 
				foreach ($comments as $addtime => $content)
				{
					$ctime=showtime($addtime);
					echo '<li>
							<img src="">
							<p>',$content,'</p>
							<p>',$ctime,'</p>
							</li>';

				}
				mysql_free_result($query);
				?>

			</ul>
			<?php if ($p <= $pagenum-1)
			{
				# code...
				 Chromephp::log("评论页数".$pagenum);
				$p += 1;
				echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="comment.php?a=',$aid,'&p=',$p,'" >更多评论</a>';
			} 
			
			?>
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>">
				<div data-role="fieldcontain">
    				<textarea placeholder="请输入评论内容..." name="comment" id="comment"></textarea>
    				<input type="submit"   value='我要评论' id="btn_comment"/>

				</div>
			</form>
		</div>

		


	</div>

	
</body>

</html>