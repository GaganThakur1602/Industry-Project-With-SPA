<?php
class Admin_model extends CI_Model
{
    public function __construct()
	{
		$this->load->database();
	}
    
    public function check_admin_details()
    {
        $myData = json_decode($_POST['myData']);
        $a_email = $myData->a_email;
        $a_password = $myData->a_password;
        $query = $this->db->get_where('admins', array('Admin_email' => $a_email,'Admin_password'=>$a_password));
        return $query->row_array();
        
    }

    public function get_tickets_for_admin()
    {
        $query = $this->db->get('tickets');
        return $query->result();
    }
}
?>