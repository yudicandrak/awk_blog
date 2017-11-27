<div class="row">
<link href="{{ base_url }}asset/lib/css/emoji.css" rel="stylesheet">
<!-- start emoji!-->
  <script src="{{ base_url }}asset/lib/js/config.js"></script>
    <script src="{{ base_url }}asset/lib/js/util.js"></script>
    <script src="{{ base_url }}asset/lib/js/jquery.emojiarea.js"></script>
    <script src="{{ base_url }}asset/lib/js/emoji-picker.js"></script>
  

<div id="sliderWrapp">

  <link rel="stylesheet" href="{{ base_url }}bootstrap/cssslider_files/csss_engine1/style.css">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/autosize.js/3.0.15/autosize.min.js'></script>
  
</div>
  <input id="id_cat" type="text" value="{{ id }}" hidden="">
  <div class="col-md-12" >
    <div class="x_panel"> 
      <div class="col-md-9 col-sm-9 col-xs12" >
        <h4>Recent Activity</h4>
          <ul id="body_post" class="messages"></ul>
      </div>

    </div>
  </div>
</div>

<!-- modal del comment !-->
<div id="modal_del_com" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Delete Comment</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this comment.?</p>
        <span id = "id_comment" hidden></span>
        <span id = "id_post" hidden></span>
        <span id = "c_comment" hidden></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button onclick="proses_del_comment()" type="button" class="btn btn-danger">Delete</button>
      </div>

    </div>
  </div>
</div>
<!-- end modal !-->
  
  <!-- start emoji !-->
  <script>
      //$(function() {
        // // Initializes and creates emoji set from sprite sheet
        // window.emojiPicker = new EmojiPicker({
          // emojiable_selector: '[data-emojiable=true]',
          // assetsPath: '{{ base_url }}asset/lib/img/',
          // popupButtonClasses: 'fa fa-smile-o'
        // });
        // // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // // It can be called as many times as necessary; previously converted input fields will not be converted again
        // window.emojiPicker.discover();
      // });
    </script>
    <script>
      //// Google Analytics
      // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      // })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      // ga('create', 'UA-49610253-3', 'auto');
      // ga('send', 'pageview');
    </script>
<!-- end emoji !-->
<script type="text/javascript">
  autosize(document.querySelectorAll('textarea'));
  var id_cat = document.getElementById('id_cat').value;

  $.ajax({
    url     : 'get_blog',
    type    : "POST",
    data    : {id_cat : id_cat},
    success : function(data) {
      new Date($.now());
      var obj = JSON.parse(data);
      for (var k in obj){
        var id_post = obj[k]['id_post'];
        var dt = obj[k]['post_date'];
        var ul = document.createElement('li');
        ul.innerHTML = "<img src='{{ base_url }}asset/photo_user/"+obj[k]['photo']+"' class='avatar' alt='Avatar'>"+
                  "<div class='message_date'>"+
                    formatDate(new Date(dt), new Date(), 'post')+
                  "</div>"+
                  "<div class='message_wrapper'>"+
                    "<h4 class='heading'>"+obj[k]['username']+"</h4>"+
                    "<blockquote class='message'>"+obj[k]['post_content']+"</blockquote>"+
                    "<br/>"+
                    "<p id='media_post"+obj[k]['id_post']+"' class='url'>"+
                    "</p>"+
                    "<div id='jumlah_like"+obj[k]['id_post']+"'>"+obj[k]['jumlah_like']+
                    "</div>"+
                    "<div>"+
                      "<div id='b_like"+obj[k]['id_post']+"' class='b_like' style='float:left; width:12%;'>"+
                        "<a onclick='like_post(\""+obj[k]['b_like']+"\", "+obj[k]['id_post']+", \""+obj[k]['user_unlike']+"\")' style='cursor:pointer;'><h4><i class='fa "+obj[k]['b_like']+"'> Like </i></h4></a>"+
                      "</div>"+
                      "<div class='accordion' id='accordion' role='tablist' aria-multiselectable='true'>"+
                        "<div class='panel' style='background:#fff; border-color:#fff; margin:0'>"+
                          "<a class='panel-heading collapsed' onclick='view_comment("+obj[k]['id_post']+","+obj[k]['c_comment']+", 0)' role='tab' id='headingThree' data-toggle='collapse' data-parent='#accordion' href='#collapseThree"+obj[k]['id_post']+"' aria-expanded='false' aria-controls='collapseThree' style='background:#fff; padding:0; border:0;'>"+
                            "<h4><i class='fa fa-comments-o'> Comment (<span id='count_comment"+obj[k]['id_post']+"'>"+obj[k]['c_comment']+"</span>)</i></h4>"+
                          "</a>"+
                          "<div id='collapseThree" + obj[k]['id_post'] + "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingThree' style='background:#f2f5f7'>"+
                            "<div id='lists_comment"+obj[k]['id_post']+"' class='panel-body'>"+
                            "</div>"+
                            "<div class='panel-body'>"+
                              "<div  class='comend_div' id='comment_div"+obj[k]['id_post']+"' contentEditable='true' data-text='Type Comment...' style='word-break: break-all; border: solid 1px #ccc; border-radius: 10px; display:inline-block; min-height: 30px; width: 90%; padding:5px; background:#ffffff';>"+
                              "</div> &nbsp"+
                              "<img id='button_send' onclick='send_comment("+obj[k]['id_post']+","+obj[k]['c_comment']+")' src='{{ base_url }}asset/send_biru.png' width='30px' style='cursor: pointer;'>"+
                            "</div>"+
                          "</div>"+
                        "</div>"+
                      "</div>"+
                    "</div>"+
                  "</div>";
        document.getElementById('body_post').appendChild(ul);
        if(obj[k]['fn_media'] != null){
          var sk = obj[k]['fn_media'].split("____");
          var media = '';
          //console.log(sk);
          for (var k in sk){
            var skk = sk[k].split("----");
            media = media+"<span class='fs1 text-info' aria-hidden='true' data-icon=''></span>"+
                  "<a href = '{{ base_url }}public/downFiles?eid_upload="+skk[1]+"' style='cursor:pointer'><i class='fa fa-paperclip'></i> "+skk[0]+" </a><br>";
          }
          // $('#media_post'+obj[k]['id_post']).html(media);
          $("#media_post"+id_post).html(media);
        }
      }
    }
  });  
  
  function like_post(logo, id_post, user_unlike){
    var func = '';
    if(logo == 'fa-thumbs-o-up'){
      func = 'unlike';
    }else{
      func = 'like';
    }
    $.ajax({
      url   : 'button_like',
      data  : {eid_post: id_post, euser_unlike: user_unlike, efunc: func},
      type  : 'POST',
      success : function(data){
        var obj = JSON.parse(data);
        $("#jumlah_like"+id_post).html(obj[0]['jumlah_like']);
        $("#b_like"+id_post).html("<a onclick='like_post(\""+obj[0]['b_like']+"\", "+id_post+", \""+obj[0]['user_unlike']+"\")' style='cursor:pointer;'><h4><i class='fa "+obj[0]['b_like']+
        "'> Like </i></h4></a>");
      }
    });
  }
  
  function view_comment(id_post, c_comment, view){
    new Date($.now());
    var data;
    $.ajax({
      url:'views_comment',
      data:{ eid_post : id_post },
      type:'POST',
      success:function(data){

        $("#lists_comment"+id_post).empty();
        var action = '';
        var count = 0;
        var divv = document.createElement('DIV');
        var obj = JSON.parse(data);
        if(c_comment>5 && view == 0){
          divv.innerHTML = "<a onclick='view_comment("+id_post+","+c_comment+",1)' style='cursor: pointer;'>View All</a>";
          var count = c_comment - 1;
        }else{
          if(c_comment>5){
            divv.innerHTML = "<a onclick='view_comment("+id_post+","+c_comment+",0)' style='cursor: pointer;'>View Simple</a>";
          }
          count = 4;
        }
        document.getElementById('lists_comment'+id_post).appendChild(divv);
        for(var k in obj.isi) {
          if(count<5){
            var dt = obj.isi[k]['post_date'];
            var div = document.createElement('DIV');
            var div2 = document.createElement('DIV');
            div.setAttribute("class", "col-md-12  div_comment");
            div.innerHTML = "<div class='x_content'>"+
                      "<ul class='list-unstyled' style='padding:-100px'>"+
                        "<li>"+
                          "<a>"+
                            "<span class='image'>"+
                              "<img class='img-circle' src='{{ base_url }}asset/photo_user/"+obj.isi[k]['photo']+"' alt='img' style='width:35px'/> &nbsp"+
                            "</span>"+
                            "<span>"+
                              "<span style='font-weight: bold;'>"+obj.isi[k]['username']+"</span> &nbsp"+
                              "<span class='message' style='word-wrap: break-word; color:black;'>"+obj.isi[k]['comment_content']+"</span>"+
                            "</span>"+
                            "<br>"+
                            "<span class='time' style='position: relative; left: 0%;'>"+formatDate(new Date(dt), new Date(), 'comment')+action+" </span>"+
                          "</a>"+
                        "</li>"+
                      "</ul>"+
                    "</div>"+
                    
                    "<div id='div_dropdown"+obj.isi[k]['id_comment']+"' class='btn-group'  style='position:absolute; left: 95%;'>"+
                      "<span data-toggle='dropdown' class='caret' style='cursor:pointer; width:10px;'></span>"+
                      "<ul role='menu' class='dropdown-menu' style='min-width: 10px'>"+
                        "<li>"+
                          "<a onclick='delete_comment("+obj.isi[k]['id_comment']+","+id_post+","+c_comment+")'><i class='fa fa-trash-o'> Delete</i></a>"+
                        "</li>"+
                      "</ul>"+
                    "</div>";
            document.getElementById('lists_comment'+id_post).appendChild(div);
            if(obj.isi[k]['id_user']!=obj['id_user']){
              $("#div_dropdown"+obj.isi[k]['id_comment']).addClass('hidden');
            }
          }
          count--;
        }
      }
    });
    }
  function delete_comment(id_comment, id_post, c_comment){
    $('#id_post').val(id_post);
    $('#id_comment').val(id_comment);
    $('#c_comment').val(c_comment);
    $("#modal_del_com").modal('show');
  }
  
  function proses_del_comment(){
    var id_post = $('#id_post').val();
    var id_comment = $('#id_comment').val();
    var c_comment = $('#c_comment').val();
    $("#modal_del_com").modal('hide');
    $.ajax({
      url : 'delete_comment',
      data:{eid_comment: id_comment, eid_post: id_post},
      type: 'POST',
      success:function(data){
        new PNotify({
          title: 'Delete Success',
          text: 'Comment has been deleted.!',
          type: 'success',
          styling: 'bootstrap3'
        });
        view_comment(id_post, c_comment, 0);
        count_comment(id_post);
      }
    });
  }
  
  function count_comment(id_post){
    var data;
    $.ajax({
      url:'count_comment',
      data:{eid_post : id_post},
      type: 'POST',
      success:function(data){
        var obj = JSON.parse(data);
        document.getElementById("count_comment"+id_post).innerHTML = obj[0]['c_comment'];
      }
    });
  }
  
  function send_comment(id_post, c_comment){
    var comment = document.getElementById('comment_div'+id_post).innerHTML;;
    $.ajax({
      url:'post_comment',
      data:{eid_post : id_post, ecomment : comment},
      type: 'POST',
      success:function(data){
        view_comment(id_post, c_comment, 0);
        count_comment(id_post);
        $( ".comend_div" ).empty();
      }
    });
  }
  
  function formatDate(date, date2, views) {
    var monthNames = [
      "January", "February", "March",
      "April", "May", "June", "July",
      "August", "September", "October",
      "November", "December"
    ];

    var day     = date.getDate();
    var monthIndex  = date.getMonth();
    var year    = date.getFullYear();
    var jam     = date.getHours();
    var menit     = date.getMinutes();
    var second    = date.getSeconds();
    
    var day2    = date2.getDate();
    var monthIndex2 = date2.getMonth();
    var year2   = date2.getFullYear();
    var jam2    = date2.getHours();
    var menit2    = date2.getMinutes();
    var second2   = date2.getSeconds();
    
    var rt = '';
    if(year == year2){
      if(monthIndex == monthIndex2 && day == day2){
        if(jam == jam2){
          if(menit == menit2){
            //rt = second2 - second+' Secn';
            if(views == 'comment'){
              rt = 'Recently';
            }else if(views == 'post'){
              rt = '<strong>Recently</strong>';
            }
          }else{
            f_menit = menit2 - menit;
            if(views == 'comment'){
              rt = menit2 - menit+' Mins';
            }else if(views == 'post'){
              rt = "<strong>"+f_menit+" Mins </strong>";
            }
          }
        }else{
          f_jam = jam2 - jam;
          if(views == 'comment'){
            rt = jam2 - jam+' Hours';
          }else if(views == 'post'){
            rt = "<strong>"+f_jam+" Hours </strong>";
          }
        }
      }else{
        if(views == 'comment'){
          rt = day + ' ' + monthNames[monthIndex] + ' '+ jam+':'+menit;
        }else if(views == 'post'){
          rt = "<h3 class='date text-info'>"+day +"</h3><p class='month'>"+ monthNames[monthIndex]+ "</p>";
        }
      }
    }else{
      if(views == 'comment'){
        rt = day + ' ' + monthNames[monthIndex] + ' ' + year +' '+ jam+':'+menit;
      }else if(views == 'post'){
        rt =  "<h3 class='date text-info'>"+day +"</h3><p class='month'>"+ monthNames[monthIndex]+" "+ year +"</p>";
      }
    }
    return rt;
  }
</script>

<!-- Start CSS Slider -->
<style>
  body {
    margin: 0;
    //background: #F5F6F8;
  }

  *, *:after, *:before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  #sliderWrapp {
    text-align: center;
    background: #fff;
    padding: 30px 10px;
    border-bottom: 1px solid #DDE0E7;
  }
  #sliderWrapp > div {
    margin: 0 auto;
    width:100%;
  }
  .instuction {
    font-family: sans-serif, Arial;
    display: block;
    margin: 0 auto;
    max-width: 840px;
    width: 100%;
    color: #494F54;
    padding: 0 10px;
    text-align: left;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  .instuction h1 img {
    max-width: 170px;
    vertical-align: middle;
    margin-bottom: 10px;
  }
  .instuction h1 {
    font-weight: normal;
    color: #3A4A5A;
    text-align: center;
  }
  .instuction h2 {
    position: relative;
    font-weight: normal;
    font-size: 1.4em;
    margin-bottom: 20px;
    margin-top: 0;
    padding-left: 50px;
  }
  .instuction h2 .num {
    position: absolute;
    font-style: italic;
    font-size: 1.3em;
    left: -8px;
    top: -12px;

    width: 50px;
    height: 50px;
    line-height: 50px;
    background: #CBECFD;
    display: inline-block;
    text-align: center;
    border-radius: 50%;
  }
  .instuction .mono {
    color: #000;
    font-family: monospace;
    font-size: 1.3em;
    font-weight: normal;
  }
  .instuction li.mono {
    font-size: 1.5em;
  }

  .instuction ul {
    font-size: 0.9em;
    margin-top: 0;
    padding-left: 0;
    list-style: none;
  }
  .instuction .note {
    color: #A3A3B2;
    font-style: italic;
    padding-top: 10px;
  }
  .instuction p.note {
    text-align: center;
    padding-top: 0;
    margin-top: 4px;
  }
  .instuction textarea {
    font-size: 0.9em;
    min-height: 60px;
    padding: 10px;
    margin: 0;
    overflow: auto;
    max-width: 100%;
    width: 100%;
  }
  .instuction a,
  .instuction a:visited {
    color: #2196F3;
  }

  .instuction .card {
    padding: 25px;
    margin-bottom: 20px;
    background: #fff;
    border: 1px solid #DDE0E7;
  }
  
  .b_func{
    max-width:none;
  }

  [contentEditable=true]:empty:not(:focus):before{
    content:attr(data-text)
  }

  #button_send:hover{
    opacity: 0.5; 
  }
  
  .div_comment:hover{
    background-color: #e9eced;
    //opacity: 0.8; 
  }
  
  // #div_das_tags:hover{
    // opacity: 0.5; 
  // }
  
  // #alert_das_tax:after{
    // position: absolute;
    // display: block;
    // content: "";
    // bottom: -6px;
    // left: 50%;
    // width: 0;
    // height: 0;
    // margin-left: -3px;
    // overflow: hidden;
    // border: 3px solid transparent;
    // border-top-color: #ed5565;
  // }
  
  .b_like:active{
    transform: translateY(4px);
  }
</style>
<!-- End CSS Slider -->