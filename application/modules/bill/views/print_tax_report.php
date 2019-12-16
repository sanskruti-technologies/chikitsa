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
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
						<h2><?php echo $this->lang->line('tax')." ".$this->lang->line('report');?></h2>
					</div>
					<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="appointment_report" >
						<thead>
							<tr>
								<th><?php echo $this->lang->line("sr_no");?></th>
								<th><?php echo $this->lang->line('patient')." ".$this->lang->line('id');?></th>
								<th><?php echo $this->lang->line('patient')." ".$this->lang->line('name');?></th>
								<th><?php echo $this->lang->line('invoice')." #";?></th>
								<th><?php echo $this->lang->line('invoice')." ".$this->lang->line('date');?></th>
								<th><?php echo $this->lang->line('taxable_revenue');?></th>
								<th><?php echo $this->lang->line('non_taxable_revenue');?></th>
								<th><?php echo $this->lang->line('total');?></th>
								<th><?php echo $this->lang->line('tax_revenue');?></th>
								<th><?php echo $this->lang->line('discount');?></th>
								<th><?php echo $this->lang->line('invoice') ." ".$this->lang->line('total');?></th>

							</tr>
						</thead>
						<?php
						$total_taxable_revenue = 0;
						$total_non_taxable_revenue = 0;
						$grand_total = 0;
						$total_tax_revenue = 0;
						$total_discount = 0;
						?>
						<?php if ($tax_report) {?>
						<tbody>
							<?php $i=1; ?>
							<?php foreach ($tax_report as $row):  ?>
								<tr <?php if ($i%2 == 0) { echo "class='even'"; }else{ echo "class='odd'"; } ?> >
									<td><?php echo $i;?></td>
									<td><?=$row['display_id'];?></td>
									<td><?=$row['first_name']." ".$row['middle_name']." ".$row['last_name'];?></td>
									<td><?=$row['bill_id']; ?></td>
									<td><?=date($def_dateformate,strtotime($row['bill_date'])); ?></td>
									<td style="text-align:right;"><?=currency_format($row['taxable_amount']);?></td>
									<td style="text-align:right;"><?=currency_format($row['non_taxable_amount']);?></td>
									<td style="text-align:right;"><?=currency_format($row['taxable_amount'] + $row['non_taxable_amount']);?></td>
									<td style="text-align:right;"><?=currency_format($row[$tax_type.'_tax_amount']);?></td>
									<td style="text-align:right;"><?=currency_format($row['discount']);?></td>
									<td style="text-align:right;"><?=currency_format($row['taxable_amount'] + $row['non_taxable_amount'] + $row[$tax_type.'_tax_amount'] - $row['discount']);?></td>
								</tr>

							<?php $i++;
							$total_taxable_revenue = $total_taxable_revenue + $row['taxable_amount'];
							$total_non_taxable_revenue = $total_non_taxable_revenue + $row['non_taxable_amount'];
							$grand_total = $grand_total + $row['taxable_amount'] + $row['non_taxable_amount'];
							$total_tax_revenue = $total_tax_revenue + $row[$tax_type.'_tax_amount'];
							$total_discount = $total_discount + $row['discount'];
							endforeach ?>
						</tbody>
						<?php } ?>
						<tfoot>
							<tr>
								<th colspan="5" style="text-align:left;"><?php echo $this->lang->line("total");?></th>
								<th style="text-align:right;"><?=currency_format($total_taxable_revenue);?></th>
								<th style="text-align:right;"><?=currency_format($total_non_taxable_revenue);?></th>
								<th style="text-align:right;"><?=currency_format($grand_total);?></th>
								<th style="text-align:right;"><?=currency_format($total_tax_revenue);?></th>
								<th style="text-align:right;"><?=currency_format($total_discount);?></th>
								<th style="text-align:right;"><?=currency_format($grand_total + $total_tax_revenue - $total_discount);?></th>

							</tr>
						</tfoot>
					<table>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
