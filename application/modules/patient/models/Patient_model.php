<?php

class Patient_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
		//get patient_id from user_id
	function get_patient_id_from_user_id($user_id){
		$query = $this->db->get_where('patient', array('user_id' => $user_id));
		//echo $this->db->last_query()."<br/>";
        $row = $query->row();
        $patient_id=$row->patient_id;
		return $patient_id;
	
	}
	function get_patients_count(){
    	$query = $this->db->query('SELECT visit_date,doctor_id,count(*) as count FROM '. $this->db->dbprefix('visit').' GROUP BY visit_date,doctor_id');
		
		//echo $this->db->last_query($query)."<br/>";exit;
		$result = $query->result_array();
		
		$patient_number_data = array();
		foreach ($result as $row) {
			$patient_number_data[$row['visit_date']][$row['doctor_id']] = $row['count'];
		}
		return $patient_number_data;
	}
	public function get_patients_this_month(){	
    		$first_day_of_month=date('Y-m-01');
        	$today=date('Y-m-d');
        	$this->db->where('visit_date >=' , $first_day_of_month);
        	$this->db->where('visit_date <=' , $today);
           	$query = $this->db->get('visit');
			//echo $this->db->last_query()."<br/>";
        	return $query->num_rows();
    }
	public function get_members(){
		$this->db->group_by('patient_id');
        $query = $this->db->get('view_patient');
		$this->db->where('IFNULL(is_inquiry,1) == 0');
		//echo $this->db->last_query()."<br/>";
        return $query->result_array();
	}
    public function get_patient() {
		$this->db->group_by('patient_id');
        $query = $this->db->get('view_patient');
		//echo $this->db->last_query()."<br/>";
        return $query->result_array();
    }
	public function get_patient_erpnext_key($erpnext_key){
		$this->db->where('erpnext_key', $erpnext_key);
		$query = $this->db->get('view_patient');
		//echo $this->db->last_query()."<br/>";
		return $query->row_array();
	}
	public function set_erpnext_key($patient_id,$erpnext_key){
		$data['erpnext_key'] = $erpnext_key;
		$this->db->update('patient', $data, array('patient_id' =>  $patient_id));
		//echo $this->db->last_query()."<br/>";
	}
	public function get_mobile_number() {
        $query = $this->db->get('view_patient');
        $patient_array = $query->result_array();
		$patient = array();
		
		foreach($patient_array as $patient_detail){
			$patient[$patient_detail['patient_id']] = $patient_detail['phone_number'];
		}
		return $patient;
    }
	public function get_patient_name() {
        $query = $this->db->get('view_patient');
        $patient_array = $query->result_array();
		$patient = array();
		
		foreach($patient_array as $patient_detail){
			$patient[$patient_detail['patient_id']] = $patient_detail['first_name'].' '.$patient_detail['middle_name'].' '.$patient_detail['last_name'];
		}
		return $patient;
    }
	public function get_patient_from_email($email) {
		$query = $this->db->get_where('view_patient', array('email' => $email));
		//echo $this->db->last_query()."<br/>";
        return $query->result_array();
    }
	public function get_today_birthdays($todate){
		$this->db->where("MONTH(dob) = MONTH('$todate')");
		$this->db->where("DAY(dob) = DAY('$todate')");
		$query = $this->db->get('view_patient');
		//echo $this->db->last_query()."<br/>";
		return $query->result_array();
	}
    public function find_patient() {
		if($this->session->userdata('clinic_code')){
			$clinic_code = $this->session->userdata('clinic_code');
			$this->db->where("clinic_code", $clinic_code);
        
		}
		$this->db->order_by("first_name", "asc");
        $this->db->group_by('patient_id');
        $query = $this->db->get('view_patient');
        return $query->result_array();
    }
	function get_patient_id_from_contact_id($contact_id){
		$query = $this->db->get_where('patient', array('contact_id' => $contact_id));
        $row = $query->row();
        if ($row)
            return $row->patient_id;
        else
            return 0;
	}
	function insert_new_register_patient($contact_id,$user_id,$first_name,$middle_name,$last_name){
		$display_id="";
		$data['contact_id'] = $contact_id;
		$data['user_id']=$user_id;
        $data['patient_since'] = date("Y-m-d");
		if($this->session->userdata('clinic_code')){
			$data['clinic_code'] = $this->session->userdata('clinic_code');
		}
		
		$this->db->insert('patient', $data);
		$patient_id = $this->db->insert_id();
		if($display_id == ""){
			$this->display_id($patient_id);
		}
        return $patient_id;
	}
	function insert_new_patient($contact_id){
		if($this->session->userdata('clinic_code')){
			$clinic_code = $this->session->userdata('clinic_code');
		}
		$data['contact_id'] = $contact_id;
		$this->db->insert('patient', $data);
        $patient_id = $this->db->insert_id();
		return $patient_id;
	}
    function insert_patient($contact_id,$patient_since) {
        $data['contact_id'] = $contact_id;
        $data['patient_since'] = $patient_since;
        $data['display_id'] = $this->input->post('display_id');
        $data['ssn_id'] = $this->input->post('ssn_id');
		$data['blood_group'] = $this->input->post('blood_group');
		$data['reference_by'] = $this->input->post('reference_by');
		$data['reference_by_detail'] = $this->input->post('reference_details');	
		$data['sync_status'] = 0;
		$data['gender'] = $this->input->post('gender');
		if($this->input->post('dob')){
			$data['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
		}
		$data['age'] = $this->input->post('age');
		if($this->session->userdata('clinic_code')){
			$data['clinic_code'] = $this->session->userdata('clinic_code');
		}
        $this->db->insert('patient', $data);
		//echo $this->db->last_query()."<br/>";
		$p_id = $this->db->insert_id();
		if($this->input->post('display_id') == ""){
			$this->display_id($p_id);
		}
        return $p_id;
    }
	function insert_patient_full($contact_id,$display_id,$reference_by,$gender,$dob,$age=NULL){
		$data['contact_id'] = $contact_id;
        $data['patient_since'] = date("Y-m-d");
        $data['display_id'] = $display_id;
        $data['reference_by'] = $reference_by;
		$data['gender'] = $gender;
		$data['age'] = $age;
		$data['sync_status'] = 0;
		
		if($this->session->userdata('clinic_code')){
			$data['clinic_code'] = $this->session->userdata('clinic_code');
		}
		if($dob != NULL){
			$data['dob'] = date('Y-m-d',strtotime($dob));
		}
		
        $this->db->insert('patient', $data);
		//echo $this->db->last_query();
		$patient_id = $this->db->insert_id();
		if($display_id == ""){
			$this->display_id($patient_id);
		}
		//echo $this->db->last_query();
        return $patient_id;
	}
	function update_patient_full($patient_id,$display_id,$reference,$gender,$dob){
		$data['display_id']   = $display_id;
		$data['reference_by']  = $reference;
		$data['gender']    = $gender;
		$data['dob'] = $dob;
		$data['sync_status'] = 0;
		
		$this->db->update('patient', $data, array('patient_id' =>  $patient_id));
	}
	function is_english($str){
		if (strlen($str) != strlen(utf8_decode($str))) {
			return false;
		} else {
			return true;
		}
	}
    function display_id($id) {
        $lname = $this->input->post('last_name');
		$str = "";
		if($this->is_english($lname)){
			$str = $lname[0];
			$str = strtoupper($str);
		}
       

        $p_id = $id;
        $n = 5;
        $num = str_pad((int) $p_id, $n, "0", STR_PAD_LEFT);
        $display_id = $str . $num;

        $this->db->set("display_id", $display_id);
		$this->db->set("sync_status", 0);
        $this->db->where("patient_id", $p_id);
        $this->db->update("patient");
		//echo $this->db->last_query()."<br/>";
    }
    function delete_patient($patient_id) {
        $this->db->select('contact_id');
        $query = $this->db->get_where('patient', array('patient_id' => $patient_id));
        $row = $query->row();
        if($row) {
            $c_id = $row->contact_id;

            /* Delete ck_contact_details data where Contact Id = $c_id */
            $this->db->delete('contact_details', array('contact_id' => $c_id));

            /* Delete ck_contacts data where Contact Id = $c_id */
            $this->db->delete('contacts', array('contact_id' => $c_id));

            /* Delete ck_visit_img data where Patient Id = $patient_id */
            $this->db->delete('visit_img', array('patient_id' => $patient_id));

            /* Delete ck_visit data where Patient Id = $patient_id */
            $this->db->delete('visit', array('patient_id' => $patient_id));

            /* Delete ck_appointments data where Patient Id = $patient_id */
            $this->db->delete('appointments', array('patient_id' => $patient_id));

            /* Delete ck_bill data where Patient Id = $patient_id */
            $this->db->delete('bill', array('patient_id' => $patient_id));

            /* Delete ck_patient data where Patient Id = $patient_id */
            $this->db->delete('patient', array('patient_id' => $patient_id));
        }
    }
    function get_patient_detail($patient_id) {
        //$this->db->group_by('patient_id');
        $query = $this->db->get_where('view_patient', array('patient_id' => $patient_id));
		//echo $this->db->last_query()."<br/>";
        return $query->row_array();
    }
	function find_patient_by_display_id($display_id) {
        $query = $this->db->get_where('view_patient', array('display_id' => $display_id));
        $row = $query->row_array();
		if ($row)
            return $row['patient_id'];
        else
            return 0;
    }
	function find_patient_by_name($first_name,$middle_name,$last_name){
		if($first_name != NULL){
			$this->db->where('first_name' , $first_name);
		}
		if($middle_name != NULL){
			$this->db->where('middle_name' , $middle_name);
		}
		if($last_name != NULL){
			$this->db->where('last_name' , $last_name);
		}
		$query = $this->db->get('view_patient');
		//echo $this->db->last_query()."<br/>";
        $row = $query->row_array();
		if ($row){
			return $row['patient_id'];	
		}else{
			return 0;
		}
		
	}
	function search_patient($name,$patient_id,$mobile,$email_id){
		$where = ' WHERE 1=1';
		$name = str_replace(" ","%",$name);
		if($name != ''){
			$where .= " AND CONCAT(IF(first_name IS NULL,'',CONCAT(first_name, ' ')), IF(middle_name IS NULL,'',CONCAT(middle_name, ' ')),last_name) like '%$name%'";
		}
		if($patient_id != ''){
			$where .= " AND CONCAT(display_id) like '%$patient_id%'";
		}
		if($mobile != ''){
			$where .= " AND CONCAT(phone_number) like '%$mobile%'";
		}
		if($email_id != ''){
			$where .= " AND CONCAT(email) like '%$email_id%'";
		}
		
		$query = $this->db->query('SELECT * FROM '. $this->db->dbprefix('view_patient') . $where);
		
		//echo $this->db->last_query()."<br/>";
		$result = $query->result_array();
		return $result;
	}
    function get_contact_id($patient_id) {
		//echo "Here";
        $query = $this->db->get_where('patient', array('patient_id' => $patient_id));
        $row = $query->row();
		//print_r($row);
        if ($row)
            return $row->contact_id;
        else
            return 0;
    }
    function get_previous_visits($patient_id,$doctor_id = NULL) {
		$this->db->order_by("visit_date", "desc");
        if($doctor_id != NULL){
           // $userid = $this->session->userdata('id');
            $query = $this->db->get_where('view_visit', array('patient_id' => $patient_id, 'doctor_id' => $doctor_id));
        }else{
            $query = $this->db->get_where('view_visit', array('patient_id' => $patient_id));
        }
		//echo $this->db->last_query()."<br/>";
        return $query->result_array();
    }
    function get_visit_data($visit_id) {
        $query = $this->db->get_where('view_visit', array('visit_id' => $visit_id));
		//echo $this->db->last_query()."<br/>";
        return $query->row_array();
    }
	function get_doctor_user_id($doctor_id){
		$this->db->where('doctor_id', $doctor_id);
		$query = $this->db->get('doctor');
		$doctor = $query->row_array();
		
		return $doctor['userid'];
	}
    function insert_visit() {
		/* Insert New Visit */
        $data['patient_id'] = $this->input->post('patient_id');
		$patient_detail = $this->get_patient_detail($data['patient_id']);
		
		$level = $this->session->userdata('category');
		$doctor_id=$this->input->post('doctor');
        $data['doctor_id'] = $doctor_id;
		
		$data['userid']=$this->get_doctor_user_id($doctor_id);
		$visit_date = date("Y-m-d", strtotime($this->input->post('visit_date')));
		$visit_time = date("H:i", strtotime($this->input->post('visit_time')));
		$data['notes'] = $this->input->post('notes');
		$data['patient_notes'] = $this->input->post('patient_notes');
		$data['type'] = $this->input->post('type');
		$data['visit_date'] = $visit_date;
		$data['visit_time'] = $visit_time;
		$data['appointment_reason'] = $this->input->post('appointment_reason');
		
		if($this->session->userdata('clinic_code')){
			$data['clinic_code'] = $this->session->userdata('clinic_code');
		}
		
		$this->db->insert('visit', $data);
		//echo $this->db->last_query()."<br/>";
		$visit_id = $this->db->insert_id();
			
		
		return $visit_id;
    }
	function get_followups($till_date,$doctor_id = 0){
		$this->db->order_by("followup_date", "asc");
		$this->db->where('followup_date <=' , $till_date);
		if($doctor_id != 0){
			$this->db->where('doctor_id' , $doctor_id);
		}
		$query = $this->db->get('followup');
		$followups = $query->result_array();
		//echo $this->db->last_query()."<br/>";
		return $followups;
	}
	public function get_followups_patient($patient_id){
		$query = $this->db->get_where('followup', array('patient_id' => $patient_id));
		$followups = $query->result_array();
		return $followups;
	}
	public function get_patient_from_followup($followup_id){
		$query = $this->db->get_where('followup', array('id' => $followup_id));
		$followup = $query->row_array();
		return $followup;
	}
	public function get_followup($followup_id){
		$query = $this->db->get_where('followup', array('id' => $followup_id));
		$followup = $query->row_array();
		return $followup;
	}
	public function getfollowup_detail($patient_id,$followup_date){
		$query = $this->db->get_where('followup', array('patient_id' => $patient_id,'followup_date' => $followup_date));
		$followup = $query->row_array();
		return $followup;
	}
	public function remove_followup($followup_id){
		$this->db->delete('followup', array('id' => $followup_id));
	}
	public function change_followup_detail($patient_id,$doctor_id){
		$data['followup_date'] = date('Y-m-d', strtotime($this->input->post('followup_date')));
		$data['patient_id'] = $patient_id;		
        $data['doctor_id'] = $doctor_id;
				
		$query = $this->db->get_where('followup', array('patient_id' => $patient_id,'doctor_id' => $doctor_id));
		$row = $query->row();
		
		if ($row){
			//Update Followup Details
			$data['sync_status'] = 0;
			$this->db->update('followup', $data, array('patient_id' => $patient_id,'doctor_id' => $doctor_id));
			//echo $this->db->last_query()."<br/>";
		}else{
			//Insert Followup Details
			$this->db->insert('followup', $data);
			//echo $this->db->last_query()."<br/>";
        }
		$data2['followup_date']=  date('Y-m-d', strtotime($this->input->post('followup_date')));
		$data2['sync_status'] = 0;
		$this->db->update('patient', $data2, array('patient_id' => $patient_id));
	}
	public function get_previous_due($patient_id){
		$this->db->order_by("bill_id", "desc");
		$query = $this->db->get_where('bill', array('patient_id' => $patient_id));
		$bills = $query->result_array();
		foreach($bills as $bill){
			$bill_id = $bill->bill_id;
			$pre_due_amount = $bill->due_amount;
			$bill_amount = $bill->amount;
			$paid_amount = $this->bill_payment($bill_id);
			$due_amount = $pre_due_amount + $bill_amount - $paid_amount;
		}
		
	}
	/*public function bill_payment($bill_id){
		$this->db->select('amount');
		$query = $this->db->get_where('payment_transaction', array('bill_id' => $bill_id, 'payment_type' => 'bill_payment'));
		
		if($query->num_rows() > 0){
			$result = $query->row();
			$paid_amount = $result->amount;
		}else{
			$paid_amount = 0;
		}
		return $paid_amount;
	}*/
    public function edit_visit_data($visit_id) {

        /* Get Value Of Notes Field */
		$doctor_id = $this->input->post('visit_doctor');
		$data['doctor_id'] = $doctor_id;
		$data['userid']= $this->get_doctor_user_id($doctor_id);
		$data['visit_date'] = $this->input->post('visit_date');
		$data['visit_date'] = date('Y-m-d', strtotime($data['visit_date']));
		
		$data['visit_time'] = $this->input->post('visit_time');
		$data['visit_time'] = date('H:i:s', strtotime($data['visit_time']));
		
		$data['type'] = $this->input->post('type');
				
        $data['notes'] = $this->input->post('notes');
		$data['patient_notes'] = $this->input->post('patient_notes');
		$data['appointment_reason'] = $this->input->post('appointment_reason');
		
		$data['sync_status'] = 0;

        /* Update Visit Data With Visit Id */
        $this->db->where('visit_id', $visit_id);
        $this->db->update('visit', $data);
        $this->edit_treatment($visit_id);
        $this->edit_disease($visit_id);
    }
	public function edit_disease($visit_id){
		if($this->input->post('disease')){
			$diseases = $this->input->post('disease');
			$this->load->model('disease/disease_model');
			$visit_diseases = $this->disease_model->get_visit_diseases($visit_id);
			foreach($diseases as $disease){
				$data4['visit_id'] = $visit_id;
				$data4['disease_id'] = $disease;
				if(in_array($disease, $visit_diseases)){
					$this->db->where('visit_id', $visit_id);
					$this->db->update('visit_disease_r', $data4);
				}else{
					$this->db->insert('visit_disease_r', $data4);
				}
			}
			foreach($visit_diseases as $visit_disease){
				if(!in_array($visit_disease['disease_id'], $diseases)){
					$this->db->where('visit_id', $visit_id);
					$this->db->where('disease_id', $visit_disease['disease_id']);
					$this->db->delete('visit_disease_r');
				}
			}
		}else{
			$this->db->where('visit_id', $visit_id);
			$this->db->delete('visit_disease_r');
		}
		
	}
    public function edit_treatment($visit_id){
        /* Get bill_id Of visit_id */
        $bill_id = $this->get_bill_id($visit_id);

		$this->db->select_sum('amount');
		$this->db->where('bill_id',$bill_id);
		$this->db->where('type','treatment');
		$query = $this->db->get('bill_detail');
		$amount = $query->row_array();
		$treatment_total  = $amount['amount']*-1;
		
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,total_amount = total_amount + ?,due_amount = due_amount + ? where bill_id = ?;";
		$this->db->query($sql, array($treatment_total,$treatment_total, $bill_id));
        $this->db->delete('bill_detail', array('bill_id' => $bill_id, 'type' => 'treatment'));
		
		if($this->input->post('treatment')){
			$treatments = $this->input->post('treatment');
			$this->load->model('treatment/treatment_model');
			$visit_treatments = $this->treatment_model->get_visit_treatments($visit_id);
			foreach($treatments as $treatment){
				$data4['visit_id'] = $visit_id;
				$data4['treatment_id'] = $treatment;
				if(in_array($treatment, $visit_treatments)){
					$this->db->where('visit_id', $visit_id);
					$this->db->update('visit_treatment_r', $data4);
				}else{
					$this->db->insert('visit_treatment_r', $data4);
				}
			}
			foreach($visit_treatments as $visit_treatment){
				if(!in_array($visit_treatment['treatment_id'], $diseases)){
					$this->db->where('visit_id', $visit_id);
					$this->db->where('treatment_id', $visit_disease['disease_id']);
					$this->db->delete('visit_treatment_r');
				}
			}
		}else{
			$this->db->where('visit_id', $visit_id);
			$this->db->delete('visit_treatment_r');
		}

	    /*$this->db->delete('visit_treatment_r', array('visit_id' => $visit_id));
		
		/* Get All Selected Treatments 
        $treatments = $this->input->post('treatment');

        /* Check If Treatment is Seleceted Then Perform Insert Treatment(s) In bill_detail Table 
        if ($treatments) {
			$treatment_total = 0;
            foreach ($treatments as $treatment) {
                $treatment = explode("/", $treatment);
                $data2['bill_id'] = $bill_id;
                $data2['purchase_id'] = NULL;
                $data2['particular'] = $treatment[1];
                $data2['amount'] = $treatment[2];
                $data2['quantity'] = 1;
                $data2['mrp'] = $treatment[2];
                $data2['type'] = 'treatment';
				$data2['clinic_code'] = $this->session->userdata('clinic_code');
        
				$treatment_total = $treatment_total + $treatment[2];
                $this->db->insert('bill_detail', $data2);
				
				//Insert in Visit Treatment R
				$data3['visit_id'] = $visit_id;
				$data3['treatment_id'] = $treatment[0];
				$this->db->insert('visit_treatment_r', $data3);
            }
			$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0, total_amount = total_amount + ?,due_amount = due_amount + ? where bill_id = ?;";
			$this->db->query($sql, array($treatment_total,$treatment_total, $bill_id));
        }*/
    }
    public function get_visit_by_patient($patient_id){
        $this->db->order_by('visit_id','desc');
        $this->db->limit(1);
		if($this->session->userdata('clinic_code')){
			$clinic_code = $this->session->userdata('clinic_code');
			$this->db->where("clinic_code", $clinic_code);
		}
		$query = $this->db->get_where('visit',array('patient_id' => $patient_id));
        return $query->row_array();
    }
    public function get_visit_treatments(){
        $query = $this->db->get('view_visit_treatments');
        return $query->result_array();
    }
    public function get_patient_id($visit_id) {
        $query = $this->db->get_where('visit', array('visit_id' => $visit_id));
        $row = $query->row();
        if ($row)
            return $row->patient_id;
        else
            return 0;
    }
	public function get_doctor_id($visit_id) {
        $query = $this->db->get_where('visit', array('visit_id' => $visit_id));
        $row = $query->row();
        if ($row)
            return $row->userid;
        else
            return 0;
    }
    /** *Bill** */
	public function get_bill_item_ids($bill_id,$type){
		$query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id,'type' => $type));
		return $query->result_array();
	}
	public function create_bill_for_patient($patient_id, $due_amount = NULL,$doctor_id = NULL) {
		
		$data['clinic_id'] = $this->session->userdata('clinic_id');
        $data['bill_date'] = date('Y-m-d');
		$data['bill_time'] = date('H:i:s');
        $data['patient_id'] = $patient_id;
		$data['doctor_id'] = $doctor_id;
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
        return $this->db->insert_id();
    }
	public function update_bill($bill_id){
		$data['amount'] = $this->input->post('doctor_id');
		$this->db->update('bill', $data,array('bill_id' => $bill_id));
	}
	public function edit_bill_item($bill_detail_id,$mrp,$quantity){
		$bill_detail = $this->get_bill_detail_by_id($bill_detail_id);
		$previous_amount = $bill_detail['amount'];
		$bill_id = $bill_detail['bill_id'];
		
		$data['mrp'] = $mrp;
		$data['quantity'] = $quantity;
		$amount = $mrp*$quantity;
		$data['amount'] = $amount;
		$adjust_amount = $amount - $previous_amount;
		$this->db->update('bill_detail', $data,array('bill_detail_id' => $bill_detail_id));
		echo $this->db->last_query()."<br/>";
		
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,total_amount = total_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($adjust_amount, $bill_id));
		
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,due_amount = due_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($adjust_amount, $bill_id));
	}
	public function update_bill_item($bill_detail_id,$amount){
		$bill_detail = $this->get_bill_detail_by_id($bill_detail_id);
		$previous_amount = $bill_detail['amount'];
		$bill_id = $bill_detail['bill_id'];
		
		$data['amount'] = $amount;
		$this->db->update('bill_detail', $data,array('bill_detail_id' => $bill_detail_id));
		
		$adjust_amount = $amount - $previous_amount;
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,total_amount = total_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($adjust_amount, $bill_id));
		
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0,due_amount = due_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($adjust_amount, $bill_id));
	}
    public function add_bill_item($action, $bill_id, $particular, $qnt = NULL, $amt = NULL, $mrp = NULL, $item_id = NULL, $tax_amount = NULL) {
		
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
		
		if ($item_id != NULL){
			$query = $this->db->get_where('bill_detail', array('bill_id ' => $bill_id, 'item_id ' => $item_id));
			if ($query->num_rows() > 0){
				$bill_detail = $query->row_array();
				$bill_detail_id = $bill_detail['bill_detail_id'];
				//print_r($bill_detail);
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
	function update_discount($bill_id,$discount_amount) {
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
		
		$bill = $this->get_bill_by_id($bill_id);
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
	function get_discount_amount($bill_id){
		$query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id,'type'=>'discount'));
        $row = $query->row();
        if ($row)
            return $row->amount;
        else
            return 0;
	}
	public function get_data_value($key){
		$this->db->select('ck_value');
		$query=$this->db->get_where('data',array('ck_key'=>$key));
		$row=$query->row();
		if (!$row) {
			return "";
		}else{
			return $row->ck_value;	
		}
	}
	function get_bill_detail_export_query($from_date,$to_date,$selected_doctor){
		
		$tax_type = $this->get_data_value('tax_type');
		
		if($tax_type == 'item'){
			$this->db->select('clinic_name,bill_id,bill_date,doctor_name,display_id AS patient_id,CONCAT(IFNULL(first_name,"")," ",IFNULL(middle_name,"")," ",IFNULL(last_name,"")) AS patient_name,(total_amount + (IFNULL(item_tax_amount,"0"))) AS bill_amount,pay_amount as payment_amount, due_amount');
		}else{
			$this->db->select('clinic_name,bill_id,bill_date,doctor_name,display_id AS patient_id,CONCAT(IFNULL(first_name,"")," ",IFNULL(middle_name,"")," ",IFNULL(last_name,"")) AS patient_name,(total_amount + (IFNULL(bill_tax_amount,"0"))) AS bill_amount,pay_amount as payment_amount, due_amount');
		}
		
		if (empty($selected_doctor)) {
			$query = $this->db->get_where('view_bill', array('bill_date <=' => $to_date, 'bill_date >=' => $from_date));
			//echo $this->db->last_query()."<br/>";
			return $query->result_array();
		}else{
			$this->db->where_in('doctor_id',$selected_doctor);
			$this->db->where('bill_date <=',$to_date);
			$this->db->where('bill_date >=',$from_date);
			$query = $this->db->get('view_bill');
			//echo $this->db->last_query()."<br/>";
			return $query->result_array();
		}
	}
    function get_bill_report($from_date,$to_date,$selected_doctor,$clinic_id = NULL,$patient_id = NULL) {
		
        if (!empty($selected_doctor)) {
			$this->db->where_in('doctor_id',$selected_doctor);
		}
		if($patient_id != NULL && $patient_id != 0){
			$this->db->where('patient_id',$patient_id);
		}
		
		if($clinic_id != NULL && $clinic_id != 0){
			$this->db->where('clinic_id',$clinic_id);
		}
		$this->db->where('bill_date <=',$to_date);
		$this->db->where('bill_date >=',$from_date);
		$query = $this->db->get('view_bill');
		
		//echo $this->db->last_query()."<br/>";
		return $query->result_array();
    }
    public function update_available_quantity($quantity_sold, $purchase_id) {
        $sql = "update " . $this->db->dbprefix('purchase') . " set sync_status = 0,remain_quantity = remain_quantity - ? where purchase_id = ?;";
        $this->db->query($sql, array($quantity_sold, $purchase_id));
    }
    public function get_bill($visit_id) {
        $query = $this->db->get_where('bill', array('visit_id' => $visit_id));
		//echo $this->db->last_query()."<br/>";
        return $query->row_array();
    }
	public function get_bill_by_id($bill_id) {
        $query = $this->db->get_where('bill', array('bill_id' => $bill_id));
        return $query->row_array();
    }
	public function get_pending_bills() {
        $query = $this->db->get_where('bill', array('due_amount >' => 0));
        return $query->result_array();
    }
	public function get_patient_bills($patient_id) {
        $query = $this->db->get_where('bill', array('patient_id' => $patient_id));
        return $query->result_array();
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
    public function get_bill_id($visit_id) {
        $query = $this->db->get_where('bill', array('visit_id' => $visit_id));
        $row = $query->row();
        if ($row)
            return $row->bill_id;
    }
    public function get_visit_id($bill_id) {
        $query = $this->db->get_where('bill', array('bill_id' => $bill_id));
        $row = $query->row();
        if ($row)
            return $row->visit_id;
        else
            return 0;
    }
	public function get_patient_id_for_bill($bill_id) {
        $query = $this->db->get_where('bill', array('bill_id' => $bill_id));
        $row = $query->row();
        if ($row)
            return $row->patient_id;
        else
            return 0;
    }
    public function get_bill_detail($visit_id) {
        $bill_id = $this->get_bill_id($visit_id);
        $this->db->order_by("type", "desc");
        $query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id));
        return $query->result_array();
    }
    public function get_bill_detail_amount($bill_detail_id) {
        $query = $this->db->get_where('bill_detail', array('bill_detail_id' => $bill_detail_id));
        $row = $query->row();
        if ($row)
            return $row->amount;
        else
            return 0;
    }
    function update_remaining_quantity($bill_detail_id) {
        $this->db->select('purchase_id,quantity');
        $query = $this->db->get_where('bill_detail', array('bill_detail_id' => $bill_detail_id));
        $row = $query->row();
        if ($row)
            return $row;
        else
            return 0;
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
		echo $this->db->last_query()."<br/>";
		
		//Adjust Payment
		$this->update_payment($bill_id,$due_amount);
		
		//echo $this->db->last_query()."<br/>";

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
    public function get_bill_detail_by_id($bill_detail_id){
		$query = $this->db->get_where('bill_detail', array('bill_detail_id' => $bill_detail_id));
        $row = $query->row_array();
		return $row;
	}
	/** *Payment** */
    public function get_payment($bill_id) {
        $query = $this->db->get_where('payment', array('bill_id' => $bill_id));
        return $query->result_array();
    }
    public function insert_payment() {
        $data['bill_id'] = $this->input->post('bill_id');
        $data['pay_date'] = $this->input->post('pay_date');
        $data['pay_mode'] = $this->input->post('pay_mode');
        $data['amount'] = $this->input->post('amount');
        $data['cheque_no'] = $this->input->post('cheque_no');
        $this->db->insert('payment', $data);

        $sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0, paid_amount = paid_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($this->input->post('amount'), $this->input->post('bill_id')));
    }
    function get_detail($item) {
        $this->db->select('item_id');
        $query = $this->db->get_where('item', array('item_name' => $item));

        if ($query)
            return $query->result_array();
        else
            return 0;
    }
    function get_item_detail($id) {
        $query = $this->db->get_where('purchase', array('item_id' => $id, 'remain_quantity !=' => 0));
        if ($query)
            return $query->result_array();
        else
            return 0;
    }
    function get_price($id) {
        $this->db->select('mrp');
        $query = $this->db->get_where('purchase', array('item_id' => $id));
        if ($query)
            return $query->result_array();
        else
            return 0;
    }
    function dismiss_followup($patient_id) {
        $sql = "update " . $this->db->dbprefix('patient') . " set sync_status = 0 , followup_date = ? where patient_id = ?;";
        $this->db->query($sql, array('0000:00:00', $patient_id));
    }
    function get_medicine_total($visit_id) {
        $this->db->select_sum('amount', 'medicine_total');
        $query = $this->db->get_where('view_bill', array('visit_id' => $visit_id, 'type' => 'medicine'));
        $row = $query->row();
        return $row->medicine_total;
    }
    function get_treatment_total($visit_id) {
        $this->db->select_sum('amount', 'treatment_total');
        $query = $this->db->get_where('view_bill_detail_report', array('visit_id' => $visit_id, 'type' => 'treatment'));
        $row = $query->row();
        return $row->treatment_total;
    }
	function get_item_total($visit_id) {
        $this->db->select_sum('amount', 'item_total');
        $query = $this->db->get_where('view_bill_detail_report', array('visit_id' => $visit_id, 'type' => 'item'));
        $row = $query->row();
		return $row->item_total;
    }
	function get_particular_total($visit_id) {
        $this->db->select_sum('amount', 'particular_total');
        $query = $this->db->get_where('view_bill_detail_report', array('visit_id' => $visit_id,'type'=>'particular'));
        $row = $query->row();
        return $row->particular_total;
    }
	function get_fee_total($visit_id) {
        $this->db->select_sum('amount', 'fees_total');
        $query = $this->db->get_where('view_bill_detail_report', array('visit_id' => $visit_id,'type'=>'fees'));
        $row = $query->row();
        return $row->fees_total;
    }
	function get_total($type,$visit_id) {
		$this->db->select_sum('amount', 'total');
        $query = $this->db->get_where('view_bill_detail_report', array('visit_id' => $visit_id,'type'=>$type));
		//echo $this->db->last_query()."<br/>";
        $row = $query->row();
        return $row->total;
	}
	function get_tax_total($type,$visit_id) {
		
		$this->db->select_sum('tax_amount', 'tax_total');
        $query = $this->db->get_where('view_bill_detail_report', array('visit_id' => $visit_id,'type'=>$type));
		//echo $this->db->last_query()."<br/>";
        $row = $query->row();
        return $row->tax_total;
	}
	public function get_paid_amount($bill_id) {
        $query = $this->db->get_where('payment', array('bill_id' => $bill_id));
        $result = $query->row_array();
		if ($query->num_rows() > 0){
			$row = $query->row_array();
			$payment_amount = $row['amount'];
		}else{
			$payment_amount = 0;
		}
        return $payment_amount;
    }
	public function get_due_amount($bill_id) {
        $query = $this->db->get_where('bill', array('bill_id' => $bill_id));
        $result = $query->row_array();
		if ($query->num_rows() > 0){
			$row = $query->row_array();
			$due_amount = $row['due_amount'];
		}else{
			$due_amount = 0;
		}
        return $due_amount;
    }
    function new_inquiries() {

        /* Select Patientid with only one visit or no visits */
		$sql = "SELECT *
				  FROM (SELECT patient.patient_id,
							   count( visit.patient_id ) AS count,
							   CONCAT( IFNULL(patient.first_name,''), ' ', IFNULL(patient.middle_name,''), ' ', IFNULL(patient.last_name,'' )) AS patient_name,
							   patient.phone_number ,
							   patient.email
						  FROM " . $this->db->dbprefix('view_patient') ." AS patient
							   LEFT JOIN " . $this->db->dbprefix('visit') ." AS visit ON visit.patient_id = patient.patient_id
						 GROUP BY patient_id) AS A
				  WHERE A.count <= 1
				  ORDER BY A.count DESC";
        $result = $this->db->query($sql);
        return $result->result_array();
    }
    public function get_reference_by($patient_id){
        $query = $this->db->get_where('patient', array('patient_id' => $patient_id));
        return $query->row_array();
    }
    public function update_reference_by($patient_id){
		$data['reference_by'] = "";
		$data['sync_status'] = 0;
        if($this->input->post('reference_by')){
			$data['reference_by'] = $this->input->post('reference_by');
			if($this->input->post('reference_by') == "Self"){
				$data['reference_by_detail'] = " ";
			}
			if($this->input->post('reference_by') == "Internet"){
				$data['reference_by_detail'] = " ";
			}
			/*if($this->input->post('reference_details')){
				$data['reference_by'] .= "|".$this->input->post('reference_details');
			}*/
		}
		if($this->input->post('reference_details')){
			$data['reference_by_detail'] = $this->input->post('reference_details');	
		}
        
        $this->db->update('patient', $data, array('patient_id' => $patient_id));
		//echo $this->db->last_query();
    }
	 public function update_patient_data($patient_id){
		 $data['age'] = $this->input->post('age');
        $data['gender'] = $this->input->post('gender');
        $data['ssn_id'] = $this->input->post('ssn_id');
		$data['blood_group'] = $this->input->post('blood_group');
		$data['sync_status'] = 0;
		if($this->session->userdata('clinic_code')){
			$data['clinic_code'] = $this->session->userdata('clinic_code');
       
		}
		if($this->input->post('dob')){
			$data['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
		}
        $this->db->update('patient', $data, array('patient_id' => $patient_id));
//echo $this->db->last_query();
    }
	public function update_display_id(){
		$patient_id = $this->input->post('patient_id');
        $data['display_id'] = $this->input->post('display_id');
		$data['sync_status'] = 0;
        $this->db->update('patient', $data, array('patient_id' => $patient_id));
		//echo $this->db->last_query();
    }
	function get_balance_amount($bill_id) {
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
	function get_patient_id_from_bill_id($bill_id){
		$query = $this->db->get_where('bill', array('bill_id' => $bill_id));
        
		if ($query->num_rows() > 0){
			$bill = $query->row_array();
			$patient_id = $bill['patient_id'];
		}else{
			$patient_id = 0;
		}
		return $patient_id;
	}
	function get_template($type=NULL){
		if($type == NULL){
			$type = 'bill';
		}
		$query = $this->db->get_where('receipt_template', array('is_default' => 1,'type'=>$type));
        $row = $query->row_array();
		return $row;
	}
	function get_template_by_name($template_name){
		
		$query = $this->db->get_where('receipt_template', array('template_name'=>$template_name));
        $row = $query->row_array();
		return $row;
	}
	function delete_bill_discount($bill_id){
		$query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id,'type'=>'discount'));
        $row = $query->row_array();
		$discount = $row['amount'];
		
		$this->db->delete('bill_detail', array('bill_id' => $bill_id,'type' => 'discount'));
		
		$sql = "update " . $this->db->dbprefix('bill') . " set sync_status = 0, total_amount = total_amount + ?, due_amount = due_amount + ? where bill_id = ?;";
        $this->db->query($sql, array($discount,$discount, $bill_id));
		//echo $this->db->last_query()."<br/>";
	}
	function get_patient_report(){
		
		if($this->session->userdata('clinic_code')){
			$clinic_code = $this->session->userdata('clinic_code');
			$this->db->where("clinic_code", $clinic_code);
        
		}
		if($this->input->post('reference')){
			$reference = $this->input->post('reference');
			$reference_by = array();
			foreach($reference as $reference_id){
				$query = $this->db->get_where('reference_by', array('reference_id' => $reference_id));
				$row = $query->row_array();
				$reference_by[] = $row['reference_option'];
			}
			$this->db->where_in("reference_by", $reference_by);
		}
		
		$query = $this->db->get('view_patient');
		return $query->result_array();
	}
}
?>