<script type="text/javascript" charset="utf-8">
$(window).load(function() {
	$('#availability_table').dataTable();
	
	$('.confirmDelete').click(function(){
		return confirm('<?php echo $this->lang->line("areyousure_delete");?>');
	});
});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			
	
			<div class="panel panel-primary">	
				<div class="panel-heading"><?=$this->lang->line('doctor_unavailability') ;?></div>
				<div class="panel-body">
					<a class="btn btn-primary btn-sm square-btn-adjust" href='<?= site_url('doctor/add_inavailability');?>'><?=$this->lang->line('add') .' ' .$this->lang->line('doctor_unavailability') ;?></a>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="availability_table">
						<thead>
							<tr>
								<th><?php echo $this->lang->line('doctor');?></th>
								<th width="100px;"><?php echo $this->lang->line('start_date');?></th>
								<th width="100px;"><?php echo $this->lang->line('end_date');?></th>
								<th width="100px;"><?php echo $this->lang->line('start_time');?></th>
								<th width="100px;"><?php echo $this->lang->line('end_time');?></th>
								<th><?php echo $this->lang->line('edit');?></th>
								<th><?php echo $this->lang->line('delete');?></th>
							</tr>									
						</thead>
						<?php $i = 1; ?>        
						<?php foreach ($availability as $avi) { ?>
						<tbody>
							<tr <?php if ($i % 2 == 0) {
								echo "class='alt'";
								} ?> >
								<td>
								<?php 
									foreach ($doctors as $doctor)
									{
										if ($avi['doctor_id'] == $doctor['doctor_id']) 
										{
											echo $doctor['title']." ".$doctor['first_name']." ".$doctor['middle_name']." ".$doctor['last_name'];
										}
									}
								?>
								</td>
								<td><?= date($def_dateformate,strtotime($avi['appointment_date'])); ?></td>
								<td><?= date($def_dateformate,strtotime($avi['end_date'])); ?></td>
								<td><?= date($def_timeformate,strtotime($avi['start_time'])); ?></td>
								<td><?= date($def_timeformate,strtotime($avi['end_time'])); ?></td>
								
							<td><center><a class="btn btn-primary btn-sm square-btn-adjust" href="<?= site_url('doctor/edit_inavailability') . "/" . $avi['appointment_id'] ."/" . $avi['userid']. "/" . $avi['end_date']?>"><?php echo $this->lang->line('edit')?></a></center></td>
							<td><center><a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?= site_url('doctor/delete_availability') . "/" . $avi['appointment_id'] ?>"><?php echo $this->lang->line('delete')?></a></center></td>
						</tr>
						</tbody>
						<?php $i++; ?>
						<?php } ?>
						</table>
					</div>		
				</div>
			</div>
		</div>
	</div>
</div>