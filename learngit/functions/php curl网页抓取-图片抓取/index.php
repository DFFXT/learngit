<?php
//------抓取某一个网页和其所有的链接网页下的图片
$url="http://www.jb51.net/article/57237.htm";

$links=Array();
$i=0;

function __construct($url){//------获取网页代码
	$curl=curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
		 
	curl_setopt($curl, CURLOPT_HEADER, 0);
	$GLOBALS['Maintext']=curl_exec($curl);
	curl_close($curl);
	$GLOBALS['MaintextImg']=$GLOBALS['Maintext'];
	if($GLOBALS['i']==0)$GLOBALS['MaintextUrl']=$GLOBALS['Maintext'];
	$GLOBALS['i']++;
}

function getIMG(){//-----分析网页下的所有图片链接
	$pos=strpos($GLOBALS['MaintextImg'],"src");
	$GLOBALS['MaintextImg']=substr($GLOBALS['MaintextImg'],$pos+1);
	$posM=strpos($GLOBALS['MaintextImg'],"\"");
	$GLOBALS['MaintextImg']=substr($GLOBALS['MaintextImg'],$posM+1);
	$posM=strpos($GLOBALS['MaintextImg'],"\"");
	$leftText=substr($GLOBALS['MaintextImg'],0,$posM);
	$lastPoint=strrpos($leftText, ".");
	$suffix=substr($leftText,$lastPoint+1);
	if($suffix=='jpg'||$suffix=='png'||$suffix=='gif'){
		echo "<img src='".$leftText."'>";
	}
	
	$GLOBALS['MaintextImg']=substr($GLOBALS['MaintextImg'],$posM+1);
	$pos=strpos($GLOBALS['MaintextImg'],"src");
	if($pos>0){
		getIMG();
	}
}
function getURL(){//----获取网页下的所有子链接
	$pos=strpos($GLOBALS['MaintextUrl'],"href");
	$GLOBALS['MaintextUrl']=substr($GLOBALS['MaintextUrl'],$pos+1);
	$posM=strpos($GLOBALS['MaintextUrl'],"\"");
	$GLOBALS['MaintextUrl']=substr($GLOBALS['MaintextUrl'],$posM+1);
	$posM=strpos($GLOBALS['MaintextUrl'],"\"");
	$leftText=substr($GLOBALS['MaintextUrl'],0,$posM);
	$lastPoint=strrpos($leftText, ".");
	$suffix=substr($leftText,$lastPoint+1);
	if(($suffix!='css'&&$suffix!='xml')&&strlen($leftText)>7&&substr($leftText,0,4)=='http'&&substr($leftText,0,1)!='#'&&substr($leftText,0,11)!="javascript:"&&$leftText!="javascript:;"){
		$GLOBALS['links'][]=$leftText;
		__construct($leftText);
		getIMG();
	}
	
	
	$GLOBALS['MaintextUrl']=substr($GLOBALS['MaintextUrl'],$posM+1);
	$pos=strpos($GLOBALS['MaintextUrl'],"href");
	if($pos>0){
		getURL();
	}
}

__construct($url);
getIMG();
getURL();




?>