var linkshref_083473874=new Array();
function AutoRefresh_98823457334(j){
	var j=j||0;
	var links=document.getElementsByTagName('link');
	if(j==0){
		var href=new Array();
		for(var i=0;i<links.length;i++){
			linkshref_083473874[i]=links[i].getAttribute("href");
		}
	}
	var r="?"+Math.random();
	for(var i=0;i<links.length;i++){
		links[i].setAttribute("href",linkshref_083473874[i]+r);
	}
	j++;
	setTimeout("AutoRefresh_98823457334(1)",1500);
};
AutoRefresh_98823457334();