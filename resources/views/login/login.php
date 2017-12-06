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
    <link href="http://10.15.3.183/dev/awk-blog/templates/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="http://10.15.3.183/dev/awk-blog/templates/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">
    <!-- Load jQuery -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
     <!-- PNotify -->
    <link href="http://10.15.3.183/dev/awk-blog/templates/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="http://10.15.3.183/dev/awk-blog/templates/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="http://10.15.3.183/dev/awk-blog/templates/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="http://10.15.3.183/dev/awk-blog/templates/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form" style="padding: 10px; border-radius:8px; background:#fff; box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
          <section class="login_content">
            <form>
              <h1>Login Form</h1>
              <div>
                <input id="username" type="text" class="form-control" placeholder="Username" required=""  style="margin-bottom: 8px"/>
              </div>
              <div>
                <input id="password" type="password" class="form-control" placeholder="Password" required="" style="margin-bottom: 8px"/>
              </div>
              <div>
                <a class="btn btn-primary submit" onclick="login()" style="width:100%; margin:0px; text-decoration: none"><span style="color:#fff; text-shadow: none;">Log in</span></a>
				<!--<button class="btn-primary form-control" onclick="login()" style="width:100%; margin:0px; border-radius:5px">Login
				</button>-->
              </div>
              <div class="separator" style="border:none; opacity:0.6">
                <div>
                  <p>©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>


    <script type="text/javascript">
      
      $(function() {
        $.post("login", function(data){

            if(data == '1') {

              window.location.replace("myblog");

            } else if(data == '0') {
              alert('0');
              new PNotify({
                title: 'Login alert',
                text: 'Please Relogin!',
                type: 'error',
                styling: 'bootstrap3'
              });
            }
            
        });
      });

      function login()
      {
        var user = document.getElementById('username').value;
        var pass = document.getElementById('password').value;
		
        $.ajax({
          url: "http://10.15.3.183:8080/login",
          data: {username : user, password : pass, token : ''},
          type: "POST",
          success: function(data)
          {
            // console.log(data); return;

            $.post("login", { token : data.token }, function(dtlogin){

            // console.log(dtlogin); return;
            if(dtlogin == '1') {

              window.location.replace("myblog");

            } else if(dtlogin == '0') {

              new PNotify({
                title: 'Login alert',
                text: 'Please Relogin!',
                type: 'error',
                styling: 'bootstrap3'
              });

            } else if(dtlogin == '2') {

              new PNotify({
                title: 'Login alert',
                text: 'Username or Password not match!',
                type: 'error',
                styling: 'bootstrap3'
              });
              
            }

            }); 

          }
        });
      }

    </script>
  </body>
</html>

    <!-- PNotify -->
    <script src="http://10.15.3.183/dev/awk-blog/templates/vendors/pnotify/dist/pnotify.js"></script>
    <script src="http://10.15.3.183/dev/awk-blog/templates/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="http://10.15.3.183/dev/awk-blog/templates/vendors/pnotify/dist/pnotify.nonblock.js"></script>