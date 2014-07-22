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
				<ul data-role="listview" data-inset=	"true" data-filter="true" data-filter-placeholder="比逗一下">
					<li data-role="list-divider">逗贴集结号</li>
					<?php
					// Chromephp::log($article);
						while ($article=mysql_fetch_array($query))
						{
							echo '<li><a href="view.php?a=',$article['id'],'">
							<img src="">
							<p>',$article['title'],'</p>
							</a></li>';
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