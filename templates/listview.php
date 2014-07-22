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



	<div data-role="page" id="listview">
		<div data-role="header">
			<a class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left "  data-rel="back" >返回</a>
			<h1><?php echo $from ?></h1>
		</div>

		<div role="main" class="ui-content">
			<div class="content-primary">	
				<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="比逗一下">
					<?php
					//Chromephp::log($article);
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
			<?php 
					if ($p <= $pagenum-1)
					{
						# code...
						$p += 1;
						echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="listview.php?c=',$c,'&p=',$p,'" >下一页</a>';
					} 
			?>
		</div>
	</div>
</body>
</html>
