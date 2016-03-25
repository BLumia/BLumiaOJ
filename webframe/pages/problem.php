
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<h1 class="text-center"><?php echo $problemItem['problem_id']." : ".$problemItem['title'];?></h1>
			<p class="text-center">
				时间限制:<span class="label label-primary"><?php echo $problemItem['time_limit']." Sec";?></span>
				内存限制:<span class="label label-primary"><?php echo $problemItem['memory_limit']." MiB";?></span><br/>
				提交:<span class="label label-info"><?php echo $problemItem['submit'];?></span>
				正确:<span class="label label-success"><?php echo $problemItem['accepted'];?></span>
			</p>
			<p class="text-center">
				<a id="oj-p-submit" class="btn btn-primary" href="./problemsubmit.php?pid=<?php echo $problemItem['problem_id'];?>" role="button">Submit</a>
				<a class="btn btn-primary" href="./problemstatistics.php?pid=<?php echo $problemItem['problem_id'];?>" role="button">Status</a>
				<a class="btn btn-primary" href="#" role="button">Edit</a>
			</p>
			
			<h3><a data-toggle="collapse" data-target="#problemDesc"><?php echo L_PROB_DESC;?></a></h3>
			<div class="collapse in" id="problemDesc" aria-expanded="true">
				<pre><?php echo $problemItem['description'];?></pre>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#problemInput"><?php echo L_INPUT;?></a></h3>
			<div class="collapse in" id="problemInput" aria-expanded="true">
				<pre><?php echo $problemItem['input'];?></pre>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#problemOut"><?php echo L_OUTPUT;?></a></h3>
			<div class="collapse in" id="problemOut" aria-expanded="true">
				<pre><?php echo $problemItem['output'];?></pre>
			</div>
			
			<h3 id="bl-p-datain"><a data-toggle="collapse" data-target="#dataIn"><?php echo L_SAMP_INPUT;?></a></h3>
			<div class="collapse in" id="dataIn" aria-expanded="true">
				<div class="zero-clipboard">
					<span id="bl-p-copy" class="btn-clipboard" onclick="copyToClipboard(document.getElementById('dataInContent').innerHTML);">复制</span>
				</div>
				<pre id="dataInContent"><?php echo $problemItem['sample_input'];?></pre>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#dataOut"><?php echo L_SAMP_OUTPUT;?></a></h3>
			<div class="collapse in" id="dataOut" aria-expanded="true">
				<div class="zero-clipboard">
					<span class="btn-clipboard" onclick="copyToClipboard(document.getElementById('dataOutContent').innerHTML);">复制</span>
				</div>
				<pre id="dataOutContent"><?php echo $problemItem['sample_output'];?></pre>
			</div>

			<h3><a data-toggle="collapse" data-target="#problemHint"><?php echo L_HINT;?></a></h3>
			<div class="collapse" id="problemHint" aria-expanded="true">
				<pre><?php echo $problemItem['hint'];?></pre>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#problemTag"><?php echo L_TAG;?></a></h3>
			<div class="collapse" id="problemTag" aria-expanded="true">
				<div class="well">
					<span class="label label-default">搜索</span>
				</div>
			</div>
			
			<h3><a data-toggle="collapse" data-target="#problemSrc"><?php echo L_SOURCE;?></a></h3>
			<div class="collapse" id="problemSrc" aria-expanded="true">
				<pre><?php echo $problemItem['source'];?></pre>
			</div>
			
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	<script type="text/javascript">
function copyToClipboard(s){
    //alert(s);
    if(window.clipboardData){
       window.clipboardData.setData("Text",s);
       alert("已经复制到剪切板！");
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
        alert("已经复制到剪切板！");  
    }
}

$(window).load(function(){
    //$("pre").addClass("prettyprint");
    prettyPrint();
})
	</script>
	
	<script type="text/javascript">
	//http://bootstraptour.com/api/
	var tour = new Tour({
		backdrop: true,
		debug: true,
		steps: [
		{
			element: "#problemDesc",
			title: "This is the Problem Description",
			content: "This block tell you what is the problem.",
			placement: "top"
		},
		{
			element: "#bl-p-datain",
			title: "This is the Sample in-data",
			content: "Click these title of the blocks will collapse the context of a block",
			placement: "top"
		},
		{
			element: "#bl-p-copy",
			//backdrop: false,
			title: "This is the copy button",
			content: "You can copy the input/output speedly by click here.",
			placement: "left"
		},
		{
			element: "#oj-p-submit",
			title: "This is Submit button",
			content: "When you finished the problem, click here to submit code",
			placement: "bottom"
		}]
	});
	</script>
	</body>