# 关于 BLumiaOJ

<!-- 您可以适当编辑该段文字以使得它与您 OJ 的实际情况对应 -->

感谢您使用 BLumiaOJ 。

BLumiaOJ 是一个开源的，完全重写的，HUSTOJ 兼容的在线评测系统。由于 BLumiaOJ 当前并不包含判题端，当前版本的 BLumiaOJ 仅仅包含一个完整功能的网页站点源码。由于我们兼容 HUSTOJ ，所以，如果你之前正在使用 HUSTOJ ，你可以即刻立即尝试 BLumiaOJ —— 把代码放在您的网页服务器目录下，修改配置文件，就轻松愉快的完成辣！

这里有一些或许有用的信息。

---------------------------------

### 谁开了这个“坑”?

如这个“坑”的名字，我，[@BLumia](https://github.com/BLumia) ，最初决定开始这个项目。

当然，我并不是这个项目的唯一作者，依然有很多人帮助完成了这个项目，[你可以在这里得到一个作者清单](https://github.com/BLumia/BLumiaOJ/blob/master/AUTHORS)！

我们也使用了很多的开源软件和第三方库来帮助构建这个项目，它们是

 - [HUSTOJ](https://github.com/zhblue/hustoj) 我们使用了 HUSTOJ 的判题核心并使用了部分代码使得该系统与 HUSTOJ 兼容。
 - [Bootstrap 3](https://getbootstrap.com/) 我们使用了 Twitter 公司的 bootstrap 3 来构建前端页面.
 - [jQuery](https://jquery.com/) 我们使用 jQuery 来更方便的直接操作 DOM 以及使用网络异步加载内容.
 - [Code Prettify](https://github.com/google/code-prettify) 我们使用 Google 的 Code Prettify 来进行代码高亮.
 - [Highcharts](https://www.highcharts.com/) 我们使用 Highcharts 来展示图表.
 - [FontAwesome](http://fontawesome.io/) 我们使用 FontAwesome 的图标提高用户体验.
 - [NProgress](https://ricostacruz.com/nprogress/) 我们使用 NProgress 来提示用户部分页面的加载情况.
 - [Summernote](http://summernote.org/) 我们使用 Summernote 作为后台的富文本编辑器
 - [Simple HTML Dom](http://simplehtmldom.sourceforge.net/) 我们使用 Simple HTML Dom 以在后端处理 DOM.
 - [Paresdown](https://github.com/erusev/parsedown) 我们使用 Parsedown 来解析 markdown 并展示.
 - [Bootswatch](https://bootswatch.com/) 我们使用的 bootstrap 主题来自 Bootswatch
 - [JasnyBootstrap](http://www.jasny.net/bootstrap/) 我们使用该插件作为后台的部分组件.

### 为啥要开这个“坑”？

最初，我负责维护我所在学校的 ACM 队所需要使用的校内的在线评测系统，正巧有空闲时间，我就阅读了它（HUSTOJ）的源码，并发现这些代码有些混乱。所幸有些闲暇时间，我就决定重写一套在线评测系统来给学校用，也当练练手。

于是我通过阅读 HUSTOJ 的代码来学了 PHP 的使用，也是因为这个，如果你读过它的代码，你会发现这个项目的代码和它的代码结构是非常的相似的。写了一段时间后，我完成了 BLumiaOJ 的原型，使用 PDO 并支持 PHP 7 ，以及包含更易用的后台。后来，随着更多知识的学习，我发现了更多的好的代码技巧和习惯，比如 MVC 体系架构和其它更多东西。我觉得再次重写这套在线评测系统并不是什么好的主意，所以我决定，将这套在线评测系统做完并开源发布给希望使用的人。于是就有了你所见的这个项目。

### 所以它哪里比 HUSTOJ 棒吗?

实际上，我之前读的代码是 [zhblue/hustoj](https://github.com/zhblue/hustoj), 这份代码的确有些乱，而我的目标也是至少要比它好（否则我也不会打算开坑重写了）。所以下面是一些 BLumiaOJ 的特性:

 - 完全兼容 HUSTOJ , 无痛部署!
 - 支持 PHP 7 !
 - 使用 PDO ，不局限于 MySql 或 MariaDB!
 - 更好看的前端 !
 - 更好配置!
 - 我们以 MIT 协议开源!

顺带一提，HUST 自己后来还有过一个重写版本是 [freefcw/hustoj](https://github.com/freefcw/hustoj). 如果你是要寻找一个好的旧版 HUSTOJ 的替代品，不妨也看看那个项目 :D

### 我可以魔改这份代码吗?

当然! 这是开源项目，只要你遵循宽松的 MIT 协议，你就可以随便改辣!

当然，或许你是刚刚部署好，并且想要修改你正在阅读的这个页面，你可以在 `OJ_PATH/pages/documents/` 路径下建立一个叫做 `custom` 的文件夹，然后将 `OJ_PATH/pages/documents/` 路径下的 `about.md` 文件拷贝到你刚刚新建的文件夹 (`OJ_PATH/pages/documents/custom/`) 内，然后编辑这个文件以适应你自己的需求。

### 想要帮助贡献代码?

转到 [GitHub](https://github.com/BLumia/BLumiaOJ/) 然后你知道该怎么做!

当然，如果你不想把你自己的改动合并进来也是没问题的，能够将我们的代码为你所用，这才是充分的自由啊！

### 其他信息?

任何其他关于 BLumiaOJ 的信息或者问题，请转到 [GitHub](https://github.com/BLumia/BLumiaOJ/). 那里也可以找到一份部署教程. 再次感谢你读这么多. 比心心 <3

