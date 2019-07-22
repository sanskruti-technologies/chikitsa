<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	})

    $("#doctor_table").dataTable();
	$('#from_time').datetimepicker({
		datepicker:false,
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>'
    });    
    $('#to_time').datetimepicker({
		datepicker:false,
		minTime:'<?=date($def_timeformate,strtotime($clinic_start_time));?>',
		maxTime:'<?=date($def_timeformate,strtotime($clinic_end_time));?>',
		format: '<?=$def_timeformate; ?>',
		formatTime:'<?=$def_timeformate; ?>'
    });    
});
function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }

</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
		<!-- Advanced Tables -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				 <?php echo $this->lang->line('doctor') . ' ' .$this->lang->line('preferences'); ?>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="doctor_table">
						<thead>
							<tr>
								<th><?php echo $this->lang->line('sr_no');?></th>	
								<th><?php echo $this->lang->line('doctor');?></th>	
								<th><?php echo $this->lang->line('max_patient');?></th>	
								<th><?php echo $this->lang->line('edit');?></th>
								<th><?php echo $this->lang->line('delete');?></th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=1; 
								$level = $this->session->userdata('category');
							?>
							<?php foreach ($doctor_preferences as $doctor_preference){  ?> 
							<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >								
								<td><?php echo $i; ?></td>
								<td>
								<?php if ($level == 'Doctor') {  ?>
									<?= $doctor_name; ?>
								<?php }else{ ?>	
									<?php  foreach ($doctors as $doctor) { 
									if($doctor['doctor_id']==$doctor_preference['doctor_id']){
									?>
									<?php echo $doctor['first_name'] . ' ' . $doctor['middle_name']. ' ' . $doctor['last_name']; ?> 
									<?php }} ?>	
								<?php } ?>	
								</td>	
								<td><?php echo $doctor_preference['max_patient']; ?></td>
								<td><a class="btn btn-info btn-sm " title="<?php echo $this->lang->line('edit') ?>" href="<?php echo site_url("doctor/edit_preference/" . $doctor_preference['doctor_id']); ?>"><?php echo $this->lang->line("edit");?></a></td>
								<td><a class="btn btn-danger btn-sm confirmDelete" title="<?php echo $this->lang->line('delete')?>" href="<?php echo site_url("doctor/delete_preference/" . $doctor_preference['preference_id']); ?>"><?php echo $this->lang->line("delete");?></a></td>
							</tr>
							<?php $i++; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			<a class="btn btn-primary btn-sm " href="<?=site_url('doctor/index');?>"><?php echo $this->lang->line('back') ;?></a>

			</div>
		</div>
		<!--End Advanced Tables -->
		</div>
	</div>
</div>