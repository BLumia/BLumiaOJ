
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<h1 class="text-center"><?php echo $problemItem[0]['problem_id']." : ".$problemItem[0]['title'];?></h1>
			<p class="text-center">
				时间限制:<span class="label label-primary"><?php echo $problemItem[0]['time_limit']." Sec";?></span>
				内存限制:<span class="label label-primary"><?php echo $problemItem[0]['memory_limit']." MiB";?></span><br/>
				提交:<span class="label label-info"><?php echo $problemItem[0]['submit'];?></span>
				正确:<span class="label label-success"><?php echo $problemItem[0]['accepted'];?></span>
			</p>
			<p class="text-center">
				<a class="btn btn-default" href="#" role="button">Submit</a>
				<a class="btn btn-default" href="#" role="button">Status</a>
				<a class="btn btn-default" href="#" role="button">Edit</a>
			</p>
			
			<h3><a data-toggle="collapse" data-target="#problemDesc">题目描述</a></h3>
			<div class="collapse in" id="problemDesc" aria-expanded="true">
				<div class="well">
					<?php echo $problemItem[0]['description'];?>
				</div>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#problemInput">输入</a></h3>
			<div class="collapse in" id="problemInput" aria-expanded="true">
				<div class="well">
					<?php echo $problemItem[0]['input'];?>
				</div>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#problemOut">输出</a></h3>
			<div class="collapse in" id="problemOut" aria-expanded="true">
				<div class="well">
					<?php echo $problemItem[0]['output'];?>
				</div>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#dataIn">样例输入</a></h3>
			<div class="collapse in" id="dataIn" aria-expanded="true">
				<div class="zero-clipboard">
					<span class="btn-clipboard">复制</span>
				</div>
				<pre id="dataInContent"><?php echo $problemItem[0]['sample_input'];?></pre>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#dataOut">样例输出</a></h3>
			<div class="collapse in" id="dataOut" aria-expanded="true">
				<div class="zero-clipboard">
					<span class="btn-clipboard" onclick="copyToClipboard(document.getElementById('dataOutContent').innerHTML);">复制</span>
				</div>
				<pre id="dataOutContent"><?php echo $problemItem[0]['sample_output'];?></pre>
			</div>

			<h3><a data-toggle="collapse" data-target="#problemHint">提示</a></h3>
			<div class="collapse" id="problemHint" aria-expanded="true">
				<div class="well">
					<?php echo $problemItem[0]['hint'];?>
				</div>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#problemTag">标签</a></h3>
			<div class="collapse" id="problemTag" aria-expanded="true">
				<div class="well">
					<span class="label label-default">搜索</span>
				</div>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#problemSrc">来源</a></h3>
			<div class="collapse" id="problemSrc" aria-expanded="true">
				<div class="well">
					<?php echo $problemItem[0]['source'];?>
				</div>
			</div>
			
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	<script type="text/javascript">
function copyToClipboard(s){
    alert(s);
    if(window.clipboardData){
       window.clipboardData.setData("Text",s);
       alert("已经复制到剪切板！"+s);
    }else if(navigator.userAgent.indexOf("Opera") != -1) {  
       window.location = s;  
    }else if(window.netscape) {
        try {  
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  
        } catch (e) {  
            alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");  
        }  
        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);  
        if (!clip)  
            return;  
        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);  
        if (!trans)  
            return;  
        trans.addDataFlavor('text/unicode');  
        var str = new Object();  
        var len = new Object();  
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);  
        var copytext = s;  
        str.data = copytext;  
        trans.setTransferData("text/unicode",str,copytext.length*2);  
        var clipid = Components.interfaces.nsIClipboard;  
        if (!clip)  
            return false;  
        clip.setData(trans,null,clipid.kGlobalClipboard);  
        alert("已经复制到剪切板！"+"\n"+s)  
    }
}

$(window).load(function(){
     $("pre").addClass("prettyprint");
     prettyPrint();
})
	</script>
	</body>