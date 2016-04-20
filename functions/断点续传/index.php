<?php
$sourceFile = "1.jpg"; //要下载的临时文件名 
$outFile = "1.jpg"; //下载保存到客户端的文件名 
$range=0;
header("Cache-Control:"); 
header("Cache-Control: public");
header("Content-Disposition: attachment; filename=" . $outFile);  
header("Accept-Ranges:bytes");
$size = filesize($sourceFile); 
$size2 = $size -1; //文件总字节数 
if(isset($_SERVER['HTTP_RANGE'])){
        header('HTTP/1.1 206 Partial Content');
        $range = str_replace('=','-',$_SERVER['HTTP_RANGE']);
        $range = explode('-',$range);
        $range = trim($range[1]);//$range为开始的地方
        header('Content-Length:'.$size);
        header('Content-Range: bytes '.$range.'-'.$size2.'/'.$size);
    }
else {
        header('Content-Length:'.$size);
        header('Content-Range: bytes 0-'.$size2.'/'.$size);
    }
$fp = fopen($sourceFile, "rb"); 
fseek($fp, $range); 
while (!feof($fp)) { 
print (fread($fp, 1024*8));
flush(); 
ob_flush(); 
} 
fclose($fp); 
?>