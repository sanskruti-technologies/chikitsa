<html>
    <head>
        <title><?php echo $this->lang->line('main_title');?> - <?php echo $this->lang->line('sign_in'); ?></title>

		<!-- BOOTSTRAP STYLES-->
		<link href="<?= base_url() ?>assets/css/bootstrap.css" rel="stylesheet" />
		<!-- FONTAWESOME STYLES-->
		<link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet" />
		<!-- CUSTOM STYLES-->
		<link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet" />
	</head>
	<body>
		<div class="container">
			<div class="row text-center">
				<br/><br/><br/><br/><br/>
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
					<h2>
					<?php if($clinic['clinic_logo'] != NULL){  ?>
						<img src="<?php echo base_url().$clinic['clinic_logo']; ?>" alt="Logo"  height="60" width="260" />
					<?php  }elseif($clinic['clinic_name'] != NULL){  ?>
						<?= $clinic['clinic_name'];?>
					<?php  } else { ?>
						<?= $software_name;?>
					<?php }  ?>
					</h2>
					<h3><?= $clinic['tag_line'];?></h3>
					<h5>( <?=$this->lang->line($instruction);?> )</h5>
				</div>
			</div>
			<div class="row ">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
					<div class="panel panel-default">
						<?php if(isset($error)) { ?><div class="alert alert-danger"><?=$this->lang->line($error);?></div><?php } ?>
						<?php if(isset($message)) { ?><div class="alert alert-info"><?=$this->lang->line($message);?></div><?php } ?>
						<div class="panel-body">
							<?php echo form_open('login/send_forgot_password_email'); ?>
							<div class="form-group input-group">
								<input type="text" name="new_password" id="email" class="form-control" placeholder="<?=$this->lang->line('new_password');?>" />
								<?php echo form_error('new_password','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group input-group">
								<input type="text" name="confirm_password" id="email" class="form-control" placeholder="<?=$this->lang->line('confirm_password');?>" />
								<?php echo form_error('confirm_password','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<button type="submit" name="submit" class="btn btn-primary"><?php echo $this->lang->line('reset_password');?></button>
							<?php echo form_close(); ?>
						</div>

					</div>
					<?php if($frontend_active){?>
					<a href="<?=site_url('login/index');?>" class="btn btn-primary"><?=$this->lang->line('login');?></a>
					<a href="<?=site_url();?>" class="btn btn-primary"><?php echo $this->lang->line('back_to'); ?><?= $clinic['clinic_name'];?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</body>
</html>
