<?php
	/************* Off Canvas **************/
	const LA_BKSTAGE_ADMIN		= "管理后台";
	const LA_PROB_EDITOR		= "问题编辑";
	const LA_PROB_LIST			= "问题列表";
	const LA_PROB_MAN			= "管理问题";
	const LA_DATA_MAN			= "管理数据";
	const LA_CONT_EDITOR		= "比赛编辑";
	const LA_CONT_MAN			= "比赛管理";
	const LA_CONT_ADD			= "添加竞赛";
	const LA_CONT_LIST			= "竞赛列表";
	const LA_NEWS_MAN			= "管理新闻";
	const LA_CAST_MAN			= "管理广播";
	const LA_RESET_PSW			= "重置密码";
	const LA_ACCOUNT_GEN		= "账号生成器";
	const LA_PAGE_MODIFIER		= "页面编辑";
	const LA_USER_MGR			= "用户管理";
	const LA_PRIVILEGE_MAN		= "权限管理";
	const LA_SUPER_USER			= "最高权限";
	const LA_EXIT_ADMIN			= "退出管理页面";
	/************* Index **************/
	const LA_WELCOME			= "欢迎";
	const LA_INDEX_LEAD			= "要开始管理，请点击<b>此页面左侧的侧边菜单</b>中的链接。";
	const LA_INDEX_MORE			= "如果您在使用移动设备（平板，智能手机等），你应该点击页面左上角的按钮展开菜单<br/>以下为该平台的属性信息，若要修改这些属性，请修改OJ目录<code>include</code>文件夹下的<code>config.php</code>配置文件。";
	const LA_PROPERTY			= "属性";
	const LA_STATUS				= "状态";
	const LA_YES				= "是";
	const LA_NO					= "否";
	const LA_DEFAULT_CFG		= "使用默认示例配置文件";
	const LA_DEFAULT_CFG_HELP	= "我们建议您复制 <code>include</code> 文件夹中的 <code>config.sample.php</code> 为 <code>config.php</code> 并修改它，以配置该在线评测系统.";
	const LA_MAGIC_QUOTE_WARN	= "<code>magic_quotes_gpc</code> 当前状态为 <b>开启</b>, 这个已弃用的选项会造成代码提交时被添加额外的转义符号并导致编译失败, 请在 <code>php.ini</code> 中关闭该选项并重启您的http服务或升级您的 PHP 版本以解决该问题. (<a href='https://secure.php.net/manual/zh/security.magicquotes.disabling.php'>了解应该怎么做</a>)";
	const LA_HACKER_ROCKS		= "恭喜入侵后台成功！翻滚吧，牛宝宝！";
	const LA_SHOW_WA_INFO		= "是否显示答案错误对比";
	const LA_ENABLED_LANG		= "默认可提交的编程语言";
	const LA_CODE_SUBMIT_LIMIT	= "代码提交最小间隔时间";
	const LA_DO_LOCK_RANKLIST	= "竞赛后期是否锁定排名";
	const LA_LOCK_RANKLIST_PCT	= "竞赛锁定排名时间比例";
	/************* Contest Management Page **************/
	const LA_CONTLIST_HEAD		= "您可以从这里开始进行竞赛的添加和管理。";
	const LA_MORE_OPTIONS		= "更多选项";
	const LA_U_ARE_EDITING		= "您正在编辑";
	/************* Test Case Editor **************/
	const LA_TEST_DATA			= "测试数据";
	const LA_EDIT_DATA			= "编辑数据";
	const LA_TCE_LEAD			= "在这里编辑问题的测试数据。<br/>若要对问题进行编辑和其他针对某个问题的操作，请进入“问题列表”。";
	const LA_DELETE_DATA		= "删除测试数据";
	const LA_DELETE_WARNING		= "确认要删除";
?>