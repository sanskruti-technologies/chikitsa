<?php
class Module extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->config->load('version');
		$this->load->model('menu_model');
		$this->load->model('module_model');
		$this->load->model('settings/settings_model');
		$this->load->model('admin/admin_model');
		
		$this->load->helper('url');
		$this->load->helper('path');
		$this->load->helper('form');
		$this->load->helper('file');
		$this->load->helper('unzip_helper');
		$this->load->helper('mainpage');
		
        $this->load->library('form_validation');
		$this->load->library('session');
		
		$this->lang->load('main');
    }
    public function index($message_type = NULL,$message = NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['modules'] = $this->module_model->get_modules();
			$data['message']=$message;
			$data['message_type']=$message_type;
			$data['connection_message'] = NULL;
			
			if($this->check_for_updates()=== FALSE){
				$data['connection_message'] = "Cannot connect to Chikitsa Server.Please check your internet connection.";
			}else{
				$data['module_license_status'] = $this->check_for_updates();
			
			}
			$data['software_name'] = $this->menu_model->get_data_value('software_name');  
			$clinic_id = $this->session->userdata('clinic_id'); 
			$user_id = $this->session->userdata('user_id'); 	
			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();
			
			$this->load->view('templates/header',$header_data);
		    $this->load->view('templates/menu');
			$this->load->view('browse',$data);
			$this->load->view('templates/footer');
        }
    }
	public function check_for_updates(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$module_license_status = array();

			$doc = new DOMDocument();
			if($doc->load( "http://sanskruti.net/chikitsa/modules/chikitsa.xml" ) === false){
				return FALSE;
			}else{
				//xml file loading here

				$modules = $this->module_model->get_modules();
				$i = 0;
				foreach($modules as $module) {
					//Check for updates
					$module_name = $module['module_name'];
					$module_license_status[$i]['module_name'] = $module_name;
				
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
								$module_license_status[$i]['module_status'] = 'update_required';
							}else{
								$module_license_status[$i]['module_status'] = 'uptodate';
							}
						}
					}
					
				
				
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
					curl_setopt($ch, CURLOPT_URL, 'http://sanskruti.net/chikitsa/');
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
				return $module_license_status;
			}
		}
	}
	public function add(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['def_dateformate'] = $this->settings_model->get_date_formate();
			
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('add_module',$data);
			$this->load->view('templates/footer');
		}
	}
	public function upload() {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('upload_module');
			$this->load->view('templates/footer');
		}
	}
	public function deactivate_module($module_id) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->module_model->deactivate_module($module_id);
			$this->index();
        }
	}
	public function clear_data($module_name) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			//Execute SQL file
			$sql_file_name = "./application/modules/".$module_name."/". $module_name."_dd.sql";
			//Read Files details
			$sqls = file($sql_file_name);	
			foreach($sqls as $statement){
				$dbprefix =  $this->db->dbprefix;
				$statement = str_replace("%db_prefix%",$dbprefix,$statement);
				$this->db->query($statement);
			}
			$this->index();
        }
	}
	public function activate_module($module_name) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			//Read required Chikitsa
			$readme_file = "./application/modules/".$module_name."/readme.txt";
			$lines = file($readme_file);	
			$required_version = $lines[1]; 
			$required_version = str_replace("Requires","",$required_version);
			$required_version = str_replace("Chikitsa","",$required_version);
			$required_version = trim($required_version);
			$current_version = $this->config->item('current_version'); 
			$current_version_int = (int)str_replace(".","",$current_version);
			$required_version_int =  (int)str_replace(".","",$required_version);
			if($current_version_int < $required_version_int){ 
				$data['error'] = "This Module requires Chikitsa Version (".$required_version.") to be active. Please upgrade Chikitsa first.";
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('extract_module',$data);
				$this->load->view('templates/footer');
			}else{
						
				//Execute SQL file
				$sql_file_name = "./application/modules/".$module_name."/". $module_name.".sql";
				//Read Files details
				$sqls = file($sql_file_name);	
				foreach($sqls as $statement){
					$dbprefix =  $this->db->dbprefix;
					$statement = str_replace("%db_prefix%",$dbprefix,$statement);
					$this->db->query($statement);
				}
				//Check for required modules
				if($this->module_model->check_required_modules($module_name)){
					$this->module_model->activate_module($module_name);
					$activation_hook = $this->module_model->get_activation_hook($module_name);
					if($activation_hook != NULL){
						redirect($module_name."/".$activation_hook);
					}else{
						$this->index();
					}
					
				}else{
					$required_modules = $this->module_model->get_required_modules($module_name);
					$data['error'] = "This Module requires Modules (".$required_modules.") to be active. Please activate them first.";
					$this->load->view('templates/header');
					$this->load->view('templates/menu');
					$this->load->view('extract_module',$data);
					$this->load->view('templates/footer');
				}
			}
        }
	}
	//File Upload 
	function do_upload() {
			
        $config['upload_path'] = './application/modules/';
		$config['allowed_types'] = '*';
		$config['max_size'] = '4096';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('extension')) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data'];
		}
    }
	function upload_module(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {	
			$file_upload = $this->do_upload(); 
			$filename= $file_upload['file_name'];
			$filname_without_ext = pathinfo($filename, PATHINFO_FILENAME);		
			if(isset($file_upload['error'])){
				$data['error'] = $file_upload['error'];		
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('upload_module',$data);
				$this->load->view('templates/footer');
			}elseif($file_upload['file_ext']!='.zip'){
				$data['error'] = "The file you are trying to upload is not a .zip file. Please try again.";		
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('upload_module',$data);
				$this->load->view('templates/footer');
			}elseif(preg_match('/^[a-z_]+$/',$filname_without_ext)) {
				$data['error'] = "";
				$data['file_upload'] = $file_upload;		
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('extract_module',$data);
				$this->load->view('templates/footer');
			}else{			
				$data['error'] = "Make Sure the file-name doesn't have any special characters. File-name must be the name of module being installed.";		
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('upload_module',$data);
				$this->load->view('templates/footer');
			}
		}
	}
	public function license_key($module_name){
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('license_key', $this->lang->line("license_key"), 'required');

			if ($this->form_validation->run() === FALSE){
				$data['module_name'] = $module_name;
				$data['module'] = $this->module_model->get_module_details_by_name($module_name);
				$data['license_key'] = $this->module_model->get_license_key($module_name);
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('license_key',$data);
				$this->load->view('templates/footer');
			}else{
				$license_key = $this->input->post('license_key');
				$this->module_model->set_license_key($module_name,$license_key);
				$this->index();
			}
        }
	}
	public function activate_license_key($module_name){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			//http://docs.easydigitaldownloads.com/article/384-software-licensing-api
			$module = $this->module_model->get_module_details_by_name($module_name);
			
			$parameters = array();
			$parameters['edd_action'] = 'activate_license';
			$parameters['item_name'] = $module['module_display_name'];
			$parameters['license'] = $module['license_key'];
			$parameters['url'] = base_url();
			
			$encoded = "";
			foreach($parameters as $name => $value) {
				$encoded .= urlencode($name).'='.urlencode($value).'&';
			}

		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://sanskruti.net/chikitsa/');
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST' );
			curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);
			

	        $response = curl_exec($ch); 
	        curl_close($ch);      
			
			$data = json_decode($response, TRUE);
			if($data['success']){
				$this->module_model->activate_license($module_name);
				$message_type = "success";
				$message = "License Key is activated for ".$module['module_display_name'];
			}else{
				$message_type = "error";
				switch( $data['error'] ) {

					case 'expired' :

						$message = sprintf(
							'Your license key expired on %s.' ,
							date_i18n( get_option( 'date_format' ), strtotime( $license_data['expires'], current_time( 'timestamp' ) ) )
						);
						break;

					case 'revoked' :

						$message =  'Your license key has been disabled.' ;
						break;

					case 'missing' :

						$message = 'Invalid license.' ;
						break;

					case 'invalid' :
					case 'site_inactive' :

						$message = 'Your license is not active for this URL.' ;
						break;

					case 'item_name_mismatch' :

						$message = sprintf(  'This appears to be an invalid license key for %s.' , $module['module_display_name'] );
						break;

					case 'no_activations_left':

						$message = 'Your license key has reached its activation limit.' ;
						break;

					default :

						$message =  'An error occurred, please try again.' ;
						break;
				}
			}
			
			$this->index($message_type,$message);
		}
	}
	public function take_backup(){
		$db_prefix =  $this->db->dbprefix;
		// Load the DB utility class
		$this->load->dbutil();
				
		$tables = $this->db->list_tables();
		$tables_array = array();
		
		$dbprefix =  $this->db->dbprefix;
		$prefix_length = strlen($dbprefix);
		foreach($tables as $table){
			if(substr($table,0,$prefix_length) == $dbprefix){
				$tables_array[] = $table;
			}
		}
					
		$prefs = array(
			'tables'        => $tables_array,			    // Array of tables to backup.
			'ignore'        => array(),                     // List of tables to omit from the backup
			'format'        => 'zip',                       // gzip, zip, txt
			'filename'      => 'chikitsa-backup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
			'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
			'newline'       => "\n"                         // Newline character used in backup file
		);
		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup($prefs);
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('chikitsa-backup.zip', $backup);
		//Take Backup of Profile Pictures
		$this->load->library('zip');
		$this->zip->read_dir('uploads');
		
		$data = $db_prefix;
		$db_prefix_file = "prefix.txt";
		write_file($db_prefix_file, $data);
		$this->zip->read_file($db_prefix_file);
		
		$this->zip->download('chikitsa-backup.zip');
		
		
	}
	public function dowload_chikitsa($file,$latest_version){
		$this->take_backup();
		$data['file'] = $file;
		$data['latest_version'] = $latest_version;
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('blank',$data);
		$this->load->view('templates/footer');
		
	}
	public function get_latest_chikitsa($file,$latest_version){
		
		$destination = "./chikitsa.zip";
		$file = str_replace("_","/",$file);
		copy($file, $destination);
		echo "Download Complete.";
	}
	public function unzip_chikitsa($latest_version){
		$destination = "./chikitsa.zip";
		$uploads = "./uploads";
		if(unzip($destination, $uploads, true, false)){
			//Replace Files
			full_copy($uploads."/Chikitsa".$latest_version, "./");
			echo "Unzip Successfully completed";
		}else{
			echo "Error while unzipping the file";
		}
	}
	public function update_extension($module_name){
		$module = $this->module_model->get_module_details_by_name($module_name);
		
		$parameters = array();
		$parameters['edd_action'] = 'get_version';
		$parameters['item_name'] = $module['module_display_name'];
		$parameters['license'] = $module['license_key'];
		$parameters['url'] = base_url();
		
		$encoded = "";
		foreach($parameters as $name => $value) {
			$encoded .= urlencode($name).'='.urlencode($value).'&';
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://sanskruti.net/chikitsa/');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST' );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded);
		

		$response = curl_exec($ch); 
		curl_close($ch);    
		$data = json_decode($response, TRUE);
		//print_r($data);
		$download_link = $data['download_link'];
		
		$destination = "./uploads/".$module_name.".zip";
		copy($download_link, $destination);
		//echo "Module Downloaded";
		$this->unzip_module($module_name);
		$this->change_log($module_name);	
	}
	public function change_log($module_name){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			//Execute SQL file
			$sql_file_name = "./application/modules/".$module_name."/". $module_name.".sql";
			//Read Files details
			$sqls = file($sql_file_name);	
			foreach($sqls as $statement){
				$dbprefix =  $this->db->dbprefix;
				$statement = str_replace("%db_prefix%",$dbprefix,$statement);
				$this->db->query($statement);
			}
			//Check for required modules
			$data['module_name'] = $module_name;
			if($this->module_model->check_required_modules($module_name)){
				$this->module_model->activate_module($module_name);
				$activation_hook = $this->module_model->get_activation_hook($module_name);
				if($activation_hook != NULL){
					redirect($module_name."/".$activation_hook);
				}else{
					$this->load->view('templates/header');
					$this->load->view('templates/menu');
					$this->load->view('change_log',$data);
					$this->load->view('templates/footer');
				}
				
			}else{
				$required_modules = $this->module_model->get_required_modules($module_name);
				$data['error'] = "This Module requires Modules (".$required_modules.") to be active. Please activate them first.";
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('change_log',$data);
				$this->load->view('templates/footer');
			}
			
        }
	}
	public function unzip_module($module_name){
		$file_name = "./uploads/".$module_name.".zip";
		$uploads = "./uploads";
		//echo $uploads;
		if(unzip($file_name, $uploads, true, false)){
			//Replace Files
			full_copy($uploads."/".$module_name, "./application/modules/".$module_name);
			//echo "Unzip Successfully completed";
		}else{
			//echo "Error while unzipping the file";
		}
		
	}
}

?>
