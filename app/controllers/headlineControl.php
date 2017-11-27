<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class headlineControl extends BaseController
{
	public function index($request, $response)
	{

		if(isset($_COOKIE['jwtcookie'])) {

			$s = "select id_user, full_name, photo from wp_user where id_user = $_COOKIE[id_user]";
			$s = $this->db->prepare($s);
			$s->execute();
			$dt = $s->fetch(\PDO::FETCH_ASSOC);
			// $data = $dt[0];
			$data = array('full_name' => $dt['full_name'], 'photo' => $dt['photo'], 'base_url' => $this->base_url() );	
			$this->view->render($response, 'header_page.php', $data);
			$this->view->render($response, 'setting/headline.php', $data);
			$this->view->render($response, 'footer_page.php', $data);

		} else {

			$this->view->render($response, 'login/login.php');
		}
	}

	public function get_headline($request, $response)
	{

		if(isset($_COOKIE['jwtcookie'])) {
			if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {   
				
				$s = "SELECT id_post, post_title, rating_post, status
						FROM wp_post 
						ORDER BY rating_post desc";
				$s = $this->db->prepare($s);
				$s->execute();
				$dt = $s->fetchAll(\PDO::FETCH_ASSOC);

				foreach ($dt as $k => $v) {
					foreach ($v as $kk => $vv) {
						$dt[$k][] = $vv;
					}
					if($v['status'] == '1') {

					$dt[$k][3] = 
						'<center>
						<label class="switch">
						  <input type="checkbox" checked onclick="upd_status('.$v['id_post'].', 0)">
						  <span class="slider round"></span>
						</label>
						</center>
						';
					} else {
					$dt[$k][3] = 
						'<center>
						<label class="switch">
						  <input type="checkbox" onclick="upd_status('.$v['id_post'].', 1)">
						  <span class="slider round"></span>
						</label>
						</center>
						';

					}
				}
				$dt1['data'] = $dt;
				return json_encode($dt1);

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

	public function upd_status($request, $response)
	{
		if(isset($_COOKIE['jwtcookie'])) {

    		if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {    

				try {
					$s = "update wp_post
							set status = :status
							where id_post = :id_post";
					$s = $this->db->prepare($s);
					$s->bindparam(":status",$this->param['upd_status']);
					$s->bindparam(":id_post",$this->param['id_post']);
					$s->execute();

					$log['event'] = "Update Status to " . $_POST['upd_status'];
					$log['id_post'] = $_POST['id_post'];
					$log['id_user'] = $_COOKIE['id_user'];
					$this->addLog($log);
					return '1';

		        } catch (PDOException $e) {
		            return $this->jsonFail("Failed update status", array('error'=>$e->getMessage()));
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
}