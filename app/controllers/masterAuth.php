<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class masterAuth extends BaseController{

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
				$this->view->render($response, 'v_auth.php', $data);
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

}