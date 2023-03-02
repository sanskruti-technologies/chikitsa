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
class Payment extends CI_Controller {
    function __construct() {
        parent::__construct();

		$this->config->load('version');
       
		$this->load->model('payment_model');
		$this->load->model('patient/patient_model');
		$this->load->model('bill/bill_model');
		$this->load->model('settings/settings_model');

		$this->load->model('module/module_model');
		$this->load->model('admin/admin_model');
		$this->load->model('menu_model');

		$this->load->helper('form');
		/*$this->load->helper('currency');*/
		$this->load->helper('currency_helper');
		
		$this->load->helper('url');
		//$this->load->helper('mainpage');
		$this->load->helper('header');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->lang->load('main',$this->session->userdata('prefered_language'));
	
    }
    public function index() {
		/*Check if user has logged in*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
			redirect('login/index');
        }else if (!$this->menu_model->can_access("payments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
			if($this->input->post('from_date')){
				$data['from_date'] = $this->input->post('from_date');
			}else{
				//$data['from_date'] = date('Y-m-d');
				$data['from_date'] = date('01-m-Y');
			}
			if($this->input->post('to_date')){
				$data['to_date'] = $this->input->post('to_date');
			}else{
				$data['to_date'] = date('Y-m-d');
			}
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
			$header_data = get_header_data();

			$this->load->view('templates/header',$header_data);
		    $this->load->view('templates/menu');
			$this->load->view('browse',$data);
			$this->load->view('templates/footer');
        }
    }
	public function insert($patient_id,$called_from = 'bill') {
		/*Check if user has logged in*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        }else if (!$this->menu_model->can_access("payments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
			//patient_account_value from settings 
			$data['patient_account_value']=$this->settings_model->get_data_value('patient_account');

			$active_modules = $this->module_model->get_active_modules();
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();

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
				$this->form_validation->set_rules('payment_date', $this->lang->line('payment_date'), 'required');
				if($data['patient_account_value']!=1){
					$total_due_amount_validate=$total_due_amount-1;
					$this->form_validation->set_rules('payment_amount', $this->lang->line('payment_amount'), "required|greater_than[0]|less_than_equal_to[$total_due_amount_validate]");
				}

				if ($this->form_validation->run() === FALSE) {
					$data['patients'] = $this->patient_model->get_patient();
					$data['bills'] = $this->bill_model->get_pending_bills();
					$data['invoice_settings'] = $this->settings_model->get_invoice_settings();
					//print_r($data['invoice_settings']);
					$data['currency_symbol']=$data['invoice_settings']['currency_symbol'];
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
					$header_data = get_header_data();

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
						/*redirect('patient/visit/'.$patient_id);*/
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
	public function pending_payments(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        }else if (!$this->menu_model->can_access("payments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
			$data['pending_payments'] = $this->payment_model->get_pending_payments();
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');
			$header_data = get_header_data();

			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('pending_payments',$data);
			$this->load->view('templates/footer');
		}
	}
	public function approve($payment_id){
		$this->payment_model->approve($payment_id);

		$this->pending_payments();
	}
	public function reject($payment_id){
		$this->payment_model->reject($payment_id);
		$this->pending_payments();
	}
	public function edit($payment_id,$called_from='payment'){
		/*Check if user has logged in*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        }else if (!$this->menu_model->can_access("payments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
			//patient_account_value from settings 
			$data['patient_account_value']=$this->settings_model->get_data_value('patient_account');

			$total_due_amount = $this->input->post('total_due_amount')+1;
			$this->form_validation->set_rules('patient_id', $this->lang->line('patient_id'), 'required');
			$this->form_validation->set_rules('payment_amount', $this->lang->line('payment_amount'), "required");
			
			if($data['patient_account_value']!=1){
				$total_due_amount_validate=$total_due_amount-1;
				$this->form_validation->set_rules('payment_amount', $this->lang->line('payment_amount'), "required|greater_than[0]|less_than_equal_to[$total_due_amount_validate]");
			}


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
				$data['payment_methods'] = $this->settings_model->get_payment_methods();

				/*
				$bill_id = $payment->bill_id;
				$data['bill_id'] = $bill_id;
				$data['due_amount'] = $this->patient_model->get_due_amount($bill_id);
				$patient_id = $this->patient_model->get_patient_id_from_bill_id($bill_id);
				$data['bills'] = $this->patient_model->get_pending_bills();
				*/
				$clinic_id = $this->session->userdata('clinic_id');
				$user_id = $this->session->userdata('user_id');
				$header_data = get_header_data();

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
        }else if (!$this->menu_model->can_access("issue_refund",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {

			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');
			$header_data = get_header_data();

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
        }else if (!$this->menu_model->can_access("issue_refund",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
			$this->form_validation->set_rules('patient_id', $this->lang->line('patient_id'), "required");
			$this->form_validation->set_rules('refund_amount', $this->lang->line('refund_amount'), "required");

			if ($this->form_validation->run() === FALSE) {

				$data['patients'] = $this->patient_model->get_patient();
				$data['def_dateformate'] = $this->settings_model->get_date_formate();
				$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
				$data['currency_symbol'] = $this->settings_model->get_currency_symbol();

				$clinic_id = $this->session->userdata('clinic_id');
				$user_id = $this->session->userdata('user_id');
				$header_data = get_header_data();
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
        }else if (!$this->menu_model->can_access("issue_refund",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
			$this->form_validation->set_rules('refund_amount', $this->lang->line('refund_amount'), "required");

			if ($this->form_validation->run() === FALSE) {
				$clinic_id = $this->session->userdata('clinic_id');
				$user_id = $this->session->userdata('user_id');
				$header_data = get_header_data();

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

	public function payment_methods(){
		if (!$this->menu_model->can_access("payment_methods",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		}
		else{
			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			$header_data = get_header_data();

			$data['payment_methods'] = $this->settings_model->get_payment_methods();
			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('payment/payment_methods',$data);
			$this->load->view('templates/footer');
		}
	}
	public function insert_payment_method(){
		$this->form_validation->set_rules('payment_method_name', $this->lang->line('payment_method')." ".$this->lang->line('name'), 'required|is_unique[payment_methods.payment_method_name]');

		if ($this->form_validation->run() === FALSE) {

			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			$header_data = get_header_data();

			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('payment/payment_method_form');
			$this->load->view('templates/footer');
		}else{
			$this->settings_model->insert_payment_method();
			$this->payment_methods();
		}
	}
	public function edit_payment_method($payment_method_id){
		$this->form_validation->set_rules('payment_method_name', $this->lang->line('payment_method')." ".$this->lang->line('name'), 'required');

		if ($this->form_validation->run() === FALSE) {

			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			$header_data = get_header_data();
			$data['payment_method'] = $this->settings_model->get_payment_method($payment_method_id);
			$this->load->view('templates/header',$header_data);
			$this->load->view('templates/menu');
			$this->load->view('payment/payment_method_form',$data);
			$this->load->view('templates/footer');
		}else{
			$this->settings_model->edit_payment_method($payment_method_id);
			$this->payment_methods();
		}
	}
	public function delete_payment_method($payment_method_id){
		$this->settings_model->delete_payment_method($payment_method_id);
		$this->payment_methods();
	}

}
?>