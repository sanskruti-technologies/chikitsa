<html>
    <head>
        <title><?php echo $this->lang->line('main_title');?> - <?php echo $this->lang->line('sign_in'); ?></title>
		<!-- BOOTSTRAP STYLES-->
		<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
		<!-- FONTAWESOME STYLES-->
		<link href="<?= base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet" />
		<!-- CUSTOM STYLES-->
		<link href="<?= base_url() ?>assets/css/custom.min.css" rel="stylesheet" />
	</head>
	<body>
		<div class="container">
			<div class="row text-center">
				<br/><br/><br/><br/><br/>
			</div>
			<div class="row ">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong><?=$this->lang->line('please_select');?></strong>
						</div>
						<?php if(isset($error)) { ?><div class="alert alert-danger"><?=$error;?></div><?php } ?>
						<?php if(isset($message)) { ?><div class="alert alert-info"><?=$message;?></div><?php } ?>
						<div class="panel-body">
							<?php echo form_open('login/set_options'); ?>   
							<?php if (in_array("centers", $active_modules)) { ?>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
								<select name="clinic_id" class="form-control">
									<?php foreach($clinics as $clinic){?> 
									<option value="<?=$clinic['clinic_id'];?>"><?=$clinic['clinic_name'];?></option>
									<?php } ?> 
								</select>
								<?php echo form_error('clinic_id','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<?php } ?>
							
							<button type="submit" name="submit" class="btn btn-primary square-btn-adjust"><?php echo $this->lang->line('select');?></button>
							<!--a class="btn btn-primary" href="<?=site_url('login/forgot_password');?>"><?php echo $this->lang->line('forgot_password');?></a-->
							<?php echo form_close(); ?>
						</div>
						
					</div>
				</div>
			</div>				
		</div>
	</body>
</html>
