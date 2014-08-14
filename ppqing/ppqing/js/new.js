// JavaScript Document
lastScrollY=0;
function heartBeat(){ 
var diffY;
if (document.documentElement && document.documentElement.scrollTop)
    diffY = document.documentElement.scrollTop;
else if (document.body)
    diffY = document.body.scrollTop
else
    {/*Netscape stuff*/}
    
//alert(diffY);
percent=.1*(diffY-lastScrollY); 
if(percent>0)percent=Math.ceil(percent); 
else percent=Math.floor(percent); 

lastScrollY=lastScrollY+percent; 
//alert(lastScrollY);
}

if( typeof document.compatMode != 'undefined' ){
	suspendcode14='<div  style="z-index:9;right:0;bottom:320px;height:100px;width:24px;overflow:hidden;POSITION:fixed;_position:absolute; _margin-top:expression(document.documentElement.clientHeight-this.style.pixelHeight+document.documentElement.scrollTop);"><a  href=index.php?m=index.help><img style=\'border:0px\' src=css/help/1.png></img></a></div>';
	}else{
suspendcode14='<div  style="z-index:9;right:0;bottom:320px;height:100px;width:24px;overflow:hidden;POSITION:fixed;*position:absolute; *top:expression(eval(document.body.scrollTop)+eval(document.body.clientHeight)-this.style.pixelHeight);"><a   href=index.php?m=index.help><img style=\'border:0px\' src=css/help/1.png></img></a></div>'
	}
document.write(suspendcode14); 
window.setInterval("heartBeat()",1);
