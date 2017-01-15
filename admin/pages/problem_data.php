<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1><?php echo LA_PROB_MAN; ?> <small><?php echo LA_EDIT_DATA.":{$problemID}"; ?></small></h1>
		</div>
		<p class="lead">
			<?php echo LA_TCE_LEAD; ?>
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
			<button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	  </div>
	</div>
	
	<button type="button" class="btn btn-primary" data-toggle="modal" onclick="$('#deleteModal').modal('toggle')">Small modal</button>

	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title">Delete Test Data</h4>
			</div>
			<div class="modal-body">
			Are you sure you want to delete <span id="deleteFileName">sample.in</span>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="button" id="deleteBtn" class="btn btn-danger">Delete</button>
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
					$('#deleteFileName').text(filename);
					$('#deleteModal').modal('toggle');
					$("#deleteBtn").click(function() {
						console.log("delete: "+filename);
						$('#deleteModal').modal('hide');
					})
				break;
				case 'edit':
					$('#modalTitle').text('Edit ' + filename);
					$('#dataModal').modal('toggle');
					$("#saveBtn").click(function() {
						console.log("saving: "+filename);
						$('#dataModal').modal('hide');
					})
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