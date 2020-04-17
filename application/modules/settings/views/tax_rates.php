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
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Advanced Tables -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('tax_rates');?>
				</div>
				<div class="panel-body">
					<a href="<?= site_url("settings/insert_tax_rate/");?>" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line("add")." ".$this->lang->line("tax_rate");?></a>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="tax_rate_table">
							<thead>
								<tr>
									<th><?php echo $this->lang->line("id");?></th>
									<th><?php echo $this->lang->line("tax_rate")." ".$this->lang->line("name");?></th>
									<th><?php echo $this->lang->line("tax_rate")." ".$this->lang->line("percentage");?></th>
									<th><?php echo $this->lang->line("action");?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach($tax_rates as $tax_rate){ ?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$tax_rate['tax_rate_name'];?></td>
										<td><?=$tax_rate['tax_rate'];?></td>
										<td>
											<a class="btn btn-primary btn-sm square-btn-adjust editbt" href="<?=site_url('settings/edit_tax_rate/'.$tax_rate['tax_id']);?>"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-danger btn-sm square-btn-adjust confirmDelete" href="<?=site_url('settings/delete_tax_rate/'.$tax_rate['tax_id']);?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
										</td>
									</tr>
									<?php $i++; ?>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--End Advanced Tables -->
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
$( window ).load(function() {

	$('.confirmDelete').click(function(){
		return confirm("<?=$this->lang->line('areyousure_delete');?>");
	})

    $("#tax_rate_table").dataTable({
		"pageLength": 50
	});
});
</script>
