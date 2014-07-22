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
			<a href="index.php" class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left "  data-rel="back" >取消</a>
			<h1>编辑帖子</h1>
		</div>

		<form method="post" action="">      
      		<ul data-role="listview" data-inset="true">
        		<li class="ui-field-contain">
            <label for="fullname">标题</label>
        	<input type="text" name="title" id="title" value="#">
        		</li>
        		<li class="ui-field-contain">
            		<label for="bday">内容</label>
        		<textarea placeholder="请输入帖子内容..." name="content" id="content"></textarea>
        		</li>
        		<li class="ui-field-contain">
            <fieldset data-role="controlgroup">
        		<legend>请选择分类：</legend>
        		<label for="classic1">主题1</label>
        		<input type="radio" name="classic" id="classic1" value="classic1" checked>
        		<label for="classic2">主题2</label>
        		<input type="radio" name="classic" id="classic2" value="classic2" >
        		<label for="classic3">主题3</label>
        		<input type="radio" name="classic" id="classic3" value="classic3" >
        	</fieldset>
        		</li>

        		<li class="ui-field-contain">
            		<input type="submit"  value="保存">	
        		</li>

    		</ul>
			
		</form>

</body>

</html>