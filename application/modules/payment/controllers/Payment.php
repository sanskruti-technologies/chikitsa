<?php
class Payment extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model('payment_model');
		$this->load->model('patient/patient_model');
		$this->load->model('bill/bill_model');
		$this->load->model('settings/settings_model');
		
		$this->load->model('module/module_model');
		$this->load->model('admin/admin_model');
		$this->load->model('menu_model');
		
		$this->load->helper('form');
		$this->load->helper('currency');
		$this->load->helper('url');
		$this->load->helper('mainpage');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		
		$this->lang->load('main');
    }
    public function index() {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
			redirect('login/index');
        } else {
			$data['payments'] = $this->payment_model->list_payments();
			
			$active_modules = $this->module_model->get_active_modules();
			$data['active_modules'] = $active_modules;
			if (in_array("snaap", $active_modules)) {	
				$this->load->model('snaap/snaap_model');
				$data['payment_cases'] = $this->snaap_model->get_payment_case_number();
			}
			
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
			
			$clinic_id = $this->session->userdata('clinic_id'); 
			$user_id = $this->session->userdata('user_id'); 	
			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
				
			$this->load->view('templates/header',$header_data);
		    $this->load->view('templates/menu');
			$this->load->view('browse',$data);
			$this->load->view('templates/footer');
        }
    }
	public function insert($patient_id,$called_from = 'bill') {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$active_modules = $this->module_model->get_active_modules();
			if((int)$this->input->post('adjust_from_account') == 1){
				$patient_id = $this->input->post('patient_id');
				$this->payment_model->adjust_from_account($patient_id);
				$data['called_from'] = $called_from;
				if($called_from == 'bill'){
					redirect('patient/visit/'.$patient_id.'/0/0');	
				}else{
					redirect('payment/index/0/0/0');
				}
			}else{
				$total_due_amount = $this->input->post('total_due_amount')+1;
				$this->form_validation->set_rules('patient_id', $this->lang->line('patient_id'), 'required');
				$this->form_validation->set_rules('payment_amount', $this->lang->line('payment_amount'), "required|greater_than[0]");
				
				if ($this->form_validation->run() === FALSE) {
					$data['patients'] = $this->patient_model->get_patient();
					$data['bills'] = $this->bill_model->get_pending_bills();
					$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
					$data['currency_symbol'] = $this->settings_model->get_currency_symbol();
					$data['patient_id'] =$patient_id;
					$data['patient'] = $this->patient_model->get_patient_detail($patient_id); 
					$data['called_from'] = $called_from;
					$data['def_dateformate'] = $this->settings_model->get_date_formate();
					$data['payment_methods'] = $this->settings_model->get_payment_methods();

					if (in_array("sessions", $active_modules)) {
						$this->load->model('sessions/sessions_model');
						$data['sessions'] = $this->sessions_model->get_sessions();
					}
					$clinic_id = $this->session->userdata('clinic_id'); 
					$user_id = $this->session->userdata('user_id'); 
					$header_data['clinic_id'] = $clinic_id;
					$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
					$header_data['active_modules'] = $active_modules;
					$header_data['user_id'] = $user_id;
					$header_data['user'] = $this->admin_model->get_user($user_id);
					$header_data['login_page'] = get_main_page();
						
					$this->load->view('templates/header',$header_data);
					$this->load->view('templates/menu');
					$this->load->view('form',$data);
					$this->load->view('templates/footer');
				}else{
					$payment_id = $this->payment_model->insert_payment();
					$patient_id = $this->input->post('patient_id');
					if($this->input->post('in_account_amount') > 0){
						$in_account_amount = $this->input->post('in_account_amount');
						$this->payment_model->add_payment_in_account($patient_id ,$payment_id,$in_account_amount);
					}
					
					
					if($called_from == 'bill'){
						//redirect('patient/visit/'.$patient_id);
						$active_modules = $this->module_model->get_active_modules();
						if (in_array("alert", $active_modules)) {
							redirect("alert/send/payment_received/$patient_id/0/0/0/$payment_id/0/patient/visit/$patient_id/0/0");
						}else{
							redirect('patient/visit/'.$patient_id.'/0/0');	
						}
					}else{
						
						if (in_array("alert", $active_modules)) {
							redirect("alert/send/payment_received/$patient_id/0/0/0/$payment_id/0/payment/index/0/0/0");
						}else{
							redirect('payment/index/0/0/0');
						}
					}
				}
			}
        }
    }
	public function edit($payment_id,$called_from='payment'){
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$total_due_amount = $this->input->post('total_due_amount')+1;
			$this->form_validation->set_rules('patient_id', $this->lang->line('patient_id'), 'required');
				$this->form_validation->set_rules('payment_amount', $this->lang->line('payment_amount'), "required");
			
			if ($this->form_validation->run() === FALSE) {
				$data = array();
				$payment = $this->payment_model->get_payment($payment_id);
				$data['payment'] = $payment;
				$patient_id = $payment['patient_id'];
				$data['payment_id'] = $payment['payment_id'];
				$data['patient_id'] = $patient_id;
				$data['patient'] = $this->patient_model->get_patient_detail($patient_id); 
				$data['called_from'] = $called_from;
				$data['def_dateformate'] = $this->settings_model->get_date_formate();
				$data['adjusted_bills'] = $this->payment_model->get_bills_for_payment($payment_id);
				$data['bills'] = $this->patient_model->get_patient_bills($patient_id);
				$data['currency_symbol'] = $this->settings_model->get_currency_symbol();
				$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
				$data['patients'] = $this->patient_model->get_patient();
				/*
				$bill_id = $payment->bill_id;
				$data['bill_id'] = $bill_id;
				$data['due_amount'] = $this->patient_model->get_due_amount($bill_id);
				$patient_id = $this->patient_model->get_patient_id_from_bill_id($bill_id);
				$data['bills'] = $this->patient_model->get_pending_bills();
				*/
				$clinic_id = $this->session->userdata('clinic_id'); 
				$user_id = $this->session->userdata('user_id'); 
				$header_data['clinic_id'] = $clinic_id;
				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
				$header_data['active_modules'] = $this->module_model->get_active_modules();
				$header_data['user_id'] = $user_id;
				$header_data['user'] = $this->admin_model->get_user($user_id);
				$header_data['login_page'] = get_main_page();
					
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('form',$data);
				$this->load->view('templates/footer');
			}else{
				$this->payment_model->edit_payment($payment_id);
				$in_account_amount = $this->input->post('in_account_amount');
				$patient_id = $this->input->post('patient_id');
				$this->payment_model->update_payment_in_account($patient_id ,$payment_id,$in_account_amount);
				$this->index();
			}
			
		}
	}
	public function delete ($payment_id ,$called_from='payment'){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->payment_model->delete_payment($payment_id);
			$this->index();
		}
	}
	public function issue_refund(){
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
			$data['patient_name'] = $this->patient_model->get_patient_name();
			
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['refunds'] = $this->payment_model->get_refunds();
			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('issue_refund',$data);
			$this->load->view('templates/footer');
		
		}
	}
	public function add_issue_refund(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('refund_amount', $this->lang->line('refund_amount'), "required");
				
			if ($this->form_validation->run() === FALSE) {
				
				$data['patients'] = $this->patient_model->get_patient();
				$data['def_dateformate'] = $this->settings_model->get_date_formate();
				$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
				$data['currency_symbol'] = $this->settings_model->get_currency_symbol();
									
				$clinic_id = $this->session->userdata('clinic_id'); 
				$user_id = $this->session->userdata('user_id'); 
				$header_data['clinic_id'] = $clinic_id;
				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
				$header_data['active_modules'] = $this->module_model->get_active_modules();
				$header_data['user_id'] = $user_id;
				$header_data['user'] = $this->admin_model->get_user($user_id);
				$header_data['login_page'] = get_main_page();
				
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('issue_refund_form',$data);
				$this->load->view('templates/footer');
			}else{
				$this->payment_model->add_refund();
				$this->issue_refund();
			}
		}
	}
	public function edit_refund($refund_id){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('refund_amount', $this->lang->line('refund_amount'), "required");
				
			if ($this->form_validation->run() === FALSE) {
				$clinic_id = $this->session->userdata('clinic_id'); 
				$user_id = $this->session->userdata('user_id'); 
				$header_data['clinic_id'] = $clinic_id;
				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
				$header_data['active_modules'] = $this->module_model->get_active_modules();
				$header_data['user_id'] = $user_id;
				$header_data['user'] = $this->admin_model->get_user($user_id);
				$header_data['login_page'] = get_main_page();
				
				$data['def_dateformate'] = $this->settings_model->get_date_formate();
				$data['refund'] = $this->payment_model->get_refund($refund_id);
				$data['refund_id'] = $refund_id;
				$patient_id = $data['refund']['patient_id'];
				$data['patient'] = $this->patient_model->get_patient_detail($patient_id);
				$data['patient_name'] = $data['patient']['first_name'] . " " . $data['patient']['middle_name'] . " " .$data['patient']['last_name'];
				$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
				$data['currency_symbol'] = $this->settings_model->get_currency_symbol();
					
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('issue_refund_form',$data);
				$this->load->view('templates/footer');
			}else{
				$this->payment_model->edit_refund($refund_id);
				$this->issue_refund();
			}
		}
	}
	public function delete_refund($refund_id){
		$this->payment_model->delete_refund($refund_id);
		$this->issue_refund();
	}
}
?>
