<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('about');?>
			</div>
			<div class="panel-body">
				<h4> <?php  echo $software_name." " .$version['current_version'] ?></h4>

				<p><strong><?php echo $this->lang->line('website');?> : </strong><a href="<?php echo $website_url;?>"><?php echo $website_text;?></a> <br>
				<strong><?php echo $this->lang->line('support');?> : </strong><a href="<?php echo $support_url;?>"><?php echo $support_text;?></a></p>
				<br>
				<?php  echo $about_us_content; ?>
			</div>
		</div>
	</div>
</div>
<!-- JQUERY SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-1.11.3.js"></script>
<!-- JQUERY UI SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="<?= base_url() ?>assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="<?= base_url() ?>assets/js/custom.js"></script>