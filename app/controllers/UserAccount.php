<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class UserAccount extends BaseController
{
	// Start funtion dashboard
	public function index($request, $response){
		if(isset($_COOKIE['jwtcookie'])) {
			if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {
				//$data = [ 'username' => $_COOKIE['username'] ];
				$s = "select id_user, full_name, photo from wp_user where id_user = $_COOKIE[id_user]";
				$s = $this->db->prepare($s);
				$s->execute();
				$dt = $s->fetch(\PDO::FETCH_ASSOC);
				//$data = $dt[0];
				$data = array('full_name' => $dt['full_name'], 'photo' => $dt['photo'], 'base_url' => $this->base_url() );
				$this->view->render($response, 'header_page.php', $data);
				$this->view->render($response, 'v_useraccount.php', $data);
				$this->view->render($response, 'footer_page.php', $data);
			}else{
				setcookie('jwtcookie', null, -1, '/');
	    		setcookie('username', null, -1, '/');
	    		setcookie('id_user', null, -1, '/');
	    		$this->view->render($response, 'login/login.php');
			}
		}else{
			$this->view->render($response, 'login/login.php');
		}
	}
	
	public function get_user($request, $response){
		try {
			$s = "select id_user, status, job_title, full_name from wp_user";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
			foreach($data as $k=>$v){
				if($v['status'] == 0){
					$data[$k]['status'] =  '<label class="switch">
											  <input type="checkbox" checked onclick="change_status('.$v['id_user'].', 1)">
											  <span class="slider round"></span>
											</label>';
				}else{
					$data[$k]['status'] =  '<label class="switch">
											  <input type="checkbox" onclick="change_status('.$v['id_user'].', 0)">
											  <span class="slider round"></span>
											</label>';
				}
				
				$data[$k]['action'] = " <button onclick='view_user($v[id_user])' title='View' class='btActive btn btn-success btn-xs' type='button'>
											<i class='fa fa-eye'></i>
										</button>
										<button onclick='edit_user($v[id_user])' title='edit' class='btEdit btn btn-warning btn-xs' type='button'>
											<i class='glyphicon glyphicon-edit'></i>
										</button>";
			}
			$dt["data"] = $data;
            return json_encode($dt);
        } catch (PDOException $e) {
            return $this->jsonFail("Can not load data", array('error'=>$e->getMessage()));
        }
	}
	
	public function update_status($request, $response){
		try {
			$s = "update wp_user set status = :status where id_user = :id";
			$s = $this->db->prepare($s);
			$s->bindparam(":id",$this->param['eid'], \PDO::PARAM_STR);
			$s->bindparam(":status",$this->param['estatus'], \PDO::PARAM_STR);
			$s->execute();

			$log['event'] = "Update Status User";
			$log['id_post'] = $_POST['eid'];
			$log['id_user'] = $_COOKIE['id_user'];
			$this->addLog($log);
			
        } catch (PDOException $e) {
            return $this->jsonFail("Failed update profile", array('error'=>$e->getMessage()));
        }
	}
	
	public	function view_user($request, $response){
		try {
			$s = "select id_user, username, status, full_name, photo, home_address, job_title from wp_user where id_user = $_POST[eid]";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
            return json_encode($data[0]);
        } catch (PDOException $e) {
            return $this->jsonFail("Can not load data", array('error'=>$e->getMessage()));
        }
	}
	
	public function edit_user($request, $response){
		try {
			$s = "update wp_user set username = '$_POST[eusername]', home_address = '$_POST[eaddress]', job_title= '$_POST[ejtitle]', full_name= '$_POST[efullname]' where id_user = $_POST[eid]";
			$s = $this->db->prepare($s);
			if($s->execute()){
				echo 'sukses';
			}else{
				echo 'failed';
			}

			$log['event'] = "Edit User";
			$log['id_post'] = $_POST['eid'];
			$log['id_user'] = $_COOKIE['id_user'];
			$this->addLog($log);
			
        } catch (PDOException $e) {
            return $this->jsonFail("Failed update profile", array('error'=>$e->getMessage()));
        }
	}
	
	public function add_user($request, $response){
		print_r($_FILES);
	}
}