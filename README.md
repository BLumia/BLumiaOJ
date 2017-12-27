# BLumiaOJ

HUSTOJ Web 重写版本

[English](https://github.com/BLumia/BLumiaOJ/wiki)

## 请注意

如果想要部署，请仔细阅读下面的 "部署和简要说明" 部分。  
如果您已部署，建议您 watch 该 repo ，以便接收更新和 BUG 修复的邮件和消息提醒。  
如果您有任何疑问，请开 issue 。

## 概述

HUSTOJ Web 完全重写版本。支持 PHP 7 ，更易用的前端交互，新增部分实用功能，提高代码可读性和可维护性。

## 预览

如果您需要预览，您可以在[这里（腾讯云位置）](https://oj.blumia.cn/)看到新评测系统的预览状况。

## 部署和简要说明

当前版本已经具备了 HUSTOJ 原版的大部分功能，但没有完整测试，如果您发现任何问题，请开 Issue 汇报。如果您希望部署，参与开发或仅仅想要体验效果，可以参考下面的一小段帮助。

如果您已经部署好了可用的 HUSTOJ ，您可以直接将 HUSTOJ 网页后端所在的路径（通常可能在 `/var/www/html/JudgeOnline` ）下的所有代码文件 __直接替换__ 为本 repo 的所有代码文件。如果您希望保留您原有的 HUSTOJ 安装，您亦可将本 repo 放在其它任意位置。之后，您需要复制本 repo 的 `include` 文件夹内的 `config.sample.php` 为 `config.php` 并根据您原有的 HUSTOJ 配置文件（即 `db_info.inc.php` ）来编辑该配置文件，保存后，如果配置正确，就可以直接使用 BLumiaOJ 了。

如果您之前尚未部署过 HUSTOJ ，您可以选择通过 [GitHub:zhblue/hustoj](https://github.com/zhblue/hustoj) 给出的方法来部署 HUSTOJ ，并在之后根据上述方式部署 BLumiaOJ （推荐的做法），也可以尝试自己直接安装 BLumiaOJ 。如果您希望自行安装，以下有一些参考内容：

- [GitHub:BLumia/BLumiaOJ-Installation-Helper](https://github.com/BLumia/BLumiaOJ-Installation-Helper) 该 repo 提供了一个 BLumiaOJ 的安装脚本，以便于快速部署，但该脚本仅仅可用于 debian 8 ，并且没有测试是否一定可以正常工作。
- [GitHub:BLumia/HUSTOJ-Core](https://github.com/BLumia/HUSTOJ-Core) 该 repo 是 HUSTOJ 所使用的判题核心的人工同步的镜像 repo 。如果您不希望克隆完整的 HUSTOJ 的 repo 来获得判题部分的代码（因为其依然使用 SVN 的文件结构，故比较肥大），可以使用该 repo 。
- [GitHub:zhblue/hustoj HUST JOL安装说明](https://github.com/zhblue/hustoj/tree/master/trunk/install) HUSTOJ 给出的用于 HUSTOJ 的手动安装说明。

BLumiaOJ 需要您的 PHP 版本至少在 PHP 5.1 以上（由于使用了 `PDO` ），大部分情况下您只需将所有代码文件放在您的支持 PHP 的 http 服务路径下即可正常运行，但另有一些其它内容需要注意。如果您使用了较早的 HUSTOJ Live CD 来安装 BLumiaOJ 或者您使用了较早版本的 PHP 版本（5.4.0之前的版本），您可能需要检查 `php.ini` 中 `magic_quotes_gpc` 选项的值是否为 `off` 。您也可以登陆管理后台首页查看是否存在警告提示以确认这些内容是否配置正确（配置正确则不会显示任何警告）。

无论何种安装方式，您需要注意的是确保您的判题核心能够正常工作（虽然这和 BLumiaOJ 并没有关系）。 BLumiaOJ 本身没有任何额外的部署要求，故只需放置到您想要的地方并配置好您的 Apache / Nginx / 任何其它支持 PHP 的 http 服务器下，并正确配置 BLumiaOJ 所需的配置文件（ `config.php` ，上述）即可。本人测试时的环境为判题部分直接操作 MySQL ，故尚不清楚 HTTP Judge 是否正常工作，如果您使用 HTTP Judge ，配置正确但发现 BLumiaOJ 不能正常工作（无法判题），欢迎 [创建新的 Issue 汇报问题](https://github.com/BLumia/BLumiaOJ/issues/new) 或 fork 后修改问题并提交 Pull Request 。

本 OJ 相较 HUSTOJ 的功能部分尚未完成的部分有：

- 问题导出为 FreeProblemSet XML
- 内建论坛（discuss）不能对帖子的回复进行管理操作（API存在，前端还没写）

目前版本相较 HUSTOJ 的不同有：

- 使用 PDO 操作数据库，支持更新版本的 PHP
- 重新整合的论坛部分
- 更易用的后台管理
- 问题标签关联（WIP）

额外的，如果您已经部署好 HUSTOJ 并打算将本 repo 的代码 clone 到您的 `WWW_PATH` 以达到便于部署和升级的目的的话，建议您建立一条额外的规则来实现屏蔽对 `.git` 目录的访问。本 repo 提供了适用于 Apache 的 `.htaccess` 规则，您可以选择使用该规则，启用方法为修改 `apache2.conf` （您的发行版上， Apache 的配置文件也可能叫 `httpd.conf` 或其它名字），修改该在线评测系统的 `AllowOverride None` 选项为 `AllowOverride All`。

## 参与开发

如果您曾经阅读过 [GitHub:zhblue/hustoj](https://github.com/zhblue/hustoj) 的代码，那么阅读本 repo 的代码应该没有问题。因为本 repo 是在阅读并魔改 HUSTOJ 代码一段时间后才决定完全重写的，故代码结构上受 HUSTOJ 本身结构影响，几乎是相同的。如果您之前没有阅读过 HUSTOJ 的代码也不必担心，本项目本身没有使用任何复杂的惯用设计模式结构，您只需要顺着该 repo 根目录下的任一 php 文件阅读下去就可以了，本身很意大利面条，所以读起来很快。

如果您希望参与开发，欢迎 fork 后修改并提交 Pull Request ，或者，只是汇报问题或提出建议，也欢迎开 Issue ~


