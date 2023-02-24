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

	$level = $this->session->userdata('category');
	$version = $this->menu_model->find_version();
	$software_name = $this->menu_model->get_data_value('software_name');
	$copyright_text = $this->menu_model->get_data_value('copyright_text');
	$copyright_url  = $this->menu_model->get_data_value('copyright_url');
	$updates_available = $this->menu_model->get_updates_available();
	$current_page =  uri_string(current_url());

	$first_occur = strpos($current_page,"/",0);
	$second_occur = strpos($current_page,"/",$first_occur+1);
	if($second_occur > 0){
		$current_page = substr($current_page,0,$second_occur);
	}

?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
		<!-- Creating the dynamic menu -->
        <ul class="nav" id="main-menu">
			<?php
			$parent_name="";
			$result_top_menu = $this->menu_model->find_menu($parent_name,$level);
			foreach ($result_top_menu as $top_menu):
				$id = $top_menu['id'];
				$parent_name = $top_menu['menu_name'];
				//Does the user have access to this menu?
				if($this->menu_model->has_access($top_menu['menu_name'],$level)){
					if($this->menu_model->is_module_active($top_menu['required_module'])){ ?>
				<li>
					<a href="<?= site_url( $top_menu['menu_url'] ); ?>" <?php if($this->menu_model->is_active_menu($current_page,$top_menu['menu_name'])) echo "class='active-menu'";?>><i class="fa <?php echo $top_menu['menu_icon']; ?> fa-2x"></i><?php echo $this->lang->line($top_menu['menu_text']);  ?>
						<?php if($top_menu['menu_name'] == "modules" && $updates_available != "") {echo "<span class='available_updates'>".$updates_available."</span>";} ?>
					</a>

					<?php
						//Select all Childs
						$result_sub_menu = $this->menu_model->find_menu($parent_name,$level);
						$rowcount= count($result_sub_menu);
						if($rowcount != 0){?>
							<ul class="nav nav-second-level">
								<?php
								foreach ($result_sub_menu as $sub_menu){
									//Check access for sub menu
									if($this->menu_model->has_access($sub_menu['menu_name'],$level)){
										if($this->menu_model->is_module_active($sub_menu['required_module'])){ ?>
										<li>
											<a href="<?php echo site_url($sub_menu['menu_url']); ?>" <?php if($this->menu_model->is_active_menu($current_page,$sub_menu['menu_name'])) echo "class='active-menu'";?>><?php echo  $this->lang->line($sub_menu['menu_text']); ?></a>
											<?php //Select all Childs
												$result_sub_menu2 = $this->menu_model->find_menu($sub_menu['menu_name'],$level);
												$rowcount2= count($result_sub_menu2);
												if($rowcount2 != 0){?>
													<ul class="nav nav-third-level">
													<?php
													foreach ($result_sub_menu2 as $sub_menu2):
														if($this->menu_model->has_access($sub_menu2['menu_name'],$level)){
															if($this->menu_model->is_module_active($sub_menu2['required_module'])){ ?>
																<li><a href="<?php echo site_url($sub_menu2['menu_url']); ?>" <?php if($this->menu_model->is_active_menu($current_page,$sub_menu2['menu_name'])) echo "class='active-menu'";?>><?php echo $this->lang->line($sub_menu2['menu_text']); ?></a></li>
													<?php
															}
														}
													endforeach;
													?>
													</ul>
												<?php  } ?>
										</li>
										<?php  } ?>
									<?php  } ?>
								<?php  } ?>
							</ul>
						<?php  } ?>
				</li>
					<?php
					}
					}
			endforeach;

			?>

			<li>
				<a target="_blank" href="<?php echo $copyright_url;?>"><?php echo $copyright_text;?></a>
				<a target="_blank" href="<?php echo site_url("admin/about"); ?>"><?php echo $software_name;?> <?php echo $version['current_version']; ?></a>
			</li>
        </ul>

    </div>

</nav>

<div id="page-wrapper" >
