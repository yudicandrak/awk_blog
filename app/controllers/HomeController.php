<?php

namespace App\Controllers;

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
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

		if(!$this->param['token']) return null;
        $param=$this->param;
        $token = (new Parser())->parse((string) $param['token']);

        if(!$token) return null;

        // print_r($token->getClaim('ID_USER')); exit;
    	if(!isset($_COOKIE['jwtcookie'])) {

			setcookie("jwtcookie", $this->param['token'], time() + 21600, "/");
    		setcookie("id_user", $token->getClaim('ID_USER'), time() + 21600, "/");
    		setcookie("username", $token->getClaim('USERNAME'), time() + 21600, "/");

			return '1';
    	} 

		setcookie('jwtcookie', null, -1, '/');
		setcookie('username', null, -1, '/');
		setcookie('id_user', null, -1, '/');
		// alert 'Session expired, please relogin!'
		return '0';		
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

			$s = "select ID_USER, FULLNAME as full_name, FOTO as photo from M_USER where ID_USER = $_COOKIE[id_user]";
			$s = $this->db->prepare($s);
			$s->execute();
			$dt = $s->fetch(\PDO::FETCH_ASSOC);
			
			$data = array('full_name' => $dt['full_name'], 'photo' => "data:image;base64,".base64_encode( $dt['photo'] )." ", 'base_url' => $this->base_url() );

    		$this->view->render($response, 'header_page.php', $data);
			$this->view->render($response, 'my_blog.php', $data);
			$this->view->render($response, 'footer_page.php', $data);

    	} else {

    		setcookie('jwtcookie', null, -1, '/');
    		setcookie('username', null, -1, '/');
    		setcookie('id_user', null, -1, '/');
    		$this->view->render($response, 'login/login.php');
    	}
	}

	public function get_myblog($request, $response) 
	{	

		if(isset($_COOKIE['jwtcookie'])) {
		
			$id_user = $_COOKIE['id_user'];
			try {
				$s = "SELECT * 
					from wp_post 
					where id_user = '$id_user'
					AND status != '2' 
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

	}

	public function get_tags()
	{	
		if(isset($_COOKIE['jwtcookie'])) {	

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
		        return $this->jsonFail("Can not load data ", array('error'=>$e->getMessage()));
		    }

	    } else {

    		setcookie('jwtcookie', null, -1, '/');
    		setcookie('username', null, -1, '/');
    		setcookie('id_user', null, -1, '/');
    		$this->view->render($response, 'login/login.php');
    	}
	}

	public function dt_tags($request, $response)
	{			

		if(isset($_COOKIE['jwtcookie'])) {

			$key = $_GET['q'];

			try {
			$s = "SELECT ID_TAXONOMY as id, NM_TAXONOMY as taxonomi from M_TAXONOMY where NM_TAXONOMY like '%$key%' ";
			$s = $this->db->prepare($s);
			$s->execute();
			$array = $s->fetchAll(\PDO::FETCH_ASSOC);
			header('Content-Type: application/json');
			return json_encode($array);
			} 

			catch (PDOException $e) {
	            return $this->jsonFail("Can not load user", array('error'=>$e->getMessage()));
	        }

        } else {

    		setcookie('jwtcookie', null, -1, '/');
    		setcookie('username', null, -1, '/');
    		setcookie('id_user', null, -1, '/');
    		$this->view->render($response, 'login/login.php');
    	}
	}

	public function post_blog($request, $response)
	{	
		// print_r($_POST);
		// print_r($_FILES); 
		// exit;
		
		if(isset($_COOKIE['jwtcookie'])) {

			if( $_POST['post_title'] != '' && $_POST['post_schedule'] != '' && $_POST['post_content'] != '' &&
				$_POST['post_tag'] != '' && $_POST['post_url'] != '' && isset($_FILES) ) {

    			$time = strtotime($_POST['post_schedule']);
				$newdate = date('Y-m-d 00:00:00',$time);
				$DTnow = date("Y-m-d H:i:s");

				if($_POST['post_schedule'] == date('m/d/Y')) {
					$date = "NOW()";
				} else {
					$date = "'". $newdate ."'";
				}

				if($_POST['post_tag'] == '0') {
					$tag = "";
				} else {
					$tag = $_POST['post_tag'];
				}

				$ext = substr($_FILES['thumbnail']['type'], 0, 5);

				$type = explode("/",$_FILES['thumbnail']['type']);
				$realname = $_FILES['thumbnail']['name'];
				$tempname = $_FILES['thumbnail']['tmp_name'];
				$lok = "/opt/lampp/htdocs/dev/awk-blog/asset/image_post/" . $_COOKIE['id_user'] . "_" . $DTnow . "_" .  $realname;
				move_uploaded_file($tempname, $lok);

				try {

					if($_FILES['thumbnail']['size'] >= '500000' ) {
						return '1';
					} else if ($_FILES['thumbnail']['error'] != '0' ) {
						return '2';
					} else if ($ext != 'image') {
						return '3';
					} else {
						$s = "insert into wp_post 
						(id_post, post_title, post_content, tag, media, url, post_date, upd_date, status, id_user)
						values 
						('', :title, :content, '$tag', '".$_COOKIE['id_user']."_".$DTnow."_".$realname."', :url, $date, $date, '0', :id_user)";
						$s = $this->db->prepare($s);
						$s->bindparam(":title",$this->param['post_title']);
						$s->bindparam(":content",$this->param['post_content']);
						$s->bindparam(":url",$this->param['post_url']);
						$s->bindparam(":id_user",$_COOKIE['id_user']);
						$s->execute();

						$log['event'] = "Post Blog Content";
						$log['id_post'] = '0';
						$log['id_user'] = $_COOKIE['id_user'];
						$this->addLog($log);
						return '0';
					}
					
		        } catch (PDOException $e) {
		            return $this->jsonFail("Failed post blog", array('error'=>$e->getMessage()));
		        }   
	    	}

    	} else {
			setcookie('jwtcookie', null, -1, '/');
    		setcookie('username', null, -1, '/');
    		setcookie('id_user', null, -1, '/');	
			$this->view->render($response, 'login/login.php');
		}

	}

	public function del_blog($request, $response)
	{
		
		if(isset($_COOKIE['jwtcookie'])) {

			try {
				// Delete thumbnail
				// unlink('/opt/lampp/htdocs/dev/awk-slim3/asset/image_post/' . $_POST['filename']);

				// $s = "delete from wp_post where id_post = :id_post and id_user = :id_user";
				$s = "UPDATE wp_post SET status = '2' where id_post = :id_post and id_user = :id_user";
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
	}

	public function edit_post($request, $response)
	{

		if(isset($_COOKIE['jwtcookie'])) {

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

	}

	public function upd_blog($request, $response)
	{		

		if(isset($_COOKIE['jwtcookie'])) {

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
	}

	public function get_list_upl($request, $response)
	{

		if(isset($_COOKIE['jwtcookie'])) {

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
							<a title='Download' class='btn btn-warning btn-xs' href = ' " .$this->base_url(). "downFiles?eid_upload=" .$v['id_upload']. "' style='cursor:pointer'><i class='fa fa-download'></i></a>

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

		} else {

    		setcookie('jwtcookie', null, -1, '/');
    		setcookie('username', null, -1, '/');
    		setcookie('id_user', null, -1, '/');
    		$this->view->render($response, 'login/login.php');
    	}
	}

	public function uplFiles($request, $response)
	{
		// echo ("<pre>");
		// print_r($_FILES);
		// echo ("</pre>"); 
		// exit;

		if(isset($_COOKIE['jwtcookie'])) {

			for ($i=0; $i < count($_FILES['uplName']['name']); $i++) { 
				if($_FILES['uplName']['size'][$i] >= '2000000' ) {
					return '1';
					exit();
				} else if ($_FILES['uplName']['error'][$i] != '0' ) {
					return '2';
					exit();
				} 
			}

			$id_user = $_COOKIE['id_user'];
			$id_post = $_POST['id_post'];
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

				// header('Location: http://' . $_SERVER['SERVER_NAME'] . '/dev/awk-slim3/public/myblog' );
				return '0';
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
		if(isset($_COOKIE['jwtcookie'])) {
		
			try{
				$s = "delete from wp_media where id_upload = :id_upload";
				$s = 	$this->db->prepare($s);
				$s->bindparam(":id_upload",$this->param['id_upload']);
				$s->execute();

				return '1';

			} catch (PDOException $e) {
				return $this->jsonFail("Failed delete upload", array('error'=>$e->getMessage()));
			}

		} else {

    		setcookie('jwtcookie', null, -1, '/');
    		setcookie('username', null, -1, '/');
    		setcookie('id_user', null, -1, '/');
    		$this->view->render($response, 'login/login.php');
    	}
	}	

  public function downFiles($request, $response)
  {

		if(isset($_COOKIE['jwtcookie'])) {

			$s = "select * from wp_media where id_upload = $_GET[eid_upload]";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetch(\PDO::FETCH_ASSOC);

			header("Content-Type: application/octet-stream"); 
			header("Content-Transfer-Encoding: Binary");
			header("Content-disposition: attachment; filename=\" ". $data['filename'] ."\" ");
			echo $data['media'];
			exit;

		} else {

			setcookie('jwtcookie', null, -1, '/');
			setcookie('username', null, -1, '/');
			setcookie('id_user', null, -1, '/');
			$this->view->render($response, 'login/login.php');
		}
  }

  public function search_blog($request, $response)
  {

 //  	$s = "SELECT ID_TAXONOMY FROM M_TAXONOMY WHERE NM_TAXONOMY LIKE '%".$this->param['k']."%'";
 //  	$s = $this->db->prepare($s);	
	// $s->execute();
	// $s = $s->fetchAll(\PDO::FETCH_ASSOC);

	// $data = array_column($s, 'ID_TAXONOMY');
	// for ($i=0; $i < count($data); $i++) { 
	// 	$id_txn[] = "SELECT NM_TAXONOMY FROM M_TAXONOMY WHERE ID_TAXONOMY = '$data[$i]' ) AS txn$data[$i] ";
	// }
  	
  	// echo "<pre>";
  	// print_r("(".implode(",(", $id_txn)); 
  	// echo "</pre>";
  	// $taxon = "(".implode(",(", $id_txn);  	

	$q = "SELECT wp.*
		FROM wp_post wp
		WHERE (post_title LIKE '%".$this->param['k']."%' OR post_content LIKE '%".$this->param['k']."%') 
		AND id_user = '$_COOKIE[id_user]'
		ORDER BY rating_post desc";
  	$q = $this->db->prepare($q);	
  	// $q->bindparam(":k",$this->param['k']);
	$q->execute();
	$q = $q->fetchAll(\PDO::FETCH_ASSOC);
	return json_encode($q);
	// echo "<pre>";
 //  	print_r($q); 
 //  	echo "</pre>";
  }
	// End function my blog page

}