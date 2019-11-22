<?php
class Settings_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
	
	public function get_language_name_array($language){
		$result=$this->db->get_where('language_data',array('l_name'=>$language));
		$languages = $result->result_array();
		//echo $this->db->last_query();
		return $languages;
	}
	
	public function edit_language_data()
	{
		$language = $this->input->post('language');
		$index = $this->input->post('index');
		$l_name = $this->input->post('l_name');
		
		$this->db->set('l_value', $language);
		$this->db->where("l_index", $index);
		$this->db->where('l_name',$l_name);
		$this->db->update('language_data');
		//echo $this->db->last_query();
		//change mail_lang.php file
		
		//redirect("settings/edit_language/");
		//redirect("settings/save_language/");
	}
	//Clinic
    public function get_clinic_settings($clinic_id=1) {
		$query=$this->db->get_where('clinic',array('clinic_id'=>$clinic_id));
        return $query->row_array();
    }
	public function get_all_clinics(){
		$result = $this->db->get('clinic');
        return $result->result_array();
	}
	public function get_clinic($clinic_id = 1){
		$query = $this->db->get_where('clinic',array('clinic_id' => $clinic_id));
        $row =  $query->row_array();
		return $row;
	}
	public function get_clinic_name($clinic_id = 1){
		$this->db->where('clinic_id' , $clinic_id);
		$query = $this->db->get('clinic');
        $row =  $query->row_array();
		return $row['clinic_name'];
	}
	public function get_clinic_name_array(){
		$clinics = $this->get_all_clinics();
		$clinic_array = array();
		foreach($clinics as $clinic){
			$clinic_array[$clinic['clinic_id']] = $clinic['clinic_name'];
		}
		return $clinic_array;
	}
    public function save_clinic_settings() {
		
        $data['clinic_name'] = $this->input->post('clinic_name');
		$data['clinic_code'] = $this->input->post('clinic_code');
        $data['tag_line'] = $this->input->post('tag_line');
        $data['clinic_address'] = $this->input->post('clinic_address');
        $data['landline'] = $this->input->post('landline');
        $data['mobile'] = $this->input->post('mobile');
        $data['email'] = $this->input->post('email');
		$data['website'] = $this->input->post('website');
		if($this->input->post('full_day') == 1){
			$data['start_time'] = "00:00";
			$data['end_time'] = "24:00";
		}else{
			$data['start_time'] = date('H:i:s',strtotime($this->input->post('start_time')));
			$data['end_time'] = date('H:i:s',strtotime($this->input->post('end_time')));
		}
		
        $data['time_interval'] = $this->input->post('time_interval');
        $data['next_followup_days'] = $this->input->post('next_followup_days');        
		$data['facebook'] = $this->input->post('facebook');
		$data['twitter'] = $this->input->post('twitter');
		$data['google_plus'] = $this->input->post('google_plus');
		$data['max_patient'] = $this->input->post('max_patient');
        $data['sync_status'] = 0;
		if($this->input->post('clinic_id')){
			$this->db->update('clinic', $data, array('clinic_id' => $this->input->post('clinic_id')));
			//echo $this->db->last_query();
			return $this->input->post('clinic_id');
		}else{
			$this->db->insert('clinic', $data);
			$clinic_id = $this->db->insert_id();
			//echo $this->db->last_query();
			//Add Working days
			
			$working_days_array = array('7','1','2','3','4','5','6');
			$working_days_string = implode(",", $working_days_array);
			$this->set_data_value('working_days_'.$clinic_id, $working_days_string);
				
			return $clinic_id;
		}
    }
	public function number_of_clinic(){
		$query = $this->db->get('clinic');
		$num_of_clinic = $query->num_rows();
		return $num_of_clinic;
	}
	public function delete_clinic($clinic_id){
		$this->db->delete('clinic', array('clinic_id' => $clinic_id));
	}
	public function update_clinic_logo($file_name) {
		if($file_name != NULL && $file_name != "" ){
			$data['clinic_logo'] = 'uploads/images/'. $file_name;
		}else{
			$data['clinic_logo'] = '';
		}
		$data['sync_status'] = 0;
		$this->db->update('clinic', $data,array('clinic_id' => 1));
	}
	public function remove_clinic_logo() {
		$data['clinic_logo'] = '';
		$data['sync_status'] = 0;
		$this->db->update('clinic', $data,array('clinic_id' => 1));
	}
    public function get_clinic_start_time($clinic_id = 1) {
		$this->db->where("clinic_id", $clinic_id);
        $query = $this->db->get('clinic');
        $row = $query->row_array();
        if (!$row) {
            return '09:00';
        }
        return $row['start_time'];
    }
    public function get_clinic_end_time($clinic_id = 1) {
		$this->db->where("clinic_id", $clinic_id);
        $query = $this->db->get('clinic');
        $row = $query->row_array();
        if (!$row) {
            return '18:00';
        }
        return $row['end_time'];
    }
    public function get_time_interval() {
        $query = $this->db->get('clinic');
        $row = $query->row_array();
        if (!$row) {
            return '0.50';
        }
        return $row['time_interval'];
    }
	
	//Invoice
    public function get_invoice_settings() {
        $query = $this->db->get('invoice');
        return $query->row_array();
    }
    public function get_currency_postfix(){
        $this->db->select('currency_postfix');
        $query = $this->db->get('invoice');
        return $query->row()->currency_postfix;        
    }
    public function get_currency_symbol(){
        $this->db->select('currency_symbol');
        $query = $this->db->get('invoice');
        return $query->row()->currency_symbol;        
    }
    public function save_invoice_settings() {
        $data['static_prefix'] = $this->input->post('static_prefix');
        $data['left_pad'] = $this->input->post('left_pad');
        $data['currency_symbol'] = $this->input->post('currency_symbol');
        $data['currency_postfix'] = $this->input->post('currency_postfix');
		$data['sync_status'] = 0;
        $this->db->update('invoice', $data, array('invoice_id' => 1));
    }
    public function get_invoice_next_id() {
        $query = $this->db->get('invoice');
        $row = $query->row_array();
        return $row['next_id'];
    }
    public function increment_next_id() {
        $next_id = $this->get_invoice_next_id();
        $next_id++;
        $data['next_id'] = $next_id;
		$data['sync_status'] = 0;
        $this->db->update('invoice', $data, array('invoice_id' => 1));
    }
	public function get_treatments(){
        $result = $this->db->get('treatments');
        return $result->result_array();
    }
    public function add_treatment() {
        $data['treatment'] = $this->input->post('treatment');
        $data['price'] = $this->input->post('treatment_price');
        $this->db->insert('treatments',$data);
    }
    public function get_edit_treatment($id) {    
        $this->db->where("id", $id);
        $query = $this->db->get("treatments");
        return $query->row_array();    
    }
    public function edit_treatment($id){
        $data['treatment'] = $this->input->post('treatment');
        $data['price'] = $this->input->post('treatment_price');
		$data['sync_status'] = 0;
        $this->db->where('id', $id);
        $this->db->update('treatments', $data);
    }
    public function delete_treatment($id) {
        $this->db->delete('treatments', array('id' => $id));
    }
    public function get_visit_treatment($visit_id){
        $bill_id = $this->patient_model->get_bill_id($visit_id);
        
        $query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id));
       // echo $this->db->last_query();
		return $query->result_array();
    }
	public function get_time_zone(){
	   $this->db->select('ck_value');
	   $query=$this->db->get_where('data',array('ck_key'=>'default_timezone'));
	   $row=$query->row();
	   return $row->ck_value;
	}
	public function save_timezone($key, $value) {
		$this->db->where('ck_key', $key);
		$db_array['ck_value'] = $value;
		$db_array['sync_status'] = 0;
		$this->db->update('data', $db_array);	
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
	public function set_data_value($key, $value) {
		$db_array['ck_key'] = $key;
		$db_array['ck_value'] = $value;
		
		
		$query=$this->db->get_where('data',array('ck_key'=>$key));
		//echo $this->db->last_query();
		$row=$query->row();
		//print_r($row);
		if (!$row) {
			$this->db->insert('data',$db_array);
			//echo $this->db->last_query();
		}else{
			$db_array['sync_status'] = 0;
			$this->db->update('data',$db_array,array('ck_key'=>$key));	
			//echo $this->db->last_query();
		}
	}
	public function get_time_formate(){
	   $this->db->select('ck_value');
	   $query=$this->db->get_where('data',array('ck_key'=>'default_timeformate'));
	   $row=$query->row();
	   return $row->ck_value;
	}
	public function save_timeformate($key, $value) {
		$this->db->where('ck_key', $key);
		$db_array = array('ck_value' => $value,'sync_status' => 0);
		$this->db->update('data', $db_array);	
	}
	public function get_date_formate(){
	   $this->db->select('ck_value');
	   $query=$this->db->get_where('data',array('ck_key'=>'default_dateformate'));
	   $row=$query->row();
	   return $row->ck_value;
	}
	public function get_morris_date_format(){
		$date_format = $this->get_date_formate();
		if($date_format == "d-m-Y"){
			return 'D-mm-YYYY';
		}elseif($date_format == "Y-m-d"){
			return 'YYYY-mm-D';
		}elseif($date_format == "m-d-Y"){
			return 'mm-D-YYYY';
		}elseif($date_format == "d m y"){
			return 'D mm YY';
		}elseif($date_format == "d M Y"){
			return 'D MMM YYYY';
		}
	}
	public function get_morris_time_format(){
		$time_format = $this->get_time_formate();
		if($time_format == "h:i A"){
			return 'h:mm a';
		}elseif($time_format == "H:i"){
			return 'H:mm';
		}elseif($time_format == "H:i:s"){
			return 'H:mm:ss';
		}
	}
	public function save_dateformate($key, $value) {
		$this->db->where('ck_key', $key);
		$db_array = array('ck_value' => $value,'sync_status' => 0);
		$this->db->update('data', $db_array);	
	}
	public function save_working_days(){
		if($this->input->post('working_days')){
			$working_days_array = $this->input->post('working_days');
			$working_days_string = implode(",", $working_days_array);
			$this->set_data_value('working_days', $working_days_string);
		}
		
		
		$clinics = $this->get_all_clinics();
		foreach($clinics as $clinic){
			if($this->input->post('working_days_'.$clinic['clinic_id'])){
				$working_days_array = $this->input->post('working_days_'.$clinic['clinic_id']);
				$working_days_string = implode(",", $working_days_array);
				$this->set_data_value('working_days_'.$clinic['clinic_id'], $working_days_string);
			}
		}
	}
	public function get_working_days(){
		$working_days_string = $this->get_data_value('working_days');
		$working_days_array = explode(",", $working_days_string);
		return $working_days_array;
	}
	function get_working_days_for_clinic($clinic_id){
		$working_days_string = $this->get_data_value('working_days_'.$clinic_id);
		$working_days_array = explode(",", $working_days_string);
		return $working_days_array;
	}
	function get_all_working_days(){
		$all_working_days = array();
		$clinics = $this->get_all_clinics();
		foreach($clinics as $clinic){
			$working_days_string = $this->get_data_value('working_days_'.$clinic['clinic_id']);
			$working_days_array = explode(",", $working_days_string);
			$all_working_days[$clinic['clinic_id']] = $working_days_array;
		}
		return $all_working_days;
	}
	public function save_exceptional_days(){
		//prepare data
		$data['working_date'] = date('Y-m-d',strtotime($this->input->post('working_date')));
		$data['working_status'] = $this->input->post('working_status');
		$data['working_reason'] = $this->input->post('working_reason');
		$data['end_date'] =  date('Y-m-d',strtotime($this->input->post('end_date')));
		$data['start_time'] = date('H:i:s',strtotime($this->input->post('start_time')));
		$data['end_time'] = date('H:i:s',strtotime($this->input->post('end_time')));
		
		//check if any data exists for this date. 
		$query=$this->db->get_where('working_days',array('working_date' => $data['working_date']));
		$row=$query->row();
		if (!$row) {
			//if data doesnot exist then insert it
			$this->db->insert('working_days',$data);
			//echo $this->db->last_query();
		}else{
			//If data exists then update it
			$data['sync_status'] = 0;
			$this->db->update('working_days',$data,array('working_date'=>$data['working_date']));	
		}
		//echo $this->db->last_query();
	}
	public function get_exceptional_days(){
		//$this->db->order_by("uid", "desc");
		$query = $this->db->get('working_days'); 
		//echo $this->db->last_query();
        return $query->result_array();
	}
	public function get_exceptional_day_by_date($date){
		$query = $this->db->get_where('working_days',array('working_date' => $date));
		//echo $this->db->last_query();
        return $query->row_array();
	}
	public function get_exceptional_day($uid){
		$query = $this->db->get_where('working_days',array('uid' => $uid));
        return $query->row_array();
	}
	public function delete_exceptional_days($uid){
		$this->db->delete('working_days', array('uid' => $uid));
	}	
	function update_exceptional_days(){
		//prepare data
		$data['working_date'] = date('Y-m-d',strtotime($this->input->post('working_date')));
		$data['end_date'] = date('Y-m-d',strtotime($this->input->post('end_date')));
		$data['working_status'] = $this->input->post('working_status');
		$data['working_reason'] = $this->input->post('working_reason');
		$data['start_time'] = date('H:i:s',strtotime($this->input->post('start_time')));
		$data['end_time'] = date('H:i:s',strtotime($this->input->post('end_time')));
		$data['sync_status'] = 0;
		$uid = $this->input->post('uid');
		$this->db->update('working_days',$data,array('uid' => $uid));	
		//echo $this->db->last_query();
	}
	function get_reference_by(){
		$query = $this->db->get('reference_by');
		//echo $this->db->last_query();
        return $query->result_array();
	}
	function get_reference($reference_id){
		$query = $this->db->get_where('reference_by',array('reference_id' => $reference_id));
        return $query->row_array();
	}
	function add_reference(){
		$data['reference_option'] = $this->input->post('reference_option');
		$data['reference_add_option'] = $this->input->post('reference_add_option');
		$data['placeholder'] = $this->input->post('placeholder');
		$this->db->insert('reference_by',$data);
		//echo $this->db->last_query();
	}
	function edit_reference($reference_id){
		$data['reference_option'] = $this->input->post('reference_option');
		$data['reference_add_option'] = $this->input->post('reference_add_option');
		$data['placeholder'] = $this->input->post('placeholder');
		$data['sync_status'] = 0;
		$this->db->update('reference_by',$data,array('reference_id' => $reference_id));	
	}
	function delete_reference($reference_id){
		$this->db->delete('reference_by', array('reference_id' => $reference_id));
	}
	function save_synchronize(){
		if($this->input->post('enable_sync') == 1){
			$this->set_data_value('enable_sync', 1);
			if($this->input->post('sync_status')){
				$this->set_data_value('sync_status',$this->input->post('sync_status'));
			}
			$this->set_data_value('online_url',$this->input->post('online_url'));
			$this->set_data_value('online_account_name',$this->input->post('online_account_name'));
		}else{
			$this->set_data_value('enable_sync', 0);
		}
	}
	function get_all_tables(){
		$dbprefix = $this->db->dbprefix;
		$tables = $this->db->list_tables();
		$tables_array = array();
		foreach($tables as $table){
			if(strpos($table,$dbprefix) !== false && strpos($table,$dbprefix.'view_') === false){
				$tables_array[] = $table;
			}
		}
		return $tables_array;
	}
	function get_columns($table){
		$fields = $this->db->field_data($table);
		$field_array = array();
		foreach($fields as $field){
			$field_array[] = $field->name;
		}
		
		return $field_array;
	}
	function get_primary_key($table){
		$fields = $this->db->field_data($table);
		foreach($fields as $field){
			if($field->primary_key){
				return $field->name;
			}
		}
	}
	function get_all_rows($table){
		$primary_key = $this->get_primary_key($table);
		
		$query = $this->db->query("SELECT * FROM $table WHERE IFNULL(sync_status,0) != 1 ORDER BY $primary_key  ASC;");
		//echo $this->db->last_query();
		return $query->result_array();
	}
	public function get_tax_rates(){
		$result = $this->db->get('tax_rates');
        return $result->result_array();
	}
	public function insert_tax_rate(){
		$data['tax_rate_name'] = $this->input->post('tax_rate_name');
		$data['tax_rate'] = $this->input->post('tax_rate');
		$this->db->insert('tax_rates',$data);
		//echo $this->db->last_query();
	}
	public function edit_tax_rate($tax_id){
		$data['tax_rate_name'] = $this->input->post('tax_rate_name');
		$data['tax_rate'] = $this->input->post('tax_rate');
		$this->db->update('tax_rates',$data,array('tax_id' => $tax_id));	
		
		//echo $this->db->last_query();
	}
	public function get_tax_rate($tax_id){
		$query = $this->db->get_where('tax_rates',array('tax_id' => $tax_id));
        return $query->row_array();
	}
	public function get_tax_rate_name(){
		$tax_rates = $this->get_tax_rates();
		$tax_rate_array = array();
		foreach($tax_rates as $tax_rate){
			$tax_rate_array[$tax_rate['tax_id']] = $tax_rate['tax_rate_name'];
		}
		return $tax_rate_array;
	}
	public function get_tax_rate_array(){
		$tax_rates = $this->get_tax_rates();
		$tax_rate_array = array();
		foreach($tax_rates as $tax_rate){
			$tax_rate_array[$tax_rate['tax_id']] = $tax_rate['tax_rate'];
		}
		return $tax_rate_array;
	}

	public function delete_tax_rate($tax_id){
		$this->db->delete('tax_rates', array('tax_id' => $tax_id));
	}
	public function get_payment_methods(){
		$result = $this->db->get('payment_methods');
        return $result->result_array();
	}
	public function get_payment_method($payment_method_id){
		$query = $this->db->get_where('payment_methods',array('payment_method_id' => $payment_method_id));
        return $query->row_array();	
	}
	
	public function insert_payment_method(){
		$data['payment_method_name'] = $this->input->post('payment_method_name');
		if($this->input->post('has_additional_details')){
			$data['has_additional_details'] = 1;
		}
		if($this->input->post('needs_cash_calc')){
			$data['needs_cash_calc'] = 1;
		}
		if($this->input->post('payment_pending')){
			$data['payment_pending'] = 1;
		}
		$data['additional_detail_label'] = $this->input->post('additional_detail_label');
		
		$this->db->insert('payment_methods',$data);
	}
	public function edit_payment_method($payment_method_id){
		$data['payment_method_name'] = $this->input->post('payment_method_name');
		if($this->input->post('has_additional_details')){
			$data['has_additional_details'] = 1;
		}else{
			$data['has_additional_details'] = 0;
		}
		if($this->input->post('needs_cash_calc')){
			$data['needs_cash_calc'] = 1;
		}else{
			$data['needs_cash_calc'] = 0;
		}
		if($this->input->post('payment_pending')){
			$data['payment_pending'] = 1;
		}else{
			$data['payment_pending'] = 0;
		}
		$data['additional_detail_label'] = $this->input->post('additional_detail_label');
		$this->db->update('payment_methods',$data,array('payment_method_id' => $payment_method_id));	
	}
	public function delete_payment_method($payment_method_id){
		$this->db->delete('payment_methods', array('payment_method_id' => $payment_method_id));
	}
	
}
?>