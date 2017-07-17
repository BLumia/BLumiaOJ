# About BLumiaOJ

<!-- EDIT THIS FILE TO MAKE IT SUITABLE FOR YOUR OJ -->

Thank you for using BLumiaOJ.

BLumiaOJ is an open source, fully rewriten, HUSTOJ compatible, online judge system. Since BLumiaOJ currently doesn't have any back-end judge system, current version of BLumiaOJ only include a full functional website source. It's HUSTOJ compatible, so, if you are using HUSTOJ before, you can try BLumiaOJ on the fly - just throw the website source under your http-server web root, edit the configuration file, and it's done!

Here are some informations for you!

---------------------------------

### Who made this project?

As the name, I'm [@BLumia](https://github.com/BLumia). At somewhere I also use CatStatsD as my name.

But by making this project, there are also a lot of people helps me solving problem. So, I am NOT the only author of this project! Of course, [you can found the full AUTHORS list at here](https://github.com/BLumia/BLumiaOJ/blob/master/AUTHORS)!

We also use a dozen of open source software and 3rd-party libraries, they are:

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

### Why make this project?

Since I help my school maintenancing the online judge system of our ACM/ICPC team, I read the source of HUSTOJ and found it's a little bit messy. Luckly I have some spare time so I decided to rewrite the full OJ system for our school for fun.

I learning PHP since HUSTOJ use it, you can also found the code base's struct is also similar as HUSTOJ because of I exactly learning PHP by reading the HUSTOJ source. Some months later, I did this BLumiaOJ's prototype, with PDO to make it PHP 7 ready, and better administration page. By learning futher, I found some more effective ways to write code, like MVC and other stuff. I think it's not a good idea to rewrite this project again because of I don't always have spare time, but I still decided to make it functional to use, and free to use for everyone. So there you are. I made this HUSTOJ compatible online judge system website.

### Anywhere better than HUSTOJ?

In fact, the code I read before is [zhblue/hustoj](https://github.com/zhblue/hustoj), this is really a messy code if you read this. The goal of BLumiaOJ is better than that one (or I will not decided to rewrite one). Here are a feature list:

 - It's HUSTOJ compatible, NO pain on deploy!
 - PHP 7 ready!
 - PDO for database connection, Not limited in MySql and MariaDB!
 - Better front-end!
 - Configurable!
 - We use MIT licence!

BTW, HUST's student also rewrited one and also open sourced at [freefcw/hustoj](https://github.com/freefcw/hustoj). If you are interested, take a look, maybe the new one is better :D

### Can I modify this project?

Of course! This is an open source project, just follow MIT licence and feel free to edit on your own purpose!

Also, if you just deployed this Online Judge system on your own server and you want to change the text what you are reading, you can create a folder named `custom` at `OJ_PATH/pages/documents/` , copy the `about.md` at `OJ_PATH/pages/documents/` inside the folder you created (`OJ_PATH/pages/documents/custom/`) and modify that file to adapt your need.

### Wanna contribute?

Just refer to [GitHub](https://github.com/BLumia/BLumiaOJ/) and you know what to do!

If you just want use without send a pull request, it's also okay. Just feel free to use, send issues or pull request if you want!

### More Informations?

Anything about BLumiaOJ please refer to [GitHub](https://github.com/BLumia/BLumiaOJ/). You can found installation guide at there. Thanks again for reading this page. Enjoy!
