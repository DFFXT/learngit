<?php
$src='../imgFile/2016-04-23 01-56-02.jpg';//---源文件
$water='../imgFile/mp3.png';//-----添加文件
$img=imagecreatefromstring(file_get_contents($src));//------把图片转换成资源类型、但无法以fwrite写入文件
$water=imagecreatefromstring(file_get_contents($water));
$size=getimagesize($src);//------获取文件信息( [0] => 768 [1] => 1024 [2] => 3 [3] => width="768" height="1024" [bits] => 8 [mime] => image/png )
imagecopymerge($img,$water,0,0,0,0,$size[0],$size[1],50);//------图片重合第一个参数为主体0,0,0,0分别为在$img上的x y位置，$water的切割起点 最后的参数为模糊程度百分比

if($size['mime']=='image/jpeg'){
	header("Content-type:image/jpeg");
	imagejpeg($img);//----合成jpeg$img 第二个参数可以指定保存的位置和文件名 imagejpeg($img,'position/name');
}

else if($size['mime']=='image/png'){
	header("Content-type:image/png");
	imagepng($img);
}

imagedestroy($img);//-----释放资源
imagedestroy($water);
?>