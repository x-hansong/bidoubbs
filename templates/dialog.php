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
<div data-role="dialog" id="dialog" >
		<div data-role="header">
			<h1>逗它一下</h1>
		</div>

			<form method="post" <?php echo 'action="/bidoubbs/view.php?a=',$_GET['a'],'"' ?> >
				<div data-role="fieldcontain">
    				<textarea placeholder="请输入评论内容..." name="comment" id="comment"></textarea>
    				<input type="submit"   value='我要评论' id="btn_comment"/>
				</div>
			</form>
</div>

</body>
</html>
