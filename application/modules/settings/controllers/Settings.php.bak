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
<?php
class Settings extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model('menu_model');
        $this->load->model('settings_model');
		$this->load->model('module/module_model');
		$this->load->model('admin/admin_model');

		$this->load->helper('url');
		$this->load->helper('currency_helper');
        $this->load->helper('form');
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->helper('unzip_helper');
		$this->load->helper('mainpage');

		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('time');
		$this->load->helper('date');

		$this->lang->load('main',$this->session->userdata('prefered_language'));

    }

    public function delete_language($language_id){
      $language = $this->settings_model->get_language($language_id);
      $language_name = $language['language_name'];
      $this->settings_model->delete_language($language_id);
      $this->settings_model->delete_language_data($language_name);
      $this->language();
    }
  	public function change_language_file($language) {
		$clinic_id = $this->session->userdata('clinic_id');
		$user_id = $this->session->userdata('user_id');

    $data['l_name']=$language;
		$data['language_array']=$this->settings_model->get_language_name_array($language);


		$header_data['clinic_id'] = $clinic_id;
		$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
		$header_data['active_modules'] = $this->module_model->get_active_modules();
		$header_data['user_id'] = $user_id;
		$header_data['user'] = $this->admin_model->get_user($user_id);
		$header_data['login_page'] = get_main_page();

		$this->load->view('templates/header',$header_data);
		$this->load->view('templates/menu');
		$this->load->view('edit_language',$data);
		$this->load->view('templates/footer');
	}
  public function upload_language_file(){
    $clinic_id = $this->session->userdata('clinic_id');
    $user_id = $this->session->userdata('user_id');
    $header_data['clinic_id'] = $clinic_id;
    $header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
    $header_data['active_modules'] = $this->module_model->get_active_modules();
    $header_data['user_id'] = $user_id;
    $header_data['user'] = $this->admin_model->get_user($user_id);
    $header_data['login_page'] = get_main_page();
    $language_name = $this->input->post('language_name');
    $data['language_name'] = $language_name;

    $this->settings_model->add_language();

    $this->load->view('templates/header',$header_data);
    $this->load->view('templates/menu');
    $this->load->view('settings/add_language',$data);
    $this->load->view('templates/footer');
	}
  public function set_as_default($language_id){
    $this->settings_model->set_as_default($language_id);
    redirect('settings/language');
	}
	public function save_language(){
    if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
        redirect('login/index');
    }else {
       $language_id = $this->input->post('language_id');
       if($language_id == 0){
         //Add Language
         $this->add_language();
       }else{
         //Edit Language
          $this->edit_language();
       }
    }
  }
  public function edit_language(){
    if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
        redirect('login/index');
    }else {
        //Add Language in table
        $this->settings_model->edit_language();
        $data['languages']=$this->settings_model->get_languages();
        $language_name = $this->input->post('language_name');

        $reload_language_file = $this->input->post('reload_language_file');
        $file_copied = true;
        if($reload_language_file){
          $language_folders = directory_map('./application/language/');
          $folders = array_keys($language_folders);

          if(!in_array($language_name."\\",$folders,true)){

            $message[] = "Creating Folder for $language_name";
            mkdir('./application/language/' . $language_name, 0777, TRUE);
            //Copy from English
            $src = 'application/language/english/main_lang.php';
  					$destination = 'application/language/'.$language_name.'/main_lang.php';

            if(!copy($src,$destination)){
  						$message[] = "Failed to Copy Language Files";
  						$file_copied = false;
  					}

            $system_language_files = directory_map('./system/language/english');
            foreach($system_language_files as $system_language_file){
              $src = 'system/language/english/'.$system_language_file;
  						$destination = 'application/language/'.$language_name.'/'.$system_language_file;
  						if(!copy($src,$destination)){
                  $message[] = "Failed to Copy System Language File $system_language_file";
  								$file_copied = false;
  						}
            }
          }

  			  $data['language_name']=$language_name;
  				$data['file_copied'] = $file_copied;
          $data['language_array']=$this->settings_model->get_language_name_array($language_name);


          $data['clinics'] = $this->settings_model->get_all_clinics();
          $clinic_id = $this->session->userdata('clinic_id');
          $user_id = $this->session->userdata('user_id');
  				$header_data['clinic_id'] = $clinic_id;
  				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
  				$header_data['active_modules'] = $this->module_model->get_active_modules();
  				$header_data['user_id'] = $user_id;
  				$header_data['user'] = $this->admin_model->get_user($user_id);
  				$header_data['login_page'] = get_main_page();

  				$data['def_timeformate']=$this->settings_model->get_time_formate();
          $data['language_name'] = $this->input->post('language_name');

  				$this->load->view('templates/header',$header_data);
  				$this->load->view('templates/menu');
  				$this->load->view('settings/reload_language',$data);
  				$this->load->view('templates/footer');
        }else{
          $this->language();
        }
    }
	}

	public function save_language_data(){
		$this->settings_model->edit_language_data();
		$language = $this->input->post('language');
		$index = $this->input->post('index');
		$l_name = $this->input->post('l_name');
		$l_name=rtrim($l_name);
				$language_file = "./application/language/$l_name/main_lang.php";
				$line_array = file($language_file);

				for ($i = 0; $i < count($line_array); $i++) {
					if (strstr($line_array[$i], '$lang[\''.$index.'\'] = ')) {
						$line_array[$i] = '$lang[\''.$index.'\'] = "'.$language.'";' . "\r\n";
					}
				}
				file_put_contents($language_file, $line_array);

				$main_lang_file = "./application/language/$l_name/main_lang.php";
				rename($language_file,$main_lang_file);

		echo $index;
	}
	public function add_language(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        }else {
            $this->form_validation->set_rules('language_name', $this->lang->line('language')." ".$this->lang->line('name'), 'trim|required');
            if ($this->form_validation->run() === FALSE) {
            $this->language();
        }else{
            //Add Language in table
            $this->settings_model->add_language();
            $data['languages']=$this->settings_model->get_languages();
				
            $language_name = $this->input->post('language_name');
				
            $language_folders = directory_map('./application/language/');
            $folders = array_keys($language_folders);
            $file_copied = true;
            if(!in_array($language_name."\\",$folders,true)){
		
              $message[] = "Creating Folder for $language_name";
				mkdir('./application/language/' . $language_name, 0777, TRUE);
              //Copy from English
              $src = 'application/language/english/main_lang.php';
							$destination = 'application/language/'.$language_name.'/main_lang.php';
			
				if(!copy($src,$destination)){
								$message[] = "Failed to Copy Language Files";
								$file_copied = false;
				}

              $system_language_files = directory_map('./system/language/english');
              foreach($system_language_files as $system_language_file){
                $src = 'system/language/english/'.$system_language_file;
								$destination = 'application/language/'.$language_name.'/'.$system_language_file;
						if(!copy($src,$destination)){
                    $message[] = "Failed to Copy System Language File $system_language_file";
										$file_copied = false;
						}	
				}
				}
				
					
					  $data['language_name']=$language_name;
						$data['file_copied'] = $file_copied;
						
            $data['clinics'] = $this->settings_model->get_all_clinics();
            $clinic_id = $this->session->userdata('clinic_id');
            $user_id = $this->session->userdata('user_id');
    				$header_data['clinic_id'] = $clinic_id;
    				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
    				$header_data['active_modules'] = $this->module_model->get_active_modules();
    				$header_data['user_id'] = $user_id;
    				$header_data['user'] = $this->admin_model->get_user($user_id);
    				$header_data['login_page'] = get_main_page();
    				$data['def_timeformate']=$this->settings_model->get_time_formate();
					
            $data['language_name'] = $this->input->post('language_name');
    				$this->load->view('templates/header',$header_data);
    				$this->load->view('templates/menu');
    				$this->load->view('settings/add_language',$data);
    				$this->load->view('templates/footer');
				}
			}	
	}
	public function upload_language() {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        }else {
			
            $this->form_validation->set_rules('language', $this->lang->line('language'), 'required');
			if ($this->form_validation->run() === FALSE) {
               
            }else {
				$language_name=$this->input->post('language');
				$language_file=directory_map('./application/language/'.$language_name);		
				
				for($i=0;$i<sizeof($language_file);$i++){
					$destination='application/language/'.$language_name.'/'.$language_file[$i];
				include($destination);
					$language_array=$lang;
					$this->settings_model->save_language_data($language_name,$language_array);
			}
			}
			$this->change_settings();
        }
	}
	/** File Upload for Clinic Logo Image */
	public function do_logo_upload() {
        $config['upload_path'] = './uploads/images/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$config['overwrite'] = TRUE;
		$config['file_name'] = 'logo';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('clinic_logo')) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data'];
		}
    }
	public function clinic() {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$active_modules = $this->module_model->get_active_modules();
			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			if (in_array("centers", $active_modules)) {
				$data['clinics'] = $this->settings_model->get_all_clinics();

				$header_data['clinic_id'] = $clinic_id;
				$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
				$header_data['active_modules'] = $this->module_model->get_active_modules();
				$header_data['user_id'] = $user_id;
				$header_data['user'] = $this->admin_model->get_user($user_id);
				$header_data['login_page'] = get_main_page();
				$data['def_timeformate']=$this->settings_model->get_time_formate();

				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('centers/all_centers',$data);
				$this->load->view('templates/footer');
			}else{
				$this->form_validation->set_rules('clinic_name', $this->lang->line('clinic_name'), 'required');
				$this->form_validation->set_rules('start_time', $this->lang->line('start_time'), 'callback_check_clinic_time');
				$this->form_validation->set_rules('end_time', $this->lang->line('end_time'), 'callback_check_clinic_time');
				$this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email');
				$this->form_validation->set_rules('time_interval', $this->lang->line('appointment_time_interval'), 'greater_than[5]');
				if ($this->form_validation->run() === FALSE) {
					$data['active_modules'] = $this->module_model->get_active_modules();
					$data['center'] = $this->settings_model->get_clinic_settings($clinic_id);
					$data['def_timeformate']=$this->settings_model->get_time_formate();

					$header_data['clinic_id'] = $clinic_id;
					$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
					$header_data['active_modules'] = $this->module_model->get_active_modules();
					$header_data['user_id'] = $user_id;
					$header_data['user'] = $this->admin_model->get_user($user_id);
					$header_data['login_page'] = get_main_page();

					$this->load->view('templates/header',$header_data);
					$this->load->view('templates/menu');
					$this->load->view('settings/clinic', $data);
					$this->load->view('templates/footer');
				} else {
					$this->settings_model->save_clinic_settings();
					$file_upload = $this->do_logo_upload();

					//Error uploading the file
					if(isset($file_upload['error']) && $file_upload['error']!='<p>You did not select a file to upload.</p>'){
						$data['error'] = $file_upload['error'];
					}elseif(isset($file_upload['file_name'])){
						$file_name = $file_upload['file_name'];
						$this->settings_model->update_clinic_logo($file_name);
					}
					$data['active_modules'] = $this->module_model->get_active_modules();
					$data['center'] = $this->settings_model->get_clinic_settings();
					$data['def_timeformate']=$this->settings_model->get_time_formate();


					$header_data['clinic_id'] = $clinic_id;
					$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
					$header_data['active_modules'] = $this->module_model->get_active_modules();
					$header_data['user_id'] = $user_id;
					$header_data['user'] = $this->admin_model->get_user($user_id);
					$header_data['login_page'] = get_main_page();

					$this->load->view('templates/header',$header_data);
					$this->load->view('templates/menu');
					$this->load->view('settings/clinic', $data);
					$this->load->view('templates/footer');
				}
			}
        }
    }
	public function check_clinic_time(){
		if($this->input->post('full_day') == 1){
			return TRUE;
		}else{
			if(!$this->input->post('start_time') || !$this->input->post('end_time')){
				$this->form_validation->set_message('check_clinic_time', 'Clinic Start Time and End Time is required');
				return FALSE;
			}
		}

	}
	public function remove_clinic_logo(){
		$this->settings_model->remove_clinic_logo();
		$this->clinic();
	}
    public function working_days() {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['def_timeformate']=$this->settings_model->get_time_formate();

			$data['working_days'] = $this->settings_model->get_working_days();
			$data['all_working_days'] = $this->settings_model->get_all_working_days();
			$data['exceptional_days'] = $this->settings_model->get_exceptional_days();
			$data['clinics'] = $this->settings_model->get_all_clinics();
			$active_modules = $this->module_model->get_active_modules();
			$data['active_modules'] = $active_modules;
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
			$this->load->view('settings/working_days',$data);
			$this->load->view('templates/footer');
		}
	}
	public function save_working_days(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->settings_model->save_working_days();
			$this->working_days();
		}
	}
	public function save_exceptional_days(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('working_date', $this->lang->line('working_date'), 'required');
			$this->form_validation->set_rules('working_status', $this->lang->line('working_status'), 'required');
            if ($this->form_validation->run() === FALSE) {

			}else{
				$this->settings_model->save_exceptional_days();
			}
			$this->working_days();
		}
	}
	public function update_exceptional_days(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$uid = $this->input->post('uid');
			$this->form_validation->set_rules('working_date', $this->lang->line('working_date'), 'required');
			$this->form_validation->set_rules('working_status', $this->lang->line('working_status'), 'required');
            if ($this->form_validation->run() === FALSE) {
				$this->edit_exceptional_days($uid);
			}else{
				$this->settings_model->update_exceptional_days($uid);
				$this->working_days();
			}

		}
	}
	public function delete_exceptional_days($uid){
		$this->settings_model->delete_exceptional_days($uid);
		$this->working_days();
	}
	public function edit_exceptional_days($uid=NULL){
		$data['exceptional'] = $this->settings_model->get_exceptional_day($uid);
		$data['def_dateformate']=$this->settings_model->get_date_formate();
		$data['def_timeformate']=$this->settings_model->get_time_formate();
		$data['clinics'] = $this->settings_model->get_all_clinics();
		$this->load->view('templates/header');
		$this->load->view('templates/menu');
		$this->load->view('settings/edit_working_days',$data);
		$this->load->view('templates/footer');
	}
	public function save_invoice() {
        if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {

            $this->form_validation->set_rules('left_pad', $this->lang->line('left_pad'), 'required');
            $this->form_validation->set_rules('currency_symbol', $this->lang->line('currency_symbol'), 'required');
            if ($this->form_validation->run() === FALSE) {
                $this->change_settings();
            } else {
                $this->settings_model->save_invoice_settings();
                $this->change_settings();
            }
        }
    }
	public function change_settings() {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['def_timezone']=$this->settings_model->get_time_zone();
			$data['def_timeformate']=$this->settings_model->get_time_formate();
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['enable_ad']=$this->settings_model->get_data_value('enable_ad');
			$data['tax_type']=$this->settings_model->get_data_value('tax_type');
			$data['default_language']= $this->settings_model->get_data_value("default_language");
			$data['languages']=$this->settings_model->get_language_name();	
			$data['language_folders']=directory_map('./application/language/');	
			$data['folder']=array_keys($data['language_folders']);
				foreach($data['folder'] as $row)
				{
					$row=substr($row, 0, -1);
					if(strlen($row)>1){
						$folder_name[$row]=$row;
					}
				}
			$result_language=array_diff($folder_name,$data['languages']);
			$data['result_language']=$result_language;
			//print_r($result_language);
			$data['invoice'] = $this->settings_model->get_invoice_settings();
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
			$this->load->view('settings',$data);
			$this->load->view('templates/footer');
		}
	}
	public function tax_type(){
		$this->settings_model->set_data_value("tax_type", $this->input->post('tax_type'));
		$this->change_settings();
	}
	public function tax_rates(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['tax_rates'] = $this->settings_model->get_tax_rates();
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
			$this->load->view('tax_rates',$data);
			$this->load->view('templates/footer');
		}
	}
	public function insert_tax_rate(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('tax_rate_name', $this->lang->line("tax_rate")." ".$this->lang->line("name"), 'required');
			$this->form_validation->set_rules('tax_rate', $this->lang->line("tax_rate")." ".$this->lang->line("percentage"), 'required');
			if ($this->form_validation->run() === FALSE) {

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
				$this->load->view('tax_rate_form');
				$this->load->view('templates/footer');

			}else{
				$this->settings_model->insert_tax_rate();
				$this->tax_rates();
			}
		}
	}
	public function edit_tax_rate($tax_id){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('tax_rate_name', $this->lang->line("tax_rate")." ".$this->lang->line("name"), 'required');
			$this->form_validation->set_rules('tax_rate', $this->lang->line("tax_rate")." ".$this->lang->line("percentage"), 'required');
			if ($this->form_validation->run() === FALSE) {
				$data['tax_rate'] = $this->settings_model->get_tax_rate($tax_id);

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
				$this->load->view('tax_rate_form',$data);
				$this->load->view('templates/footer');

			}else{
				$this->settings_model->edit_tax_rate($tax_id);
				$this->tax_rates();
			}
		}
	}
	public function delete_tax_rate($tax_id){
		$this->settings_model->delete_tax_rate($tax_id);
		$this->tax_rates();
	}
	public function get_tax_rate_name(){

	}
	public function enable_ad(){
		$this->settings_model->set_data_value("enable_ad", $this->input->post('enable_ad'));
		$this->change_settings();
	}
	public function save_lang(){
		$button=$this->input->post('submit');
		$language = $this->input->post('default_language');
		$language = str_replace("\\","",$language);
		if($button=="Change Language File"){
			redirect('settings/edit_language/'.$language);
		}
		$config_file = "application/config/config.php";
		$line_array = file($config_file);
		for ($i = 0; $i < count($line_array); $i++) {
			if (strstr($line_array[$i], "config['language']")) {
				$line_array[$i] = '$config[\'language\'] = \'' . $language . '\';' . "\r\n";
			}
		}
		file_put_contents($config_file, $line_array);

		//$this->change_settings();
		redirect('settings/change_settings');
	}
	public function save_timezone(){
		$this->settings_model->save_timezone("default_timezone",$this->input->post('timezones'));
		$this->change_settings();
	}
	public function save_time_formate(){
		$this->settings_model->save_timezone("default_timeformate",$this->input->post('timeformate'));
		$this->change_settings();
	}
	public function save_date_formate(){
		$this->settings_model->save_timezone("default_dateformate",$this->input->post('dateformate'));
		$this->change_settings();
	}
	public function save_display(){
		$this->settings_model->save_timezone("default_display",$this->input->post('display_list'));
		$this->change_settings();
	}
	public function backup(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['active_modules'] = $this->module_model->get_active_modules();
			$data['enable_sync'] = $this->settings_model->get_data_value('enable_sync');
			$data['sync_status'] = $this->settings_model->get_data_value('sync_status');
			$data['online_url'] = $this->settings_model->get_data_value('online_url');
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
			$this->load->view('settings/backup',$data);
			$this->load->view('templates/footer');
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
			'format'        => 'txt',                       // gzip, zip, txt
			'filename'      => 'chikitsa-backup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
			'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
			'newline'       => "\n"                         // Newline character used in backup file
		);
		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup($prefs);
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('chikitsa-backup.sql', $backup);

		$data = $db_prefix;
		$db_prefix_file = "prefix.txt";
		write_file($db_prefix_file, $data);

		//Take Backup of Profile Pictures

		$this->load->library('zip');
		$this->zip->read_file('chikitsa-backup.sql');
		$this->zip->read_dir('uploads/images');
		$this->zip->read_dir('uploads/marking_images');
		$this->zip->read_dir('uploads/media');
		$this->zip->read_dir('uploads/patient_images');
		$this->zip->read_dir('uploads/profile_picture');
		$this->zip->read_dir('uploads/themes');




		$this->zip->read_file($db_prefix_file);

		$this->zip->download('chikitsa-backup.zip');

		$this->backup();
	}
	public function do_upload() {
        $config['upload_path'] = './uploads/restore_backup/';
		$config['allowed_types'] = '*';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('backup')) {
			$error = array('error' => $this->upload->display_errors());
			return $error;
		} else {
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data'];
		}
    }
	public function restore_backup(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			//Upload File
			$file_upload = $this->do_upload();
			$filename = $file_upload['file_name'];
			$filname_without_ext = pathinfo($filename, PATHINFO_FILENAME);
			$clinic_id = $this->session->userdata('clinic_id');
			$user_id = $this->session->userdata('user_id');

			$header_data['clinic_id'] = $clinic_id;
			$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
			$header_data['active_modules'] = $this->module_model->get_active_modules();
			$header_data['user_id'] = $user_id;
			$header_data['user'] = $this->admin_model->get_user($user_id);
			$header_data['login_page'] = get_main_page();



			if(isset($file_upload['error'])){
				$data['error'] = $file_upload['error'];
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('settings/backup',$data);
				$this->load->view('templates/footer');
			}elseif($file_upload['file_ext']!='.zip'){
				$data['error'] = "The file you are trying to upload is not a .zip file. Please try again.";
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('settings/backup',$data);
				$this->load->view('templates/footer');
			}else{
				$data['file_upload'] = $file_upload;
				//Unzip
				$full_path = $file_upload['full_path'];
				$file_path = $file_upload['file_path'];
				$raw_name = $file_upload['raw_name'];

				$return_code = unzip($full_path,$file_path);
				if($return_code === TRUE){
					//Check prefix
					$prefix_match = FALSE;

					$prefix_file_name = $file_path . '/prefix.txt';
					if (file_exists($prefix_file_name)) {
						$backup_prefix = file_get_contents($prefix_file_name);
						$current_prefix = $this->db->dbprefix;
            			$database = $this->db->database;
						if($backup_prefix == $current_prefix){
							$prefix_match = TRUE;
						}
					}else{
						$prefix_match = TRUE;
					}
						//execute sql file
						$sql_file_name = $file_path . '/chikitsa-backup.sql';

						$file_content = file_get_contents($sql_file_name);
						$query_list = explode(";\n", $file_content);

						foreach($query_list as $query){
							//Remove Comments like # # Commment #
							$pos1 = strpos($query,"#\n# ");
							if($pos1 !== FALSE){
								$pos2 = strpos($query,"\n#",$pos1+3);
								$comment = substr($query,$pos1, $pos2-$pos1)."<br/>";
								$query = substr($query, $pos2+2);
							}
							//echo $query."<br/>";
							$this->db->query($query);
						}
					if(!$prefix_match){
            $query=$this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME LIKE '%$backup_prefix%'");
            $tables = $query->result();
            foreach ($tables as $table) {
              $old_table_name = $table->TABLE_NAME;
              $table_name = substr($old_table_name,strlen($backup_prefix));
              $new_table_name = $current_prefix.$table_name;
              $query = "DROP TABLE $new_table_name";
              $this->db->query($query);
              $query = "ALTER TABLE $old_table_name  RENAME TO $new_table_name;";
              $this->db->query($query);
            }


					}
						//Move folders to their location
						$this->move_folder("./restore_backup/profile_picture", "./profile_picture");
						$this->move_folder("./restore_backup/patient_images", "./patient_images");
						$data['message'] = "Backup Restored Successfully!";
					}else{
					$data['error'] = $return_code;
				}
				$this->load->view('templates/header',$header_data);
				$this->load->view('templates/menu');
				$this->load->view('settings/backup',$data);
				$this->load->view('templates/footer');
			}
		}
	}
	public function move_folder($source_dir,$destination_dir){
		// Get array of all source files
		$files = scandir($source_dir);
		// Identify directories
		$source = "$source_dir/";
		$destination = "$destination_dir/";
		// Cycle through all source files
		foreach ($files as $file) {
		  if (in_array($file, array(".",".."))) continue;
		  // If we copied this successfully, mark it for deletion
		  if (copy($source.$file, $destination.$file)) {
			$delete[] = $source.$file;
		  }
		}
		// Delete all successfully-copied files
		foreach ($delete as $file) {
		  unlink($file);
		}
	}
	public function reference_by(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$data['reference_by'] = $this->settings_model->get_reference_by();
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
			$this->load->view('settings/reference_by',$data);
			$this->load->view('templates/footer');
		}
	}
	public function add_reference(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('reference_option', $this->lang->line('option'), 'required');
			if ($this->form_validation->run() === FALSE) {
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
				$this->load->view('settings/reference_by_form');
				$this->load->view('templates/footer');
			}else{
				$this->settings_model->add_reference();
				$this->reference_by();
			}
		}
	}
	public function edit_reference($reference_id){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('reference_option', $this->lang->line('option'), 'required');

			if ($this->form_validation->run() === FALSE) {
				$data['reference'] = $this->settings_model->get_reference($reference_id);
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
				$this->load->view('settings/reference_by_form',$data);
				$this->load->view('templates/footer');
			}else{
				$this->settings_model->edit_reference($reference_id);
				$this->reference_by();
			}
		}
	}
	public function delete_reference($reference_id){
		$this->settings_model->delete_reference($reference_id);
		$this->reference_by();
	}
	public function synchronize(){
		$this->settings_model->save_synchronize();
		$this->backup();
	}
	public function send_data_online(){
		$tables = $this->settings_model->get_all_tables();
		$dbprefix = $this->db->dbprefix;
		foreach($tables as $table){
			$rows = $this->settings_model->get_all_rows($table);
			$columns = $this->settings_model->get_columns($table);
			$this->send_row_online($dbprefix,$table,$columns,$rows);

			//$this->settings_model->add_sync_log("online","insert",$table,$row_count);
		}
	}
	public function send_row_online($dbprefix,$table,$columns,$rows){
		$url = $this->settings_model->get_data_value('online_url')."/index.php/settings/receive_data_online";
		$row_count = 0;
		$all_data = array();
		foreach($rows as $row){
			$fields = array();
			$fields['table_name'] = $table;
			$fields['dbprefix'] = $dbprefix;
			$fields['primary_id'] = $this->settings_model->get_primary_key($table);
			foreach($columns as $column_name){
				$fields[$column_name] = $row[$column_name];
			}
			$all_data[] = $fields;
			$row_count++;
			if($row_count > 1000) break; //To avoid heavy traffic
		}
		$data_string = json_encode($all_data);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string))
		);
		$response = curl_exec($ch);
		curl_close($ch);

		$oXML = new SimpleXMLElement($response);
		foreach($oXML->row as $row){
			//echo $row->table_name." ". $row->primary_key." ". $row->primary_id." ".$row->status."\n";
			if($row->status == "OK"){
				$query = "UPDATE ".$row->table_name." SET sync_status = '1' WHERE ".$row->primary_key." = ". $row->primary_id;
				$this->db->query($query);
			}
		}

	}
	public function receive_data_online(){
		$xml = new SimpleXMLElement('<xml/>');

		$dbprefix = $this->db->dbprefix;

		$result = json_decode(file_get_contents('php://input'), true);
		foreach($result as $row){
			$table_name = str_replace($row['dbprefix'],$dbprefix,$row['table_name']);

			$columns = $this->settings_model->get_columns($table_name);

			$primary_key = $row['primary_id'];
			$primary_id = $row[$row['primary_id']];

			$xml_row = $xml->addChild('row');
			$xml_row->addChild('table_name', $table_name);
			$xml_row->addChild('primary_key', $primary_key);
			$xml_row->addChild('primary_id', $primary_id);

			unset($row['table_name']);
			unset($row['dbprefix']);
			unset($row['primary_id']);

			if($row['sync_status'] == NULL){
				$columns = implode(",", $columns);
				$values =  implode("','", $row);
				$insert_qry = "INSERT INTO ".$table_name." (".$columns.") VALUES ('".$values."');";
				$this->db->query($insert_qry);
				$xml_row->addChild('status', "OK");
			}elseif($row['sync_status'] == '0'){
				$set_values = "";
				foreach($columns as $column){
					$set_values .= $column . "= '".$row[$column]."',";
				}
				$set_values = rtrim($set_values,',');

				$update_qry = "UPDATE ".$table_name." SET ".$set_values." WHERE ". $primary_key. " = ".$primary_id.";";
				$this->db->query($update_qry);
				$xml_row->addChild('status', "OK");
			}
		}
		Header('Content-type: text/xml');
		print($xml->asXML());
	}

  public function language(){
    $clinic_id = $this->session->userdata('clinic_id');
    $user_id = $this->session->userdata('user_id');
    $header_data['clinic_id'] = $clinic_id;
		$header_data['clinic'] = $this->settings_model->get_clinic($clinic_id);
		$header_data['active_modules'] = $this->module_model->get_active_modules();
		$header_data['user_id'] = $user_id;
		$header_data['user'] = $this->admin_model->get_user($user_id);
		$header_data['login_page'] = get_main_page();
    $language_array = $this->settings_model->get_language_array();
    $languages = $this->settings_model->get_languages();
    $data['languages'] = $languages;
    $data['language_array'] = $language_array;
    $language_folders = directory_map('./application/language/');
    $folders = array_keys($language_folders);
    $folder_names = array();
    foreach($folders as $folder){
      if($folder != 'index.html') {
        $folder=substr($folder, 0, -1);
        $folder_names[] = $folder;
      }
    }
    $pending_folders = array_diff($folder_names, $language_array);
    $data['pending_folders'] = $pending_folders;

    $this->load->view('templates/header',$header_data);
    $this->load->view('templates/menu');
    $this->load->view('settings/language',$data);
    $this->load->view('templates/footer');
  }
}
?>
