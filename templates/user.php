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
	<div data-role="page" id="user">
		<div data-role="header">
			<a href="index.php" class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left "  data-rel="back" >返回</a>
			<h1>个人中心</h1>
			<a href="edit.php" class="ui-btn-right ui-icon-edit ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ">编辑</a>
		</div>

		<div role="main" class="ui-content">
			<ul data-role="listview" data-inset="true" >
				<li>
					<a href="#">
						<img src="">
						<h2>用户名：</h2>
						<p></p>
					</a>
				</li>
				<li >
					<a href="listview.php">
						<h3>我发表的逗贴<span class="ui-li-count">25</span></h3>
					</a>
				</li>
				<li>
					<a href="#">
						<h3>我收藏的逗贴<span class="ui-li-count">25</span></h3>
					</a>
				</li>
				<li>
					<a href="#">
						<h3>我回复的逗贴<span class="ui-li-count">25</span></h3>
					</a>
				</li>
			</ui>


		</div>

</body>

</html>