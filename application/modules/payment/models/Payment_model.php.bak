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
?>
<?php

class Payment_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function list_payments() {
		/*if($this->session->userdata('clinic_code')){
			$clinic_code = $this->session->userdata('clinic_code');
			$this->db->where("clinic_code", $clinic_code);
		}*/
		$this->db->order_by("pay_date", "desc");
        $query = $this->db->get('view_payment');
        //echo $this->db->last_query();
		return $query->result_array();
    }
	public function get_payments() {
        $this->db->order_by("pay_date", "desc");
        $query = $this->db->get('payment');
        return $query->result_array();
    }
	public function get_payments_by_email($user_email) {
		$query = $this->db->get_where('view_patient', array('email' => $user_email));
        $patients = $query->result_array();
		$patient_ids ="";
		foreach($patients as $patient){
			$patient_ids .= $patient['patient_id'];
		}
		$where='patient_id in ('.$patient_ids.')';
		$this->db->where($where);
        $query = $this->db->get('payment');
		return $query->result_array();
    }
	public function get_bill_payment_r() {
        $query = $this->db->get('bill_payment_r');
        return $query->result_array();
    }
	public function get_bills_for_payment($payment_id) {
		$this->db->where('payment_id', $payment_id);
        $query = $this->db->get('bill_payment_r');
        return $query->result_array();
    }
	public function get_total_payment_for_bill($bill_id){
		$this->db->select_sum('adjust_amount', 'amount');
		$this->db->where('bill_id', $bill_id);
        $query = $this->db->get('bill_payment_r');
		$result = $query->result();

		return $result[0]->amount;
	}
	public function get_payments_for_bill($bill_id) {
		$this->db->where('bill_id', $bill_id);
        $query = $this->db->get('bill_payment_r');
        return $query->result_array();
    }
	public function add_payment_in_account($patient_id ,$payment_id,$in_account_amount){
		$data['patient_id'] = $patient_id ;
		$data['payment_id'] = $payment_id ;
		$data['adjust_amount'] = $in_account_amount ;
		$this->db->insert('patient_account', $data);

		//echo $this->db->last_query();
	}
	public function update_payment_in_account($patient_id ,$payment_id,$in_account_amount){

		$query=$this->db->get_where('patient_account',array('patient_id'=>$patient_id,'payment_id'=>$payment_id));
		$row=$query->row();
		if (!$row) {
			$data['patient_id'] = $patient_id ;
			$data['payment_id'] = $payment_id ;
			$data['adjust_amount'] = $in_account_amount ;
			$this->db->insert('patient_account', $data);
			//echo $this->db->last_query();
		}else{
			$data['adjust_amount'] = $in_account_amount ;
			$this->db->update('patient_account', $data,array('payment_id'=>$payment_id,'patient_id'=>$patient_id));
			//echo $this->db->last_query();
		}


	}
	public function adjust_from_account($patient_id){

		/** Multiple Bill Adjustment */
		if($this->input->post('bill_id')){
			$bill_array = $this->input->post('bill_id');
			$adjust_amount = $this->input->post('adjust_amount');
			$i=0;
			foreach($bill_array as $bill){
				$bill_id = $bill;
				$bill_adjust_amount = $adjust_amount[$i];

				$data_r['patient_id'] = $patient_id ;
				$data_r['bill_id'] = $bill_id;
				$data_r['adjust_amount'] = $bill_adjust_amount;
				$this->db->insert('patient_account', $data_r);
				echo $this->db->last_query();

				$this->db->set('due_amount', "`due_amount`-$bill_adjust_amount", FALSE);
				$this->db->set('sync_status', 0);
				$this->db->where('bill_id', $bill_id);
				$this->db->update('bill');
				echo $this->db->last_query();

				$i++;
			}
		}
		//$this->db->insert('patient_account', $data);
	}
	public function get_payment_method_by_name($payment_method_name){
		$query = $this->db->get_where('payment_methods',array('payment_method_name' => $payment_method_name));
        return $query->row_array();
	}
	public function insert_payment() {
		$data = array();
		$data_r = array();

		$pay_amount = $this->input->post('payment_amount');

		$data['pay_amount'] = $pay_amount;
		$data['pay_date'] = date('Y-m-d',strtotime($this->input->post('payment_date')));
		$data['pay_mode'] = $this->input->post('pay_mode');
		$data['additional_detail'] = $this->input->post('additional_detail');
		$data['patient_id'] = $this->input->post('patient_id');
		if($this->session->userdata('clinic_code')){
			$data['clinic_code'] = $this->session->userdata('clinic_code');
		}
		$payment_method = $this->get_payment_method_by_name($data['pay_mode']);
		$data['payment_status'] = 'complete';
		if($payment_method['payment_pending'] == 1){
			$data['payment_status'] = 'pending';
		}
		$this->db->insert('payment', $data);
		//echo $this->db->last_query();
		$payment_id = $this->db->insert_id();

		/** Multiple Bill Adjustment */
		if($this->input->post('bill_id')){
			$bill_array = $this->input->post('bill_id');
			$adjust_amount = $this->input->post('adjust_amount');

			$i=0;
			foreach($bill_array as $bill){
				$bill_id = $bill;
				$bill_adjust_amount = $adjust_amount[$i];

				$data_r['bill_id'] = $bill_id;
				$data_r['payment_id'] = $payment_id;
				$data_r['adjust_amount'] = $bill_adjust_amount;
				$data_r['clinic_code'] = $this->session->userdata('clinic_code');
				$this->db->insert('bill_payment_r', $data_r);
				//echo $this->db->last_query();

				//if($payment_method['payment_pending'] != 1){
					$this->db->set('due_amount', "`due_amount`-$bill_adjust_amount", FALSE);
					$this->db->set('sync_status', 0);
					$this->db->where('bill_id', $bill_id);
					$this->db->update('bill');
					//echo $this->db->last_query();
				//}
				$i++;
			}
		}
		return 	$payment_id;
    }
	public function get_pending_payments(){
		$query = $this->db->get_where('view_payment', array('payment_status' => 'pending'));
        return $query->result_array();
	}
	public function get_paid_amount($bill_id){
		$payments =  $this->get_payments_for_bill($bill_id);
		$total_payment = 0;
		foreach($payments as $payment){
			$payment_id = $payment['payment_id'];
			$adjust_amount = $this->get_adjustment_amount($bill_id,$payment_id);
			$total_payment = $total_payment + $adjust_amount;
		}
		return $total_payment;
	}
	function approve($payment_id){


		$data['payment_status'] = 'complete';
		$this->db->where('payment_id', $payment_id);
		$this->db->update('payment', $data);
	}
	function reject($payment_id){

		$this->db->where('payment_id', $payment_id);
        $query = $this->db->get('bill_payment_r');
        $bill_payments = $query->result_array();

		foreach($bill_payments as $bill_payment){
			$adjust_amount = $bill_payment['adjust_amount'];
			$bill_id = $bill_payment['bill_id'];

			$this->db->set('due_amount', "`due_amount`+$adjust_amount", FALSE);
			$this->db->set('sync_status', 0);
			$this->db->where('bill_id', $bill_id);
			$this->db->update('bill');
		}

		$data['payment_status'] = 'rejected';
		$this->db->where('payment_id', $payment_id);
		$this->db->update('payment', $data);
	}
	function get_payment($payment_id){
		$query = $this->db->get_where('payment', array('payment_id' => $payment_id));
        return $query->row_array();
	}
	function edit_payment($payment_id){
		//Get previous details

		$bill_array = $this->input->post('bill_id');
		$adjust_amount = $this->input->post('adjust_amount');
		$i=0;
		foreach($bill_array as $bill){
			$bill_id = $bill;
			$bill_adjust_amount = $adjust_amount[$i];

			//Previous Adjustment Amount
			$previous_adjust_amount = $this->get_adjustment_amount($bill_id,$payment_id);

			//Update Bill Payment Relation
			$data_r['adjust_amount'] = $bill_adjust_amount;
			$data_r['sync_status'] = 0;
			$this->db->where('payment_id', $payment_id);
			$this->db->where('bill_id', $bill_id);
			$this->db->update('bill_payment_r', $data_r);
			//echo $this->db->last_query();

			//if($payment_method['payment_pending'] != 1){
				//Update Bill
				$this->db->set('due_amount', "`due_amount`+$previous_adjust_amount-$bill_adjust_amount", FALSE);
				$this->db->set('sync_status',0);
				$this->db->where('bill_id', $bill_id);
				$this->db->update('bill');
				//echo $this->db->last_query();
			//}
			$i++;
		}

		//Update Payment
		$data['pay_amount'] = $this->input->post('payment_amount');
		$pay_amount = $data['pay_amount'];
		$data['pay_mode'] = $this->input->post('pay_mode');
		$data['pay_date'] = date('Y-m-d',strtotime($this->input->post('payment_date')));
		$data['additional_detail'] = $this->input->post('additional_detail');
		$data['sync_status'] = 0;
		$this->db->where('payment_id', $payment_id);
		$this->db->update('payment', $data);

	}
	function get_adjustment_amount($bill_id,$payment_id){
		$this->db->where('payment_id', $payment_id);
		$this->db->where('bill_id', $bill_id);
        $query = $this->db->get('bill_payment_r');
        $row = $query->row_array();
		$previous_adjust_amount = $row['adjust_amount'];
		return $previous_adjust_amount;
	}
	function delete_payment($payment_id){
		//Adjust Bills
		$related_bills = $this->get_bills_for_payment($payment_id);
		foreach($related_bills as $bill){
			$bill_id = $bill['bill_id'];
			$bill_adjust_amount = $bill['adjust_amount'];
			$this->db->set('due_amount', "`due_amount`+$bill_adjust_amount", FALSE);
			$this->db->set('sync_status',0);
			$this->db->where('bill_id', $bill_id);
			$this->db->update('bill');
		}
		//Delete Bill Payment Relation
		$this->db->delete('bill_payment_r', array('payment_id' => $payment_id));
		//Delete From Patient Account
		$this->db->delete('patient_account', array('payment_id' => $payment_id));
		//Delete Payment
		$this->db->delete('payment', array('payment_id' => $payment_id));
	}
	public function add_refund(){
		$data['patient_id'] = $this->input->post('patient_id');
		$data['refund_amount'] = $this->input->post('refund_amount');
		if($this->input->post('refund_date')){
			$data['refund_date'] = date('Y-m-d',strtotime($this->input->post('refund_date')));
		}else{
			$data['refund_date'] = date('Y-m-d');
		}
		$data['refund_note'] = $this->input->post('refund_note');
		$this->db->insert('refund', $data);
		$refund_id = $this->db->insert_id();

		$data = array();
		$data['patient_id'] = $this->input->post('patient_id');
		$data['refund_id'] = $refund_id;
		$data['adjust_amount'] = $this->input->post('refund_amount') * -1;
		$this->db->insert('patient_account', $data);

		//echo $this->db->last_query();
	}
	public function edit_refund($refund_id){
		$data['patient_id'] = $this->input->post('patient_id');
		$data['refund_amount'] = $this->input->post('refund_amount');
		$data['refund_date'] = date('Y-m-d',strtotime($this->input->post('refund_date')));
		$data['refund_note'] = $this->input->post('refund_note');
		$this->db->update('refund', $data,array('refund_id'=>$refund_id));
		//echo $this->db->last_query();

		$data = array();
		$data['patient_id'] = $this->input->post('patient_id');
		$data['adjust_amount'] = $this->input->post('refund_amount') * -1;
		$this->db->update('patient_account', $data,array('refund_id'=>$refund_id));
		//echo $this->db->last_query();
	}

	public function get_refunds(){
		$query = $this->db->get('refund');
        return $query->result_array();
	}
	public function get_refund($refund_id){
		$this->db->where('refund_id', $refund_id);

		$query = $this->db->get('refund');
        return $query->row_array();
	}
	public function delete_refund($refund_id){
		$this->db->delete('refund', array('refund_id' => $refund_id));
	}
}
?>