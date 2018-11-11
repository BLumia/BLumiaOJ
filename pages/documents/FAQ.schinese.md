# 常见问题

<!-- 您可以适当编辑该段文字以使得它与您 OJ 的实际情况对应 -->

有问题要问？下面是一些常见的问题，也许下面的答案对你有所帮助。

---------------------------------

### 判题系统如何编译我所提交的代码？

我们在 Linux 操作系统下运行判题系统，我们使用 GNU GCC / G++ 来编译 C / C++ 代码，使用 Free Pascal 来编译 pascal 代码, 以及使用 sun-java-jdk 来编译 java 代码。我们使用的编译指令是：

语言	                | 编译参数
------------------------|-----------------------------
C						| gcc Main.c -o Main -fno-asm -O2 -Wall -lm --static -std=c99 -DONLINE_JUDGE
C++						| g++ Main.cc -o Main -fno-asm -O2 -Wall -lm --static -DONLINE_JUDGE
Pascal					| fpc Main.pas -oMain -O1 -Co -Cr -Ct -Ci
Java*					| javac -J-Xms32m -J-Xmx256m Main.java

*请注意， Java 在判题时具有两秒的额外运行时间和 512M 的额外运行内存。

### 我应该怎样处理输入输出？

你的程序总是应该从 __标准输入__ 处理输入并输出到 __标准输出__ 。例如，你可以在 C 语言中使用 `scanf` ，在 C++ 中使用 `cin`.

你不可以直接操作文件，否则你将得到 `运行时错误`。

### 使用 C / C++ 时如何处理 64 位整形变量的输入和输出？

你应当使用 `%lld` 或 `%llu` .

### 为何我在我的电脑可以正常编译，提交代码却得到了编译错误？

也许你在使用和该判题系统不同的编译器，或者使用了不同的编译参数或标准。你可以作一个快速的问题检查，检查你的代码有没有如下问题：

 - `main` 函数必须返回 `int` 类型.
 - `itoa` 不是一个 ANSI C 标准函数.
 - `__int64` 不是一个 ANSI C 标准类型. 你应该使用 `long long` 来替代它.

你也可以直接查看我们返回的编译错误信息来查看错误原因。

### 那些判题状态的含义是什么？

判题状态		| 含义
----------------|----------
提交中			| 你的提交正在排队等待判题
等待重判		| 因为一些原因，系统将对该提交进行重(Chóng)判
编译中			| 你的代码正在被编译
判题中			| 判题系统正在检验您提交的答案是否正确
答案正确		| 你解决了这道问题
格式错误		| 你的答案在格式上与正确答案有所偏差，例如，你的答案漏掉了一个空格等格式问题
答案错误		| 你的答案不正确 (注意: 有时一些严重的格式问题也会被判为答案错误而不是格式错误)
时间超限		| 你的程序运行时间超过了题目限制
内存超限		| 你的程序运行内存超过了题目限制
输出超限		| 你的程序输出的答案过长（超过了正确答案长度的两倍）
运行时错误		| 你的程序出现了运行时错误，通常可能是你试图使用被禁止的函数或者数组下标越界等原因导致
编译失败		| 我们无法成功编译你提交的代码，试试检查代码是否有语法错误或者你是否错误选择了提交的语言

### 问题页面中每行前面的那些符号是什么意思？

图标                       | 含义 
---------------------------|-----------------------------
<i style='color: green;' class='fa fa-check'/> | 当前登陆用户 __已经解决__ 的问题
<i style='color: orange;' class='fa fa-dot-circle-o'/> | 当前登陆用户 __尝试解决过__ (但没有解决) 的问题
<i class='fa fa-clock-o'/> | 问题 __在某个尚未开始的竞赛中__ 被使用 (仅管理员可见)
<i class='fa fa-lock'/>    | 问题被 __锁定__ (隐藏) (仅管理员可见)

### BBCode 是什么? 应该怎样在讨论版中使用它？

BBCode ，全称 Bulletin Board Code 是一种特殊的标记。UBB代码很简单，但可以方便用户在论坛等位置使用链接/加粗字体等常见富文本功能。所以我们引入了这种代码支持。

以下是在该讨论版中所支持的部分 BBCode

BBCode                  | 对应含义
------------------------|-------------------
[b]加粗文字[/b]			| __加粗文字__
[i]斜体文字[/i]			| _斜体文字_
[u]下划线文字[/u]		| <u>下划线文字</u>
[del]删除线文字[/del]	| ~~删除线文字~~
[br]					| 换行符，和 HTML 中的 &lt;br&gt; 效果一致
[hr]					| 分割线符, 和 HTML 中的 &lt;hr&gt; 效果一致
[url]https://g.cn[/url] | 可点击的链接. 例如: [https://g.cn](https://g.cn)
[url=https://g.cn]Google[/url] | 带文字的可点击链接. 例如: [Google](https://g.cn)
[h1]一级大标题[/h1]		| 标题标记. 你可以使用 `h1` 到 `h6` 使用六种不同级别的标题.
[code]你的代码[/code]	| 在 [code] 标签中粘贴你的代码，可以得到带高亮的代码

### 讨论版前面的头像是什么？我的为什么是奇怪的图案？如何修改这个头像？

很多网站都有使用一个叫做 Identicon 的头像生成策略，可以根据不同的用户的一些信息来生成一个特别的头像，以便于网页浏览者可以更方便的区分不同的没有设置头像的人。我们在讨论版也使用了这种策略。当你浏览讨论版的环境可以访问广域网的时候，我们会使用你的邮箱作为特征来向 [gravatar](http://cn.gravatar.com/) 发出请求来得到一个特定的头像。如果你所处的环境无法访问广域网，我们则会使用 OJ 自带的 Identicon 生成策略来生成一个头像以供显示。

因为我们使用了 gravatar 作为广域网时的头像获取位置，这就意味着你可以通过登陆 [gravatar](http://cn.gravatar.com/) ，关联邮箱并修改你的头像以达到自定义头像的目的，这时，只要能够访问广域网的用户就都能够正常的看到你独一无二的自定义头像，而不是我们根据你的邮箱生成的随机特征头像了。当然，这也意味着你的 OJ 账户的邮箱必须填写正确。

---------------------------------

# 关于此在线评测系统

<!-- 如有需要，您可以根据实际情况编辑该段文字 -->

该在线评测系统基于 [BLumiaOJ](https://github.com/BLumia/BLumiaOJ/), 由该站点维护者进行维护.

该在线评测系统 (不含判题部分) 是使用 PHP 编写的. 支持 PHP 7 并且完全与 HUSTOJ 兼容.

该在线评测系统 使用 [MIT 协议](https://github.com/BLumia/BLumiaOJ/blob/master/LICENSE) 并开源在 [GitHub](https://github.com/BLumia/BLumiaOJ/).

我们使用了一些开源软件来进行该系统的开发，它们是：

 - [HUSTOJ](https://github.com/zhblue/hustoj) 我们使用了 HUSTOJ 的判题核心并使用了部分代码使得该系统与 HUSTOJ 兼容。
 - [Bootstrap 3](https://getbootstrap.com/) 我们使用了 Twitter 公司的 bootstrap 3 来构建前端页面.
 - [jQuery](https://jquery.com/) 我们使用 jQuery 来更方便的直接操作 DOM 以及使用网络异步加载内容.
 - [Code Prettify](https://github.com/google/code-prettify) 我们使用 Google 的 Code Prettify 来进行代码高亮.
 - [Highcharts](https://www.highcharts.com/) 我们使用 Highcharts 来展示图表（注意，这是非自由软件）.
 - [FontAwesome](http://fontawesome.io/) 我们使用 FontAwesome 的图标提高用户体验.
 - [NProgress](https://ricostacruz.com/nprogress/) 我们使用 NProgress 来提示用户部分页面的加载情况.
 - [Summernote](http://summernote.org/) 我们使用 Summernote 作为后台的富文本编辑器
 - [Simple HTML Dom](http://simplehtmldom.sourceforge.net/) 我们使用 Simple HTML Dom 以在后端处理 DOM.
 - [Paresdown](https://github.com/erusev/parsedown) 我们使用 Parsedown 来解析 markdown 并展示.
 - [Bootswatch](https://bootswatch.com/) 我们使用的 bootstrap 主题来自 Bootswatch
 - [JasnyBootstrap](http://www.jasny.net/bootstrap/) 我们使用该插件作为后台的部分组件.
 
感谢开源软件的力量使得该在线评测系统变得更好.

同时，我们也感谢所有参与了该在线评测平台开发的人员，你可以在 [这里](https://github.com/BLumia/BLumiaOJ/blob/master/AUTHORS) 得到一个包含所有代码贡献者的名单。
 
<script>
$("table").addClass("table table-hover");
</script>