<script type="text/javascript" charset="utf-8">	
	$(window).load(function(){
		$('#working_date').datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false
		}); 
	});
</script>
<?php
$working_date = set_value('working_date',date('Y/m/d'));
$working_status = set_value('working_status','');
$working_reason = set_value('working_reason','');
if(isset($exceptional)){
	$working_date = set_value('working_date',$exceptional['working_date']);
	$working_status = set_value('working_date',$exceptional['working_status']);
	$working_reason = set_value('working_date',$exceptional['working_reason']);
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
						<div class="col-md-3">
							<label><?php echo $this->lang->line("date");?></label>
							<input type="text" id="working_date" name="working_date" class="form-control" value="<?= date($def_dateformate,strtotime($working_date));?>">
							<?php echo form_error('working_date','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<label><?php echo $this->lang->line("status");?></label>
							<?php
							$option = array('Working'=>'Working',
											'Non Working'=>'Non Working');
							$attr = 'class="form-control"';
							echo form_dropdown("working_status",$option,$working_status,$attr);
							?>
							<?php echo form_error('working_status','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<label><?php echo $this->lang->line("reason");?></label>
							<input type="text" id="working_reason" name="working_reason" value="<?=$working_reason;?>" class="form-control">
							<?php echo form_error('working_reason','<div class="alert alert-danger">','</div>'); ?>
						</div>
						<div class="col-md-3">
							<p></p>
							<input type="submit" name="submit" class="btn btn-primary">
							<a href="<?=site_url('settings/working_days/');?>" class="btn btn-primary" ><?php echo $this->lang->line('back');?></a>
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
