<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	
	$('.confirmDelete').click(function(){
		return confirm(<?php echo $this->lang->line("areyousure_delete");?>);
	})

    $("#doctor_table").dataTable();
});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line("fees_detail");?>
				</div>
				<div class="panel-body">
					<a href="<?=site_url('doctor/add_fee');?>" class="btn btn-primary square-btn-adjust"><?=$this->lang->line("add_fee");?></a>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="doctor_table">
							<thead>
								<tr>
									<th><?=$this->lang->line("sr_no");?></th>	
									<th><?=$this->lang->line("doctor");?></th>	
									<th><?=$this->lang->line("detail");?></th>	
									<th><?=$this->lang->line("fees");?></th>		
									<th><?=$this->lang->line("edit");?></th>								
									<th><?=$this->lang->line("delete");?></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$i=1; 
									$rows = FALSE;
									if($this->session->userdata('category') == 'Doctor'){
										foreach ($fees as $fee){      
											if($doctor['doctor_id']==$fee['doctor_id']){ 
												$rows = TRUE; ?>
												<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >								
													<td><?php echo $i; ?></td>
													<td><?php echo 'Dr. ' . $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?> </td>									
													<td><?php echo $fee['detail']; ?></td>
													<td><?php echo $fee['fees']; ?></td>
													<td><a class="btn btn-info square-btn-adjust " title="<?php echo $this->lang->line('edit').' '.$this->lang->line('fee') . $fee['id'] ?>" href="<?php echo site_url("doctor/edit_fees/" . $fee['id']); ?>"><?php echo $this->lang->line("edit");?></a></td>
													<td><a class="btn btn-danger square-btn-adjust confirmDelete" title="<?php echo $this->lang->line('delete').' fee : ' . $fee['id']?>" href="<?php echo site_url("doctor/delete_fees/" . $fee['id']); ?>"><?php echo $this->lang->line("delete");?></a></td>
												</tr>
											<?php } ?>
									<?php $i++; ?>
									<?php } ?>
								<?php }else{ ?>
								<?php foreach ($fees as $fee){  ?>      
									<?php foreach ($doctors as $doctor) { ?>
										<?php if($doctor['doctor_id']==$fee['doctor_id']){ ?>
											<?php $rows = TRUE;?>
											<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >								
												<td><?php echo $i; ?></td>
												<td><?php echo 'Dr. ' . $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?> </td>									
												<td><?php echo $fee['detail']; ?></td>
												<td><?php echo $fee['fees']; ?></td>
												<td><a class="btn btn-info square-btn-adjust " title="<?php echo $this->lang->line('edit').' '.$this->lang->line('fee') . $fee['id'] ?>" href="<?php echo site_url("doctor/edit_fees/" . $fee['id']); ?>"><?php echo $this->lang->line("edit");?></a></td>
												<td><a class="btn btn-danger square-btn-adjust confirmDelete" title="<?php echo $this->lang->line('delete').' fee : ' . $fee['id']?>" href="<?php echo site_url("doctor/delete_fees/" . $fee['id']); ?>"><?php echo $this->lang->line("delete");?></a></td>
												</tr>
										<?php } ?>
									<?php } ?>
								<?php $i++; ?>
								<?php } ?>
								<?php } ?>
								<?php if(!$rows){?>
									<tr>
										<td colspan="6"><?php echo $this->lang->line("norecfound");?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>
</div>
