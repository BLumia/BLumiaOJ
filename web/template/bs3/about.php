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
  </head>

  <body>

    <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
<div class="page-header">
  <h1>关于在线评测系统 <small>About Online Judge System</small></h1>
</div>
<p>在线评测系统（Online Judge系统，简称OJ）是提供给编程学习者在线判断代码正确与否的工具平台，用户可以在线提交程序多种程序（如C、C++、Pascal）源代码，系统对源代码进行编译和执行，并通过预先设计的测试数据来检验程序源代码的正确性。</p>


<h3>判题系统相关问答<small><a data-toggle="collapse" href="#LiuChch" aria-expanded="false" aria-controls="LiuChch">
  (戳我展开)
</a></small></h3>
<div class="well <?php echo (isset($_GET['FAQ'])?"collapse in":"collapse");?>"  id="LiuChch">
<p><font color="green">Q</font>:这个在线裁判系统使用什么样的编译器和编译选项?<br>
  <font color="red">A</font>:系统运行于<a href="http://www.debian.org/">Debian</a>/<a href="http://www.ubuntu.com">Ubuntu</a> Linux. 使用<a href="http://gcc.gnu.org/">GNU GCC/G++</a> 作为C/C++编译器, <a href="http://www.freepascal.org">Free Pascal</a> 作为pascal 编译器 ，用 <a href="http://www.oracle.com/technetwork/java/index.html">sun-java-jdk1.6</a> 编译 Java. 对应的编译选项如下:<br>
</p>
<table border="1">
  <tbody><tr>
    <td>C:</td>
    <td><font color="blue">gcc Main.c -o Main  -fno-asm -O2 -Wall -lm --static -std=c99 -DONLINE_JUDGE</font></td>
  </tr>
  <tr>
    <td>C++:</td>
    <td><font color="blue">g++ Main.cc -o Main  -fno-asm -O2 -Wall -lm --static -DONLINE_JUDGE</font></td>
  </tr>
  <tr>
    <td>Pascal:</td>
    <td><font color="blue">fpc Main.pas -oMain -O1 -Co -Cr -Ct -Ci </font></td>
  </tr>
  <tr>
    <td>Java:</td>
    <td><font color="blue">javac -J-Xms32m -J-Xmx256m Main.java</font>
    <br>
    <font color="red" size="-1">*Java has 2 more seconds and 512M more memory when running and judging.</font>
    </td>
  </tr>
</tbody></table>
<p>  编译器版本为（仅供参考）:<br>
  <font color="blue">gcc (Ubuntu/Linaro 4.4.4-14ubuntu5) 4.4.5</font><br>
  <font color="blue">glibc 2.3.6</font><br>
<font color="blue">Free Pascal Compiler version 2.4.0-2 [2010/03/06] for i386<br>
java version "1.6.0_22"<br>
</font></p>
<p><font color="green">Q</font>:程序怎样取得输入、进行输出?<br>
  <font color="red">A</font>:你的程序应该从标准输入 stdin('Standard Input')获取输出 并将结果输出到标准输出 stdout('Standard Output').例如,在C语言可以使用 'scanf' ，在C++可以使用'cin' 进行输入；在C使用 'printf' ，在C++使用'cout'进行输出.</p>
<p>用户程序不允许直接读写文件, 如果这样做可能会判为运行时错误 "<font color="green">Runtime Error</font>"。<br>
  <br>
下面是经典的a+b问题的参考答案</p>
<p> C++:<br>
</p>
<pre><font color="blue">
#include &lt;iostream&gt;
using namespace std;
int main(){
    int a,b;
    while(cin &gt;&gt; a &gt;&gt; b)
        cout &lt;&lt; a+b &lt;&lt; endl;
	return 0;
}
</font></pre>
<p> C:<br>
</p>
<pre><font color="blue">
#include &lt;stdio.h&gt;
int main(){
    int a,b;
    while(scanf("%d %d",&amp;a, &amp;b) != EOF)
        printf("%d\n",a+b);
	return 0;
}
</font></pre>
<p> Pascal:<br>
</p>
<pre><font color="blue">
program p1001(Input,Output); 
var 
  a,b:Integer; 
begin 
   while not eof(Input) do 
     begin 
       Readln(a,b); 
       Writeln(a+b); 
     end; 
end.
</font></pre>
<p> Java:<br>
</p>
<pre><font color="blue">
import java.util.*;
public class Main{
	public static void main(String args[]){
		Scanner cin = new Scanner(System.in);
		int a, b;
		while (cin.hasNext()){
			a = cin.nextInt(); b = cin.nextInt();
			System.out.println(a + b);
		}
	}
}</font></pre>

<font color="green">Q</font>:为什么我的程序在自己的电脑上正常编译，而系统告诉我编译错误!<br>
<font color="red">A</font>:GCC的编译标准与VC6有些不同，更加符合c/c++标准:<br>
<ul>
  <li><font color="blue">main</font> 函数必须返回<font color="blue">int</font>, <font color="blue">void main</font> 的函数声明会报编译错误。<br> 
  </li><li><font color="green">i</font> 在循环外失去定义 "<font color="blue">for</font>(<font color="blue">int</font> <font color="green">i</font>=0...){...}"<br>
  </li><li><font color="green">itoa</font> 不是ansic标准函数.<br>
  </li><li><font color="green">__int64</font> 不是ANSI标准定义，只能在VC使用, 但是可以使用<font color="blue">long long</font>声明64位整数。<br>如果用了__int64,试试提交前加一句#define __int64 long long
</li></ul>
<font color="green">Q</font>:系统返回信息都是什么意思?<br>
<font color="red">A</font>:详见下述:<br>
<p><font color="blue">Pending</font> : 系统忙，你的答案在排队等待. <br/>
<font color="blue">Pending Rejudge</font>: 因为数据更新或其他原因，系统将重新判你的答案.<br/>
<font color="blue">Compiling</font> : 正在编译.<br>
<font color="blue">Running &amp; Judging</font>: 正在运行和判断.<br>
<font color="blue">Accepted</font> : 程序通过!<br>
  <br>
  <font color="blue">Presentation Error</font> : 答案基本正确，但是格式不对。<br>
  <font color="blue">Wrong Answer</font> : 答案不对，仅仅通过样例数据的测试并不一定是正确答案，一定还有你没想到的地方.<br>
  <font color="blue">Time Limit Exceeded</font> : 运行超出时间限制，检查下是否有死循环，或者应该有更快的计算方法。<br>
  <font color="blue">Memory Limit Exceeded</font> : 超出内存限制，数据可能需要压缩，检查内存是否有泄露。<br>
  <font color="blue">Output Limit Exceeded</font>: 输出超过限制，你的输出比正确答案长了两倍.<br>
  <br>
  <font color="blue">Runtime Error</font> : 运行时错误，非法的内存访问，数组越界，指针漂移，调用禁用的系统函数。请点击后获得详细输出。<br>
  <font color="blue">Compile Error</font> : 编译错误，请点击后获得编译器的详细输出。<br>
  <br>
</p>
</div>


<h3>迎来新OJ？<small><a data-toggle="collapse" href="#LiuChchShabusha" aria-expanded="false" aria-controls="LiuChchShabusha">
  (戳我展开)
</a></small></h3>
<div class="well <?php echo (isset($_GET['NEWOJ'])?"collapse in":"collapse");?>" id="LiuChchShabusha">
<p>大家都知道，本OJ在不久前迎来了一次更新，那是我们的新OJ吗？事实上来说，他并不是一次“更新”<br/>本在线评测系统是基于开源项目HustOJ的一个在线评测系统，但为了能够有更好的做题体验，我们针对本系统进行了多处改善。而我们最先着手的，就是阅读和修改HustOJ的代码并进行一些完善和修改，于是便有了你眼前的ZZNU OJ。当前的OJ相比之前的版本，除了界面上，并无太多新增功能，所以事实上上次更新并不算是一次大“更新”，只是一些界面和功能完善罢了。<br/>
现在的OJ系统是完全开源的（您可以在下面提供的信息中找到源码），但无论代码上还是功能上都还有诸多缺陷，我们正在尝试将他做的更好。但是，我们只是在做“功能完善”吗？
<br/>
由于旧版HustOJ本身代码风格和其他的诸多原因，基于HustOJ做修改已经不能满足我们的部分需求，所以，我们计划制作新的OJ，以带来更好的体验。也就是说，我们正在制作一个全新的OJ。当然，制作的过程必定很漫长，请大家拭目以待~</p>
<h4>新OJ，我可以做什么：</h4><br/>
<p>在我们的制作过程中，我们尽量会让OJ使用更舒适，更人性化，而我们能想到的可能并不周全。<br/>
所以，如果您对当前OJ有什么意见和建议，您可以在<a href="./feedback.html">反馈板</a>反馈建议给我们。<br/>
当然，如果您是网页制作高手，也欢迎您加入我们的制作团队中来。请联系wzc782970009#qq.com（#替换为@）</p>
</div>
<h3>OJ相关资料</h3>
<p>
当前OJ项目地址: <a href="https://github.com/bLumia/blumiaoj/tree/hustoj_web">GitHub上的位置</a><br/>
新OJ项目地址: <a href="https://github.com/bLumia/blumiaoj">GitHub上的位置</a>
</p>
	  
<?php require_once("oj-footer.php");?>
</div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>
