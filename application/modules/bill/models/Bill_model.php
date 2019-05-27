<?php
class Bill_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
	public function get_bill_id($visit_id) {
        $query = $this->db->get_where('bill', array('visit_id' => $visit_id));
        //echo $this->db->last_query()."<br/>";
		$row = $query->row();
        if ($row)
            return $row->bill_id;
    }
	public function get_bill_amount($bill_id) {
        $query = $this->db->get_where('bill', array('bill_id' => $bill_id));
		//echo $this->db->last_query()."<br/>";
        $row = $query->row();
        if ($row)
            return $row->total_amount;
        else
            return 0;
    }
	public function get_bill_detail_by_id($bill_detail_id){
		$query = $this->db->get_where('bill_detail', array('bill_detail_id' => $bill_detail_id));
        $row = $query->row_array();
		return $row;
	}
	public function update_remaining_quantity($bill_detail_id) {
        $this->db->select('purchase_id,quantity');
        $query = $this->db->get_where('bill_detail', array('bill_detail_id' => $bill_detail_id));
        $row = $query->row();
        if ($row)
            return $row;
        else
            return 0;
    }
	public function get_bill_from_appointment_id($appointment_id){
		$query = $this->db->get_where('bill', array('appointment_id' => $appointment_id));
        $row = $query->row_array();
		return $row;
	}
	public function get_taxable_amount($bill_id){
		$bill_details = $this->get_bill_detail($bill_id);
		$taxable_total = 0;
		foreach($bill_details as $bill_detail){
			if($bill_detail['type'] != 'tax' && $bill_detail['type'] != 'discount'){
				$taxable_total = $taxable_total + $bill_detail['amount'];
			}		
		}
		return $taxable_total;
	}
	public function recalculate_tax($bill_id){
		$bill_details = $this->get_bill_detail($bill_id);
		//Get Total Before Discount
		$taxable_total = $this->get_taxable_amount($bill_id);
		
		//Update Tax
		foreach($bill_details as $bill_detail){
			if($bill_detail['type'] == 'tax'){
				$bill_detail_id = $bill_detail['bill_detail_id'];
				$org_tax_amount = $bill_detail['amount'];
				
				$tax_id = $bill_detail['tax_id'];
				$tax_rate = $this->settings_model->get_tax_rate($tax_id);
				$tax_rate_percent = $tax_rate['tax_rate'];
				//echo $taxable_total."<br/>";
				//echo $tax_id."<br/>";
				//echo $tax_rate_percent."<br/>";
				$new_tax_amount = $taxable_total * $tax_rate_percent / 100;
				//echo $new_tax_amount."<br/>";
				//Update Bill Detail
				$sql = "update " . $this->db->dbprefix('bill_detail') . " set sync_status = 0,amount = ?,mrp = ? where bill_detail_id = ?;";
				$this->db->query($sql, array($new_tax_amount,$new_tax_amount,$bill_detail_id));
				//echo $this->db->last_query()."<br/>";

				$amount_change = $new_tax_amount - $org_tax_amount;
				//Update Bill
				$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,total_amount = total_amount + ?,due_amount = due_amount + ?,tax_amount = tax_amount + ? where bill_id = ?;";
				$this->db->query($sql, array($amount_change,$amount_change,$amount_change, $bill_id));
				//echo $this->db->last_query()."<br/>";
			}
		}	
	}
	public function delete_bill_detail($bill_detail_id = NULL, $bill_id = NULL) {
        $bill_detail = $this->get_bill_detail_by_id($bill_detail_id);
		
		if($bill_detail['type'] == "tax"){
			$tax_amount = $bill_detail['amount'];
			$total_amount = 0;
		}else{
			$tax_amount = 0;
			$total_amount = $bill_detail['amount'];
		}
		$due_amount = $tax_amount + $total_amount;
		
        $purchase_id = 0;
        $quantity = 0;

        $remain_quantity = $this->update_remaining_quantity($bill_detail_id);
        if ($remain_quantity) {
            $purchase_id = $remain_quantity->purchase_id;
            $quantity = $remain_quantity->quantity;
        }

        $this->db->delete('bill_detail', array('bill_detail_id' => $bill_detail_id));
		//echo $this->db->last_query()."<br/>";
        
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,total_amount = total_amount - ?,due_amount = due_amount - ?,tax_amount = tax_amount - ? where bill_id = ?;";
        $this->db->query($sql, array($total_amount,$due_amount,$tax_amount, $bill_id));
		//echo $this->db->last_query()."<br/>";
		
		//Adjust Payment
		$this->update_payment($bill_id,$due_amount);
		
		//echo $this->db->last_query()."<br/>";

    }
    public function update_discount($bill_id,$discount_amount) {
		$data['bill_id'] = $bill_id;
		$data['particular'] = 'Discount';
		$data['quantity'] = 1;
		$data['amount'] = $discount_amount;
		$data['mrp'] = $discount_amount;
		$data['type'] = 'discount';
		$data['clinic_code'] = $this->session->userdata('clinic_code');
        
		$query = $this->db->get_where('bill_detail', array('bill_id ' => $bill_id, 'type' => 'discount'));
		//echo $this->db->last_query()."<br/>";
		if ($query->num_rows() > 0){
			$bill_detail = $query->row_array();
			$data['amount'] = $discount_amount + $bill_detail['amount'];
			$data['mrp'] = $discount_amount + $bill_detail['amount'];
			$data['sync_status'] = 0;
			$this->db->update('bill_detail', $data,array('bill_id ' => $bill_id, 'type' => 'discount'));
			//echo $this->db->last_query()."<br/>";
		}else{
			$this->db->insert('bill_detail', $data);
			//echo $this->db->last_query()."<br/>";
		}
		
		$bill = $this->get_bill($bill_id);
		$balance_amount = $bill['due_amount'];
		if($balance_amount > $discount_amount){
			$balance_amount = $balance_amount - $discount_amount;
		}else{
			$balance_amount = 0;
		}
		
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0, total_amount = total_amount - ?, due_amount = ?  where bill_id = ?;";
        $this->db->query($sql, array($discount_amount,$balance_amount, $bill_id));
		//echo $this->db->last_query()."<br/>";
		$this->update_payment($bill_id,$discount_amount);
		
	}
	public function update_payment($bill_id,$adjust_amount){
		$query = $this->db->get_where('bill_payment_r', array('bill_id' => $bill_id));
        $bill_payment_r = $query->result_array();
		
		foreach($bill_payment_r as $bill_payment){
			if($bill_payment['adjust_amount'] >= $adjust_amount){
				
				$bill_payment_id = $bill_payment['bill_payment_id'];
				$data['adjust_amount'] = $bill_payment['adjust_amount'] - $adjust_amount;
 				$this->db->update('bill_payment_r', $data, array('bill_payment_id' => $bill_payment_id));
				
				$query = $this->db->get_where('payment', array('payment_id' => $bill_payment['payment_id']));
				$payment = $query->row_array();
				
				$data = array();
				$data['patient_id'] = $payment['patient_id'];
				$data['payment_id'] = $bill_payment['payment_id'];
				$data['bill_id'] = NULL;
				$data['adjust_amount'] = $adjust_amount;
				$this->db->insert('patient_account', $data);
				$adjust_amount = 0;
				
				
			}
		}
	}
    public function get_discount_amount($bill_id){
		$query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id,'type'=>'discount'));
        $row = $query->row();
        if ($row)
            return $row->amount;
        else
            return 0;
	}
	public function get_tax_total($type,$bill_id) {
		
		$this->db->select_sum('tax_amount', 'tax_total');
        $query = $this->db->get_where('view_bill_detail_report', array('bill_id' => $bill_id,'type'=>$type));
		//echo $this->db->last_query()."<br/>";
        $row = $query->row();
        return $row->tax_total;
	}
	public function get_income_data(){
    	
		$query = $this->db->query('SELECT visit_id,bill_date,total_amount FROM '. $this->db->dbprefix('bill').' GROUP BY visit_id');
		
		//echo $this->db->last_query($query)."<br/>";
		$result = $query->result_array();
		
		$total_amount_data = array();
		foreach ($result as $row) {
			$total_amount_data[$row['bill_date']][$row['total_amount']] = $row['total_amount'];
		}

		return $total_amount_data;
	}	
	public function get_income_this_month(){
    	$first_day_of_month=date('Y-m-01');
       	$today=date('Y-m-d');
    	$this->db->select_sum('total_amount');
    	$this->db->where('bill_date >=' , $first_day_of_month);
        $this->db->where('bill_date <=' , $today);
    	$query=$this->db->get('bill');
    	//echo $this->db->last_query();
    	$row=$query->row_array();
    	return $row['total_amount'];
    }
	public function get_bills(){
		
		if($this->input->post('from_date')){
			$from_date = date("Y-m-d", strtotime($this->input->post('from_date')));
			$this->db->where('bill_date >=', $from_date);
		}
		if($this->input->post('to_date')){
			$to_date = date("Y-m-d", strtotime($this->input->post('to_date')));
			$this->db->where('bill_date <=', $to_date);
		}
		if($this->input->post('doctor_id') && $this->input->post('doctor_id') != 0){
			$doctor_id = $this->input->post('doctor_id');
			$this->db->where('doctor_id', $doctor_id);
		}
		
    	$qry=$this->db->get('view_bill');
    	$result=$qry->result_array();
    	return $result;
    }
	public function create_bill($visit_id, $patient_id, $due_amount = NULL) {
		$data['clinic_id'] = $this->session->userdata('clinic_id');
		if($this->session->userdata('clinic_code')){
			$data['clinic_code'] = $this->session->userdata('clinic_code');
		}
        $data['bill_date'] = date('Y-m-d');
		$data['bill_time'] = date('H:i:s');
        $data['patient_id'] = $patient_id;
        $data['visit_id'] = $visit_id;
        if($due_amount == NULL){
            $data['due_amount'] = 0.00;
        }else{
            $data['due_amount'] = $due_amount;
        }
		$data['clinic_code'] = $this->session->userdata('clinic_code');
        
        $this->db->insert('bill', $data);
		//echo $this->db->last_query()."<br/>";
        return $this->db->insert_id();
    }
	public function create_bill_for_patient($patient_id, $due_amount = NULL,$doctor_id = NULL) {
		if($this->session->userdata('clinic_code')){
			$clinic_code = $this->session->userdata('clinic_code');
			$data['clinic_code'] = $clinic_code;
		}
		$clinic_id = $this->session->userdata('clinic_id');
		$data['clinic_id'] = $clinic_id;
		if($this->input->post('appointment_id')){
			$data['appointment_id'] = $this->input->post('appointment_id');
		}
		if($this->input->post('bill_date')){
			 $data['bill_date'] = date('Y-m-d',strtotime($this->input->post('bill_date')));
		}else{
			 $data['bill_date'] = date('Y-m-d');
		}
        if($this->input->post('bill_time')){
			 $data['bill_time'] = date('H:i:s',strtotime($this->input->post('bill_time')));
		}else{
			 $data['bill_time'] = date('H:i:s');
		}
        $data['patient_id'] = $patient_id;
        $data['doctor_id'] = $doctor_id;
       // $data['visit_id'] = $visit_id;
        if($due_amount == NULL){
            $data['due_amount'] = 0.00;
        }else{
            $data['due_amount'] = $due_amount;
        }
		$data['clinic_code'] = $this->session->userdata('clinic_code');
        
        $this->db->insert('bill', $data);
		//echo $this->db->last_query()."<br/>";
        return $this->db->insert_id();
    }
	public function get_bill_clinic_id($clinic_id) {
        $query = $this->db->get_where('bill', array('clinic_id' => $clinic_id));
        return $query->row_array();
        
    }
	public function get_bill_patient_byid($patient_id) {
        $query = $this->db->get_where('bill', array('patient_id' => $patient_id));
        return $query->row_array();
        
    }
	public function get_bill($bill_id) {
        $query = $this->db->get_where('bill', array('bill_id' => $bill_id));
        return $query->row_array();
        
    }
	public function get_bill_by_visit($visit_id) {
        $query = $this->db->get_where('bill', array('visit_id' => $visit_id));
		//echo $this->db->last_query()."<br/>";
        return $query->row_array();
    }
    public function get_bill_details(){
		$this->db->order_by("type", "desc");
        $query = $this->db->get('bill_detail');
		return $query->result_array();
	}
	public function get_bill_detail($bill_id) {
        $this->db->order_by("type", "desc");
        $query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id));
        //echo $this->db->last_query()."<br/>";
		return $query->result_array();
    }
	public function get_bill_detail_by_visit($visit_id) {
        $bill_id = $this->get_bill_id($visit_id);
        $this->db->order_by("type", "desc");
        $query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id));
        return $query->result_array();
    }
	public function get_particular_total($bill_id) {
        $this->db->select_sum('amount', 'particular_total');
        $query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id,'type'=>'particular'));
        $row = $query->row();
        return $row->particular_total;
    }
	public function get_package_total($bill_id) {
        $this->db->select_sum('amount', 'package_total');
        $query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id,'type'=>'package'));
        $row = $query->row();
        return $row->package_total;
    }
	public function get_treatment_total($bill_id) {
        $this->db->select_sum('amount', 'treatment_total');
        $query = $this->db->get_where('view_bill_detail_report', array('bill_id' => $bill_id, 'type' => 'treatment'));
        $row = $query->row();
        return $row->treatment_total;
    }
	public function get_item_total($bill_id) {
        $this->db->select_sum('amount', 'item_total');
        $query = $this->db->get_where('view_bill_detail_report', array('bill_id' => $bill_id, 'type' => 'item'));
        $row = $query->row();
        return $row->item_total;
    }
	public function get_fee_total($bill_id) {
        $this->db->select_sum('amount', 'fees_total');
        $query = $this->db->get_where('view_bill_detail_report', array('bill_id' => $bill_id,'type'=>'fees'));
        $row = $query->row();
        return $row->fees_total;
    }
	public function get_total($type,$bill_id){
		$this->db->select_sum('amount', 'total');
        $query = $this->db->get_where('view_bill_detail_report', array('bill_id' => $bill_id,'type'=>$type));
        $row = $query->row();
        return $row->total;
	}
	public function get_balance_amount($bill_id) {
		//Fetch Patient ID from bill id
		$query = $this->db->get_where('bill', array('bill_id' => $bill_id));
		if ($query->num_rows() > 0){
			$bill = $query->row_array();
			$balance_amount = $bill['due_amount'];
		}else{
			$balance_amount = 0;
		}
		return $balance_amount;
		
    }
	public function add_bill_item($action, $bill_id, $particular, $qnt = NULL, $amt = NULL, $mrp = NULL, $item_id = NULL, $tax_amount = NULL,$tax_id = NULL) {
		//If item already exists,just update item
		$data['bill_id'] = $bill_id;
		$data['particular'] = $particular;
		$data['quantity'] = $qnt;
		$data['amount'] = $amt;
		$data['mrp'] = $mrp;
		$data['type'] = $action;
		$data['item_id'] = $item_id;
		$data['clinic_code'] = $this->session->userdata('clinic_code');
		$data['tax_amount'] = $tax_amount;
		$data['tax_id'] = $tax_id;
		
		if ($item_id != NULL){
			$query = $this->db->get_where('bill_detail', array('bill_id ' => $bill_id, 'item_id ' => $item_id));
			if ($query->num_rows() > 0){
				$bill_detail = $query->row_array();
				$data['quantity'] = $qnt + $bill_detail['quantity'];
				$data['amount'] = $amt + $bill_detail['amount'];
				$data['sync_status'] = 0;
				$this->db->update('bill_detail', $data,array('bill_id ' => $bill_id, 'item_id ' => $item_id));
				//echo $this->db->last_query()."<br/>";
			}else{
				$this->db->insert('bill_detail', $data);
				$bill_detail_id = $this->db->insert_id();
				//echo $this->db->last_query()."<br/>";
			}
		}else{
			$this->db->insert('bill_detail', $data);
			$bill_detail_id = $this->db->insert_id();
			//echo $this->db->last_query()."<br/>";
		}
		if($action == "tax"){
			$total_amount = 0;
			$tax_amount = $amt;
		}else{
			$total_amount = $amt;
		}
		
        $sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,total_amount = total_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($total_amount, $bill_id));
		//echo $this->db->last_query()."<br/>";
		
		$total_tax_amount=$tax_amount;
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,tax_amount = tax_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($total_tax_amount, $bill_id));
		//echo $this->db->last_query()."<br/>";
		
		$due_amount = $total_amount + $tax_amount;
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,due_amount = due_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($due_amount, $bill_id));
		//echo $this->db->last_query()."<br/>";
		
		return $bill_detail_id;
    }
	public function update_bill_detail($bill_id,$type,$particular,$quantity,$amount,$mrp,$item_id){

		$data['bill_id'] = $bill_id;
		$data['particular'] = $particular;
		$data['quantity'] = $quantity;
		$data['amount'] = $amount;
		$data['mrp'] = $mrp;
		$data['item_id'] = $item_id;
		
		$this->db->update('bill_detail', $data,array('bill_id' =>  $bill_id,'type'=>$type));
		//echo $this->db->last_query();
	}
	public function edit_bill_item($bill_detail_id,$particular,	$amount,$quantity){
		$data['particular'] = $particular;
		$data['quantity'] = $quantity;
		$data['amount'] = $amount;
		$data['mrp'] = $amount;
		
		$this->db->update('bill_detail', $data,array('bill_detail_id' =>  $bill_detail_id));
	}
	public function get_tax_report($from_date = NULL, $to_date = NULL){
		if($from_date != NULL){
			$this->db->where('bill_date >=', $from_date);
		}
		if($to_date != NULL){
			$this->db->where('bill_date <=', $to_date);
		}
		
		$query = $this->db->get('view_tax_report');
		//echo $this->db->last_query()."<br/>";
        return $query->result_array();
	}
	public function get_bill_tax_report($from_date = NULL, $to_date = NULL){
		if($from_date != NULL){
			$this->db->where('bill_date >=', $from_date);
		}
		if($to_date != NULL){
			$this->db->where('bill_date <=', $to_date);
		}
		
		$query = $this->db->get('view_bill_tax_report');
		//echo $this->db->last_query()."<br/>";
        return $query->result_array();
        
	}
	public function get_pending_bills() {
        $query = $this->db->get_where('bill', array('due_amount >' => 0));
        return $query->result_array();
    }
	function get_bill_report($from_date,$to_date,$selected_doctor,$clinic_id = NULL,$patient_id = NULL) {
		
        if (!empty($selected_doctor)) {
			$this->db->where_in('doctor_id',$selected_doctor);
		}
		if($patient_id != NULL && $patient_id != 0){
			$this->db->where('patient_id',$patient_id);
		}
		$this->db->where('bill_date <=',$to_date);
		$this->db->where('bill_date >=',$from_date);
		$query = $this->db->get('view_bill');
		
		//echo $this->db->last_query()."<br/>";
		return $query->result_array();
    }
}
?>