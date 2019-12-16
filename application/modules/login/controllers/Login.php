<?php
/*
	This file is part of Chikitsa.

    Chikitsa is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Chikitsa is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Chikitsa.  If not, see <https://www.gnu.org/licenses/>.
*/


class login extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->config->load('version');
        $this->load->library('form_validation');

		$this->load->helper('form');
		$this->load->helper('url');
        $this->load->helper('security');

		$this->load->model('login_model');
		$this->load->model('menu_model');
		$this->load->model('module/module_model');
		$this->load->model('settings/settings_model');
		$this->load->model('admin/admin_model');

		$this->load->library('session');

		$this->lang->load('main');
    }
	function currentUrl($server){
		//Figure out whether we are using http or https.
		$http = 'http';
		//If HTTPS is present in our $_SERVER array, the URL should
		//start with https:// instead of http://
		if(isset($server['HTTPS'])){
			$http = 'https';
		}
		//Get the HTTP_HOST.
		$host = $server['HTTP_HOST'];
		//Get the REQUEST_URI. i.e. The Uniform Resource Identifier.
		$requestUri = $server['REQUEST_URI'];
		//Finally, construct the full URL.
		//Use the function htmlentities to prevent XSS attacks.
		return $http . '://' . htmlentities($host) . htmlentities($requestUri);
	}
	public function version_check() {
		$current_version = $this->config->item('current_version');
		$db_current_version = $this->login_model->get_current_version();
		//Check Database and File Version of Chikitsa
		if ($current_version == $db_current_version) {
			//Is User logged In ?
			if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
				if($this->module_model->is_active('frontend')){
					redirect('/frontend/index', 'refresh');
				}else{
					redirect('/login/index', 'refresh');
				}
			}else{
				redirect('/appointment/index', 'refresh');
			}
		} else {
			//Upgrade database to latest version
			$base_url  = $this->config->item('base_url');
			redirect($base_url.'/install.php', 'refresh');
		}
    }
  	function login_page(){
		$level = $this->session->userdata('category');
		if($level == 'Patient'){
			return '/frontend/my_account';
		}
		$parent_name="";
		$result_top_menu = $this->menu_model->find_menu($parent_name,$level);
		foreach ($result_top_menu as $top_menu){
			$id = $top_menu['id'];
			$parent_name = $top_menu['menu_name'];
			if($this->menu_model->has_access($top_menu['menu_name'],$level)){
				if($this->menu_model->is_module_active($top_menu['required_module'])){
					$result_sub_menu = $this->menu_model->find_menu($parent_name,$level);
					$rowcount= count($result_sub_menu);
					if($rowcount != 0){
						foreach ($result_sub_menu as $sub_menu){
							if($this->menu_model->has_access($sub_menu['menu_name'],$level)){
								if($this->menu_model->is_module_active($sub_menu['required_module'])){
									return $sub_menu['menu_url'];
								}
							}
						}
					}else{
						return $top_menu['menu_url'];
					}
				}
			}
		}
		return '/appointment/index';
	}
    public function index() {
		//If Not Logged In, Go to Login Form
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
			$frontend_active=$this->module_model->is_active("frontend");
			$data['frontend_active'] = $frontend_active;
			$active_modules = $this->module_model->get_active_modules();
			$data['active_modules'] = $active_modules;
			$data['clinic']=$this->settings_model->get_clinic_settings();
	        $data['software_name']= $this->settings_model->get_data_value("software_name");
			$this->load->view('login/login_signup',$data);
		} else {
			//Go to Appointment Page if logged in
			$login_page = $this->login_page();
            redirect($login_page, 'refresh');
        }
    }
    public function valid_signin() {
		//Check if loggin details entered
        $this->form_validation->set_rules('username', $this->lang->line('username'), 'trim|required|min_length[5]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
			$logged_in = FALSE;
			$is_active = TRUE;
            if($this->input->post('username')){
				//Check Login details
				$username = $this->input->post('username');

				$password = base64_encode($this->input->post('password'));
				$result = $this->login_model->login($username, $password);
				if(!empty($result)){
					$is_active = $this->login_model->is_active($username);
					if($is_active){
						$userdata = array();
						$userdata["name"] = $result->name;
						$userdata["user_name"] = $result->username;
						$userdata["category"] = $result->level;
						$userdata["id"] = $result->userid;
						$userdata["logged_in"] = TRUE;
						$clinic = $this->settings_model->get_clinic_settings(1);
						$userdata["clinic_code"] = $clinic['clinic_code'];
						$userdata["clinic_id"] = 1;
						$this->session->set_userdata($userdata);
						$logged_in = TRUE;
					}
				}
			}
			//If Username and Password matches
			if ($logged_in) {
				$login_page = $this->login_page();
				if($this->module_model->is_active("chat")){
					$this->load->model('chat/chat_model');
					$user_id = $this->session->userdata('id');
					$status = "available";
					$timezone = $this->settings_model->get_time_zone();
					if (function_exists('date_default_timezone_set'))
						date_default_timezone_set($timezone);
					$current_time = date("Y-m-d H:i:s");

					$this->chat_model->change_status($user_id,$status, $current_time);
				}
				if($this->module_model->is_active("centers")){
					redirect('login/select_options');
				}else{
					redirect($login_page, 'refresh');
				}
			} else {

				if($is_active){
					$data['username'] = $this->input->post('username');
					$data['level'] = $this->input->post('level');
					$data['error'] = 'Invalid Username and/or Password';
					$frontend_active=$this->module_model->is_active("frontend");
					$data['frontend_active']=$frontend_active;
					$data['clinic']=$this->settings_model->get_clinic_settings();
		            $data['software_name']= $this->settings_model->get_data_value("software_name");
					$this->load->view('login/login_signup',$data);
				}else{
					$data['username'] = $this->input->post('username');
					$data['level'] = $this->input->post('level');
					$data['error'] = 'User is Inactive. Please contact Administrator.';
					$frontend_active=$this->module_model->is_active("frontend");
					$data['frontend_active']=$frontend_active;
					$data['clinic']=$this->settings_model->get_clinic_settings();
                    $data['software_name']= $this->settings_model->get_data_value("software_name");
					$this->load->view('login/login_signup',$data);
				}
			}
        }
    }
    public function logout() {
		//Destroy Session and go to login form
		if($this->module_model->is_active("chat")){
			$this->load->model('chat/chat_model');
			$user_id = $this->session->userdata('id');
			$status = "away";
			$timezone = $this->settings_model->get_time_zone();
			if (function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
			$current_time = date("Y-m-d H:i:s");

			$this->chat_model->change_status($user_id,$status, $current_time);
		}
		$this->session->sess_destroy();
        $this->index();
    }
	public function cleardata() {
		$frontend_active=$this->module_model->is_active("frontend");
		$data['frontend_active']=$frontend_active;
		$center_active=$this->module_model->is_active("center");
		$data['center_active']=$center_active;
		$this->session->sess_destroy();
		$data['clinic']=$this->settings_model->get_clinic_settings();
		$active_modules = $this->module_model->get_active_modules();
		$data['active_modules'] = $active_modules;
        $data['software_name']= $this->settings_model->get_data_value("software_name");
		$this->load->view('login/login_signup',$data);
    }
	public function forgot_password($instruction='reset_password_instructions',$error=NULL,$message=NULL){
		$frontend_active=$this->module_model->is_active("frontend");
		$data['frontend_active']=$frontend_active;
		$data['instruction']=$instruction;
		if($error != "X"){
			$data['error']=$error;
		}
		if($message != "X"){
			$data['message']=$message;
		}
		$data['clinic']=$this->settings_model->get_clinic_settings();
        $data['software_name']= $this->settings_model->get_data_value("software_name");
		$this->load->view('forgot_password',$data);
	}
	public function send_forgot_password_email(){
		$data['email'] = $this->input->post('email');
		//Check if Email is registered
		if(!$this->login_model->is_active($data['email'])){
			$no_email = 'no_email_registered';
			redirect('login/forgot_password/reset_password_instructions/'.$no_email);
		}else{
			$parameter_string = http_build_query($data);
			redirect('alert/send_alert/forgot_password/'.$parameter_string.'/login/forgot_password/reset_password_instructions/X/check_confirmation_link');
		}
	}
	public function reset_password($email,$key,$instruction='enter_new_password'){
		$data['instruction']=$instruction;
		$data['clinic']=$this->settings_model->get_clinic_settings();
		$frontend_active=$this->module_model->is_active("frontend");
		$data['frontend_active']=$frontend_active;
        $data['software_name']= $this->settings_model->get_data_value("software_name");
		$this->load->view('reset_password',$data);
	}
	public function select_options(){
		$active_modules = $this->module_model->get_active_modules();
		$data['active_modules'] = $active_modules;
		$data['clinic']=$this->settings_model->get_clinic_settings();
		if (in_array("centers", $active_modules)) {
			$data['clinics'] = $this->admin_model->get_allowed_clinics();
		}else{
			$data['clinics']=$this->settings_model->get_all_clinics();
		}
        $data['software_name']= $this->settings_model->get_data_value("software_name");
		$this->load->view('login/select_options',$data);
	}
	public function set_options(){
		$this->session->set_userdata('clinic_id', $this->input->post('clinic_id'));
		$login_page = $this->login_page();
		redirect($login_page, 'refresh');
	}
}

?>
