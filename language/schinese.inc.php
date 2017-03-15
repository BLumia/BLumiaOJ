<?php
	/************* Navigation Bar **************/
	const L_OJ		= "在线判题";
	const L_PROB_SET= "问题列表";
	const L_STATUS	= "状态";
	const L_RANKLIST= "排名";
	const L_CONTEST	= "比赛";
	const L_VJ		= "虚拟判题";
	const L_FORUM	= "讨论区";
	const L_SIGNUP	= "注册";
	const L_LOGIN	= "登陆";
	const L_INBOX	= "收件箱";
	const L_MOD_INFO= "修改个人资料";
	const L_USR_PAGE = "个人主页";
	const L_RECENTSUB= "最近提交";
	const L_CTRLPANEL= "后台管理";
	const L_LOGOUT	= "退出登录";
	const L_OVERVIEW= "概览";
	const L_PREV_PAGE= "上一页";
	const L_NEXT_PAGE= "下一页";
	const L_SRC_VIEW= "查看代码";
	const L_ERR_VIEW= "错误详情";
	/*********** Problem Description ***********/
	const L_TITLE 	= "标题";
	const L_DESC  	= "描述";
	const L_SUBMIT	= "提交";
	const L_EDIT	= "编辑";
	const L_CODE_SUBMIT	= "代码提交";
	const L_TIME_LIMIT = "时间限制";
	const L_MEM_LIMIT = "内存限制";
	/************* Contest **************/
	const L_START_TIME	= "开始时间";
	const L_END_TIME	= "结束时间";
	const L_CONTEST_ID	= "比赛编号";
	const L_CONTEST_DESC = "竞赛描述";
	const L_CONTEST_INFO = "竞赛信息";
	/************* Contest Status **************/
	const L_LeftTime= "剩余时间";
	const L_Running	= "进行中";
	const L_Public	= "公开";
	const L_Private	= "私有";
	const L_Ended	= "已结束";
	const L_Start	= "开始于";
	const L_Not_Start	= "尚未开始";
	/************* Hint Statement **************/
	const L_CONTEST_NOT_AUTH	= "您没有权限参加该竞赛";
	const L_NO_SUBMIT_RECORD	= "没有可展示的数据，先去写道 A+B 吧 :)";
	const L_WEEKY_SUBMIT_N_AC	= "最近一周内提交情况";
	const L_THREAD_HELP	= "可以在回复中使用UBB代码高亮。更多讨论版使用帮助请参见FAQ页面";
	const L_RANKLIST_LOCKED = "锁榜时间已到，榜单不再更新，请把握好最后的时间，祝你好运！";
	/************* Judge Status *****************/
	const L_JUDGE_PD = "提交中..";
	const L_JUDGE_PR = "等待判题";
	const L_JUDGE_CI = "编译中..";
	const L_JUDGE_RG = "判题中..";
	const L_JUDGE_AC = "答案正确";
	const L_JUDGE_PE = "格式错误";
	const L_JUDGE_WA = "答案错误";
	const L_JUDGE_TLE = "时间超限";
	const L_JUDGE_MLE = "内存超限";
	const L_JUDGE_OLE = "输出超限";
	const L_JUDGE_RE = "运行时错误";
	const L_JUDGE_CE = "编译失败";
	const L_JUDGE_TR = "测试运行";
	/************* Program Page *****************/
	const L_PROB_DESC = "题目描述";
	const L_INPUT	= "输入";
	const L_OUTPUT	= "输出";
	const L_SAMP_INPUT = "样例输入";
	const L_SAMP_OUTPUT = "样例输出";
	const L_HINT	= "提示";
	const L_TAG		= "标签";
	const L_SOURCE	= "来源";
	const L_DIFFICUTY = "难度";
	/************* Mail Page *****************/
	const L_SEND	= "发送";
	const L_CLEAR	= "清空";
	const L_CONTENT	= "内容";
	const L_SEND_TO	= "收件人ID";
	const L_WRITE_NEW_MAIL	= "创建新站内信";
	/************* Register ****************/
	const L_PLZ			= "请";
	const L_UID			= "用户ID";
	const L_NICK		= "昵称";
	const L_PSW			= "密码";
	const L_PSW_AGAIN	= "再次输入密码";
	const L_SCHOOL		= "学校";
	const L_EMAIL		= "电子邮箱";
	const L_AGREE_EULA	= "同意 最终用户许可协议";
	const L_UID_DV_MSG	= "用户ID 长度应当超过 3 个字符.";
	const L_PSW_DV_MSG	= "密码应当至少包括 6 个字符.";
	const L_PSW2_DV_MSG	= "两次输入的密码不匹配";
	/************* User Page ***************/
	const L_USER_PAGE	= "用户页面";
	const L_USER_INFO	= "用户信息";
	const L_ORI_PSW		= "原密码";
	const L_NEW_PSW		= "新密码 (不修改则不填写)";
	const L_NEW_PSW_AGAIN= "再次输入新密码";
	const L_MODIFY_INFO	= "修改信息";
	const L_SOLVED		= "已解决";
	const L_CHALLENGED	= "已挑战";
	const L_NOT_EDITABLE= "不可修改";
	/************* Ranklist ***************/
	const L_RANK	= "排名";
	const L_PASSRATE= "通过率";
	/************* Forum ***************/
	const L_THREADLIST	= "主题列表";
	const L_THREAD		= "主题帖";
	const L_LASTREPLY	= "最后回复";
	const L_POST	= "发帖";
	const L_REPLY	= "回复";
	const L_PROBLEM	= "问题";
	const L_LOCK	= "锁定主题";
	const L_UNLOCK	= "取消锁定";
	const L_LOCKED	= "已锁定";
	const L_STICKY	= "置顶主题";
	const L_TOP_0	= "取消置顶";
	const L_TOP_1	= "置顶";
	const L_TOP_2	= "区置顶";
	const L_TOP_3	= "总置顶";
	const L_DELETE_THREAD = "删除主题";
	const L_PROBLEM_DISCUSS	= "问题讨论";
	const L_GOTO_PROBLEM = "转到问题";
	const L_MUST_LOGIN_TO_POST = "您必须登陆以发表主题。";
	const L_MUST_LOGIN_TO_REPLY = "您必须登陆以发表回复。";
	const L_LOCKED_FOR_EDIT = "该回复被建议修改，故已锁定。";
	/************* Misc *****************/
	const L_OR		= "或";
	const L_OK		= "好的";
	const L_GO		= "走起";
	const L_ALL		= "所有";
	const L_DATE	= "日期";
	const L_HELP	= "帮助";
	const L_LANG	= "语言";
	const L_CLOSE	= "关闭";
	const L_RESULT	= "结果";
	const L_DELETE	= "删除";
	const L_WARNING = "警告";
	const L_DOWNLOAD= "下载";
	const L_UPLOAD	= "上传";
	const L_CHANGE	= "更换";
	const L_REMOVE	= "移除";
	const L_OTHER	= "其它";
	const L_MANAGEMENT = "管理";
	const L_SELECT_FILE	= "选择文件";
	const L_INFOLABEL = "【提示信息】";
?>