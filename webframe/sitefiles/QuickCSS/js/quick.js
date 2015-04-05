/*!
 * 快切——开源中文css框架 v1.0
 *
 * Copyright 2014 kuai.qietu.com, Inc
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 */

 /*tooltip*/
$(function(){
	$('[rel=tooltip]').hover(function(){ 
		$('<div class="tooltip" style="display:none; top:'+($(this).offset().top+$(this).height()+5)+'px;left:'+$(this).offset().left+'px;">'+$(this).attr('title')+'<div class="arrow"></div></div>').appendTo('body').fadeIn();
		//$('body').append('<div class="tooltip" style="top:'+($(this).offset().top+$(this).height()+5)+'px;left:'+$(this).offset().left+'px;">'+$(this).attr('title')+'<div class="arrow"></div></div>');						  		
	},
	function(){
		$('.tooltip').fadeOut().remove();	
	})
	
	
	$('.naver .collapse').click(function(){
		$('.naver .module, .naver .search, .naver .sub').toggle();									  
	})
})


/*浮动菜单*/
$(function(){
	$('.absbar li').hover(function(){
		
		$(this).addClass('selected');	
	},
	function(){
		$(this).removeClass('selected');
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
	$('.naver li').hover(function(){
		
		//alert($('.naver').height());
		$('.naver .droper').css('top',$('.naver').height()-2);
		$(this).addClass('selected');
	},
	function(){
		$(this).removeClass('selected');
	})
	
	if($('.naver.fixed').size()>0){
		$('body').animate({'padding-top':67},'fast');	
	}
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
	$('a[rel=dialog]').click(function(){
		
		$('body').prepend('<div id="mask"></div>').find('#mask').css({opacity:0.5,  cursor:'pointer', background:'black', position:'absolute', zIndex:999, width:'100%',  height:$(document).height()});
		
		//$('body').append('<div class="popup"><del>x</del><div class="head">快切-开源中文css框架</div><div class="body">快切是一个开源中文 (X)HTML/CSS 框架 ,它的目的是减少你的css开发时间。它提供一个可靠的css基础去创建你的项目,能够用于网站的快速设计,通过重设和重建浏览器标准，可以让每个网站防 止枯燥的跨浏览器兼容性测试。你可以将他理解成一套模板，里面包含了大多数站点中所需要的那些css类。他很小，只有四个文件而已。总共不到6KB。</div><div class="foot"><a href="#" class="button blue">关闭</a></div></div>').find('.popup').fadeIn();
		$($(this).attr('href')).fadeIn().animate({'top':'60%'});
		return false;
		
	})		   
	
	/*点击遮罩关闭,live方法用于，为通过js新增的元素添加事件*/
	$('#mask, .dialog del').live('click',function(){
		$('#mask').remove();
		$(this).parent('.dialog').fadeOut(); $(this).parent().parent('.dialog').fadeOut();
		$('.dialog').fadeOut();
	})
})

/*popover*/
$(function(){
	$('*[rel=popover], .popover').live('mouseover',function(){
		//alert(o) 
		e = $(this)[0];
		
		$('<div class="popover" onMouseOver="'+$('.popover').show()+'" onMouseOut="'+$('.popover').hide()+'"  style="display:none; top:'+($(this).offset().top+$(this).height()+3)+'px;left:'+$(this).offset().left+'px;">'+$(this).attr('title')+'<div class="arrow"></div></img></div>').appendTo('body').show();
							   
	})	
	
	$('*[rel=popover], .popover').live('mouseout',function(){
		$('.popover').hide().remove();						   
	})	
	
	/*$('.popover').live('mouseover',function(){
		$(this).show();										
	})
	$('.popover').live('mouseout',function(){
		$(this).hide();									   
	})*/
})

 

/*头部提示语*/
$(function(){
	$('.spring del').click(function(){
		$('.spring').slideUp();								
	})		   
})

/*头部导航搜索栏 用户体验*/
$(function(){
	$('.naver input[type=text]').focus(function(){
		//$(this).animate({'width':'+=10px'},'fast')									 
	})			
})


/*导航条固定*/
$(document).ready(function(){
		
	$(window).bind('scroll',function() {
		if(Math.abs($(window).scrollTop())>300)
			{
				$('.naver.js').hide().addClass('fixed').fadeIn('slow');
			}
			else
			{
				$('.naver.js').removeClass('fixed');
			}
	});
	
});

/*回到顶部*/
$(document).ready(function(){
	
	if($.browser.msie&&($.browser.version == "6.0")&&!$.support.style){
		
	}
	else{
		$(window).bind('scroll',function() {
			if(Math.abs($(window).scrollTop())>200)
				{
					//$('.scrolltotop').fadeIn();
					if($('.scrolltotop').length <= 0){
						$('<a class="fixed scrolltotop" style="display:none;" href="#">^</a>').appendTo('body').fadeIn();
					}
					
				}
				else
				{
					$('.scrolltotop').fadeOut(function(){
						$(this).remove()
					   });	
				}
		});	
	}
	//
	
	
});


/*幻灯片*/
$(function(){
		setTimeout(function(){
			$('.slider-list li:first').fadeIn(); $('.slider').css('background-image','none');
		},600);
		
		$.extend({
			autoSlider:function(){
				
				/*if($('.slider .item.selected').next().size()==0){
					$('.slider .item.selected').removeClass('selected').parent().find('.item:first').addClass('selected');
				}
				else{
					$('.slider .item.selected').removeClass('selected').next().addClass('selected');
				}*/
				$('.slider-list li:first').animate({'opacity':0},200,function(){
						$(this).css('opacity',1).hide().appendTo($(this).parent());
						$('.slider-list li:first').fadeIn();
				})
			}
		})
		// 函数重复调用，基于jQuery的方法一定要以上面的写法定义，否则这里不会生效
		setInterval("$.autoSlider()",10000);

     $('.slider-prev').click(function(){
		
			/*if($('.slider .item.selected').next().size()==0){
					$('.slider .item.selected').removeClass('selected').parent().find('.item:first').addClass('selected');
				}
				else{
					$('.slider .item.selected').removeClass('selected').next().addClass('selected');
				}*/
				$('.slider-list li:first').animate({'opacity':0},200,function(){
						$(this).css('opacity',1).hide();
						$('.slider-list li:last').prependTo($(this).parent()).fadeIn();
				})
		});
		
		$('.slider-next').click(function(){
		
			$('.slider-list li:first').animate({'opacity':0},200,function(){
						$(this).css('opacity',1).hide().appendTo($(this).parent());
						$('.slider-list li:first').fadeIn();
				})
		})
	})


/*单行滚动 singlerolling */
$(function(){
		
		$.extend({
			singlerolling:function(){
				$('.singlerolling ul').animate({'marginTop':-22},function(){
					$(this).css('marginTop',0).find('li:first').appendTo($(this));
				});
			}
		})
		// 函数重复调用，基于jQuery的方法一定要以上面的写法定义，否则这里不会生效
		setInterval("$.singlerolling()",3000);
	})


// 加载prettify着色插件

// Load the stylesheet that we're demoing.
/*var script = document.createElement('script');
script.src = 'assets/js/prettify.js';
document.getElementsByTagName('head')[0].appendChild(script);

var link = document.createElement('link');
link.rel = 'stylesheet';
link.type = 'text/css';
link.href = 'assets/css/prettify.css';
document.getElementsByTagName('head')[0].appendChild(link);
  

$(function(){
  // 调用prettify着色插件
  $('pre').addClass('prettyprint linenums');
  prettyPrint();
})*/

$(function(){
	//alert($('body').width());	
	
	
	if($.browser.msie) { 
		
		responsive();
		
		$(window).resize(function() {
		  responsive();
		}); 
		
		if($.browser.msie&&($.browser.version == "6.0")&&!$.support.style){
			$('html').addClass('ie6');
		} 
		if($.browser.msie&&($.browser.version == "7.0")&&!$.support.style){
			$('html').addClass('ie7');
		} 
		if($.browser.msie&&($.browser.version == "8.0")&&!$.support.style){
			$('html').addClass('ie8');
		}
	}
	else if($.browser.safari)
	{
		$('html').addClass('safari');
	}
	else if($.browser.mozilla)
	{
		$('html').addClass('firefox');
	}
	else if($.browser.opera) {
		$('html').addClass('opera');
	}
	else {
		//alert("i don't konw!");
	}  
})


//滚动监听(对象,偏移,改变的样式,非活动时隐藏对象)
$(function(){ 
	$(window).bind("scroll",function(){ 
	
		$('.sidebar').not('.nojs').find('li').not('.nojs').each(function(){
			var top=$(window).scrollTop();
			
			if($($(this).find('a').attr("href")).size() > 0){
				var thisOffsetTop =$($(this).find('a').attr("href")).offset().top;	
			}
			
			
			if (thisOffsetTop -top<200){
				$(this).closest('.sidebar').find("li").not('.nojs').removeClass("selected");
				$(this).addClass("selected");
			};
		});
	}); 

})

/*左侧菜单*/
$(function(){ 
		   	/*初始化*/
	 $('.sidebar').not('.nojs').css('width',$('.sidebar').width());
	  
	  if($('.sidebar').not('.nojs').size()>0){
		  	var sidebarOffsetTop = $('.sidebar').not('.nojs').offset().top;
		  }
	  //alert(sidebarOffsetTop);
	  
	  if($.browser.msie&&($.browser.version == "6.0")&&!$.support.style){
		} 
		else{  
			$(window).bind('scroll',function(){
				if($(window).scrollTop()> sidebarOffsetTop){
					$('.sidebar').not('.nojs').addClass('affixed');
				}	 
				else{
					$('.sidebar').not('.nojs').removeClass('affixed');	
				}								 
			});
		}
		   
})
	


function responsive(){
			if($('body').width()>1250 && $('body').width() < 1440){
		//$('<link rel="stylesheet" href="assets/css/screen/1200.css" />').appendTo('head').fadeIn();
		$('html').removeClass('w768 w960 w1200');
			$('html').addClass('w1200');
		}
		else if($('body').width()>980 && $('body').width() < 1300){
			$('html').removeClass('w768 w960 w1200');
			$('html').addClass('w960');
		}
		else if($('body').width()>768 && $('body').width() < 960){
			$('html').removeClass('w768 w960 w1200');
			$('html').addClass('w768');
		}
	}
	
	/*ie6 浏览器更新提醒*/
	$(function(){
		if($.browser.msie&&($.browser.version == "6.0")&&!$.support.style){
			//$('<div class="spring"><div class="wrapper">亲~您还在使用十几年前的浏览器IE6，享受更棒的冲浪体验建议您更新 <a href="http://se.360.cn" target="_blank">360安全浏览器</a></div><del>×</del></div>').prependTo('body').fadeIn();	
		}		   
	})
	
	$(function(){
			   	if($('.absbar').size() > 0){
						$('.absbar li').hover(function(){
							$(this).find('.droper').show();							   
						}
						,function(){
								$(this).find('.droper').hide();	
							})
					}
			   })
	
	
	
	/*  加入收藏  */
function AddFavorite(sURL, sTitle)
{
    try { window.external.addFavorite(sURL, sTitle); }
    catch (e)
    {
        try { window.sidebar.addPanel(sTitle, sURL, ""); }
        catch (e) {
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
}


/*  设为首页
	$example : <a href="javascript:void(0)" onclick="setHomepage()">设为首页</a> */
function SetHome(obj,vrl){
	try{ obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl); }
	catch(e){
		if(window.netscape) {
			try { netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  }  
			catch (e) { 
				alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将[signed.applets.codebase_principal_support]设置为'true'");
			}
		var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
		prefs.setCharPref('browser.startup.homepage',vrl);
		}
	}
}

/*   $ 图片预加载
  	 $ comfrom: dreamweaver编辑器
     $example: simplePreload( '01.gif', '02.gif' );  */
function simplePreload()
{ 
  var args = simplePreload.arguments;
  document.imageArray = new Array(args.length);

  for(var i=0; i<args.length; i++)
  {
    document.imageArray[i] = new Image;
    document.imageArray[i].src = args[i];
  }

} 


//双击鼠标滚动屏幕的代码
/*var currentpos,timer;
function initialize()
{
timer=setInterval ("scrollwindow ()",30);
}
function clearScroll()
{
clearInterval(timer);
}
function scrollwindow()
{
	currentpos=document.body.scrollTop;
	window.scroll(0,++currentpos);
	if (currentpos !=document.body.scrollTop)
	clearScroll();
}
document.onmousedown=clearScroll;
document.ondblclick=initialize ;*/