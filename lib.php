<?php 
    //定义常量
    $pagesize=3;







	//       显示时间格式化
	function showtime($db_time)
    {
    $diftime = time() - $db_time;
    if($diftime < 31536000)
    {
        // 小于1年如下显示
        if($diftime>=86400)
        {
            return round($diftime/86400,1).'天前';
        }else if($diftime>=3600)
        {
            return round($diftime/3600,1).'小时前';
        }else if($diftime>=60)
        {
            return round($diftime/60,1).'分钟前';
        }else
        {
            return ($diftime+1).'秒钟前';
        }
        }
        else{
        // 大于一年
        return gmdate("Y-m-d H:i:s", $db_time);
        }
    }

    //对表单输入数据进行处理
    function format($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        return $data;
    }

    //根据月日分计算并创建目录  
    function mk_dir()
    {  
        $dir = date('m/d', time());  
        if(is_dir('upload/' .$dir)){  
            ChromePhp::log("目录存在"); 
            return $dir;

        }else{  
            mkdir('upload/'.$dir,0777,true);  
            ChromePhp::log($dir); 
            return $dir;  
        } 
    } 

    //获取文件后缀  
    function getExt($file)
    {  
        $tmp = explode('.',$file);  
        return end($tmp);  
    }  

    //随机生成移动后的文件名  
    function randName()
    {  
        $str = 'abcdefghijkmnpqrstwxyz23456789';  
        return substr(str_shuffle($str),0,6);  
    }  

?>