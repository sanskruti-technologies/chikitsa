<?php
class Menu_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

	public function get_xml_check_by_module_name($module_name) {
		$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('chikitsa_xml_check'). " WHERE module_name = '".$module_name."';");
		//echo "<br/>".$this->db->last_query();
		return $query->row_array();
    }
	public function get_chikitsa_xml_check() {

		$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('chikitsa_xml_check'). " ;");
		//echo "<br/>".$this->db->last_query();
		return $query->result_array();

    }
	public function add_chikitsa_xml_check($data) {
		 $this->db->insert("chikitsa_xml_check",$data);
		//echo "<br/>".$this->db->last_query();
    }
	public function update_chikitsa_xml_check($data) {
		$this->db->where('module_name', $data['module_name']);
		$this->db->update('chikitsa_xml_check', $data);
	   //echo $this->db->last_query();
   }
	public function get_menu_array(){
		$this->db->order_by("menu_order", "asc");
		$query = $this->db->get('navigation_menu');
		$menus =  $query->result_array();
		$menu_array = array();	
		foreach($menus as $menu){
			
			$menu_array[$menu['menu_name']]['menu_order'] = $menu['menu_order'];
			$menu_array[$menu['menu_name']]['menu_url'] = $menu['menu_url'];
			$menu_array[$menu['menu_name']]['menu_icon'] = $menu['menu_icon'];
			$menu_array[$menu['menu_name']]['menu_text'] = $menu['menu_text'];
			$menu_array[$menu['menu_name']]['required_module'] = $menu['required_module'];
			$menu_array[$menu['menu_name']]['parent_name'] = $menu['parent_name'];
			$menu_array[$menu['menu_name']]['has_access'] = array();
			$menu_array[$menu['menu_name']]['child_menus'] = array();
		}
		foreach($menus as $menu){
			//Parent Menu
			if(!isset($menu_array[$menu['parent_name']]['child_menus'])){
				$menu_array[$menu['parent_name']]['child_menus'] = array();
				//$menu_array[$menu['parent_name']][['child_menus']]['has_access'] = array();
			}
			array_push($menu_array[$menu['parent_name']]['child_menus'] ,$menu['menu_name']);
			
		}
		$query = $this->db->get('menu_access');
		$menu_access = $query->result_array();
		foreach($menu_access as $access){
			if($access['allow']==1){
				if(!isset($menu_array[$access['menu_name']]['has_access'])){
					$menu_array[$access['menu_name']]['has_access'] = array();
				}
				array_push($menu_array[$access['menu_name']]['has_access'] ,$access['category_name']);
			}
		}
		
		return $menu_array;
	}
	public function find_menu($parent_name,$level) {
		$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('navigation_menu')." AS navigation_menu LEFT JOIN ".$this->db->dbprefix('menu_access')." AS menu_access ON menu_access.menu_name = navigation_menu.menu_name WHERE navigation_menu.parent_name = '$parent_name' AND menu_access.category_name = '$level' AND menu_access.allow = 1 ORDER BY navigation_menu.menu_order ASC");
		//echo $this->db->last_query();
		return $query->result_array();
    }
	public function find_version() {
		$query = $this->db->get('version');
		return $query->row_array();
	}
	public function get_menu_id($menu_name){
		$query = $this->db->get_where('navigation_menu', array('menu_name'=>$menu_name));
		$row = $query->row_array();

		return $row['id'];
	}
	public function has_access($menu_name,$level){

		if($level=='System Administrator'){
			return true;
		}else{
			$query_access = $this->db->get_where('menu_access', array('category_name'=>$level));
			$result_access = $query_access->result_array();

			$count_access= count($result_access);
			if($count_access != 0){
				foreach ($result_access as $access){
					if($access['menu_name']==$menu_name){
						if($access['allow']==1){
							return true;
						}else{
							return false;
						}
					}else{
						return false;
					}
				}
			}else{
				return false;
			}
		}
	}
	public function can_access($menu_name,$level){

		/*if($level=='System Administrator'){
			return true;
		}else{*/
			$query_access = $this->db->get_where('menu_access', array('category_name'=>$level,'menu_name'=>$menu_name));
			$result_access = $query_access->result_array();
			//print_r($result_access);
			//echo $this->db->last_query();
			$count_access= count($result_access);
			if($count_access != 0){
				foreach ($result_access as $access){
						if($access['allow']==1){
							return true;
						}else{
							return false;
						}
				}
			}else{
				return false;
			}
		//}
	}
	public function is_accessible($menu_name,$level){
			$query=$this->db->get_where('navigation_menu',array('menu_text'=>$menu_name));
			$result=$query->row_array();

			$query_access = $this->db->get_where('menu_access', array('category_name'=>$level,'menu_name'=>$result['menu_name']));
			$result_access = $query_access->result_array();
			//print_r($result_access);
			//echo $this->db->last_query();
			$count_access= count($result_access);
			if($count_access != 0){
				foreach ($result_access as $access){
						if($access['allow']==1){
							return true;
						}else{
							return false;
						}
				}
			}else{
				return false;
			}
	}
	public function is_module_active($module_name){
		if($module_name == ""){
			return TRUE;
		}
		$module_name_array = explode(",",$module_name);
		$this->db->where_in('module_name', $module_name_array);
		$query = $this->db->get('modules');
		//echo $this->db->last_query();
		if ($query->num_rows() > 0){
			$row = $query->row_array();
			if($row['module_status']==1){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}
	public function get_modules(){
		$query = $this->db->get_where('modules', array('module_status' => 1));
		$result = $query->result_array();

		
		return $result;
	}
	public function is_ad_enabled(){
		$this->db->select('ck_value');
		$query=$this->db->get_where('data',array('ck_key'=>'enable_ad'));
		$row=$query->row();
		if (!$row) {
			return FALSE;
		}else{

			if($row->ck_value == 1){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}
	public function is_active_menu($current_page,$current_menu){
		//Self Link
		$query = $this->db->get_where('navigation_menu',array('menu_url'=>$current_page,'menu_name'=>$current_menu));
		if($query->num_rows() > 0){
			return TRUE;
		}
		//First Parent
		$query = $this->db->get_where('navigation_menu',array('menu_url'=>$current_page,'parent_name'=>$current_menu));
		if($query->num_rows() > 0){
			return TRUE;
		}
		//Second Parent
		$query = $this->db->get_where('navigation_menu',array('menu_url'=>$current_page));
		$row = $query->row_array();

		$num_rows=$query->num_rows();
		
		if($num_rows!=0){
		
		$parent_name = $row['parent_name'];
		$query = $this->db->get_where('navigation_menu',array('menu_name'=>$parent_name));
		$row = $query->row_array();

			$num_rows=$query->num_rows();
			
			if($num_rows!=0){
			
		$parent_name = $row['parent_name'];
		if($parent_name == $current_menu){
			return TRUE;

		}
			}
		}
		return FALSE;
	}
	public function new_messages_count(){
		$query = $this->db->get_where('modules',array('module_name'=>'chat'));
		$row = $query->row_array();

		$num_rows=$query->num_rows();
		
		if($num_rows!=0){
		$module_status = $row['module_status'];
		if($module_status == 1){
			$user_id = $_SESSION['id'];
			$this->db->select('COUNT(chat_id) AS chat_count', FALSE);
			$this->db->from('chat');
			$this->db->where("chat_user_id_to" , $user_id);
			$this->db->where('chat_read_at IS NULL');
			$query = $this->db->get();
			$row = $query->row_array();

			return $row['chat_count'];
		}else{
			return -1;
		}

	}

	}

	public function get_data_value($key){
		$this->db->select('ck_value');
		$query=$this->db->get_where('data',array('ck_key'=>$key));
		$row=$query->row();
		if (!$row) {
			return "";
		}else{
			return $row->ck_value;
		}
	}
    public function check_valid_license(){
		$modules = $this->module_model->get_modules();
		$i = 0;
		foreach($modules as $module) {
		//Check for updates
		$module_name = $module['module_name'];
		$module_license_status[$i]['module_name'] = $module_name;

		//Check if License is Valid
		//http://YOURSITE.com/?edd_action=check_license&item_id=8&license=cc22c1ec86304b36883440e2e84cddff&url=http://licensedsite.com

		$parameters = array();
		$parameters['edd_action'] = 'check_license';
		$parameters['item_name'] = $module['module_display_name'];
		$parameters['license'] = $module['license_key'];
		$parameters['url'] = base_url();

		$encoded = "";
		foreach($parameters as $name => $value) {
			$encoded .= urlencode($name).'='.urlencode($value).'&';
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://chikitsa.net/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);

		$response = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($response, TRUE);
		$module_license_status[$i]['license_status'] = $data['license'];
		if($data['license'] == 'valid'){
			$this->module_model->activate_license($module_name);
		}else{
			$this->module_model->dectivate_license($module_name);
		}
		$i++;
		}
  	}
	public function get_updates_available(){
		
		$updates_available = 0;
		//Chikitsa Core Update
		$current_version = $this->config->item('current_version');
		$latest_version = $current_version;
		$today = date('Y-m-d');
		$yesterday = date('Y-m-d', strtotime('-1 days'));
		$doc = new DOMDocument();
		//echo base_url("about_chikitsa/$today.xml");
		if (@$doc->load( base_url("about_chikitsa/$today.xml") ) !== false){
			$chikitsa = $doc->getElementsByTagName( "chikitsa" );
			foreach( $chikitsa as $c ){
				$versions = $c->getElementsByTagName( "version" );
				$latest_version = $versions->item(0)->nodeValue;

				$links = $c->getElementsByTagName( "link" );
				$download_link = $links->item(0)->nodeValue;
			}

			//Chikitsa Upgrade required
			$current_version_int = (int)str_replace(".","",$current_version);
			$latest_version_int =  (int)str_replace(".","",$latest_version);
			if($current_version_int < $latest_version_int){
				$updates_available++;
			}

			//Check all extensions
			$module_status = array();
			$modules = $this->get_modules();
			$i = 0;
			foreach($modules as $module) {
				//Check for updates
				$module_name = $module['module_name'];
				$downloads = $doc->getElementsByTagName( "download" );
				foreach( $downloads as $download ){
					$extensions = $download->getElementsByTagName( "module" );
					$extension = $extensions->item(0)->nodeValue;
					if($extension == $module_name){
						$versions = $download->getElementsByTagName( "version" );
						$version = $versions->item(0)->nodeValue;
						$download_links = $download->getElementsByTagName( "download_link" );
						$download_link = $download_links->item(0)->nodeValue;
						if ($version > $module['module_version']){
							$updates_available++;
						}
					}
				}
			}
		}else{
			 //Dowload the xml
			 $this->load->helper('download');
			 // read file contents
			 $data = file_get_contents("https://chikitsa.net/chikitsa.xml");
			 write_file('./about_chikitsa/'.$today.'.xml', $data);
			$this->check_valid_license();
			 //Delete yesterday's file
			 unlink('./about_chikitsa/'.$yesterday.'.xml');
		}

		if($updates_available != 0){
			return $updates_available;
		}else{
			return "";
		}
		return "";
	}

	public function check_updates_available(){
		$updates_available = 0;
		$modules = $this->get_modules();
		
		$xml_data=$this->get_chikitsa_xml_check();
		foreach($xml_data as $x_data){
			if($x_data['module_name']=="chikitsa"){
				$current_version = $this->config->item('current_version');
				$latest_version = $x_data['xml_version'];
				$current_version_int = (int)str_replace(".","",$current_version);
				$latest_version_int =  (int)str_replace(".","",$latest_version);

				if($current_version_int < $latest_version_int){
					$updates_available++;
				}
			}else{
				foreach($modules as $module) {
					if($module['module_name']==$x_data['module_name']){
						
						$current_version=$module['module_version'];
						$latest_version = $x_data['xml_version'];

						$current_version_int = (int)str_replace(".","",$current_version);
						$latest_version_int =  (int)str_replace(".","",$latest_version);

						if($current_version_int < $latest_version_int){
							$updates_available++;
						}
						break;
					}
				}
			}
		}
		if($updates_available != 0){
			return $updates_available;
		}else{
			return "";
		}
	}

}
?>