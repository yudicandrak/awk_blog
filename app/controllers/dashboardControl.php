<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class dashboardControl extends BaseController
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
				$data = array('full_name' => $dt['full_name'], 'photo' => $dt['photo'], 'base_url' => $this->base_url() );
				//$data = $dt[0];
				$this->view->render($response, 'header_page.php', $data);
				$this->view->render($response, 'dashboard.php', $data);
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

	// Function slider
	public function cont_slide($request, $response)
	{
		try {
			$s = "
				select * from (
				  select wu.username, wp.id_post as id_post, wp.post_title, wp.post_content, count(wc.id_comment) as jml_comment
				    from wp_post wp join wp_comment wc on wp.id_post = wc.id_post
				    join wp_user wu on wp.id_user = wu.id_user
				  group by wp.id_post
				) as new
				order by jml_comment desc
				limit 3";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
            return json_encode($data);
			
        } catch (PDOException $e) {
            return $this->jsonFail("Can not load data", array('error'=>$e->getMessage()));
        }
	}
	
	public function get_post($request, $response){
		try {
			$s = "SELECT ps.id_post, ps.post_title, ps.media, ps.user_like, ps.post_date, us.full_name,
				(select count(id_comment) from wp_comment cm where id_post = ps.id_post and status = 0) as c_comment
				FROM wp_post ps join wp_user us ON ps.id_user = us.id_user where ps.post_date < NOW() order by ps.post_date desc";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
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
	
	public function views_comment($request, $response){
		$id_post = $_POST['eid_post'];
		try {
			$s = "SELECT cm.*, us.username, us.photo FROM wp_comment cm join wp_user us on cm.id_user = us.id_user WHERE id_post = '$id_post' and cm.status = 0";
			$s = $this->db->prepare($s);
			$s->execute();
			$data['isi'] = $s->fetchAll(\PDO::FETCH_ASSOC);
			$data['id_user'] = $_COOKIE['id_user'];
            return json_encode($data);
			
        } catch (PDOException $e) {
            return $this->jsonFail("Can not load data: attachment ", array('error'=>$e->getMessage()));
        }
	}
	
	public function count_comment($request, $response){
		$id_post = $_POST['eid_post'];
		try {
			$s = "SELECT COUNT(id_comment) as c_comment FROM wp_comment WHERE id_post = $id_post and status = 0";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
            return json_encode($data);
			
        } catch (PDOException $e) {
            return $this->jsonFail("Can not load data: attachment ", array('error'=>$e->getMessage()));
        }
	}
	
	public function post_comment($request, $response){
		try {
			$s = "insert into wp_comment
			(id_comment, comment_author , comment_content, post_date, upd_date, status, id_post, id_user)
			value
			('', '5', :comment, NOW(), NOW(), 0, :id_post, $_COOKIE[id_user])";
			$s = $this->db->prepare($s);
			$s->bindparam(":comment",$this->param['ecomment']);
			$s->bindparam(":id_post",$this->param['eid_post']);
			$s->execute();

			$log['event'] = "Post Comment";
			$log['id_post'] = '0';
			$log['id_user'] = $_COOKIE['id_user'];
			$this->addLog($log);
			
			$this->add_rating_post($_POST['eid_post'], '+1');
			
        } catch (PDOException $e) {
            return $this->jsonFail("Failed post comment", array('error'=>$e->getMessage()));
        }
	}
	
	public function taxonomomi_das($request, $response){
		try {
			$s = "SELECT tx.*, (select count(tag) from wp_post where tag like concat('%',tx.id,'%')) as c_taxonomi, (select count(id_post) from wp_post) as count_wp
				FROM wp_taxonomi tx order by c_taxonomi desc";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
            return json_encode($data);
			
        } catch (PDOException $e) {
            return $this->jsonFail("Can not load data: attachment ", array('error'=>$e->getMessage()));
        }
	}
	
	public function delete_comment($request, $response){
		try {
			$s = "update wp_comment set status = 1 where id_comment = :id_comment";
			$s = $this->db->prepare($s);
			$s->bindparam(":id_comment",$this->param['eid_comment'], \PDO::PARAM_STR);
			$s->execute();

			$log['event'] = "Delete Comment";
			$log['id_post'] = $_POST['eid_comment'];
			$log['id_user'] = $_COOKIE['id_user'];
			$this->addLog($log);
			
			$this->add_rating_post($_POST['eid_post'], '-1');
			
        } catch (PDOException $e) {
            return $this->jsonFail("Failed post comment", array('error'=>$e->getMessage()));
        }
	}
	
	public function button_like($request, $response){
		try {
			if($_POST['efunc'] == 'like'){
				$s = "update wp_post set user_like = :user_unlike, rating_post = rating_post-3 where id_post = :id_post";
				$s = $this->db->prepare($s);
				$s->bindparam(":id_post",$this->param['eid_post'], \PDO::PARAM_STR);
				$s->bindparam(":user_unlike",$this->param['euser_unlike'], \PDO::PARAM_STR);
				$s->execute();
				$log['event'] = "Unlike Post";
				$log['id_post'] = $_POST['eid_post'];
				$log['id_user'] = $_COOKIE['id_user'];
				$this->addLog($log);
			}else{
				$s = "update wp_post set user_like = '".($_POST['euser_unlike'].$_COOKIE['id_user'].'_')."', rating_post = rating_post+3 where id_post = :id_post";
				$s = $this->db->prepare($s);
				$s->bindparam(":id_post",$this->param['eid_post'], \PDO::PARAM_STR);
				$s->execute();
				$log['event'] = "Like Post";
				$log['id_post'] = $_POST['eid_post'];
				$log['id_user'] = $_COOKIE['id_user'];
				$this->addLog($log);
			}
			$v_like = $u_like = $like = '';
			$c_like = 0;
			$s = "select user_like from wp_post where id_post = '".$_POST['eid_post']."'";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);
			$e_ul = explode('_',$data[0]['user_like']);
			$data[0]['b_like'] = 'fa-thumbs-o-up';
			if($data[0]['user_like'] != ''){
				foreach($e_ul as $kk=>$vv){
					if($vv == $_COOKIE['id_user']){
						$v_like = 'You';
						$data[0]['b_like'] = 'fa-thumbs-up';
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
					$data[0]['b_like'] = 'fa-thumbs-up';
				}
			}
			$data[0]['jumlah_like'] = $like;
			$data[0]['user_unlike'] = $u_like;
            return json_encode($data);
        } catch (PDOException $e) {
            return $this->jsonFail("Failed like", array('error'=>$e->getMessage()));
        }	
	}
	
	public function view_post($request, $response){
		if(isset($_COOKIE['jwtcookie'])) {
			if( $this->decode_jwt($_COOKIE['jwtcookie']) == '1' ) {
				//$data = [ 'username' => $_COOKIE['username'] ];
				$s = "select id_user, full_name, photo from wp_user where id_user = $_COOKIE[id_user]";
				$s = $this->db->prepare($s);
				$s->execute();
				$dt = $s->fetch(\PDO::FETCH_ASSOC);
				$data = array('full_name' => $dt['full_name'], 'id_post'=>$_GET['eid_post'], 'photo' => $dt['photo'], 'base_url' => $this->base_url());
				$this->view->render($response, 'header_page.php', $data);
				$this->view->render($response, 'view_post.php', $data);
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