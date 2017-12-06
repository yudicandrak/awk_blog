<script src="http://malsup.github.com/jquery.form.js"></script> 
<div class="x_panel">
	<div class="x_title">
		<h2>Profile</h2>
		<div class="clearfix"></div>
	</div>
	<div id="body_profile" class="x_content">
		<script type="text/javascript">
			$( document ).ready(function() {
				window.onload = function () { 
					$('body').loading('stop');
				}

				get_profile();
				$('#bchange_foto').on('click', function () {
					//alert('lala');
					var file_data = $('#photo_change').prop('files')[0];
					var form_data = new FormData(); 
					form_data.append('file', file_data);
					$.ajax({
						url: 'change_foto',
						dataType: 'text',
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,                         
						type: 'post',
						success: function(data){
							$("#modal_edit_photo").modal("hide");
							get_profile();
						}
					});
				});
			});
			function get_profile(){
				$.ajax({
					url		: 'get_profile',
					type	: 'POST',
					success	: function(data){
						$( "#body_profile" ).empty();
						obj = JSON.parse(data);
						var div = document.createElement('DIV');
						div.setAttribute("class", "col-md-3 col-sm-3 col-xs-12 profile_left");
						div.innerHTML = "<div class='profile_img'>"+
											"<div onClick='change_foto()' class='profile-pic'>"+
												"<img id='img_profile' class='img-responsive avatar-view' src='{{ base_url }}asset/photo_user/"+obj.photo+"'>"+
												"<div class='edit' style='color:#ffffff;'><i class='fa fa-camera' style='margin:5%;'> Edit Photo</i></div>"+
											"</div>"+
										"</div>"+
										"<h3>"+obj.full_name+"</h3>"+
										"<ul class='list-unstyled user_data'>"+
											"<li>"+
												"<i class='fa fa-map-marker user-profile-icon'></i> "+obj.home_address+
											"</li>"+
											"<li>"+
												"<i class='fa fa-briefcase user-profile-icon'></i> "+obj.job_title+
											"</li>"+
											"<li class='m-top-xs'>"+
												"<i class='fa fa-external-link user-profile-icon'></i>"+
												"<a href='http://www.google.com' target='_blank'>www.google.com</a>"+
											"</li>"+
										"</ul>"+
										"<a onClick= 'edit_profile(\""+obj.photo+"\", \""+obj.home_address+"\", \""+obj.job_title+"\", \""+obj.full_name+"\")' class='btn btn-success'><i class='fa fa-edit m-right-xs'></i>Edit Profile</a>"+
										"<br/>";
						document.getElementById('body_profile').appendChild(div);
					}
				});
			}
			
			function change_foto(){
				$("#modal_edit_photo").modal("show");
			}
			
			function edit_profile(photo, address, job_title, name){
				//$("#modal_img").html("<img class='img-responsive avatar-view' src='{{ base_url }}asset/"+photo+"'>");
				$("#modal_name").val(name);
				$("#modal_address").val(address);
				$("#modal_job").val(job_title);
				$("#modal_edit_prof").modal("show");
			}
			
			// function upload_image(){
				// alert('lala');
				// var lala = $("#photo_change").val();
				// console.log(lala);
			// }
			
			var upload_image = function(){
				var photo = document.getElementById("photo_change");
				return false;
			}
			
			function upload_profile(){
				var name		= $("#modal_name").val();
				var address		= $("#modal_address").val();  
				var job_title	= $("#modal_job").val();
				//alert(name+" -> "+address+" -> "+job_title);
				$.ajax({
					url		: 'upload_profile',
					type	: 'POST',
					data	: {ename: name, eaddress: address, ejob_title: job_title},
					success	: function(data){
						$("#modal_edit_prof").modal('hide');
						get_profile();
					}
				});
			}
		</script>
			<!--
			
					
					
					
			<h4>Skills</h4>
			<ul class="list-unstyled user_data">
				<li>
					<p>Web Applications</p>
					<div class="progress progress_sm">
						<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
					</div>
				</li>
				<li>
					<p>Website Design</p>
					<div class="progress progress_sm">
						<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
					</div>
				</li>
				<li>
					<p>Automation & Testing</p>
					<div class="progress progress_sm">
						<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
					</div>
				</li>
				<li>
					<p>UI / UX</p>
					<div class="progress progress_sm">
						<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
					</div>
				</li>
			</ul>
			!-->
		<!--
		<div class="col-md-9 col-sm-9 col-xs-12">
			<div class="profile_title">
				<div class="col-md-6">
					<h2>User Activity Report</h2>
				</div>
				<div class="col-md-6">
					<div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
						<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
						<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
					</div>
				</div>
			</div>
			<!-- start of user-activity-graph 
			<div id="graph_bar" style="width:100%; height:280px;"></div>
			<!-- end of user-activity-graph 
			<div class="" role="tabpanel" data-example-id="togglable-tabs">
				<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
					<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a></li>
					<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a></li>
					<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
						<!-- start recent activity 
						<ul class="messages">
							<li>
								<img src="images/img.jpg" class="avatar" alt="Avatar">
								<div class="message_date">
									<h3 class="date text-info">24</h3>
									<p class="month">May</p>
								</div>
								<div class="message_wrapper">
									<h4 class="heading">Desmond Davison</h4>
									<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
									<br />
									<p class="url">
										<span class="fs1 text-info" aria-hidden="true" data-icon="?"></span>
										<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
									</p>
								</div>
							</li>
							<li>
								<img src="images/img.jpg" class="avatar" alt="Avatar">
								<div class="message_date">
									<h3 class="date text-error">21</h3>
									<p class="month">May</p>
								</div>
								<div class="message_wrapper">
									<h4 class="heading">Brian Michaels</h4>
									<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
									<br />
									<p class="url">
										<span class="fs1" aria-hidden="true" data-icon="?"></span>
										<a href="#" data-original-title="">Download</a>
									</p>
								</div>
							</li>
							<li>
								<img src="images/img.jpg" class="avatar" alt="Avatar">
								<div class="message_date">
									<h3 class="date text-info">24</h3>
									<p class="month">May</p>
								</div>
								<div class="message_wrapper">
									<h4 class="heading">Desmond Davison</h4>
									<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
									<br />
									<p class="url">
										<span class="fs1 text-info" aria-hidden="true" data-icon="?"></span>
										<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
									</p>
								</div>
							</li>
							<li>
								<img src="images/img.jpg" class="avatar" alt="Avatar">
								<div class="message_date">
									<h3 class="date text-error">21</h3>
									<p class="month">May</p>
								</div>
								<div class="message_wrapper">
									<h4 class="heading">Brian Michaels</h4>
									<blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
									<br />
									<p class="url">
										<span class="fs1" aria-hidden="true" data-icon="?"></span>
										<a href="#" data-original-title="">Download</a>
									</p>
								</div>
							</li>
						</ul>
						<!-- end recent activity 
					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
					<!-- start user projects 
					<table class="data table table-striped no-margin">
						<thead>
						<tr>
							<th>#</th>
							<th>Project Name</th>
							<th>Client Company</th>
							<th class="hidden-phone">Hours Spent</th>
							<th>Contribution</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>New Company Takeover Review</td>
								<td>Deveint Inc</td>
								<td class="hidden-phone">18</td>
								<td class="vertical-align-mid">
									<div class="progress">
										<div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>New Partner Contracts Consultanci</td>
								<td>Deveint Inc</td>
								<td class="hidden-phone">13</td>
								<td class="vertical-align-mid">
									<div class="progress">
										<div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Partners and Inverstors report</td>
								<td>Deveint Inc</td>
								<td class="hidden-phone">30</td>
								<td class="vertical-align-mid">
									<div class="progress">
										<div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>New Company Takeover Review</td>
								<td>Deveint Inc</td>
								<td class="hidden-phone">28</td>
								<td class="vertical-align-mid">
									<div class="progress">
										<div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<!-- end user projects 

					</div>
					<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
						<p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
						photo booth letterpress, commodo enim craft beer mlkshk </p>
					</div>
				</div>
			</div>
		</div>!-->
	</div>
</div>
<!-- start modal -->
<div id="modal_edit_prof" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<!--<div id="modal_img" class="col-md-3">
						
					</div>-->
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="modal_name" type="text" class="form-control" value="lala">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Addres</label>
						<div class="col-md-9" style="padding-bottom: 10px">
							<input id="modal_address" type="text" class="form-control" value="lili">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Job Title</label>
						<div class="col-md-9">
							<input id="modal_job" type="text" class="form-control" value="lulu">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onClick="upload_profile()">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div id="modal_edit_photo" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<!--<form id="pchange_foto" action="change_foto" method="post">-->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Change Photo</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<input id="photo_change" type="file">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="bchange_foto" type="button" class="btn btn-primary">Upload</button>
				</div>
			<!--</form>-->
		</div>
	</div>
</div>
<!-- end modal -->

<script src="{{ base_url }}templates/vendors/raphael/raphael.min.js"></script>
<script src="{{ base_url }}templates/vendors/morris.js/morris.min.js"></script>
<style>
.profile-pic {
	position: relative;
	display: inline-block;
}
.profile-pic:hover{
	opacity: 0.5;
	cursor:pointer;
}

.profile-pic:hover .edit {
	background: #737373;
	width: 100%;
	height: 20%;
	display: block;
}

.edit {
	padding-top: 7px;	
	padding-right: 7px;
	position: absolute;
	right: 0;
	bottom: 0;
	display: none;
}

.edit a {
	color: #000;
}
</style>