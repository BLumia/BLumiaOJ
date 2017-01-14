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
	
	<button type="button" class="btn btn-primary" onclick="$('#dataModal').modal('toggle')">Large modal</button>

	<div class="modal fade" id="dataModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="modalTitle">Modal title</h4>
			</div>
			<div class="modal-body">
			...
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	  </div>
	</div>
	
	<script>
	function updateTable(data) {
		var len = data.length;
		$("#filelist tbody").empty();
		var number = 1;
		var actionDOM = "<a do='edit'>Edit</a> <a do='del'>Delete</a>";
		$.each($.parseJSON(data), function(idx, obj) {
			//console.log(obj);
			var inDataDOM = 'in' in obj ? idx+".in ("+obj.in+") "+actionDOM : "";
			var outDataDOM = 'out' in obj ? idx+".out ("+obj.out+") "+actionDOM : "";
			var newRowContent = "<tr file='"+ idx +"'><td>"+number+"</td><td ext='in'>"+inDataDOM+"</td><td ext='out'>"+outDataDOM+"</td></tr>";
			$(newRowContent).appendTo("#filelist tbody");
			number++;
		});
		
		$("table#filelist a").click(function() {
			var filename = $(this).parent().parent().attr('file') + '.' + $(this).parent().attr('ext');
			var doAction = $(this).attr('do');
			console.log(filename + " " + doAction);
			
			switch(doAction) {
				case 'del':
				break;
				case 'edit':
					$('#modalTitle').text('Edit ' + filename);
					$('#dataModal').modal('toggle');
				break;
			}
		});
	}
	
	function refreshTable(problemid) {
		$.post("../api/ajax_problemdata.php", {
			pid: problemid
		}, function(data, status) {
			//console.log(data);
			updateTable(data);
		});
	}
	
	refreshTable(<?php echo $problemID;?>);
	</script>
</body>