<script type="text/javascript" charset="utf-8">	
	$(window).load(function(){
		$('#time').hide();
		var w_status=document.getElementsByName("working_status");
		for (i = 0; i < w_status.length; i++) {
			//alert(w_status[i].value)
			status=w_status[i].value;
		}
		if(status=='Half Day'){
			$('#time').show();
		}
		
		$('#working_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false
		}); 
		$('#end_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false
		});
		$('#start_time').datetimepicker({
			datepicker:false,
			format: '<?=$def_timeformate; ?>',
			formatTime:'<?=$def_timeformate; ?>'
		});    
		$('#end_time').datetimepicker({
			datepicker:false,
			format: '<?=$def_timeformate; ?>',
			formatTime:'<?=$def_timeformate; ?>'
		}); 
				
		$('#working_date').change(function () {
			var w_date=this.value;
			document.getElementById("end_date").value = w_date;
        });
		$( ".working_status" ).change(function() {
			//console.log($(this).val());
					if ($(this).val() == 'Half Day') {
					$('#time').show();
					}
					else{
					$('#time').hide();
					}
				
			});
		
	});
</script>
<?php
$working_date = set_value('working_date',date('Y/m/d'));
$working_status = set_value('working_status','');
$working_reason = set_value('working_reason','');
$end_date = set_value('end_date',date('Y/m/d'));
$start_time = set_value('start_time','');
$end_time = set_value('end_time','');
if(isset($exceptional)){
	$working_date = set_value('working_date',$exceptional['working_date']);
	$working_status = set_value('working_status',$exceptional['working_status']);
	$working_reason = set_value('working_reason',$exceptional['working_reason']);
	$end_date = set_value('end_date',$exceptional['end_date']);
	$start_time = set_value('start_time',$exceptional['start_time']);
	$start_time = date($def_timeformate,strtotime($start_time));
	$end_time = set_value('end_time',$exceptional['end_time']);
	$end_time = date($def_timeformate,strtotime($end_time));
}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $this->lang->line("exceptional_days");?></div>
				<div class="panel-body">
					<?php 	if(!isset($exceptional)){
								echo form_open('settings/save_exceptional_days');
							}else{
								echo form_open('settings/update_exceptional_days');
							}
					 ?>
					<div class="col-md-12">
						<input type="hidden" id="uid" name="uid" class="form-control" value="<?=$exceptional['uid'];?>">
						<div class="col-md-6">
							<label><?php echo $this->lang->line("start_date");?></label>
							<input type="text" id="working_date" name="working_date" class="form-control" value="<?= date($def_dateformate,strtotime($working_date));?>" >
							<?php echo form_error('working_date','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-6">
							<label><?php echo $this->lang->line("end_date");?></label>
							<input type="text" id="end_date" name="end_date" class="form-control" value="<?= date($def_dateformate,strtotime($end_date));?>">
							<?php echo form_error('end_date','<div class="alert alert-danger">','</div>'); ?>
						</div>
					
						<div class="col-md-6">
							<label><?php echo $this->lang->line("status");?></label>
							<?php
							$option = array('Working'=>$this->lang->line('working'),
											'Non Working'=>$this->lang->line('non_working'),
											'Half Day'=>$this->lang->line('half_day'));
							$attr = 'class="form-control working_status"';
							echo form_dropdown("working_status",$option,$working_status,$attr);
							?>
							<?php echo form_error('working_status','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-6">
							<label><?php echo $this->lang->line("reason");?></label>
							<input type="text" id="working_reason" name="working_reason" value="<?=$working_reason;?>" class="form-control">
							<?php echo form_error('working_reason','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div id="time">
							<div class="col-md-6">
								<div class="form-group">
									<label for="start_time"><?php echo $this->lang->line('start_time');?></label>
									<input type="input" name="start_time" id="start_time" value="<?=$start_time; ?>" class="form-control"/>
									<?php echo form_error('start_time','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="end_time"><?=$this->lang->line('end_time');?></label>
									<input type="input" name="end_time" id="end_time" value="<?=$end_time; ?>" class="form-control"/>
									<?php echo form_error('end_time','<div class="alert alert-danger">','</div>'); ?>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<p></p>
							<input type="submit" name="submit" class="btn btn-primary square-btn-adjust btn-sm" value="<?=$this->lang->line('save');?>">
							<a href="<?=site_url('settings/working_days/');?>" class="btn btn-primary square-btn-adjust btn-sm" ><?php echo $this->lang->line('back');?></a>
						</div>
					</div>
					<?php echo form_close(); ?>
					<div class="col-md-12">
						<p></p>
					</div>
					
				</div>
		</div>
		</div>
	</div>
</div>	
