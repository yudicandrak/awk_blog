<!-- Datatables -->
<link href="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/jszip/dist/jszip.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="http://10.15.3.183/dev/awk-slim3/templates/vendors/pdfmake/build/vfs_fonts.js"></script>

<button onclick='$("#modal_create_user").modal("show")' type="button" class="btn_add btn btn-primary">
	<i class="fa fa-plus-circle">
	</i>
	Create
</button>
<table id="menu_tbl" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Job Title</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<!--Start Modal!-->
<div id="modal_view_user" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title full_name" id="myModalLabel"> </h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12 profile_left">
						<div class='profile_img'>
							<div onClick='change_foto()' class='profile-pic'>
								<img id='img_view_user' class='img-responsive avatar-view' src='http://10.15.3.183/dev/awk-slim3/asset/yudi.jpg'>
							</div>
						</div>
					</div>
					<div  class="col-md-8 col-sm-8 col-xs-12 profile_left">
						<h3 class="full_name">full_name</h3>
						<ul class='list-unstyled user_data'>
							<li>
								<i class='fa fa-map-marker user-profile-icon'></i> <span id="home_address"></span>
							</li>
							<li>
								<i class='fa fa-briefcase user-profile-icon'></i> <span id="job_title"></span>
							</li>
							<li class='m-top-xs'>
								<i class='fa fa-external-link user-profile-icon'></i>
								<a href='http://www.google.com' target='_blank'>www.google.com</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--<button type="button" class="btn btn-primary" onClick="">Save changes</button>-->
			</div>
		</div>
	</div>
</div>

<div id="modal_edit_user" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel"> Edit Profile</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">User Name</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="edit_uname" type="text" class="form-control" value="">
							<input id="edit_iduser" type="text" hidden>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="edit_fname" type="text" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="edit_address" type="text" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Job Title</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="edit_jtitle" type="text" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input type="file" class="form-control" value="">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onClick="pedit_user()">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_create_user" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title full_name" id="myModalLabel">Create New User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">User Name*</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="create_un" type="text" required= "required" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Password*</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="create_pw" type="password" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name*</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="create_fname" type="text" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="create_address" type="text" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Job Title</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="create_jtitle" type="text" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="foto_cu" type="file" class="form-control" value="">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button onClick="add_user()" id="bcreate_user" type="button" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>
<!--End Modal!-->

<script type="text/javascript">
	$( document ).ready(function() {
	});
	function add_user() {
		var file_data = $('#foto_cu').prop('files')[0];
		var form_data = new FormData();
		form_data.append('file', file_data);
		var username	= $("#create_un").val();
		var password	= $("#create_pw").val();
		var fullname	= $("#create_fname").val();
		var address		= $("#create_address").val();
		var jobtitle	= $("#create_jtitle").val();
		
		$.ajax({
			url: 'add_user',
			//dataType: 'text',
			//cache: false,
			//contentType: false,
			processData: false,
			data: {eform_data: form_data, eusername: username, epassword: password, efullname: fullname, eaddress: address, ejobtitle: jobtitle, ed: 'lala'},
			type: 'post',
			success: function(data){
				//$("#modal_edit_photo").modal("hide");
			}
		});
	}
	data_t();
	function data_t(){
		$('#menu_tbl').DataTable( {
			destroy: true,
			ajax: {
				"url": "get_user",
				"type": "POST"
			},
			dom: 'Bfrtip',
			lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
				'pageLength'
			],
			columns: [
				{ "data": "full_name" },
				{ "data": "job_title" },
				{ "data": "status", "className": "text-center", "width": "10%" },
				{ "data": "action" }
			]
		});
	}
	
	function edit_user(id){
		$.ajax({
			url		: 'view_user',
			type	: 'POST',
			data	: {eid: id},
			success	:function(data){
				obj = JSON.parse(data);
				$("#edit_uname").val(obj.username);
				$("#edit_fname").val(obj.full_name);
				$("#edit_address").val(obj.home_address);
				$("#edit_jtitle").val(obj.job_title);
				$("#edit_iduser").val(obj.id_user);
				$('#modal_edit_user').modal('show');
			}
		});
	}
	
	function pedit_user(){
		var id_user		= $("#edit_iduser").val();
		var username	= $("#edit_uname").val();
		var fullname	= $("#edit_fname").val();
		var address		= $("#edit_address").val();
		var jtitle		= $("#edit_jtitle").val();
		
		$.ajax({
			url		: 'edit_user',
			type	: 'POST',
			data	: {eid: id_user, eusername: username, efullname: fullname, eaddress: address, ejtitle: jtitle},
			success	: function(data){
				$('#modal_edit_user').modal('hide');
				data_t();
			}
		});
	}
	
	function change_status(id, status){
		$.ajax({
			url		: 'update_status',
			type	: 'POST',
			data	: {eid: id, estatus: status},
			success	: function(data){
				new PNotify({
					title: 'Info',
					text: 'User Activation Change.!',
					type: 'success',
					styling: 'bootstrap3'
				});
				data_t();
			}
		});
	}
	
	function view_user(id){
		$.ajax({
			url		: 'view_user',
			type	: 'POST',
			data	: {eid: id},
			success	: function(data){
				obj = JSON.parse(data);
				document.getElementById("img_view_user").src = "http://10.15.3.183/dev/awk-slim3/asset/photo_user/"+obj['photo'];
				$(".full_name").html(obj['full_name']);
				$("#home_address").html(obj['home_address']);
				$("#job_title").html(obj['job_title']);
				
				$("#modal_view_user").modal('show');
			}
		});
	}
</script>

<style>
	/* The switch - the box around the slider */
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 52px;
	  height: 26px;
	  margin-bottom: 0px;
	}

	/* Hide default HTML checkbox */
	.switch input {display:none;}

	/* The slider */
	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 22px;
	  width: 22px;
	  left: 2px;
	  bottom: 2px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #2196F3;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}
</style>