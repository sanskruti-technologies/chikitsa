<?php
class Appointment_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

	//get appointment_details from patient_id
	function get_upcoming_appointments_by_patient_id($patient_id){
		$this->db->where('patient_id', $patient_id);
		$where = '(status="Consultation" or status = "Waiting" or status = "Appointments" or status = "Pending")';
		$this->db->where($where);
		$query=$this->db->get('appointments');
		//echo $this->db->last_query();
		$upcoming_appointments= $query->result_array();
		//print_r($upcoming_appointments);
		return $upcoming_appointments;
	}

	function get_completed_appointments_by_patient_id($patient_id){
		$this->db->where('patient_id', $patient_id);
		$this->db->where('status','Complete');
		$query=$this->db->get('appointments');
		//echo $this->db->last_query();
		$completed_appointments= $query->result_array();
		//print_r($upcoming_appointments);
		return $completed_appointments;
	}
	function get_upcoming_appointments_by_email($user_email){
		$query = $this->db->get_where('users', array('username' => $user_email));
		$user =  $query->row_array();
		$contact_id = $user['contact_id'];

		$query = $this->db->get_where('patient', array('contact_id' => $contact_id));
		$patient =  $query->row_array();
		$patient_id = $patient['patient_id'];

		$upcoming_appointments = $this->get_upcoming_appointments_by_patient_id($patient_id);
		return $upcoming_appointments;
	}
	function get_completed_appointments_by_email($user_email){
		$query = $this->db->get_where('users', array('username' => $user_email));
		$user =  $query->row_array();
		$contact_id = $user['contact_id'];

		$query = $this->db->get_where('patient', array('contact_id' => $contact_id));
		$patient =  $query->row_array();
		$patient_id = $patient['patient_id'];

		$completed_appointments = $this->get_completed_appointments_by_patient_id($patient_id);
		return $completed_appointments;
	}
	function get_dr_inavailability($appointment_id = NULL, $doctor_id = NULL) {
        $level = $this->session->userdata('category');

		if($appointment_id != NULL && $doctor_id!=NULL){
				$this->db->where('end_date IS NOT NULL');
				$this->db->where('IFNULL(is_deleted,0) != 1');
				$this->db->where('appointment_id', $appointment_id);
				$this->db->where('doctor_id', $doctor_id);
				$query=$this->db->get('appointments');
				return $query->result_array();
		}
		else
		{
			if($level == 'Doctor'){
				$user_id = $this->session->userdata('id');
				$query = $this->db->get_where('view_doctor', array('userid' => $user_id));
				$doctor =  $query->row_array();
				$doctor_id = $doctor['doctor_id'];
				$this->db->where('end_date IS NOT NULL');
				$this->db->where('IFNULL(is_deleted,0) != 1');
				$this->db->where('status', 'NotAvailable');
				$this->db->where('doctor_id', $doctor_id);
				$this->db->order_by('appointment_id');
				$query=$this->db->get('appointments');
			}else{
				$this->db->where('end_date IS NOT NULL');
				$this->db->where('status', 'NotAvailable');
				$this->db->where('IFNULL(is_deleted,0) != 1');
				$this->db->order_by('appointment_id');
				$query=$this->db->get('appointments');
			}
			return $query->result_array();
		}
    }
	function get_doctor_unavailability($appointment_date,$start_time,$end_time,$doctor_id,$is_doctor_active){
		//Check if Doctor is unavailable
		$this->db->where('appointment_date', $appointment_date);
		$this->db->where('status', 'NotAvailable');
		$this->db->where('IFNULL(is_deleted,0) != 1');
		$this->db->where('doctor_id', $doctor_id);
		$this->db->where("'$start_time' BETWEEN start_time AND end_time");
		$this->db->where("'$end_time' BETWEEN start_time AND end_time");

		$query = $this->db->get('appointments');
		$num = $query->num_rows();
		if($num >= 1){
			//Doctor is unavailable
			return FALSE;
		}else{
			if($is_doctor_active){

				//If no schedule than consider full day - all day
				$this->db->where('doctor_id', $doctor_id);
				$this->db->where('IFNULL(is_deleted,0) != 1');
				$query = $this->db->get('doctor_schedule');
				//echo $this->db->last_query();
				$num = $query->num_rows();
				if($num >= 1){
					//Check Doctor Schedule
					$day = date('l',strtotime($appointment_date));
					$date = date('Y-m-d',strtotime($appointment_date));
					$this->db->where("(IFNULL(schedule_day,'X') LIKE '%$day%' OR IFNULL(schedule_date,'0000-00-00') = '$date')");
					$this->db->where('doctor_id', $doctor_id);
					$this->db->where("'$start_time' BETWEEN from_time AND to_time");
					$this->db->where("'$end_time' BETWEEN from_time AND to_time");
					$query = $this->db->get('doctor_schedule');
					//echo $this->db->last_query();
					$num = $query->num_rows();
					if($num >= 1){
						return TRUE;
					}else{
						return FALSE;
					}
				}else{
					return TRUE;
				}
			}else{
				return TRUE;
			}
		}
	}
	function get_doctor_user_id($doctor_id){
		$this->db->where('doctor_id', $doctor_id);
		$query = $this->db->get('doctor');
		$doctor = $query->row_array();

		return $doctor['userid'];
	}
	function insert_new_appointment($patient_id,$doctor_id,$appointment_date,$appointment_start_time,$appointment_end_time){
		$data['appointment_date'] = $appointment_date;
        $data['start_time'] = $appointment_start_time;
        $data['end_time'] = $appointment_end_time;
		$data['visit_id'] = 0;
		$data['status'] = 'Complete';
		$data['title']=$this->get_patient_name($patient_id);
		$data['patient_id'] = $patient_id;
		$data['doctor_id'] = $doctor_id;
		$userid = $this->get_doctor_user_id($doctor_id);
		$data['userid'] = $userid;
		$data['clinic_code'] = $this->session->userdata('clinic_code');

		$this->db->insert('appointments', $data);
		//echo $this->db->last_query();
		$appointment_id = $this->db->insert_id();
		return $appointment_id;
	}
	//Add New Appointment
    function add_appointment($status,$patient_name = NULL,$patient_id = NULL) {
		// Set Local TimeZone as Default TimeZone
		$timezone = $this->settings_model->get_time_zone();
        if (function_exists('date_default_timezone_set'))
            date_default_timezone_set($timezone);

        $appointment_date = date("Y-m-d", strtotime($this->input->post('appointment_date')));
        $start_time = date("H:i:s",strtotime($this->input->post('start_time'))); //Do Not Use Time Format
		$end_time = date("H:i:s",strtotime($this->input->post('end_time'))); //Do Not Use Time Format

		$appointment_reason = $this->input->post('appointment_reason');
		$data['appointment_reason'] = $appointment_reason;
		$data['appointment_date'] = $appointment_date;
        $data['start_time'] = $start_time;
        $data['end_time'] = $end_time;
		$data['visit_id'] = 0;

		$doctor_id = $this->input->post('doctor_id');
		$data['doctor_id'] = $doctor_id;
        if ($this->input->post('patient_id') <> 0) {
			if($this->input->post('patient_name')){
				$data['title'] = $this->input->post('patient_name');
			}else{
				$patient_id = $this->input->post('patient_id');
				$this->db->where('patient_id', $patient_id);
				$query=$this->db->get('view_patient');
				$patient =  $query->row_array();
				$data['title'] = $patient['first_name'].' '.$patient['middle_name'].' '.$patient['last_name'];
			}

        }else{
			if($this->input->post('title')){
				$data['title'] = $this->input->post('title');
			}else{
				$data['title'] = $patient_name;
			}
        }
		if($this->input->post('patient_id')){
			$data['patient_id'] = $this->input->post('patient_id');
			$patient_id = $this->input->post('patient_id');
		}else{
			$data['patient_id'] = $patient_id;
		}


		//Adding Appintment, so reset the followup date
        if ($patient_id <> NULL) {
			$data3['followup_date'] = '00:00:00';
			$data3['sync_status'] = 0;
			$this->db->update('patient', $data3, array('patient_id' => $patient_id));
		}
		// Insert Appointment
		$data['status'] = $status;
		if($this->session->userdata('clinic_code')){
			$data['clinic_code'] = $this->session->userdata('clinic_code');

		}
		$userid = $this->get_doctor_user_id($doctor_id);
		$data['userid'] = $userid;
		$this->db->insert('appointments', $data);
		//echo $this->db->last_query();
		$appointment_id = $this->db->insert_id();

		//Creating a Log of Appintment
		$data2['appointment_id'] = $appointment_id;
		$data2['appointment_reason'] = $appointment_reason;
		$data2['change_date_time'] = date('d/m/Y H:i:s'); //Do not use Time Format
		$data2['start_time'] = $this->input->post('start_time');
		$data2['old_status'] = " ";
		$data2['status'] = 'Appointment';
		$data2['from_time'] = date('H:i:s'); //Do not use Time Format
		$data2['to_time'] = " ";
		$data2['name'] = $this->session->userdata('name');
		$data2['clinic_code'] = $this->session->userdata('clinic_code');

		$this->db->insert('appointment_log', $data2);
		return $appointment_id;
    }
	function update_appointment($title){
		$appointment_id = $this->input->post('appointment_id');
		$data['appointment_reason'] = $this->input->post('appointment_reason');
		$data['appointment_date'] = date("Y-m-d",strtotime($this->input->post('appointment_date')));
        $data['start_time'] = date("H:i:s",strtotime($this->input->post('start_time')));
        $data['end_time'] = date("H:i:s",strtotime($this->input->post('end_time')));
        $data['patient_id'] = $this->input->post('patient_id');
		$data['title'] = $title;
		$data['doctor_id'] = $this->input->post('doctor_id');
		$userid = $this->get_doctor_user_id($data['doctor_id']);
		$data['userid'] = $userid;
		$data['sync_status'] = 0;

		$this->db->where('appointment_id', $appointment_id);
		$this->db->update('appointments', $data);
	}
	function get_future_appointments($date){
		$qry = " CONCAT( appointment_date,  ' ', start_time ) >= '$date' ";
		$this->db->where($qry);
		$query=$this->db->get('appointments');
		$appointments = $query->result_array();

		return $appointments;
	}
    function get_appointments($appointment_date,$doctor_id = NULL) {
		$qry = "appointment_date ='$appointment_date' AND status !='NotAvailable' ";
		if($this->session->userdata('clinic_code')){
			$clinic_code = $this->session->userdata('clinic_code');
			$qry .= " AND clinic_code = '$clinic_code'";
		}

		if(isset($doctor_id)){
			$qry .= " AND  doctor_id='$doctor_id'";
		}
		$this->db->where($qry);
		$query=$this->db->get('appointments');
		//echo $this->db->last_query();
		$appointments = $query->result_array();

		return $appointments;
    }
	function get_appointments_between_dates($start_date,$end_date,$doctor_id = NULL) {
		$qry = "appointment_date >= '$start_date'  AND appointment_date <= '$end_date' AND status !='NotAvailable'";
		if(isset($doctor_id)){
			$qry .= " AND doctor_id='$doctor_id'";
		}
		$this->db->where($qry);
		$query=$this->db->get('appointments');
		$appointments = $query->result_array();
		//echo $this->db->last_query();
		return $appointments;
    }
	function get_appointments_between_times($start_date,$end_date,$start_time,$end_time,$doctor_id = NULL){
		$qry = "appointment_date >= '$start_date'  AND appointment_date <= '$end_date' AND (status !='NotAvailable' AND status != 'Cancel') ";
		$qry .= " AND (('".date('H:i:s',strtotime($start_time))."' >= start_time  AND '".date('H:i:s',strtotime($start_time))."' < end_time ) OR ('".date('H:i:s',strtotime($end_time))."' > start_time  AND '".date('H:i:s',strtotime($end_time))."' <= end_time)) ";
		if(isset($doctor_id)){
			$qry .= " AND doctor_id='$doctor_id'";
		}
		$this->db->where($qry);
		$query=$this->db->get('appointments');
		//return $this->db->last_query();
		$appointments = $query->result_array();

		return $appointments;
	}
	function get_appointments_by_email($patient_email) {
		$query = $this->db->get_where('view_patient', array('email' => $patient_email));

        $patients = $query->result_array();
		$patient_ids ="";
		foreach($patients as $patient){
			$patient_ids .= $patient['patient_id'];
		}
		$query = $this->db->get_where('appointments', array('patient_id IN ('.$patient_ids.')'));
		//echo $this->db->last_query()."<br/>";
        $appointments = $query->result_array();
		return $appointments;
	}
	function get_appointments_id($appointment_id) {
        $query = $this->db->get_where('appointments', array('appointment_id' => $appointment_id));
		//echo $this->db->last_query()."<br/>";
        return $query->row_array();
    }
	function get_appointment_from_id($appointment_id) {
        $query = $this->db->get_where('appointments', array('appointment_id' => $appointment_id));
        return $query->row_array();
    }
	function get_appointment_at($appointment_date, $hour, $min, $doctor_id = NULL) {
        $appointment_date = date("Y-m-d", strtotime($appointment_date));
        if ($doctor_id == NULL) {
            return;
        } else {
            $start_time = $hour.":".$min;
            $query = $this->db->get_where('appointments', array('appointment_date' => $appointment_date, 'start_time' => $start_time, 'doctor_id' => $doctor_id));
            return $query->row_array();
        }
    }
    function get_appointment_by_patient($patient_id){
        $date = date('Y-m-d');
        $this->db->select('appointment_id,start_time,appointment_date,doctor_id,appointment_reason');
        $query = $this->db->get_where('appointments', array('patient_id' => $patient_id, 'appointment_date' => $date,'status!='=>'Complete'));
        $row = $query->num_rows();
        if ($row > 0) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }
	function get_appointment_by_visit($visit_id){
		$query = $this->db->get_where('appointments', array('visit_id' => $visit_id));
		//echo $this->db->last_query();
        return $query->row_array();
	}
    function insert_availability($appointment_id = NULL){
		$start_date = date("Y-m-d", strtotime($this->input->post('visit_date')));
        $data['appointment_date'] = $start_date;
		$end_date=date("Y-m-d", strtotime($this->input->post('end_date')));
		$data['end_date']=$end_date;

		//Set Time Zone
		$timezone = $this->settings_model->get_time_zone();
        if (function_exists('date_default_timezone_set'))
            date_default_timezone_set($timezone);

		$timeformat = $this->settings_model->get_time_formate();
		$data['start_time'] = date($timeformat,strtotime($this->input->post('start_time')));
		$data['end_time'] =  date($timeformat,strtotime($this->input->post('end_time')));

		$data['status'] = 'NotAvailable';
		$data['visit_id']=0;
		$data['patient_id']=0;
		$data['sync_status']=0;
		$data['title']="";
		$data['clinic_code'] = $this->session->userdata('clinic_code');

		if($this->input->post('doctor_id')==0){
			$doctor_id = $this->input->post('doctor');
		}else{
			$doctor_id = $this->input->post('doctor_id');
		}
		$data['doctor_id'] = $doctor_id;
		$userid = $this->get_doctor_user_id($doctor_id);
		$data['userid'] = $userid;
		if($appointment_id == NULL){
			$this->db->insert('appointments', $data);
		}else{
			$this->db->where('appointment_id', $appointment_id);
			$this->db->update('appointments', $data);
		}
	}
	function delete_availability($appointment_id) {
		$data['is_deleted'] = 1;
		$this->db->where('appointment_id', $appointment_id);
		$this->db->update('appointments', $data);
        //$this->db->delete('appointments', array('appointment_id' => $appointment_id));
    }
    function change_status($appointment_id, $new_status,$visit_id = NULL) {
		//Fetch Current Details
		$current_appointment = $this->get_appointments_id($appointment_id);

        //Update Status
        $data['status'] = $new_status;
		$data['sync_status'] = 0;
		if(isset($visit_id)){
			$data['visit_id'] = $visit_id;
		}
		//Set To Time in Appointment if not set
		if($current_appointment['end_time'] == '00:00:00'){
			$data['end_time'] = date('H:i:s'); //Do Not Use Time Format
		}
        $this->db->update('appointments', $data, array('appointment_id' => $appointment_id));


        //Set Time Zone
		$timezone = $this->settings_model->get_time_zone();
        if (function_exists('date_default_timezone_set'))
            date_default_timezone_set($timezone);

		//Update Old Appointment Log
        $data2['to_time'] = date('H:i:s');//Do Not Use Time Format
		$data2['sync_status'] = 0;
        $data2['clinic_code'] = $this->session->userdata('clinic_code');

		$this->db->update('appointment_log', $data2, array('appointment_id' => $appointment_id, 'to_time' => '00:00:00'));

		//Insert New Log
        $data3['appointment_id'] = $appointment_id;
		$data3['appointment_reason'] = $current_appointment['appointment_reason'];
        $data3['change_date_time'] = date('d/m/Y H:i:s'); //Do Not Use Time Format
        $data3['start_time'] =  $current_appointment['start_time'];
        $data3['old_status'] = $current_appointment['status'];
        $data3['status'] = $new_status;
        $data3['from_time'] = date('H:i:s');//Do Not Use Time Format
        $data3['to_time'] = '';
        $data3['name'] = $this->session->userdata('name');
		$data3['clinic_code'] = $this->session->userdata('clinic_code');

        $this->db->insert('appointment_log', $data3);

    }
	function change_status_visit($visit_id) {

        $data['status'] = "Complete";
		$data['sync_status'] = 0;
		$this->db->update('appointments', $data, array('visit_id' => $visit_id));


		$this->db->where('visit_id', $visit_id);;
		$query=$this->db->get('appointments');
		$row=$query->row();

		$timezone = $this->settings_model->get_time_zone();
        if (function_exists('date_default_timezone_set'))
            date_default_timezone_set($timezone);

        $data2['to_time'] = date('H:i:s'); //Do Not Use Time Format
		$data2['sync_status'] = 0;
        $this->db->update('appointment_log', $data2, array('appointment_id' =>$row->appointment_id, 'to_time' => '00:00:00'));


        $data3['appointment_id'] = $row->appointment_id;
		$data3['appointment_reason'] = $row->appointment_reason;
        $data3['change_date_time'] = date('d/m/Y H:i:s');
        $data3['start_time'] = $row->start_time;
        $data3['old_status'] = "Consultation";
        $data3['status'] = "Complete";
        $data3['from_time'] = date('H:i:s'); //Do Not Use Time Format
        $data3['to_time'] = '';
        $data3['name'] = $this->session->userdata('name');
        $data3['clinic_code'] = $this->session->userdata('clinic_code');

		$this->db->insert('appointment_log', $data3);

		// Get Insert Visit's patient_id
        $patient_id = $this->get_patient_id($visit_id);

        $this->db->select('bill_id');
        $this->db->order_by("bill_id", "desc");
        $this->db->limit(1);
        $query = $this->db->get_where('bill', array('patient_id' => $patient_id));
        $result = $query->row();

        if($result)
		{
            $result = $query->row();
            $bill_id = $result->bill_id;

            $this->db->select('due_amount');
            $query = $this->db->get_where('bill', array('bill_id' => $bill_id));
            $result = $query->row();
            $pre_due_amount = $result->due_amount;

            $this->db->select_sum('amount');
            $query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id));
            $result = $query->row();
            $bill_amount = $result->amount;

            $this->db->select('amount');
            $query = $this->db->get_where('payment_transaction', array('bill_id' => $bill_id, 'payment_type' => 'bill_payment'));

            if($query->num_rows() > 0){
                $result = $query->row();
                $paid_amount = $result->amount;
            }else{
                $paid_amount = 0;
            }
            $due_amount = $pre_due_amount + $bill_amount - $paid_amount;

            $bill_id = $this->create_bill($visit_id, $patient_id, $due_amount);
        }
		else
		{
            $bill_id = $this->create_bill($visit_id, $patient_id);
        }
    }
    function get_user_id($user_name) {
        $this->db->select('userid');
        $query = $this->db->get_where('users', array('username' => $user_name));
        return $query->row();
    }
    function get_followup($follow_date) {
        $this->db->order_by("followup_date", "desc");
        $query = $this->db->get_where('patient', array('followup_date <' => $follow_date, 'followup_date !=' => '0000:00:00'));
        return $query->result_array();
    }
    function get_report($from_date,$to_date, $doctor_id=NULL,$patient_id=NULL,$clinic_id = NULL) {

		if($from_date != NULL){
			$this->db->where('appointment_date >=', $from_date);
		}
		if($to_date != NULL){
			$this->db->where('appointment_date <=', $to_date);
		}
		if($clinic_id != NULL){
			$this->db->where('clinic_id', $clinic_id);
		}
		if($doctor_id != NULL){
			$this->db->where('doctor_id', $doctor_id);
		}
		if($patient_id != NULL){
			$this->db->where('patient_id', $patient_id);
		}
		$this->db->where('status !=', 'Cancel');
		$this->db->where('status !=', 'NotAvailable');

		$this->db->order_by("appointment_date", "asc");
		$query = $this->db->get('view_report');
		//echo $this->db->last_query();
        return $query->result_array();
    }
	function get_export_query($from_date,$to_date, $doctor_id) {
		if($from_date != NULL && $from_date != '1970-01-01'){
			$this->db->where('appointment_date >=', $from_date);
		}
		if($to_date != NULL && $from_date != '1970-01-01'){
			$this->db->where('appointment_date <=', $to_date);
		}
		if($doctor_id != NULL){
			$this->db->where('doctor_id' , $doctor_id);
		}
		$this->db->select('clinic_name,patient_name,doctor_name,appointment_date,appointment_time,waiting_in,consultation_in,consultation_out');
		$this->db->order_by("appointment_date", "asc");
		$query = $this->db->get('view_report');
		//echo $this->db->last_query();
        return $query->result_array();
    }
    function get_todos(){
        $user_id = $this->session->userdata('id');
        $query = "Select * FROM " . $this->db->dbprefix('todos') . " WHERE userid = " . $user_id . " AND (done = 0 OR (done_date > DATE_SUB(NOW(), INTERVAL 29 DAY) AND done = 1)) ORDER BY done ASC, add_date DESC;";
        $result = $this->db->query($query);
        return $result->result_array();
    }
    function add_todos(){
        $data['userid'] = $this->session->userdata('id');
        $data['add_date'] = date('Y-m-d H:i:s');
        $data['done'] = 0;
        $data['todo'] = $this->input->post('task');
        $this->db->insert('todos', $data);

        redirect('appointment/index');
    }
    function todo_done($done, $id) {
        $data['done'] = $done;
		$data['sync_status'] = 0;
        if ($data['done'] == 1) {
            $data['done_date'] = date('Y-m-d H:i:s');
        } else {
            $data['done_date'] = NULL;
        }
        $this->db->update('todos', $data, array('id_num' => $id));

        return;
    }
    function delete_todo($id) {
        $this->db->delete('todos', array('id_num' => $id));

        return;
    }
	function get_patient_id($visit_id) {
        $query = $this->db->get_where('visit', array('visit_id' => $visit_id));
        $row = $query->row();
        if ($row)
            return $row->patient_id;
        else
            return 0;
    }
	function get_visit_from_id($visit_id) {
        $query = $this->db->get_where('visit', array('visit_id' => $visit_id));
        $row = $query->row_array();
        return $row;
    }
	public function get_patient_name($patient_id) {

		$this->db->select('first_name,middle_name,last_name');
		$this->db->from('contacts');
		$this->db->join('patient', 'patient.contact_id = contacts.contact_id');
		$this->db->where('patient_id', $patient_id);
		$query = $this->db->get();

        $row = $query->row();
        if ($row)
            return $row->first_name.' '.$row->middle_name.' '.$row->last_name;
        else
            return 0;
    }
	public function insert_new_visit($appointment_id,$visit_notes){
		$query=$this->db->get_where('appointments',array('appointment_id'=>$appointment_id));

		$row=$query->row();
		if ($row){
			$data['visit_date'] = $row->appointment_date;
			$data['visit_time'] = date("h:i:s",strtotime($row->start_time)); //Do Not Use Time Format
			$data['notes'] = $visit_notes;
			$data['patient_id']=$row->patient_id;
			$data['doctor_id']=$row->doctor_id;
			$userid = $this->get_doctor_user_id($row->doctor_id);
			$data['userid'] = $userid;
			$this->db->insert('visit', $data);
			//echo $this->db->last_query()."<br/>";
			$visit_id= $this->db->insert_id();

			$update_data['visit_id']=$visit_id;
			$update_data['sync_status']=0;
			$this->db->update('appointments', $update_data, array('appointment_id' => $appointment_id));

			$bill_data['bill_date'] =  $row->appointment_date;
			$bill_data['patient_id'] = $row->patient_id;
			$bill_data['visit_id'] = $visit_id;
			$bill_data['due_amount'] = 0.00;
			$this->db->insert('bill', $bill_data);

			return $visit_id;
		}
	}
    public function insert_visit($app_id) {

        // Insert New Visit

		$query=$this->db->get_where('appointments',array('appointment_id'=>$app_id));
		$row=$query->row();
		$patient_id=$row->patient_id;
		$data['notes'] = "";
        $data['type'] = "New Visit";
        $data['visit_date'] = $row->appointment_date;
        $data['visit_time'] = date("h:i:s",strtotime($row->start_time)); //Do Not Use Time Format
		$data['patient_id']=$row->patient_id;
		$data['doctor_id']=$row->doctor_id;
        $this->db->insert('visit', $data);


        // Get Insert Visit's visit_id
        $insert_visit_id= $this->db->insert_id();

		$date['followup_date'] = date("Y-m-d",strtotime($row->appointment_date.'+ 15 days')); //Do Not Use Time Format
        $sql = "update " . $this->db->dbprefix('patient') . " set followup_date = ? where patient_id = ?;";
        $this->db->query($sql, array($date['followup_date'], $patient_id));

        // Get Insert Visit's patient_id
        $patient_id = $this->get_patient_id($insert_visit_id);

        $this->db->select('bill_id');
        $this->db->order_by("bill_id", "desc");
        $this->db->limit(1);
        $query = $this->db->get_where('bill', array('patient_id' => $patient_id));
        $result = $query->row();

        if($result)
		{
            $result = $query->row();
            $bill_id = $result->bill_id;

            $this->db->select('due_amount');
            $query = $this->db->get_where('bill', array('bill_id' => $bill_id));
            $result = $query->row();
            $pre_due_amount = $result->due_amount;

            $this->db->select_sum('amount');
            $query = $this->db->get_where('bill_detail', array('bill_id' => $bill_id));
            $result = $query->row();
            $bill_amount = $result->amount;

            $this->db->select('amount');
            $query = $this->db->get_where('payment_transaction', array('bill_id' => $bill_id, 'payment_type' => 'bill_payment'));

            if($query->num_rows() > 0){
                $result = $query->row();
                $paid_amount = $result->amount;
            }else{
                $paid_amount = 0;
            }
            $due_amount = $pre_due_amount + $bill_amount - $paid_amount;

            $bill_id = $this->create_bill($insert_visit_id, $patient_id, $due_amount);
        }
		else
		{
            $bill_id = $this->create_bill($insert_visit_id, $patient_id);
        }
        // Create Bill For Newly Entered Visit and Get bill_id

		return $insert_visit_id;

    }
	public function create_bill($visit_id, $patient_id, $due_amount = NULL) {
        $data['bill_date'] = date('Y-m-d');
        $data['patient_id'] = $patient_id;
        $data['visit_id'] = $visit_id;
        if($due_amount == NULL){
            $data['due_amount'] = 0.00;
        }else{
            $data['due_amount'] = $due_amount;
        }
        $this->db->insert('bill', $data);

        return $this->db->insert_id();
    }
	public function get_future_followups($date){
		$qry = " followup_date >= '$date' ";
		$this->db->where($qry);
		$query=$this->db->get('followup');
		$followups = $query->result_array();

		return $followups;
	}
	function add_appointment_from_visit($visit_id){
		$visit = $this->get_visit_from_id($visit_id);

        $query = $this->db->get_where('patient', array('patient_id' => $visit['patient_id']));
        $patient = $query->row_array();

		$query = $this->db->get_where('contacts', array('contact_id' => $patient['contact_id']));
        $contact = $query->row_array();

		$data['appointment_date'] = date('Y-m-d',strtotime($visit['visit_date']));
		$data['end_date'] = NULL;
		$data['start_time'] = $visit['visit_time'];
		$time = strtotime($data['start_time']);
		$time = date("H:i",strtotime('+30 minutes',$time)); //Do Not Use Time Format
		$data['end_time']=date("H:i",strtotime($time));		//Do Not Use Time Format
		$data['title'] = $contact['first_name'].' '.$contact['middle_name'].' '.$contact['last_name'];
		$data['patient_id'] = $visit['patient_id'];
		$data['doctor_id'] = $visit['doctor_id'];
		$userid = $this->get_doctor_user_id($visit['doctor_id']);
		$data['userid'] = $userid;

		$data['status'] = "Appointments";
		$data['visit_id'] = $visit_id;
		$data['appointment_reason'] = $visit['appointment_reason'];
		$data['clinic_code'] = $this->session->userdata('clinic_code');

		$this->db->insert('appointments', $data);
		//echo $this->db->last_query()."<br/>";
	}
	function add_visit_id_to_appointment($appointment_id,$visit_id){
		$data['visit_id'] = $visit_id;
		$data['sync_status'] = 0;
		$this->db->update('appointments', $data, array('appointment_id' => $appointment_id));
	}
}
