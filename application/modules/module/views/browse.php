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
		return confirm("<?=$this->lang->line('areyousure_deactivate');?>");
	});
	$('.confirmClearData').click(function(){
		return confirm("<?=$this->lang->line('areyousure_cleardata');?>");
	});
} )
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<?php
				if($connection_message != NULL){
					?><div class="alert alert-danger"><?=$connection_message;?></div><?php
				}
			?>
			<?php
			if($message != NULL){
				if($message_type == "error"){
					?><div class="alert alert-danger"><?=$message?></div><?php
				}else{
					?><div class="alert alert-success"><?=$message?></div><?php
				}
			}
			?>
			<div class="col-md-12">
				<?php
					$current_version = $this->config->item('current_version');
					$latest_version = $current_version;
					$doc = new DOMDocument();
					$doc->load( "http://chikitsa.net/chikitsa.xml" );//xml file loading here

					$chikitsa = $doc->getElementsByTagName( "chikitsa" );
					foreach( $chikitsa as $c ){
						$versions = $c->getElementsByTagName( "version" );
						$latest_version = $versions->item(0)->nodeValue;

						$links = $c->getElementsByTagName( "link" );
						$download_link = $links->item(0)->nodeValue;
					}
					$current_version_int = (int)str_replace(".","",$current_version);
					$latest_version_int =  (int)str_replace(".","",$latest_version);
					if($current_version_int < $latest_version_int){ ?>
						<a href="<?=site_url("module/dowload_chikitsa/".$download_link."/".$latest_version);?>" class="btn btn-success square-btn-adjust"><?=$software_name;?> <?=$latest_version;?> <?=$this->lang->line('chikitsa_new_version_available');?></a>
				<?php } ?>

			</div>
			<div class="col-md-12">
				<h3><?php echo $this->lang->line('extensions'); ?></h3>
				<a href="<?=base_url() . "index.php/module/add/";?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('add_extension');?></a>
			</div>
			<?php foreach($modules as $module) { ?>
				<div class="col-md-4">
				 <?php if($module['module_status']==1) { ?>
					<div class="panel panel-back noti-box" style="background-color:#5cb85c96 !important;">
				 <?php } else { ?>
					<div class="panel panel-back noti-box" style="background-color:#e6e6e6 !important;">
				 <?php } ?>
						<div class="text-box">
							<p class="main-text"><?=$module['module_display_name'] ;?></p>
							<p><?=$module['module_version'] ;?></p>
							<p class="text-muted"><?=$module['module_description'] ;?></p>
							<?php //Check if folder exists ?>
							<?php $dir_name =  './application/modules/'.$module['module_name']; ?>
							<?php if (file_exists($dir_name) && is_dir($dir_name)) {
									/**Check Module Status************************************************/
									if($module['module_status']==1) { ?>
									<a href="<?=base_url() . "index.php/module/deactivate_module/" . $module['module_name'];?>" class="btn btn-danger square-btn-adjust confirmDeactivate"><?=$this->lang->line('deactivate');?></a>
								<?php } else { ?>
									<a href="<?=base_url() . "index.php/module/activate_module/" . $module['module_name'];?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('activate');?></a>
									<a href="<?=base_url() . "index.php/module/clear_data/" . $module['module_name'];?>" class="btn btn-warning square-btn-adjust confirmClearData"><?=$this->lang->line('clear_data');?></a>
								<?php }

								$module_name = $module['module_name'];
								foreach($module_license_status as $module_status){
									if($module_status['module_name'] == $module_name){
										if($module_status['module_status'] == 'update_required'){
											if($module_status['license_status'] == 'valid'){
												?><a href="<?=base_url() . "index.php/module/update_extension/" . $module['module_name'];?>" class="btn btn-warning square-btn-adjust"><?=$this->lang->line('update');?></a><?php
											}else{
												?><a href="https://chikitsa.net/" target="_blank"  class="btn btn-warning square-btn-adjust"><?=$this->lang->line('renew_license_to_update');?></a><?php
											}
										}
									}
								}


								/**Check License Status************************************************/
								if($module['license_key'] != ""){
									if($module['license_status'] != "active"){?>
										<a href="<?=base_url() . "index.php/module/activate_license_key/" . $module['module_name'];?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('activate');?> <?=$this->lang->line('license_key');?></a>
								<?php } ?>
								<a href="<?=base_url() . "index.php/module/license_key/" . $module['module_name'];?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('edit');?> <?=$this->lang->line('license_key');?></a>
								<?php }else{  ?>
								<a href="<?=base_url() . "index.php/module/license_key/" . $module['module_name'];?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('add');?> <?=$this->lang->line('license_key');?></a>
								<?php }  ?>
							<?php }else{  ?>
								<a href="#" class="btn btn-default square-btn-adjust"><?=$this->lang->line('file_missing');?></a>
							<?php }  ?>

						</div>
					 </div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>