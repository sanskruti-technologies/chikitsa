<?php
class Contact_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
    public function get_contacts($id){
        $query = $this->db->get_where('contacts', array('contact_id' => $id));
        return $query->row_array();
	}
	public function get_contact_address($contact_id){
		$query = $this->db->get_where('contacts', array('contact_id' => $contact_id));
		return $query->row_array();
	}
	public function insert_new_contact($first_name,$middle_name,$last_name,$phone_number= NULL,$title = NULL){
		$data['title'] = $title;
		$data['first_name'] = $first_name;
		$data['middle_name'] = $middle_name;
		$data['last_name'] = $last_name;
		//$data['phone_number'] = $phone_number;
		$data['clinic_code'] = $this->session->userdata('clinic_code');
        $data['contact_image'] = 'uploads/images/Profile.png';
		$this->db->insert('contacts', $data);
		$contact_id = $this->db->insert_id();
		//echo $this->db->last_query();
        return $contact_id;
	}
	function insert_contact_full($first_name,$middle_name,$last_name,$phone_number,$second_number,$display_name,$email,$type,$address_line_1,$address_line_2,$area,$city,$state,$postal_code,$country){
		$data['first_name'] = $first_name;
		$data['middle_name'] = $middle_name;
		$data['last_name'] = $last_name;
        
		$data['display_name'] = $display_name;
		$data['email'] = $email;
        $data['type'] = $type;
		$data['address_line_1'] = $address_line_1;
		$data['address_line_2'] = $address_line_2;
		$data['area'] = $area;
		$data['city'] = $city;
		$data['state'] = $state;
		$data['postal_code'] = $postal_code;
		$data['country'] = $country;
		$data['clinic_code'] = $this->session->userdata('clinic_code');
        $data['contact_image'] = 'uploads/images/Profile.png';
		$this->db->insert('contacts', $data);
		//echo $this->db->last_query();
		$contact_id = $this->db->insert_id();
		
		
		//$data['phone_number'] = $phone_number;
		//$data['second_number'] = $second_number;
		
        return $contact_id;
	}
	function update_contact_full($contact_id,$first_name,$middle_name,$last_name,$phone_number,$second_number,$display_name,$email,$address_type,$address_line_1,$address_line_2,$city,$state,$area_postal_code,$country){
		$data['first_name']   = $first_name;
		$data['middle_name']  = $middle_name;
		$data['last_name']    = $last_name;
		$data['phone_number'] = $phone_number;
		$data['second_number'] = $second_number;
		$data['display_name'] = $display_name;
		$data['email'] = $email;
		$data['type'] = $address_type;
		$data['address_line_1'] = $address_line_1;
		$data['address_line_2'] = $address_line_2;
		$data['city'] = $city;
		$data['state'] = $state;
		$data['postal_code'] = $area_postal_code;
		$data['country'] = $country;
		$data['sync_status'] = 0;
		$data['clinic_code'] = $this->session->userdata('clinic_code');
        
		$this->db->update('contacts', $data, array('contact_id' =>  $contact_id));
		//echo $this->db->last_query();
	}
    public function insert_contact(){
		if($this->input->post('title') != false){	
            $data['title'] = $this->input->post('title');
		}
		if($this->input->post('first_name') != false){	
            $data['first_name'] = $this->input->post('first_name');
		}
		if($this->input->post('middle_name') != false){	
            $data['middle_name'] = $this->input->post('middle_name');
		}
		if($this->input->post('last_name') != false){	
            $data['last_name'] = $this->input->post('last_name');
		}
		
		if($this->input->post('display_name') != false){
			$data['display_name'] = $this->input->post('display_name');
		}
		if($this->input->post('email') != false){
			$data['email'] = $this->input->post('email');
        }
		if($this->input->post('type') != false){
			$data['type'] = $this->input->post('type');
		}
		if($this->input->post('address_line_1') != false){
			$data['address_line_1'] = $this->input->post('address_line_1');
		}
		if($this->input->post('address_line_2') != false){
			$data['address_line_2'] = $this->input->post('address_line_2');
		}
		if($this->input->post('city') != false){
			$data['city'] = $this->input->post('city');
		}
        if($this->input->post('state') != false){
			$data['state'] = $this->input->post('state');
		}    
		if($this->input->post('postal_code') != false){
			$data['postal_code'] = $this->input->post('postal_code');
		}
		if($this->input->post('country') != false){
			$data['country'] = $this->input->post('country');
		}
		if($this->input->post('phone_number') != false){
			$data['phone_number'] = $this->input->post('phone_number');
		}
		$data['clinic_code'] = $this->session->userdata('clinic_code');
        $data['contact_image'] = 'uploads/images/Profile.png';
		$this->db->insert('contacts', $data);
		$contact_id = $this->db->insert_id();
		//echo $this->db->last_query();
		
		if($this->input->post('phone_number') != false){	
			$phone_number = $this->input->post('phone_number');
			$this->insert_contact_details_full($contact_id,'mobile',$phone_number,1);
		}
		if($this->input->post('second_number') != false){	
			$second_number = $this->input->post('second_number');
			$this->insert_contact_details_full($contact_id,'mobile',$second_number,0);
		}
		return $contact_id;
    }
	function update_contact($name = NULL){
		$data['title']   = $this->input->post('title');
		$data['first_name']   = $this->input->post('first_name');
		$data['middle_name']  = $this->input->post('middle_name');
		$data['last_name']    = $this->input->post('last_name');
		$data['phone_number'] = $this->input->post('phone_number');
		$data['second_number'] = $this->input->post('second_number');
		$data['display_name'] = $this->input->post('display_name');
		$data['email'] = $this->input->post('email');
		if($this->input->post('type') != false){
			$data['type'] = $this->input->post('type');
		}
		if($this->input->post('address_line_1') != false){
			$data['address_line_1'] = $this->input->post('address_line_1');
		}
		if($this->input->post('address_line_2') != false){
			$data['address_line_2'] = $this->input->post('address_line_2');
		}
		if($this->input->post('city') != false){
			$data['city'] = $this->input->post('city');
		}
        if($this->input->post('state') != false){
			$data['state'] = $this->input->post('state');
		}    
		if($this->input->post('postal_code') != false){
			$data['postal_code'] = $this->input->post('postal_code');
		}
		if($this->input->post('country') != false){
			$data['country'] = $this->input->post('country');
		}
		if($name != NULL && $name != "" ){
			$data['contact_image'] = 'uploads/profile_picture/'. $name;
		}
		$data['sync_status'] = 0;
		$this->db->update('contacts', $data, array('contact_id' =>  $this->input->post('contact_id')));
		//echo $this->db->last_query();
	}
	function update_profile_image($name,$contact_id){
		if($name != NULL && $name != "" ){
			$data['contact_image'] = 'uploads/profile_picture/'. $name;
		}else{
			$data['contact_image'] = "";
		}
		$data['sync_status'] = 0;
		$this->db->update('contacts', $data, array('contact_id' =>  $contact_id));
	}
	function update_address(){
		$contact_id               = $this->input->post('contact_id');
		$data['type']             = $this->input->post('type');
		$data['address_line_1']   = $this->input->post('address_line_1');
		$data['address_line_2']   = $this->input->post('address_line_2');
		$data['city']             = $this->input->post('city');
		$data['state ']           = $this->input->post('state');
		$data['postal_code']      = $this->input->post('postal_code');
		$data['country']          = $this->input->post('country');
		$data['sync_status'] 	  = 0;
		$this->db->update('contacts', $data, array('contact_id' =>  $this->input->post('contact_id')));
	}
	function delete_contact($id){
		$this->db->delete('contacts', array('contact_id' => $id)); 
	}
	public function get_contact_email($contact_id){
		$query = $this->db->get_where('contacts', array('contact_id' => $contact_id));
		$row = $query->row_array();
		return $row['email'];
	}
	public function get_contact_number($contact_id){
		$query = $this->db->get_where('contact_details', array('contact_id' => $contact_id));
		$row = $query->row_array();
		return $row['detail'];
	}
	function insert_contact_details_full($contact_id,$contact_type,$contact_detail,$is_default){
		$data = array();
		$data['contact_id'] = $contact_id;
		$data['type'] = $contact_type;
		$data['detail'] = $contact_detail;
		$data['is_default'] = $is_default;
		$data['clinic_code'] = $this->session->userdata('clinic_code');
        
		$this->db->insert('contact_details', $data);
		//echo $this->db->last_query();
	}
	function insert_contact_details($contact_id){
		$types = $this->input->post('contact_type');
		$details = $this->input->post('contact_detail');
		$is_default = $this->input->post('default');
		$i = 0;
		foreach($types as $type){
			$data = array();
			$data['contact_id'] = $contact_id;
			$data['type'] = $type;
			$data['detail'] = $details[$i];
			
			if($is_default == $i){
				$data['is_default'] = 1;
			}else{
				$data['is_default'] = 0;
			}
			$data['clinic_code'] = $this->session->userdata('clinic_code');
			$this->db->insert('contact_details', $data);
			//echo $this->db->last_query();
			$i++;
		}
	}
	function update_contact_details($contact_id){
		$types = $this->input->post('contact_type');
		$details = $this->input->post('contact_detail');
		$is_default = $this->input->post('default');
		$i = 0;
		$this->db->delete('contact_details', array('contact_id' => $contact_id)); 
		if(!empty($types)){
			foreach($types as $type){
				$data = array();
				$data['contact_id'] = $contact_id;
				$data['type'] = $type;
				$data['detail'] = $details[$i];
				if(isset($is_default[$i]) && $is_default[$i]){
					$data['is_default'] = 1;
				}else{
					$data['is_default'] = 0;
				}
				$data['clinic_code'] = $this->session->userdata('clinic_code');
				$this->db->insert('contact_details', $data);
				//echo $this->db->last_query();
				$i++;
			}
		}
	}
	function get_contact_details($contact_id){
		$query = $this->db->get_where('contact_details', array('contact_id' => $contact_id));
		return $query->result_array();
	}
	function get_all_contact_details(){
		$query = $this->db->get('contact_details');
		return $query->result_array();
	}
	function delete_contact_details($contact_id){
	}
}
?>
