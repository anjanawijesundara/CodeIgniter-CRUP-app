<!-- 
    Author - Anjana Wijesundara
    Content - wsanjana951@gmail.com
-->
<?php
class Customer extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->model('customer_model');
        }

        public function index(){
            $data['customers'] = $this->customer_model->get_customer();
            $data['title'] = 'Customer List';
            
            $this->load->view('customer/header', $data);  
            $this->load->view('customer/index', $data);  
            $this->load->view('customer/footer');  
        }

        public function view($username = NULL){
            $data['customer_item'] = $this->customer_model->get_customer($username);
            $data['title'] = 'Customer Detailed';
            
            $this->load->view('customer/header', $data); 
            $this->load->view('customer/view', $data);
            $this->load->view('customer/footer');    
        }

        public function create(){
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'New Customer';

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() === FALSE){
                $this->load->view('customer/header', $data);
                $this->load->view('customer/create', $data);
                $this->load->view('customer/footer');
            }else{
                $this->customer_model->set_customer();

                $data['title'] = 'Success Page';
                $this->load->view('customer/header', $data);
                $this->load->view('customer/success');
                $this->load->view('customer/footer');
            }
        }

        public function edit($username = NULL){
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['customer_item'] = $this->customer_model->get_customer($username);

            $data['title'] = 'Customer Update';
            
            //$this->load->view('customer/edit', $data);  

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() === FALSE){
                $this->load->view('customer/header', $data);
                $this->load->view('customer/edit', $data);
                $this->load->view('customer/footer');

            }else{
                $this->customer_model->update_customer();

                $data['title'] = 'Success Page';
                $this->load->view('customer/header', $data);
                $this->load->view('customer/success');
                $this->load->view('customer/footer');
            }
        }

        public function delete($username = NULL){
            $this->customer_model->delete_customer($username);
            
            $data['title'] = 'Success Page';
            $this->load->view('customer/header', $data);
            $this->load->view('customer/success');
            $this->load->view('customer/footer');
        }
}