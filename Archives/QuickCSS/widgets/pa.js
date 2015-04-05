/*! 
  pa.js
  
视差滚动js解决方案。代码简约，快速上手
pa取自视差滚动（parallax scrolling）前两个字母。
是一款国产视差滚动js解决方案，采用了灵活的html属性来自定义效果
不管你是不是js高手，你都可以在一分钟内快速完成一个视差效果制作。

v1.7.1 www.qietu.com
*/

function pa(){
	 
	 var status = true;
	 $('.pa').each(function(n){
	 	
		style(this);
	 	
		
		var ch = '';
		ch = parseInt($(this).offset().top -$(document).scrollTop()); // current height
		
		
		//$(this).html(ch);
		
		//if(Math.abs(ch)<620 && Math.abs($(window).scrollTop())>20)
		if(ch < 620 && ch > 50)
		{   
			//alert($(this).html());
			play(this);
			status = false;
		}
		else
		{
			unplay();
			status = true;
		}
	 });
	 
	 
	 
	 function style(obj){
	 	var before = {};
		var a = $(obj).attr('before');
		
		var b = a.split(';');
		
		$.each(b, function(key, val) {  
 
			var c = val.split(':');
			var d = {};
			$.each(c, function(k,v){
				 d[k] = v; 
			})
			
			before[d[0]] = d[1]; 
		});  

		$(this).css(before);
	 }
	 
	 function play(obj){
	 	if(status){
			// 动画
			var after = {};
			var e = $(obj).attr('after');
			
			
			var f = e.split(';');
			
			$.each(f, function(key, val) {  
	 
				var g = val.split(':');
				var h = {};
				$.each(g, function(k,v){
					 h[k] = v; 
				})
				
				after[h[0]] = h[1]; 
				
				
			});  
			var delay = $(obj).attr('delay') == undefined ? 500 : $(obj).attr('delay');
			var speed = $(obj).attr('speed') == undefined ? 500 : $(obj).attr('speed');
			
			//$(obj).stop().delay(delay).animate(after,speed);
			
			$(document).queue('myQueue', function(n) {
			  $(obj).animate(after,n);
			});
	 		$(document).dequeue('myQueue');
		}
	 		
	 }
	 
	 function unplay(){
	 	if(!status){
			
		}
	 }


}

$(document).ready(function(){
	
	 pa();
	 
	$(window).bind('scroll',function() {
		var scrollid = window.setTimeout(function(){
			window.clearTimeout(scrollid);
			pa();	
		},1)
	});
	
});