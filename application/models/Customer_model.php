<!-- 
    Author - Anjana Wijesundara
    Content - wsanjana951@gmail.com
-->
<?php
class Customer_model extends CI_Model {

    public function __construct(){
            $this->load->database();
    }

    public function get_customer($username = FALSE){
        if ($username === FALSE){
            $query = $this->db->get('customer');
            return $query->result_array();
        }

        $query = $this->db->get_where('customer', array('username' => $username));
        return $query->row_array();
	}

	public function set_customer(){
	    $data = array(
	        'username' => $this->input->post('username'),
	        'full_name' => $this->input->post('full_name'),
	        'email' => $this->input->post('email')
	    );

	    return $this->db->insert('customer', $data);
	}

    public function update_customer(){
        $data = array(
            'username' => $this->input->post('username'),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email')
        );

        $this->db->where('username', $this->input->post('username'));
        return  $this->db->update('customer', $data);
    }

    public function delete_customer($username = FALSE){
        if ($username != FALSE){
            return $this->db->delete('customer', array('username' => $username)); 
        }
    }

}