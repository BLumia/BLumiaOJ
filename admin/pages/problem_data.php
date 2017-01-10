<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Edit Data:<?php echo $problemID;?></small></h1>
		</div>
		<p class="lead">
			在这里编辑问题的测试数据。<br/>
			若要对问题进行编辑和其他针对某个问题的操作，请进入“问题列表”。
		</p>
		<table id="filelist" class="table table-hover">
			<thead><tr><th>#</th><th>In Data</th><th>Out Data</th></tr></thead>
			<tbody></tbody>
		</table>
	</div>
	
	<script>
	$.post("../api/ajax_problemdata.php",
    {
        pid: 1001
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
    });
	var newRowContent = "<tr><td>1</td><td>1</td><td>1</td></tr>";
	$(newRowContent).appendTo("#filelist tbody");
	</script>
</body>