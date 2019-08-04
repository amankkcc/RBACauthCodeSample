<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require  APPPATH . 'third_party/vendor/autoload.php';
use \Firebase\JWT\JWT;
class Auth_token{
	protected $key = '269c0a56ae7a4ccc9aee0776f5056c0c';

  function __construct() 
    {
     

      $this->redis = new Redis();
      $this->redis->connect('localhost', '6379');

    }

    function request_headers() {
        $arh = array();
        $rx_http = '/\AHTTP_/';
        foreach($_SERVER as $key => $val) {
                if( preg_match($rx_http, $key) ) {
                        $arh_key = preg_replace($rx_http, '', $key);
                        $rx_matches = array();
                        // do string manipulations to restore the original letter case
                        $rx_matches = explode('_', $arh_key);
                        if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
                                foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
                                $arh_key = implode('-', $rx_matches);
                        }
                        $arh[$arh_key] = $val;
                }
        }
        return( $arh );
      }// end of request headers function

	  function generate_key($len = 16)
    {
        $data = openssl_random_pseudo_bytes($len);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0010
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
    }// end of generate key function

    function get_token($username, $user){
	    
	     $token = array();
        $token['id'] = $this->generate_key();
        $token['iss'] = 'sitecontrol';
        $token['username'] = $username;
        $token['user_id'] = $user['user_id'];
        $token['user_type'] = $user['user_type'];
        $date = new DateTime();
        $token['iat'] = $date->getTimestamp();
        
        $msg = JWT::encode($token, $this->key);


        $data = array(
          'user_id' => $user['user_id'],
          'name'     => $user['first_name'],
          'is_active' =>$user['is_active'],
          'is_phone_verified' => $user['is_phone_verified'],
          'email'   =>$user['email'],
          'user_type' => $user['user_type'],
          'ipath'   => $user['path'],
          'ifile_name' => $user['file_name'],
          'login_count' =>0

        );

        $this->redis->hmset($token['id'], $data);
        return $msg;
  	}// end of get token function


    function update_redis_data($data){
      $decoded = (array)$this->get_decoded();
      $result = $this->redis->hmset($decoded['id'], $data);
      if($result)
      return $decoded['id'];
    else
      return false;
    }// end of funcion update redis data


  	function get_decoded(){
        $headers = $this->request_headers();
        if(isset($headers['JWT'])){
              $jwt = $headers['JWT'];
              try {
                  $decoded = JWT::decode($jwt, $this->key, array('HS256'));
              } catch (Exception $e){
                      $decoded = "Token expired";
              }
             
        }
        else{
          $decoded = "Token doesn't exist";
        }
          return $decoded;
     
  	}// end of function get decoded

    function get_redis_data(){
       $decoded = (array)$this->get_decoded();
        $redis_data = $this->redis->hgetall($decoded['id']);
        return $redis_data;
    }// end of get redis tata function
      


    function verify_token(){
        
        
        $decoded = (array)$this->get_decoded();
        if(isset($decoded['user_id'])){
          $redis_data = $this->get_redis_data();
          if($redis_data)
           $auth_data = $redis_data;
         else
           $auth_data = "Logged Out";
        }
        else{
          $auth_data = 'Token is not valid';
        }

        return $auth_data;
    
    }//end of vefify token function



    function token_logout($id){
        $q = $this->redis->del($id);
        return $q;
    }// end of token logout function

}// end of auth token class