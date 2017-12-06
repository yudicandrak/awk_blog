<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class myprofile extends BaseController
{
	// Start funtion dashboard
	public function index($request, $response){
		if(isset($_COOKIE['jwtcookie'])) {
			// if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {
				//$data = [ 'username' => $_COOKIE['username'] ];
				$s = "select id_user, full_name	, photo from wp_user where id_user = $_COOKIE[id_user]";
				$s = $this->db->prepare($s);
				$s->execute();
				$dt = $s->fetch(\PDO::FETCH_ASSOC);
				//$data = $dt[0];
				$data = array('full_name' => $dt['full_name'], 'photo' => $dt['photo'], 'base_url' => $this->base_url() );
				$this->view->render($response, 'header_page.php', $data);
				$this->view->render($response, 'v_myprofile.php', $data);
				$this->view->render($response, 'footer_page.php', $data);
			} else {
				setcookie('jwtcookie', null, -1, '/');
	    		setcookie('username', null, -1, '/');
	    		setcookie('id_user', null, -1, '/');
	    		$this->view->render($response, 'login/login.php');
			}

		// } else {

		// 	$this->view->render($response, 'login/login.php');
		// }
	}
	
	public function get_profile($request, $response){
		try {
			$s = "SELECT MU.*, MT.NM_UNIT, MD.NM_DEPARTEMENT
					FROM `M_USER` MU 
					     JOIN M_UNIT MT ON MU.KD_UNIT = MT.KD_UNIT
					     JOIN M_DEPARTEMENT MD ON MT.KD_DEPARTEMENT = MD.KD_DEPARTEMENT
					WHERE ID_USER = '".$_COOKIE['id_user']."'";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetch(\PDO::FETCH_ASSOC);

			foreach ($data as $k => $v) {
				// $dt[$k] = $v; 
				$dt['USERNAME'] => $v['USERNAME'];
			    dt['USERPASS'] => $v['USERPASS'];
			    // [FULLNAME] => yudi
			    // [ID_ROLE] => 1
			}



			print_r($dt); 
			exit();
            return json_encode($data[0]);
        } catch (PDOException $e) {
            return $this->jsonFail("Can not load data", array('error'=>$e->getMessage()));
        }
	}
	
	public function upload_profile($request, $response){
		try {
			$s = "update wp_user set full_name = :name, home_address = :address, job_title = :job_title where id_user = $_COOKIE[id_user]";
			$s = $this->db->prepare($s);
			$s->bindparam(":name",$this->param['ename'], \PDO::PARAM_STR);
			$s->bindparam(":address",$this->param['eaddress'], \PDO::PARAM_STR);
			$s->bindparam(":job_title",$this->param['ejob_title'], \PDO::PARAM_STR);
			$s->execute();

			$log['event'] = "Update Profile";
			$log['id_post'] = $_COOKIE['id_user'];
			$log['id_user'] = $_COOKIE['id_user'];
			$this->addLog($log);
			
        } catch (PDOException $e) {
            return $this->jsonFail("Failed update profile", array('error'=>$e->getMessage()));
        }
	}
	
	public function change_foto($request, $response){
		//echo 'http://'.$_SERVER['HTTP_HOST'];exit;
		$type = explode("/",$_FILES['file']['type']);
		if($_FILES != null){
			if ($_FILES['file']['size'] <= 1000000) {
				if ($_FILES['file']['type']=='image/png' or $_FILES['file']['type']=='image/jpg' or $_FILES['file']['type']=='image/ico' or $_FILES['file']['type']=='image/jpeg') {
					$lok = str_replace('public/index.php','asset/photo_user/',$_SERVER['SCRIPT_FILENAME']).$_COOKIE['username'].'.'.$type[1];
					if(move_uploaded_file($_FILES["file"]["tmp_name"], $lok)){
						$s = "update wp_user set photo = '".$_COOKIE['username'].'.'.$type[1]."' where id_user = $_COOKIE[id_user]";
						$s = $this->db->prepare($s);
						if($s->execute()){
							echo 'Sukses';
						}else{
							echo 'FAILED___Upload Image Failed';
						}

						$log['event'] = "Update Photo Profile";
						$log['id_post'] = $_COOKIE['id_user'];
						$log['id_user'] = $_COOKIE['id_user'];
						$this->addLog($log);
					}else{
						echo'FAILED___Upload Image Failed';
					}
				}else{
					echo'FAILED___Format File must be *.jpg, *.png, *.jpeg or *.ico';
				}
			}else{
				echo'FAILED___The data size must be under 1Mb';
			}
		}else{
			echo 'FAILED___Image not found';
		}
	}
}