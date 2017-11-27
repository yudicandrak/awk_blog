<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class categoryControl extends BaseController
{
	// Start funtion dashboard
	public function index($request, $response){
		if(isset($_COOKIE['jwtcookie'])) {
			if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {
				$s = "select id_user, full_name, photo from wp_user where id_user = $_COOKIE[id_user]";
				$s = $this->db->prepare($s);
				$s->execute();
				$dt = $s->fetch(\PDO::FETCH_ASSOC);
				// $data = $dt[0];
				// $id['id'] = $_GET['id'];
				$data = array('id' => $_GET['id'], 'full_name' => $dt['full_name'], 'photo' => $dt['photo'], 'base_url' => $this->base_url() );
			
				$this->view->render($response, 'header_page.php', $data);
				$this->view->render($response, 'category.php', $data);
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
	
	public function get_blog($request, $response){
		// print_r($_POST);exit();
		$id_cat = $_POST['id_cat'];
		try {
			$s = "select tbl.*, group_concat(concat(md.filename,'----', md.id_upload) separator '____') as fn_media from(SELECT ps.*, us.username,
				 us.photo, 
				 (select count(id_comment) from wp_comment cm where id_post = ps.id_post and status = 0) as c_comment
				FROM wp_post ps join wp_user us ON ps.id_user = us.id_user where ps.post_date < NOW()) tbl
				left join wp_media md
					on tbl.id_post = md.id_post
				join wp_menu_c wmc  
					on wmc.id_child = tbl.category
				where tbl.category = '$id_cat'
				group by tbl.id_post
				order by tbl.post_date desc";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
			// print_r($data);exit();
			foreach($data as $k=>$v){
				$v_like = $u_like = $like = '';
				$c_like = 0;
				$data[$k]['b_like'] = 'fa-thumbs-o-up';
				$e_ul = explode('_',$data[$k]['user_like']);
				if($data[$k]['user_like'] != ''){
					foreach($e_ul as $kk=>$vv){
						if($vv == $_COOKIE['id_user']){
							$v_like = 'You';
							$data[$k]['b_like'] = 'fa-thumbs-up';
						}else{
							if($vv != ''){
								$u_like = $u_like.$vv."_";
								$c_like++;
							}
						}
					}
				}
				if($c_like == 0){
					$like = $v_like;
				}else{
					if($v_like == ''){
						$like = $c_like;
					}else{
						$like = $v_like.' and '.$c_like.' Other';
						$data[$k]['b_like'] = 'fa-thumbs-up';
					}
				}
				$data[$k]['jumlah_like'] = $like;
				$data[$k]['user_unlike'] = $u_like;
			}
			//print_r($data);exit;
            return json_encode($data);
        } catch (PDOException $e) {
            return $this->jsonFail("Can not load data: attachment ", array('error'=>$e->getMessage()));
        }
	}
	
	
}