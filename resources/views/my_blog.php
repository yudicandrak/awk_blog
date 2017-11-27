
  <link rel="stylesheet" type="text/css" href="{{ base_url }}bootstrap/src-tag/css/select2.css">
  <script src="{{ base_url }}bootstrap/src-tag/js/select2.js"></script>

  <!-- Datatables -->
  <link href="{{ base_url }}templates/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{ base_url }}templates/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="{{ base_url }}templates/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="{{ base_url }}templates/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="{{ base_url }}templates/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- CKEditor -->
  <script src="{{ base_url }}bootstrap/ckeditor/ckeditor.js"></script>

  <!-- jQuery Validation -->
  <script type="text/javascript" src="{{ base_url }}bootstrap/jquery-validation/dist/jquery.validate.js"></script>

<!-- page content  -->
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Form Elements</h3>
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
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Form Input</h2>
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
          <br />

          <center>                    
            <h2>Post your project here!</h2>
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_post">Post Blog</button>
          </center>
          <br/><br/><br/>

          <!-- Modal Post -->
          <div id="modal_post" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Post Blog Here!</h4>
                </div>
                <div class="modal-body">

                <form id="add_blog" data-parsley-validate class="form-horizontal form-label-left">

                  <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="post_title">Title <span class="required"></span>
                    </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="text" id="post_title" name="post_title" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="post_title">Schedule Post
                    </label>
                    <div class="col-md-10 col-sm-10 col-xs-12 xdisplay_inputx form-group has-feedback">
                      <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Post Date" aria-describedby="inputSuccess2Status" name="post_schedule" required="required">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status" class="sr-only">(success)</span>
                    </div>
                  </div>

                  <div class="form-group">                    
                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="content">Content</label>

                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <textarea id="editor1" name="editor1" rows="10" cols="80" required="required">
                                                
                      </textarea>
                      <script>
                          // Replace the <textarea id="editor1"> with a CKEditor
                          // instance, using default configuration.
                          CKEDITOR.replace( 'editor1' );
                      </script>
                    </div>
                  </div>
                        <br />

                        <div class="form-group">
                          <label class="control-label col-md-1 col-sm-1 col-xs-12">Tags</label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                            <select id='inp_tag' multiple="true" class="form-control" style="width: 100%" required="required"></select>
 
                            <script type="text/javascript">
                              $("#inp_tag").select2({
                                tags: true,
                                createTag: function (params) 
                                {
                                  if(params.term.indexOf('@') === -1) {
                                    return null;
                                  }
                                  return {
                                    id : params.term,
                                    text : params.term
                                  }
                                },

                                ajax: {
                                  url: "dt_tags",
                                  type: "get",
                                  dataType: "json",
                                  delay: 250,
                                  data: function(params){
                                    return { q: params.term };
                                  },
                                  processResults: function(data){     
                                  return {

                                    results: $.map(data, function(obj) {
                                      // default read is id and text
                                      return { id: obj.id, text: obj.taxonomi };         
                                    })
                                    };
                                  },
                                  cache: true
                                },
                                minimumInputLength: 1
                              });
                            </script>
                          </div>
                        </div>

                        <br/>

                        <!-- <div class="form-group">
                          <label class="control-label col-md-1 col-sm-1 col-xs-12" for="website">Reference <span class="required"></span>
                          </label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="url" id="post_url" name="post_url" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div> -->

                        <div class="form-group">
                          <label class="control-label col-md-1 col-sm-1 col-xs-12">Reference</label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                            <input id="post_url" type="text" name="post_url" class="tags form-control" value="www.example.com" />
                            <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-1 col-sm-1 col-xs-12" for="logo">Thumbnail <span class="required"></span>
                          </label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                            <input id="thumbnail" name="thumbnail" type="file" required="required" /> <br />
                          </div>
                        </div>       

                  <div class="ln_solid"></div>

                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button class="btn btn-success" type="submit" >Submit</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>                    
        </div>
        <!-- End Modal Post -->

      </div>
    </div>
  </div>        

  <div class="row">  
    <div class="col-md-12 col-sm-12 col-xs-12">          
      <div class="x_panel">
        <div class="x_title">
        <h2>My Recent Activities</h2>
        <ul class="nav navbar-right panel_toolbox">
        	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        	</li>                
        </ul>
      <div class="clearfix"></div>
    </div>
  <div id="list_myblog" class="x_content" style="height: 500px; overflow-y: scroll;">

    <script type="text/javascript">

    $(document).ready( function() {     

      $.ajax({
        url : "get_myblog",
        type : "POST",
        success : function(data) 
        {
          var obj = JSON.parse(data);
          for (var k in obj) {         
            // console.log(obj[k]);    
            var div = document.createElement('DIV');
            div.setAttribute("class", "dashboard-widget-content");
            div.innerHTML = 
            "<div class='col-md-9 col-sm-9 col-xs-12'>" +
              "<ul class='list-unstyled timeline widget'>" +
              "<li>" +
                "<div class='block'>" +
                  "<div class='block_content'>" +
                  "<h2 class='title'>" +
                    "<a> " + obj[k]['post_title'] + " </a>" +
                  "</h2>" +
                "<div class='byline'>" +
              "<span> " + obj[k]['upd_date'] + " </span> by <a> me </a>" +
            "</div>" +
            "<p class='excerpt'> " + obj[k]['post_content'] + " </p>" + 
                  "</div>" +
                "</div>" +
              "</li>" +       
              "</ul>" +
            "</div>" +
            "<div class='col-md-3 col-sm-3'>" +
              "<a class='btn btn-app' data-toggle='modal' onclick='upl_post("+ obj[k]['id_post'] +"); tbl_upl("+ obj[k]['id_post'] +");' data-target='#modal_upload'>" +
                "<i class='fa fa-cloud-upload'></i> Upload" +
              "</a>" +
              "<a class='btn btn-app' data-toggle='modal' onclick='edit_post("+ obj[k]['id_post'] +")' data-target='#modal_edit'>" +
                "<i class='fa fa-edit'></i> Edit" +
              "</a>" +
              "<a class='btn btn-app' data-toggle='modal' onclick='del_blog(" + obj[k]['id_post'] + "," + obj[k]['id_user'] + ")' data-target='#modal_delete'>" +
                "<i class='fa fa-remove'></i> Remove" +
              "</a>" +
            "</div>"; 
          document.getElementById('list_myblog').appendChild(div);
          };
        }
      });
    }); 

    </script>
    </div>   
    </div>             
  </div>
</div>
<!-- /page content --> 

<!-- Modal Upload -->
  <div id="modal_upload" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Drop files here!</h4>
        </div>

        <div class="x_panel col">          
          <table id="list_upload" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th style="width: 80%">Filename</th>                
                <th style="width: 20%">Action</th>
              </tr>
            </thead>
          </table>
        </div>

        <button id="uplfile" class="btn btn-rounded btn-primary" onclick="addupl()" style="margin-left: 20px;margin-top: 20px"> <i class='fa fa-plus-square'></i></button>        
        <form id="form_upload" method="POST"  enctype="multipart/form-data">
          <div class="modal-body">
            <div style="white-space: nowrap;">            
              <h5>Choose file</h5>
                <div >
                  <table id="chsFileUpl">
                    <tr><!-- example html
                      <td><input type="file" name="uplName[]" id="uplName"></td>
                      <td><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-minus-square"></i></button></td>
                    </tr> -->
                  </table>                  
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" type="submit" onclick="checkUpl()">Upload</button>
            <button id="btn-cancel" class="btn btn-info" data-dismiss="modal" onclick="emptyListUpl()" >Cancel</button>                  
          </div>
        </form>                          

      </div>
    </div>
  </div>                  
<!--End Modal Upload -->

<!-- Modal Delete Upload-->
  <div id="mod_del_upl" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
        </div>
        <div class="modal-body">
          <h2>Do you want to delete media?</h2>
        </div>
        <div class="modal-footer">
          <button id="btn-del-upl" class="btn btn-primary" type="button" data-dismiss="modal">Delete</button>
          <button class="btn btn-info" data-dismiss="modal">Cancel</button>                  
        </div>
      </div>
    </div>
  </div>                  
<!--End Modal Delete -->


<script type="text/javascript"> 

  var k = 0;
  function addupl()
  {
    k = k + 1;
    var tr = document.createElement("tr");
    tr.setAttribute("id","id_tr"+k);
    tr.innerHTML = 
      "<td><input type='file' name='uplName[]' id='uplName"+ k +"'></td>"+
      "<td><button type='button' class='btn btn-danger btn-xs' onclick='remove_upl("+ k +")'><i class='fa fa-minus-square'></i></button></td>";

    document.getElementById("chsFileUpl").appendChild(tr);
  }

  function remove_upl(id_upl)
  {
    $( "tr" ).remove( "#id_tr"+id_upl );
  }

  function emptyListUpl() 
  {
    $("#chsFileUpl").empty(); 
  }

</script> 

<!-- Modal Delete -->
  <div id="modal_delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
        </div>
        <div class="modal-body">
          <h2>Do you want to delete data?</h2>
        </div>
        <div class="modal-footer">
          <button id="btn-delete" class="btn btn-primary" type="button" data-dismiss="modal">Delete</button>
          <button class="btn btn-info" data-dismiss="modal">Cancel</button>                  
        </div>
      </div>
    </div>
  </div>                  
<!--End Modal Delete -->

<!-- Modal Edit -->
  <div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Edit Blog Here!</h4>
        </div>
        <div class="modal-body">

        <form id="edit_blog" data-parsley-validate class="form-horizontal form-label-left">

          <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="post_title">Title <span class="required"></span>
            </label>
            <div class="col-md-10 col-sm-10 col-xs-12">
              <input type="text" id="upd_title" name="post_title" required="required" class="form-control col-md-7 col-xs-12" value="">
            </div>
          </div>

          <div class="form-group">                    
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="content">Content</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <textarea id="editor2" rows="10" cols="80" required="required">
                                          
                </textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'editor2' );
                </script>
              </div>
          </div>

            <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12">Tags</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <select id='upd_tag' multiple="true" class="form-control" style="width: 100%" required="required"></select>
              </div>
            </div>

            <!-- <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12" for="website">URL <span class="required"></span>
              </label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="url" id="upd_url" name="upd_url" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div> -->

            <div class="form-group">
              <label class="control-label col-md-1 col-sm-1 col-xs-12">Reference</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input id="upd_url" type="text" name="post_url" class="tags form-control" />
                <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
              </div>
            </div>            

          <div class="ln_solid"></div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="reset">Reset</button>
              <button id="btn-sub-edit" class="btn btn-success" type="button">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    </div>                    
  </div>
<!-- End Modal Edit -->

<script type="text/javascript"> 

  $(document).ready(function() {
    $('#post_url').tagsInput({
      width: 'auto'
    });

    $('#upd_url').tagsInput({
      width: 'auto'
    });
  });

  function get_blog()
  {
    $.ajax({
        url : "get_myblog",
        type : "POST",
        success : function(data) 
        {
          var obj = JSON.parse(data);
          for (var k in obj) {        
            var div = document.createElement('DIV');
            div.setAttribute("class", "dashboard-widget-content");
            div.innerHTML = 
            "<div class='col-md-9 col-sm-9 col-xs-12'>" +
              "<ul class='list-unstyled timeline widget'>" +
              "<li>" +
                "<div class='block'>" +
                  "<div class='block_content'>" +
                  "<h2 class='title'>" +
                    "<a> " + obj[k]['post_title'] + " </a>" +
                  "</h2>" +
                "<div class='byline'>" +
              "<span> " + obj[k]['upd_date'] + " </span> by <a> me </a>" +
            "</div>" +
            "<p class='excerpt'> " + obj[k]['post_content'] + " </p>" + 
                  "</div>" +
                "</div>" +
              "</li>" +       
              "</ul>" +
            "</div>" +
            "<div class='col-md-3 col-sm-3'>" +
              "<a class='btn btn-app' data-toggle='modal' onclick='upl_post("+ obj[k]['id_post'] +"); tbl_upl("+ obj[k]['id_post'] +");' data-target='#modal_upload'>" +
                "<i class='fa fa-cloud-upload'></i> Upload" +
              "</a>" +
              "<a class='btn btn-app' data-toggle='modal' onclick='edit_post("+ obj[k]['id_post'] +")' data-target='#modal_edit'>" +
                "<i class='fa fa-edit'></i> Edit" +
              "</a>" +
              "<a class='btn btn-app' data-toggle='modal' onclick='del_blog(" + obj[k]['id_post'] + "," + obj[k]['id_user'] + ")' data-target='#modal_delete'>" +
                "<i class='fa fa-remove'></i> Remove" +
              "</a>" +
            "</div>"; 
          document.getElementById('list_myblog').appendChild(div);
          };
        }
      });
  }       

  // CRUD TOP
  $(document).ready(function () {
    $( "#add_blog" ).validate( {
        event : 'blur',
        rules: {
          editor1: function(textarea) {
          CKEDITOR.instances[textarea.id].updateElement(); // update textarea
          var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
          return editorcontent.length === 0;
        },
          agree: "required"
        },
        messages: {
          editor1: "Please fill the content"
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
        }
      } );

  //Program a custom submit function for the form
    $("form#add_blog").submit(function(event){
      
      //disable the default form submission
      event.preventDefault();

      //grab all form data  
      var formData = new FormData($(this)[0]);

      var content = CKEDITOR.instances['editor1'].getData();

      if($('#inp_tag').val() != null) {
        var tag = $('#inp_tag').val();
      } else {
        var tag = '0';
      }

      $.ajax({
        url: 'post_blog?post_tag='+ tag +'&post_content='+ content,
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (returndata) {
          alert(returndata);
        }
      });
    });
  });


  function submit_blog()
  { 
    var title   = document.getElementById('post_title').value;
    var date    = document.getElementById('single_cal1').value;
    var content = document.getElementById('blog-content').innerHTML;
    var tag     = $('#inp_tag').val();
    var url     = document.getElementById('post_url').value; 
  

    if(title == '' || content == '' || tag == '' || url == '' ) {
      new PNotify({
        title: 'Alert',
        text: 'Complete form!',
        type: 'error',
        styling: 'bootstrap3'
      });

      document.getElementById('add_blog').reset();

    } else {

      $.ajax({
        url     : 'post_blog',
        data    : { title : title, date : date, content : content, tag : tag, url : url},
        type    : "POST",
        success : function(data){
          new PNotify({
            title: 'Success',
            text: 'Post Success!',
            type: 'success',
            styling: 'bootstrap3'
          });
          // location.reload();
        }
      });

      document.getElementById('add_blog').reset();

      $("#list_myblog").empty(); 
      $('#modal_post').modal('hide');

      get_blog();

    }
  }

  function del_blog(id_post, id_user)
  { 
    document.getElementById('btn-delete').setAttribute("onclick","del_post("+ id_post +", " + id_user + ")");    
  }

  function del_post(id_post, id_user)
  {        
    $.ajax({
      url     : 'del_blog',
      data    : { id_post : id_post, id_user : id_user},
      type    : "POST",
      success : function(data) {
        new PNotify({
          title: 'Success',
          text: 'Delete Success!',
          type: 'success',
          styling: 'bootstrap3'
        });
        // location.reload();
      }
    });

    $("#list_myblog").empty(); 
    // $("#category").empty(); 

    get_blog();
  }

  // OPEN MODAL EDIT

  $("#upd_tag").select2({
    tags: true,
    createTag: function (params) 
    {
      if(params.term.indexOf('@') === -1) {
        return null;
      }
      return {
        id : params.term,
        text : params.term
      }
    },

    ajax: {
      url: "dt_tags",
      type: "get",
      dataType: "json",
      delay: 250,
      data: function(params){
        return { q: params.term };
      },
      processResults: function(data){     
      return {

        results: $.map(data, function(obj) {
          // default read is id and text
          return { id: obj.id, text: obj.taxonomi };         
        })
        };
      },
      cache: true
    },
    minimumInputLength: 1
  });

  function edit_post(id_post)
  {

    $.ajax({
      url: "edit_post",
      data: {id_post : id_post},
      type: "POST",
      success: function(data)
      {
        var obj = JSON.parse(data);
        // console.log(obj[0]['url']); return;      
        // for(var k in obj) {
        //   document.getElementById('upd_title').value = obj[0]['post_title'];
        //   CKEDITOR.instances['editor2'].setData(obj[0]['post_content']);
        //   document.getElementById('btn-sub-edit').setAttribute("onclick","update_blog("+ obj[k]['id_post'] +","+ obj[k]['id_user'] +")");
        // }
          // document.getElementById('upd_url').setAttribute('value', obj[0]['url'] );
          $("#upd_url").tagsinput('add',{ id: 1, text: 'some' });
          $('#upd_url').tagsinput('refresh');

        $.ajax({
          url: "get_tags",
          data: { id_post : id_post },
          type: "GET",
          success: function(data) {
           var obj = JSON.parse(data);      
            $("#upd_tag").empty();          
            for(var k in obj) {       
              var opt = document.createElement('option');
              opt.setAttribute("value", obj[k]['id'] )
              opt.setAttribute("selected", "selected");
              opt.innerHTML = obj[k]['taxonomi'];          
              // console.log(opt);
              document.getElementById('upd_tag').appendChild(opt);
            }
          }
        });
      }
    });

  }
    
  
  // UPDATE MODAL
  function update_blog(id_post, id_user)
  { 
    var upd_title   = document.getElementById('upd_title').value;
    var upd_content = CKEDITOR.instances['editor2'].getData();
    var upd_tag     = $('#upd_tag').val();
    var upd_url     = document.getElementById('upd_url').value;

    if(upd_title == '' || upd_content == '' || upd_tag == '' || upd_url == '' ) {

      new PNotify({
        title: 'Alert',
        text: 'Complete Form!',
        type: 'error',
        styling: 'bootstrap3'
      });

    } else {

      $.ajax({
        url     : 'upd_blog',
        data    : { id_post : id_post, id_user : id_user, title : upd_title, content : upd_content, 
                  tag : upd_tag, url : upd_url},
        type    : "POST",
        success : function(data){
          new PNotify({
            title: 'Success',
            text: 'Update Success!',
            type: 'info',
            styling: 'bootstrap3'
          });
        }
      });

      $('#modal_edit').modal('hide');
      $("#list_myblog").empty(); 
    
      get_blog();

    }
  }

  // UPLOAD MODAL
  function upl_post(id_post)
  {
   document.getElementById('form_upload').setAttribute("action","uplFiles/"+id_post);
  }
  
  function del_upl(id_upload)
  {
    document.getElementById("btn-del-upl").setAttribute("onclick","delete_upl("+ id_upload +")");
  }

  function delete_upl(id_upload)
  {
    $.post("delete_upl", {id_upload : id_upload})
      .done(function(data){
        if(data == '1') {
          new PNotify({
            title: 'Success',
            text: 'Delete Success!',
            type: 'info',
            styling: 'bootstrap3'
          });
          $('#list_upload').DataTable().ajax.reload();  
        }
    });
  }

  function down_file(id_upload)
  {
    $.post("down_file", { id_upload : id_upload })
    .done(function(data){
      if(data == '1') {
        alert('down');
      }
    });
  }

</script>
</div>

</div>

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

    function tbl_upl(id_post)
    {

      $("#list_upload").DataTable( {
        "bDestroy": true,
        "ajax": {
          "url": "get_list_upl",
          "data": { id_post: id_post }
        },
      } );

    }

  </script>


    <!-- validator -->
    <!-- <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script> -->
    <!-- /validator