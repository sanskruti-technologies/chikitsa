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
	function is_group_repeat($field_name,$fields){
		foreach($fields as $field){
			if($field['field_name']==$field_name){
				if($field['is_repeat']==1){
					return TRUE;
				}
			}
		}
		return FALSE;
	}
	function display_group_multiple_fields($field,$field_options,$fields,$patient_history_details){
		$display_field = "";
		$value_array = array();
		
		foreach($fields as $f){
			if(($f['in_group'] == 1) && ($f['group_name'] == $field['field_name']) && ($f['section_id'] == $field['section_id'])){
				if(isset($patient_history_details[$f['field_id']])){
					$value = $patient_history_details[$f['field_id']];
				}else{
					$value = "";
				}
				
				$value_array[$f['field_id']] = $value;
				$value=explode(",",$value);
				$repeat_count = sizeof($value);
			}
		}
		
		for($i=0;$i<$repeat_count;$i++){
			foreach($value_array as $field_id => $value){
				$value=explode(",",$value);
				$v = $value[$i];
				foreach($fields as $f){
					if($f['field_id'] == $field_id){
						$display_field .= display_single_field($f,$v,$field_options,$fields,$patient_history_details,TRUE);
					}
				}
			}
		}
		
		
		return $display_field;
	}
	function display_group_single_fields($field,$field_options,$fields,$patient_history_details){
		$display_field = "";
		foreach($fields as $f){
			if(isset($patient_history_details[$f['field_id']])){
				$v = $patient_history_details[$f['field_id']];
			}else{
				$v = "";
			}
				
			if(($f['in_group'] == 1) && ($f['group_name'] == $field['field_name']) && ($f['section_id'] == $field['section_id'])){
				$display_field .= display_single_field($f,$v,$field_options,$fields,NULL,TRUE);
			}
		}
		return $display_field;
	}
	function display_single_field($field,$value,$field_options,$fields,$patient_history_details=NULL,$for_group = FALSE){
		$style="";
		$disabled='disabled';
		$array = "";
		$add_button = "";
		if($field['in_group']=='1' && !$for_group){
			return "";
		}
		if($field['in_group']=='1' && is_group_repeat($field['group_name'],$fields)){
			$array = "[]";
		}
		if($field['is_repeat']=='1'){
			$array = "[]";
			$add_button = " <a class='btn btn-primary square-btn-adjust btn-xs repeat_field' data-field_name='history_".$field['field_id']."'>+</a>";
					
		}
		if($field['field_status'] == 'hidden' ){
			$style="style='display:none;'";
		}
		/*if($field['field_status'] == 'disabled' ){
			$disabled=" disabled='disabled'";
		}*/
		
		$display_field = "<div class='form-group col-md-".$field['field_width']." history_".$field['field_id']."' ".$style.">";
		if($field['field_type'] !== "file"){
			if($field['field_type'] != "header"){
				$display_field .= "<h4>".$field['field_label']."</h4>"; 
			}else{
				$display_field .= "<label for='history_".$field['field_id']."'>".$field['field_label']."</label>"; 
			}
		}
		$display_field .= $add_button;
		
		if($field['field_type'] == "text"){
			$display_field .= "<input type='input' ".$disabled." class='form-control' id='".$field['field_name']."' name='history_".$field['field_id']."$array' value='".$value."'/>";
		}elseif($field['field_type'] == "textarea"){
			$display_field .= "<textarea ".$disabled." class='form-control' id='".$field['field_name']."' name='history_".$field['field_id']."$array' >".$value."</textarea>";
		}elseif($field['field_type'] == "file"){
			//$display_field .= "<input type='file' ".$disabled." class='form-control' id='".$field['field_name']."' name='history_".$field['field_id']."$array' value='".$value."'/>";
		}elseif($field['field_type'] == "date"){ 
			$display_field .= "<input type='input' ".$disabled." class='form-control datetimepicker' id='".$field['field_name']."' name='history_".$field['field_id']."$array' value='".$value."'/>";
		}elseif($field['field_type'] == "combo"){ 
			$display_field .= "<select id='".$field['field_name']."' class='form-control' ".$disabled." name='history_".$field['field_id']."$array'>";
			foreach($field_options as $field_option){ 
				if($field_option['field_id'] == $field['field_id']){
					if($field_option['option_value'] == $value ){$selected = "selected";}
					$display_field .= "<option value='".$field_option['option_value']."' $selected >".$field_option['option_label']."</option>";
				} 
			} 
			$display_field .= "</select>";
		}elseif($field['field_type'] == "checkbox"){ 
			foreach($field_options as $field_option){ 
				if($field_option['field_id'] == $field['field_id']){
					$checked = "";
					if(strpos($value,$field_option['option_value']) !== FALSE ){$checked = "checked";}
					$display_field .= "<label class='checkbox'>";
					$display_field .= "<input id='".$field['field_name']."' $disabled type='checkbox' name='history_".$field['field_id']."[]' value='".$field_option['option_value']."' $checked />".$field_option['option_label'];
					$display_field .= "</label>";
				}
			}
		}elseif($field['field_type'] == "radio"){
			foreach($field_options as $field_option){
				if($field_option['field_id'] == $field['field_id']){
					$checked = "";
					if(strpos($value,$field_option['option_value']) !== FALSE ){$checked = "checked";}
					
					$display_field .= "<div class='radio'><label>";
					$display_field .= "<input id='".$field['field_name']."' $disabled type='radio' name='history_".$field['field_id']."' id='history_".$field['field_id']."' value='".$field_option['option_value']."' $checked>".$field_option['option_label'];
					$display_field .= "</label></div>";
				}
			}
		}elseif($field['field_type'] == "group"){
			$display_field .=  "<div id='".$field['field_name']."' class='div_history_".$field['field_id']."' >";
			if($field['is_repeat'] == 1){
				$display_field .= display_group_multiple_fields($field,$field_options,$fields,$patient_history_details);
			}else{
				$display_field .= display_group_single_fields($field,$field_options,$fields,$patient_history_details);
			}
			
			$display_field .=  "</div>";
		}
		$display_field .=  form_error($field['field_id'],'<div class="alert alert-danger">','</div>');
		$display_field .=  "</div>";
		return $display_field;
	}
?>
<?php
		$doctor_departments=array();
	
	 if (in_array("history", $active_modules)) {
		foreach($doctor_names as $doc){
			$doctor_departments[] = explode(",",$doc['department_id']); 
		}
	}
	if(isset($doctor)){
		$doctor_name = $doctor['name'];
		$doctor_id = $doctor['doctor_id'];
	}
	if(isset($appointment)){
		//Edit Appointment
		$header = $this->lang->line("edit")." ".$this->lang->line("appointment");
		$patient_name = $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'];
		$title = $appointment['title'];
		$appointment_id = $appointment['appointment_id'];
		$start_time = $appointment['start_time'];
		$end_time = $appointment['end_time'];
		$appointment_date = $appointment['appointment_date'];
		$status = $appointment['status'];
		$appointment_id = $appointment['appointment_id'];
	}else{
		//Add Appointment
		$header = $this->lang->line("new")." ".$this->lang->line("appointment");
		$patient_name = "";
		$title = "";
		$time_interval =  $time_interval*60;
		$start_time = date($def_timeformate, strtotime($appointment_time));
		$end_time = date($def_timeformate, strtotime("+$time_interval minutes", strtotime($appointment_time))); 
		
		$appointment_date = $appointment_date;
		$status = "Appointments";
	}
	$total = ($particular_total + $fees_total + $treatment_total + $item_total) - ((-1)*($balance));
?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line("appointment_details");?></h6>
		</div>
		<div class="card-body">
					<div class="row col-md-12">
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('patient_name');?>:</label>
								<span><?=$patient['first_name'].' '.$patient['middle_name'] .' '.$patient['last_name'];?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('doctor_name');?>:</label>
								<span><?=$doctor['name'];?></span>
							</div>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('visit_date');?>:</label>
								<span><?=date($def_dateformate,strtotime($visit['visit_date']));?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('visit_time');?>:</label>
								<span><?=date($def_timeformate,strtotime($visit['visit_time']));?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('visit_type');?>:</label>
								<span><?=$visit['type'];?></span>
							</div>
						</div>
					</div>
					
					<div class="row col-md-12">
						<div class="col-md-12">
							<div class="form-group">
									<label><?php echo $this->lang->line('reason');?>:</label>
									<span><?=$visit['appointment_reason'];?></span>
							</div>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('notes');?>:</label>
								<span><?=$visit['notes'];?></span>
							</div>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="col-md-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('patient_notes');?>:</label>
								<span><?=$visit['patient_notes'];?></span>
							</div>
						</div>
					</div>

					<div class="">
						<?php
						//echo "<hr id='null' />";
						$i=0;
						echo "<div class='col-md-12'>";
							if(isset($section_master)){ 
								
								echo "<script>";
								foreach($section_conditions as $section_condition){
									echo "$(document).on('change', '#".$field_name[$section_condition['field_name']]."', function() {\n";
									
									//Check Value of field
									if($section_condition['field_is_checked'] != NULL &  $section_condition['field_is_checked'] == 1){ //checked
										echo "if ($('#".$field_name[$section_condition['field_name']]."').is(':checked')) {";
									}elseif($section_condition['field_is_checked'] != NULL & $section_condition['field_is_checked'] == 0){ //unchecked
										echo "if (!$('#".$field_name[$section_condition['field_name']]."').is(':checked')) {";
									}elseif($section_condition['condition_type'] == 'has_value' ){ //has value
										echo "var flag = false;\n";
										echo "$('#".$field_name[$section_condition['field_name']].":checked').each(function() {\n";
										echo "  if(this.value == '".$section_condition['field_has_value']."'){\n";
										echo "	flag = true;\n";
										echo "	}\n";
										echo "});\n";
										echo "if(flag){\n";
									}elseif($section_condition['condition_type'] == 'does_not_has_value' ){ //does not has value
										echo "var flag = true;\n";
										echo "$('#".$field_name[$section_condition['field_name']].":checked').each(function() {\n";
										echo "  if(this.value == '".$section_condition['field_has_value']."'){\n";
										echo "	flag = false;\n";
										echo "	}\n";
										echo "});\n";
										echo "if(flag){\n";
									}

									//Change Status of field
									if($section_condition['change_status_to'] == 'enabled'){
										echo "$('#".$field_name[$section_condition['change_status_of_field']]."').parent().show();";
										echo "$('#".$field_name[$section_condition['change_status_of_field']]."').prop('disabled', false);";
									}elseif($section_condition['change_status_to'] == 'disabled'){
										echo "$('#".$field_name[$section_condition['change_status_of_field']]."').parent().show();";
										echo "$('#".$field_name[$section_condition['change_status_of_field']]."').prop('disabled', true);";
									}elseif($section_condition['change_status_to'] == 'hidden'){
										echo "$('#".$field_name[$section_condition['change_status_of_field']]."').parent().hide();";
									
									}
										echo "}";
										echo "});";
								} 
								echo "</script>";
								
							foreach($section_master as $section){
								$section_departments = explode(",",$section['department_id']);
								$display_section = FALSE;
								foreach($section_departments as $section_department){
									foreach($doctor_departments as $dept){
										foreach($dept as $doctor_department){
											if($doctor_department == $section_department){
												$display_section = TRUE;
											}
										}
									}
								}
								/*  *///$display_section = TRUE;
								if($display_section){
									echo "<div class='section col-md-12' data-department='".$section['department_id']."'>";
									echo "<h3 style='text-align: left;'><u>".$section['section_name']."</u></h3>";
									$section_id = $section['section_id'];
										$g_array=array();
										$k=0;
									foreach($section_fields as $field){
										if($field['section_id'] == $section['section_id']) {
											//Get Value of Field
												if(isset($patient_history_details[$i][$field['field_id']])){
													$value = $patient_history_details[$i][$field['field_id']];
												}else{
													$value = "";
												}

												if($field['is_repeat']=='1'){
													$value=explode(",",$value);
													foreach ($value as $v){
														if($v['value']!=""){
															echo display_single_field($field,$v['value'],$field_options,$section_fields,$patient_history_details[$i]);	
														}
													}
												}else{
													//echo display_single_field($field,"11111",$field_options,$section_fields,$patient_history_details[$i]);
													//foreach ($value as $v){
														if($value['value']!=""){
															echo display_single_field($field,$value['value'],$field_options,$section_fields,$patient_history_details[$i]);	
														}
													//}
												}
											
										}
												/*
												if(($field['group_name']!=NULL) && ($field['in_group']==1)){
														echo $field['group_name'];
														$g_array[$field['field_id']]=$field['group_name'];
														//$k++;
															}*/
									}
								}
								
							
								echo "</div>";
							}	
							} 
									
							echo "</div>";
						?>
					</div>



					<div class="row col-md-12">
						<div class="col-md-12">
							<label><?php echo $this->lang->line('bill_details');?></label>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('bill_id');?>:</label>
								<span><?=$bill['bill_id'];?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label><?php echo $this->lang->line('bill_date');?>:</label>
								<span><?=date($def_dateformate,strtotime($bill['bill_date']));?></span>
							</div>
						</div>
						<div class="col-md-12">
							<?php $this->load->view('bill/bill_table'); ?>
						</div>
					</div>
				</div>
				<div class="col-md-12"><center>
							<?php 
								$level = $this->session->userdata('category'); 
								if ($level == 'System Administrator') {
							?>
							<a href="<?php echo site_url("appointment/change_status/" . $appointment_id. "/Consultation"); ?>" class="btn btn-success">
								<?php echo $this->lang->line('back')." ".$this->lang->line('to')." ".$this->lang->line('consultation');?>
							</a>
							<?php } ?>
							<br/>&nbsp;<br/>
					</center>
				</div>

			
	</div>
</div>