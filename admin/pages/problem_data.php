<!DOCTYPE html>
<html>
<head>
	<?php require_once('../include/admin_head.inc.php'); ?>
	<title><?php echo LA_DATA_MAN." - {$OJ_NAME}";?></title>
	<style>
table#tableFileList a {
	padding-left: 5px;
}
	</style>
</head>	
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
		<!-- FileInput -->
		<div class="row">
		<div class="col-md-9">
			<form id="uploadForm" enctype="multipart/form-data">
			<input type="hidden" id="uploadProblemID" name="pid"/>
			<input type="hidden" name="action" value="upload"/>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><?php echo L_SELECT_FILE;?></span><span class="fileinput-exists"><?php echo L_CHANGE;?></span><input id="uploadFileInput" type="file" name="file"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><?php echo L_REMOVE;?></a>
			</div>
			</form>
		</div>
		<div class="col-md-3"><button type="button" id='doUploadBtn' data-action='upload' class="btn btn-default btn-block"><?php echo L_UPLOAD;?></button></div>
		</div>
	</div>
	
	<!-- dataModal -->
	<div class="modal fade" id="dataModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="modalTitle">Modal title</h4>
			</div>
			<div class="modal-body">
			<form id="updateDataForm">
				<input type="hidden" name="action" value="update"/>
				<input type="hidden" id="updateProblemID" name="pid"/>
				<input type="hidden" id="updateFileName" name="filename"/>
				<textarea class="form-control" id="fileContent" rows="5" name="content" placeholder="Data Here"></textarea>
			</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" data-action='update' class="btn btn-primary">Save changes</button>
			</div>
		</div>
	  </div>
	</div>
	
	<!-- divModalDeleteFile -->
	<div class="modal fade" id="divModalDeleteFile" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title"><?php echo LA_DELETE_DATA;?></h4>
			</div>
			<div class="modal-body">
			<?php echo LA_DELETE_WARNING;?> <span id="deleteFileName">Loading</span> ?
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

			var lnIndex = 0;
			var $aEdit = $(document.createElement("a")).text("<?php echo L_EDIT;?>").attr("href", "javascript:;").attr("data-action", "edit");
			var $aDelete = $(document.createElement("a")).text("<?php echo L_DELETE;?>").attr("href", "javascript:;").attr("data-action", "delete");
			var $aDownload = $(document.createElement("a")).text("<?php echo L_DOWNLOAD;?>").attr("href", "javascript:;").attr("data-action", "download");
			$.each(data, function (lStrFileNameWithoutExt, data) {
				$tdDataIn = $(document.createElement("td"));
				$tdDataOut = $(document.createElement("td"));
				if (data["in"]) {
					$tdDataIn.text(lStrFileNameWithoutExt + ".in (" + data["in"] + ")")
						.append($aEdit.clone().attr("data-fileName", lStrFileNameWithoutExt + ".in"))
						.append($aDelete.clone().attr("data-fileName", lStrFileNameWithoutExt + ".in"));
						//.append($aDownload.clone().attr("data-fileName", lStrFileNameWithoutExt + ".in"))
				}
				if (data["out"]) {
					$tdDataOut.text(lStrFileNameWithoutExt + ".out (" + data["out"] + ")")
						.append($aEdit.clone().attr("data-fileName", lStrFileNameWithoutExt + ".out"))
						.append($aDelete.clone().attr("data-fileName", lStrFileNameWithoutExt + ".out"));
						//.append($aDownload.clone().attr("data-fileName", lStrFileNameWithoutExt + ".in"))
				}
				$tr = $(document.createElement("tr")).append($(document.createElement("td")).text(++lnIndex))
					.append($tdDataIn).append($tdDataOut);
				$tableBody.append($tr);
			});

			$("a[data-action='edit']", $tableBody).bind("click", a_action_edit_onClick);
			$("a[data-action='delete']", $tableBody).bind("click", a_action_delete_onClick);
			$("a[data-action='download']", $tableBody).bind("click", a_action_download_onClick);
		}

		function a_action_edit_onClick(e) {
			var $a = $(e.currentTarget);
			showModalDialog_editData($a.attr("data-fileName"));
		}

		function a_action_delete_onClick(e) {
			var $a = $(e.currentTarget);
			showModalDialog_deleteFile($a.attr("data-fileName"));
		}
		
		function a_action_download_onClick(e) {
			var $a = $(e.currentTarget);
			showModalDialog_downloadFile($a.attr("data-fileName"));
		}
		
		function btn_upload_onClick() {
			if($("#uploadFileInput").val()!="") { 
				$("#uploadProblemID").val($("#problemID").attr("data-pid"));
				var formData = new FormData($("#uploadForm")[0]); // used to upload file.
				$.ajax({  
					url: "../api/ajax_problemdata.php",
					type: "POST",  
					data: formData,
					processData: false,
					contentType: false,
					success: function(data) {
						$('.fileinput').fileinput('clear');
						loadData_tableFileList($("#problemID").attr("data-pid"));
					},  
					error: function(data) {
						console.log(data.status + " : " + data.statusText + " : " + data.responseText);
					}
				});
			}
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
					$('#updateFileName').val(fileName);
					$('#updateProblemID').val(problemID);
					$('textarea#fileContent').val(data);
				}
			);
		}

		function showModalDialog_deleteFile(fileName) {
			var $divModal = $("#divModalDeleteFile");
			$("span.fileName", $divModal).text(fileName);
			$("span#deleteFileName").text(fileName);
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
		
		function showModalDialog_downloadFile(fileName) {
			//console.log("...");
		}

		function buttonPerformFileDeletion_onClick(e) {
			// e.currentTarget: "#divModalDeleteFile button[data-action='delete']"
			var $divModal = $("#divModalDeleteFile");
			
			$.post('../api/ajax_problemdata.php', 
				$('#formDeleteFile').serialize(),
				function(data, status) {
					//TODO: warning if return {"status":false}
					//console.log(data);
					loadData_tableFileList($("#problemID").attr("data-pid"));
				}
			);
			$divModal.modal("hide");
		}
		
		function buttonPerformDataEditing_onClick(e) {
			// e.currentTarget: "#dataModal button[data-action='update']"
			var $divModal = $("#dataModal");
			
			$.post('../api/ajax_problemdata.php', 
				$('#updateDataForm').serialize(),
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
			$("#dataModal button[data-action='update']").bind("click", buttonPerformDataEditing_onClick);
			$("#doUploadBtn[data-action='upload']").bind("click", btn_upload_onClick);
			
			loadData_tableFileList(<?php echo $problemID; ?>);
		});
	</script>
</body>
</html>