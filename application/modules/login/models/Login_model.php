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


class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
		$this->load->database();
    }

    public function get_current_version(){
		$query = $this->db->get('version');
		$row = $query->row();
		return $row->current_version;
    }
    function login($username, $password) {
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        $query = $this->db->get("users");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
        }
        return array();
    }
	function is_active($username) {
		$this->db->where("username", $username);
        $query = $this->db->get("users");
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->is_active;
		}else{
			return FALSE;
		}
	}
    function activate($username) {
        $data['is_active'] = 1;
        $data['sync_status'] = 0;
        $this->db->where('username', $username);
        $this->db->update('users', $data);
    }
	function activate_email($verify_email,$verification_code){
		$data['code_is_verified'] = 1;
        $data['sync_status'] = 0;
        $this->db->where('user_email', $verify_email);
		$this->db->where('verification_code', $verification_code);
        $this->db->update('user_verification', $data);
		$this->activate($verify_email);
	}
	function get_password($verify_email){
		$this->db->where("username", $verify_email);
        $query = $this->db->get("users");
        if ($query->num_rows() > 0) {
			$result = $query->row_array();
			return $result["password"];
        }

	}
}

?>
