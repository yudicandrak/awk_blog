<?php

namespace App\Controllers;

use PDO;

class BaseController
{
	protected $container;
    protected $dbpdo;
    protected $param;
    protected $db;

	public function __construct($container)
	{
		global $pdo;
		$this->container = $container;

		$this->db = $pdo;
		$this->dbpdo = $pdo;
		$this->dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->param = $this->container->get('request')->getParsedBody();
	}

	// load container to view in controller 
	public function __get($property)
	{
		if($this->container->{$property}) {
			return $this->container->{$property};
		}
	}

	function encode_jwt($user, $id_user, $check)
	{		
		// base64 encodes the header json
		$encoded_header = base64_encode('{"alg": "HS256","typ": "JWT"}');

		// base64 encodes the payload json
		$encoded_payload = base64_encode("{'usernama': $user,'id_user': $id_user}");

		// base64 strings are concatenated to one that looks like this
		$header_payload = $encoded_header . '.' . $encoded_payload;

		//Setting the secret key
		$secret_key = 'cobajwtaccess';

		// Creating the signature, a hash with the s256 algorithm and the secret key. The signature is also base64 encoded.
		$signature = base64_encode(hash_hmac('sha256', $header_payload, $secret_key, true));

		// Creating the JWT token by concatenating the signature with the header and payload, that looks like this:
		$jwt_token = $header_payload . '.' . $signature;
		
		//listing the resulted  JWT
		if($check == 0) {
			setcookie("jwtcookie", $jwt_token, time() + 21600, "/");
			return $jwt_token; 			
		} else {
			return $jwt_token; 			
		}
	}

	function decode_jwt($jwt)
	{			
		if(isset($_COOKIE['jwtcookie'])) {
			$receiveJWT = $jwt;

			$secret_key = 'cobajwtaccess';

			// split valueJWT
			$jwt_value = explode('.', $receiveJWT);

			// extract signature
			$receive_signature = $jwt_value[2];

			// receiver $header and $payload
			$receiveHeaderAndPayload = $jwt_value[0] . '.' . $jwt_value[1];

			$resultSignature = base64_encode(hash_hmac('sha256', $receiveHeaderAndPayload, $secret_key, true));

			if($resultSignature == $receive_signature) {
				return 1; // match			
			} else {
				return 0; // not match
			}
		} else {
			return 0;
		}		
	}

	public function base_url()
	{
		return "http://" . $_SERVER['SERVER_NAME'] . "/dev/awk-slim3/";
	}

	public function addLog($log) 
	{
		try {
			$s = "insert into wp_log
			(id_log, event, time, id_post, id_user)
			values 
			('', '$log[event]', NOW(), '$log[id_post]', '$log[id_user]') ";
			$s = $this->db->prepare($s);			
			$s->execute();
			
        } catch (PDOException $e) {
            return $this->jsonFail("Failed add log", array('error'=>$e->getMessage()));
        }
	}
	
	public function add_rating_post($id_post, $value){
		try {
			$s = "update wp_post set rating_post = rating_post $value where id_post = $id_post";
			$s = $this->db->prepare($s);			
			$s->execute();
			
        } catch (PDOException $e) {
            return $this->jsonFail("Failed add rating", array('error'=>$e->getMessage()));
        }
	}
}