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


	<div data-role="page" id="create">
		<div data-role="header">
			<a href="index.php" class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left "  data-rel="back" >返回</a>
			<h1>发布逗贴</h1>
		</div>
        
		<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="post"
        enctype="multipart/form-data" data-ajax="false" >
      		<ul data-role="listview" data-inset="true">
        		<li class="ui-field-contain">
            <label for="fullname">标题</label>
        	<input type="text" name="title" id="title">
        		</li>
        		<li class="ui-field-contain">
            		<label for="bday">内容</label>
        		<textarea placeholder="请输入帖子内容..." name="content" id="content"></textarea>
        		</li>
        		<li class="ui-field-contain">
            <fieldset data-role="controlgroup">
        		<legend>请选择分类：</legend>

            <?php  

                foreach ($category as $id => $name) {
                    echo '<label for="',$id,'">',$name,'</label>
                        <input type="radio" name="classic" id="',$id,'" value="',$name,'">';
                }
        		
            ?>

        	</fieldset>
        		</li>

                <li class="ui-field-contain">
                    <label for="file">图片:</label>
                    <input type="file" name="img" id="file" /> 
                </li>
        		<li class="ui-field-contain">
            		<input type="submit"  value="提交">	
        		</li>

    		</ul>
			
		</form>

	</div>

</body>