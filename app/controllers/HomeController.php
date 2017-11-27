<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class HomeController extends BaseController
{

	function home($request, $response)
	{
		$this->view->render($response, 'home.php');
	} 

	// Start function login and logout
	public function index($request, $response)
	{
		$this->view->render($response, 'login/login.php');
	}

	public function login($request, $response)
	{
    	if(isset($_COOKIE['jwtcookie'])) {

    		// check login jwt    		
    		if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {    			
	    		return '1';
	    	} else {
	    		setcookie('jwtcookie', null, -1, '/');
	    		setcookie('username', null, -1, '/');
	    		setcookie('id_user', null, -1, '/');
	    		// alert 'Session expired, please relogin!'
	    		return '0';
	    	}    	

    	} else {

    		try {
			$s = "select * from wp_user where username = :user and password = :pass and status = '0' ";
			$s = $this->db->prepare($s);
			$s->bindparam(":user",$this->param['user']);
			$s->bindparam(":pass",$this->param['pass']);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);

				if(isset($data[0])) {				
		    		$enc_jwt = $this->encode_jwt($data[0]['username'],$data[0]['id_user'],0);
		    		setcookie("id_user", $data[0]['id_user'], time() + 21600, "/");
		    		setcookie("username", $data[0]['username'], time() + 21600, "/");
					return '1';
				} else {
					// alert 'Username or password not match'
					return '2';
				}
			
	        } catch (PDOException $e) {
	            return $this->jsonFail("Can not load user", array('error'=>$e->getMessage()));
	        }
		}
		
	}

	public function logout($request, $response)
	{
		setcookie('jwtcookie', null, -1, '/');
		setcookie('username', null, -1, '/');
		setcookie('id_user', null, -1, '/');
		return '1';
	}
	// End function login and logout


	// Start function my blog
	public function myblog($request, $response)
	{
		if(isset($_COOKIE['jwtcookie'])) {

    		if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {   
    			$s = "select id_user, full_name, photo from wp_user where id_user = $_COOKIE[id_user]";
				$s = $this->db->prepare($s);
				$s->execute();
				$dt = $s->fetch(\PDO::FETCH_ASSOC);
				// $data = $dt[0];	
				// $base_url = $this->base_url();
				$data = array('full_name' => $dt['full_name'], 'photo' => $dt['photo'], 'base_url' => $this->base_url() );

	    		$this->view->render($response, 'header_page.php', $data);
				$this->view->render($response, 'my_blog.php', $data);
				$this->view->render($response, 'footer_page.php', $data);
	    	} else {
	    		setcookie('jwtcookie', null, -1, '/');
	    		setcookie('username', null, -1, '/');
	    		setcookie('id_user', null, -1, '/');
	    		$this->view->render($response, 'login/login.php');
	    	}    	

    	} else {
    		$this->view->render($response, 'login/login.php');
    	}
	}

	public function get_category($request, $response)
	{
		try {

		if( $_POST['data'] == 'inp' ) {

			$s = "SELECT wmc.* 
						 FROM wp_menu_p wmp JOIN wp_menu_c wmc ON wmp.id_parent = wmc.id_parent
						 WHERE wmp.parent = 'Category' ";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
				
      return json_encode($data);

	  } else {

	  	$t = "SELECT category as cat FROM wp_post WHERE id_post = :id_post ";
	  	$t = $this->db->prepare($t);
	  	$t->bindparam(":id_post", $this->param['data']);
	  	$t->execute();
	  	$tdt = $t->fetch(\PDO::FETCH_ASSOC);
// echo $tdt['cat']
	  	$s = "SELECT wmc.* 
						 FROM wp_menu_p wmp JOIN wp_menu_c wmc ON wmp.id_parent = wmc.id_parent
						 WHERE wmp.parent = 'Category' ";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);

			for ($i=0; $i < count($data); $i++) {
				if( $data[$i]['id_child'] == $tdt['cat']) {
					$dt[] = "<option value='". $data[$i]['id_child'] ."' selected>". $data[$i]['child'] ."</option>";
				} else {
					$dt[] = "<option value='". $data[$i]['id_child'] ."' >". $data[$i]['child'] ."</option>";
				}	 
			}

			return json_encode(implode(" ", $dt)); 

	  }
		
      } catch (PDOException $e) {
          return $this->jsonFail("Can not load data", array('error'=>$e->getMessage()));
      }   
	}

	public function get_myblog($request, $response) 
	{	

		if(isset($_COOKIE['jwtcookie'])) {
		
			if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {
				$id_user = $_COOKIE['id_user'];
				try {
					$s = "select * 
						from wp_post 
						where id_user = '$id_user' 
						order by upd_date desc ";
					$s = $this->db->prepare($s);
					$s->execute();
					$data = $s->fetchAll(\PDO::FETCH_ASSOC);
					// print_r($data);
          return json_encode($data);
				
	        } catch (PDOException $e) {
	            return $this->jsonFail("Can not load data", array('error'=>$e->getMessage()));
	        }   

		    	} else {
		    		setcookie('jwtcookie', null, -1, '/');
		    		setcookie('username', null, -1, '/');
		    		setcookie('id_user', null, -1, '/');
					$this->view->render($response, 'login/login.php');
	    	}    	

    	} else {
			$this->view->render($response, 'login/login.php');
		}	
		
	}

	public function get_tags()
	{		
		$id = $_GET['id_post'];		
		try {
			$s = "select tag from wp_post where id_post = '$id' ";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);	
			
			$dt = explode("," , $data[0]['tag']);
			$dt1 = implode("','" , $dt);

			$t = "select id, taxonomi from wp_taxonomi where id in ('$dt1') ";
			$t = $this->db->prepare($t);
			$t->execute();
			$data1 = $t->fetchAll(\PDO::FETCH_ASSOC);

      return json_encode($data1);
	
    } catch (PDOException $e) {
        return $this->jsonFail("Can not load data: attachment ", array('error'=>$e->getMessage()));
    }
	}

	public function dt_tags($request, $response)
	{				
		$key = $_GET['q'];

		try {
		$s = "select id, taxonomi from wp_taxonomi where taxonomi like '%$key%' ";
		$s = $this->db->prepare($s);
		$s->execute();
		$array = $s->fetchAll(\PDO::FETCH_ASSOC);
		header('Content-Type: application/json');
		return json_encode($array);
		} 

		catch (PDOException $e) {
            return $this->jsonFail("Can not load user", array('error'=>$e->getMessage()));
        }
	}

	public function post_blog($request, $response)
	{	
		// print_r($_POST);
		// print_r($_GET);
		// print_r($_FILES); 
		// exit;
		
		if(isset($_COOKIE['jwtcookie'])) {

    		if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) { 
    			$time = strtotime($_POST['post_schedule']);
				$newdate = date('Y-m-d 00:00:00',$time);
				// $daten = strtotime($newdate);

				if($_POST['post_schedule'] == date('m/d/Y')) {
					$date = "NOW()";
				} else {
					$date = "'". $newdate ."'";
				}

				if($_GET['post_tag'] == '0') {
					$tag = "";
				} else {
					$tag = $_GET['post_tag'];
				}

				$type = explode("/",$_FILES['thumbnail']['type']);
				$realname = $_FILES['thumbnail']['name'];
				$tempname = $_FILES['thumbnail']['tmp_name'];
				$lok = "/opt/lampp/htdocs/dev/awk-slim3/asset/image_post/" . $_COOKIE['id_user'] . "_" . $realname;
				move_uploaded_file($tempname, $lok);

				try {
					$s = "insert into wp_post 
					(id_post, post_title, post_content, tag, media, url, post_date, upd_date, status, id_user)
					values 
					('', :title, :content, '$tag', '".$_COOKIE['id_user']."_".$realname."', :url, $date, $date, '0', :id_user)";
					$s = $this->db->prepare($s);
					$s->bindparam(":title",$this->param['post_title']);
					$s->bindparam(":content",$_GET['post_content']);
					$s->bindparam(":url",$this->param['post_url']);
					$s->bindparam(":id_user",$_COOKIE['id_user']);
					$s->execute();

					$log['event'] = "Post Blog Content";
					$log['id_post'] = '0';
					$log['id_user'] = $_COOKIE['id_user'];
					$this->addLog($log);
					
		        } catch (PDOException $e) {
		            return $this->jsonFail("Failed post blog", array('error'=>$e->getMessage()));
		        }   
	    	} else {
	    		setcookie('jwtcookie', null, -1, '/');
	    		setcookie('username', null, -1, '/');
	    		setcookie('id_user', null, -1, '/');
	    		$this->view->render($response, 'login/login.php');
	    	}    	

    	} else {
			$this->view->render($response, 'login/login.php');
		}

	}

	public function del_blog($request, $response)
	{

		if(isset($_COOKIE['jwtcookie'])) {

    		if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {   

    			try {
					$s = "delete from wp_post where id_post = :id_post and id_user = :id_user";
					$s = $this->db->prepare($s);
					$s->bindparam(":id_post",$this->param['id_post'], \PDO::PARAM_STR);
					$s->bindparam(":id_user",$this->param['id_user'], \PDO::PARAM_STR);
					$s->execute();

					$log['event'] = "Delete Blog Content";
					$log['id_post'] = $_POST['id_post'];
					$log['id_user'] = $_POST['id_user'];
					$this->addLog($log);
					
		        } catch (PDOException $e) {
		            return $this->jsonFail("Failed delete blog", array('error'=>$e->getMessage()));
		        }

	    	} else {
	    		setcookie('jwtcookie', null, -1, '/');
	    		setcookie('username', null, -1, '/');
	    		setcookie('id_user', null, -1, '/');
	    		$this->view->render($response, 'login/login.php');
	    	}    	

    	} else {
			$this->view->render($response, 'login/login.php');
		}
	}

	public function edit_post($request, $response)
	{

		if(isset($_COOKIE['jwtcookie'])) {

    		if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {    

    			try {

						$s = "select * from wp_post where id_post = :id_post ";
						$s = $this->db->prepare($s);
						$s->bindparam("id_post",$this->param['id_post']);
						$s->execute();
						$data = $s->fetchAll(\PDO::FETCH_ASSOC);		
            			return json_encode($data);
					
		        } catch (PDOException $e) {
		            return $this->jsonFail("Can not load data: attachment ", array('error'=>$e->getMessage()));
		        }

	    	} else {
	    		setcookie('jwtcookie', null, -1, '/');
	    		setcookie('username', null, -1, '/');
	    		setcookie('id_user', null, -1, '/');
	    		$this->view->render($response, 'login/login.php');
	    	}    	

    	} else {
			$this->view->render($response, 'login/login.php');
		}

	}

	public function upd_blog($request, $response)
	{		

		if(isset($_COOKIE['jwtcookie'])) {

    		if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {    

    			if($_POST['tag'] != "") {
					$tag = implode(",", $_POST['tag']);
				} else {
					$tag = " ";			
				}

				try {
					$s = "update wp_post
							set post_title = :title,
								post_content = :content,
								tag = '$tag',
								url = :url
							where id_post = :id_post and id_user = :id_user";
					$s = $this->db->prepare($s);
					$s->bindparam(":title",$this->param['title']);
					$s->bindparam(":content",$this->param['content']);
					$s->bindparam(":url",$this->param['url']);
					$s->bindparam(":id_post",$this->param['id_post']);
					$s->bindparam(":id_user",$this->param['id_user']);
					$s->execute();

					$log['event'] = "Update Blog Content";
					$log['id_post'] = $_POST['id_post'];
					$log['id_user'] = $_POST['id_user'];
					$this->addLog($log);

		        } catch (PDOException $e) {
		            return $this->jsonFail("Failed update blog", array('error'=>$e->getMessage()));
		        }

	    	} else {
	    		setcookie('jwtcookie', null, -1, '/');
	    		setcookie('username', null, -1, '/');
	    		setcookie('id_user', null, -1, '/');
	    		$this->view->render($response, 'login/login.php');
	    	}    	

    	} else {
			$this->view->render($response, 'login/login.php');
		}
	}

	public function get_list_upl($request, $response)
	{

		$id_post = $_GET['id_post'];
		try {

			$s = "select id_upload, filename from wp_media where id_post = '$id_post' ";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
			if(!empty($data)) {

				foreach ($data as $k => $v) {
					foreach ($v as $kk => $vv) {
						$dt["data"][$k][] = $v['filename'];
					}

						$dt["data"][$k][1] = " <center>
						<a title='Download' class='btn btn-warning btn-xs' href = 'http://10.15.3.183/dev/awk-slim3/public/downFiles?eid_upload=" .$v['id_upload']. "' style='cursor:pointer'><i class='fa fa-download'></i></a>

						<button type='button' title='Delete' class='btn btn-danger btn-xs' onclick='del_upl(". $v['id_upload'] .")' data-toggle='modal' data-target='#mod_del_upl'><i class='fa fa-trash'></i></button>
						</center>
						";
				}
	      return json_encode($dt);
			} else {
				$dt["data"][0][0] = "Empty Data";
				$dt["data"][0][1] = "Empty Data";
				return json_encode($dt);
			}

		} catch (PDOException $e) {
      return $this->jsonFail("Failed delete blog", array('error'=>$e->getMessage()));			
		}
	}

	public function uplFiles($request, $response, $args)
	{

			// echo ("<pre>");
			// print_r($_FILES);
			// echo ("</pre>"); exit;

		if(isset($_COOKIE['jwtcookie'])) {

			$id_user = $_COOKIE['id_user'];
			$id_post = $args['id_post'];
			$filename = $_FILES['uplName']['name'];

			if(isset($_FILES)) {
				$file = $_FILES["uplName"]["tmp_name"];
				for ($i=0; $i < count($file); $i++) { 
					if($_FILES['uplName']['error'][$i] == 0){						
						$fileContent[] = addslashes(file_get_contents($file[$i]));
						$ins[] = "( '', '$id_post', '$id_user', '$filename[$i]', '$fileContent[$i]' )";
					}
				}
			}
			$allFiles = implode(",", $ins);

			try {
				$s = " INSERT INTO wp_media (id_upload, id_post, id_user, filename, media) 
						VALUES $allFiles ";
				$s = $this->db->prepare($s);
				$s->execute();

				$log['event'] = "Upload file";
				$log['id_post'] = $id_post;
				$log['id_user'] = $id_user;
				$this->addLog($log);

				header('Location: http://' . $_SERVER['SERVER_NAME'] . '/dev/awk-slim3/public/myblog' );
    		exit;

		    } catch (PDOException $e) {
		        return $this->jsonFail("failed upload file", array('error'=>$e->getMessage()));
		    }

		} else {
			$this->view->render($response, 'login/login.php');
		}

	}

	public function delete_upl($request, $response, $args)
	{
		
		try{
			$s = "delete from wp_media where id_upload = :id_upload";
			$s = 	$this->db->prepare($s);
			$s->bindparam(":id_upload",$this->param['id_upload']);
			$s->execute();

			return '1';

		} catch (PDOException $e) {
			return $this->jsonFail("Failed delete upload", array('error'=>$e->getMessage()));
		}
	}	

  public function downFiles($request, $response)
  {
  	$s = "select * from wp_media where id_upload = $_GET[eid_upload]";
		$s = $this->db->prepare($s);
		$s->execute();
		$data = $s->fetch(\PDO::FETCH_ASSOC);

		header("Content-Type: application/octet-stream"); 
		header("Content-Transfer-Encoding: Binary");
		header("Content-disposition: attachment; filename=\" ". $data['filename'] ."\" ");
   	echo $data['media'];
   	exit;
  }
	// End function my blog page
	
	public function coba_baseurl($request, $response){
		//echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SERVER_NAME'];
		echo 'http://10.15.3.183/dev/awk-slim3/';
	}  
}