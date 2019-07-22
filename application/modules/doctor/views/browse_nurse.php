<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	})

    $("#nurse_table").dataTable();
});
</script>
<?php $category = $this->session->userdata('category');?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line("nurse");?>
				</div>
				<div class="panel-body">
					<?php if($category != 'nurse') {?>
					<a title="<?php echo $this->lang->line("add")." ".$this->lang->line("nurse");?>" href="<?php echo base_url()."index.php/doctor/nurse_detail/" ?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("nurse");?></a>
					<?php }?>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="nurse_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<th><?php echo $this->lang->line("name");?></th>
									<th><?php echo $this->lang->line("department");?></th>
									<th><?php echo $this->lang->line("email");?></th> 
									<th><?php echo $this->lang->line("phone_number");?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; ?>
								<?php $display = TRUE; ?>
								<?php if(isset($nurses)){ ?>
								<?php foreach ($nurses as $nurse):  ?>
								<?php if($category == 'nurse') {?>
									<?php if($nurse['userid'] == $this->session->userdata('id')) {?>
										<?php $display = TRUE; ?>
									<?php }else{ ?>
										<?php $display = FALSE; ?>
									<?php } ?>
								<?php } ?>
								<?php if($display) {?>
								<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >								
									<td><?php echo $i; ?></td>
									<td><a class="btn btn-info btn-sm square-btn-adjust" href="<?php echo site_url("doctor/nurse_detail/" . $nurse['nurse_id']); ?>"><?php echo  $nurse['first_name'] . " " . $nurse['middle_name'] . " " . $nurse['last_name']; ?></a></td>
									<td>
									<?php $nurse_departments = explode(",",$nurse['department_id']); 
										$j=1;
									?>
									<?php foreach ($departments as $department):  ?>
										<?php if(in_array($department['department_id'],$nurse_departments)){ ?>
											
											<?php if(count($nurse_departments )==$j) {
												echo $department['department_name'];
											}else{
												echo $department['department_name'].",";?>
											<?php } $j++;
										} ?>
									<?php endforeach ?>
									</td>
									<td><?php echo $nurse['email'];?></td> 
									<td><?php echo $nurse['phone_number'];?></td>
								</tr>
								<?php } ?>
								<?php $i++; ?>
								
								<?php endforeach ?>
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
