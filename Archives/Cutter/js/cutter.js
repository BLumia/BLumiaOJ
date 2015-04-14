/*tooltip*/
$(function(){
	$('[rel=tooltip]').hover(function(){ 
		$('<div class="tooltip" style="display:none; top:'+($(this).offset().top+$(this).height()+5)+'px;left:'+$(this).offset().left+'px;">'+$(this).attr('title')+'<div class="arrow"></div></div>').appendTo('body').fadeIn();
		//$('body').append('<div class="tooltip" style="top:'+($(this).offset().top+$(this).height()+5)+'px;left:'+$(this).offset().left+'px;">'+$(this).attr('title')+'<div class="arrow"></div></div>');						  		
	},
	function(){
		$('.tooltip').fadeOut().remove();	
	})
	
	
	$('.topbar .collapse').click(function(){
		$('.topbar .module, .topbar .sub').toggle();									  
	})
})


/*选项卡效果*/
$(function(){
	$('.taber .head a').hover(function(){
		$('.taber .body').hide();
		$('.taber #'+$(this).attr('lang')).show();	
		
		$('.taber .head a').removeClass('selected');
		$(this).addClass('selected');
	})		   
})


/*头部二级菜单*/
$(function(){
	$('.topbar .module li').hover(function(){
		$(this).addClass('selected');
	},
	function(){
		$(this).removeClass('selected');
	})
})


/*heading响应式用户体验*/
$(function(){
/*	$('.heading').hover(function(){
		$(this).animate({'height':'+=10'},300,function(){
														  
		})							 
	},
	function(){
		$(this).animate({'height':'-=10'},300,function(){
														  
		})		
	})	*/	   
})

$(function(){
	$('a[rel=popup]').click(function(){
		
		$('body').prepend('<div id="mask"></div>').find('#mask').css({opacity:0.5,  cursor:'pointer', background:'black', position:'absolute', zIndex:999, width:'100%',  height:$(document).height()});
		
		$('body').append('<div class="popup"><del>x</del><div class="head">渴切-开源中文css框架</div><div class="body">渴切是一个开源中文 (X)HTML/CSS 框架 ,它的目的是减少你的css开发时间。它提供一个可靠的css基础去创建你的项目,能够用于网站的快速设计,通过重设和重建浏览器标准，可以让每个网站防 止枯燥的跨浏览器兼容性测试。你可以将他理解成一套模板，里面包含了大多数站点中所需要的那些css类。他很小，只有四个文件而已。总共不到6KB。</div><div class="foot"><a href="#" class="button blue">关闭</a></div></div>').find('.popup').fadeIn();
	})		   
	
	/*点击遮罩关闭,live方法用于，为通过js新增的元素添加事件*/
	$('#mask, .popup del').live('click',function(){
		$('#mask, .popup').remove();
	})
})

/*卡通公仔*/
$(function(){
	setTimeout(function(){
			$('.cartoon').fadeIn();				
		},1000)		   
})

/*头部提示语*/
$(function(){
	$('.spring del').click(function(){
		$('.spring').slideUp();								
	})		   
})