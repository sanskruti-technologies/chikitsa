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
	$('#show_alert').click(function(event) {
		event.preventDefault();
		<?php if($show_nag_screen == 'screen2' && !empty($non_licence_activated_plugins)){?>
		$( "#nag_screen_modal" ).modal('toggle');	
		<?php } ?>
	});	
	$('#activate_plugins').click(function(event) {
		event.preventDefault();
		$( "#nag_screen_modal" ).modal('toggle');
	});	
	$('#update').click(function(event) {
		event.preventDefault();
		var url = $( "#show_alert" ).attr("href");
		setTimeout(function(){ window.location.replace(url);}, 500);
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
						<a id="show_alert" href="<?=site_url("module/dowload_chikitsa/".$download_link."/".$latest_version);?>" class="btn btn-success square-btn-adjust"><?=$software_name;?> <?=$latest_version;?> <?=$this->lang->line('chikitsa_new_version_available');?></a>
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

              ?>

							<?php }else{  ?>
								<a href="#" class="btn btn-default square-btn-adjust"><?=$this->lang->line('file_missing');?></a>
                <?php if($module['license_status'] == "active"){ ?>
                  <a href="<?=site_url('module/download_extension/'. $module['module_name']);?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('download_extension');?></a>
                <?php } ?>
              <?php }  ?>


              <?php
								/**Check License Status************************************************/
								if($module['license_key'] != ""){
									if($module['license_status'] != "active"){?>
										<a href="<?=base_url() . "index.php/module/activate_license_key/" . $module['module_name'];?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('activate');?> <?=$this->lang->line('license_key');?></a>
								<?php } ?>
								<a href="<?=base_url() . "index.php/module/license_key/" . $module['module_name'];?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('edit');?> <?=$this->lang->line('license_key');?></a>
								<?php }else{  ?>
								<a href="<?=base_url() . "index.php/module/license_key/" . $module['module_name'];?>" class="btn btn-success square-btn-adjust"><?=$this->lang->line('add');?> <?=$this->lang->line('license_key');?></a>
								<?php }  ?>

						</div>
					 </div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>



<div class="modal fade" id="nag_screen_modal" tabindex="-1" role="dialog" aria-labelledby="myNagScreenLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myNagScreenLabel">Activate Plugins</h4>
		</div>
		<div class="modal-body">
			<p>Your following extensions are not activated.</p>
			<ul>
			<?php foreach($non_licence_activated_plugins as $non_licence_activated_plugin){ ?>
				<li><?=$non_licence_activated_plugin['module_display_name'];?></li>
			<?php } ?>
			</ul>
			<div class="alert alert-danger">If you upgrade now, they might stop working</div> 
		</div>
		<div class="modal-footer">
			<a href="https://chikitsa.net/plugin-policy/" target="_blank" class="btn btn-primary activate_plugins" >Know More</a>
			<a id="activate_plugins" class="btn btn-primary activate_plugins" >Activate First</a>
			<a id="update" class="btn btn-danger remind_later" >Update Anyway</a>
		</div>
	</div>
	</div>
</div>
