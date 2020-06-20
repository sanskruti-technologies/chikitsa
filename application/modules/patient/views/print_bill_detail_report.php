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
<div id="page-inner">
	<h1><?php echo $this->lang->line("bill_report");?></h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="bill_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("sr_no");?></th>
									<!--th><?php echo $this->lang->line("clinic_name");?></th-->
									<th><?php echo $this->lang->line("bill")." ".$this->lang->line("date");?></th>

									<th><?php echo $this->lang->line("doctor") . ' ' . $this->lang->line("name");?></th>
									<th><?php echo $this->lang->line("patient_id");?></th>
									<th><?php echo $this->lang->line("patient_name");?></th>
									<th><?php echo $this->lang->line("bill")." ".$this->lang->line("no");?></th>

									<th style="text-align:right;"><?php echo $this->lang->line('bill') . ' ' . $this->lang->line('amount');?></th>
									<th style="text-align:right;"><?php echo $this->lang->line('payment_amount');?></th>
									<th style="text-align:right;"><?php echo $this->lang->line('due_amount');?></th>
								</tr>
							</thead>
							<tbody>
							<?php $bill_amt=0; $pay_amt=0; $due_amt=0;?>
							<?php if ($reports) { ?>
							<?php $i = 1; ?>
							<?php foreach ($reports as $report) { ?>
								<tr>
									<td><?php echo $i; ?></td>
									<!--td><?php echo $report['clinic_name']; ?></td-->
									<?php $bill_date = date($def_dateformate,strtotime($report['bill_date'])); ?>
									<td><?php echo $bill_date; ?></td>

									<td><?php echo $report['doctor_name']; ?></td>
									<td><?php echo $report['display_id']; ?></td>
                                    <td><?php echo $report['first_name'] . ' ' .$report['middle_name'] . ' ' . $report['last_name'] ?></td>
                                    <td><?php echo $report['bill_id']; ?></td>

                                    <td style="text-align:right;"><?php
											echo currency_format($report['total_amount']+$report[$tax_type.'_tax_amount']);
											

											$bill_amt=$bill_amt+$report['total_amount']+ $report[$tax_type.'_tax_amount'];
										?></td>
									<td style="text-align:right;"><?php
											echo currency_format($report['pay_amount']);
											

											$pay_amt=$pay_amt+$report['pay_amount'];
										?>
									</td>
									<td style="text-align:right;"><?php
											echo currency_format($report['total_amount']+$report[$tax_type.'_tax_amount'] - $report['pay_amount']);
											

											$due_amt=$due_amt+$report['total_amount'] + $report[$tax_type.'_tax_amount']- $report['pay_amount'];
										?></td>
                                </tr>
								<?php $i++; ?>
								<?php } ?>
								<script>
									$(window).load(function() {
										$('#bill_table').dataTable();
									});
								</script>

								<?php }else{ ?>
									<tr>
										<td colspan="10"><?php echo $this->lang->line('nobillsfound_for_selected_parameters');?></td>
									</tr>
								<?php } ?>
							</tbody>
							<thead>
								<tr>
									<th></th>
									<!--th></th-->
									<th></th>
									<th></th>									
									<th></th>
									<th></th>
									<th></th>
									<th style="text-align:right;"><?php echo currency_format($bill_amt);  ?></th>
									<th style="text-align:right;"><?php echo currency_format($pay_amt);  ?></th>
									<th style="text-align:right;"><?php echo currency_format($due_amt);  ?></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
