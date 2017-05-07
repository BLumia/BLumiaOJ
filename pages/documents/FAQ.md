# Frequently Asked Questions

<!-- EDIT THIS FILE TO MAKE IT SUITABLE FOR YOUR OJ -->

Looking for help? Below is some frequently asked questions. Maybe these answer helps.

---------------------------------

### How does this online judge system compile submited code?

We are running our judger under linux and use GNU GCC / G++ for compile C / C++ code, Free Pascal for compile pascal code, and sun-java-jdk to compile java code. compiler parameters are:

Language                | Compiler parameter
------------------------|-----------------------------
C						| gcc Main.c -o Main -fno-asm -O2 -Wall -lm --static -std=c99 -DONLINE_JUDGE
C++						| g++ Main.cc -o Main -fno-asm -O2 -Wall -lm --static -DONLINE_JUDGE
Pascal					| fpc Main.pas -oMain -O1 -Co -Cr -Ct -Ci
Java*					| javac -J-Xms32m -J-Xmx256m Main.java

*Notice that Java has 2 more seconds and 512M more memory when running and judging.

### How can I process input data and where should I do with output?

Your program should always read data from __standard input__ and output to __standard output__ . As an example, you can use `scanf` in C and `cin` in C++ for input.

You can't operate a file directly, if you did, you will get a `Runtime Error`

### How to process 64 bit integer in C / C++ ?

You should use `%lld` or `%llu` .

### Why I can compile my code in my computer, but I get a Compile Error in this OJ ?

Maybe you are using a different compiler OJ that is not the same as this OJ or you are not using the same standard as this OJ. For a quick check, you can take a look at:

 - `main` function must return `int` type.
 - `itoa` is not an ANSI C standard function.
 - `__int64` is not an ANSI C standard type. use `long long` instead.

You can also check the compile error log of your submit to know the error detail. 

### What's the meaning of the judge status text ?

Judge Status	| Meaning
----------------|----------
Pending			| Your submit is queueing (pending) for judge.
Pending Rejudge | For some reason, system are rejudgeing your submit.
Compiling		| Your code is now compiling
Running & Judgeing | Your code is running for judge.
Accepted		| You pass all test data, your submit solved this problem.
Presentation Error | Your output answer may have some mistake on output format, i.e. you may lose a space character or etc.
Wrong Answer	| Your output answer is not correct (Notice: sometimes data format error still judged as Wrong Answer than Presentation Error)
Time Limit Exceeded | Your program run out of the problem specify time limit.
Memory Limit Exceeded | Your program run out of the problem specify memory limit.
Output Limit Exceeded | Your program output is quite big that two times longer than the correct answer.
Runtime Error | Your program get a runtime error, you may trying to access forbidden functions or your array index is out-of-bound, etc.
Compile Error | We can't compile your code, check your code or if you mis-select the wrong language before submit.

### What's the meaning of the symbols in front of a problem in Problem List page ?

Icon                       | Meaning 
---------------------------|-----------------------------
<i style='color: green;' class='fa fa-check'/> | __Accepted__ (solved) by current login user
<i style='color: orange;' class='fa fa-dot-circle-o'/> | Current login user are __challenging__ (trying to solved) this problem
<i class='fa fa-clock-o'/> | Problem __under contest__ (Only Problem Managers can see this problem)
<i class='fa fa-lock'/>    | __Locked__ (hidden) problem (Only Problem Managers can see this problem)

### What's BBCode? How to use them in the discuss forum?

BBCode or Bulletin Board Code is a lightweight markup language used to format posts in many message boards. The available tags are usually indicated by square brackets ([ ]) surrounding a keyword, and they are parsed before being translated into pretty-looked HTML to make you read confortable.

Here are some BBCode tags that we support in this discuss forum.

BBCode                 | Output display or meaning of the BBCode
-----------------------|-------------------
[b]bolded text[/b]     | __bolded text__
[i]italicized text[/i] | _italicized text_
[u]underlined text[/u] | <u>underlined text</u>
[del]deleted text[/del]| ~~deleted text~~
[br]				   | inserts a single line break, worked as &lt;br&gt; in HTML
[hr]				   | inserts a single horizontal rule, worked as &lt;hr&gt; in HTML
[url]https://g.cn[/url] | Clickable link. Works as: [https://g.cn](https://g.cn)
[url=https://g.cn]Google[/url] | Clickable link with text. Works as: [Google](https://g.cn)
[h1]Level 1 Heading[/h1] | heading mark. Also, from `h1` to `h6` you can use six level of heading.
[code]source code[/code] | Paste your source code between a [code] label, can output a highlighted source code

### Why I got a weird icon/avatar in discuss forum? How to custom my icon/avatar?

Many sites, like GitHub, StackOverflow, use a kind of technology called __Identicon__ to generate user avatar from a special hash(usually E-mail, IP address or user id). That's a way to let other user can easier identify different user who didn't set their own avatar. So we use this "technology", too. If user can access gravatar.com, they can see a identicon generated by gravatar. If user can't access gravatar.com, they will get an identicon generated by the OJ.

Since we use [gravatar](https://gravatar.com/) to generate identicon, you can actually register an account at gravatar site and associate your e-mail. Then you can set a custom icon/avatar for your account, then other user will see the icon you set, not an identicon we generated - as far as you set the correct e-mail.

---------------------------------

# About This Online Judge System

<!-- Feel free to edit this part if you feel generous -->

This online judge system is powered by [BLumiaOJ](https://github.com/BLumia/BLumiaOJ/), and maintenance by this site owner.

This online judge system (without the judger part) is written in PHP. This online judge system is PHP 7 ready and it is fully compitiable with HUSTOJ.

This online judge system is [OPEN SOURCE at GitHub](https://github.com/BLumia/BLumiaOJ/) and licenced under [MIT licence](https://github.com/BLumia/BLumiaOJ/blob/master/LICENSE).

We use a list of open source softwares to make this online judge. They are:

 - [HUSTOJ](https://github.com/zhblue/hustoj) We use the judge core from HUSTOJ by zhblue and use some of code to make this OJ compitiable with it.
 - [Bootstrap 3](https://getbootstrap.com/) We use bootstrao 3 by Twitter Inc. to construct the font-end page.
 - [jQuery](https://jquery.com/) We use jQuery to boost the js DOM operations and network operations.
 - [Code Prettify](https://github.com/google/code-prettify) We use Code Prettify by Google to make code looks pretty.
 - [Highcharts](https://www.highcharts.com/) We use Highcharts to display charts.
 - [FontAwesome](http://fontawesome.io/) We use icons from FontAwesome.
 - [NProgress](https://ricostacruz.com/nprogress/) We use this to display page load status on some pages.
 - [Summernote](http://summernote.org/) We use Summernote as the text editor in the admin page.
 - [Simple HTML Dom](http://simplehtmldom.sourceforge.net/) We use this to process html dom in server side.
 - [Paresdown](https://github.com/erusev/parsedown) We use this to parse markdown documents and display it.
 - [Bootswatch](https://bootswatch.com/) We use the bootstrap theme from Bootswatch
 - [JasnyBootstrap](http://www.jasny.net/bootstrap/) We use this as some componment in the admin page.
 
Thanks the open source power to make this online judge system success.

Also, we thanks all the peoples who contributed code to this online judge system. To get a list of authors about contributer, see the contributer list [here](https://github.com/BLumia/BLumiaOJ/blob/master/AUTHORS).
 
<script>
$("table").addClass("table table-hover");
</script>