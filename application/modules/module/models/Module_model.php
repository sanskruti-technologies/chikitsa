<?php

class Module_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->load->database();
    }
	function get_modules() {
		$this->db->order_by("module_status", "desc");
		$this->db->order_by("module_id", "asc");
		$query=$this->db->get('modules');
		return $query->result_array();
    }
	function get_module_details($module_id) {
		$query = $this->db->get_where('modules', array('module_id' => $module_id));
        return $query->row_array();
    }
	function get_module_details_by_name($module_name) {
		$query = $this->db->get_where('modules', array('module_name' => $module_name));
        return $query->row_array();
    }
	function get_activation_hook($module_name) {
		$module = $this->get_module_details_by_name($module_name);
		return $module['activation_hook'];
	}
	function deactivate_module($module_name) {
		$data['module_status'] = 0;
		$data['sync_status'] = 0;
		$this->db->update('modules', $data, array('module_name' => $module_name));
    }
	function activate_module($module_name) {
		$data['module_status'] = 1;
		$data['sync_status'] = 0;
		$this->db->update('modules', $data, array('module_name' => $module_name));
    }
	function get_active_modules() {
		$this->db->where('module_status', 1);
		$this->db->select('module_name');
		$query=$this->db->get('modules');
		$result =  $query->result_array();
		$active_modules = array();
		foreach($result as $row){
			$active_modules[]= $row['module_name']; 
		}
		return $active_modules;
    }
	function is_active($module_name) {
		$this->db->where('module_name', $module_name);
		$this->db->select('module_status');
		$query=$this->db->get('modules');
		//echo $this->db->last_query();
		$row =  $query->row_array();
		if($row['module_status'] == 1){
			return TRUE;
		}else{
			return FALSE;
		}
    }
	function get_license_key($module_name){
		$this->db->where('module_name', $module_name);
		$this->db->select('license_key');
		$query=$this->db->get('modules');
		$row =  $query->row_array();
		return $row['license_key'];
	}
	function activate_license($module_name){
		$data['license_status'] = 'active';
		$data['sync_status'] = 0;
		$this->db->update('modules', $data, array('module_name' => $module_name));
	}
	function dectivate_license($module_name){
		$data['license_status'] = 'inactive';
		$data['sync_status'] = 0;
		$this->db->update('modules', $data, array('module_name' => $module_name));
	}
	function set_license_key($module_name,$license_key){
		$data['license_key'] = $license_key;
		$data['license_status'] = '';
		$data['sync_status'] = 0;
		$this->db->update('modules', $data, array('module_name' => $module_name));
	}
	function check_required_modules($module_name){
		$module = $this->get_module_details_by_name($module_name);
		
		$required_modules = explode(",",$module['required_modules']);
		
		foreach($required_modules as $required_module){
			if($required_module !=""){
				if(!$this->is_active($required_module)){
					return FALSE;
				}
			}
		}
		return TRUE;
	}
	function get_required_modules($module_name){
		$module = $this->get_module_details_by_name($module_name);
		$required_modules = explode(",",$module['required_modules']);
		$required_modules_list = array();
		foreach($required_modules as $required_module){
			$doc = new DOMDocument();
			$doc->load( "http://sanskruti.net/chikitsa/modules/".$required_module.".xml" );//xml file loading here
			$download = $doc->getElementsByTagName( "download" );
			
			foreach( $download as $d ){
				$t = $d->getElementsByTagName( "title" );
				$title = $t->item(0)->nodeValue;
			}
			$required_modules_list[] = $title;
		}
		return implode(",",$required_modules_list);
	}
}

?>
