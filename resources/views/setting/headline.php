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
                    <!-- <button class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#modal_parent">Add Parent</button> -->
                    <table id="headline_tbl" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Post Title</th>
                          <th>Rating Post</th>
                          <th>Headline</th>
                        </tr>
                      </thead>

                      <tbody>
    
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

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

      </div>
    </div>

  	<script type="text/javascript">  

  		function upd_status(id_post, upd_status)
  		{
  			$.post("upd_status", { id_post : id_post, upd_status : upd_status })
  				.done(function(data){
  				if(data == '1') {
  					new PNotify({
		          title: 'Success',
		          text: 'Update Success!',
		          type: 'success',
		          styling: 'bootstrap3'
	       	 	});
	       	 	$('#headline_tbl').DataTable().ajax.reload();
  				} else {
  					new PNotify({
		          title: 'Failed',
		          text: 'Update Failed!',
		          type: 'error',
		          styling: 'bootstrap3'
	       	 	});
  				}
  			});
  		}

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

	    $('#headline_tbl').DataTable( {
	        "ajax": 'get_headline',
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

	<!-- <style>
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
</style> -->