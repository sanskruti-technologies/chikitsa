<script type="text/javascript" charset="utf-8">	
	$(window).load(function(){
		$('#working_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false
		}); 
		$('#working_table').dataTable();
		$('.confirmDelete').click(function(){
			return confirm("<?=$this->lang->line('areyousure_delete');?>");
		})
	});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<h2><?php echo $this->lang->line('working_days');?></h2>
					</div>
				</div>
				<div class="panel-body table-responsive-30">
					<?php echo form_open('settings/save_working_days'); ?>
					
					<?php 
						$days = array();
						$days[7] = "S";
						$days[1] = "M";
						$days[2] = "T";
						$days[3] = "W";
						$days[4] = "T";
						$days[5] = "F";
						$days[6] = "S";
								
						if (in_array("centers", $active_modules)) {
							foreach($clinics as $clinic){
								echo "<div class='col-md-12'>";
								echo "<div class='col-md-2'>".$clinic['clinic_name']."</div>";
								
						
								foreach($days as $key=>$value){
									$checked = '';	
									if(in_array($key, $all_working_days[$clinic['clinic_id']])){	
										$checked = 'checked';
									}
									echo"<div class='col-md-1'><label><input type='checkbox' name='working_days_".$clinic['clinic_id']."[]' $checked value='$key'>$value</label></div>";
								}
								echo "</div>";
							}
						}else{
							echo "<div class='col-md-12'>";
					
								foreach($days as $key=>$value){
									$checked = '';	
									if(in_array($key, $working_days)){	
										$checked = 'checked';
									}
									echo"<div class='col-md-1'><label><input type='checkbox' name='working_days[]' $checked value='$key'>$value</label></div>";
								}
								echo "</div>";
						}
					?>
										
					<div class="col-md-1">	
						<input type="submit" name="submit" class="btn btn-primary square-btn-adjust btn-sm" value="Save">
					</div>	
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<h2><?php echo $this->lang->line('exceptional_days');?></h2>
					</div>
				</div>
				<div class="panel-body table-responsive-15">
					
					<div class="col-md-3">
							<a href="<?=site_url('settings/edit_exceptional_days/');?>" class="btn btn-primary square-btn-adjust btn-sm" ><?php echo $this->lang->line('add');?></a>
					</div>
					<div class="col-md-12">
						<p></p>
					</div>
					<div class="col-md-12 table-responsive-25">
					<div class="table-responsive">
						<table class="table table-striped table-hover display responsive nowrap" id="working_table">
							<thead>
							<tr>
								<th><?php echo $this->lang->line('sr_no');?></th>
								<th><?php echo $this->lang->line('start_date');?></th>
								<th><?php echo $this->lang->line('end_date');?></th>
								<th><?php echo $this->lang->line('start_time');?></th>
								<th><?php echo $this->lang->line('end_time');?></th>
								<th><?php echo $this->lang->line('status');?></th>
								<th><?php echo $this->lang->line('reason');?></th>
								<th><?php echo $this->lang->line('actions');?></th>
							</tr>
							</thead>
							<tbody>
							<?php $i=1;?>
							<?php foreach($exceptional_days as $exceptional_day){?>
							
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo date($def_dateformate,strtotime($exceptional_day['working_date']));?></td>
								<td><?php echo date($def_dateformate,strtotime($exceptional_day['end_date']));?></td>
								<td><?php echo date($def_timeformate,strtotime($exceptional_day['start_time']));?></td>
								<td><?php echo date($def_timeformate,strtotime($exceptional_day['end_time']));?></td>
								<td><?php echo $exceptional_day['working_status'];?></td>
								<td><?php echo $exceptional_day['working_reason'];?></td>
								<td>
									<a class="btn btn-primary btn-sm square-btn-adjust editbt" title="Edit" href="<?=site_url('settings/edit_exceptional_days/'.$exceptional_day['uid']);?>"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" title="delete" href="<?=site_url('settings/delete_exceptional_days/'.$exceptional_day['uid']);?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
								</td>
							</tr>
							
							<?php $i++; }?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
		</div>
		</div>
	</div>
</div>	