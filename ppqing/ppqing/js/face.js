function setface(id){
	if(id==1){
		var divcss = {display:""};
		$('#face').css(divcss);
		$('#facetop').css(divcss);
		divcss = {display:"none"};
		$('#facetop2').css(divcss);
	}else if(id==2){
		var divcss = {display:""};
		$('#face').css(divcss);
		$('#facetop2').css(divcss);
		divcss = {display:"none"};
		$('#facetop').css(divcss);
	}else{
		var divcss = {display:"none"};
		$('#face').css(divcss);
	}
}


function setdbface(name){
	$.ajax({
		   type: "POST",
		   url: "index.php?m=index.face",
		   data: "name="+name,
		   success: function(msg){
		    var divcss = {display:"none"};
		   $('#face').css(divcss);
		   $('#facetmp').html('<link href="http://localhost/paipang/css/'+msg+'_skin/skin.css" rel="stylesheet" type="text/css" />');
			 location.reload();
		   }

		}); 
	 alert('系统模板保存成功,自定义模板已清除');

}