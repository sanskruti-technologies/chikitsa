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

<script type="text/javascript" charset="utf-8">

$(document).ready(function (){

	var table= $("#issue_refund_table").DataTable({

		"pageLength": 50

	});

	$('.confirmDelete').click(function(){

		return confirm('<?=$this->lang->line('areyousure_delete');?>');

	});

	table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
	$('#btn-show-all-children').on('click', function(){
		// Expand row details
		table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
	});
	// Handle click on "Collapse All" button
	$('#btn-hide-all-children').on('click', function(){
		// Collapse row details
		table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
	});
	$('.confirmDelete').click(function(){
		return confirm("<?=$this->lang->line('areyousure_delete');?>");
	});

});

</script>

<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line("refund");?></h5></br>
		</div>
		<div class="card-body">
			
				<a href="<?=site_url('payment/add_issue_refund');?>" class="btn square-btn-adjust btn-primary btn-sm right"><i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('add_refund');?></a>
				</br>&nbsp;
				<div class="text-align">
								<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-show-all-children" type="button"><?=$this->lang->line('expand_all');?></button>
								<button class="btn square-btn-adjust btn-primary btn-sm" id="btn-hide-all-children" type="button"><?=$this->lang->line('collapse_all');?></button>
				</div>&nbsp;
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover display responsive nowrap" id="issue_refund_table">
						<thead>

							<tr>

								<th><?php echo $this->lang->line("sr_no");?></th>

								<th><?php echo $this->lang->line("date");?></th>

								<th><?php echo $this->lang->line("patient");?></th>

								<th><?php echo $this->lang->line("amount");?></th>

								<th><?php echo $this->lang->line("action");?></th>

							</tr>

						</thead>

						<tbody>

							<?php $i=1; ?>

							<?php foreach ($refunds as $refund):  ?>

								<tr <?php if ($i%2 == 0) { echo "class='even'"; } else { echo "class='odd'"; }?> >

									<td><?php echo $i; ?></td>

									<td><?php echo date($def_dateformate,strtotime($refund['refund_date'])); ?></td>

									<td><?php echo $patient_name[$refund['patient_id']]; ?></td>

									<td><?php echo currency_format($refund['refund_amount']); ?></td>

									<td><a href="<?= site_url('payment/edit_refund/'.$refund['refund_id']);?>" class="btn btn-sm btn-primary square-btn-adjust"><i class="fa fa-edit"></i><?php echo $this->lang->line("edit");?></a>

										<a href="<?= site_url('payment/delete_refund/'.$refund['refund_id']);?>" class="btn btn-sm btn-danger square-btn-adjust confirmDelete"><i class="fa fa-trash"></i><?php echo $this->lang->line("delete");?></a>

									</td>

								</tr>

							<?php $i++; ?>

							<?php endforeach ?>

						</tbody>

					</table>

				</div>

		</div>
	</div>
</div>