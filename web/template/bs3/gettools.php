<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $OJ_NAME?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
ieGo();
function ieGo(){ 
		var ie = !-[1,];  
		if(ie == true) {
			var ua = navigator.userAgent.toLowerCase();
			var version = parseInt(ua.match(/msie ([\d.]+)/)[1]);
			if(version <= 7) {
				location.href='./old/'; 
			}
		}
}
	</script>
  </head>

  <body>

    <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
<div class="page-header">
  <h1>获取开发工具 <small>选择一款IDE</small></h1>
</div>
<p>IDE是Integrated Development Environment 的缩写，即集成式开发环境。为了方便我们的开发，我们通常在IDE中完成代码编写，编译构建，调试运行等工作。无论是参与算法竞赛或是个人软件开发，选择一个顺手的IDE都是一个明智的选择。接下来将推荐几款常见的IDE供大家选择。</p>
<h3>Code::Block</h3>
<p>简介：<br/>
Code::Blocks是一个开源的全功能的跨平台C/C++集成开发环境。由纯粹的C++语言以配合图形界面库wxWidgets开发完成。其操作程度略微复杂但可以完成大部分的代码工作任务，适用于所有应用开发程序员。</p>
<p>安装：<br/>
软件支持Windows，MacOS和Linux操作系统。<br/>
在windows上使用带编译器的安装版本可以使你安装后可以直接使用该软件，当然您也可以选择下载不带编译器的版本。<br/>
如果您使用不带编译器的安装版本或是您所在平台非windows，您需要先依次安装GCC、GDB然后再安装使用。</p>
<p>下载地址：<br/>
<a href="http://www.codeblocks.org/downloads">【官网地址】</a>
<a href="http://tieba.baidu.com/p/3242052995">【其他地址】</a>
</p>
<p>
使用方法：
（创建一个新的控制台程序项目）<br/>
对于算法竞赛用户，应创建控制台程序。<br/>
在File->New->Project弹出的对话框中选择Console application（在Category选择Console可以塞选类型为控制台）<br/>
弹出向导选择下一步，选择语言并下一步，填写保存路径和项目名称等信息，最后完成。<br/>
在左侧的Management中选择项目名称并选择代码文件，双击后右侧即代码文件。
</p>
<div class="alert alert-warning" role="alert">
常见问题：<br/>
<b>无法编译，无法调试</b>：可能是由于程序路径或者项目路径存在中文字符。请不要让安装路径和项目路径中出现中文。<br/>
<b>调试不可用</b>：您可能没有创建项目。您需要创建一个工程项目（Project）才能使用调试。<br/>
<b>无法正常调试</b>：关联的编译器设置可能出现问题，在编译器设置中选择-g编译选项。
</div>
<hr>
<h3>Dev C++</h3>
<p>简介：<br/>
Dev C++是一个开源简约d的C/C++集成开发环境。原作者停止开发后Orwell继续开发了后续的Orwell Dev-C++版本。是一个适用于新手和便捷开发人士的简约但强大的开发环境。</p>
<p>安装：<br/>
软件支持Windows，FreeBSD操作系统。<br/>
官方提供自带编译器的版本和不带编译器的版本，前者安装后可直接使用，后者需要手动配置编译器。<br/>
安装过程中选择英文，安装完毕后的首次运行向导选择简体中文即可使用中文。<br/>
如果您使用不带编译器的安装版本，您需要先依次安装GCC、GDB然后再安装使用。</p>
<p>下载地址：<br/>
<a href="http://sourceforge.net/projects/orwelldevcpp/">【官网地址】</a>
<a href="http://chenxuefeng.net.cn/2015/02/3048.html">【其他地址】</a>
</p>
<p>
使用方法：
（创建一个新的控制台程序项目）<br/>
安装完成后直接新建代码文件即可使用。<br/>
亦可选择 文件->新建->项目 创建控制台程序。
</p>
<div class="alert alert-warning" role="alert">
常见问题：<br/>
<b>如何进行调试</b>：DevCpp的调试功能并不强大，一切几乎都需要手动完成。在下方的调试选项中查看具体功能，另外需要掌握一定gdb命令调试技巧。新版本的调试功能略有优化。
</div> 
<hr>
其余待添加...
	  
<?php require_once("oj-footer.php");?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>
