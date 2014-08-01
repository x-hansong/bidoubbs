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


	<div data-role="page" id="create">
		<div data-role="header">
			<a href="index.php" class="ui-btn-left ui-icon-back ui-btn  ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left " >返回</a>
			<h1>注册</h1>
		</div>
         <div role="main" class="ui-content">
		<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="post"
        data-ajax="false" >
      		<ul data-role="listview" data-inset="true">
        		<li class="ui-field-contain">
            <label for="fullname">用户名</label>
        	<input type="text" name="name" >
        		</li>
        		<li class="ui-field-contain">
            		 <label for="pwd">密码</label>
                    <input type="password" id="password" name="pwd"/>
        		</li>
        		<li class="ui-field-contain">
            		<input type="submit"  value="提交">	
        		</li>

    		</ul>
			
		</form>
        <p><?php echo $error; ?></p>
    </div>
	</div>

</body>