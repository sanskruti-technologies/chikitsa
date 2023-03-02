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
class Admin extends CI_Controller {

    function __construct() {

        parent::__construct();

		$this->config->load('version');

		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->helper('security');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('header');

		$this->load->model('menu_model');
        $this->load->model('admin_model');
		$this->load->model('contact/contact_model');
		$this->load->model('doctor/doctor_model');
		$this->load->model('module/module_model');
		$this->load->model('settings/settings_model');



		//$this->lang->load('main');
		$this->lang->load('main',$this->session->userdata('prefered_language'));
    }
	/** Users*/
    public function users($message = NULL) {
		/*Check if user has logged in*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        }else if (!$this->menu_model->can_access("all_users",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
            $data['user'] = $this->admin_model->get_users();
			$data['message'] = $message;
			$data['categories'] = $this->admin_model->find_category();

			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('users_list', $data);
			$this->load->view('templates/footer');
        }
    }
	public function add_user(){
		/*Check if user has logged in*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        }else if (!$this->menu_model->can_access("all_users",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
			$this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'callback_validate_name');
            $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'callback_validate_name');

			$this->form_validation->set_rules('level',  $this->lang->line('level') , 'trim|required');
            $this->form_validation->set_rules('username', $this->lang->line('username'), 'trim|required|min_length[5]|max_length[12]|xss_clean|is_unique[users.username]');
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', $this->lang->line('passconf'), 'trim|required');
            if ($this->form_validation->run() == FALSE) {
				$data['user']="";
				$data['message']="";
				$data['categories'] = $this->admin_model->find_category();
				$data['languages'] = $this->settings_model->get_languages();
				$active_modules = $this->module_model->get_active_modules();
				$data['active_modules'] = $active_modules;
				if (in_array("centers", $active_modules)) {
					$data['clinics'] = $this->settings_model->get_all_clinics();
				}
				$header_data = get_header_data();
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('user_form', $data);
				$this->load->view('templates/footer');
				
            } else {
      			$level = $this->input->post('level');
				$title = $this->input->post('title');
					$first_name = $this->input->post('first_name');
					$middle_name = $this->input->post('middle_name');
					$last_name = $this->input->post('last_name');
					$contact_id = $this->contact_model->insert_new_contact($first_name,$middle_name,$last_name,"",$title);
					$user_id = $this->admin_model->add_user($contact_id);
					//	if ($this->doctor_model->is_doctor($user_id)) {
					if($level == 'Doctor'){
					/*Insert in Doctor Table*/
						$this->admin_model->add_doctor_user($contact_id,$user_id);
					}
				$message['text'] = 'User added Successfully';
				$message['type'] = 'success';
				$this->users($message);
        }

		}
	}
	public function validate_name(){
	   if($this->input->post('first_name') || $this->input->post('last_name')){
			return TRUE;
	   }else{
	        $this->form_validation->set_message('validate_name', $this->lang->line('first_or_last'));
			return FALSE;
	   }
	}

  public function delete($id) {
	   /*Check if user has logged in*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        }else if (!$this->menu_model->can_access("all_users",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
        		/*if($this->doctor_model->is_doctor($id)){
          			$message['text'] = 'Cannot delete as User is Doctor';
    				$message['type'] = 'danger';
    			}else{*/
    				$this->admin_model->delete_user($id);
    				$message['text'] = 'User deleted Successfully';
    				$message['type'] = 'success';
    			//}
         		$this->users($message);
        }
    }
    public function edit_user($uid) {
        /*Check if user has logged in*/
		    if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'callback_validate_name');
            $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'callback_validate_name');
            $this->form_validation->set_rules('level', $this->lang->line('level'), 'trim|required');
		    $this->form_validation->set_rules('password', $this->lang->line('new_password'), 'trim|matches[passconf]');
            $this->form_validation->set_rules('passconf', $this->lang->line('passconf'), 'trim');
            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->admin_model->get_user_detail($uid);
 		        $data['languages'] = $this->settings_model->get_languages();
         		$contact_id = $data['user']['contact_id'];
                $data['contact'] = $this->contact_model->get_contacts($contact_id);
				$data['categories'] = $this->admin_model->find_category();
				$active_modules = $this->module_model->get_active_modules();
				$data['active_modules'] = $active_modules;
				if (in_array("centers", $active_modules)) {
					$data['clinics'] = $this->settings_model->get_all_clinics();
				}

				$header_data = get_header_data();
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('user_form', $data);
				$this->load->view('templates/footer');
       				
            } else {

						$data['user'] = $this->admin_model->get_user_detail($uid);
						$contact_id = $data['user']['contact_id'];
						//echo $contact_id;
						$first_name=$this->input->post('first_name');
						$middle_name=$this->input->post('middle_name');
						$last_name=$this->input->post('last_name');
						$title=$this->input->post('title');
                		$this->contact_model->update_contact_full($contact_id,$first_name,$middle_name,$last_name,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,$title);
                		$this->admin_model->edit_user_data($uid);
        				$message['text'] = 'User Updated Successfully';
        				$message['type'] = 'success';
        				$this->users($message);
            }
        }
	}
	
	public function remove_profile_image($user_id){
		$this->admin_model->update_profile_image($user_id,"");
		redirect("admin/change_profile");
	}
	public function do_upload() {
		$user_id = $this->session->userdata('id');
        $config['upload_path'] = './uploads/profile_picture/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['overwrite'] = TRUE;
		$date=date("dmyhis");
		$config['file_name'] = 'user_'.$date.'_'.$user_id;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('profile_image')) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data'];
		}
    }
	/**Change Profile*/
    public function change_profile() {
        //Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$user_id = $this->session->userdata('id');
			$data['user_id']=$user_id;
			$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|min_length[5]|max_length[200]|xss_clean');
            if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->admin_model->get_user_detail($user_id);
				$header_data = get_header_data();
				$data['languages']=$this->settings_model->get_language_name();
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('edit_profile', $data);
				$this->load->view('templates/footer');
			} else {
				$file_upload = $this->do_upload();
				if(isset($file_upload['error']) && $file_upload['error']!='<p>You did not select a file to upload.</p>'){
					//Display Error
					$data['error'] = $file_upload['error'];
					$data['user'] = $this->admin_model->get_user_detail($user_id);
					$data['languages']=$this->settings_model->get_language_name();
					$header_data = get_header_data();
					$this->load->view('templates/header',$header_data);
					$this->load->view('templates/menu');
					$this->load->view('edit_profile', $data);
					$this->load->view('templates/footer');
				}else{
					//print_r($file_upload);
					if(isset($file_upload['file_name'])){
						$file_name = $file_upload['file_name'];
						$this->admin_model->update_profile_image($user_id,$file_name);
					}
				}
				if ($this->input->post('newpassword') != '') {
					$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|min_length[5]|max_length[200]|xss_clean');
                    $this->form_validation->set_rules('oldpassword', $this->lang->line('oldpassword'), 'trim|required|xss_clean|callback_password_check[' . $user_id . ']');
                    $this->form_validation->set_rules('newpassword', $this->lang->line('newpassword'), 'trim|required|matches[passconf]');
                    $this->form_validation->set_rules('passconf', $this->lang->line('passconf'), 'trim|required');
                    if ($this->form_validation->run() == FALSE) {
                        $data['user'] = $this->admin_model->get_user_detail($user_id);
						$data['languages']=$this->settings_model->get_language_name();
                        $header_data = get_header_data();
                  		$this->load->view('templates/header',$header_data);
						$this->load->view('templates/menu');
                        $this->load->view('edit_profile', $data);
                        $this->load->view('templates/footer');
                    } else{
						$this->admin_model->change_profile($user_id);
						$this->admin_model->change_password($user_id);
						redirect('appointment/index');
					}
				}else{
					$this->admin_model->change_profile($user_id);
					redirect('appointment/index');
				}
			}
        }
    }
    public function password_check($str, $user_id) {
        $data['user'] = $this->admin_model->get_user_detail($user_id);
        $password = base64_decode($data['user']['password']);
        if ($str == $password) {
            return TRUE;
        } else {
            $this->form_validation->set_message('password_check', $this->lang->line('password_not_match'));
            return FALSE;
        }
    }
	public function about(){
		$data['software_name']= $this->settings_model->get_data_value("software_name");
		$data['website_url']= $this->settings_model->get_data_value("website_url");
		$data['website_text']= $this->settings_model->get_data_value("website_text");
		$data['support_url']= $this->settings_model->get_data_value("support_url");
		$data['support_text']= $this->settings_model->get_data_value("support_text");
		$data['about_us_content']= $this->settings_model->get_data_value("about_us_content");
		$data['version'] = $this->menu_model->find_version();
		$header_data = get_header_data();
		$this->load->view('templates/header',$header_data);
		$this->load->view('templates/menu');
		$this->load->view('about',$data);
		$this->load->view('templates/footer');
	}

}

?>