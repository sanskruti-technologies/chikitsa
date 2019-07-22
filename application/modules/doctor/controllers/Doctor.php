<?php
class Doctor extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('contact/contact_model');
        $this->load->model('doctor_model');
		$this->load->model('menu_model');
	    $this->load->model('settings/settings_model');
        $this->load->model('admin/admin_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('payment/payment_model');
		
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('date');
        $this->load->helper('currency');
		$this->load->helper('my_string_helper');
		
        $this->load->library('form_validation');
		$this->load->library('session');
		
        $this->load->database();
		$this->lang->load('main');
    }
	/** List All Doctors */
    public function index() {	
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$data['doctors'] = $this->doctor_model->find_doctor();
			$data['departments'] = $this->doctor_model->get_all_departments();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');			
            $this->load->view('doctor/browse_doctor', $data);
            $this->load->view('templates/footer');
		}
    }
	public function nurse() {	
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$data['nurses'] = $this->doctor_model->get_nurse();
			
			$data['departments'] = $this->doctor_model->get_all_departments();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');			
            $this->load->view('doctor/browse_nurse', $data);
            $this->load->view('templates/footer');
		}
    }
	public function remove_nurse_profile_image($nurse_id){
		$nurse = $this->doctor_model->get_nurse_details($nurse_id);
		$contact_id = $nurse['contact_id'];
		$this->contact_model->update_profile_image("",$contact_id);
		echo $nurse_id;
		//$this->nurse_detail($nurse_id);
	}
	public function remove_profile_image($doctor_id){
		$doctor = $this->doctor_model->get_doctor_doctor_id($doctor_id);
		$contact_id = $doctor['contact_id'];
		$this->contact_model->update_profile_image("",$contact_id);
		$this->doctor_detail($doctor_id);
	}
	/** File Upload for Doctor Profile Image */
	public function do_upload($contact_id) {
        $config['upload_path'] = './uploads/profile_picture/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = '512';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $contact_id;
		$this->load->library('upload', $config);
		$image='file_name';
		if (!$this->upload->do_upload($image)) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data'];
		}
    }
	public function view_doctor($doctor_id) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$data['doctor_id'] = $doctor_id;
			$doctor_details = $this->doctor_model->get_doctor_details($doctor_id);
			$data['doctor_details'] = $doctor_details;
			$contact_id = $doctor_details['contact_id'];
			$data['contacts'] = $this->contact_model->get_contacts($contact_id);
			$data['departments'] = $this->doctor_model->get_all_departments();
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('view', $data);
			$this->load->view('templates/footer');
		}
    }
	public function doctor_detail($doctor_id = NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			if($doctor_id == NULL || $doctor_id == 0){
				$this->form_validation->set_rules('first_name',  $this->lang->line('first_name'), 'required');
				$this->form_validation->set_rules('last_name',  $this->lang->line('last_name'), 'required');
				$this->form_validation->set_rules('email',  $this->lang->line('email'), 'valid_email');
				if ($this->form_validation->run() === FALSE) {
					//Insert New Doctor
					$data['doctor_id'] = 0;
					$data['departments'] = $this->doctor_model->get_all_departments();
					$data['file_error'] = "";
					$data['def_dateformate'] = $this->settings_model->get_date_formate();
					$this->load->view('templates/header');
					$this->load->view('templates/menu');
					$this->load->view('form',$data);
					$this->load->view('templates/footer');
				}else{
					$contact_id = $this->contact_model->insert_contact(); 	
					$user_id = $this->admin_model->add_user($contact_id);	
					$doctor_id = $this->doctor_model->insert_doctors($contact_id);
					$file_upload = $this->do_upload($contact_id); 
					if(isset($file_upload['error']) && $file_upload['error']=='<p>You did not select a file to upload.</p>'){
						$this->index();
					}elseif(isset($file_upload['error'])){
						$data['file_error'] = $file_upload['error'];
						$data['doctor_id'] = $doctor_id;
						$doctor_details = $this->doctor_model->get_doctor_details($doctor_id);
						$data['doctor_details'] = $doctor_details;
						$contact_id = $doctor_details['contact_id'];
						$data['contacts'] = $this->contact_model->get_contacts($contact_id);
						$data['departments'] = $this->doctor_model->get_all_departments();
						$this->load->view('templates/header');
						$this->load->view('templates/menu');
						$this->load->view('form', $data);	
						$this->load->view('templates/footer');
					}else{
						if(isset($file_upload['file_name'])){
							$file_name = $file_upload['file_name'];
						}else{	
							$file_name = "";
						}
						$this->contact_model->update_profile_image($file_name,$contact_id);
						
						$this->index();
					}
				}
				
			}else{
				//Edit Doctor
				$this->form_validation->set_rules('first_name',  $this->lang->line('first_name'), 'required');
				$this->form_validation->set_rules('last_name',  $this->lang->line('last_name'), 'required');
				$this->form_validation->set_rules('email',  $this->lang->line('email'), 'valid_email');
				if ($this->form_validation->run() === FALSE) {
					$data['doctor_id'] = $doctor_id;
					$doctor_details = $this->doctor_model->get_doctor_details($doctor_id);
					$data['doctor_details'] = $doctor_details;
					$contact_id = $doctor_details['contact_id'];
					$user_id = $doctor_details['userid'];
					$data['contacts'] = $this->contact_model->get_contacts($contact_id);
					$data['user'] = $this->admin_model->get_user($user_id);
					$data['departments'] = $this->doctor_model->get_all_departments();
					$data['file_error'] = "";
					$data['def_dateformate'] = $this->settings_model->get_date_formate();
					$this->load->view('templates/header');
					$this->load->view('templates/menu');
					$this->load->view('form', $data);	
					$this->load->view('templates/footer');
				}else{
					$contact_id = $this->input->post('contact_id');
					$file_upload = $this->do_upload($contact_id); 
					if(isset($file_upload['error']) && $file_upload['error']=='<p>You did not select a file to upload.</p>'){
						$this->contact_model->update_contact();
						$this->contact_model->update_address();
						$this->doctor_model->update_doctors();
						$doctor_details = $this->doctor_model->get_doctor_details($doctor_id);
						if($doctor_details['userid']!=""){
							$user_id = $this->admin_model->add_user($contact_id);	
						}else{
							$this->admin_model->update_password($user_id,$password);
						}
						$this->index();
					}elseif(isset($file_upload['error'])){
						$data['file_error'] = $file_upload['error'];
						$data['doctor_id'] = $doctor_id;
						$doctor_details = $this->doctor_model->get_doctor_details($doctor_id);
						$data['doctor_details'] = $doctor_details;
						$contact_id = $doctor_details['contact_id'];
						$data['contacts'] = $this->contact_model->get_contacts($contact_id);
						$data['departments'] = $this->doctor_model->get_all_departments();
						$this->load->view('templates/header');
						$this->load->view('templates/menu');
						$this->load->view('form', $data);	
						$this->load->view('templates/footer');
					}else{
						if(isset($file_upload['file_name'])){
							$file_name = $file_upload['file_name'];
						}else{	
							$file_name = "";
						}
						$this->contact_model->update_contact($file_name);
						$this->contact_model->update_address();
						$this->doctor_model->update_doctors();
						$this->index();
					}
				}
			}
		}
    }
	public function nurse_detail($nurse_id = NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			if($nurse_id == NULL || $nurse_id == 0){
				$this->form_validation->set_rules('first_name',  $this->lang->line('first_name'), 'required');
				$this->form_validation->set_rules('last_name',  $this->lang->line('last_name'), 'required');
				$this->form_validation->set_rules('email',  $this->lang->line('email'), 'valid_email');
				if ($this->form_validation->run() === FALSE) {
					//Insert New Nurse
					$data['nurse_id'] = 0;
					$data['departments'] = $this->doctor_model->get_all_departments();
					$data['file_error'] = "";
					$data['def_dateformate'] = $this->settings_model->get_date_formate();
					$this->load->view('templates/header');
					$this->load->view('templates/menu');
					$this->load->view('nurse_form',$data);
					$this->load->view('templates/footer');
				}else{
					$contact_id = $this->contact_model->insert_contact(); 	
					$nurse_id = $this->doctor_model->insert_nurse($contact_id);
					$file_upload = $this->do_upload($contact_id); 
					if(isset($file_upload['error']) && $file_upload['error']=='<p>You did not select a file to upload.</p>'){
						$this->nurse();
					}elseif(isset($file_upload['error'])){
						$data['file_error'] = $file_upload['error'];
						$data['nurse_id'] = $nurse_id;
						$nurse_details = $this->doctor_model->get_nurse_details($nurse_id);
						$data['nurse_details'] = $nurse_details;
						$contact_id = $nurse_details['contact_id'];
						$data['contacts'] = $this->contact_model->get_contacts($contact_id);
						$data['departments'] = $this->doctor_model->get_all_departments();
						$data['def_dateformate'] = $this->settings_model->get_date_formate();
						$this->load->view('templates/header');
						$this->load->view('templates/menu');
						$this->load->view('nurse_form', $data);	
						$this->load->view('templates/footer');
					}else{
						if(isset($file_upload['file_name'])){
							$file_name = $file_upload['file_name'];
						}else{	
							$file_name = "";
						}
						$this->contact_model->update_profile_image($file_name,$contact_id);
						
						$this->nurse();
					}
				}
				
			}else{
				//Edit Nurse
				$this->form_validation->set_rules('first_name',  $this->lang->line('first_name'), 'required');
				$this->form_validation->set_rules('last_name',  $this->lang->line('last_name'), 'required');
				$this->form_validation->set_rules('email',  $this->lang->line('email'), 'valid_email');
				if ($this->form_validation->run() === FALSE) {
					$data['nurse_id'] = $nurse_id;
					$nurse_details = $this->doctor_model->get_nurse_details($nurse_id);
					$data['nurse_details'] = $nurse_details;
					$contact_id = $nurse_details['contact_id'];
					$user_id = $nurse_details['userid'];
					$data['contacts'] = $this->contact_model->get_contacts($contact_id);
					$data['user'] = $this->admin_model->get_user($user_id);
					$data['departments'] = $this->doctor_model->get_all_departments();
					$data['file_error'] = "";
					$data['def_dateformate'] = $this->settings_model->get_date_formate();
					$this->load->view('templates/header');
					$this->load->view('templates/menu');
					$this->load->view('nurse_form', $data);	
					$this->load->view('templates/footer');
				}else{
					$contact_id = $this->input->post('contact_id');
					$file_upload = $this->do_upload($contact_id); 
					if(isset($file_upload['error']) && $file_upload['error']=='<p>You did not select a file to upload.</p>'){
						$this->contact_model->update_contact();
						$this->contact_model->update_address();
						$this->doctor_model->update_nurse();
						$nurse_details = $this->doctor_model->get_nurse_details($nurse_id);
						if($nurse_details['userid']!=""){
							$user_id = $this->admin_model->add_user($contact_id);	
						}else{
							$this->admin_model->update_password($user_id,$password);
						}
						$this->nurse();
					}elseif(isset($file_upload['error'])){
						$data['file_error'] = $file_upload['error'];
						$data['nurse_id'] = $nurse_id;
						$nurse_details = $this->doctor_model->get_nurse_details($nurse_id);
						$data['nurse_details'] = $nurse_details;
						$contact_id = $nurse_details['contact_id'];
						$data['contacts'] = $this->contact_model->get_contacts($contact_id);
						$data['departments'] = $this->doctor_model->get_all_departments();
						$data['def_dateformate'] = $this->settings_model->get_date_formate();
						$user_id = $nurse_details['userid'];
						$data['user'] = $this->admin_model->get_user($user_id);
						$this->load->view('templates/header');
						$this->load->view('templates/menu');
						$this->load->view('nurse_form', $data);	
						$this->load->view('templates/footer');
					}else{
						if(isset($file_upload['file_name'])){
							$file_name = $file_upload['file_name'];
						}else{	
							$file_name = "";
						}
						//echo $file_name."<br/>";
						$this->contact_model->update_contact($file_name);
						$this->contact_model->update_address();
						$this->doctor_model->update_nurse();
						$this->nurse();
					}
				}
			}
		}
    }
	public function delete_doctor($doctor_id) {       
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->doctor_model->delete_doctor($doctor_id);
			$this->index();
		}
	}
	public function delete_nurse($nurse_id) {       
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->doctor_model->delete_nurse($nurse_id);
			$this->nurse();
		}
	}
	public function copy_from_users(){
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->doctor_model->copy_from_users();
			$this->index();
		}
	}
	/*Department ---------------------------------------------------------------------------------------*/
	public function department(){	
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$data['departments'] = $this->doctor_model->get_all_departments();
			$this->load->view('templates/header');
			$this->load->view('templates/menu');			
			$this->load->view('doctor/department', $data);
			$this->load->view('templates/footer');
		}
	}	
	public function add_department() {   
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('department_name', $this->lang->line('department')." ". $this->lang->line('name'), 'required');
            if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('department_form');
				$this->load->view('templates/footer');	
			}else{
				$this->doctor_model->add_department();
				$this->department();
			}
		}
	}
	public function edit_department($department_id = NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('department_name',$this->lang->line('department')." ". $this->lang->line('name'), 'required');
            if ($this->form_validation->run() === FALSE) {
                $data['department'] = $this->doctor_model->get_department($department_id);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('department_form', $data);
                $this->load->view('templates/footer');
            } else {
                $this->doctor_model->update_department();
                $this->department();
            }
        }
    }
	public function delete_department($id) {       
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->doctor_model->delete_department($id);
			$this->department();
		}
	}
	/*fees master -----------------------------------------------------------------------------------*/
	public function fees() {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			if($this->session->userdata('category') == 'Doctor'){
				$user_id = $this->session->userdata('id');
				$doctor = $this->doctor_model->find_doctor($user_id);
				$data['doctor'] = $doctor;
			}else{
				$data['doctors'] = $this->doctor_model->find_doctor();
			}
			$data['fees'] = $this->doctor_model->find_fees();
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('fees',$data);
			$this->load->view('templates/footer');		
		}
	}
	public function add_fee(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('doctor', $this->lang->line('doctor')." ". $this->lang->line('id'), 'required');  
			$this->form_validation->set_rules('detail',  $this->lang->line('detail'), 'required');
			$this->form_validation->set_rules('fees',  $this->lang->line('fees'), 'required');
            if ($this->form_validation->run() === FALSE) {
				if($this->session->userdata('category') == 'Doctor'){
					$user_id = $this->session->userdata('id');
					$data['doctor']  = $this->doctor_model->find_doctor($user_id);
				}
				$data['doctors'] = $this->doctor_model->find_doctor();
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('fees_form',$data);
				$this->load->view('templates/footer');
			}else{
				$this->doctor_model->add_fees();
                $this->fees();
			}
		}
	}
	public function edit_fees($id = NULL) {
        //Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
           $this->form_validation->set_rules('doctor', $this->lang->line('doctor')." ". $this->lang->line('id'), 'required');  
			$this->form_validation->set_rules('detail',  $this->lang->line('detail'), 'required');
			$this->form_validation->set_rules('fees',  $this->lang->line('fees'), 'required');
            if ($this->form_validation->run() === FALSE) {
				if($this->session->userdata('category') == 'Doctor'){
					$user_id = $this->session->userdata('id');
					$data['doctor']  = $this->doctor_model->find_doctor($user_id);
				}else{
					$data['doctors'] = $this->doctor_model->find_doctor();
				}
                $data['fees'] = $this->doctor_model->get_fees($id);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('doctor/fees_form', $data);
                $this->load->view('templates/footer');
            } else {
                $this->doctor_model->update_fees();
                if($this->session->userdata('category') == 'Doctor'){
					$user_id = $this->session->userdata('id');
					$data['doctor'] = $this->doctor_model->find_doctor($user_id);
				}else{
					$data['doctors'] = $this->doctor_model->find_doctor();
				}
				$data['fees'] = $this->doctor_model->find_fees();
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('fees',$data);
				$this->load->view('templates/footer');	
            }
        }
    }
	public function delete_fees($id) {       
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->doctor_model->delete_fees($id);
			$this->fees();
		}
	}
	/*doctor schedule -----------------------------------------------------------------------------------*/
	public function doctor_schedule($doctor_id = NULL){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('doctor', $this->lang->line('doctor'), 'required');  
			$this->form_validation->set_rules('from_time', $this->lang->line('from_time') , 'required');
			$this->form_validation->set_rules('to_time',  $this->lang->line('to_time'), 'required');
			if ($this->form_validation->run() === FALSE) {				
				
			}else{				
				$this->doctor_model->add_drschedule();
			}
			if($this->session->userdata('category') == 'Doctor'){
				$user_id = $this->session->userdata('id');
				$data['doctor'] = $this->doctor_model->find_doctor($user_id);
			}else{
				$data['doctors'] = $this->doctor_model->find_doctor();
			}
			$data['doctor_id']=$doctor_id;
			$data['doctor_details']=$this->doctor_model->get_doctor_details($doctor_id);
			$data['drschedules'] = $this->doctor_model->find_drschedule($doctor_id);
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['def_timeformate']=$this->settings_model->get_time_formate();
			$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();
            $data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();
			$this->load->view('templates/header');
			$this->load->view('templates/menu');			
			$this->load->view('doctor/doctor_schedule', $data);
			$this->load->view('templates/footer');
		}
	}
	public function add_doctor_schedule($doctor_id = NULL){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('doctor_id', $this->lang->line('doctor'), 'required');  
			$this->form_validation->set_rules('schedule_date', $this->lang->line('date'), 'callback_validate_date_or_day');
			$this->form_validation->set_rules('day[]',$this->lang->line('day'), 'callback_validate_date_or_day');
			$this->form_validation->set_rules('from_time', $this->lang->line('from_time'), 'required');
			$this->form_validation->set_rules('to_time', $this->lang->line('to_time'), 'required');
			if ($this->form_validation->run() === FALSE) {				
				if($this->session->userdata('category') == 'Doctor'){
					$user_id = $this->session->userdata('id');
					$data['doctor'] = $this->doctor_model->find_doctor($user_id);
				}
				if($doctor_id != NULL){
					$data['doctor'] = $this->doctor_model->get_doctor_details($doctor_id);
				}
				$data['doctors'] = $this->doctor_model->find_doctor();
				$data['def_dateformate']=$this->settings_model->get_date_formate();
				$data['def_timeformate']=$this->settings_model->get_time_formate();
				$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();
				$data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();
				$this->load->view('templates/header');
				$this->load->view('templates/menu');			
				$this->load->view('doctor/doctor_schedule_form', $data);
				$this->load->view('templates/footer');
			}else{				
				$this->doctor_model->add_drschedule();
				redirect('doctor/doctor_schedule/'.$doctor_id);
			}
			
		}
	}
	public function edit_drschedule($schedule_id){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('doctor_id', $this->lang->line('doctor'), 'required');  
			$this->form_validation->set_rules('schedule_date', $this->lang->line('date'), 'callback_validate_date_or_day');
			$this->form_validation->set_rules('day[]', $this->lang->line('day'), 'callback_validate_date_or_day');
			if ($this->form_validation->run() === FALSE) {
				if($this->session->userdata('category') == 'Doctor'){
					$user_id = $this->session->userdata('id');
					$data['doctor'] = $this->doctor_model->find_doctor($user_id);
				}else{
					$data['doctors'] = $this->doctor_model->find_doctor();
				}
				$data['schedule'] = $this->doctor_model->get_schedule_from_id($schedule_id);
				$data['def_dateformate']=$this->settings_model->get_date_formate();
				$data['def_timeformate']=$this->settings_model->get_time_formate();
				$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();
				$data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();
				$this->load->view('templates/header');
				$this->load->view('templates/menu');			
				$this->load->view('doctor/doctor_schedule_form', $data);
				$this->load->view('templates/footer');
			}else{
				
				$this->doctor_model->edit_drschedule();
				redirect('doctor/doctor_schedule');
			}
		}
	}
	public function validate_date_or_day(){
	   if($this->input->post('schedule_date') || $this->input->post('day[]')){
			return TRUE;
	   }else{
	        $this->form_validation->set_message('validate_date_or_day', 'Please enter Date or select Days');
			return FALSE;
	   }
	}
	public function delete_drschedule($id) {       
		$this->doctor_model->delete_drschedule($id);
		$this->doctor_schedule();
	}
	public function inavailability() {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        }else{	
			$level = $this->session->userdata('category');
			$data['level'] = $level;
			$data['availability'] = $this->appointment_model->get_dr_inavailability();	
			$data['doctors'] = $this->doctor_model->find_doctor();
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['def_timeformate']=$this->settings_model->get_time_formate();
            $this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('inavailability',$data);
			$this->load->view('templates/footer');
		}
	}
	public function add_inavailability($appointment_id=NULL, $doctor_id=NULL,$end_date=NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index/');
        }else{
			$level = $this->session->userdata('category');
			if ($level == 'Doctor'){
				$user_id = $this->session->userdata('id');
				$data['doctors']=$this->admin_model->get_doctor($user_id);
				//print_r($data['doctors']);
				$data['doctor_id']=$data['doctors']['doctor_id'];
			}else{
				$data['doctors'] = $this->doctor_model->find_doctor();
				$data['doctor_id'] = 0;
			}
			$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();
            $data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();
			$data['time_interval'] = $this->settings_model->get_time_interval();
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['def_timeformate']=$this->settings_model->get_time_formate();
            $this->form_validation->set_rules('start_time',  $this->lang->line('start_time'), 'required');
            $this->form_validation->set_rules('end_time',  $this->lang->line('end_time'), 'required');
			$this->form_validation->set_rules('doctor',  $this->lang->line('doctor')." ". $this->lang->line('name'), 'required');
		
            if ($this->form_validation->run() === FALSE){
				
				if($doctor_id==0){
					$doctor_id=NULL;
				}
				$this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('inavailability_form', $data);
                $this->load->view('templates/footer');
            } else {
                $this->doctor_model->insert_availability($appointment_id, $user_id,$end_date);
                redirect('doctor/inavailability/');
            }
        }
    }
	public function edit_inavailability($appointment_id=NULL, $doctor_id=NULL,$end_date=NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index/');
        }
		else 
		{
			$level = $this->session->userdata('category');
			if ($level == 'Doctor'){
				$id = $this->session->userdata('id');
				$data['doctors']=$this->admin_model->get_doctor($id);
			}else{
				$data['doctors'] = $this->admin_model->get_doctor();
			}
			$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();
            $data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();
			$data['time_interval'] = $this->settings_model->get_time_interval();
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['def_timeformate']=$this->settings_model->get_time_formate();
             $this->form_validation->set_rules('start_time',  $this->lang->line('start_time'), 'required');
            $this->form_validation->set_rules('end_time',  $this->lang->line('end_time'), 'required');
			$this->form_validation->set_rules('doctor',  $this->lang->line('doctor')." ". $this->lang->line('name'), 'required');
		
            if ($this->form_validation->run() === FALSE){
				
				if($doctor_id==0){
					$doctor_id=NULL;
				}
                $data['availability'] = $this->doctor_model->get_dr_inavailability($appointment_id);
				
				$this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('inavailability_form', $data);
                $this->load->view('templates/footer');
            } 
			else
			{
                $this->doctor_model->insert_availability($appointment_id, $user_id,$end_date);
                redirect('doctor/inavailability/');
            }
        }
    }
	public function delete_availability($appointment_id) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index/');
        }else {
			$this->appointment_model->delete_availability($appointment_id);
			redirect('doctor/inavailability/');
		}
	}
	public function doctor_preference(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			if($this->session->userdata('category') == 'Doctor'){
				$user_id = $this->session->userdata('id');
				$data['doctor'] = $this->doctor_model->find_doctor($user_id);
			}else{
				$data['doctors'] = $this->doctor_model->find_doctor();
			}
			$data['doctor_id'] = 0;
			$data['doctor_preferences'] = $this->doctor_model->get_doctor_preferences();
			//$data['doctor_details']=$this->doctor_model->get_doctor_details($doctor_id);
			$this->load->view('templates/header');
			$this->load->view('templates/menu');			
			$this->load->view('doctor/doctor_preference',$data);
			$this->load->view('templates/footer');
		}
	}
	function delete_preference($preference_id){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->doctor_model->delete_preference($preference_id);
			$this->doctor_preference();
		}
	}
	function edit_preference($doctor_id){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('doctor', $this->lang->line('doctor'), 'required');
			$this->form_validation->set_rules('max_patient', $this->lang->line('max_patient'), 'required');
			if ($this->form_validation->run() === FALSE) {				
				if($this->session->userdata('category') == 'Doctor'){
					$user_id = $this->session->userdata('id');
					$data['doctor'] = $this->doctor_model->find_doctor($user_id);
				}else{
					$data['doctors'] = $this->doctor_model->find_doctor();
				}
				$level = $this->session->userdata('category');
				$data['level'] = $level;
				$data['doctor_id'] = $doctor_id;
				if(isset($doctor_id)){
					$data['doctor'] = $this->doctor_model->get_doctor_details($doctor_id);
				}
				$data['doctor_preference'] = $this->doctor_model->get_doctor_preference($doctor_id);
				$this->load->view('templates/header');
				$this->load->view('templates/menu');			
				$this->load->view('doctor/doctor_preference_form',$data);
				$this->load->view('templates/footer');
			}else{	
				$this->doctor_model->update_doctor_preference($doctor_id);
				redirect('doctor/index');
			}
		}
	}
	function insert_preference(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			//$this->form_validation->set_rules('doctor', $this->lang->line('doctor'), 'required|is_unique[doctor_preferences.doctor_id]');  
			$this->form_validation->set_rules('max_patient', $this->lang->line('max_patient'), 'required');
			if ($this->form_validation->run() === FALSE) {				
				if($this->session->userdata('category') == 'Doctor'){
					$user_id = $this->session->userdata('id');
					$data['doctor'] = $this->doctor_model->find_doctor($user_id);
				}else{
					$data['doctors'] = $this->doctor_model->find_doctor();
				}
				$data['level'] = $this->session->userdata('category');
				$this->load->view('templates/header');
				$this->load->view('templates/menu');			
				$this->load->view('doctor/doctor_preference_form',$data);
				$this->load->view('templates/footer');
			}else{
				$this->doctor_model->add_doctor_preference();
				redirect('doctor/doctor_preference');
			}
		}
	}
	function doctor_bonus(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$data['doctors'] = $this->doctor_model->find_doctor();
			$data['doctor_id'] = $this->input->post('doctor');
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['def_timeformate'] = $this->settings_model->get_time_formate();
			$data['minimum_income'] = 7500;
			$data['bonus_percentage'] = 25;
			$this->form_validation	->set_rules('month',  $this->lang->line('month'), 'required');  
			$this->form_validation->set_rules('year', $this->lang->line('year') , 'required');
			$this->form_validation->set_rules('doctor',  $this->lang->line('doctor'), 'required');
			
			if ($this->form_validation->run() === FALSE) {		
				$data['bonus_reports'] = array();
				$data['month'] = date('m');
				$data['year'] = date('Y');
			}else{
				$data['month'] = $this->input->post('month');
				$data['year'] = $this->input->post('year');
				$data['doctor_id'] = $this->input->post('doctor');
				$data['minimum_income'] = $this->input->post('minimum_income');
				$data['bonus_percentage'] = $this->input->post('bonus_percentage');
				$data['bonus_reports'] = $this->doctor_model->get_doctor_bonus_report();
			}
			$this->load->view('templates/header');
			$this->load->view('templates/menu');			
			$this->load->view('doctor/doctor_bonus_report',$data);
			$this->load->view('templates/footer');
		}
	}
}
?>