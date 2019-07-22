<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	})
    $("#doctor_table").dataTable();
});
</script>
<?php $level = $this->session->userdata('category'); ?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('doctor')." ".$this->lang->line('schedule');?>
			</div>
			<div class="panel-body">
				<a href="<?=site_url('doctor/add_doctor_schedule/'.$doctor_id);?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line('add')." ".$this->lang->line('schedule');?></a>
				<p></p>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="doctor_table">
						<thead>
							<tr>
								<th><?php echo $this->lang->line('sr_no');?></th>	
								<th><?php echo $this->lang->line('doctor');?></th>	
								<th><?php echo $this->lang->line('day');?></th>	
								<th><?php echo $this->lang->line('date');?></th>	
								<th><?php echo $this->lang->line('from_time');?></th>	
								<th><?php echo $this->lang->line('to_time');?></th>									
								<th><?php echo $this->lang->line('edit');?></th>
								<th><?php echo $this->lang->line('delete');?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; ?>
							<?php foreach ($drschedules as $drschedule):  ?> 
							<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >								
								<td><?php echo $i; ?></td>
								<td>
								<?php if ($level == 'Doctor') {  ?>
									<?php echo 'Dr. '. $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?> 
								<?php }else{ ?>	
									<?php  foreach ($doctors as $doctor) { 
									if($doctor['doctor_id']==$drschedule['doctor_id']){
									?>
									<?php echo 'Dr. '. $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?> 
									<?php }} ?>	
								<?php } ?>	
								</td>	
								<td><?php echo $drschedule['schedule_day']; ?></td>								
								<?php if($drschedule['schedule_date'] !=  NULL && $drschedule['schedule_date'] !=  "0000-00-00"){?>
								<td><?php echo date($def_dateformate,strtotime($drschedule['schedule_date'])); ?></td>
								<?php }else{?>
								<td></td>
								<?php }?>
								<td><?php echo date($def_timeformate,strtotime($drschedule['from_time'])); ?></td>
								<td><?php echo date($def_timeformate,strtotime($drschedule['to_time'])); ?></td>								
								<td><a class="btn btn-info  square-btn-adjust " title="<?php echo $this->lang->line('edit').' doctor_sechedule : ' . $drschedule['schedule_id'] ?>" href="<?php echo site_url("doctor/edit_drschedule/" . $drschedule['schedule_id']); ?>"><?php echo $this->lang->line("edit");?></a></td>
								<td><a class="btn btn-danger  square-btn-adjust confirmDelete" title="<?php echo $this->lang->line('delete').' doctor_sechedule : ' . $drschedule['schedule_id']?>" href="<?php echo site_url("doctor/delete_drschedule/" . $drschedule['schedule_id']); ?>"><?php echo $this->lang->line("delete");?></a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
		<!--End Advanced Tables -->
		</div>
	</div>
</div>