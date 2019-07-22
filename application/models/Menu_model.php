<?php
class Menu_model extends CI_Model {

    public function __construct() {
        $this->load->database();
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
			$query_access = $this->db->get_where('menu_access', array('category_name'=>$level, 'allow'=>1, 'menu_name'=>$menu_name));
			$result_access = $query_access->result_array();
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
		$parent_name = $row['parent_name']; 
		$query = $this->db->get_where('navigation_menu',array('menu_name'=>$parent_name));
		$row = $query->row_array();
		$parent_name = $row['parent_name'];
		if($parent_name == $current_menu){
			return TRUE;
		}
		return FALSE;
	}
	public function new_messages_count(){
		$query = $this->db->get_where('modules',array('module_name'=>'chat'));
		$row = $query->row_array();
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
			$data = file_get_contents("http://sanskruti.net/chikitsa/modules/chikitsa.xml");
			write_file('./about_chikitsa/'.$today.'.xml', $data);
			
			//Delete yesterday's file
			unlink('./about_chikitsa/'.$yesterday.'.xml'); 
		}
		
		if($updates_available != 0){
			return $updates_available;
		}else{
			return "";
		}
		
	}
}
?>