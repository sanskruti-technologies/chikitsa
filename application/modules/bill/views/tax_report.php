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

<div id="container-fluid">

	<div class="row">

		<div class="col-md-12">

			<div class="card shadow mb-4">

				<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('tax')." ".$this->lang->line('report');?></h5>
				</div>

				<div class="card-body">

					<?php echo form_open('bill/tax_report'); ?>

					<div class="col-md-12">

						<div class="col-md-3">

							<?php echo $this->lang->line('from_date');?>

							<input type="text" name="from_date" id="from_date" class="form-control" value="<?php if($from_date){ echo date($def_dateformate,strtotime($from_date));}?>" autocomplete="off"/>

						</div>

						<div class="col-md-3">

							<?php echo $this->lang->line('to_date');?>

							<input type="text" name="to_date" id="to_date" class="form-control" value="<?php if($to_date){ echo date($def_dateformate,strtotime($to_date));}?>" autocomplete="off"/>

						</div>

					</div>

					<div class="col-md-12">

						<button type="submit" name="submit" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('go');?></button>

						<button type="submit" name="export_to_excel" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('export_to_excel');?></button>

						<button type="submit" name="print_report" class="btn square-btn-adjust btn-primary btn-sm"><?php echo $this->lang->line('print_report');?></button>

					</div>

					<?php echo form_close(); ?>

				</div>

			</div>

		</div>



			<div class="col-md-12">

				<div class="card shadow mb-4">
					<div class="table-responsive">
						<div class="table-responsive">

							<table class="table table-striped table-bordered table-hover display responsive nowrap" id="appointment_report" >

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

									?>

									<?php endforeach ?>

								</tbody>

								<?php } ?>

								<tfoot>

									<tr>

										<th colspan="5"><?php echo $this->lang->line("total");?></th>

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

		$('#appointment_report').DataTable();

    });

</script>