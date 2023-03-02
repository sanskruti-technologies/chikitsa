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

$(window).load(function() {

    $('.confirmDeactivate').click(function(){

		return confirm(<?=$this->lang->line('areyousure_deactivate');?>);

	});

} )

</script>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
			<h5 class="m-0 font-weight-bold text-primary">
			<?php echo $this->lang->line('upload_extension');?>
			</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<br/>

					<?php if (isset($error)) { ?><div class="alert alert-danger"><?php echo $error; ?></div> <?php } ?>

					<br/>

					<strong><?=$this->lang->line('upload_extention_instruction');?></strong>

				</div>
				<div class="col-md-12">



					<?php echo form_open_multipart('module/upload_module/') ?>

						<div class="form-group">

							<input type="file" id="extension" name="extension" class="form-control" size="20" />

						</div>

						<div class="form-group">

							<button class="btn btn-primary btn-sm square-btn-adjust btn-sm" type="submit" name="submit" /><?php echo $this->lang->line('install');?></button>
							<a href="<?=base_url() . "index.php/module/index/";?>" class="btn square-btn-adjust btn-primary btn-sm confirmDeactivate"><?=$this->lang->line('back');?></a>
						</div>

					<?php echo form_close(); ?>

				</div>
				<div class="col-md-12">

					

				</div>
			</div>
		</div>
	</div>
</div>