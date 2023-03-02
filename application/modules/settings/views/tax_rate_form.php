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

	if(isset($tax_rate)){

		$edit = TRUE;

		$tax_id = $tax_rate['tax_id'];

		$tax_rate_name = set_value('tax_rate_name',$tax_rate['tax_rate_name']);

		$tax_rate = set_value('tax_rate',$tax_rate['tax_rate']);

	}else{

		$edit = FALSE;

		$tax_rate_name = set_value('tax_rate_name','');

		$tax_rate = set_value('tax_rate','');

	}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
			<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('tax_rate');?></h5>
		</div>
			<div class="card-body">

				<?php if($edit){ ?>

				<?php echo form_open('settings/edit_tax_rate/'.$tax_id) ?>

				<?php }else{ ?>

				<?php echo form_open('settings/insert_tax_rate') ?>

				<?php } ?>

				<div class="form-group">
					<?php
					$readonly="";
						if($tax_rate_name=='Vat Tax'){
							$readonly="readonly";
						}
					?>

						<label for="tax_rate_name"><?php echo $this->lang->line('tax_rate')." ".$this->lang->line('name');?></label>

						<input type="text" <?=$readonly?> name="tax_rate_name" id="tax_rate_name" value="<?=$tax_rate_name;?>" class="form-control"/>

						<?php echo form_error('tax_rate_name','<div class="alert alert-danger">','</div>'); ?>

					</div>

					<div class="form-group">

						<label for="tax_rate"><?php echo $this->lang->line('tax_rate')." ".$this->lang->line('percentage');?></label>

						<input type="text" name="tax_rate" id="tax_rate" value="<?=$tax_rate;?>" class="form-control"/>

						<?php echo form_error('tax_rate','<div class="alert alert-danger">','</div>'); ?>

					</div>

					<div class="form-group">

						<button type="submit" name="submit" class="btn square-btn-adjust btn-primary btn-sm right" /><?php echo $this->lang->line('save');?></button>

					</div>

				<?php echo form_close(); ?>

			</div>
	</div>
</div>