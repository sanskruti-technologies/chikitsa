<?php

function get_main_page(){
	
	$CI = get_instance();
    $CI->load->model('menu_model');

	$level = $CI->session->userdata('category');
	$login_page = "appointment/index";
	$parent_name = "";
	$result_top_menu = $CI->menu_model->find_menu($parent_name,$level);
	foreach ($result_top_menu as $top_menu){
		$id = $top_menu['id'];
		$parent_name = $top_menu['menu_name'];
		if($CI->menu_model->has_access($top_menu['menu_name'],$level)){ 
			if($CI->menu_model->is_module_active($top_menu['required_module'])){
				$result_sub_menu = $CI->menu_model->find_menu($parent_name,$level);
				$rowcount= count($result_sub_menu);	
				if($rowcount != 0){
					foreach ($result_sub_menu as $sub_menu){	
						if($CI->menu_model->has_access($sub_menu['menu_name'],$level)){ 
							if($CI->menu_model->is_module_active($sub_menu['required_module'])){
								$login_page = $sub_menu['menu_url'];
								break;
							}
						}
					}
				}else{
					$login_page = $top_menu['menu_url'];
					break;
				}
			}
		}
	}
}

?>
