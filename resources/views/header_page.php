<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>All We Know | Blog</title>

    <!-- Bootstrap -->
    <link href="{{ base_url }}templates/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ base_url }}templates/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ base_url }}templates/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ base_url }}templates/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <!-- <link href="{{ base_url }}templates/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet"> -->
    <!-- Select2 -->
    <link href="{{ base_url }}templates/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{ base_url }}templates/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="{{ base_url }}templates/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ base_url }}templates/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ base_url }}templates/build/css/custom.min.css" rel="stylesheet">
	<link href="{{ base_url }}templates/build/css/custom.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ base_url }}templates/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="{{ base_url }}templates/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="{{ base_url }}templates/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
  	<!-- Load jQuery !-->
    <!-- <script src="https://code.jquery.com/jquery-1.11.3.js"></script> -->
  	<!-- <script src="{{ base_url }}bootstrap/jquery-3.2.1.js"></script> -->
    <!-- jQuery -->
    <script src="{{ base_url }}templates/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Loading .js -->
    <link href="{{ base_url }}bootstrap/loading/dist/jquery.loading.css" rel="stylesheet">
    <script src="{{ base_url }}bootstrap/loading/dist/jquery.loading.js"></script>
  </head>

  <body class="nav-md">
    <script type="text/javascript">
      $('body').loading({
        theme: 'dark',
        message : 'Working, please wait ...'
      });
    </script>

    <div class="container body">
      <div class="main_container">
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
				<a href="dashboard"><img height="45px" src="{{ base_url }}asset/awk_title.png" alt="all we know" style="margin-bottom:10px;"></a>
				<div class="form-horizontal form-label-left" style="display:inline; float:right; margin-top:10px" novalidate>
					<input type="text" id="name" name="esearch" placeholder="Search" class="input_cari">
					<input type="submit" name="submit" class="button_cari" value=" "><i class="fa fa-search" style="color:#fff; font-size: 20px; margin-left:5px"></i>
				</div>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ photo }}" alt="">{{ fullname }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a onclick="logout()"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <script type="text/javascript">
                  function logout()
                  {
                    $.post("logout", function(data) {
                      window.location.replace("./");
                    });
                  }
                </script>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="{{ base_url }}templates/production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ base_url }}templates/production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ base_url }}templates/production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{ base_url }}templates/production/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
		  
			<nav class="nav_menu_top">
				<ul class="ul_menu_top">
					<!--<li><a href="#">Home</a>
						<ul>
							<li><a href="dashboard" style="color:#fff">Dashboard</a></li>
							<li><a href="myblog" style="color:#fff">My Blog</a></li>
						</ul>
					</li>
					<li><a href="#">Dashboard</a></li>
					<li><a href="#">Master</a></li>-->
				</ul>
			</nav>
			<script type="text/javascript">
				$.ajax({
					url: "sidemenu",
					type: "GET",
					success: function (data) {
						var obj = JSON.parse(data);
						for(var k in obj) {
							var sk = k.split("___");
							var li = document.createElement('li');
							li.innerHTML =  "<a href='#' class='menu_top_a'>"+ sk[0] +"</a>"+
											"<ul id='menu_top"+k+"'></ul>";
							document.getElementsByClassName('ul_menu_top')[0].appendChild(li);
							for(var kk in obj[k]) {
								for(var kkk in obj[k][kk]) {
									var li3 = document.createElement('li');
									li3.innerHTML = " <a href='"+ kk +"' class='sub_menu_top'> "+ obj[k][kk][kkk] +" </a> ";
									document.getElementById('menu_top'+k).appendChild(li3);
								}
							}
						}
					}
                });
			</script>
        </div>
		<div class="right_col" role="main">
		