
<?php
	$level = $this->session->userdata('category');
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('doctor')." ".$this->lang->line('bonus')." ".$this->lang->line('report');?>
				</div>
				<div class="panel-body">
					<?php echo form_open('doctor/doctor_bonus'); ?>
					<div class="col-md-4">
						<?php echo $this->lang->line('month');?>
						<select name="month" class="form-control" >
							<option value="1" <?php if($month == 1 ){echo "selected";}?>>January</option>
							<option value="2" <?php if($month == 2 ){echo "selected";}?>>February</option>
							<option value="3" <?php if($month == 3 ){echo "selected";}?>>March</option>
							<option value="4" <?php if($month == 4 ){echo "selected";}?>>April</option>
							<option value="5" <?php if($month == 5 ){echo "selected";}?>>May</option>
							<option value="6" <?php if($month == 6 ){echo "selected";}?>>June</option>
							<option value="7" <?php if($month == 7 ){echo "selected";}?>>July</option>
							<option value="8" <?php if($month == 8 ){echo "selected";}?>>August</option>
							<option value="9" <?php if($month == 9 ){echo "selected";}?>>September</option>
							<option value="10" <?php if($month == 10 ){echo "selected";}?>>October</option>
							<option value="11" <?php if($month == 11 ){echo "selected";}?>>November</option>
							<option value="12" <?php if($month == 12 ){echo "selected";}?>>December</option>
						</select>
					</div>
					<div class="col-md-4">
						<?php echo $this->lang->line('year');?>
						<select name="year" class="form-control" >
							<?php 
								$from_year = 2017;
								$to_year = date('Y');
								for($i=$from_year;$i<= $to_year;$i++){
									$selected = "";
									if($i == $year){$selected = "selected";}
									echo "<option value='$i' $selected>$i</option>";
								}
							?>
						</select>
					</div>
					<div class="col-md-4" <?php if($level == 'Doctor'){ echo 'style = display:none;';} ?>>
						<?php echo $this->lang->line('doctor');?>
						<select name="doctor" class="form-control">
							<option></option>
							<?php foreach ($doctors as $doctor) {?>
								<option value="<?php echo $doctor['doctor_id'] ?>" <?php if($doctor['doctor_id'] == $doctor_id){echo "selected='selected'";} ?>><?= $doctor['first_name'];?></option>
							<?php } ?>
							<input type="hidden" name="doctor_id" id="doctor_id" value="" />
						</select>
					</div>
					<div class="col-md-4">
						<?php echo $this->lang->line('minimum_income');?>
						<input name="minimum_income" class="form-control" value="<?=$minimum_income;?>" />
					</div>
					<div class="col-md-4">
						<?php echo $this->lang->line('bonus_percentage');?>
						<input name="bonus_percentage" class="form-control" value="<?=$bonus_percentage;?>" />
					</div>
					<div class="col-md-4">
						<button type="submit" name="submit" class="btn btn-primary"><?php echo $this->lang->line('go');?></button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>	
		
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="appointment_report" >
							<thead>
								<tr>
									<th><?php echo $this->lang->line('date');?></th>
									<th><?php echo $this->lang->line('patient')." ".$this->lang->line('name');?></th>
									<th><?php echo $this->lang->line('billed')." ".$this->lang->line('amount');?></th>
								</tr>
							</thead>
							<?php 
								$bonus = 0;
								$total = 0;
							?>
							<?php if ($bonus_reports) {?>
							<tbody>
								<?php $i=1; ?>
								<?php foreach ($bonus_reports as $report):  ?>
									<tr <?php if ($i%2 == 0) { echo "class='even'"; }else{ echo "class='odd'"; } ?> >
										<td><?=date($def_dateformate,strtotime($report['date'])); ?></td>
										<td><?=$report['patient_name'];?></td>                
										<td style="text-align:right;"><?php echo currency_format($report['amount']); ?><?php if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
									</tr>
								<?php $i++; ?>
								
								<?php $total = $total + $report['amount']; ?>
								<?php endforeach ?>
							</tbody>
							<?php 
								if($total >= $minimum_income){
									$bonus = $bonus_percentage * $total / 100;
								}
								$grand_total = $bonus + $total;
							?>
							<tfoot>
								<tr>
									<th colspan="2"><?php echo $this->lang->line('Total');?></th>
									<th style="text-align:right;"><?php echo currency_format($total); ?><?php if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
								</tr>
								<tr>
									<th colspan="2"><?php echo $this->lang->line('bonus');?></th>
									<th style="text-align:right;"><?php echo currency_format($bonus); ?><?php if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
								</tr>
							</tfoot>
							<?php } else { ?>
							<tbody>
								<tr>
									<td colspan="9"><?php echo $this->lang->line('norecfound');?></td>
								</tr>
							</tbody>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		
	</div>
</div>
<!-- JQUERY SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-1.11.3.js"></script>
<!-- JQUERY UI SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery.metisMenu.js"></script>
 <!-- DATA TABLE SCRIPTS -->
<script src="<?= base_url() ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>/assets/js/dataTables/moment.min.js"></script>
<script src="<?= base_url() ?>/assets/js/dataTables/datetime-moment.js"></script>
<!-- TimePicker SCRIPTS-->
<script src="<?= base_url() ?>assets/js/jquery.datetimepicker.js"></script>
<link href="<?= base_url() ?>assets/js/jquery.datetimepicker.css" rel="stylesheet" />
<!-- CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>assets/js/custom.js"></script>
<script type="text/javascript" charset="utf-8">
	$(window).load(function() {
		$("#from_date").datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollInput:false, 
			scrollMonth:false,
			scrollTime:false,
			maxDate: 0,
		});
		$("#to_date").datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate;?>',
			scrollInput:false, 
			scrollMonth:false,
			scrollTime:false,
			maxDate: 0,
		});
		<?php if ($app_reports) {?>
		$('#appointment_report').DataTable();
		 /*var table = $('#appointment_report').DataTable({
			"columnDefs": [
				{ "visible": false, "targets": 0 }
			],
			"order": [[ 0, 'asc' ]],
			"displayLength": 25,
			"drawCallback": function ( settings ) {
				var api = this.api();
				var rows = api.rows( {page:'current'} ).nodes();
				var last=null;
	 
				api.column(0, {page:'current'} ).data().each( function ( group, i ) {
					if ( last !== group ) {
						$(rows).eq( i ).before(
							'<tr class="group"><td colspan="7">'+group+'</td></tr>'
						);
	 
						last = group;
					}
				} );
			}
		} );*/
		<?php } ?>
    });
</script>