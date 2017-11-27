		<!-- Datatables -->
    <link href="{{ base_url }}templates/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ base_url }}templates/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{ base_url }}templates/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{ base_url }}templates/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{ base_url }}templates/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Setting <small>Edit parent and child menu</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

        	<!-- Parent Menu -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table Parent Menu</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <button class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#modal_parent">Add Parent</button>
                    <table id="menu_tbl" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Parent Menu</th>
                          <th>Status</th>
                          <th>Logo</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
    
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- Child Menu -->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table Child Menu</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <button class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#modal_child">Add Child</button>
                    <table id="menu_tbl_c" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Child Menu</th>
                          <th>Parent Menu</th>
                          <th>Link</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                            
                      </tbody>

                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->


		<!-- Modal Add Parent -->
		  <div id="modal_parent" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-lg">
		      <div class="modal-content">

		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		          </button>
		          <h4 class="modal-title" id="myModalLabel">Add Parent Menu</h4>
		        </div>

		        <div class="modal-body">

		        <form id="post_blog" data-parsley-validate class="form-horizontal form-label-left">

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent">Parent <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="text" id="parent" name="parent" required="required" class="form-control col-md-7 col-xs-12">
		            </div>
		          </div>

		          <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="status" value="ACTIVE"> &nbsp; ACTIVE &nbsp;
                        </label>
                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="status" value="NOT_ACTIVE"> NOT ACTIVE
                        </label>
                      </div>
                    </div>
                  </div>

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="text" id="logo" name="logo" required="required" class="form-control">
		            </div>
		            <div class="col-md-1 col-sm-1 col-xs-12">		            	
		              <a class="btn btn-warning btn-xs" href="icon_info" target="_blank"> <i class="fa fa-info-circle"></i> </a>
		            </div>

		          </div>          

		          <div class="ln_solid"></div>

		          <div class="form-group">
		            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		              <button class="btn btn-primary" data-dismiss="modal">Close</button>
		              <button class="btn btn-success" type="button" onclick="addParent()">Submit</button>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		    </div>                    
		  </div>
		<!-- End Modal Add Parent -->

		<!-- Modal Edit Parent -->
		  <div id="moded_p" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-lg">
		      <div class="modal-content">

		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		          </button>
		          <h4 class="modal-title" id="myModalLabel">Edit Parent Menu</h4>
		        </div>

		        <div class="modal-body">

		        <form id="post_blog" data-parsley-validate class="form-horizontal form-label-left">

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent">Parent <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="text" id="upd_parent" name="parent" required="required" class="form-control col-md-7 col-xs-12">
		            </div>
		          </div>

		          <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div id="upd_status" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="status" value="ACTIVE"> &nbsp; ACTIVE &nbsp;
                    </label>
                    <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="status" value="NOT_ACTIVE"> NOT ACTIVE
                    </label>
                  </div>
                </div>
              </div>

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="text" id="upd_logo" name="logo" required="required" class="form-control col-md-7 col-xs-12">
		            </div>
		            <div class="col-md-1 col-sm-1 col-xs-12">		            	
		              <a class="btn btn-warning btn-xs" href="icon_info" target="_blank"> <i class="fa fa-info-circle"></i> </a>
		            </div>
		          </div>          

		          <div class="ln_solid"></div>

		          <div class="form-group">
		            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		              <button class="btn btn-primary" data-dismiss="modal">Close</button>
		              <button id="upd-parent" class="btn btn-success" type="button" data-dismiss="modal">Submit</button>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		    </div>                    
		  </div>
		<!-- End Modal Edit Parent -->

		<!-- Modal Delete Parent -->
		  <div id="model_p" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-sm">
		      <div class="modal-content">

		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		          </button>
		          <h4 class="modal-title" id="myModalLabel">Confirm Delete Parent</h4>
		        </div>
		        <div class="modal-body">
		          <h2>Do you want to delete data?</h2>
		        </div>
		        <div class="modal-footer">
		          <button id="btn-delete" class="btn btn-success" type="button">Delete</button>
		          <button class="btn btn-info" data-dismiss="modal">Cancel</button>                  
		        </div>
		      </div>
		    </div>
		  </div>                  
		<!--End Modal Delete -->		

		<!-- Modal Child -->
		  <div id="modal_child" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-lg">
		      <div class="modal-content">

		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		          </button>
		          <h4 class="modal-title" id="myModalLabel">Add Child Menu</h4>
		        </div>

		        <div class="modal-body">

		        <form id="post_blog" data-parsley-validate class="form-horizontal form-label-left">

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent">Child <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="text" id="child" name="parent" required="required" class="form-control col-md-7 col-xs-12">
		            </div>
		          </div>

		          <div class="form-group">
		              <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
		              <div class="col-md-6 col-sm-6 col-xs-12">
		                <div class="btn-group" data-toggle="buttons">
		                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                    <input type="radio" name="status_c" value="ACTIVE"> &nbsp; ACTIVE &nbsp;
		                  </label>
		                  <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                    <input type="radio" name="status_c" value="NOT_ACTIVE"> NOT ACTIVE
		                  </label>
		                </div>
		              </div>
		            </div>

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Link <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="text" id="link" name="link" required="required" class="form-control col-md-7 col-xs-12">
		            </div>
		          </div>          

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Choose Parent <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <select id="dr_chs_parent" class="form-control">
		              	
		              </select>
		            </div>
		          </div>          

		          <div class="ln_solid"></div>

		          <div class="form-group">
		            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		              <button class="btn btn-primary" data-dismiss="modal">Close</button>
		              <button class="btn btn-success" type="button" onclick="addChild()">Submit</button>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		    </div>                    
		  </div>
		<!-- End Modal Add Child -->

		<!-- Modal Upd Child -->
		  <div id="moded_c" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-lg">
		      <div class="modal-content">

		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		          </button>
		          <h4 class="modal-title" id="myModalLabel">Edit Child Menu</h4>
		        </div>

		        <div class="modal-body">

		        <form id="post_blog" data-parsley-validate class="form-horizontal form-label-left">

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent">Child <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="text" id="upd_child" name="parent" required="required" class="form-control col-md-7 col-xs-12">
		            </div>
		          </div>

		          <div class="form-group">
		              <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
		              <div class="col-md-6 col-sm-6 col-xs-12">
		                <div id="edit_status" class="btn-group" data-toggle="buttons">
		                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                    <input type="radio" name="status_c" value="ACTIVE"> &nbsp; ACTIVE &nbsp;
		                  </label>
		                  <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
		                    <input type="radio" name="status_c" value="NOT_ACTIVE"> NOT ACTIVE
		                  </label>
		                </div>
		              </div>
		            </div>

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Link <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <input type="text" id="upd_link" name="link" required="required" class="form-control col-md-7 col-xs-12">
		            </div>
		          </div>          

		          <div class="form-group">
		            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Choose Parent <span class="required"></span>
		            </label>
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <select id="upd_dr_chs_parent" class="form-control">
		              	
		              </select>
		            </div>
		          </div>          

		          <div class="ln_solid"></div>

		          <div class="form-group">
		            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		              <button class="btn btn-primary" data-dismiss="modal">Close</button>
		              <button id="upd-child" class="btn btn-success" type="button" data-dismiss="modal">Submit</button>
		            </div>
		          </div>
		        </form>
		      </div>
		    </div>
		    </div>                    
		  </div>
		<!-- End Modal Upd Child -->

		<!-- Modal Delete Child -->
		  <div id="model_c" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-sm">
		      <div class="modal-content">

		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		          </button>
		          <h4 class="modal-title" id="myModalLabel">Confirm Delete Child</h4>
		        </div>
		        <div class="modal-body">
		          <h2>Do you want to delete data?</h2>
		        </div>
		        <div class="modal-footer">
		          <button id="btn-del-c" class="btn btn-success" type="button">Delete</button>
		          <button class="btn btn-info" data-dismiss="modal">Cancel</button>                  
		        </div>
		      </div>
		    </div>
		  </div>                  
		<!--End Modal Delete -->        

      </div>
    </div>

  	<script type="text/javascript">  

		// Parent side
		function addParent()
		{
			var parent = document.getElementById('parent').value;
			var status = $('.active').find('input').attr("value");
			var logo   = document.getElementById('logo').value;
			
			$.ajax({
				url: "add_parent",
				type: "POST",
				data: {parent : parent, status : status, logo : logo},
				success: function(data)
				{
					if(data == '1') {
						new PNotify({
	            title: 'Regular Success',
	            text: 'Add Success!',
	            type: 'success',
	            styling: 'bootstrap3'
						});
						location.reload();
					}
				}
			});
		}            

		function edit_parent(id_parent) 
		{
			document.getElementById('upd-parent').setAttribute('onclick','update_parent('+ id_parent +')');

			$.post("edit_parent", {"id_parent" : id_parent})
				.done(function(data){
					var obj = JSON.parse(data);
					// console.log(obj[0]['status']); return;
					document.getElementById('upd_status').innerHTML = obj[0]['status'];
					for (var k in obj) {
						document.getElementById('upd_parent').value = obj[k]['parent'];
						document.getElementById('upd_logo').value = obj[k]['logo'];						
					}
					
				});

		} 

		function update_parent(id_parent)
		{
			var upd_parent = document.getElementById('upd_parent').value;
			var upd_status = $('.active').find('input').attr("value");
			var upd_logo = document.getElementById('upd_logo').value;

			$.post("upd_parent", {"id_parent" : id_parent , "upd_parent" : upd_parent , "upd_status" : upd_status , "upd_logo" : upd_logo})
				.done(function(data){
					new PNotify({
	          title: 'Success',
	          text: 'Update Success!',
	          type: 'success',
	          styling: 'bootstrap3'
       	 	});
				});
			$('#menu_tbl').DataTable().ajax.reload();
		}

		function delete_parent(id_parent) 
		{
			document.getElementById('btn-delete').setAttribute("onclick","del_parent("+ id_parent +")");
		} 

		function del_parent(id_parent) 
		{
			$.post("del_parent", {"id_parent" : id_parent})
				.done(function(data){					
					if(data == 1) {						
						new PNotify({
	          title: 'Confirm',
	          text: 'Delete Success!',
	          type: 'success',
	          styling: 'bootstrap3'
       	 	});
					location.reload();
					} else {
						new PNotify({
	          title: 'Warning',
	          text: 'Delete Failed!',
	          type: 'error',
	          styling: 'bootstrap3'	
       	 	});
				}					
			}) ;
		}


 		// End Parent


 		// Child side
 		$.ajax({
 			url: "get_parent_menu",
 			type: "GET",
 			success: function(data)
 			{
 				var obj = JSON.parse(data);
 				for(var k in obj) {
 					for(var kk in obj[k]) {
 						var opt = document.createElement('option');
 						opt.setAttribute("value",obj[k][kk][0]);
 						opt.innerHTML = obj[k][kk][1];
 						document.getElementById("dr_chs_parent").appendChild(opt);
 					}
 				}
 			}
 		});

		function addChild()
		{
			var child = document.getElementById('child').value;
			var status = $('.active').find('input').attr("value");
			var link = document.getElementById('link').value;
			var parent = document.getElementById('dr_chs_parent').options[document.getElementById('dr_chs_parent').selectedIndex].value;
			// alert(child+"__"+status+"__"+link+"__"+parent);return;
			$.ajax({
				url: "add_child",
				type: "post",
				data: {child: child, status: status, link: link, parent: parent},
				success: function(data)
				{
					if(data == '1') {
						new PNotify({
	            title: 'Regular Success',
	            text: 'Add Success!',
	            type: 'success',
	            styling: 'bootstrap3'
						});
						location.reload();
					}
				}
			});
		}

		function edit_child(id_child)
		{
			document.getElementById('upd-child').setAttribute('onclick','update_child('+ id_child +') ');

			$.post("edit_child", {"id_child" : id_child})
				.done(function(data){
					var obj = JSON.parse(data);
					document.getElementById('edit_status').innerHTML = obj[0]['status'];
					for(var k in obj) {
						document.getElementById('upd_child').value = obj[k]['child'];
						document.getElementById('upd_link').value = obj[k]['link'];
						// console.log(obj[k]);
					}
			$("#upd_dr_chs_parent").empty();
					$.ajax({
			 			url: "get_parent_menu",
			 			data: { data : id_child },
			 			type: "GET",
			 			success: function(data)
			 			{
			 				var obj = JSON.parse(data);
	 						document.getElementById("upd_dr_chs_parent").innerHTML = obj;
			 			}
			 		});
			} );
		}

		function update_child(id_child)
		{
			var upd_child = document.getElementById('upd_child').value;
			var upd_status = $('.active').find('input').attr("value");
			var upd_link = document.getElementById('upd_link').value;
			var upd_dr_chs_parent = document.getElementById('upd_dr_chs_parent').options[document.getElementById('upd_dr_chs_parent').selectedIndex].value;

			$.post("upd_child", 
					{"id_child" : id_child , "upd_child" : upd_child , "upd_status" : upd_status , 
						"upd_link" : upd_link , "upd_dr_chs_parent" : upd_dr_chs_parent})
				.done(function(data){					
					new PNotify({
	          title: 'Update',
	          text: 'Update Success!',
	          type: 'success',
	          styling: 'bootstrap3'
       	 		});
					$('#menu_tbl_c').DataTable().ajax.reload();
				});
		}


		function delete_child(id_child)
		{
			document.getElementById('btn-del-c').setAttribute('onclick','del_child('+ id_child +')');
		}

		function del_child(id_child)
		{
			$.post("del_child", {"id_child" : id_child})
				.done(function(data){					
					if(data == 1) {						
						new PNotify({
	          title: 'Confirm',
	          text: 'Delete Success!',
	          type: 'success',
	          styling: 'bootstrap3'
       	 		});
					location.reload();
					} else {
						new PNotify({
	          title: 'Warning',
	          text: 'Delete Failed!',
	          type: 'error',
	          styling: 'bootstrap3'	
       	 	});
				}					
			}) ;
		}
		// End Child 

	</script>       

    <!-- Datatables -->
    <script src="{{ base_url }}templates/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{ base_url }}templates/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{ base_url }}templates/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{ base_url }}templates/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ base_url }}templates/vendors/pdfmake/build/vfs_fonts.js"></script>

    <script type="text/javascript">

	    $('#menu_tbl').DataTable( {
	        "ajax": 'get_parent_menu',
	        dom: 'Bfrtip',
			lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
				'pageLength'
			]
	    } );

	    $('#menu_tbl_c').DataTable( {
	        "ajax": 'get_child_menu',
	        dom: 'Bfrtip',
			lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],
			buttons: [
				'pageLength'
			]
	    } );

		</script>