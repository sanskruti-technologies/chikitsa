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



	$reference_option = "";

	$placeholder = "";

	$reference_add_option = 0;

	if(isset($reference)){

		$reference_id = $reference['reference_id'];

		$reference_option = $reference['reference_option'];

		$reference_add_option = $reference['reference_add_option'];

		$placeholder = $reference['placeholder'];

	}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary"><?php echo $this->lang->line('reference_by');?></h5>	
		</div>
		<div class="card-body" >

					<?php if(isset($reference)){

						echo form_open('settings/edit_reference/'.$reference_id);

					}else{

						echo form_open('settings/add_reference');

					} ?>

						<div class="row">

							<div class="col-md-3">

								<div class="form-group" >

									<label for="reference_option"><?php echo $this->lang->line('option');?></label>

									<input type="input" name="reference_option" value="<?=$reference_option;?>" class="form-control"/>

								</div>

							</div>

							<div class="col-md-3">

								<div class="form-group" >

									<label for="reference_add_option"><?php echo $this->lang->line('add_detail');?>

									<input type="checkbox" name="reference_add_option" class="form-control" value="1" <?php if($reference_add_option ==1) { echo "checked"; } ?>/></label>

								</div>

							</div>

							<div class="col-md-3">

								<div class="form-group" >

									<label for="placeholder"><?php echo $this->lang->line('placeholder');?></label>

									<input type="input" name="placeholder" value="<?=$placeholder;?>" class="form-control"/>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col-md-3">

								<div class="form-group text-align" >

									<button type="submit" name="submit" class="btn square-btn-adjust btn-primary btn-sm" /><?php echo $this->lang->line('save');?></button>

									<a class="btn square-btn-adjust btn-primary btn-sm" href="<?=site_url('settings/reference_by');?>" ><?php echo $this->lang->line('back');?></a>

								</div>

							</div>

						</div>
					

					<?php echo form_close(); ?>

		</div>
	</div>
</div>