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

	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://chikitsa.net/wp-json/chikitsa_extension/v1/all");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output_value = curl_exec($ch);
	curl_close($ch);

	$server_output = json_decode($server_output_value,true);



	if(is_array($server_output)){
		//start Chikitsa xml 
		$chikitsa_xml_check = $this->menu_model->get_chikitsa_xml_check();
		if(sizeof($chikitsa_xml_check) <=0) {
			//insert details of xml file to table 
			foreach ($server_output as $key => $module_value){
				
				//for chikitsa
				if($key=='chikitsa'){
					$data['last_checked_date']=$module_value['last_modified_date'];
					$data['module_name']=$key;
					$data['xml_version']=$module_value['version'];
					$data['xml_content']=json_encode($module_value);
					
					//insert chikitsa data to table 
					$chikitsa_xml_check = $this->menu_model->add_chikitsa_xml_check($data);

					
				}else{
					foreach ($module_value as $key => $extension){
						$data['last_checked_date']=$extension['last_updated'];
						$data['module_name']=$key;
						$data['xml_version']=$extension['version'];
						$data['xml_content']=json_encode($extension);

						//insert extensions data to table 
						$chikitsa_xml_check = $this->menu_model->add_chikitsa_xml_check($data);
						
					}
				}	
			}
			
			

		}else{
			
			foreach ($server_output as $key => $module_value){
				
				//for chikitsa
				if($key=='chikitsa'){
					
					foreach($chikitsa_xml_check as $table_value){
						if($table_value['module_name']=='chikitsa'){
							if(	$table_value['module_name']==$key){
								if(strtotime($table_value['last_checked_date']) < strtotime($module_value['last_modified_date'])){
									$update_data['module_name']=$key;
									$update_data['last_checked_date']=$module_value['last_modified_date'];
									$update_data['xml_content']=json_encode($module_value);;
									$update_data['xml_version']=$module_value['version'];
									$chikitsa_xml_check = $this->menu_model->update_chikitsa_xml_check($update_data);
								}
							}

						}else{
							break;
						}
					}
					
				}else{
					//FOR ALL EXTENSIONS 	
					foreach($chikitsa_xml_check as $table_value){
						foreach ($module_value as $key => $extension){
							if(	$table_value['module_name']==$key){
								if(strtotime($table_value['last_checked_date']) < strtotime($extension['last_updated'])){
									$update_data['module_name']=$key;
									$update_data['last_checked_date']=$extension['last_updated'];
									$update_data['xml_version']=$extension['version'];
									$update_data['xml_content']=json_encode($extension);
									$chikitsa_xml_check = $this->menu_model->update_chikitsa_xml_check($update_data);
								}
							}
						}
					}
				}	
			}
		}

		$updates_available = $this->menu_model->check_updates_available();

		//end xml 

	}


		$level = $this->session->userdata('category');
		$version = $this->menu_model->find_version();
		$software_name = $this->menu_model->get_data_value('software_name');
		$copyright_text = $this->menu_model->get_data_value('copyright_text');
		$copyright_url  = $this->menu_model->get_data_value('copyright_url');
		//$updates_available = $this->menu_model->get_updates_available();

		$current_page =  uri_string(current_url());
		$first_occur = strpos($current_page,"/",0);
		$second_occur = strpos($current_page,"/",$first_occur+1);
		if($second_occur > 0){
			$current_page = substr($current_page,0,$second_occur);
		}

?>
<!-- Sidebar -->

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">
		
        <!-- Sidebar - Brand -->
		<div class="desktopLogo">
	    <?php if($clinic['clinic_logo'] != NULL){  ?>
			<a class="sidebar-brand d-flex align-items-center justify-content-center" style="padding:0px;background:#FFF;" href="<?= site_url($login_page); ?>">
				<img src="<?php echo base_url().$clinic['clinic_logo']; ?>" alt="Logo"  height="60"  />
			</a>
		<?php  }elseif($clinic['clinic_name'] != NULL){  ?>
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url($login_page); ?>">
				<?= $clinic['clinic_name'];?>
			</a>
		<?php  } else { ?>
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url($login_page); ?>">
				<?= $software_name;?>
			</a>
		<?php }  ?>
		</div>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

	  <?php
		$menus = $this->menu_model->get_menu_array();
		

		foreach($menus as $menu_name => $menu){
			$active = "";
			//if($this->menu_model->has_access($menu['parent_name']),$level)){
			if($this->menu_model->is_module_active($menu['required_module'])){
				if(!isset($menu['parent_name']) || $menu['parent_name'] == ""){
					if (isset($menu['has_access']) && in_array($level, $menu['has_access'])){
						//if (isset($menu['required_module'])  && $menu['required_module']!= ""&& in_array($menu['required_module'],$active_modules)){
							$number_of_child = 0;
							if(isset($menu['child_menus'])){
								$number_of_child = count($menu['child_menus']);
							}
							if( isset($menu['menu_url']) && $menu['menu_url'] == $this->uri->segment(1)."/".$this->uri->segment(2)){
								$active = "active";
							} 
					?>
					<?php if($number_of_child > 0 || isset($menu['menu_url'])){ ?>
					<li class="nav-item <?=$active;?>">
						<?php if($number_of_child > 0){ ?>
						<a class="nav-link " href="#" data-toggle="collapse" data-target="#collapse_<?=$menu_name;?>" aria-expanded="true" aria-controls="collapse_<?=$menu_name;?>">
						<?php }else{ ?>
						<?php if(isset($menu['menu_url'])){ ?>
						<a class="nav-link" href="<?= site_url( $menu['menu_url'] ); ?>">
						<?php }else{ ?>
						<a class="nav-link" href="#">

						<?php } ?>
						<?php } ?>
							<?php if(isset($menu['menu_icon'])){ ?>
							<i class="fas fa-fw <?php echo $menu['menu_icon']; ?>"></i>
							<?php } ?>
							<?php if(isset($menu['menu_text'])){ ?>
								
							<span><?php echo $this->lang->line($menu['menu_text']);  ?></span>
							<?php } ?>
							<?php if($menu_name == "modules" && $updates_available != "") {echo "<span class='available_updates'>".$updates_available."</span>";} ?>
						</a>
						<?php if($number_of_child > 0){ ?>
						<div id="collapse_<?=$menu_name;?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<?php foreach($menu['child_menus'] as $child_menu) { 
								?>
								<?php foreach($menus as $child_menu_name => $child_menu_detail) { ?>
									<?php if($child_menu_name == $child_menu) {  ?>
										<?php if(count($child_menu_detail['child_menus']) > 0){ 
											if($this->menu_model->is_module_active($child_menu_detail['required_module'])){
											if (($this->menu_model->is_accessible($child_menu_detail['menu_text'],$level))){
											?>
											<h6 class="collapse-header"><?php echo $this->lang->line($child_menu_detail['menu_text']);?></h6>
											<?php foreach($child_menu_detail['child_menus'] as $grandchild_menu) { ?>
												<?php foreach($menus as $grand_child_menu_name => $grand_child_menu_detail) { ?>
													<?php
													if (($this->menu_model->is_accessible($grand_child_menu_detail['menu_text'],$level))){
														if($this->menu_model->is_module_active($grand_child_menu_detail['required_module'])){
														if($grand_child_menu_name == $grandchild_menu) { ?>
														<?php $active = ""; ?>
														<?php if( isset($grand_child_menu_detail['menu_url']) && $grand_child_menu_detail['menu_url'] == $this->uri->segment(1)."/".$this->uri->segment(2)){
															$active = "active";
														}?>
														<a class="collapse-item <?=$active;?>" href="<?= site_url( $grand_child_menu_detail['menu_url'] ); ?>"><?php echo $this->lang->line($grand_child_menu_detail['menu_text']);?>
															<?php
																//echo $grand_child_menu_detail['menu_text'];
																//echo $this->menu_model->is_accessible($grand_child_menu_detail['menu_text'],$level);
															?>
														</a>
													<?php
														} }
													} 
												?>
												<?php } ?>
											<?php 
											}
										}} ?>
											<!--<hr class="sidebar-divider">-->
										<?php }else{ ?>
										<?php
										if (($this->menu_model->is_accessible($child_menu_detail['menu_text'],$level)) ){
											if ( ($this->menu_model->is_module_active($child_menu_detail['required_module']))){
										?>
											<?php $active = ""; ?>
											<?php if( isset($child_menu_detail['menu_url']) && $child_menu_detail['menu_url'] == $this->uri->segment(1)."/".$this->uri->segment(2)){
												$active = "active";
											}?>
											<a class="collapse-item <?=$active;?>" href="<?= site_url( $child_menu_detail['menu_url'] ); ?>"><?php echo $this->lang->line($child_menu_detail['menu_text']);?>
												<?php
													//echo $child_menu_detail['menu_text'];
													//echo ":";
													//echo $this->menu_model->is_accessible($child_menu_detail['menu_text'],$level);
												?>
											</a>
										<?php 
											}
										}
										} ?>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						</div>
						</div>
						<?php } ?>
					</li>
					<?php } ?>
				<?php //}
					}
				}
			}
			//}else{
			//	$this->load->view('templates/access_forbidden');
			//}
		}
		?>
		<li class="nav-item">

		<a class="nav-link" target="_blank" href="<?php echo $copyright_url;?>"><span class="direction_left">© <?=date('Y');?> Sanskruti Technologies</span></a>

		<a class="nav-link" target="_blank" href="<?php echo site_url("admin/about"); ?>"><span><?php echo $software_name;?> <?php echo $version['current_version']; ?></span></a>

		</li>
    </ul>
    <!-- End of Sidebar -->
	<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

				<div class="mobileLogo">
					<?php if($clinic['clinic_logo'] != NULL){  ?>
						<a class="sidebar-brand d-flex align-items-center justify-content-right" style="padding:5px;background:#FFF;" href="<?= site_url($login_page); ?>">
							<img src="<?php echo base_url().$clinic['mobile_clinic_logo']; ?>" alt="Logo"  height="50"  />
						</a>
					<?php  }elseif($clinic['clinic_name'] != NULL){  ?>
						<a class="sidebar-brand d-flex align-items-center justify-content-right" href="<?= site_url($login_page); ?>">
							<?= $clinic['clinic_name'];?>
						</a>
					<?php  } else { ?>
						<a class="sidebar-brand d-flex align-items-center justify-content-right" href="<?= site_url($login_page); ?>">
							<?= $software_name;?>
						</a>
					<?php }  ?>
				</div>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
			<!-- Nav Item - User Information -->
			
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <!--<li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>

            </li>-->
			<!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle profile" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$user['name'];?></span>

				<?php if($user['profile_image']!=""){ ?>
				<img class="img-profile rounded-circle" src="<?php echo base_url()."uploads/profile_picture/". $user['profile_image']; ?>" alt="Profile Image"  height="100" width="100" />
				<?php }else{ ?>
				<img class="img-profile rounded-circle" src="<?php echo base_url()."uploads/images/Profile.png"; ?>" alt="Profile Image"  height="100" width="100" />
				<?php } ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?=site_url("admin/change_profile"); ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?php echo $this->lang->line("profile");?>
                </a>
                <?php
					/*$new_messages = $this->menu_model->new_messages_count();
					if($new_messages > 0){
				?>
				<a data-notifications="<?=$new_messages;?>" href="<?=site_url("chat/index"); ?>" class="btn btn-primary square-btn-adjust"><i class="fa fa-bell" aria-hidden="true"></i></a>
				<?php } elseif($new_messages == 0) { ?>
				<a href="<?=site_url("chat/index");?>" class="btn btn-primary square-btn-adjust"><i class="fa fa-bell" aria-hidden="true"></i></a>
				<?php } */?>
				<?php if (in_array("centers", $active_modules)) { ?>
				<a href="<?=site_url("centers/change_center"); ?>" class="btn btn-primary square-btn-adjust">Change Center</a>
				<?php } ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= site_url("login/logout"); ?>" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?php echo $this->lang->line("logout");?>
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

		<script type="text/javascript" charset="utf-8">
			function mobileViewUpdate() {
				var width = $(window).width();
				//alert(width);
				if (width < 600) {
					$('ul').removeClass('toggled');
					$('ul').addClass('toggled');
				}else{
					$('ul').removeClass('toggled');
				}
			}
			$(window).load(mobileViewUpdate);
			$(window).resize(mobileViewUpdate);
		</script>