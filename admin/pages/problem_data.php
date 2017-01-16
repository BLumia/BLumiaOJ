<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1><?php echo LA_PROB_MAN; ?> <small><?php echo LA_EDIT_DATA.":<span id='problemID'>Loading</span>"; ?></small></h1>
		</div>
		<p class="lead">
			<?php echo LA_TCE_LEAD; ?>
		</p>
		<table id="tableFileList" class="table table-hover">
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
			<textarea class="form-control" id="fileContent" rows="5" name="content" placeholder="Data Here"></textarea>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	  </div>
	</div>
	
	<button type="button" class="btn btn-primary" data-toggle="modal" onclick="$('#deleteModal').modal('toggle')">Small modal</button>

	<div class="modal fade" id="divModalDeleteFile" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title">Delete Test Data</h4>
			</div>
			<div class="modal-body">
			Are you sure you want to delete <span id="deleteFileName">Loading</span>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="button" data-action='delete' class="btn btn-danger">Delete</button>
			</div>
		</div>
	  </div>
	</div>
	<form id="formDeleteFile"></form>
	<script>
		function tableFileList_onUpdateContent(e, data) {
			var $tableBody = $("#tableFileList > tbody").empty();
			{
				var lnIndex = 0;
				var $aEdit = $(document.createElement("a")).text("Edit").attr("href", "javascript:;").attr("data-action", "edit");
				var $aDelete = $(document.createElement("a")).text("Delete").attr("href", "javascript:;").attr("data-action", "delete");
				$.each(data, function (lStrFileNameWithoutExt, data) {
					$tdDataIn = $(document.createElement("td"));
					$tdDataOut = $(document.createElement("td"));
					if (data["in"]) {
						$tdDataIn.text(lStrFileNameWithoutExt + ".in (" + data["in"] + ")")
							.append($aEdit.clone().attr("data-fileName", lStrFileNameWithoutExt + ".in"))
							.append($aDelete.clone().attr("data-fileName", lStrFileNameWithoutExt + ".in"));
					}
					if (data["out"]) {
						$tdDataOut.text(lStrFileNameWithoutExt + ".out (" + data["out"] + ")")
							.append($aEdit.clone().attr("data-fileName", lStrFileNameWithoutExt + ".out"))
							.append($aDelete.clone().attr("data-fileName", lStrFileNameWithoutExt + ".out"));
					}
					$tr = $(document.createElement("tr")).append($(document.createElement("td")).text(++lnIndex))
						.append($tdDataIn).append($tdDataOut);
					$tableBody.append($tr);
				});
			}
			$("a[data-action='edit']", $tableBody).bind("click", a_action_edit_onClick);
			$("a[data-action='delete']", $tableBody).bind("click", a_action_delete_onClick);
		}

		function a_action_edit_onClick(e) {
			var $a = $(e.currentTarget);
			showModalDialog_editData($a.attr("data-fileName"));
		}

		function a_action_delete_onClick(e) {
			var $a = $(e.currentTarget);
			showModalDialog_deleteFile($a.attr("data-fileName"));
		}
		
		function showModalDialog_editData(fileName) {
			var $divModal = $("#dataModal");
			var problemID = $("#problemID").attr("data-pid");
			$('#modalTitle').text('Edit ' + fileName);
			// Construct form
			$.post('../api/ajax_problemdata.php', 
				{
					pid: problemID,
					action: "cat",
					filename: fileName
				},
				function(data, status) {
					//TODO: warning if return {"status":false}
					$divModal.modal("show");
					$('textarea#fileContent').val(data);
				}
			);
		}

		function showModalDialog_deleteFile(fileName) {
			var $divModal = $("#divModalDeleteFile");
			$("span.fileName", $divModal).text(fileName);
			// Construct form
			var $form = $("form#formDeleteFile").empty();
			$form.append(
				$(document.createElement("input"))
					.attr("type", "hidden")
					.attr("name", "pid")
					.attr("value", $("#problemID").attr("data-pid"))
			);
			$form.append(
				$(document.createElement("input"))
					.attr("type", "hidden")
					.attr("name", "action")
					.attr("value", "rm")
			);
			$form.append(
				$(document.createElement("input"))
					.attr("type", "hidden")
					.attr("name", "filename")
					.attr("value", fileName)
			);
			// Show dialog
			$divModal.modal("show");
		}

		function buttonPerformFileDeletion_onClick(e) {
			// e.currentTarget: "#divModalDeleteFile button[data-action='delete']"
			var $divModal = $("#divModalDeleteFile");
			
			$.post('../api/ajax_problemdata.php', 
				$('#formDeleteFile').serialize(),
				function(data, status) {
					//TODO: warning if return {"status":false}
					//console.log(data);
				}
			);
			$divModal.modal("hide");
			loadData_tableFileList($("#problemID").attr("data-pid"));
		}

		function loadData_tableFileList(problemID) {
			$("#problemID").attr("data-pid", problemID);
			$("#problemID").text(problemID);
			$.ajax({
				url: "../api/ajax_problemdata.php",
				method: "POST",
				data: {
					"pid": problemID
				},
				dataType: "json",
				success: function (data, textStatus, jqXHR) {
					$("#tableFileList").trigger("updateContent", data);
				}
			});
		}

		$(document).ready(function () {
			$("#tableFileList").bind("updateContent", tableFileList_onUpdateContent);
			$("#divModalDeleteFile button[data-action='delete']").bind("click", buttonPerformFileDeletion_onClick);
			loadData_tableFileList(<?php echo $problemID; ?>);
		});
	</script>
</body>