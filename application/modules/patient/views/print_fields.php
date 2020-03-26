<?php
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
		if($field['field_type'] == "header"){
			$display_field .= "<h4>".$field['field_label']."</h4>"; 
		}else{
			$display_field .= "<label for='history_".$field['field_id']."'>".$field['field_label']."</label>"; 
		}
		$display_field .= $add_button;
		
		if($field['field_type'] == "text"){
			$display_field .= "<input type='input' ".$disabled." class='form-control' id='".$field['field_name']."' name='history_".$field['field_id']."$array' value='".$value."'/>";
		}elseif($field['field_type'] == "textarea"){
			$display_field .= "<textarea ".$disabled." class='form-control' id='".$field['field_name']."' name='history_".$field['field_id']."$array' >".$value."</textarea>";
		}elseif($field['field_type'] == "file"){
			$display_field .= "<input type='file' ".$disabled." class='form-control' id='".$field['field_name']."' name='history_".$field['field_id']."$array' value='".$value."'/>";
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
<html>
<head>
<!-- BOOTSTRAP STYLES-->
<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<style>
	label{font-weight:bold;margin-right:10px;}
	.form-control{border:none; border-bottom: 1px solid #ccc; border-radius:0px;box-shadow:none;}
	@media print {
			.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11,.col-md-12{
				float:left;
			}
		 .col-md-12 {
			width: 100%;
		  }
		  .col-md-11 {
			width: 91.66666667%;
		  }
		  .col-md-10 {
			width: 83.33333333%;
		  }
		  .col-md-9 {
			width: 75%;
		  }
		  .col-md-8 {
			width: 66.66666667%;
		  }
		  .col-md-7 {
			width: 58.33333333%;
		  }
		  .col-md-6 {
			width: 50%;
		  }
		  .col-md-5 {
			width: 41.66666667%;
		  }
		  .col-md-4 {
			width: 33.33333333%;
		  }
		  .col-md-3 {
			width: 25%;
		  }
		  .col-md-2 {
			width: 16.66666667%;
		  }
		  .col-md-1 {
			width: 8.33333333%;
		  }
		 
	}
		
		
</style>
</head>

<?php $doctor_departments = explode(",",$doctor['department_id']); 

?> 

<body onload="window.print();">
<body>
<div class="col-md-12">
	<h1 style="text-align: center;"><?=$clinic['clinic_name']?></h1>
	<h2 style="text-align: center;"><?=$clinic['tag_line']?></h2>
	<p style="text-align: center;"><?=$clinic['clinic_address']?></p>
	<p style="text-align: center;">
		<strong style="line-height: 1.42857143;">Landline : </strong>
		<span style="line-height: 1.42857143;"><?=$clinic['landline']?></span>
		<strong style="line-height: 1.42857143;">Mobile : </strong>
		<span style="line-height: 1.42857143;"><?=$clinic['mobile']?></span>
		<strong style="line-height: 1.42857143;">Email : </strong>
		<span style="text-align: center;"><?=$clinic['email']?></span>
	</p>
</div>
	

<div class="col-md-12">
	<div class="col-md-12">
		<hr id="null" />
		<h3 style="text-align: center;">
			<u style="text-align: center;">Patient Details</u>
		</h3>
	</div>
		<div class="col-md-6">
			<span> <strong>Patient Name : </strong><?php echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name']; ?></span>
		</div>
		<div class="col-md-6">
			<span> <strong>Patient Address : </strong><?php echo $contact['address_line_1'] . " " . $contact['address_line_2'] . " " . $contact['area']." " . $contact['city']; ?></span>
		</div>
		<div class="col-md-6">
			<span> <strong>Date Of Birth : </strong><?php  if($patient['dob']!=""){echo date($def_dateformate, strtotime($patient['dob']));}else{ echo "--";} ?> </span>
		</div>
		<div class="col-md-6">
			<span> <strong>Mobile No. : </strong><?php echo $patient['phone_number']?> </span>
		</div>
		<div class="col-md-6">
			<span> <strong>Email : </strong><?php echo $patient['email']?> </span>
		</div>
		<div class="col-md-6">
			<span> <strong>Gender : </strong><?php echo $patient['gender']?> </span>
		</div>
		<div class="col-md-6">
			<span> <strong>Age : </strong><?php  if($patient['age']!=0){echo $patient['age'];}else{ echo "--";} ?> </span>
		</div>
		
		<div class="col-md-12">
			<?php
			//echo "<hr id='null' />";
			echo "<div class='col-md-12'>";
				if(isset($section_patient_master)){ 
					
					echo "<script>";
					foreach($section_patient_conditions as $section_condition){
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
					
				foreach($section_patient_master as $section){
					$section_departments = explode(",",$section['department_id']);
					$display_section = FALSE;
					foreach($section_departments as $section_department){
						foreach($doctor_departments as $doctor_department){
							if($doctor_department == $section_department){
								$display_section = TRUE;
							}
						}
					}
					if($display_section){
						echo "<div class='section col-md-12' data-department='".$section['department_id']."'>";
						echo "<h3 style='text-align: center;'><u>".$section['section_name']."</u></h3>";
						$section_id = $section['section_id'];
							$g_array=array();
							$k=0;
							foreach($section_patient_fields as $field){
							if($field['section_id'] == $section['section_id']) {
								//Get Value of Field
								if(isset($patient_detail_field_history[$field['field_id']])){
									$value = $patient_detail_field_history[$field['field_id']];
								}else{
									$value = "";
								}
									
								if($field['is_repeat']=='1'){
									$value=explode(",",$value);
									foreach ($value as $v){
										echo display_single_field($field,$v,$field_patient_options,$section_patient_fields,$patient_detail_field_history);	
								}
								}else{
									echo display_single_field($field,$value,$field_patient_options,$section_patient_fields,$patient_detail_field_history);
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
		
</div>
<div class="col-md-12">
	<div class="col-md-12">
		<hr id="null" />
		<h3 style="text-align: center;">
			<u style="text-align: center;">Visit Details</u>
		</h3>
	</div>
	<div class="col-md-8">
		<span> <strong>Doctor Name :  </strong><?= $visit['name']; ?></span>
	</div>
	<div class="col-md-8">
			<span> <strong>Visit Date & Time :  </strong><?= date($def_dateformate, strtotime($visit['visit_date'])); ?> <?= date($def_timeformate, strtotime($visit['visit_time'])); ?></span>

	</div>
	<div class="col-md-8">
		 <span> <strong>Visit Notes :  </strong><?= $visit['notes']; ?></span>
	</div>
	<div class="col-md-8">
		<span> <strong>Patient Notes :  </strong><?= $visit['patient_notes']; ?></span>
	</div>
</div>
<div class="col-md-12">
	<?php
	//echo "<hr id='null' />";
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
				foreach($doctor_departments as $doctor_department){
					if($doctor_department == $section_department){
						$display_section = TRUE;
					}
				}
			}
			if($display_section){
				echo "<div class='section col-md-12' data-department='".$section['department_id']."'>";
				echo "<h3 style='text-align: center;'><u>".$section['section_name']."</u></h3>";
				$section_id = $section['section_id'];
					$g_array=array();
					$k=0;
				foreach($section_fields as $field){
					if($field['section_id'] == $section['section_id']) {
						//Get Value of Field
						if(isset($patient_history_details[$field['field_id']])){
							$value = $patient_history_details[$field['field_id']];
						}else{
							$value = "";
						}

						if($field['is_repeat']=='1'){
							$value=explode(",",$value);
							foreach ($value as $v){
								echo display_single_field($field,$v,$field_options,$section_fields,$patient_history_details);	
							}
						}else{
							echo display_single_field($field,$value,$field_options,$section_fields,$patient_history_details);
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

 
</body>
</html>