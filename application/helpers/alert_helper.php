<?php

/*********************************Functions to Fetch Data*********************************************/
function get_appointment_time($appointment_id){
	$CI =& get_instance();
	$CI->load->model('appointment/appointment_model');
	$appointment = $CI->appointment_model->get_appointment_from_id($appointment_id);
	return $appointment['start_time'];
}
function get_appointment_date($appointment_id){
	$CI =& get_instance();
	$CI->load->model('appointment/appointment_model');
	$appointment = $CI->appointment_model->get_appointment_from_id($appointment_id);
	return $appointment['appointment_date'];
}
function get_clinic_name(){
	$CI =& get_instance();
	$CI->load->model('settings/settings_model');
	return $CI->settings_model->get_clinic_name();
}
function get_data($key){
	$CI =& get_instance();
	$CI->load->model('settings/settings_model');
	return $CI->settings_model->get_data_value($key);
}
function get_doctor_id_from_appointment($appointment_id){
	$CI =& get_instance();
	$CI->load->model('appointment/appointment_model');
	$appointment = $CI->appointment_model->get_appointment_from_id($appointment_id);
	return $appointment['doctor_id'];
}
function get_doctor_name($doctor_id){
	$CI =& get_instance();
	$CI->load->model('admin/admin_model');
	$doctor =  $CI->admin_model->get_user_detail($doctor_id);
	return $doctor['name'];
}
function get_email_id_patient($patient_id){
	$CI =& get_instance();
	$CI->load->model('patient/patient_model');	
	$CI->load->model('contact/contact_model');
	$contact_id = $CI->patient_model->get_contact_id($patient_id);
	return $CI->contact_model->get_contact_email($contact_id);
}
function get_mobile_number_patient($patient_id){
	$CI =& get_instance();
	$CI->load->model('patient/patient_model');	
	$CI->load->model('contact/contact_model');
	$contact_id = $CI->patient_model->get_contact_id($patient_id);
	return $CI->contact_model->get_contact_number($contact_id);
}
function get_mobile_number_doctor($doctor_id){
	$CI =& get_instance();
	$CI->load->model('doctor/doctor_model');	
	$CI->load->model('contact/contact_model');
	$doctor = $CI->doctor_model->get_doctor_user_id($doctor_id);
	$contact_id = $doctor['contact_id'];
	return $CI->contact_model->get_contact_number($contact_id);
}
function get_patient_display_id($patient_id){
	$CI =& get_instance();
	$CI->load->model('patient/patient_model');
	$patient = $CI->patient_model->get_patient_detail($patient_id);
	return $patient['display_id'];
}
function get_patient_id($contact_id){
	$CI =& get_instance();
	$CI->load->model('patient/patient_model');
	return $CI->patient_model->get_patient_id_from_contact_id($contact_id);
}
function get_patient_id_from_appointment($appointment_id){
	$CI =& get_instance();
	$CI->load->model('appointment/appointment_model');
	$appointment = $CI->appointment_model->get_appointment_from_id($appointment_id);
	return $appointment['patient_id'];
}
function get_patient_id_from_visit($visit_id){
	$CI =& get_instance();
	$CI->load->model('patient/patient_model');
	$visit = $CI->patient_model->get_visit_data($visit_id);
	return $visit['patient_id'];
}
function get_patient_name($patient_id){
	$CI =& get_instance();
	$CI->load->model('patient/patient_model');
	$patient = $CI->patient_model->get_patient_detail($patient_id);
	return $patient['first_name']." ".$patient['middle_name']." ".$patient['last_name'];
}


/*********************************Functions to Check How and If to Send Alert **********************/
function generate_message($template,$patient_id,$doctor_id,$appointment_id,$visit_id){
	//Clinic Name
	$clinic_name = get_clinic_name();
	$template = str_replace("[clinic_name]", $clinic_name, $template);
	if($patient_id != NULL){
		//Patient Name
		$patient_name = get_patient_name($patient_id);
		$template = str_replace("[patient_name]", $patient_name, $template);
		//Patient ID
		$display_id = get_patient_display_id($patient_id);
		$template = str_replace("[patient_id]", $display_id, $template);
	}
	if($doctor_id != NULL){
		//Doctor Name
		$doctor_name = get_doctor_name($doctor_id);
		$template = str_replace("[doctor_name]", $doctor_name, $template);
	}
	if($appointment_id != NULL){
		//Appointment Time
		$appointment_time = get_appointment_time($appointment_id);
		$template = str_replace("[appointment_time]", $appointment_time, $template);
		//Appointment Date
		$appointment_date = get_appointment_date($appointment_id);
		$appointment_date = date('d-m-Y',strtotime($appointment_date));
		$template = str_replace("[appointment_date]", $appointment_date, $template);
	}
	if($visit_id != NULL){
		$bill_copy = get_print_receipt($visit_id);
		$template = str_replace("[bill]", $bill_copy, $template);	
	}
	return $template;
}

function get_print_receipt($visit_id){
	$CI =& get_instance();
	$CI->load->model('module/module_model');
	$CI->load->model('patient/patient_model');
	$CI->load->model('payment/payment_model');
	$CI->load->model('settings/settings_model');
	
	$currency_postfix = $CI->settings_model->get_currency_postfix();
	$def_dateformate = $CI->settings_model->get_date_formate();
	$def_timeformate = $CI->settings_model->get_time_formate();
	$invoice = $CI->settings_model->get_invoice_settings();
			
	$active_modules = $CI->module_model->get_active_modules();
	$bill_id = $CI->patient_model->get_bill_id($visit_id);
	
	$particular_total = $CI->patient_model->get_particular_total($visit_id);
    if (in_array("treatment", $active_modules)) {
		$treatment_total = $CI->patient_model->get_treatment_total($visit_id);
	}
	if (in_array("doctor", $active_modules)) {
		$fees_total = $CI->patient_model->get_fee_total($visit_id);
	}
	$item_total = $CI->patient_model->get_item_total($visit_id);
    
	$paid_amount = $CI->payment_model->get_paid_amount($bill_id);
	
	$receipt_template = $CI->patient_model->get_template();
	
	$template = $receipt_template['template'];
	
	$clinic = $CI->settings_model->get_clinic_settings();
	//Clinic Details
	$clinic_array = array('clinic_name','tag_line','clinic_address','landline','mobile','email');
	foreach($clinic_array as $clinic_detail){
		$template = str_replace("[$clinic_detail]", $clinic[$clinic_detail], $template);
	}
			
	//Bill Details
	$bill_array = array('bill_date','bill_id');
	$bill = $CI->patient_model->get_bill($visit_id);
	$patient_id = $bill['patient_id'];
	$bill_details = $CI->patient_model->get_bill_detail($visit_id);
	foreach($bill_array as $bill_detail){
		if($bill_detail == 'bill_date'){
			$bill_date = date($def_dateformate, strtotime($bill['bill_date']));
			$template = str_replace("[bill_date]", $bill_date, $template);
		}elseif($bill_detail == 'bill_id'){
			$bill_id = $invoice['static_prefix'] . sprintf("%0" . $invoice['left_pad'] . "d", $bill['bill_id']);
			$template = str_replace("[bill_id]", $bill_id, $template);
		}else{
			$template = str_replace("[$bill_detail]", $bill[$bill_detail], $template);
		}
	}
	//Patient Details
	$patient = $CI->patient_model->get_patient_detail($patient_id);
	$patient_array = array('patient_name');
	foreach($patient_array as $patient_detail){
		if($patient_detail == 'patient_name'){
			$patient_name = $patient['first_name']." ".$patient['middle_name']." ".$patient['last_name'];
			$template = str_replace("[patient_name]",$patient_name, $template);
		}else{
			$template = str_replace("[$patient_detail]", $patient[$patient_detail], $template);
		}
	}
			
	//Bill Columns
	$start_pos = strpos($template, '[col:');
	$item_table = "";
	$particular_table = "";
	$treatment_table = "";
	$fees_table = "";
	$col_string = "";
	
	$particular_amount = 0;
	$item_amount = 0;
	$treatment_amount = 0;
	$fees_amount = 0;
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
					if($col =='mrp' || $col =='amount'){
						$particular_table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
						$particular_table .= currency_format($bill_detail[$col])."</td>";
					}else{
						$particular_table .= "<td style='padding:5px;border:1px solid black;'>";
						$particular_table .= $bill_detail[$col]."</td>";
					}
				}
				$particular_table .= "</tr>";
				$particular_amount = $particular_amount + $bill_detail['amount'];
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
					}else{
						$treatment_table .= "<td style='padding:5px;border:1px solid black;'>";
						$treatment_table .= $bill_detail[$col]."</td>";
					}
					
				}
				$treatment_table .= "</tr>";
				$treatment_amount = $treatment_amount + $bill_detail['amount'];
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
			$particular_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Particular</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($particular_amount)."</strong></td></tr>";
		}
		if($item_table != ""){
			$item_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Items</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($item_amount)."</strong></td></tr>";
		}
		if($treatment_table != ""){	
			$treatment_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Treatment</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($treatment_amount)."</strong></td></tr>";
		}
		if($fees_table != ""){	
			$fees_table .= "<tr><td colspan='3' style='padding:5px;border:1px solid black;'><strong>Sub Total - Fees</strong></td><td style='text-align:right;padding:5px;border:1px solid black;'><strong>".currency_format($fees_amount)."</strong></td></tr>";
		}
	}
	$table = $particular_table . $item_table . $treatment_table .$fees_table;
	$template = str_replace("$col_string",$table, $template);
	
	$balance = $CI->patient_model->get_balance_amount($bill['bill_id']);
	$balance = currency_format($balance);
	$template = str_replace("[previous_due]",$balance, $template);
	
	$paid_amount = $CI->payment_model->get_paid_amount($bill['bill_id']);
	$paid_amount = currency_format($paid_amount);
	$template = str_replace("[paid_amount]",$paid_amount, $template);
	
	$discount_amount = $CI->patient_model->get_discount_amount($bill['bill_id']);
	$discount = currency_format($discount_amount);
	$template = str_replace("[discount]",$discount, $template);
	
	$total_amount = $particular_amount + $item_amount + $treatment_amount + $fees_amount - $discount_amount;
	$total_amount = currency_format($total_amount);
	$template = str_replace("[total]",$total_amount, $template);
	return $template;
}
function get_format($sms_format_name){
	$CI =& get_instance();
	$CI->load->model('settings/settings_model');
	return $CI->settings_model->get_data_value($sms_format_name);
}

function is_alert_enabled($alert_name){
	$CI =& get_instance();
	$CI->db->reconnect();
	$CI->load->model('alert/alert_model');
	return $CI->alert_model->is_alert_enabled($alert_name);
}

function send_sms($alert_name,$mobile_number,$message){ 
	//Get API URL
	$send_sms_url = get_data('send_sms_url');
	//Get Username
	$sms_api_username = get_data('sms_api_username');
	$send_sms_url = str_replace("[username]", $sms_api_username, $send_sms_url);
	//Get Password
	$sms_api_password = get_data('sms_api_password');
	$send_sms_url = str_replace("[password]", $sms_api_password, $send_sms_url);
	//Get Sender ID
	$senderid = get_data('senderid');
	$send_sms_url = str_replace("[senderid]", $senderid, $send_sms_url);
	//Mobile Number
	$send_sms_url = str_replace("[mobileno]", "91".$mobile_number, $send_sms_url);
	//Message
	$message = urlencode($message);
	$send_sms_url = str_replace("[message]", $message, $send_sms_url);
	echo $send_sms_url;
	//Call API
	// init the resource
	$options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 
	$ch = curl_init($send_sms_url);
	curl_setopt_array($ch, $options);

    $content  = curl_exec($ch);

    curl_close($ch);
	//echo $content;
}

function send_email($alert_name,$email_id,$subject,$message){
	$CI =& get_instance();
	
	$CI->load->library('email');
	
	//Get Username
	$from_name = get_data('from_name');
	$from_email = get_data('from_email');
	
	$config['mailtype'] = 'html';
	
	$CI->email->initialize($config);
	
	$CI->email->from($from_email,$from_name);
	$CI->email->to($email_id);
	//$this->email->cc('another@another-example.com');
	//$this->email->bcc('them@their-example.com');
	$CI->email->subject($subject);
	$CI->email->message($message);
	$CI->email->send();

	//echo $this->email->print_debugger();
}
/*********************************Function to Send Alert********************************************
	$data can contain following values
		patient_id
		doctor_id
		appointment_id
*/
function send_alert($alert_name,$data){
	$patient_id = NULL;
	$doctor_id = NULL;
	$appointment_id = NULL;
	$visit_id = NULL;
	
	if(array_key_exists('patient_id',$data)){
		$patient_id = $data['patient_id'];
	}
	if(array_key_exists('doctor_id',$data)){
		$doctor_id = $data['doctor_id'];
	}
	if(array_key_exists('appointment_id',$data)){
		$appointment_id = $data['appointment_id'];
		$patient_id = get_patient_id_from_appointment($appointment_id);
		$doctor_id = get_doctor_id_from_appointment($appointment_id);
	}
	if(array_key_exists('visit_id',$data)){
		$visit_id = $data['visit_id'];
		$patient_id = get_patient_id_from_visit($visit_id);
	}
	//Check if SMS Alert is enabled ?
	$sms_alert_name = 'sms_alert_'.$alert_name;
	if(is_alert_enabled($sms_alert_name)){
		//To Patient
		$sms_alert_name_to_patient = $sms_alert_name.'_to_patient';
		if(is_alert_enabled($sms_alert_name_to_patient)){
			if($patient_id != NULL){
				$mobile_number = get_mobile_number_patient($patient_id);
				if($mobile_number != ''){
					//Message Template
					$sms_format_name = 'sms_format_'.$alert_name.'_to_patient';
					$template = get_format($sms_format_name);
					$message = generate_message($template,$patient_id,$doctor_id,$appointment_id,$visit_id);
					send_sms($alert_name,$mobile_number,$message);
				}
			}
		}
		
		//To Doctor
		$sms_alert_name_to_doctor = $sms_alert_name.'_to_doctor';
		if(is_alert_enabled($sms_alert_name_to_doctor)){
			if($doctor_id != NULL){
				$mobile_number = get_mobile_number_doctor($doctor_id);
				if($mobile_number != ''){
					//Message Template
					$sms_format_name = 'sms_format_'.$alert_name.'_to_doctor';
					$template = get_format($sms_format_name);
					$message = generate_message($template,$patient_id,$doctor_id,$appointment_id,$visit_id);
					send_sms($alert_name,$mobile_number,$message);
				}
			}
		}
	}
	$email_alert_name = 'email_alert_'.$alert_name;
	if(is_alert_enabled($email_alert_name)){
		//To Patient
		$email_alert_name_to_patient = $email_alert_name.'_to_patient';	
		if(is_alert_enabled($email_alert_name_to_patient)){
			if($patient_id != NULL){
				$email_id = get_email_id_patient($patient_id);
				if($email_id != ''){
					//Message Template
					$email_format_name = 'email_format_'.$alert_name.'_to_patient';
					$template = get_format($email_format_name);
					$message = generate_message($template,$patient_id,$doctor_id,$appointment_id,$visit_id);
					$subject = "Subject";
					send_email($alert_name,$email_id,$subject,$message);
				}
			}
		}
	}
}


?>
