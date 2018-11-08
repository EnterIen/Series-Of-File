<?php

$message = '';
$data = [];

if ($_FILES['file']['error'] > 0) {  
    switch ($_FILES['file']['error'])  
    {  
        case 1:  
            $message =  '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';  
            break;  
        case 2:  
            $message =  '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';  
            break;  
        case 3:  
            $message =  '文件只有部分被上传';  
            break;  
        case 4:  
            $message =  '没有文件被上传';  
            break;  
        case 5:  
            $message =  '上传文件大小为0';  
            break;  
    }  
    $data = [
    	'code' => 0,
    	'result' => $message,
    ];
    exit(json_encode($data));

}  else{  
    

    // echo '文件名为：'.$_FILES['file']['name'].'<br/>';  
    // echo '文件类型为：'.$_FILES['file']['type'].'<br/>';  
    // echo '文件大小为：'.$_FILES['file']['size'].'字节<br/>';  
  
    // 设置文件的保存路径  
    //如果文件是中文文件名，则需要使用 iconv() 函数将文件名转换为 gbk 编码，否则将会出现乱码  
    $dir = './upload/'.iconv('UTF-8','gbk',basename($_FILES['file']['name']));  
  
    // 将用户上传的文件保存到 upload 目录中  
    if (move_uploaded_file($_FILES['file']['tmp_name'],$dir)){  
        $message =  '文件上传成功'; 
        $data = [
        	'code' => 1,
	    	'result' => $message,
	    ];
    	exit(json_encode($data)); 
    }  
    else{  
    	$message = '文件没有上传到指定文件夹';
    	$data = [
        	'code' => 2,
	    	'result' => $message,
	    ];
        exit(json_encode($data));  
    }  
}  
