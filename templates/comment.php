<!DOCTYPE html>
<html>
<head>
<?php header("Content-type: text/html; charset=utf-8");  ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>


<script type="text/javascript">

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
				$p += 1;
				Chromephp::log($pagenum);
				echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="comment.php?a=',$aid,'&p=',$p,'" >更多评论</a>';
			} 
			else if($pagenum!=1 && $pagenum!=0)
			{
				 Chromephp::log($pagenum);
				echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="view.php?a=',$aid,'" >回到帖子首页</a>';
			}
			?>
		</div>

		


	</div>

	
</body>

</html>