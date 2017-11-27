<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class generalControl extends BaseController
{
	public function index($request, $response)
	{
		try {
			$s = " select mp.*, 
					(select parent from wp_menu_p mc where id_parent = mp.id_parent ) as parent,
					(select status from wp_menu_p mc where id_parent = mp.id_parent ) as stat_parent,
					(select logo from wp_menu_p mc where id_parent = mp.id_parent) as logo
					from wp_menu_c mp ";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);

			foreach ($data as $k => $v) {
				$dt[$v['parent'].'___'.$v['logo']][$v['link']][$k] = $v['child'];
			}
			// print_r($dt);
			return json_encode($dt);

		} catch (PDOException $e) {

            return $this->jsonFail("Can't load sidemenu", array('error'=>$e->getMessage()));

		}
	}

	public function menu($request, $response)
	{

		if(isset($_COOKIE['jwtcookie'])) {

			$s = "select id_user, full_name, photo from wp_user where id_user = $_COOKIE[id_user]";
			$s = $this->db->prepare($s);
			$s->execute();
			$dt = $s->fetch(\PDO::FETCH_ASSOC);
			// $data = $dt[0];
			$data = array('full_name' => $dt['full_name'], 'photo' => $dt['photo'], 'base_url' => $this->base_url() );	
			$this->view->render($response, 'header_page.php', $data);
			$this->view->render($response, 'setting/menu.php', $data);
			$this->view->render($response, 'footer_page.php', $data);

		} else {

			$this->view->render($response, 'login/login.php');
		}
	}

	// Parent side
	public function get_parent_menu($request, $response)
	{
		try {
			
			if(!isset($_GET['data'])) {

				$s = " select * from wp_menu_p ";
				$s = $this->db->prepare($s);
				$s->execute();
				$data = $s->fetchAll(\PDO::FETCH_ASSOC);

				foreach ($data as $k => $v) {
					foreach ($v as $kk => $vv) {
						$dt[$k][] = $vv;					
					}
						$dt[$k][4] = 
						" <center>
						<button title='Edit' type='button' class='btn btn-warning btn-xs' onclick='edit_parent(". $v['id_parent'] .")' data-toggle='modal' data-target='#moded_p'> <i class='fa fa-edit'> </i></button> 

						<button title='Delete' type='button' class='btn btn-danger btn-xs' onclick='delete_parent(". $v['id_parent'] .")' data-toggle='modal' data-target='#model_p'> <i class='fa fa-trash'> </i></button>
							</center>
						";
				}			
				$dt1['data'] = $dt;
				return json_encode($dt1);
			} else {
				$id_child = $_GET['data'];

				$t = " SELECT id_parent FROM wp_menu_c WHERE id_child = '$id_child' ";
				$t = $this->db->prepare($t);
				$t->execute();
				$tdata = $t->fetch(\PDO::FETCH_ASSOC);
				// print_r($tdata);exit();

				$s = " select * from wp_menu_p ";
				$s = $this->db->prepare($s);
				$s->execute();
				$data = $s->fetchAll(\PDO::FETCH_ASSOC);

				for ($i=0; $i < count($data); $i++) { 
					if( $data[$i]['id_parent'] == $tdata['id_parent'] ) {
						$dt[] = "<option value='". $data[$i]['id_parent'] ."' selected>". $data[$i]['parent'] ."</option>";
					} else {
						$dt[] = "<option value='". $data[$i]['id_parent'] ."'>". $data[$i]['parent'] ."</option>";	
					}
				}

				return json_encode(implode(" ", $dt));
			}

		} catch (PDOException $e) {

      return $this->jsonFail("Can't get parent menu", array('error'=>$e->getMessage()));

		}
	}

	public function add_parent($request, $response)
	{
		// print_r($_POST);
		try {
			$s = " insert into wp_menu_p 
			(id_parent, parent, status, logo) 
			values 
			('', :parent, :status, :logo) ";
			$s = $this->db->prepare($s);
			$s->bindparam(":parent", $this->param['parent']);
			$s->bindparam(":status", $this->param['status']);
			$s->bindparam(":logo", $this->param['logo']);
			$s->execute();

			return '1';

		} catch (PDOException $e) {

      return $this->jsonFail("Can't get parent menu", array('error'=>$e->getMessage()));

		}

	}

	public function edit_parent($request, $response)
	{
		try {
			$s = " SELECT * FROM wp_menu_p WHERE id_parent = :id_parent ";
			$s = $this->db->prepare($s);
			$s->bindparam(":id_parent", $this->param['id_parent']);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);

			if($data[0]['status'] == 'ACTIVE') {
				$data[0]['status'] = 
					"<label class='btn btn-default active' data-toggle-class='btn-primary' data-toggle-passive-class='btn-default'>".
	          "<input type='radio' name='status' value='ACTIVE'> &nbsp; ACTIVE &nbsp;".
	        "</label>".
	        "<label class='btn btn-primary' data-toggle-class='btn-primary' data-toggle-passive-class='btn-default'>".
	          "<input type='radio' name='status' value='NOT_ACTIVE'> NOT ACTIVE ".
	        "</label>";
			} else {
				$data[0]['status'] = 
					"<label class='btn btn-default' data-toggle-class='btn-primary' data-toggle-passive-class='btn-default'>".
	          "<input type='radio' name='status' value='ACTIVE'> &nbsp; ACTIVE &nbsp;".
	        "</label>".
	        "<label class='btn btn-primary active' data-toggle-class='btn-primary' data-toggle-passive-class='btn-default'>".
	          "<input type='radio' name='status' value='NOT_ACTIVE'> NOT ACTIVE".
	        "</label>";
			}

			return json_encode($data);

		} catch (PDOException $e) {

      return $this->jsonFail("Can't load parent", array('error'=>$e->getMessage()));

		}
	}

	public function upd_parent($request, $response)
	{
		print_r($_POST);
		try{
			$s = " UPDATE wp_menu_p 
							SET parent = :upd_parent,
							status = :upd_status,
							logo = :upd_logo

							WHERE id_parent = :id_parent ";
			$s = $this->db->prepare($s);
			$s->bindparam(":id_parent", $this->param['id_parent']);
			$s->bindparam(":upd_parent", $this->param['upd_parent']);
			$s->bindparam(":upd_status", $this->param['upd_status']);
			$s->bindparam(":upd_logo", $this->param['upd_logo']);
			$s->execute();

		} catch (PDOException $e) {

			return $this->jsonFail("Can't update child", array('error'=>$e->getMessage()));

		}
	}

	public function del_parent($request, $response)
	{
		// print_r($_POST);

		try {
			$s = " DELETE FROM wp_menu_p WHERE id_parent = :id_parent ";
			$s = $this->db->prepare($s);
			$s->bindparam(":id_parent", $this->param['id_parent']);
			$s->execute();
			return 1;

		} catch (PDOException $e) {

      return $this->jsonFail("Can't delete parent menu", array('error'=>$e->getMessage()));

		}

	}

	// End parent side

	// Child Side

	public function get_child_menu($request, $response)
	{
		try {
			$s = " SELECT wmc.id_child, wmc.child, wmp.parent, wmc.link, wmc.status 
							FROM wp_menu_c wmc JOIN wp_menu_p wmp 
							on wmc.id_parent = wmp.id_parent";
			$s = $this->db->prepare($s);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);

			foreach ($data as $k => $v) {
				foreach ($v as $kk => $vv) {
					$dt[$k][] = $vv;
					
				}
					$dt[$k][5] = 
					" <center>
					<button title='Edit' type='button' class='btn btn-warning btn-xs' onclick='edit_child(". $v['id_child'] .")' data-toggle='modal' data-target='#moded_c'> <i class='fa fa-edit'> </i></button> 

					<button title='Delete' type='button' class='btn btn-danger btn-xs' onclick='delete_child(". $v['id_child'] .")' data-toggle='modal' data-target='#model_c'> <i class='fa fa-trash' ></i></button>
					</center>
					";
			}			
			$dt1['data'] = $dt;
			return json_encode($dt1);

		} catch (PDOException $e) {

      return $this->jsonFail("Can't get child menu", array('error'=>$e->getMessage()));

		}
	}

	public function add_child($request, $response)
	{
		// print_r($_POST); exit;
		try {
			$s = " insert into wp_menu_c 
			(id_child, child, link, status, id_parent) 
			values 
			('', :child, :link, :status, :id_parent) ";
			$s = $this->db->prepare($s);
			$s->bindparam(":child", $this->param['child']);
			$s->bindparam(":link", $this->param['link']);
			$s->bindparam(":status", $this->param['status']);
			$s->bindparam(":id_parent", $this->param['parent']);
			$s->execute();
			
			return '1';

		} catch (PDOException $e) {

      return $this->jsonFail("Failed insert child menu", array('error'=>$e->getMessage()));

		}
	}

	public function edit_child($request, $response)
	{
		try {
			$s = " SELECT * FROM wp_menu_c WHERE id_child = :id_child ";
			$s = $this->db->prepare($s);
			$s->bindparam(":id_child", $this->param['id_child']);
			$s->execute();
			$data = $s->fetchAll(\PDO::FETCH_ASSOC);


			if($data[0]['status'] == 'ACTIVE') {
				$data[0]['status'] = 
					"<label class='btn btn-default active' data-toggle-class='btn-primary' data-toggle-passive-class='btn-default'>".
	          "<input type='radio' name='status' value='ACTIVE'> &nbsp; ACTIVE &nbsp;".
	        "</label>".
	        "<label class='btn btn-primary' data-toggle-class='btn-primary' data-toggle-passive-class='btn-default'>".
	          "<input type='radio' name='status' value='NOT_ACTIVE'> NOT ACTIVE ".
	        "</label>";
			} else {
				$data[0]['status'] = 
					"<label class='btn btn-default' data-toggle-class='btn-primary' data-toggle-passive-class='btn-default'>".
	          "<input type='radio' name='status' value='ACTIVE'> &nbsp; ACTIVE &nbsp;".
	        "</label>".
	        "<label class='btn btn-primary active' data-toggle-class='btn-primary' data-toggle-passive-class='btn-default'>".
	          "<input type='radio' name='status' value='NOT_ACTIVE'> NOT ACTIVE".
	        "</label>";
			}
			// print_r($data); exit;

			return json_encode($data);

		} catch (PDOException $e) {

      return $this->jsonFail("Can't edit child", array('error'=>$e->getMessage()));

		}
	}

	public function upd_child($request, $response)
	{
		print_r($_POST);
		try{

			$s = " UPDATE wp_menu_c 
							SET child = :upd_child,
							link = :upd_link,
							status = :upd_status,
							id_parent = :upd_dr_chs_parent

							WHERE id_child = :id_child ";
			$s = $this->db->prepare($s);
			$s->bindparam(":id_child", $this->param['id_child']);
			$s->bindparam(":upd_child", $this->param['upd_child']);
			$s->bindparam(":upd_link", $this->param['upd_link']);
			$s->bindparam(":upd_status", $this->param['upd_status']);
			$s->bindparam(":upd_dr_chs_parent", $this->param['upd_dr_chs_parent']);
			$s->execute();

		} catch (PDOException $e) {

			return $this->jsonFail("Can't update child", array('error'=>$e->getMessage()));

		}
	}

	public function del_child($request, $response)
	{

		// print_r($_POST);
		try {
			$s = " DELETE FROM wp_menu_c WHERE id_child = :id_child ";
			$s = $this->db->prepare($s);
			$s->bindparam(":id_child", $this->param['id_child']);
			$s->execute();
			return '1';

		} catch (PDOException $e) {

      return $this->jsonFail("Can't delete child menu", array('error'=>$e->getMessage()));

		}
	}

	// End child side

	public function icon_info($request, $response)
	{
		$this->view->render($response, 'icons.php');
	}


}