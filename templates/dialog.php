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
<div data-role="dialog">
		<div data-role="header">
			<h1>逗它一下</h1>
		</div>

			<form method="post" <?php echo 'action="view.php?a=',$_GET['a'],'&touid=',$_GET['touid'],'"' ?> >
				<div data-role="fieldcontain">
					<?php echo '<textarea placeholder="回复',$toname['name'],': " name="comment"></textarea>' ?>
        				<input type="submit" value='提交'/>
				</div>
			</form>
</div>

</body>
</html>
