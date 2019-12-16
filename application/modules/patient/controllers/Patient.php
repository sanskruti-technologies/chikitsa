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

class Patient extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->config->load('version');

        $this->load->model('contact/contact_model');
        $this->load->model('patient_model');
	    $this->load->model('settings/settings_model');
        $this->load->model('admin/admin_model');
		$this->load->model('doctor/doctor_model');
        $this->load->model('appointment/appointment_model');
		$this->load->model('module/module_model');
		$this->load->model('bill/bill_model');
		$this->load->model('payment/payment_model');
		$this->load->model('menu_model');

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('currency');
		$this->load->helper('date');
		$this->load->helper('mainpage');
        $this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('export');

		$this->load->database();
		$this->lang->load('main');
    }
	/** Browse all patients*/
    public function index(){
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');
			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
	        $header_data['software_name']= $this->settings_model->get_data_value("software_name");

			$data['show_columns'] = array($this->lang->line('id'),
											$this->lang->line('ssn_id'),
											$this->lang->line('name'),
											$this->lang->line('display')." ".$this->lang->line("name"),
											$this->lang->line('phone_number'),
											$this->lang->line('email'),
											$this->lang->line('reference_by'),
											$this->lang->line('added_date'),
											$this->lang->line('visit'),
											$this->lang->line('follow_up'),
											$this->lang->line('delete'));
			if($this->input->post('show_columns[]') != null){
				$data['show_columns'] = $this->input->post('show_columns[]');
			}

			$this->load->view('templates/header_chikitsa',$header_data);
		    $this->load->view('templates/menu');
            $this->load->view('patient/browse',$data);
            $this->load->view('templates/footer');
        }
    }
	public function ajax_all_patients() {

		$show_columns = $this->input->post('show_columns');
		$level = $this->session->userdata('category');
		$patients = $this->patient_model->find_patient();
		$contact_details = $this->contact_model->get_all_contact_details();
		$def_dateformate = $this->settings_model->get_date_formate();
		$ajax_data = array();
		foreach ($patients as $patient){
			$col = array();
			if(isset($patient['followup_date']) && $patient['followup_date'] != '0000-00-00'){
				$followup_date = date($def_dateformate,strtotime($patient['followup_date']));
			}else{
				$followup_date = "Set Next Follow Up";
			}
			$col[$this->lang->line('id')] = $patient['display_id'];
			$col[$this->lang->line('ssn_id')] = $patient['ssn_id'];
			$col[$this->lang->line('name')] = "<a class='btn btn-info btn-sm square-btn-adjust' title='Edit' href='".site_url("patient/edit/" . $patient['patient_id']."/patient")."'>".$patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'] ."</a>";
			$col[$this->lang->line("display")." ".$this->lang->line("name")] = $patient['display_name'];
			$contacts = "";
			foreach($contact_details as $contact_detail){
				if($contact_detail['contact_id'] == $patient['contact_id']){
					if($contacts == ""){
						$contacts .= $contact_detail['detail'];
					}else{
						$contacts .= ",".$contact_detail['detail'];
					}
				}
			}
			$col[$this->lang->line('phone_number')] = $contacts;
			$col[$this->lang->line("email")] = $patient['email'];
			$reference_by = $patient['reference_by'];
			if($patient['reference_by_detail'] != NULL || $patient['reference_by_detail']!= ""){
				$reference_by .= $patient['reference_by_detail'];
			}
			$col[$this->lang->line('reference_by')] = $reference_by;
			$col[$this->lang->line("added_date")] = date($def_dateformate,strtotime($patient['patient_since']));;
			if($level != "Receptionist") {
				$col[$this->lang->line("visit")] = "<a class='btn btn-primary btn-sm square-btn-adjust' title='Visit' href='".site_url("patient/visit/" . $patient['patient_id'])."'>". $this->lang->line("visit")."</a>";
			}
			$col[$this->lang->line("follow_up")] = "<a class='btn btn-success btn-sm square-btn-adjust' title='Follow Up' href='".site_url("patient/followup/" . $patient['patient_id'])."'>".$followup_date."</a>";
			if($level != "Receptionist") {
				$col[$this->lang->line('delete')]="<a class='btn btn-danger btn-sm square-btn-adjust confirmDelete deletePatient' data-patient_id='".$patient['patient_id']."' title='".$this->lang->line('delete')."' >".$this->lang->line("delete")."</a>";
			}
			$ajax_data[] = $col;
		}
		echo '{ "data":'.json_encode($ajax_data).'}';
	}
	/** File Upload for Patient Profile Image */
	public function do_upload() {
        $config['upload_path'] = './uploads/profile_picture/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $this->input->post('contact_id');
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data'];
		}
    }
	public function remove_profile_image($patient_id,$called_from){
		$patient = $this->patient_model->get_patient_detail($patient_id);
		$contact_id = $patient['contact_id'];
		$this->contact_model->update_profile_image("",$contact_id);
		$this->edit($patient_id,$called_from);
	}
	/** Edit Patient Details */
	public function edit($patient_id=NULL,$called_from) {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'callback_validate_name');
            $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'callback_validate_name');
			$this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email');

			if ($this->form_validation->run() === FALSE) {
				$contact_id = $this->patient_model->get_contact_id($patient_id);
				$data['called_from']=$called_from;
				$data['patient_id'] = $patient_id;
				$data['contact_details'] = $this->contact_model->get_contact_details($contact_id);
				$data['patient'] = $this->patient_model->get_patient_detail($patient_id);
				$data['contacts'] = $this->contact_model->get_contacts($contact_id);
				$data['address'] = $this->contact_model->get_contact_address($contact_id);
				$data['emails'] = $this->contact_model->get_contact_email($contact_id);
				$data['def_dateformate'] = $this->settings_model->get_date_formate();
				$data['references'] = $this->settings_model->get_reference_by();
				$active_modules = $this->module_model->get_active_modules();
				$data['active_modules'] = $active_modules;
				if (in_array("history", $active_modules)) {
					$this->load->model('history/history_model');
					$data['section_master'] = $this->history_model->get_section_by_display_in("patient_detail");
					$data['section_fields'] = $this->history_model->get_fields_by_display_in("patient_detail");
					$data['section_conditions'] = $this->history_model->get_conditions_by_display_in("patient_detail");
					$data['field_options'] = $this->history_model->get_field_options_by_display_in("patient_detail");
					$data['field_name'] = $this->history_model->get_field_names();
					$data['patient_history_details'] = $this->history_model->get_patient_history_details($patient_id);
				}
				if (in_array("alert", $active_modules)) {
					$this->load->model('alert/alert_model');
					$data['alerts'] = $this->alert_model->get_all_alerts();
					if( method_exists($this->alert_model, 'get_patient_alerts') ){
						$data['patient_alerts'] = $this->alert_model->get_patient_alerts($patient_id);
					}
				}
				$clinic_id = $this->session->userdata('clinic_id');
				$user_id = $this->session->userdata('user_id');
				$header_data['clinic_id'] = $clinic_id;
				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
				$header_data['active_modules'] = $this->module_model->get_active_modules();
				$header_data['user_id'] = $user_id;
				$header_data['user'] = $this->admin_model->get_user($user_id);
				$header_data['login_page'] = get_main_page();
	            $header_data['software_name']= $this->settings_model->get_data_value("software_name");


				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('form', $data);
				$this->load->view('templates/footer');
			} else {
				$patient_id = $this->input->post('patient_id');

				$file_upload = $this->do_upload();
				//Error uploading the file
				if(isset($file_upload['error']) && $file_upload['error']!='<p>You did not select a file to upload.</p>'){
					$contact_id = $this->patient_model->get_contact_id($patient_id);
					$data['patient_id'] = $patient_id;
					$data['patient'] = $this->patient_model->get_patient_detail($patient_id);
					$this->patient_model->update_reference_by($patient_id);
					$data['contacts'] = $this->contact_model->get_contacts($contact_id);
					$data['address'] = $this->contact_model->get_contact_address($contact_id);
					$data['emails'] = $this->contact_model->get_contact_email($contact_id);
					$data['def_dateformate'] = $this->settings_model->get_date_formate();
					$data['error'] = $file_upload['error'];
					$data['references'] = $this->settings_model->get_reference_by();
					$clinic_id = $this->session->userdata('clinic_id');
					$user_id = $this->session->userdata('user_id');
					$header_data['clinic_id'] = $clinic_id;
					$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
					$header_data['active_modules'] = $this->module_model->get_active_modules();
					$header_data['user_id'] = $user_id;
					$header_data['user'] = $this->admin_model->get_user($user_id);
					$header_data['login_page'] = get_main_page();
                    $header_data['software_name']= $this->settings_model->get_data_value("software_name");


					$this->load->view('templates/header',$header_data);
					$this->load->view('templates/menu');
					$this->load->view('form', $data);
					$this->load->view('templates/footer');
				} else {
					if(isset($file_upload['file_name'])){
						$file_name = $file_upload['file_name'];
					}else{
						$file_name = NULL;
					}
					//Save the details
					if(isset($patient_id) && $patient_id!=NULL){
						$this->contact_model->update_contact($file_name);
						$contact_id = $this->patient_model->get_contact_id($patient_id);
						$this->contact_model->update_contact_details($contact_id);
						$this->contact_model->update_address();
						$this->patient_model->update_reference_by($patient_id);
						$this->patient_model->update_patient_data($patient_id);
						$this->patient_model->update_display_id();
						$active_modules = $this->module_model->get_active_modules();
						if (in_array("history", $active_modules)) {
							$this->load->model('history/history_model');
							$this->history_model->update_patient_history_details($patient_id);
						}
						if (in_array("alert", $active_modules)) {
							$this->load->model('alert/alert_model');
							if( method_exists($this->alert_model, 'set_patient_alerts') ){
								$this->alert_model->set_patient_alerts($patient_id);
							}
						}

						if($called_from =="patient"){
							$message = "Patient updated successfully!";

							$this->index($message);
						}else{
							redirect('patient/visit/' . $patient_id);
						}
					}else{
						$this->patient_model->update_reference_by($patient_id);
						$contact_id = $this->contact_model->insert_contact();
						$timezone = $this->settings_model->get_time_zone();
						if (function_exists('date_default_timezone_set'))
							date_default_timezone_set($timezone);
						$patient_since = date("Y-m-d");
						$patient_id = $this->patient_model->insert_patient($contact_id,$patient_since);
						$active_modules = $this->module_model->get_active_modules();
						if (in_array("account", $active_modules)) {
							$this->load->model('account/account_model');
							$this->account_model->insert_account_for_patient($contact_id);
						}
						$this->contact_model->insert_contact_details($contact_id);
						$this->contact_model->update_profile_image($file_name,$contact_id);
						$active_modules = $this->module_model->get_active_modules();
						if (in_array("history", $active_modules)) {
							$this->load->model('history/history_model');
							$this->history_model->add_patient_history_details($patient_id);
						}
						if (in_array("alert", $active_modules)) {
							$this->load->model('alert/alert_model');
							if( method_exists($this->alert_model, 'set_patient_alerts') ){
								$this->alert_model->set_patient_alerts($patient_id);
							}
						}
						if (in_array("alert", $active_modules)) {
							//Send Alert : new_patient
							redirect("alert/send/new_patient/$patient_id/0/0/0/0/0/patient/index/0/0/0");
						}else{
							$message = "Patient added successfully!";
							//echo $message;
							$this->index($message);
						}
					}
                }
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
	/**Just show the Form to Add Patient */
    public function insert() {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['references'] = $this->settings_model->get_reference_by();
			$active_modules = $this->module_model->get_active_modules();
			$data['active_modules'] = $active_modules;
			if (in_array("history", $active_modules)) {
				$this->load->model('history/history_model');
				$data['section_master'] = $this->history_model->get_section_by_display_in("patient_detail");
				$data['section_fields'] = $this->history_model->get_fields_by_display_in("patient_detail");
				$data['field_options'] = $this->history_model->get_field_options_by_display_in("patient_detail");
			}
			if (in_array("alert", $active_modules)) {
				$this->load->model('alert/alert_model');
				$data['alerts'] = $this->alert_model->get_all_alerts();
				$data['patient_alerts'] = array();
			}
			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');
			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
            $header_data['software_name']= $this->settings_model->get_data_value("software_name");


			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('form', $data);
			$this->load->view('templates/footer');
        }
    }
	/** Delete Patient */
    public function delete($patient_id) {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$contact_id = $this->patient_model->get_contact_id($patient_id);
			$this->patient_model->delete_patient($patient_id);
			$this->contact_model->delete_contact($contact_id);
			$active_modules = $this->module_model->get_active_modules();
			if (in_array("history", $active_modules)) {
				$this->load->model('history/history_model');
				$this->history_model->delete_patient_history_detail($patient_id);
				$data['section_fields'] = $this->history_model->get_fields_by_display_in("patient_detail");
				$data['field_options'] = $this->history_model->get_field_options_by_display_in("patient_detail");
			}
            //$this->index();
        }
    }
	public function add_inquiry(){
		$contact_id = $this->contact_model->insert_contact();
		$today = date('Y-m-d');
		$patient_id = $this->patient_model->insert_patient($contact_id,$today);
		echo "Patient Inquiry Saved";
	}
	public function insert_patient(){
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$mobile_number = $_POST['mobile_number'];
		$gender = $_POST['gender'];
		$dob = $_POST['dob'];
		$age = $_POST['age'];
		$contact_id = $this->contact_model->insert_new_contact($first_name,$middle_name,$last_name,$mobile_number);
		$this->contact_model->insert_contact_details_full($contact_id,'mobile',$mobile_number,1);
		$display_id = "";
		$reference_by = "Self";
		$patient_id = $this->patient_model->insert_patient_full($contact_id,$display_id,$reference_by,$gender,$dob,$age);

		$patient_array = array();
		$patient_array['patient_id'] = $patient_id;
		$patient_array['patient_name'] = $first_name." ".$middle_name." ".$last_name;
		$patient_array['gender'] = $gender;
		$patient_array['phone_number'] = $mobile_number;
		$patient_array['dob'] = $dob;
		$patient_array['age'] = $age;

		echo json_encode($patient_array);
	}
	/** Visit details of a Patient*/
    public function visit($patient_id = NULL, $appointment_id = NULL, $app_date = NULL, $hour = NULL , $min = NULL,$session_date_id = NULL) {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$data = array();
			//Set Timezone
			$timezone = $this->settings_model->get_time_zone();
			if (function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
			$user_id = $this->session->userdata('user_id');
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['def_timeformate'] = $this->settings_model->get_time_formate();
			$data['morris_date_format'] = $this->settings_model->get_morris_date_format();
			$data['morris_time_format'] = $this->settings_model->get_morris_time_format();
			$level = $this->session->userdata('category');
			$data['level'] = $level;

			$data['curr_date']=date($data['def_dateformate']);
			$data['curr_time']=date($data['def_timeformate']);

			$data['error']="";
			$doctor_id = NULL;
			$active_modules = $this->module_model->get_active_modules();
			$data['active_modules'] = $active_modules;

			$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();
            $data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();
			$data['time_interval'] = $this->settings_model->get_time_interval();
			$data['contact_details'] = $this->contact_model->get_all_contact_details();
			if ($this->session->userdata('category') == 'Doctor'){
				$id = $this->session->userdata('id');
				$data['doctors']=$this->admin_model->get_doctor($id);
			}else{
				$data['doctors'] = $this->doctor_model->get_doctors();
				//print_r($data);
				$this->form_validation->set_rules('doctor', $this->lang->line('doctor'), 'required');
			}

			$data['back_date_visit'] = 0;
			if (in_array("menu_access", $active_modules)){
				$this->load->model('menu_access/menu_access_model');
				if ( method_exists($this->menu_access_model,'access_granted')){
					$data['back_date_visit'] = $this->menu_access_model->access_granted('back_date_visit', $this->session->userdata('category'));
				}
			}
			if (in_array("treatment", $active_modules)){
				$this->load->model('treatment/treatment_model');
            	$data['treatments'] = $this->treatment_model->get_treatments();
            	$data['treatment_name'] = $this->treatment_model->get_treatment_name();
            }
			if (in_array("lab", $active_modules)){
				$this->load->model('lab/lab_model');
            	$data['lab_tests'] = $this->lab_model->get_tests();
            }
			if (in_array("disease", $active_modules)){
				$this->load->model('disease/disease_model');
            	$data['diseases'] = $this->disease_model->get_diseases();
            	$data['visit_diseases'] = $this->disease_model->get_visit_diseases_for_patient($patient_id);
			}
			if (in_array("prescription", $active_modules)){
				$this->load->model('prescription/prescription_model');
            	$data['medicines'] = $this->prescription_model->get_medicines();
			}
			if (in_array("history", $active_modules)) {
				$this->load->model('history/history_model');
				$data['section_master'] = $this->history_model->get_section_by_display_in("visits");
				$data['section_fields'] = $this->history_model->get_fields_by_display_in("visits");
				if ( method_exists($this->history_model,'get_conditions_by_display_in')){
				$data['section_conditions'] = $this->history_model->get_conditions_by_display_in("visits");
				}else{
				    $data['section_conditions'] = array();
				}
				$data['field_options'] = $this->history_model->get_field_options_by_display_in("visits");
				if ( method_exists($this->history_model,'get_field_names')){
				$data['field_name'] = $this->history_model->get_field_names();
				}else{
				    $data['field_name'] = array();
				}
				//$data['patient_history_details'] = $this->history_model->get_patient_history_details($patient_id);
			}
			$data['clinic_settings'] = $this->settings_model->get_clinic_settings();
			$data['working_days']=$this->settings_model->get_exceptional_days();
			$data['appointment_doctor'] = 0;
			$data['next_followup_date'] = $this->calculate_next_followup_date();

			$this->form_validation->set_rules('doctor', $this->lang->line('doctor'), 'required');
			$this->form_validation->set_rules('visit_date', $this->lang->line('visit_date'), 'required');
            $this->form_validation->set_rules('visit_time', $this->lang->line('visit_time'), 'required');

            if ($this->form_validation->run() === FALSE) {

            }else {
		        $visit_id = $this->patient_model->insert_visit();
				$data['bill_id'] = $this->bill_model->get_bill_id($visit_id);
				$appointment_id=$this->input->post('appointment_id');
				$this->appointment_model->add_visit_id_to_appointment($appointment_id,$visit_id);
				$patient_id = $this->input->post('patient_id');
				$doctor_id = $this->input->post('doctor');
				$bill_id = $this->bill_model->create_bill($visit_id, $patient_id,0,$doctor_id);

				if (in_array("treatment", $active_modules)) {
					$this->load->model('treatment/treatment_model');
					if ( method_exists($this->treatment_model,'add_visit_treatment')){
						$this->treatment_model->add_visit_treatment($visit_id);
					}
					if($this->input->post('treatment')){
						$treatments = $this->input->post('treatment');
						foreach($treatments as $treatment_id){
							$treatment = $this->treatment_model->get_treatment($treatment_id);
							$this->bill_model->add_bill_item('treatment', $bill_id, $treatment['treatment'], 1, $treatment['price'], $treatment['price'], NULL, NULL, NULL);
						}
					}
				}
				if (in_array("lab", $active_modules)) {
					$this->load->model('lab/lab_model');
					$this->lab_model->add_test_visit($visit_id);
					$lab_tests = $this->input->post('lab_test[]');
					foreach($lab_tests as $test_id){
						$lab_test = $this->lab_model->get_test($test_id);
						$this->bill_model->add_bill_item('lab_test', $bill_id, $lab_test['test_name'], 1, $lab_test['test_charges'], $lab_test['test_charges'], NULL, NULL, NULL);
					}
				}
				if (in_array("sessions", $active_modules)){
					$session_date_id = $this->input->post('session_date_id');
					if($session_date_id != NULL){
						$this->load->model('sessions/sessions_model');
						$this->sessions_model->update_visit_id($session_date_id,$visit_id);
					}
				}
				if (in_array("prescription", $active_modules)){
					$this->prescription_model->insert_prescription($visit_id,$patient_id);
				}
                $doctor_id = $this->input->post('doctor');
				if($this->input->post('followup_date')!== NULL){
					$this->patient_model->change_followup_detail($patient_id,$doctor_id);
				}
				if (in_array("history", $active_modules)) {
					$this->load->model('history/history_model');
					$this->history_model->update_visit_history_details($visit_id);
				}
				$level = $this->session->userdata('category');
				if($level != "Nurse"){
					$this->appointment_model->change_status($appointment_id,"Complete");
				}
            }

			$data['patient_id'] = $patient_id;
			if (!isset($appointment_id) || $appointment_id == 0) {
                $result = $this->appointment_model->get_appointment_by_patient($patient_id);

                if ($result == FALSE) {
                    $data['appointment_id'] = NULL;
                    $data['start_time'] = NULL;
                    $data['appointment_date'] = NULL;
					$data['appointment_reason'] = NULL;
                } else {
                    $data['appointment_id'] = $result['appointment_id'];
                    $data['start_time'] = $result['start_time'];
                    $data['appointment_date'] = $result['appointment_date'];
					$data['appointment_doctor']= $result['doctor_id'];
					$data['appointment_reason'] = $result['appointment_reason'];
                }
            } else {
                $data['appointment_id'] = $appointment_id;
				$time = $hour . ":" . $min;
                $data['start_time'] = $time;
                $data['appointment_date'] = $app_date;
				$appointment = $this->appointment_model->get_appointments_id($appointment_id);

				$doctor_id = $appointment['doctor_id'];
				$data['appointment_doctor']=$doctor_id;
				$data['appointment_reason']=$appointment['appointment_reason'];
            }

			$data['session_date_id'] = $session_date_id;
			if (in_array("sessions", $active_modules)){
				$this->load->model('sessions/sessions_model');
				if($session_date_id == NULL && $appointment_id != NULL){

					$session_date = $this->sessions_model->get_session_date_id($appointment_id);
					$session_date_id = $session_date['session_date_id'];
				}
				$data['session_date_id'] = $session_date_id;

				if($session_date_id != NULL){
					$data['appointment_doctor']=$this->sessions_model->get_doctor_id($data['session_date_id']);
				}
			}
			if (in_array("treatment", $active_modules)){
				$this->load->model('treatment/treatment_model');
            	$data['treatments'] = $this->treatment_model->get_treatments();
            	$data['treatment_name'] = $this->treatment_model->get_treatment_name();
            }
			if (in_array("lab", $active_modules)) {
				$this->load->model('lab/lab_model');
				$data['visit_lab_tests'] = $this->lab_model->get_all_visit_tests();
				$data['lab_test_name'] = $this->lab_model->get_test_name_array();
			}
			$data['references'] = $this->settings_model->get_reference_by();
			$data['patient'] = $this->patient_model->get_patient_detail($patient_id);
			$data['contact_details'] = $this->contact_model->get_all_contact_details();
			$data['addresses'] = $this->contact_model->get_contacts($data['patient']['contact_id']);
			$data['visit_treatments'] = $this->patient_model->get_visit_treatments();
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();

			$data['user_level'] = $this->session->userdata('category');
			if($data['user_level'] == 'Doctor'){
				$user_id = $this->session->userdata('id');
				$doctor = $this->admin_model->get_doctor_by_user_id($user_id);
				$data['doctor'] = $doctor;
				$doctor_id = $data['doctor']['doctor_id'];
			}else{
				$doctor = $this->doctor_model->get_doctor_doctor_id($doctor_id);
				$data['doctor'] = $doctor;
			}
			$data['visits'] = $this->patient_model->get_previous_visits($patient_id,$doctor_id);
			$data['tax_type'] = $this->settings_model->get_data_value('tax_type');

			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
            $header_data['software_name']= $this->settings_model->get_data_value("software_name");


			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('visit', $data);
			$this->load->view('templates/footer');
        }
    }
	public function calculate_next_followup_date(){
		$clinic_settings = $this->settings_model->get_clinic_settings();
		$next_followup_date = date('Y-m-d',strtotime('+' .$clinic_settings['next_followup_days']. ' days', time()));
		$working_days=$this->settings_model->get_exceptional_days();

		$non_working = true;
		while($non_working)
		{
			$non_working = false;
			foreach($working_days as $work_day){
				if((strtotime($work_day['working_date'])==strtotime($next_followup_date))&&($work_day['working_status']=="Non Working")){
					$non_working = true;
				}
			}
			if($non_working){
				$next_followup_date = date('Y-m-d',strtotime($next_followup_date . '+1 days', time()));
			}else{
				return $next_followup_date;
			}
		}
	}
	/** Edit Visit */
    public function edit_visit($visit_id, $patient_id = NULL,$appointment_id =NULL ) {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$this->form_validation->set_rules('visit_doctor', $this->lang->line('visit_doctor'), 'required');
			$this->form_validation->set_rules('visit_date', $this->lang->line('visit_date'), 'required');
			$this->form_validation->set_rules('visit_time', $this->lang->line('visit_time'), 'required');
            if ($this->form_validation->run() === FALSE) {
				$level = $this->session->userdata('category');
				$data['level'] = $level;
				$data['visit'] = $this->patient_model->get_visit_data($visit_id);

				$data['doctors'] = $this->doctor_model->get_doctors();
				if ($this->session->userdata('category') == 'Doctor'){
					$user_id = $this->session->userdata('id');
					$data['doctor'] =  $this->doctor_model->get_doctor_user_id($user_id);
				}else{
					$data['doctor'] = $this->doctor_model->get_doctor_details($data['visit']['doctor_id']);
				}

				$active_modules = $this->module_model->get_active_modules();
				$data['active_modules'] = $active_modules;
				if (in_array("treatment", $active_modules)) {
					$this->load->model('treatment/treatment_model');
                	$data['treatments'] = $this->treatment_model->get_treatments();
				}
				if (in_array("lab", $active_modules)){
					$this->load->model('lab/lab_model');
					$data['lab_tests'] = $this->lab_model->get_tests();
					$data['visit_lab_tests'] = $this->lab_model->get_visit_tests($visit_id);
				}
				if (in_array("disease", $active_modules)){
					$this->load->model('disease/disease_model');
					$data['diseases'] = $this->disease_model->get_diseases();
					$data['visit_diseases'] = $this->disease_model->get_visit_diseases($visit_id);
					//print_r($data['visit_diseases']);
				}
				if (in_array("history", $active_modules)) {
					$this->load->model('history/history_model');
					$data['section_master'] = $this->history_model->get_section_by_display_in("visits");
					$data['section_fields'] = $this->history_model->get_fields_by_display_in("visits");
					//print_r($data['section_fields']);
					if ( method_exists($this->history_model,'get_conditions_by_display_in')){
						$data['section_conditions'] = $this->history_model->get_conditions_by_display_in("visits");
					}else{
						$data['section_conditions'] = array();
					}
					$data['field_options'] = $this->history_model->get_field_options_by_display_in("visits");
					$data['field_name'] = $this->history_model->get_field_names();
					$data['visit_history_details'] = $this->history_model->get_visit_history_details($visit_id);
				}
				if (in_array("prescription", $active_modules)){
					$this->load->model('prescription/prescription_model');
					$data['medicines'] = $this->prescription_model->get_medicines();
					$data['prescriptions'] = $this->prescription_model->get_all_medicines($visit_id);
					$data['medicine_array'] = $this->prescription_model->get_medicine_array();
				}
				$data['references'] = $this->settings_model->get_reference_by();
                $data['visit_treatments'] = $this->settings_model->get_visit_treatment($visit_id);
				$data['def_dateformate'] = $this->settings_model->get_date_formate();
				$data['def_timeformate'] = $this->settings_model->get_time_formate();
				$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();
				$data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();
				$data['time_interval'] = $this->settings_model->get_time_interval();
				$data['visit_id'] = $visit_id;
				if($patient_id == NULL){
					$patient_id = $this->patient_model->get_patient_id($visit_id);
				}
				$data['patient_id'] = $patient_id;
				$data['appointment_id'] = $appointment_id;
                $clinic_id = $this->session->userdata('clinic_id');
				$user_id = $this->session->userdata('user_id');

				$header_data['clinic_id'] = $clinic_id;
				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
				$header_data['active_modules'] = $this->module_model->get_active_modules();
				$header_data['user_id'] = $user_id;
				$header_data['user'] = $this->admin_model->get_user($user_id);
				$header_data['login_page'] = get_main_page();
                $header_data['software_name']= $this->settings_model->get_data_value("software_name");


				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
                $this->load->view('edit_visit', $data);
                $this->load->view('templates/footer');
            } else {
				$active_modules = $this->module_model->get_active_modules();
                $this->patient_model->edit_visit_data($visit_id);

				if($this->input->post('submit') == "save_complete"){
					$appointment_id = $this->input->post('appointment_id');
					$this->appointment_model->change_status($appointment_id,"Complete");
				}
				if (in_array("history", $active_modules)) {
					$this->load->model('history/history_model');
					$this->history_model->update_visit_history_details($visit_id);
				}
				if (in_array("prescription", $active_modules)){
					$patient_id = $this->patient_model->get_patient_id($visit_id);
					$this->load->model('prescription/prescription_model');
					$this->prescription_model->update_prescription($visit_id,$patient_id);
				}
				if (in_array("lab", $active_modules)) {
					$this->load->model('lab/lab_model');
					$this->lab_model->add_test_visit($visit_id);
					$bill_id = $this->patient_model->get_bill_id($visit_id);
					$lab_tests = $this->input->post('lab_test[]');
					foreach($lab_tests as $test_id){
						if(!$this->lab_model->is_test_added($visit_id, $test_id)){
							$lab_test = $this->lab_model->get_test($test_id);
							$this->bill_model->add_bill_item('lab_test', $bill_id, $lab_test['test_name'], 1, $lab_test['test_charges'], $lab_test['test_charges'], NULL, NULL, NULL);
						}
					}
				}
				redirect('patient/visit/' . $patient_id);
            }
        }
    }
	public function check_available_stock($required_stock, $item_id) {
		if ($this->module_model->is_active('stock')){
			$this->load->model('stock/stock_model');
			$item_detail = $this->stock_model->get_item($item_id);

			$available_quantity = $item_detail['available_quantity'];
			if ($available_quantity < $required_stock) {
				$this->form_validation->set_message('check_available_stock', 'Required Quantity ' . $required_stock . ' exceeds Available Stock (' . $available_quantity . ') for Item ' . $item_detail['item_name']);
				return FALSE;
			} else {
				return TRUE;
			}
		}else{
			$this->form_validation->set_message('check_available_stock', 'Stock Module Missing');
			return FALSE;
		}
    }
	public function edit_bill($bill_id){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$visit_id = $this->patient_model->get_visit_id($bill_id);
			$patient_id = $this->patient_model->get_patient_id_for_bill($bill_id);
			$this->bill($visit_id,$patient_id,$bill_id);
		}
	}
	/* Bill Details */
    public function bill($visit_id = NULL, $patient_id = NULL,$bill_id = NULL) {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$data['called_from'] = "patient_bill_".$visit_id."_".$patient_id."_".$bill_id;
			$data['tax_type']=$this->settings_model->get_data_value('tax_type');


			//echo "Bill Id ".$bill_id."<br/>";
			if ($bill_id == NULL || $bill_id == 0){
				$bill_id = $this->bill_model->get_bill_id($visit_id);
			}
			//echo "Bill Id ".$bill_id."<br/>";
		    if ($bill_id == NULL){
				$bill_id = $this->bill_model->create_bill($visit_id, $patient_id,0,$doctor_id);
			}
			//echo "Bill Id ".$bill_id."<br/>";
			$data['visit_id'] = $visit_id;

			$visit = $this->patient_model->get_visit_data($visit_id);
			$patient_id = $visit['patient_id'];
			$data['patient_id'] = $patient_id;
			$data['visit_date'] = date('d-m-Y',strtotime($visit['visit_date']));

			$doctor_id = $visit['doctor_id'];
			$doctor = $this->admin_model->get_doctor_by_doctor_id($doctor_id);
			$data['doctor_name'] = $doctor['name'];
            $data['edit_bill'] = TRUE;
            $data['patient'] = $this->patient_model->get_patient_detail($patient_id);

			$result = $this->appointment_model->get_appointment_by_visit($visit_id);

			if ($result == FALSE) {
				$data['appointment_id'] = NULL;
			} else {
				$data['appointment_id'] = $result['appointment_id'];
			}

            $data['adv_payment'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);

            $data['currency_postfix'] = $this->settings_model->get_currency_postfix();

            $action = $this->input->post('submit');

			$active_modules = $this->module_model->get_active_modules();
			$data['active_modules'] = $active_modules;

			$data['fees'] = array();
			if (in_array("doctor", $active_modules)) {
				$data['fees'] = $this->doctor_model->get_doctor_fees($doctor_id);
			}

			if (in_array("treatment", $active_modules)) {
				$this->load->model('treatment/treatment_model');
				$data['treatments'] = $this->treatment_model->get_treatments();
			}

			if (in_array("lab", $active_modules)) {
				$this->load->model('lab/lab_model');
				$data['lab_tests'] = $this->lab_model->get_tests();
			}

            if ($action == 'item') {
				$item_id = $this->input->post('item_id');
				$this->form_validation->set_rules('item_name', $this->lang->line('item_name'), 'required');
                $this->form_validation->set_rules('item_amount', $this->lang->line('item_amount'), 'required|numeric');
				$this->form_validation->set_rules('item_quantity', $this->lang->line('item_quantity'), 'required|callback_check_available_stock['.$item_id.']');
				if ($this->form_validation->run() === FALSE) {

                } else {
                    $item = $this->input->post('item_name');

                    $amount = $this->input->post('item_amount');
					$quantity = $this->input->post('item_quantity');
                    $this->patient_model->add_bill_item($action, $bill_id, $item, $quantity, $amount*$quantity, $amount,$item_id);
					$this->bill_model->recalculate_tax($bill_id);
				}

                $data['bill_id'] = $bill_id;

                $data['bill'] = $this->patient_model->get_bill($visit_id);
                $data['bill_details'] = $this->patient_model->get_bill_detail($visit_id);

				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);

			}elseif ($action == 'fees') {
				$this->form_validation->set_rules('fees_detail', $this->lang->line('fees_detail'), 'required');
                $this->form_validation->set_rules('fees_amount', $this->lang->line('fees_amount'), 'required|numeric');
				if ($this->form_validation->run() === FALSE) {

                } else {
                    $fees_detail = $this->input->post('fees_detail');
                    $fees_amount = $this->input->post('fees_amount');
                    $this->patient_model->add_bill_item($action, $bill_id, $fees_detail, 1, $fees_amount,$fees_amount);
					$this->bill_model->recalculate_tax($bill_id);
                }

                $data['bill_id'] = $bill_id;

                $data['bill'] = $this->patient_model->get_bill($visit_id);
                $data['bill_details'] = $this->patient_model->get_bill_detail($visit_id);

				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);
			}elseif ($action == 'treatment') {
				$this->form_validation->set_rules('treatment', $this->lang->line('treatment'), 'required');
                $this->form_validation->set_rules('treatment_price', $this->lang->line('treatment_price'), 'required|numeric');
				if ($this->form_validation->run() === FALSE) {

                } else {
                    $treatment = $this->input->post('treatment');
                    $treatment_price = $this->input->post('treatment_price');
					$tax_amount = $this->input->post('treatment_rate');

                    $this->bill_model->add_bill_item($action, $bill_id, $treatment, 1, $treatment_price,$treatment_price,NULL,$tax_amount);
					$this->bill_model->recalculate_tax($bill_id);
                }

                $data['bill_id'] = $bill_id;

                $data['bill'] = $this->bill_model->get_bill($bill_id);
                $data['bill_details'] = $this->bill_model->get_bill_detail($bill_id);

				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);
			}elseif ($action == 'lab_test') {
				$this->form_validation->set_rules('lab_test', $this->lang->line('lab_test'), 'required');
                $this->form_validation->set_rules('test_price', $this->lang->line('amount'), 'required|numeric');
				if ($this->form_validation->run() === FALSE) {

                } else {
                    $test_id = $this->input->post('test_id');
                    $lab_test = $this->input->post('lab_test');
                    $test_price = $this->input->post('test_price');
					$this->lab_model->add_single_test_visit($visit_id,$test_id);
                    $this->bill_model->add_bill_item($action, $bill_id, $lab_test, 1, $test_price,$test_price,NULL,NULL);
					$this->bill_model->recalculate_tax($bill_id);
                }

                $data['bill_id'] = $bill_id;

                $data['bill'] = $this->bill_model->get_bill($bill_id);
                $data['bill_details'] = $this->bill_model->get_bill_detail($bill_id);

				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);
			}elseif ($action == 'session') {
				$this->form_validation->set_rules('session_charges', $this->lang->line('charges'), 'required');
				if ($this->form_validation->run() === FALSE) {

                } else {
                    $session_charges = $this->input->post('session_charges');

                    $this->patient_model->add_bill_item($action, $bill_id, 'Session', 1, $session_charges,$session_charges,NULL,0);
					$this->bill_model->recalculate_tax($bill_id);
				}

                $data['bill_id'] = $bill_id;

                $data['bill'] = $this->patient_model->get_bill($visit_id);
                $data['bill_details'] = $this->patient_model->get_bill_detail($visit_id);

				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);
			}elseif ($action == 'particular') {

				$this->form_validation->set_rules('particular', $this->lang->line('particular'), 'required');
                $this->form_validation->set_rules('particular_amount', $this->lang->line('particular_amount'), 'required|numeric');
				if ($this->form_validation->run() === FALSE) {

                } else {
                    $particular = $this->input->post('particular');
                    $particular_amount = $this->input->post('particular_amount');
                    $tax_amount = $this->input->post('tax_amount');

					$this->bill_model->add_bill_item($action, $bill_id, $particular, 1, $particular_amount,$particular_amount,NULL,$tax_amount);
					$this->bill_model->recalculate_tax($bill_id);
				}
                $data['bill_id'] = $bill_id;
                $data['bill'] = $this->bill_model->get_bill_by_visit($visit_id);
                $data['bill_details'] = $this->bill_model->get_bill_detail_by_visit($visit_id);

				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);

			}elseif ($action == 'discount') {
				$bill_amount = $this->bill_model->get_bill_amount($bill_id);
				$discount = $this->bill_model->get_discount_amount($bill_id);
				$bill_amount = $bill_amount + 1;
                $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'required|less_than['.$bill_amount.']|numeric');
				if ($this->form_validation->run() === FALSE) {

                } else {
                    $discount_amount = $this->input->post('discount');
                    $this->bill_model->update_discount($bill_id,$discount_amount);
                }
                $data['bill_id'] = $bill_id;
                $data['bill'] = $this->bill_model->get_bill_by_visit($visit_id);
                $data['bill_details'] = $this->bill_model->get_bill_detail($bill_id);
				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);
			}elseif ($action == 'tax') {
				$taxable_amount = $this->bill_model->get_taxable_amount($bill_id);
				$discount = $this->bill_model->get_discount_amount($bill_id);
                $this->form_validation->set_rules('bill_tax_rate', $this->lang->line("tax"), 'required');
				if ($this->form_validation->run() === FALSE) {

                } else {
					$tax_id = $this->input->post('bill_tax_rate');
					$tax_rate = $this->settings_model->get_tax_rate($tax_id);
					$tax_rate_name = $tax_rate['tax_rate_name'];
					$tax_rate_percent = $tax_rate['tax_rate'];
					$tax_rate_name = $tax_rate['tax_rate_name']." ( ".$tax_rate_percent."% )";
					$tax_amount = $taxable_amount * $tax_rate_percent /100;

					//$discount_amount = $this->input->post('discount');
                    $this->bill_model->add_bill_item($action, $bill_id, $tax_rate_name, 1, $tax_amount,$tax_amount,NULL,NULL,$tax_id);
                }
                $data['bill_id'] = $bill_id;
                $data['bill'] = $this->bill_model->get_bill($visit_id);
                $data['bill_details'] = $this->bill_model->get_bill_detail($bill_id);
				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);
			}else{
				$data['bill_id'] = $bill_id;
				$data['bill'] = $this->bill_model->get_bill($bill_id);
				$data['bill_details'] = $this->bill_model->get_bill_detail($bill_id);
				$data['balance'] = $this->patient_model->get_balance_amount($bill_id,$patient_id);
			}
			if (in_array("stock", $active_modules)) {
				$this->load->model('stock/stock_model');
				$data['items'] = $this->stock_model->get_items();
				$data['item_total'] = $this->patient_model->get_item_total($visit_id);
			}else{
				$data['item_total'] = 0;
			}
			$data['particular_total'] = $this->patient_model->get_total("particular",$visit_id);
			if($data['tax_type'] == "item"){
				$data['particular_tax_total'] = $this->patient_model->get_tax_total("particular",$visit_id);
				$data['treatment_tax_total'] = $this->patient_model->get_tax_total("treatment",$visit_id);
				$data['session_tax_total'] = $this->bill_model->get_tax_total("session",$bill_id);
			}else{
				$data['particular_tax_total'] = $this->patient_model->get_total("tax",$visit_id);
				$data['treatment_tax_total'] = $this->patient_model->get_tax_total("treatment",$visit_id);
				$data['session_tax_total'] = $this->bill_model->get_tax_total("session",$bill_id);
			}

			if (in_array("doctor", $active_modules)) {
				$data['fees_total'] = $this->patient_model->get_fee_total($visit_id);
			}else{
				$data['fees_total'] = 0;
			}
			if (in_array("treatment", $active_modules)) {
				$data['treatment_total'] = $this->patient_model->get_treatment_total($visit_id);
			}else{
				$data['treatment_total'] = 0;
			}
			if (in_array("lab", $active_modules)) {
				$data['lab_test_total'] = $this->bill_model->get_total("lab_test",$bill_id);
			}else{
				$data['lab_test_total'] = 0;
			}
			$data['tax_rates'] = $this->settings_model->get_tax_rates();
			$data['tax_rate_name'] = $this->settings_model->get_tax_rate_name();
			$data['tax_rate_array'] = $this->settings_model->get_tax_rate_array();
			$data['session_total'] = $this->patient_model->get_total("session",$visit_id);
			$data['paid_amount'] = $this->payment_model->get_paid_amount($bill_id);
			$data['discount'] = $this->bill_model->get_discount_amount($bill_id);
			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
            $header_data['software_name']= $this->settings_model->get_data_value("software_name");

			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('bill', $data);
			$this->load->view('templates/footer');
        }
    }
	/* Print Receipt */
	public function print_receipt($visit_id) {
        //session_start();
		//Check if user has logged in
		//if (!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == '') {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$active_modules = $this->module_model->get_active_modules();
			$data['active_modules'] = $active_modules;

            //$data['medicine'] = $this->patient_model->get_medicine_total($visit_id);
            if (in_array("treatment", $active_modules)) {
				$data['treatment_total'] = $this->patient_model->get_treatment_total($visit_id);
			}
			$data['item_total'] = $this->patient_model->get_item_total($visit_id);
            $bill_id = $this->bill_model->get_bill_id($visit_id);

            $data['paid_amount'] = $this->payment_model->get_paid_amount($bill_id);
			$data['particular_total'] = $this->patient_model->get_particular_total($visit_id);
			if (in_array("doctor", $active_modules)) {
				$data['fees_total'] = $this->patient_model->get_fee_total($visit_id);
			}
            $data['currency_postfix'] = $this->settings_model->get_currency_postfix();

			$def_dateformate = $this->settings_model->get_date_formate();
			$def_timeformate = $this->settings_model->get_time_formate();
			$invoice = $this->settings_model->get_invoice_settings();
			$receipt_template = $this->patient_model->get_template();
			$template = $receipt_template['template'];

			$clinic = $this->settings_model->get_clinic_settings();

			//Clinic Details
			$clinic_array = array('clinic_name','tag_line','clinic_address','landline','mobile','email');
			foreach($clinic_array as $clinic_detail){
				$template = str_replace("[$clinic_detail]", $clinic[$clinic_detail], $template);
			}
			$clinic_logo = "<img src='".base_url()."/".$clinic['clinic_logo']."'/>";
			$template = str_replace("[clinic_logo]", $clinic_logo, $template);

			//Bill Details
			$bill_array = array('bill_date','bill_id','bill_time');
			$bill = $this->bill_model->get_bill_by_visit($visit_id);
			$patient_id = $bill['patient_id'];
			$bill_details = $this->bill_model->get_bill_detail_by_visit($visit_id);
			foreach($bill_array as $bill_detail){
				if($bill_detail == 'bill_date'){
					$bill_date = date($def_dateformate, strtotime($bill['bill_date']));
					$template = str_replace("[bill_date]", $bill_date, $template);
				}elseif($bill_detail == 'bill_time'){
					$bill_time = date($def_timeformate, strtotime($bill['bill_time']));
					$template = str_replace("[bill_time]", $bill_time, $template);
				}elseif($bill_detail == 'bill_id'){
					$bill_id = $invoice['static_prefix'] . sprintf("%0" . $invoice['left_pad'] . "d", $bill['bill_id']);
					$template = str_replace("[bill_id]", $bill_id, $template);
				}else{
					$template = str_replace("[$bill_detail]", $bill[$bill_detail], $template);
				}
			}
			//Tax Details for Bill type
			$tax_amount = 0;
			$bill_tax_amount = 0;
			$data['tax_type']=$this->settings_model->get_data_value('tax_type');
			if($data['tax_type'] == "bill"){
				$tax_details = "</td>";
				foreach($bill_details as $bill_detail){

					if($bill_detail['type']=='tax'){
						$tax_details .= "<td colspan='2' style='padding:5px;border:1px solid black;'>".$bill_detail['particular']."</td>";
						$tax_details .= "<td style='padding:5px;border:1px solid black;text-align:right;'><strong>".currency_format($bill_detail['amount'])."</strong></td>";
						$bill_tax_amount = $bill_tax_amount + $bill_detail['amount'];
						$tax_details .= "</tr><tr><td>";
					}
				}

			}else{
				$tax_details = "</td><td></td><td></td><td>";
			}
			$template = str_replace("[tax_details]", $tax_details, $template);
			if($data['tax_type'] == "item"){
				$tax_column_header = "<td style='width: 100px; text-align: right; padding: 5px; border: 1px solid black;'><strong>Tax</strong></td>";
			}else{
				$tax_column_header = "";
			}
			$template = str_replace("[tax_column_header]", $tax_column_header, $template);
			//Patient Details
			$patient = $this->patient_model->get_patient_detail($patient_id);
			$patient_array = array('patient_name');
			foreach($patient_array as $patient_detail){
				if($patient_detail == 'patient_name'){
					$patient_name = $patient['first_name']." ".$patient['middle_name']." ".$patient['last_name'];
					$template = str_replace("[patient_name]",$patient_name, $template);
				}else{
					$template = str_replace("[$patient_detail]", $patient[$patient_detail], $template);
				}
			}


			$visit = $this->patient_model->get_visit_data($visit_id);
			$doctor_id = $visit['doctor_id'];
			$doctor = $this->doctor_model->get_doctor_doctor_id($doctor_id);
			$doctor_name = $doctor['title'].' '.$doctor['first_name'].' '.$doctor['middle_name'].' '.$doctor['last_name'];
			$template = str_replace("[doctor_name]",$doctor_name, $template);

			$particular_table = "";
			$item_table = "";
			$treatment_table = "";
			$fees_table = "";
			$col_string = "";
			$particular_amount = 0;
			$particular_tax_amount = 0;
			$treatment_tax_amount = 0;
			$item_amount = 0;
			$treatment_amount = 0;
			$fees_amount = 0;
			//Bill Columns
			$start_pos = strpos($template, '[col:');
			if ($start_pos !== false) {
				$end_pos= strpos($template, ']',$start_pos);
				$length = abs($end_pos - $start_pos);
				$col_string = substr($template, $start_pos, $length+1);
				$columns = str_replace("[col:", "", $col_string);
				$columns = str_replace("]", "", $columns);
				$cols = explode("|",$columns);

				foreach($bill_details as $bill_detail){

					if($bill_detail['type']=='particular'){
						$particular_table .= "<tr>";
						foreach($cols as $col){
							if($col =='mrp' || $col =='amount' ){
								$particular_table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
								$particular_table .= currency_format($bill_detail[$col])."</td>";
							}elseif($col=='tax_amount'){
								if($data['tax_type'] == "item"){
									$particular_table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
									$particular_table .= currency_format($bill_detail[$col])."</td>";
								}
							}else{
								$particular_table .= "<td style='padding:5px;border:1px solid black;'>";
								$particular_table .= $bill_detail[$col]."</td>";
							}
						}
						$particular_table .= "</tr>";
						$particular_amount = $particular_amount + $bill_detail['amount'];
						$particular_tax_amount= $particular_tax_amount + $bill_detail['tax_amount'];
						$particular_total_amount = $particular_amount + $bill_detail['amount']+$bill_detail['tax_amount'];
					}elseif($bill_detail['type']=='item'){
						$item_table .= "<tr>";
						foreach($cols as $col){
							if($col =='mrp' || $col =='amount'){
								$item_table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
								$item_table .= currency_format($bill_detail[$col])."</td>";
							}else{
								$item_table .= "<td style='padding:5px;border:1px solid black;'>";
								$item_table .= $bill_detail[$col]."</td>";
							}

						}
						$item_table .= "</tr>";
						$item_amount = $item_amount + $bill_detail['amount'];
					}elseif($bill_detail['type']=='treatment'){
						$treatment_table .= "<tr>";
						foreach($cols as $col){
							if($col =='mrp' || $col =='amount'){
								$treatment_table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
								$treatment_table .= currency_format($bill_detail[$col])."</td>";
							}elseif($col=='tax_amount'){
								if($data['tax_type'] == "item"){
									$treatment_table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
									$treatment_table .= currency_format($bill_detail[$col])."</td>";
								}
							}else{
								$treatment_table .= "<td style='padding:5px;border:1px solid black;'>";
								$treatment_table .= $bill_detail[$col]."</td>";
							}

						}
						$treatment_table .= "</tr>";
						$tax_rate=$bill_detail['tax_amount'];
						$treatment_amount = $treatment_amount + $bill_detail['amount'];
						$treatment_tax_amount= $treatment_tax_amount + $bill_detail['tax_amount'];
						$treatment_total_amount = $particular_amount + $bill_detail['amount'];
					}elseif($bill_detail['type']=='tax'){
						$tax_amount=$bill_detail['tax_amount'];
						//$tax_amount = $tax_amount + $bill_detail['amount'];
					}elseif($bill_detail['type']=='fees'){
						$fees_table .= "<tr>";
						foreach($cols as $col){
							if($col =='mrp' || $col =='amount'){
								$fees_table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
								$fees_table .= currency_format($bill_detail[$col])."</td>";
							}else{
								$fees_table .= "<td style='padding:5px;border:1px solid black;'>";
								$fees_table .= $bill_detail[$col]."</td>";
							}

						}
						$fees_table .= "</tr>";
						$fees_amount = $fees_amount + $bill_detail['amount'];
					}
				}
				if($particular_table != ""){
					if($data['tax_type'] == "bill"){
						$particular_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Particular</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($particular_amount)."</strong></td></tr>";
					}else{
						$particular_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Particular</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($particular_amount)."</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($particular_tax_amount)."</strong></td></tr>";
					}
				}
				if($item_table != ""){
					if($data['tax_type'] == "bill"){
						$item_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Items</strong></td></tr>";
					}else{
						$item_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Items</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($item_amount)."</strong></td></tr>";
					}
				}
				if($treatment_table != ""){
					if($data['tax_type'] == "bill"){
						$treatment_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Treatment</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($treatment_amount)."</strong></td></tr>";
					}else{
						$treatment_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Treatment</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($treatment_amount)."</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($treatment_tax_amount)."</strong></td></tr>";
					}
				}
				if($fees_table != ""){
					if($data['tax_type'] == "bill"){
						$fees_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Fees</strong></td></tr>";
					}else{
						$fees_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Fees</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($fees_amount)."</strong></td></tr>";
					}
				}
			}
			$table = $particular_table . $item_table . $treatment_table.$fees_table;
			$template = str_replace("$col_string",$table, $template);

			$balance = $this->patient_model->get_balance_amount($bill['bill_id']);
			$balance = currency_format($balance);
			$template = str_replace("[previous_due]",$balance, $template);

			$paid_amount = $this->payment_model->get_paid_amount($bill['bill_id']);
			$paid_amount = currency_format($paid_amount);
			if($data['tax_type'] == "item"){
				$paid_amount = "</td><td style='text-align: right; padding: 5px; border: 1px solid black;'>".$paid_amount;
			}
			$template = str_replace("[paid_amount]",$paid_amount, $template);

			$discount_amount = $this->bill_model->get_discount_amount($bill['bill_id']);
			$discount = currency_format($discount_amount);
			if($data['tax_type'] == "item"){
				$discount = "(".$discount.")"."<td style='text-align: right; padding: 5px; border: 1px solid black;'></td>";
			}
			$template = str_replace("[discount]",$discount, $template);

			$total_amount = $particular_amount + $particular_tax_amount + $item_amount + $treatment_amount + $treatment_tax_amount + $fees_amount - $discount_amount +  $bill_tax_amount;
			$total_amount = currency_format($total_amount);
			if($data['tax_type'] == "item"){
				$total_amount = "</td><td style='text-align: right; padding: 5px; border: 1px solid black;'>".$total_amount;
			}
			$template = str_replace("[total]",$total_amount, $template);

			$template .="<input type='button' value='Print' id='print_button' onclick='window.print()'>
			<style>
				@media print{
					#print_button{
						display:none;
					}

				}
			</style>";
			$data['receipt_template'] = $template;
            $this->load->view('receipt_template/receipt', $data);
        }
    }
    public function bill_detail_report_export($from_date,$to_date,$doctor){
		if($doctor == "0"){
			$selected_doctors = array();
		}else{
			$selected_doctors = explode("__",$doctor);
		}
		$result = $this->patient_model->get_bill_detail_export_query($from_date,$to_date,$selected_doctors);
		$tax_type = $this->settings_model->get_data_value('tax_type');
		$total_bill_amount = 0;
		$total_payment_amount = 0;
		$total_due_amount = 0;
		foreach($result as $row){
			$total_bill_amount = $total_bill_amount + $row['bill_amount'];
			$total_payment_amount = $total_payment_amount + $row['payment_amount'];
			$total_due_amount = $total_due_amount + $row['due_amount'];
		}

		$total_array['clinic_name'] = 'Total';
		$total_array['bill_id'] = '';
		$total_array['bill_date'] = '';
		$total_array['doctor_name'] = '';
		$total_array['patient_id'] = '';
		$total_array['patient_name'] = '';
		$total_array['bill_amount'] = $total_bill_amount;
		$total_array['payment_amount'] = $total_payment_amount;
		$total_array['due_amount'] = $total_due_amount;

		$result[] = $total_array;
		$this->export->to_excel($result, 'bill_detail_report');
	}
	public function bill_detail_report(){
        //Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$data['tax_type']=$this->settings_model->get_data_value('tax_type');
            $level = $this->session->userdata('category');
            $data['doctors'] = $this->doctor_model->get_doctors();
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['def_timeformate'] = $this->settings_model->get_time_formate();
			$data['active_modules'] = $this->module_model->get_active_modules();
			$data['clinics']=$this->settings_model->get_all_clinics();
			$data['clinic_id']=$this->session->userdata('clinic_id');
            $data['patients'] = $this->patient_model->get_patient();

            $this->form_validation->set_rules('bill_from_date', $this->lang->line('bill_from_date'), 'required');
            $this->form_validation->set_rules('bill_to_date',$this->lang->line('bill_to_date'), 'required');
            if ($this->form_validation->run() === FALSE) {
				if ($level == 'Doctor') {
					$user_id = $this->session->userdata('id');
					$data['doctor'] = $this->admin_model->get_doctor($user_id);
					$data['selected_doctor'] = array($data['doctor']['doctor_id']);
				}else{
					$data['selected_doctor'] =  array();
				}

				$data['reports'] = array();
				$data['bill_from_date'] = date('Y-m-d');
				$data['bill_to_date'] = date('Y-m-d');
				$data['reports'] = $this->bill_model->get_bill_report($data['bill_from_date'],$data['bill_to_date'],$data['selected_doctor'],$data['clinic_id']);
				$clinic_id = $this->session->userdata('clinic_id');
				$user_id = $this->session->userdata('user_id');

				$header_data['clinic_id'] = $clinic_id;
				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
				$header_data['active_modules'] = $this->module_model->get_active_modules();
				$header_data['user_id'] = $user_id;
				$header_data['user'] = $this->admin_model->get_user($user_id);
				$header_data['login_page'] = get_main_page();
                $header_data['software_name']= $this->settings_model->get_data_value("software_name");


				$this->load->view('templates/header_chikitsa',$header_data);
				$this->load->view('templates/menu');
                $this->load->view('patient/bill_detail_report', $data);
                $this->load->view('templates/footer');
            } else {
				$data['selected_doctor'] = $this->input->post('doctor');
				$data['patient_id'] = $this->input->post('patient_id');
				$data['bill_from_date'] = date('Y-m-d', strtotime($this->input->post('bill_from_date')));
				$data['bill_to_date'] = date('Y-m-d', strtotime($this->input->post('bill_to_date')));
				$data['selected_doctor'] = $this->input->post('doctor');
				$data['reports'] = $this->bill_model->get_bill_report($data['bill_from_date'],$data['bill_to_date'],$data['selected_doctor'],$data['clinic_id'],$data['patient_id']);

				if($this->input->post('print_report') !== NULL){
					$this->load->view('patient/print_bill_detail_report', $data);
				}elseif($this->input->post('excel_report') !== NULL){

					$result = $this->patient_model->get_bill_detail_export_query($data['bill_from_date'] ,$data['bill_to_date'],$data['selected_doctor']);
					$tax_type = $this->settings_model->get_data_value('tax_type');
					$total_bill_amount = 0;
					$total_payment_amount = 0;
					$total_due_amount = 0;
					foreach($result as $row){
						$total_bill_amount = $total_bill_amount + $row['bill_amount'];
						$total_payment_amount = $total_payment_amount + $row['payment_amount'];
						$total_due_amount = $total_due_amount + $row['due_amount'];
					}

					$total_array['clinic_name'] = 'Total';
					$total_array['bill_id'] = '';
					$total_array['bill_date'] = '';
					$total_array['doctor_name'] = '';
					$total_array['patient_id'] = '';
					$total_array['patient_name'] = '';
					$total_array['bill_amount'] = $total_bill_amount;
					$total_array['payment_amount'] = $total_payment_amount;
					$total_array['due_amount'] = $total_due_amount;

					$result[] = $total_array;
					$this->export->to_excel($result, 'bill_detail_report');
				}else{
					$data['clinic_id'] = $this->input->post('clinic_id');

					if ($level == 'Doctor') {
						$user_id = $this->session->userdata('id');
						$data['doctor'] = $this->admin_model->get_doctor($user_id);
						$data['selected_doctor'] = array($data['doctor']['doctor_id']);
					}elseif($this->input->post('doctor')){
						$data['selected_doctor'] = $this->input->post('doctor');
					}else{
						$data['selected_doctor'] = array();
					}

					$clinic_id = $this->session->userdata('clinic_id');
					$user_id = $this->session->userdata('user_id');
					$header_data['clinic_id'] = $clinic_id;
					$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
					$header_data['active_modules'] = $this->module_model->get_active_modules();
					$header_data['user_id'] = $user_id;
					$header_data['user'] = $this->admin_model->get_user($user_id);
					$header_data['login_page'] = get_main_page();
			        $header_data['software_name']= $this->settings_model->get_data_value("software_name");

					$this->load->view('templates/header_chikitsa',$header_data);
					$this->load->view('templates/menu');
					$this->load->view('patient/bill_detail_report', $data);
					$this->load->view('templates/footer');
				}

            }
        }
    }
    public function print_bill_detail_report($bill_from_date,$bill_to_date,$selected_doctor){
		if($selected_doctor == "0"){
			$selected_doctors = array();
		}else{
			$selected_doctors = explode("__",$selected_doctor);
		}
		$data['tax_type']=$this->settings_model->get_data_value('tax_type');

		$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
		$data['reports'] = $this->patient_model->get_bill_report($bill_from_date,$bill_to_date,$selected_doctors);

	}
	public function delete_bill_detail($bill_detail_id, $bill_id, $visit_id, $patient_id,$called_from) {
        //Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
            $this->patient_model->delete_bill_detail($bill_detail_id, $bill_id);
			$called_from = str_replace("_","/",$called_from);
			echo $called_from;
            //redirect($called_from);
        }
    }
	public function delete_bill_detail_table($called_from,$bill_detail_id, $bill_id, $visit_id, $patient_id) {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {

			$bill_detail = $this->bill_model->get_bill_detail_by_id($bill_detail_id);
			//print_r($bill_detail);
			$this->bill_model->delete_bill_detail($bill_detail_id, $bill_id);
			if($bill_detail['type'] != "tax"){
				$this->bill_model->recalculate_tax($bill_id);
			}
			$called_from = str_replace("_","/",$called_from);
            redirect($called_from);
        }
	}
	public function delete_bill_discount($bill_id, $visit_id, $patient_id,$called_from = NULL) {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$this->patient_model->delete_bill_discount($bill_id);
			if($called_from == "visit"){
				$this->visit($patient_id, $visit_id);
			}else{
				$this->bill($visit_id, $patient_id);
			}
        }
	}
    public function followup($patient_id) {

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
            $data['patient_id'] = $patient_id;
			$data['followups'] = $this->patient_model->get_followups_patient($patient_id);
			$data['patient'] = $this->patient_model->get_patient_detail($patient_id);
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['def_timeformate'] = $this->settings_model->get_time_formate();
			$data['morris_date_format'] = $this->settings_model->get_morris_date_format();


			if($this->session->userdata('category') == 'Doctor'){
				$id = $this->session->userdata('id');
				$data['doctor']=$this->admin_model->get_doctor($id);
			}else{
				$data['doctors'] = $this->admin_model->get_doctor();
			}
			$data['working_days']=$this->settings_model->get_exceptional_days();
            $clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
            $header_data['software_name']= $this->settings_model->get_data_value("software_name");

			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
            $this->load->view('followup', $data);
            $this->load->view('templates/footer');
        }
    }
	public function dismiss_followup($followup_id) {
        //Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$followup = $this->patient_model->get_patient_from_followup($followup_id);
			$patient_id = $followup['patient_id'];
			//echo $patient_id."<br/>";
            $this->patient_model->remove_followup($followup_id);
            $this->followup($patient_id);
        }
    }
	public function change_followup_date() {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$this->form_validation->set_rules('doctor_id', $this->lang->line('doctor_id'), 'required');
			$this->form_validation->set_rules('followup_date', $this->lang->line('followup_date'), 'required');
			if ($this->form_validation->run() === FALSE) {
				$patient_id = $this->input->post('patient_id');
				$this->followup($patient_id);
			}else{
				$patient_id = $this->input->post('patient_id');
				$doctor_id = $this->input->post('doctor_id');
				$this->patient_model->change_followup_detail($patient_id,$doctor_id);
				redirect('patient/index');
			}
        }
    }
    public function edit_followup($followup_id){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index/');
        } else {
			$patient = $this->patient_model->get_patient_from_followup($followup_id);
            $patient_id = $patient['patient_id'];
			$data['patient_id'] = $patient_id;
			$data['followups'] = $this->patient_model->get_followups_patient($patient_id);
			$data['patient'] = $this->patient_model->get_patient_detail($patient_id);
			$data['followup'] = $this->patient_model->get_followup($followup_id);
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['def_timeformate'] = $this->settings_model->get_time_formate();
			$data['morris_date_format'] = $this->settings_model->get_morris_date_format();
			$data['working_days']=$this->settings_model->get_exceptional_days();
            if($this->session->userdata('category') == 'Doctor'){
				$id = $this->session->userdata('id');
				$data['doctor']=$this->admin_model->get_doctor($id);
			}else{
				$data['doctors'] = $this->admin_model->get_doctor();
			}
            $clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
            $header_data['software_name']= $this->settings_model->get_data_value("software_name");


			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
            $this->load->view('followup', $data);
            $this->load->view('templates/footer');
        }
	}
	public function new_inquiry_report() {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
			redirect('login/index/');
		} else {
			$data['patients_detail'] = $this->patient_model->new_inquiries();
			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');
			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
            $header_data['software_name']= $this->settings_model->get_data_value("software_name");

			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('new_inquiries', $data);
			$this->load->view('templates/footer');
		}
    }
	function email_bill($visit_id,$patient_id = NULL){
		$active_modules = $this->module_model->get_active_modules();
		if (in_array("alert", $active_modules)) {
			//Send Alert : bill
			redirect('alert/send/new_bill/'.$patient_id.'/0/0/'.$visit_id.'/0/0/patient/bill/'.$visit_id.'/'.$patient_id.'/0');
		}else{
			$this->bill($visit_id,$patient_id);
		}
	}
	function patient_report() {
		//Check if user has logged in
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
			redirect('login/index/');
		} else {
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['reference_by']= $this->settings_model->get_reference_by();
			$data['patient_report']= $this->patient_model->get_patient_report();
			$data['selected_reference'] = $this->input->post('reference');
			if($this->input->post('export_to_excel')!== NULL){
				$this->patient_report_excel_export($data['patient_report']);
			}elseif($this->input->post('print_report')!== NULL){
				$this->print_patient_report($data['patient_report']);
			}else{
				$clinic_id = $this->session->userdata('clinic_id');
				$user_id = $this->session->userdata('user_id');
				$header_data['clinic_id'] = $clinic_id;
				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
				$header_data['active_modules'] = $this->module_model->get_active_modules();
				$header_data['user_id'] = $user_id;
				$header_data['user'] = $this->admin_model->get_user($user_id);
				$header_data['login_page'] = get_main_page();
                $header_data['software_name']= $this->settings_model->get_data_value("software_name");

				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('patient/patient_report',$data);
				$this->load->view('templates/footer');
			}
		}
    }
	function patient_report_excel_export($result){
		$def_dateformate = $this->settings_model->get_date_formate();
		$patient_report = array();
		$i = 0;
		foreach($result as $patient){
			$followup_date = "";
			if($patient['followup_date'] != '0000-00-00' && $patient['followup_date'] != NULL){
				$followup_date = date($def_dateformate,strtotime($patient['followup_date']));
			}
			$patient_report[$i]['sr_no'] = $i+1;
			$patient_report[$i]['display_id'] = $patient['display_id'];
			$patient_report[$i]['name'] = $patient['first_name'] . " " .$patient['middle_name']. "  ".$patient['last_name'];;
			$patient_report[$i]['phone_number'] = $patient['phone_number'];
			$patient_report[$i]['email'] = $patient['email'];
			$patient_report[$i]['reference_by'] = $patient['reference_by'];
			$patient_report[$i]['followup_date'] = $followup_date;
			$i++;
		}
		$this->export->to_excel($patient_report, 'patient_report');
	}
	function print_patient_report($result){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['def_dateformate'] = $this->settings_model->get_date_formate();

			$data['patient_report']=  $result;
			$this->load->view('patient/print_report', $data);
		}
	}
}
?>