<?php
/**
 * 

 * @author        Hakimuddin Jamali <hakimjamali@outlook.com>
 *
 * DO NOT put config.php and cookie.txt into public accessable area.
 *
 */
define('ROOTPATH',dirname(__FILE__));

class FrappeClient {

	public $errorno = 0;
	public $error;
	public $body;
	public $header;
	public $is_auth = false;

	private $_auth_url = "";
	private $_api_url = "";
	private $_cookie_file = "";
	private $_auth = array();
	private $_basic_auth = array();
	private $_curl_timeout = 30;
	private $_limit_page_length = 20;
	
	function get_data($key){
		$value = "";
		$dbprefix = $this->CI->db->dbprefix;
		$sql = "SELECT * FROM ".$dbprefix."data WHERE ck_key = ?"; 
		$results = $this->CI->db->query($sql, array($key));
		$data = $results->row(); 
		if($data){
			
			$value = $data->ck_value;
		}
		return $value;
	}
	
	function __construct(
				$usr=""
				,$pwd=""
		){
			$this->CI =&get_instance();
			$this->CI->load->database();
			
			$erpnext_url = $this->get_data('erpnext_url');
			
			$erpnext_username = $this->get_data('erpnext_username');
			$erpnext_password = $this->get_data('erpnext_password');
			
			$conf = array(
					'auth_url' => $erpnext_url . '/api/method/login',
					'api_url' => $erpnext_url .'/api/resource/',
					'auth' => array('usr' => $erpnext_username, 'pwd' => $erpnext_password),
					'cookie_file' => dirname(__FILE__).'/cookie.txt',
					'curl_timeout' => 30,

					'basic_auth' => array(),
					'basic_auth' => array('usr' => '', 'pwd' => ''),

			);
			
			foreach($conf as $key => $value){
				if(property_exists($this, '_'.$key)){
					$this->{'_'.$key} = $value;
				}
			}
			if(!is_writable( dirname( $this->_cookie_file) ) ){
				throw new FrappeClient_Exception(
							"Cookie file not writable:".$this->_cookie_file
							,2
						);
			}
			if($usr && $pwd){
				$this->_auth = array(
					'usr' => $usr,
					'pwd' => $pwd,
					);
			}
			$this->_auth();
		}

	private function _auth_check(){
		if($this->is_auth == false){
			throw new FrappeClient_Exception(
						"Auth check fail."
						,3
					);
		}else{
			return true;
		}
	}

	private function _auth(){
		if(is_file($this->_cookie_file)){
			@unlink($this->_cookie_file);
		}
		$login_result = $this->_curl('AUTH',$this->_auth);
		if(isset($login_result->body->message)){
			$this->is_auth = true;
		}else{
			throw new FrappeClient_Exception(
						"Auth fail."
						,4
					);
		}
		if(!is_file($this->_cookie_file)){
			throw new FrappeClient_Exception(
						"Cookie file not found:".$this->_cookie_file
						,5
					);
		}
	}

	public function get(
			$doctype
			,$key
		){
			$this->_auth_check();
			return $this->_curl(
				'GET'
				, array(
					'doctype' => $doctype
					,'data' => $key
					)
				);
		}

	public function search(
			$doctype
			,$conditions=array()
			,$fields=array()
			,$limit_start=0
			,$limit_page_length=0
		){
			$this->_auth_check();
			if($limit_page_length){
				$limit = $limit_page_length;
			}else{
				$limit = $this->_limit_page_length;
			}
			return $this->_curl(
						'SEARCH'
						, array(
							'doctype' => $doctype,
							'filters' => $conditions,
							'fields' => $fields,
							'limit_start' => $limit_start,
							'limit_page_length' => $limit
							)
						);
		}

	public function update(
			$doctype
			,$key
			,$params
		){
			$this->_auth_check();
			return $this->_curl(
				'UPDATE'
				, array('doctype' => $doctype, 'key' => $key,'data' => $params )
				);
		}

	public function insert(
			$doctype
			,$params
		){
			$this->_auth_check();
			return $this->_curl(
				'INSERT'
				, array('doctype' => $doctype, 'data' => $params )
				);
		}

	public function delete(
			$doctype
			,$key
		){
			$this->_auth_check();
			return $this->_curl(
				'DELETE'
				, array('doctype' => $doctype, 'key' => $key)
				);
		}

	private function _curl(
			$method='GET'
			,$params=array()
		){
			switch($method){
				case 'AUTH':
						$url = $this->_auth_url;
						$ch = curl_init($url);
						curl_setopt($ch,CURLOPT_POST, true);
						curl_setopt($ch,CURLOPT_POSTFIELDS, $this->_auth);
						curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
					break;
				case 'UPDATE':
						$url = $this->_api_url.$params['doctype'].'/'.$params['key'];
						$ch = curl_init($url);
						curl_setopt(
								$ch
								,CURLOPT_POSTFIELDS
								,array( 'data' => json_encode($params['data']) )
							);
						curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'PUT');
					break;
				case 'INSERT':
						$url = $this->_api_url.$params['doctype'];
						
						$data_string = "data=".json_encode($params['data']); 
						
						$ch = curl_init($url);
						curl_setopt(
								$ch
								,CURLOPT_POSTFIELDS
								,$data_string
							);
						curl_setopt($ch,CURLOPT_POST, true);
					break;
				case 'DELETE':
						$url = $this->_api_url.$params['doctype'].'/'.$params['key'];
						$ch = curl_init($url);
						curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'DELETE');
					break;
				case 'SEARCH':
						$query = array();
						if($params['filters']){
							$query['filters'] = json_encode($params['filters']);
						}
						if($params['fields']){
							$query['fields'] = json_encode($params['fields']);
						}
						if($params['limit_start']){
							$query['limit_start'] = json_encode($params['limit_start']);
						}
						if($params['limit_page_length']){
							$query['limit_page_length'] = json_encode($params['limit_page_length']);
						}
						$url = $this->_api_url.$params['doctype'];
						if($query){
							$url .= '?';
							foreach($query as $key => $value){
								$url .= $key.'='.$value.'&';
							}
						}
						$ch = curl_init($url);
						curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');

					break;
				case 'GET':
				default:
						$query = array();
						$url = $this->_api_url.$params['doctype'].'/'.urlencode($params['data']);
						$ch = curl_init($url);
						curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
					break;
			}
			if(!empty($this->_basic_auth)){
					curl_setopt($ch,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt(
					$ch
				,CURLOPT_USERPWD
					, $this->_basic_auth['usr'].':'.$this->_basic_auth['pwd']
					);
			}
			curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($ch,CURLOPT_COOKIEJAR, $this->_cookie_file);
			curl_setopt($ch,CURLOPT_COOKIEFILE, $this->_cookie_file);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($ch,CURLOPT_TIMEOUT, $this->_curl_timeout);
			$response = curl_exec($ch);
			$this->header = curl_getinfo($ch);
			$error_no = curl_errno($ch);
			$error = curl_error($ch);
			curl_close($ch);
			if($error_no){
				$this->error_no = $error_no;
			}
			if($error){
				$this->error = $error;
			}
			$this->body = @json_decode($response);
			if(JSON_ERROR_NONE != json_last_error()){
				$this->body = $response;
			}
			return $this;
		}

	}


class FrappeClient_Exception extends Exception {

	public function __construct(
			$message
			, $code = 0
		) {
			parent::__construct(
						@$message
						,@$code
						,@$previous
					);
		}
	public function __toString() {
		return __CLASS__ .': ['.$this->code.']: '.$this->message.PHP_EOL;
	}

}


