<?php 
/*
	This file is part of Chikitsa.

    Chikitsa is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Chikitsa is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Chikitsa.  If not, see <https://www.gnu.org/licenses/>.
*/
?>
<head>
<style>
	.table-bordered{
		border-collapse:collapse;
	}
	.table-bordered > thead > tr > th,
	.table-bordered > tbody > tr > th,
	.table-bordered > tfoot > tr > th,
	.table-bordered > thead > tr > td,
	.table-bordered > tbody > tr > td,
	.table-bordered > tfoot > tr > td{
		border:1px solid #ddd;
	}
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td{
		padding:8px;
		line-height:1.42857143;
		vertical-align:top;
	}
</style>
</head>
<body onload="window.print();">
<?php
	$level = $this->session->userdata('category');
?>
<div id="page-inner">
	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<h2><?php echo $this->lang->line('appointment_report');?></h2>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="appointment_report" >
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<?php if (in_array("centers", $active_modules)) { ?>
									<th width="100px;"><?php echo $this->lang->line('clinic')." ".$this->lang->line('name');?></th>
									<?php } ?>
									<th width="100px;"><?php echo $this->lang->line('doctor')." ".$this->lang->line('name');?></th>
									<th width="100px;"><?php echo $this->lang->line('patient')." ".$this->lang->line('name');?></th>
									<th width="100px;"><?php echo $this->lang->line('appointment')." ".$this->lang->line('date');?></th>
									<th width="100px;"><?php echo $this->lang->line('appointment')." ".$this->lang->line('time');?></th>
									<th><?php echo $this->lang->line('waiting_in');?></th>
									<th><?php echo $this->lang->line('waiting')." ".$this->lang->line('duration');?></th>
									<th><?php echo $this->lang->line('consultation_in');?></th>
									<th><?php echo $this->lang->line('consultation_out');?></th>
									<th><?php echo $this->lang->line('consultation')." ".$this->lang->line('duration');?></th>
								</tr>
							</thead>
							<?php if ($app_reports) {?>
							<tbody>
								<?php $i=1; ?>
								<?php foreach ($app_reports as $report):  ?>
									<tr <?php if ($i%2 == 0) { echo "class='even'"; }else{ echo "class='odd'"; } ?> >
										<td><?=$i;?></td>   
										<?php if (in_array("centers", $active_modules)) { ?>
										<td><?=$report['clinic_name'];?></td>    
										<?php } ?>
										<td><?=$report['doctor_name'];?></td>      
										<td><?=$report['patient_name'];?></td>                
										<td><?=date($def_dateformate,strtotime($report['appointment_date'])); ?></td>
										<td><?=$report['appointment_time']; ?></td>
										<td><?=$report['waiting_in']; ?></td>
										<?php 
											$waiting_duration = "--";
											if(isset($report['waiting_in']) && isset($report['consultation_in'])){
												$waiting_duration = inttotime((strtotime($report['consultation_in'])-strtotime($report['waiting_in']))/60/60);
											}
										?>
										<td><?php if($waiting_duration != "--") {echo date('H:i:s',strtotime($waiting_duration));} else{echo $waiting_duration;} ?></td>
										<td><?=$report['consultation_in'];?></td>
										<td><?=$report['consultation_out'];?></td>
										<?php 
											$consultation_duration = "--";
											if(isset($report['consultation_out']) && isset($report['consultation_in'])){
												$consultation_duration = inttotime((strtotime($report['consultation_out'])-strtotime($report['consultation_in']))/60/60);
											}
										?>
										<td><?php if($consultation_duration != "--") {echo date('H:i:s',strtotime($consultation_duration));} else{echo $consultation_duration;} ?></td>
										<!--td class="right"><?php echo currency_format($report['collection_amount']);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td-->
									</tr>
								
								<?php $i++; ?>
								<?php endforeach ?>
							</tbody>
							<?php } else { ?>
							<tbody>
								<tr>
									<td colspan="8"><?php echo $this->lang->line('norecfound');?></td>
								</tr>
							</tbody>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		
	</div>
</div>
</body>