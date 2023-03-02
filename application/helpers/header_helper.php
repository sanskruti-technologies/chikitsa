<?php
function get_header_data(){
	$CI = get_instance();
  $CI->load->model('settings/settings_model');
  $CI->load->model('admin/admin_model');
  $CI->load->model('module/module_model');
  $CI->load->model('menu_model');

	$clinic_id = $CI->session->userdata('clinic_id');
	$user_id = $CI->session->userdata('id');
	$header_data = array();
	$header_data['active_modules'] = $CI->module_model->get_active_modules();
	$header_data['clinic'] = $CI->settings_model->get_clinic($clinic_id);
	$header_data['clinic_id'] = $clinic_id;
	$header_data['level'] = $CI->session->userdata('category');
	if($CI->menu_model->is_module_active('frontend,')==1){
		$header_data['login_page'] ="frontend/images";
	}else{
		$header_data['login_page'] = get_main_page();
	}
	
	$header_data['software_name']= $CI->settings_model->get_data_value("software_name");
	$header_data['user'] = $CI->admin_model->get_user($user_id);
	$header_data['user_id'] = $user_id;
	return $header_data;
}

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