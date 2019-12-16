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
					<h2><?=$this->lang->line('patient_report');?></h2>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="appointment_report" >
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<th><?php echo $this->lang->line("id");?></th>
									<th><?php echo $this->lang->line("name");?></th>
									<th><?php echo $this->lang->line("phone_number");?></th>
									<th><?php echo $this->lang->line("email");?></th>
									<th><?php echo $this->lang->line("reference_by");?></th>
									<th><?php echo $this->lang->line("follow_up");?></th>
								</tr>
							</thead>
							<?php if ($patient_report) {?>
							<?php $i=1;?>
							<tbody>
								<?php foreach($patient_report as $patient){
						$followup_date = "";

						if($patient['followup_date'] != '0000-00-00' && $patient['followup_date'] != NULL){
							$followup_date = date($def_dateformate,strtotime($patient['followup_date']));
						}
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $patient['display_id'];?></td>
							<td><?php echo $patient['first_name'] . " " .$patient['middle_name']. "  ".$patient['last_name'];?></td>
							<td><?php echo $patient['phone_number'];?></td>
							<td><?php echo $patient['email'];?></td>
							<td><?php echo $patient['reference_by'];?></td>
							<td><?php echo $followup_date;?></td>
						</tr>
						<?php $i++; ?>
					<?php }?>
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
