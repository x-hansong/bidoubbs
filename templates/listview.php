<!DOCTYPE html>
<html>
<head>
<?php header("Content-type: text/html; charset=utf-8");  ?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.css">
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>


<script type="text/javascript">

</script>
</head>
<body>



	<div data-role="page" id="listview">
		<div data-role="header">
			<a class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left "  data-rel="back" >返回</a>
			<h1><?php echo $from ?></h1>
			<a href="create.php" class="ui-btn-right ui-icon-plus ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ">发帖</a>
		</div>

		<div role="main" class="ui-content">
			<div class="content-primary">	
				<ul data-role="listview" data-inset="true" >
					<?php
					//Chromephp::log($article);
					if ($_GET['col'] || $_GET['c'] || $_GET['fav'] || $_GET['post']) 
					{
						while ($article=mysql_fetch_array($query2))
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
						mysql_free_result($query2);
					}
					else if($_GET['rep'] || $_GET['rep_new'])
					{
						while ($comment_=mysql_fetch_array($query2))
						{

							$query1=mysql_query("select name from users where id='$uid'");
							$toname=mysql_fetch_array($query1);
							$cuid=$comment_['uid'];
							$query1=mysql_query("select name, cover from users where id='$cuid'");
							$commenter=mysql_fetch_array($query1);
							//Chromephp::log($comment_);
							$ctime=showtime($comment_['addtime']);
							echo '<li>
									<img src="',$commenter['cover'],'"><p>',$commenter['name'],' 回复 ',$toname['name'],': 
									',$comment_['content'],'</p>
									<p>',$ctime,' </p>
									<div>
									<a href="dialog.php?a=',$aid,'&touid=',$comment_['uid'],'" class="ui-btn ui-btn-inline ui-mini ui-icon-comment ui-btn-right ui-btn-icon-right ">回复</a>
									</div>
								</li>';

						}
						mysql_free_result($query);
					}
						
					?>
				</ul>
			</div>	
			<?php 
					if ($p <= $pagenum-1)
					{
						# code...
						$p += 1;
						if($_GET['c'])
							echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="listview.php?c=',$c,'&p=',$p,'" >下一页</a>';
						if($_GET['post'])
							echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="listview.php?post=1&p=',$p,'" >下一页</a>';
						if($_GET['col'])
							echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="listview.php?col=1&p=',$p,'" >下一页</a>';
						if($_GET['rep'])
							echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="listview.php?rep=1&p=',$p,'" >下一页</a>';
						if($_GET['rep_new'])
							echo '<a  class="ui-btn  ui-btn-inlineui-corner-all" href="listview.php?rep_new=1&p=',$p,'" >下一页</a>';
					} 
			?>
		</div>
	</div>
</body>
</html>
