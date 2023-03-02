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
class Appointment extends CI_Controller {

    function __construct() {

        parent::__construct();



		$this->config->load('version');



        $this->load->model('appointment_model');

        $this->load->model('admin/admin_model');

		$this->load->model('contact/contact_model');

        $this->load->model('patient/patient_model');

        $this->load->model('bill/bill_model');

		$this->load->model('payment/payment_model');

        $this->load->model('settings/settings_model');

		$this->load->model('module/module_model');

		$this->load->model('doctor/doctor_model');

		$this->load->model('menu_model');



        $this->load->helper('url');

        $this->load->helper('form');

		$this->load->helper('currency_helper');

		$this->load->helper('directory' );

		$this->load->helper('inflector');

		$this->load->helper('time');

		$this->load->helper('header');



		$this->lang->load('main');



        $this->load->library('form_validation');

		$this->load->library('session');

		$this->load->library('export');

		$this->lang->load('main',$this->session->userdata('prefered_language'));

        $prefs = array(

            'show_next_prev' => TRUE,

            'next_prev_url' => base_url() . 'index.php/appointment/index',

        );

        $this->load->library('calendar', $prefs);

    }
	public function ajax_appointments_all($appointment_date){

		$clinic_id = $this->session->userdata('clinic_id');

		$level = $this->session->userdata('category');

		$start_time = $this->settings_model->get_clinic_start_time($clinic_id);

		$end_time = $this->settings_model->get_clinic_end_time($clinic_id);

		$time_interval = $this->settings_model->get_time_interval();



		$start_time = timetoint($start_time);

		$end_time = timetoint($end_time);


	  $user_id = $this->session->userdata('id');

		if ($this->doctor_model->is_doctor($user_id)) {

			//Fetch this doctor's appointments for the date

      		$user_id = $this->session->userdata('id');
			$doctor = $this->admin_model->get_doctor($user_id);

			$doctor_id = $doctor['doctor_id'];

			$appointments = $this->appointment_model->get_appointments($appointment_date,$doctor_id);



		} else {

			//Fetch appointments for the date

			$appointments = $this->appointment_model->get_appointments($appointment_date);

		}

		$appointment_array = array();

		foreach($appointments as $appointment){

			$row = array();

			$appointment_id = $appointment['appointment_id'];

			$patient_id = $appointment['patient_id'];

			$row['appointment_id'] = $appointment_id;


			$start_position = timetoint($appointment['start_time'])*100;

			$start_position = round($start_position);

			$start_position = nearest_timeinterval($start_time,$end_time,$time_interval,$start_position);



			$end_position =  timetoint($appointment['end_time'])*100;

			$end_position = round($end_position);

			$end_position = nearest_timeinterval($start_time,$end_time,$time_interval,$end_position);



			$href = site_url("appointment/edit_appointment/" . $appointment_id );

			$appointment_title = $appointment['title'];



			$appointment_column = 0;

			$doctor_id = 0;

			$next_link = "";

			$cancel_link = "";
			$dot_back_color = "";
 
			if ($this->doctor_model->is_doctor($user_id)) {

				switch($appointment['status']){

					case 'Appointments':

						$class = "btn-primary";
						$dot_back_color = "#4e73df";
						$start_position = "app".$start_position;

						$end_position = "app".$end_position;

						$nxt=true;

						$nextstatus= base_url() ."index.php/appointment/change_status/". $appointment_id."/Waiting";

						$ca=true;

						$cancelapp= base_url() ."index.php/appointment/change_status/". $appointment_id."/Cancel";

						break;

					case 'Consultation':

						$class = "btn-danger";
						$dot_back_color = "#e74a3b";
						$start_position = "con".$start_position;

						$end_position = "con".$end_position;

						$appointment = $this->appointment_model->get_appointments_id($appointment_id);

						$visit_id = $appointment['visit_id'];

						if($visit_id != 0){

							$href = site_url("patient/edit_visit/" . $visit_id."/".$patient_id."/".$appointment_id );

						}else{

							$href = site_url("patient/visit/" . $patient_id ."/" . $appointment_id) ;

						}

						$nxt=false;

						$ca=false;

						break;

					case 'Complete':

						$class = "btn btn-success";
						$dot_back_color = "#1cc88a";
						$start_position = "com".$start_position;

						$end_position = "com".$end_position;

						$href = site_url("patient/visit/" . $patient_id ."/" . $appointment_id) ;

						$nxt=false;

						$ca=false;

						break;

					case 'Cancel':

						$class = "btn btn-info";
						$dot_back_color = "#36b9cc";
						$start_position = "can".$start_position;

						$end_position = "can".$end_position;

						$nxt=false;

						$ca=false;

						break;

					case 'Pending':

						$class = "btn btn_pending";
						$dot_back_color = "#FF8404";
						$start_position = "pend".$start_position;

						$end_position = "pend".$end_position;

						$nxt=false;

						$ca=false;

						break;

					case 'Waiting':

						$class = "btn-warning";
						$dot_back_color = "#f6c23e";
						$start_position = "wai".$start_position;

						$end_position = "wai".$end_position;

						$nxt=true;

						$nextstatus = site_url("appointment/change_status/". $appointment_id."/Consultation");

						$ca=true;

						$cancelapp= base_url() ."index.php/appointment/change_status/". $appointment_id."/Cancel";

						break;

					default:

						break;

				}

				if ($nxt){

					$next_link = "<a href='".$nextstatus."' class='btn square-btn-adjust $class ' style='height:100%;padding-top:10%;'><i class='fa fa-arrow-circle-right'></i></a>";

				}

				if($ca){

					$cancel_link = "<a href='".$cancelapp."' class='btn square-btn-adjust $class' style='height:100%;padding-top:10%;'><i class='fa fa-times'></i></a>";

				}

			}else{



					$start_position = $appointment['doctor_id']."_".$start_position;

					$end_position = $appointment['doctor_id']."_".$end_position;

					switch($appointment['status']){

						case 'Appointments':

							$class = "btn-primary";
							$dot_back_color = "pink";


							break;

						case 'Consultation':

							$class = "btn-danger";
							$dot_back_color = "#e74a3b";

							$appointment = $this->appointment_model->get_appointments_id($appointment_id);

							$visit_id = $appointment['visit_id'];

							if($visit_id != 0){

								$href = site_url("patient/edit_visit/" . $visit_id."/".$patient_id."/".$appointment_id );
	
							}else{
	
								$href = site_url("patient/visit/" . $patient_id ."/" . $appointment_id) ;
	
							}

							//$href = site_url("patient/edit_visit/" . $visit_id."/".$patient_id );

							break;

						case 'Complete':

							$class = "btn-success";
							$dot_back_color = "#1cc88a";
							$href = site_url("appointment/view_appointment	/". $appointment_id ) ;

							break;

						case 'Cancel':

							$class = "btn-info";
							$dot_back_color = "#36b9cc";
							break;

						case 'Waiting':

							if ($this->doctor_model->is_nurse($user_id)) {

								$href = site_url("patient/visit/" . $patient_id."/".$appointment_id );

							}

							$class = "btn-warning";
							$dot_back_color = "#f6c23e";
							break;

						case 'Pending':

							$class = "btn_pending";
							$dot_back_color = "#FF8404";
							break;

						default:

							$class = "btn-primary";

							break;

					}

				}

				$row['start_position'] = $start_position;

				$row['end_position'] = $end_position;

				$row['href'] = $href;

				$row['appointment_title'] = $appointment_title;

				$row['appointment_class'] = $class;

				$row['next_link'] = $next_link;

				$row['cancel_link'] = $cancel_link;
				$row['dot_back_color'] = $dot_back_color;


				$appointment_array[] = $row;

			}

		echo json_encode($appointment_array);


	}
	public function ajax_appointments($appointment_date){

		$clinic_id = $this->session->userdata('clinic_id');

		$level = $this->session->userdata('category');



		$start_time = $this->settings_model->get_clinic_start_time($clinic_id);

		$end_time = $this->settings_model->get_clinic_end_time($clinic_id);

		$time_interval = $this->settings_model->get_time_interval();



		$start_time = timetoint($start_time);

		$end_time = timetoint($end_time);



		if ($level == 'Doctor') {

			//Fetch this doctor's appointments for the date

			$user_id = $this->session->userdata('id');

			$doctor = $this->admin_model->get_doctor($user_id);

			$doctor_id = $doctor['doctor_id'];

			$appointments = $this->appointment_model->get_appointments($appointment_date,$doctor_id);



		} else {

			//Fetch appointments for the date

			$appointments = $this->appointment_model->get_appointments($appointment_date);

		}

		$appointment_array = array();

		foreach($appointments as $appointment){

			$row = array();

			$appointment_id = $appointment['appointment_id'];

			$patient_id = $appointment['patient_id'];

			$row['appointment_id'] = $appointment_id;



			$start_position = timetoint($appointment['start_time'])*100;

			$start_position = round($start_position);

			$start_position = nearest_timeinterval($start_time,$end_time,$time_interval,$start_position);



			$end_position =  timetoint($appointment['end_time'])*100;

			$end_position = round($end_position);

			$end_position = nearest_timeinterval($start_time,$end_time,$time_interval,$end_position);



			$href = site_url("appointment/edit_appointment/" . $appointment_id );

			$appointment_title = $appointment['title'];



			$appointment_column = 0;

			$doctor_id = 0;

			$next_link = "";

			$cancel_link = "";
			$dot_back_color = "";

			if ($level == 'Doctor') {

				switch($appointment['status']){

					case 'Appointments':

						$class = "btn-primary";
						$dot_back_color = "#4e73df";

						$start_position = "app".$start_position;

						$end_position = "app".$end_position;

						$nxt=true;

						$nextstatus= base_url() ."index.php/appointment/change_status/". $appointment_id."/Waiting";

						$ca=true;

						$cancelapp= base_url() ."index.php/appointment/change_status/". $appointment_id."/Cancel";

						break;

					case 'Consultation':

						$class = "btn-danger";
						$dot_back_color = "#e74a3b";

						$start_position = "con".$start_position;

						$end_position = "con".$end_position;

						$appointment = $this->appointment_model->get_appointments_id($appointment_id);

						$visit_id = $appointment['visit_id'];

						if($visit_id != 0){

							$href = site_url("patient/edit_visit/" . $visit_id."/".$patient_id."/".$appointment_id );

						}else{

							$href = site_url("patient/visit/" . $patient_id ."/" . $appointment_id) ;

						}

						$nxt=false;

						$ca=false;

						break;

					case 'Complete':

						$class = "btn btn-success";
						$dot_back_color = "#1cc88a";

						$start_position = "com".$start_position;

						$end_position = "com".$end_position;

						$href = site_url("patient/visit/" . $patient_id ."/" . $appointment_id) ;

						$nxt=false;

						$ca=false;

						break;

					case 'Cancel':

						$class = "btn btn-info";
						$dot_back_color = "#36b9cc";

						$start_position = "can".$start_position;

						$end_position = "can".$end_position;

						$nxt=false;

						$ca=false;

						break;

					case 'Pending':

						$class = "btn btn_pending";
						$dot_back_color = "#FF8404";
						$start_position = "pend".$start_position;

						$end_position = "pend".$end_position;

						$nxt=false;

						$ca=false;

						break;

					case 'Waiting':

						$class = "btn-warning";
						$dot_back_color = "#f6c23e";

						$start_position = "wai".$start_position;

						$end_position = "wai".$end_position;

						$nxt=true;

						$nextstatus = site_url("appointment/change_status/". $appointment_id."/Consultation");

						$ca=true;

						$cancelapp= base_url() ."index.php/appointment/change_status/". $appointment_id."/Cancel";

						break;

					default:

						break;

				}

				if ($nxt){

					$next_link = "<a href='".$nextstatus."' class='btn square-btn-adjust $class ' style='height:100%;'><i class='fa fa-arrow-circle-right'></i></a>";

				}

				if($ca){

					$cancel_link = "<a href='".$cancelapp."' class='btn square-btn-adjust $class' style='height:100%;'><i class='fa fa-times'></i></a>";

				}

			}else{



					$start_position = $appointment['doctor_id']."_".$start_position;

					$end_position = $appointment['doctor_id']."_".$end_position;

					switch($appointment['status']){

						case 'Appointments':

							$class = "btn-primary";
							$dot_back_color = "#4e73df";


							break;

						case 'Consultation':

							$class = "btn-danger";
							$dot_back_color = "#e74a3b";
							$appointment = $this->appointment_model->get_appointments_id($appointment_id);

							$visit_id = $appointment['visit_id'];

							if($visit_id != 0){

								$href = site_url("patient/edit_visit/" . $visit_id."/".$patient_id );

							}else{

								$href = site_url("patient/visit/" . $patient_id ."/" . $appointment_id) ;

							}

							//$href = site_url("patient/edit_visit/" . $visit_id."/".$patient_id );

							break;

						case 'Complete':

							$class = "btn-success";
							$dot_back_color = "#1cc88a";
							$href = site_url("appointment/view_appointment	/". $appointment_id ) ;

							break;

						case 'Cancel':

							$class = "btn-info";
							$dot_back_color = "#36b9cc";
							break;

						case 'Waiting':

							if ($level == 'Nurse') {

								$href = site_url("patient/visit/" . $patient_id."/".$appointment_id );

							}

							$class = "btn-warning";
							$dot_back_color = "#f6c23e";

							break;

						case 'Pending':

							$class = "btn_pending";
							$dot_back_color = "#FF8404";
							break;

						default:

							$class = "btn-primary";

							break;

					}

				}

				/*

				$row['start_position'] = $start_position;

				$row['end_position'] = $end_position;

				$row['href'] = $href;

				$row['appointment_title'] = $appointment_title;

				$row['appointment_class'] = $class;

				$row['next_link'] = $next_link;

				$row['cancel_link'] = $cancel_link;

				*/

				

				$row['title'] = substr($appointment_title,0);

				$row['resource'] = $appointment['doctor_id'];

				$row['event_class'] = $class;
				$row['dot_back_color'] = $dot_back_color;

				$row['fromTime'] = substr($appointment['start_time'],0,-3);

				$row['toTime'] =substr($appointment['end_time'],0,-3);

				$row['url'] = $href;
				

				$appointment_array[] = $row;

			}

			echo json_encode($appointment_array);

	}

	public function index($year = NULL, $month = NULL, $day = NULL) {

		// Check If user has logged in or not

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index');

        }else if (!$this->menu_model->can_access("appointments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {
			$timezone = $this->settings_model->get_time_zone();

			if (function_exists('date_default_timezone_set'))

				date_default_timezone_set($timezone);


			//echo($day);
			//Default to today's date if date is not mentioned

            if ($year == NULL) { $year = date("Y"); }

            if ($month == NULL) { $month = date("m"); }

            if ($day == NULL) { $day = date("d");}



            $data['year'] = $year;

            $data['month'] = $month;

            $data['day'] = $day;
			//echo($day);


			//Fetch Time Interval from settings

            $data['time_interval'] = $this->settings_model->get_time_interval();

			$data['time_format'] = $this->settings_model->get_time_formate();
			
			$data['def_dateformate'] = $this->settings_model->get_date_formate();

			$data['morris_dateformate'] = $this->settings_model->get_morris_date_format();

			$data['def_timeformate'] = $this->settings_model->get_time_formate();

			$data['morris_date_format'] = $this->settings_model->get_morris_date_format();

			$data['morris_time_format'] = $this->settings_model->get_morris_time_format();



			//Generate display date in YYYY-MM-DD formate

            //$appointment_date = date("Y-n-d", gmmktime(0, 0, 0, $month, $day, $year));

			$appointment_date = $year ."-". $month."-".$day;

			$data['appointment_date'] = $appointment_date;



			//Fetch Task Details

            $data['todos'] = $this->appointment_model->get_todos();

			$data['def_dateformate'] = $this->settings_model->get_date_formate();

			//Display Followups for next 8 days

			$followup_date = date('Y-m-d', strtotime("+8 days"));

			//Fetch Level of Current User

			$level = $this->session->userdata('category');

			$data['level'] = $level;

			if ($level == 'Doctor') {

				//Fetch this doctor's appointments for the date

                $user_id = $this->session->userdata('id');

				$data['doctor']=$this->admin_model->get_doctor($user_id);

				$doctor_id = $data['doctor']['doctor_id'];

				$data['doctor_id']=$doctor_id;

			}else{

				$user_id = 0;

				$doctor_id = 0;

			}



			$data['followups'] = $this->patient_model->get_followups($followup_date,$doctor_id);



			//Fetch all patient details

			$data['patients'] = $this->patient_model->get_patient();

			//Fetch Doctor Schedules

			$doctor_active=$this->module_model->is_active("doctor");

			$data['doctor_active']=$doctor_active;



			if($doctor_active){

				$this->load->model('doctor/doctor_model');

				$data['doctors_data'] = $this->doctor_model->find_doctor();

				$data['drschedules'] = $this->doctor_model->find_drschedule();

				$data['inavailability'] = $this->appointment_model->get_dr_inavailability();

			}

			$data['exceptional_days']= $this->settings_model->get_exceptional_days();



			$centers_active=$this->module_model->is_active("centers");



			if($centers_active){

				$clinic_id = $this->session->userdata('clinic_id');

				$data['working_days']= $this->settings_model->get_working_days_for_clinic($clinic_id);



				//Fetch Clinic Start Time and Clinic End Time

				$data['start_time'] = $this->settings_model->get_clinic_start_time($clinic_id);

				$data['end_time'] = $this->settings_model->get_clinic_end_time($clinic_id);



			}else{

				$data['working_days']= $this->settings_model->get_working_days();

				$data['start_time'] = $this->settings_model->get_clinic_start_time(1);

				$data['end_time'] = $this->settings_model->get_clinic_end_time(1);

			}

			

			//For Doctor's login

            if ($level == 'Doctor') {

				//Fetch this doctor's appointments for the date

                $user_id = $this->session->userdata('id');

				$data['appointments'] = $this->appointment_model->get_appointments($appointment_date,$doctor_id);



            } else {

				//Fetch appointments for the date

                $data['appointments'] = $this->appointment_model->get_appointments($appointment_date);

            }

			//Fetch details of all Doctors

			$data['doctors'] = $this->doctor_model->get_doctors();

			//Load the view

			$header_data = get_header_data();

			$this->load->view('templates/header',$header_data);

			$this->load->view('templates/menu');

			$this->load->view('browse', $data);

			$this->load->view('templates/footer');

        }

	}
	
	/** Edit fetch appointmnets */
	public function ajax_fetch_edit_appointment() {

		$appointment_id = $this->input->post('appointment_id');
		$appointment = $this->appointment_model->get_appointments_id($appointment_id);
		echo json_encode($appointment);
	}

	/** Add Appointment */
	public function ajax_add_appointment() {

		$patient_id = $this->input->post('patient_id');
		$doctor_id = $this->input->post('doctor_id');
		$title = $this->input->post('title');
		$appointment_date = date("Y-m-d", strtotime($this->input->post('appointment_date')));
        $start_time = date("H:i:s",strtotime($this->input->post('start_time'))); //Do Not Use Time Format
		$end_time = date("H:i:s",strtotime($this->input->post('end_time'))); //Do Not Use Time Format
		$appointment_reason = $this->input->post('appointment_reason');

		$appointment_data['appointment_reason'] = $appointment_reason;
		$appointment_data['appointment_date'] = $appointment_date;
        $appointment_data['start_time'] = $start_time;
		$appointment_data['end_time'] = $end_time;
		$appointment_data['status'] = 'Appointments';
		$appointment_data['patient_id'] = $patient_id;
		$appointment_data['doctor_id'] = $doctor_id;
		$appointment_data['title'] = $title;

		$appointment_id = $this->appointment_model->ajax_add_appointment($appointment_data);
	
		$data2['appointment_id'] = $appointment_id;
		$data2['appointment_reason'] = $appointment_reason;
		$data2['change_date_time'] = date('d/m/Y H:i:s'); //Do not use Time Format
		$data2['start_time'] = $start_time;
		$data2['old_status'] = " ";
		$data2['status'] = 'Appointment';
		$data2['from_time'] = date('H:i:s'); //Do not use Time Format
		$data2['to_time'] = " ";
		$data2['name'] = $this->session->userdata('name');
		$data2['clinic_code'] = $this->session->userdata('clinic_code');

		$this->appointment_model->ajax_add_appointment($data2);

		$year = date("Y", strtotime($this->input->post('appointment_date')));
		$month = date("m", strtotime($this->input->post('appointment_date')));
		$day = date("d", strtotime($this->input->post('appointment_date')));

		echo  $appointment_id;		
        
	}
	

	/*public function add($show_date=NULL,$appoinment_time=NULL,$year = NULL, $month = NULL, $day = NULL, $hour = NULL, $min = NULL,$status = NULL,$patient_id=NULL,$doctor_id=NULL,$session_date_id=NULL) {

		//Check if user has logged in

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index');

        } else {

			$timezone = $this->settings_model->get_time_zone();

			if (function_exists('date_default_timezone_set'))

				date_default_timezone_set($timezone);



			$level = $this->session->userdata('category');

			$data['level'] = $level;

            if ($year == NULL) { $year = date("Y");}

            if ($month == NULL) { $month = date("m");}

            if ($day == NULL) { $day = date("d");}



			if ($hour == NULL) { $hour = date("H");}

            if ($min == NULL) { $min = date("i");}



			$data['year'] = $year;

			$data['month'] = $month;

			$data['day'] = $day;



            $today = date('Y-m-d');



			$data['hour'] = $hour;

			$data['min'] = $min;

			//$time = $hour . ":" . $min;

			$time = $appoinment_time;

           // $appointment_dt = date("Y-m-d", strtotime($year."-".$month."-".$day));

            $appointment_dt = date("Y-m-d", strtotime($show_date));



            $data['appointment_date'] = $appointment_dt;

			$data['appointment_time'] = $time;

			$data['appointment_id']=0;

			if($status == NULL){

				$data['app_status'] = 'Appointments';

			}else{

				$data['app_status']=$status;

			}



			$data['session_date_id']=$session_date_id;

			//Form Validation Rules

			$this->form_validation->set_rules('patient_id', $this->lang->line('patient_id'), 'required');

			$this->form_validation->set_rules('doctor_id', $this->lang->line('doctor_id'), 'required|callback_is_available');

			$this->form_validation->set_rules('start_time', $this->lang->line('start_time'), 'required|callback_validate_time');

			$this->form_validation->set_rules('end_time', $this->lang->line('end_time'), 'required|callback_validate_time');

			$this->form_validation->set_rules('appointment_date', $this->lang->line('appointment_date'), 'required');



			if ($this->form_validation->run() === FALSE){

				$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();

				$data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();

				$data['time_interval'] = $this->settings_model->get_time_interval();

				$data['patients'] = $this->patient_model->get_patient();

				$data['def_dateformate'] = $this->settings_model->get_date_formate();

				$data['morris_dateformate'] = $this->settings_model->get_morris_date_format();

				$data['def_timeformate'] = $this->settings_model->get_time_formate();

				$data['morris_date_format'] = $this->settings_model->get_morris_date_format();

				$data['morris_time_format'] = $this->settings_model->get_morris_time_format();

				$data['working_days']=$this->settings_model->get_exceptional_days();

				if ($patient_id) {

					$data['curr_patient'] = $this->patient_model->get_patient_detail($patient_id);

				}

				if ($level == 'Doctor'){

					$user_id = $this->session->userdata('id');

					$data['doctors'] = $this->admin_model->get_doctor();

					$data['doctor']=$this->admin_model->get_doctor($user_id);

					$data['selected_doctor_id'] = $doctor_id;

				}else{

					$data['doctors'] = $this->admin_model->get_doctor();

					$data['doctor']=$this->doctor_model->get_doctor_details($doctor_id);

				}

				$data['reference_by'] = $this->settings_model->get_reference_by();

				$data['selected_doctor_id'] = $doctor_id;





        $header_data = get_header_data();

      	$this->load->view('templates/header',$header_data);

				$this->load->view('templates/menu');

				$this->load->view('form', $data);

				$this->load->view('templates/footer');

			}else{

				//$appointment_id = $this->appointment_model->add_appointment($status);

				$appointment_id = $this->appointment_model->add_appointment($data['app_status']);

				$patient_id = $this->input->post('patient_id');

				$doctor_id = $this->input->post('doctor_id');



				$year = date("Y", strtotime($this->input->post('appointment_date')));

				$month = date("m", strtotime($this->input->post('appointment_date')));

				$day = date("d", strtotime($this->input->post('appointment_date')));



				$active_modules = $this->module_model->get_active_modules();

				if (in_array("sessions", $active_modules)) {

					$session_date_id = $this->input->post('session_date_id');

					if($session_date_id != NULL){

						$this->load->model('sessions/sessions_model');

						$this->sessions_model->update_appointment_id($session_date_id,$appointment_id);

					}

				}

				if (in_array("alert", $active_modules)) {

					//Send Alert : new_appointment

					redirect('alert/send/new_appointment/0/0/'.$appointment_id.'/0/0/0/appointment/index/'.$year.'/'.$month.'/'.$day);

				}else{

					if($this->input->post('submit') == "save_and_bill"){

						redirect('bill/insert/'.$patient_id.'/'.$doctor_id.'/'.$appointment_id);

					}else{

						redirect('appointment/index/'.$year.'/'.$month.'/'.$day);

					}

				}

			}

        }

	}*/

	public function add($a_date=NULL,$year = NULL, $month = NULL, $day = NULL, $hour = NULL, $min = NULL,$status = NULL,$patient_id=NULL,$doctor_id=NULL,$session_date_id=NULL) {

		//Check if user has logged in

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index');

        }else if (!$this->menu_model->can_access("appointments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {

			$timezone = $this->settings_model->get_time_zone();

			if (function_exists('date_default_timezone_set'))

				date_default_timezone_set($timezone);



			$level = $this->session->userdata('category');

			$data['level'] = $level;

            if ($year == NULL) { $year = date("Y");}

            if ($month == NULL) { $month = date("m");}

            if ($day == NULL) { $day = date("d");}

			if ($hour == NULL  ) { $hour = date("H");}

			if ($min == NULL ) { $min = date("i");}

			if ($a_date == NULL ) { $a_date = date("d");}
		
			$data['a_date'] = $a_date;

			$data['year'] = $year;

			$data['month'] = $month;

			$data['day'] = $day;

            $today = date('Y-m-d');

			$data['hour'] = $hour;

			$data['min'] = $min;

			$time = $hour . ":" . $min;

			$appointment_dt = date("Y-m-d", strtotime($year."-".$month."-".$a_date));

			$data['appointment_date'] = $appointment_dt;
			$data['appointment_time'] = $time;
			$data['appointment_id']=0;

			if($status == NULL){
				$data['app_status'] = 'Appointments';
			}else{
				$data['app_status']=$status;
			}
			$data['session_date_id']=$session_date_id;

			//Form Validation Rules

			$this->form_validation->set_rules('patient_id', $this->lang->line('patient_id'), 'required');

			$this->form_validation->set_rules('doctor_id', $this->lang->line('doctor_id'), 'required|callback_is_available');

			$this->form_validation->set_rules('start_time', $this->lang->line('start_time'), 'required|callback_validate_time');

			$this->form_validation->set_rules('end_time', $this->lang->line('end_time'), 'required|callback_validate_time');

			$this->form_validation->set_rules('appointment_date', $this->lang->line('appointment_date'), 'required');



			if ($this->form_validation->run() === FALSE){

				$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();

				$data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();

				$data['time_interval'] = $this->settings_model->get_time_interval();

				$data['patients'] = $this->patient_model->get_patient();

				$data['def_dateformate'] = $this->settings_model->get_date_formate();

				$data['morris_dateformate'] = $this->settings_model->get_morris_date_format();

				$data['def_timeformate'] = $this->settings_model->get_time_formate();

				$data['morris_date_format'] = $this->settings_model->get_morris_date_format();

				$data['morris_time_format'] = $this->settings_model->get_morris_time_format();

				$data['working_days']=$this->settings_model->get_exceptional_days();

				if ($patient_id) {

					$data['curr_patient'] = $this->patient_model->get_patient_detail($patient_id);

				}
				$user_id = $this->session->userdata('id');
				if ($this->doctor_model->is_doctor($user_id)) {

					$user_id = $this->session->userdata('id');

					$data['doctors'] = $this->admin_model->get_doctor();

					$data['doctor']=$this->admin_model->get_doctor($user_id);

					$data['selected_doctor_id'] = $doctor_id;

				}else{

					$data['doctors'] = $this->admin_model->get_doctor();

					$data['doctor']=$this->doctor_model->get_doctor_details($doctor_id);

				}

				$data['reference_by'] = $this->settings_model->get_reference_by();

				$data['selected_doctor_id'] = $doctor_id;

				$user_id = $this->session->userdata('user_id');

				$clinic_id = $this->session->userdata('clinic_id');

				


				 $header_data = get_header_data();

      			$this->load->view('templates/header',$header_data);

				$this->load->view('templates/menu');

				$this->load->view('form', $data);

				$this->load->view('templates/footer');


			}else{

				$appointment_id = $this->appointment_model->add_appointment($status);

				$patient_id = $this->input->post('patient_id');

				$doctor_id = $this->input->post('doctor_id');



				$year = date("Y", strtotime($this->input->post('appointment_date')));

				$month = date("m", strtotime($this->input->post('appointment_date')));

				$day = date("d", strtotime($this->input->post('appointment_date')));



				$active_modules = $this->module_model->get_active_modules();

				if (in_array("sessions", $active_modules)) {

					$session_date_id = $this->input->post('session_date_id');

					if($session_date_id != NULL){

						$this->load->model('sessions/sessions_model');

						$this->sessions_model->update_appointment_id($session_date_id,$appointment_id);

					}

				}

				if (in_array("alert", $active_modules)) {

					//Send Alert : new_appointment

					redirect('alert/send/new_appointment/0/0/'.$appointment_id.'/0/0/0/appointment/index/'.$year.'/'.$month.'/'.$day);

				}else{

					if($this->input->post('submit') == "save_and_bill"){

						redirect('bill/insert/'.$patient_id.'/'.$doctor_id.'/'.$appointment_id);

					}else{

						redirect('appointment/index/'.$year.'/'.$month.'/'.$day);

					}

				}

			}

        }

    }


	public function validate_time(){

		$appointment_date = date("Y-m-d", strtotime($this->input->post('appointment_date')));

		$start_time = $this->input->post('start_time');

		$end_time = $this->input->post('end_time');

		$doctor_id = $this->input->post('doctor_id');

		$appointment_id = $this->input->post('appointment_id');

		$edit = FALSE;

		if($appointment_id != 0 ){

			$edit = TRUE;

		}

		//Check for working day

		$working_day = $this->settings_model->get_exceptional_day_by_date($appointment_date);

		if($working_day['working_status'] == 'Non Working'){

			$this->form_validation->set_message('validate_time',$this->lang->line('non_working'));

			return FALSE;

		}

		//Check for Half Day

		if($working_day['working_status'] == 'Half Day'){



			//Check time slot

				$s_time=strtotime(substr($working_day['start_time'],0,5));

				$e_time=strtotime(substr($working_day['end_time'],0,5));

				$start_time=strtotime(substr($start_time,0,5));

				$end_time=strtotime(substr($end_time,0,5));

				//echo $s_time."=s_time ".$e_time."e_time ".$start_time."start ".$end_time."end<br/>";

				if(($start_time>=$s_time) && ($start_time<$e_time)){

					$this->form_validation->set_message('validate_time',$this->lang->line('half_day')." (".$working_day['start_time']." to ".$working_day['end_time'].")");

						return false;

				}



		}



		//Check For Maximum Patients allowed

		$clinic = $this->settings_model->get_clinic();

		$max_patient = $clinic['max_patient'];
		

		$is_doctor_active = $this->module_model->is_active("doctor");

		//echo $is_doctor_active."<br/>";

		if($is_doctor_active){

			$this->load->model('doctor/doctor_model');

			$doctor_preference = $this->doctor_model->get_doctor_preference($doctor_id);

			if(isset($doctor_preference)){

				$max_patient = $doctor_preference['max_patient'];

				//print_r($doctor_preference);

			}

		}



		$appointments = $this->appointment_model->get_appointments_between_times($appointment_date,$appointment_date,$start_time,$end_time,$doctor_id);
		$clinic_start_time=$clinic['start_time'];
		$clinic_end_time=$clinic['end_time'];
			if($max_patient > 0){
				if(strtotime($clinic_start_time)<=strtotime($start_time) && strtotime($clinic_end_time)>=strtotime($end_time)){
					if($edit){

						$count = 0;

						foreach($appointments as $appointment){

							if($appointment['appointment_id'] != $appointment_id ){

								$count++;

							}

							if($count+1 > $max_patient){

								$this->form_validation->set_message('validate_time',$this->lang->line('time_booked'));

								return FALSE;

							}

						}

					}else{

						//echo "Count".count($appointments);

						if((count($appointments) + 1 )> $max_patient){

							$this->form_validation->set_message('validate_time',$this->lang->line('time_booked'));

							return FALSE;

						}
						
					}
					return TRUE;
				}else{
					
					$this->form_validation->set_message('validate_time',$this->lang->line('clinic_close'));
					return FALSE;
				}
				return TRUE;

			}else{

				return TRUE;

			}
		return TRUE;

	}

	public function is_available(){

		$appointment_date = date("Y-m-d", strtotime($this->input->post('appointment_date')));

		$start_time = date("H:i:s", strtotime($this->input->post('start_time')));

		$end_time = date("H:i:s", strtotime($this->input->post('end_time')));

		$doctor_id = $this->input->post('doctor_id');

		$this->form_validation->set_message('is_available',$this->lang->line('doctor_not_available'));

		$is_doctor_active = $this->module_model->is_active("doctor");

		$is_unavailable = $this->appointment_model->get_doctor_unavailability($appointment_date,$start_time,$end_time,$doctor_id,$is_doctor_active);

		return $is_unavailable;

	}

	public function edit_appointment($appointment_id) {

		//Check if user has logged in

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index');

        }else if (!$this->menu_model->can_access("appointments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {

			$this->form_validation->set_rules('patient_id', $this->lang->line('patient_id'), 'required');

			$this->form_validation->set_rules('doctor_id', $this->lang->line('doctor_id'), 'required|callback_is_available');

			$this->form_validation->set_rules('start_time', $this->lang->line('start_time'), 'required|callback_validate_time');

			$this->form_validation->set_rules('end_time', $this->lang->line('end_time'), 'required|callback_validate_time');

			$this->form_validation->set_rules('appointment_date', $this->lang->line('appointment_date'), 'required');

			if ($this->form_validation->run() === FALSE){

				$appointment = $this->appointment_model->get_appointments_id($appointment_id);

				$data['bill'] = $this->bill_model->get_bill_from_appointment_id($appointment_id);

				$data['appointment']=$appointment;

				$patient_id = $appointment['patient_id'];

				$data['curr_patient']=$this->patient_model->get_patient_detail($patient_id);

				$data['patients']=$this->patient_model->get_patient();

				$doctor_id = $appointment['doctor_id'];

				$data['doctors'] = $this->admin_model->get_doctor();

				$data['selected_doctor_id'] = $doctor_id;

				$data['doctor'] = $this->doctor_model->get_doctor_details($doctor_id);

				$data['def_dateformate'] = $this->settings_model->get_date_formate();

				$data['def_timeformate'] = $this->settings_model->get_time_formate();

				$data['working_days']=$this->settings_model->get_exceptional_days();



				$data['time_interval'] = $this->settings_model->get_time_interval();

				$data['clinic_start_time'] = $this->settings_model->get_clinic_start_time();

				$data['clinic_end_time'] = $this->settings_model->get_clinic_end_time();

				$data['morris_date_format'] = $this->settings_model->get_morris_date_format();

				$data['morris_time_format'] = $this->settings_model->get_morris_time_format();

				//Fetch Level of Current User

				$level = $this->session->userdata('category');

				$data['level'] = $level;



				$active_modules = $this->module_model->get_active_modules();

				if (in_array("sessions", $active_modules)){

					$this->load->model('sessions/sessions_model');



					$session_date = $this->sessions_model->get_session_date_id($appointment_id);

					$data['session_date_id']=$session_date['session_date_id'];

				}



				$header_data = get_header_data();

				

				$this->load->view('templates/header',$header_data);

				$this->load->view('templates/menu');

				$this->load->view('form', $data);

				$this->load->view('templates/footer');

			}else{

				$patient_id = $this->input->post('patient_id');

				$curr_patient = $this->patient_model->get_patient_detail($patient_id);

				$title = $curr_patient['first_name']." " .$curr_patient['middle_name'].$curr_patient['last_name'];

				$this->appointment_model->update_appointment($title);

				$year = date('Y', strtotime($this->input->post('appointment_date')));

				$month = date('m', strtotime($this->input->post('appointment_date')));

				$day = date('d', strtotime($this->input->post('appointment_date')));

				redirect('appointment/index/'.$year.'/'.$month.'/'.$day);

			}

		}

	}

	public function insert_patient_add_appointment($hour = NULL, $min =NULL, $appointment_date = NULL, $status = NULL, $doc_id = NULL,$pid=NULL,$appid=NULL) {

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index/');

        }else if (!$this->menu_model->can_access("appointments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {

            $this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'callback_validate_name');

            $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'callback_validate_name');



            if ($this->form_validation->run() === FALSE) {

				$this->add();

            }else{

				$contact_id = $this->contact_model->insert_contact();

				$today = date('Y-m-d');

                $patient_id = $this->patient_model->insert_patient($contact_id,$today);

				$show_date="0";

				$appoinment_time="0";
		
				$appointment_date = date('Y-m-d',strtotime($appointment_date));
				list($year, $month, $day) = explode('-', $appointment_date);
				redirect('appointment/add/'. $day . '/'. $year . '/' . $month . '/' . $day . '/' . $hour . '/' . $min . '/Appointments/' . $patient_id . "/" . $doc_id );
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

	public function change_status($appointment_id = NULL,$new_status = NULL) {

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index');

        }else if (!$this->menu_model->can_access("appointments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		}else{



			$this->appointment_model->change_status($appointment_id,$new_status);

			$appointment = $this->appointment_model->get_appointment_from_id($appointment_id);

			$appointment_date = $appointment['appointment_date'];

			$year = date("Y", strtotime($appointment_date));

            $month = date("m", strtotime($appointment_date));

            $day = date("d", strtotime($appointment_date));

			if($new_status == "Cancel"){

				$active_modules = $this->module_model->get_active_modules();

				if (in_array("sessions", $active_modules)) {

					$this->load->model('sessions/sessions_model');

					$this->sessions_model->remove_appointment_id($appointment_id);

				}

				if (in_array("alert", $active_modules)) {

					//Send Alert : appointment_cancel

					redirect('alert/send/appointment_cancel/0/0/'.$appointment_id.'/0/0/0/appointment/index/'.$year.'/'.$month.'/'.$day);

				}else{

					redirect('appointment/index/'.$year.'/'.$month.'/'.$day);

				}

			}elseif($new_status == "Complete"){

				$active_modules = $this->module_model->get_active_modules();

				if (in_array("alert", $active_modules)) {

					//Send Alert : appointment_complete

					redirect('alert/send/appointment_complete/0/0/'.$appointment_id.'/0/0/0/appointment/index/'.$year.'/'.$month.'/'.$day);

				}else{

					redirect('appointment/index/'.$year.'/'.$month.'/'.$day);

				}

			}else{

				redirect('appointment/index/'.$year.'/'.$month.'/'.$day);

			}

        }

    }

	public function change_status_visit($visit_id = NULL){

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index');

        } else {

            $this->appointment_model->change_status_visit($visit_id);

			redirect('appointment/index');

        }

	}

	public function view_appointment($appointment_id) {

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

			redirect('login/index');

        }else if (!$this->menu_model->can_access("appointments",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {

			$appointment = $this->appointment_model->get_appointments_id($appointment_id);

			$data['appointment']=$appointment;

			$patient_id = $appointment['patient_id'];

			$data['patient']=$this->patient_model->get_patient_detail($patient_id);

			$doctor_id = $appointment['doctor_id'];

			$data['doctor'] = $this->admin_model->get_doctor_by_doctor_id($doctor_id);

			$visit_id = $appointment['visit_id'];

			$data['visit'] = $this->appointment_model->get_visit_from_id($visit_id);

			$data['def_dateformate'] = $this->settings_model->get_date_formate();

			$data['def_timeformate'] = $this->settings_model->get_time_formate();

			$data['bill'] = $this->bill_model->get_bill_by_visit($visit_id);

			$data['bill_details'] = $this->bill_model->get_bill_detail_by_visit($visit_id);

			$data['particular_total'] = $this->patient_model->get_particular_total($visit_id);

			$data['active_modules'] = $this->module_model->get_active_modules();

			$active_modules=$data['active_modules'];


			if (in_array("history", $active_modules)){
				$this->load->model('history/history_model');
				$data['section_patient_master'] = $this->history_model->get_section_by_display_in("patient_detail");
				$data['section_patient_fields'] = $this->history_model->get_fields_by_display_in("patient_detail");
				$data['section_patient_conditions'] = $this->history_model->get_conditions_by_display_in("patient_detail");
				$data['field_patient_options'] = $this->history_model->get_field_options_by_display_in("patient_detail");
				$data['section_master'] = $this->history_model->get_section_by_display_in("visits");
				$data['section_fields'] = $this->history_model->get_fields_by_display_in("visits");
				$data['section_conditions'] = $this->history_model->get_conditions_by_display_in("visits");
				$data['field_options'] = $this->history_model->get_field_options_by_display_in("visits");
				$data['patient_detail_field_history'] = $this->history_model->get_patient_history_details_by_patient_id($patient_id);
		
				$doctor=array();
				$patient_history_details=array();
				//foreach($data['visits'] as $visit){
					$doctor_names[] = $this->doctor_model->get_doctor_details($doctor_id);
					$patient_history_details[] = $this->history_model->get_visit_history_details($visit_id);
				//}
				if(!empty($doctor_names)){
					$data['doctor_names']=$doctor_names;
				}else{
					$data['doctor_names']='';
				}
				$data['patient_history_details']=$patient_history_details;
			}
			
			$data['tax_type']=$this->settings_model->get_data_value('tax_type');

			if($data['tax_type'] == "item"){

				$data['particular_tax_total'] = $this->patient_model->get_tax_total("particular",$visit_id);

			}else{

				$data['particular_tax_total'] = $this->patient_model->get_total("tax",$visit_id);

			}

			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();

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

			$data['session_total'] = 0;

			$data['item_total'] = 0;

			$data['balance'] = 0;

			$bill_id = $this->bill_model->get_bill_id($visit_id);

			$data['paid_amount'] = $this->payment_model->get_paid_amount($bill_id);

			$data['discount'] = $this->bill_model->get_discount_amount($bill_id);

			$data['edit_bill'] = FALSE;



			$header_data = get_header_data();

				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
                $this->load->view('view_appointment', $data);
                $this->load->view('templates/footer');

			

		}

	}

    public function appointment_report_excel_export($result){

		$def_dateformate = $this->settings_model->get_date_formate();

		$def_timeformate = $this->settings_model->get_time_formate();



		$appointment_report = array();

		$i = 0;

		foreach($result as $row){

			$appointment_report[$i]['sr_no'] = $i+1;

			$appointment_report[$i]['clinic_name'] = $row['clinic_name'];

			$appointment_report[$i]['doctor_name'] = $row['doctor_name'];

			$appointment_report[$i]['patient_name'] = $row['patient_name'];

			$appointment_report[$i]['appointment_date'] = date($def_dateformate,strtotime($row['appointment_date']));

			$appointment_report[$i]['appointment_time'] = $row['appointment_time'];

			$appointment_report[$i]['waiting_in'] = $row['waiting_in'];

			$waiting_duration = "--";

			if(isset($row['waiting_in']) && isset($row['consultation_in'])){

				$waiting_duration = inttotime((strtotime($row['consultation_in'])-strtotime($row['waiting_in']))/60/60);

			}

			if($waiting_duration != "--") {

				$appointment_report[$i]['waiting_duration'] = date('H:i:s',strtotime($waiting_duration));

			} else{

				$appointment_report[$i]['waiting_duration'] = $waiting_duration;

			}

			$appointment_report[$i]['consultation_in'] = $row['consultation_in'];

			$appointment_report[$i]['consultation_out'] = $row['consultation_out'];

			$consultation_duration = "--";

			if(isset($row['consultation_out']) && isset($row['consultation_in'])){

				$consultation_duration = inttotime((strtotime($row['consultation_out'])-strtotime($row['consultation_in']))/60/60);

			}

			if($consultation_duration != "--") {

				$appointment_report[$i]['consultation_duration'] = date('H:i:s',strtotime($consultation_duration));

			} else{

				$appointment_report[$i]['consultation_duration'] = $consultation_duration;

			}

			$i++;

		}

		$this->export->to_excel($appointment_report, 'appointment_report');

	}

	public function print_appointment_report($report){

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index');

        }else if (!$this->menu_model->can_access("appointment_report",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {

			$data['active_modules'] = $this->module_model->get_active_modules();

			$data['def_dateformate'] = $this->settings_model->get_date_formate();

			$data['app_reports'] = $report;

			$this->load->view('appointment/print_report', $data);

		}

	}

	public function appointment_report() {

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {

            redirect('login/index');

        }else if (!$this->menu_model->can_access("appointment_report",$this->session->userdata('category'))){
			$header_data = get_header_data();
			$this->load->view('templates/header',$header_data);
		 	$this->load->view('templates/menu');
			$this->load->view('templates/access_forbidden');
			$this->load->view('templates/footer');
		} else {

			$data['active_modules'] = $this->module_model->get_active_modules();

			$data['clinics']=$this->settings_model->get_all_clinics();

			$active_modules=$data['active_modules'];

            $data['doctors'] = $this->admin_model->get_doctor();

            $level = $this->session->userdata('category');

            $data['currency_postfix'] = $this->settings_model->get_currency_postfix();

			$data['def_dateformate'] = $this->settings_model->get_date_formate();

			$data['patients'] = $this->patient_model->get_patient();

            if ($level == 'Doctor'){

				$user_id = $this->session->userdata('id');

				$data['doctor']=$this->admin_model->get_doctor($user_id);

				$doctor_id = $data['doctor']['doctor_id'];



                $this->form_validation->set_rules('from_date', $this->lang->line('from_date'), 'required');

				$this->form_validation->set_rules('to_date', $this->lang->line('to_date'), 'required');

                if ($this->form_validation->run() === FALSE) {

					$timezone = $this->settings_model->get_time_zone();

					if (function_exists('date_default_timezone_set'))

						date_default_timezone_set($timezone);

					$from_date = date('Y-m-d');

					$to_date = date('Y-m-d');

					$data['from_date'] = $from_date;

					$data['to_date'] = $to_date;



					$data['app_reports'] = $this->appointment_model->get_report($from_date, $to_date, $doctor_id,$patient_id);



                } else {

                    $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));

					$data['from_date'] = $from_date;

					$to_date = date('Y-m-d', strtotime($this->input->post('to_date')));

					$data['to_date'] = $to_date;

                    $data['app_reports'] = $this->appointment_model->get_report($from_date, $to_date, $doctor_id,$patient_id);

                }

				$data['doctor_id'] = $doctor_id;

				//var_dump($data);

				$header_data = get_header_data();



				//$this->load->view('templates/header_chikitsa',$header_data);

				$this->load->view('templates/header',$header_data);

                $this->load->view('templates/menu');

                $this->load->view('appointment/report', $data);

                $this->load->view('templates/footer');

            }else{

				$timezone = $this->settings_model->get_time_zone();

				if (function_exists('date_default_timezone_set'))

					date_default_timezone_set($timezone);



					$user_id = $this->session->userdata('id');

					$to_date = NULL;

					$from_date = NULL;

					$doctor_id = NULL;

					$clinic_id = NULL;

					$patient_id = NULL;



					if($this->input->post('from_date')){

						$from_date = date('Y-m-d', strtotime($this->input->post('from_date')));

					}

					if($this->input->post('to_date')){

						$to_date = date('Y-m-d', strtotime($this->input->post('to_date')));

					}

					if($this->input->post('doctor')){

						$doctor_id = $this->input->post('doctor');

					}

					if($this->input->post('clinic')){

						$clinic_id = $this->input->post('clinic');

					}

					if($this->input->post('patient_id')){

						$patient_id = $this->input->post('patient_id');

						$data['curr_patient'] = $this->patient_model->get_patient_detail($patient_id);

					}

					$data['from_date'] = $from_date;

					$data['to_date'] = $to_date;

					$data['doctor_id'] = $doctor_id;

					$data['clinic_id'] = $clinic_id;

					$data['patient_id'] = $patient_id;



					$data['app_reports'] = $this->appointment_model->get_report($from_date,$to_date, $doctor_id,$patient_id,$clinic_id);



					if($this->input->post('export_to_excel')!== NULL){

						$this->appointment_report_excel_export($data['app_reports']);

					}elseif($this->input->post('print_report')!== NULL){

						$this->print_appointment_report($data['app_reports']);

					}else{

						$clinic_id = $this->session->userdata('clinic_id');

						$header_data = get_header_data();



						$this->load->view('templates/header',$header_data);

						$this->load->view('templates/menu');

						$this->load->view('appointment/report', $data);

						$this->load->view('templates/footer');

					}



            }

        }

    }

    public function todos() {

		$this->form_validation->set_rules('task', $this->lang->line('task'), 'required');

        if ($this->form_validation->run() === FALSE) {

		}else{

			$this->appointment_model->add_todos();

		}

        redirect('appointment/index');

    }

    public function todos_done($done, $id) {

        $this->appointment_model->todo_done($done, $id);

    }

    public function delete_todo($id) {

        $this->appointment_model->delete_todo($id);

        redirect('appointment/index');

    }

	public function select_doctors(){

		$selected_doctors = "";

		if($this->input->post('select_doctor[]')){

			$selected_doctors = implode(",",  $this->input->post('select_doctor[]'));

		}

		$this->session->set_userdata('selected_doctors', $selected_doctors);



		$date = $this->input->post('select_doctor_date');

		$year = date("Y",strtotime($date));

        $month = date("m",strtotime($date));

        $day = date("d",strtotime($date));

		$this->index($year, $month, $day);

	}

}

?>