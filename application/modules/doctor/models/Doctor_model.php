<?php
class Doctor_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
	public function find_doctor_by_name($first_name,$middle_name,$last_name){
		if($first_name != NULL){
			$this->db->where('first_name' , $first_name);
		}
		if($middle_name != NULL){
			$this->db->where('middle_name' , $middle_name);
		}
		if($last_name != NULL){
			$this->db->where('last_name' , $last_name);
		}
		$query = $this->db->get('view_doctor');
		//echo $this->db->last_query()."<br/>";
        $row = $query->row_array();
		if ($row){
			return $row['doctor_id'];	
		}else{
			return 0;
		}
	}
	public function get_doctor_name() {
        $query = $this->db->get('view_doctor');
        $doctor_array = $query->result_array();
		$doctor = array();
		
		foreach($doctor_array as $doctor_detail){
			$doctor[$doctor_detail['doctor_id']] = $doctor_detail['name'];
		}
		return $doctor;
    }
	public function get_doctor_for_online_appointment(){
		$query = $this->db->query('SELECT doctor.* , doctor_preferences.enable_online_appointment FROM '.$this->db->dbprefix('doctor').' AS doctor LEFT OUTER JOIN '.$this->db->dbprefix('doctor_preferences').' AS doctor_preferences ON doctor.doctor_id = doctor_preferences.doctor_id WHERE IFNULL(doctor_preferences.enable_online_appointment,1) = 1 AND IFNULL(doctor.is_deleted,0) != 1 AND  IFNULL(doctor_preferences.is_deleted,0) != 1');
		//echo $this->db->last_query()."<br/>";
		return $query->result_array();
	}
	public function find_doctor($user_id = NULL) {
		
		$this->db->select('*');
		$this->db->from('doctor');
		$this->db->join('contacts', 'doctor.contact_id = contacts.contact_id');
		if(isset($user_id)){
			$this->db->where('userid',$user_id);
		}	
		$this->db->where("IFNULL(".$this->db->dbprefix('doctor').".is_deleted,0) !=", 1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if(isset($user_id)){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
    }
	public function get_nurse(){
		$this->db->where("IFNULL(is_deleted,0) !=", 1);
		$query = $this->db->get('view_nurse');
		return $query->result_array();
	}
	public function get_doctor_user_id($user_id) {	
		$query = $this->db->get_where('doctor', array('userid' => $user_id,"IFNULL(is_deleted,0) !=" => 1));
		return $query->row_array();
	}
	public function get_nurse_user_id($user_id) {	
		$query = $this->db->get_where('nurse', array('userid' => $user_id,"IFNULL(is_deleted,0) !=" => 1));
		//echo $this->db->last_query();
		return $query->row_array();
	}
	public function get_doctor_doctor_id($doctor_id) {	
		$this->db->where('doctor_id',$doctor_id);
		$query = $this->db->get('view_doctor');
		//echo $this->db->last_query();
		return $query->row_array();			
	}
	public function insert_doctors($contact_id) {
		$this->load->helper('string');
				  
		$query = $this->db->get_where('contacts', array('contact_id' => $contact_id));
		$contact = $query->row_array();
		$name = $contact['title'] . ' ' .$contact['first_name'] . ' ' . $contact['middle_name'] . ' ' . $contact['last_name'];
		$username = slugify($contact['first_name'].$contact['last_name']);
		$data = array(
            'name' => $name,
            'username' => $username,
            'level' => 'Doctor',
            'password' => base64_encode($username),
			'contact_id' => $contact_id,
			'centers' => $this->session->userdata('clinic_id')
        );
        $this->db->insert('users', $data);
		//echo $this->db->last_query();
		$userid = $this->db->insert_id();
		
		$data = array();		
		$data['contact_id'] = $contact_id; 
        $data['degree'] = $this->input->post('degree');
		$data['specification'] = $this->input->post('specification');
		if($this->input->post('joining_date')){
			$data['joining_date'] = date('Y-m-d',strtotime($this->input->post('joining_date')));
		}
		if($this->input->post('dob')){
			$data['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
		}
		
		$data['licence_number'] = $this->input->post('licence_number');
		if($this->input->post('department_id[]')){
			$data['department_id'] = implode(",",$this->input->post('department_id[]'));
		}else{
			$data['department_id'] = "";
		}
		$data['gender'] = $this->input->post('gender');
		$data['userid'] = $userid;
        $this->db->insert('doctor', $data);
		//echo $this->db->last_query();
		return $this->db->insert_id();
    }
	public function insert_nurse($contact_id) {
		$this->load->helper('string');
				  
		$query = $this->db->get_where('contacts', array('contact_id' => $contact_id));
		$contact = $query->row_array();
		$name = $contact['title'] . ' ' .$contact['first_name'] . ' ' . $contact['middle_name'] . ' ' . $contact['last_name'];
		$username = slugify($contact['first_name'].$contact['last_name']);
		$data = array(
            'name' => $name,
            'username' => $username,
            'level' => 'Nurse',
            'password' => base64_encode($username),
			'contact_id' => $contact_id,
			'centers' => $this->session->userdata('clinic_id')
        );
        $this->db->insert('users', $data);
		//echo $this->db->last_query();
		$userid = $this->db->insert_id();
		
		$data = array();		
		$data['contact_id'] = $contact_id; 
		if($this->input->post('joining_date')){
			$data['joining_date'] = date('Y-m-d',strtotime($this->input->post('joining_date')));
		}else{
			$data['joining_date'] = "";
		}
		if($this->input->post('dob')){
			$data['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
		}
		if($this->input->post('department_id[]')){
			$data['department_id'] = implode(",",$this->input->post('department_id[]'));
		}else{
			$data['department_id'] = "";
		}
		$data['userid'] = $userid;
        $this->db->insert('nurse', $data);
		//echo $this->db->last_query();
		return $this->db->insert_id();
    }
	public function insert_doctors_full($name,$username,$contact_id){
		$data = array(
            'name' => $name,
            'username' => $username,
            'level' => 'Doctor',
            'password' => base64_encode($username),
			'contact_id' => $contact_id
        );
        $this->db->insert('users', $data);
		//echo $this->db->last_query();
		$userid = $this->db->insert_id();
		
		$data = array();		
		$data['contact_id'] = $contact_id; 
		$data['userid'] = $userid;
        $this->db->insert('doctor', $data);
		//echo $this->db->last_query();
		
		$doctor_id = $this->db->insert_id();
		
		return $doctor_id;
	}
	public function update_doctors() {
    
		$doctor_id = $this->input->post('doctor_id');
        $data['degree'] = $this->input->post('degree');
		$data['specification'] = $this->input->post('specification');		
		$data['experience'] = $this->input->post('experience');		
		if($this->input->post('joining_date')){
			$data['joining_date'] = date('Y-m-d',strtotime($this->input->post('joining_date')));
		}
		if($this->input->post('dob')){
			$data['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
		}
		$data['licence_number'] = $this->input->post('licence_number');
		if($this->input->post('department_id[]')){
			$data['department_id'] = implode(",",$this->input->post('department_id[]'));
		}else{
			$data['department_id'] = "";
		}
		$data['gender'] = $this->input->post('gender');		
		$data['description'] = $this->input->post('description');				
		$data['sync_status'] = 0;
		$this->db->update('doctor', $data, array('doctor_id' =>  $doctor_id));
		//echo $this->db->last_query();
	}
	public function update_nurse() {
    
		$nurse_id = $this->input->post('nurse_id');
		if($this->input->post('joining_date')){
			$data['joining_date'] = date('Y-m-d',strtotime($this->input->post('joining_date')));
		}else{
			$data['joining_date'] = NULL;
		}
		if($this->input->post('dob')){
			$data['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
		}
		if($this->input->post('department_id[]')){
			$data['department_id'] = implode(",",$this->input->post('department_id[]'));
		}else{
			$data['department_id'] = "";
		}
		$data['gender'] = $this->input->post('gender');		
		$data['sync_status'] = 0;
		$this->db->update('nurse', $data, array('nurse_id' =>  $nurse_id));
		//echo $this->db->last_query();
	}
	public function get_doctor_details($doctor_id){
		$query = $this->db->get_where('view_doctor', array('doctor_id' => $doctor_id));
        //echo $this->db->last_query();
		return $query->row_array();
	}
	public function get_nurse_details($nurse_id){
		$query = $this->db->get_where('view_nurse', array('nurse_id' => $nurse_id));
        //echo $this->db->last_query();
		return $query->row_array();
	}
	public function get_contact_id($doctor_id) {
        $query = $this->db->get_where('doctor', array('doctor_id' => $doctor_id));
        $row = $query->row();
		//print_r($row);
        if ($row)
            return $row->contact_id;
        else
            return 0;
    }
	public function get_doctors(){
		$level = $this->session->userdata('category');
		if($level == "Nurse"){
			$level = $this->session->userdata('category');
			$user_id = $this->session->userdata('id');
			
			$nurse = $this->get_nurse_user_id($user_id);
			$departments = $nurse['department_id'];
			if($departments != NULL && $departments != ""){
				$this->db->where("department_id IN ($departments)");
			}
		}
		$clinic_id = 1;
		if($this->session->userdata('clinic_id')){
			$clinic_id = $this->session->userdata('clinic_id');
			$this->db->where("centers LIKE '%$clinic_id%'");
		}
		$this->db->like('centers',$clinic_id);
		$query = $this->db->get('view_doctor');
		//echo $this->db->last_query();
        return $query->result_array();
	}
	public function delete_doctor($doctor_id) {
		$doctor = $this->get_doctor_details($doctor_id);
		$contact_id = $doctor['contact_id'];
		$user_id = $doctor['userid'];
		//$this->db->delete('doctor', array('doctor_id' => $doctor_id));
		$data['is_deleted'] = 1;
		$data['sync_status'] = 0;	
		$this->db->update('doctor', $data, array('doctor_id' =>  $doctor_id));
		$this->db->delete('contacts', array('contact_id' => $contact_id));
		$this->db->delete('users', array('userid' => $user_id));
		//$this->db->delete('doctor_preferences', array('doctor_id' => $doctor_id));
		$data['is_deleted'] = 1;
		$data['sync_status'] = 0;	
		$this->db->update('doctor_preferences', $data, array('doctor_id' =>  $doctor_id));
		//$this->db->delete('doctor_schedule', array('doctor_id' => $doctor_id));
		$data['is_deleted'] = 1;
		$data['sync_status'] = 0;	
		$this->db->update('doctor_schedule', $data, array('doctor_id' =>  $doctor_id));
	}
	public function delete_nurse($nurse_id) {
		$nurse = $this->get_nurse_details($nurse_id);
		$contact_id = $nurse['contact_id'];
		$user_id = $nurse['userid'];
		//$this->db->delete('doctor', array('nurse_id' => $nurse_id));
		$data['is_deleted'] = 1;
		$data['sync_status'] = 0;	
		$this->db->update('nurse', $data, array('nurse_id' =>  $nurse_id));
		$this->db->delete('contacts', array('contact_id' => $contact_id));
		$this->db->delete('users', array('userid' => $user_id));
	}
	public function copy_from_users(){
		//Loop through all doctor
		$query = $this->db->get_where('users', array('level' => 'Doctor'));
		$doctors =  $query->result_array();
		foreach($doctors as $doctor){
			//print_r ($doctor);
			$query = $this->db->get_where('doctor', array('userid' => $doctor['userid']));
			if ($query->num_rows() > 0){
				//Doctor already created
			}else{
				$display_name = $doctor['name'];
				
				$display_name = str_replace("Dr. ","",$display_name);
				$display_name = str_replace("Dr.","",$display_name);
				$display_name = str_replace("Dr ","",$display_name);
				
				
				$name = explode(" ", $display_name);
				if(count($name) >= 3){
					$first_name = $name[0];
					$middle_name = $name[1];
					$last_name = $name[2];
				}elseif (count($name) == 2){
					$first_name = $name[0];
					$middle_name = '';
					$last_name = $name[1];
				}elseif (count($name) == 1){
					$first_name = $name[0];
					$middle_name = '';
					$last_name = '';
				}
				//Insert into Contact
				$data_contacts['first_name'] = $first_name;
				$data_contacts['middle_name'] = $middle_name;
				$data_contacts['last_name'] = $last_name;
				$data_contacts['display_name'] = $display_name;
				$this->db->insert('contacts', $data_contacts);
				$contact_id = $this->db->insert_id();
				
				//Insert in Doctor's Table
				$data['contact_id'] = $contact_id;
				$data['userid'] = $doctor['userid'];
				$this->db->insert('doctor', $data);
			}
		}
	}
	/*department ---------------------------------------------------------------------------------------*/
	public function get_all_departments() {	
		$this->db->where("IFNULL(is_deleted,0) !=", 1);
		$query = $this->db->get("department");
		//echo $this->db->last_query();
		return $query->result_array();
	}
	public function get_department($department_id) {
		$query = $this->db->get_where('department', array('department_id' => $department_id,"IFNULL(is_deleted,0) !=" => 1));
		return $query->row_array();
	}
	public function update_department() {
		$department_id = $this->input->post('department_id');
		$data['department_id'] = $this->input->post('department_id');
		$data['department_name'] = $this->input->post('department_name');
		$data['sync_status'] = 0;
		if($this->input->post('clinic_code')){
			$data['clinic_code'] = $this->input->post('clinic_id');	
		}
		$this->db->update('department', $data, array('department_id' =>  $department_id));		
	}
	public function add_department() {       
		$data['department_name'] = $this->input->post('department_name');	
		if($this->input->post('clinic_code')){
			$data['clinic_code'] = $this->input->post('clinic_code');	
		}
		$this->db->insert('department', $data);	
		return $this->db->insert_id();
		//echo $this->db->last_query();
		
	}
	public function delete_department($id) {
		//$this->db->delete('department', array('department_id' => $id));
		$data['is_deleted'] = 1;
		$data['sync_status'] = 0;	
		$this->db->update('department', $data, array('department_id' =>  $id));
	}
	// fees master 
	public function find_fees() {	
		 $query = $this->db->get("view_fee_master");
		return $query->result_array();
	}
	public function get_fees($id) {
		$query = $this->db->get_where('fee_master', array('id' => $id,"IFNULL(is_deleted,0) !=" => 1));
		return $query->row_array();
	}
	public function get_doctor_fees($doctor_id = NULL) {
		if($doctor_id != NULL){
			$this->db->where('doctor_id' ,$doctor_id);
		}
		$this->db->where('IFNULL(is_deleted,0) !=' ,1);
		$this->db->order_by('doctor_id');
		$query = $this->db->get('fee_master');
		return $query->result_array();
	}
	public function update_fees() {
		$id = $this->input->post('id');
		$data['id'] = $this->input->post('id');
		$data['doctor_id'] = $this->input->post('doctor');
		$data['detail'] = $this->input->post('detail');
		$data['fees'] = $this->input->post('fees');
		$data['sync_status'] = 0;
		$this->db->update('fee_master', $data, array('id' =>  $id));
	}
	public function add_fees() {       
        $data['doctor_id'] = $this->input->post('doctor');
		$data['detail'] = $this->input->post('detail');
		$data['fees'] = $this->input->post('fees');	
        $this->db->insert('fee_master', $data);	
		return $this->db->insert_id();
    }
	public function delete_fees($id) {
		//$this->db->delete('fee_master', array('id' => $id));
		$data['is_deleted'] = 1;
		$data['sync_status'] = 0;	
		$this->db->update('fee_master', $data, array('id' =>  $id));
	}
	//Doctor Schedule
	public function find_drschedule(){
		$this->db->where("IFNULL(is_deleted,0) !=", 1);
		$query = $this->db->get("doctor_schedule");
		//echo $this->db->last_query()."<br/>";
        return $query->result_array();
	}
	public function get_schedule_from_id($schedule_id){
		$this->db->where("IFNULL(is_deleted,0) !=", 1);
		$this->db->where('schedule_id', $schedule_id);
		$query = $this->db->get("doctor_schedule");
		return $query->row_array();
	}
	public function add_drschedule(){
		$data['doctor_id'] = $this->input->post('doctor_id');
		if($this->input->post('day')){
			$data['schedule_day'] = implode(',', $this->input->post('day'));
		}
		if($this->input->post('schedule_date')){
			$data['schedule_date'] = date('Y-m-d',strtotime($this->input->post('schedule_date')));
		}
		$data['from_time'] = date('H:i:s',strtotime($this->input->post('from_time')));
		$data['to_time'] = date('H:i:s',strtotime($this->input->post('to_time')));
		
		$this->db->insert('doctor_schedule', $data);		
		//echo $this->db->last_query()."<br/>";
		return $this->db->insert_id();	
	}
	public function edit_drschedule(){
		$schedule_id = $this->input->post('schedule_id');
		$data['doctor_id'] = $this->input->post('doctor_id');
		if($this->input->post('day')){
			$data['schedule_day'] = implode(',', $this->input->post('day'));
		}else{
			$data['schedule_day'] = "";
		}
		if($this->input->post('schedule_date')){
			$data['schedule_date'] = date('Y-m-d',strtotime($this->input->post('schedule_date')));
		}else{
			$data['schedule_date'] = "";
		}
		$data['from_time'] = date('H:i:s',strtotime($this->input->post('from_time')));
		$data['to_time'] = date('H:i:s',strtotime($this->input->post('to_time')));
		$data['sync_status'] = 0;
		$this->db->update('doctor_schedule', $data, array('schedule_id' =>  $schedule_id));
		//echo $this->db->last_query()."<br/>";
	}
	public function delete_drschedule($schedule_id) {
		//$this->db->delete('doctor_schedule', array('schedule_id' => $schedule_id));
		$data['is_deleted'] = 1;
		$data['sync_status'] = 0;	
		$this->db->update('doctor_schedule', $data, array('schedule_id' =>  $schedule_id));
		
	}
	public function find_patientid($id){
		$this->db->select('patient_id'); 
		$this->db->where("IFNULL(is_deleted,0) !=", 1);
		$this->db->from('doctor_schedule');   
		$this->db->where('id', $id);
		return $this->db->get()->result();
	}
	public function get_dr_inavailability($appointment_id = NULL, $doctor_id = NULL) {
		$level = $_SESSION['category'];
		
		if($appointment_id != NULL){
				$this->db->where('end_date IS NOT NULL');
				$this->db->where('appointment_id', $appointment_id);
				$query=$this->db->get('appointments');
				
				return $query->row_array();
		}
		else
		{	
			if($level == 'Doctor')
			{
				$userid = $_SESSION['id'];
				$this->db->where('end_date IS NOT NULL');
				$this->db->where('status', 'NotAvailable');
				$this->db->where('doctor_id', $doctor_id);
				$this->db->order_by('appointment_id');
				$query=$this->db->get('appointments');
			}else{
				$this->db->where('end_date IS NOT NULL');
				$this->db->where('status', 'NotAvailable');
				$this->db->order_by('appointment_id');
				$query=$this->db->get('appointments');
			}
			return $query->result_array();
		}        
    }
	public function insert_availability($appointment_id = NULL){
		$start_date = date("Y-m-d", strtotime($this->input->post('start_date')));
        $data['appointment_date'] = $start_date;
		$end_date=date("Y-m-d", strtotime($this->input->post('end_date')));
		$data['end_date']=$end_date;
		
		//Set Time Zone
		$timezone = $this->settings_model->get_time_zone();
        if (function_exists('date_default_timezone_set'))
            date_default_timezone_set($timezone);
		
		//$timeformat = $this->settings_model->get_time_formate();	
		$data['start_time'] = date('H:i',strtotime($this->input->post('start_time')));
		$data['end_time'] =  date('H:i',strtotime($this->input->post('end_time')));
		//$data['start_time'] = $this->input->post('start_time');
		//$data['end_time'] =  $this->input->post('end_time');
        
		$data['status'] = 'NotAvailable';
		$data['visit_id']=0;
		$data['patient_id']=0;
		$data['title']="";
		$doctor_id = $this->input->post('doctor');
		$data['doctor_id'] = $doctor_id;
		//$data['doctor_id'] = $doctor_id;
		if($appointment_id == NULL){
			$this->db->insert('appointments', $data);
			//echo $this->db->last_query()."<br/>";
		}else{
			$data['sync_status'] = 0;
			$this->db->where('appointment_id', $appointment_id);
			$this->db->update('appointments', $data);
			//echo $this->db->last_query()."<br/>";
			
		}
	}
	public function get_today_birthdays($todate){
		$this->db->where("MONTH(dob) = MONTH('$todate')");
		$this->db->where("DAY(dob) = DAY('$todate')");
		$query = $this->db->get('doctor');
		//echo $this->db->last_query()."<br/>";
		return $query->result_array();
	}
	public function add_doctor_preference(){
		$data['doctor_id'] = $this->input->post('doctor');
		$data['max_patient'] = $this->input->post('max_patient');
		$this->db->insert('doctor_preferences', $data);	
		//echo $this->db->last_query()."<br/>";
	}
	public function update_doctor_preference($doctor_id){
		$data['max_patient'] = $this->input->post('max_patient');
		/*if($this->input->post('enable_online_appointment')){
			$data['enable_online_appointment'] = 1;
		}else{
			$data['enable_online_appointment'] = 0;
		}*/
		
		$data['sync_status'] = 0;
		$this->db->where('doctor_id', $doctor_id);
		$this->db->update('doctor_preferences', $data);
		//echo $this->db->last_query()."<br/>";
	}
	public function get_doctor_preferences($doctor_id = NULL){
		if($doctor_id != NULL){
			$this->db->where('doctor_id', $doctor_id);
		}
		$this->db->where("IFNULL(is_deleted,0) !=", 1);
		$query = $this->db->get("doctor_preferences");
		//echo $this->db->last_query()."<br/>";
		return $query->result_array();
	}
	public function get_doctor_preference($doctor_id){
		$this->db->where('doctor_id', $doctor_id);
		$this->db->where("IFNULL(is_deleted,0) !=", 1);
		$query = $this->db->get("doctor_preferences");
		//echo $this->db->last_query()."<br/>";
		return $query->row_array();
	}
	public function delete_preference($preference_id){
		$data['is_deleted'] = 1;
		$data['sync_status'] = 0;	
		$this->db->update('doctor_preferences', $data, array('preference_id' =>  $preference_id));
		//$this->db->delete('doctor_preferences', array('preference_id' => $preference_id));
	}
	public function get_doctor_bonus_report(){
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$doctor_id = $this->input->post('doctor');
		
		$where = " WHERE YEAR(visit.visit_date) = $year AND MONTH(visit.visit_date) = $month";
		
		if($doctor_id != NULL){
			$where .= " AND visit.doctor_id = $doctor_id";
		}
		
		$query = $this->db->query("SELECT CONCAT(IFNULL(patient.first_name,''),' ',IFNULL(patient.middle_name,''),' ',IFNULL(patient.last_name,'')) AS patient_name,
										   visit.visit_date AS date,
										   SUM(bill_detail.amount) AS amount
									  FROM ". $this->db->dbprefix('visit') ." AS visit 
										   JOIN ". $this->db->dbprefix('bill') ." AS bill ON bill.visit_id = visit.visit_id
										   JOIN ". $this->db->dbprefix('bill_detail') ." AS bill_detail ON bill_detail.bill_id = bill.bill_id
										   JOIN ". $this->db->dbprefix('view_patient') ." AS patient ON patient.patient_id = visit.patient_id
								   $where
								   GROUP BY patient.patient_id,visit.visit_date
								   ORDER By visit.visit_date");
		
		$result = $query->result_array();
		return $result;
	}
}
?>