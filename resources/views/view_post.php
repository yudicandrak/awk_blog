<div id="div_view_post" class="row" style="background:#fff">
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

<script type="text/javascript">
	$.ajax({
		url		:'t_view_post',
		data	:{ eid_post : {{ id_post }}},
		type	:'POST',
		success	:function(data){
			new Date($.now());
			var obj = JSON.parse(data);
			var dt = obj[0]['post_date'];
			var div = document.createElement('div');
			div.setAttribute("class", "col-md-9 col-sm-9 col-xs12");
			div.innerHTML = 	"<div>"+
									"<h1 class='color_black'>"+obj[0]['post_title']+"</h1>"+
									"<div>"+obj[0]['full_name']+" - "+formatDate(new Date(dt))+"</div>"+
								"</div>"+
								"<div>"+
									"<img src='{{ base_url }}asset/image_post/"+obj[0]['media']+"' style='margin-top: 20px; margin-bottom: 20px; width:100%; box-shadow: 1px 1px 10px #888888;'>"+
								"</div>"+
								"<div class='color_black col-md-11 col-sm-11 col-xs12'>"+
									obj[0]['post_content']+
								"</div>"+
								
								"<div style='width:500px'>"+
									"<img src='{{ base_url }}asset/like.png' width='20px'>"+
									"<span id='jumlah_like"+obj[0]['id_post']+"'>"+obj[0]['jumlah_like']+
									"</span>"+
								"</div>"+
								"<div>"+
									"<div id='b_like"+obj[0]['id_post']+"' class='b_like' style='float:left; width:12%;'>"+
										"<a onclick='like_post(\""+obj[0]['b_like']+"\", "+obj[0]['id_post']+", \""+obj[0]['user_unlike']+"\")' style='cursor:pointer;'><h4><i class='fa "+obj[0]['b_like']+"'> Like </i></h4></a>"+
									"</div>"+
									"<div class='accordion' id='accordion' role='tablist' aria-multiselectable='true'>"+
										"<div class='panel' style='background:#fff; border-color:#fff; margin:0'>"+
											"<a class='panel-heading collapsed' onclick='view_comment("+obj[0]['id_post']+","+obj[0]['c_comment']+", 0)' role='tab' id='headingThree' data-toggle='collapse' data-parent='#accordion' href='#collapseThree"+obj[0]['id_post']+"' aria-expanded='false' aria-controls='collapseThree' style='background:#fff; padding:0; border:0;'>"+
												"<h4><i class='fa fa-comments-o'> Comment (<span id='count_comment"+obj[0]['id_post']+"'>"+obj[0]['c_comment']+"</span>)</i></h4>"+
											"</a>"+
											"<div id='collapseThree" + obj[0]['id_post'] + "' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingThree' style='background:#f2f5f7'>"+
												"<div id='lists_comment"+obj[0]['id_post']+"' class='panel-body'>"+
												"</div>"+
												"<div class='panel-body'>"+
													"<div  class='comend_div' id='comment_div"+obj[0]['id_post']+"' contentEditable='true' data-text='Type Comment...' style='word-break: break-all; border: solid 1px #ccc; border-radius: 10px; display:inline-block; min-height: 30px; width: 90%; padding:5px; background:#ffffff';>"+
													"</div> &nbsp"+
													"<img id='button_send' onclick='send_comment("+obj[0]['id_post']+","+obj[0]['c_comment']+")' src='{{ base_url }}asset/send_biru.png' width='30px' style='cursor: pointer;'>"+
												"</div>"+
											"</div>"+
										"</div>"+
									"</div>"+
								"</div>";
			document.getElementById('div_view_post').appendChild(div);
			
			
			var div2 = document.createElement('div');
			div2.innerHTML = 	"<div class='col-md-3 col-sm-3 col-xs12'>"+
									"<div style='background: #b7b7b7; height: 100px; color:#fff;'> Space Iklan"+
									"</div>"+
								"</div>";
			document.getElementById('div_view_post').appendChild(div2);
		}
	});

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
					var s_com = obj.isi[k]['comment_content'].split(" ");
					if(s_com.length > 15){
						
					}
					var dt = obj.isi[k]['post_date'];
					var div = document.createElement('DIV');
					var div2 = document.createElement('DIV');
					div.setAttribute("class", "col-md-12  div_comment");
					div.innerHTML =	"<div class='x_content'>"+
										"<ul class='list-unstyled' style='padding:-100px'>"+
											"<li>"+
												"<a>"+
													"<span class='image'>"+
														"<img class='img-circle' src='{{ base_url }}asset/photo_user/"+obj.isi[k]['photo']+"' alt='img' style='width:35px'/> &nbsp"+
													"</span>"+
													"<span>"+
														"<span style='font-weight: bold;'>"+obj.isi[k]['username']+"</span> &nbsp"+
														"<span id='span_com_"+id_post+"_"+k+"' class='message' style='word-wrap: break-word; color:black;'>"+obj.isi[k]['comment_content']+"</span>"+
													"</span>"+
													"<br>"+
													"<span class='time' style='position: relative; left: 0%;'>"+formatDate2(new Date(dt), new Date(), 'comment')+action+" </span>"+
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

function like_post(logo, id_post, user_unlike){
	var func = '';
	if(logo == 'fa-thumbs-o-up'){
		func = 'unlike';
	}else{
		func = 'like';
	}
	$.ajax({
		url		: 'button_like',
		data	: {eid_post: id_post, euser_unlike: user_unlike, efunc: func},
		type	: 'POST',
		success	: function(data){
			var obj = JSON.parse(data);
			$("#jumlah_like"+id_post).html(obj[0]['jumlah_like']);
			$("#b_like"+id_post).html("<a onclick='like_post(\""+obj[0]['b_like']+"\", "+id_post+", \""+obj[0]['user_unlike']+"\")' style='cursor:pointer;'><h4><i class='fa "+obj[0]['b_like']+
			"'> Like </i></h4></a>");
		}
	});
}

function formatDate(date) {
	return date.getDate()+'/'+date.getMonth()+'/'+date.getFullYear()+' '+date.getHours()+':'+date.getMinutes();
}


function formatDate2(date, date2, views) {
	var monthNames = [
		"January", "February", "March",
		"April", "May", "June", "July",
		"August", "September", "October",
		"November", "December"
	];

	var day 		= date.getDate();
	var monthIndex 	= date.getMonth();
	var year 		= date.getFullYear();
	var jam 		= date.getHours();
	var menit 		= date.getMinutes();
	var second 		= date.getSeconds();
	
	var day2		= date2.getDate();
	var monthIndex2	= date2.getMonth();
	var year2		= date2.getFullYear();
	var jam2		= date2.getHours();
	var menit2		= date2.getMinutes();
	var second2		= date2.getSeconds();
	
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