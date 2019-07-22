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
					<?=$this->lang->line("department");?>
				</div>
				<div class="panel-body">
					<a class="btn btn-primary square-btn-adjust" href="<?=site_url("doctor/add_department/");?>"><?=$this->lang->line("add_department");?></a>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="doctor_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<th><?php echo $this->lang->line("department");?></th>									
									<th><?php echo $this->lang->line("edit");?></th>									
									<th><?php echo $this->lang->line("delete");?></th>									
								</tr>
							</thead>
							<tbody>
								<?php if($departments) { ?>
								<?php $i=1; ?>
								<?php foreach ($departments as $department):  ?>      
								
								
								<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >								
									<td><?php echo $i; ?></td>
									<td><?php echo $department['department_name']; ?></td>									
									<td><a class="btn btn-primary square-btn-adjust " title="<?php echo $this->lang->line('edit').' department : ' . $department['department_id'] ?>" href="<?php echo site_url("doctor/edit_department/" . $department['department_id']); ?>"><?php echo $this->lang->line("edit");?></a></td>
									<td><a class="btn btn-danger square-btn-adjust confirmDelete" title="<?php echo $this->lang->line('delete').' department : ' . $department['department_id']?>" href="<?php echo site_url("doctor/delete_department/" . $department['department_id']); ?>"><?php echo $this->lang->line("delete");?></a></td>
								</tr>
								<?php $i++; ?>
								<?php endforeach ?>
								<?php }else{ ?>
									<tr>								
										<td colspan="4"><?php echo $this->lang->line("norecfound");?></td>
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
