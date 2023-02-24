<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function session_check($sess)
    {
        if($sess == TRUE){
            if($this->session->userdata('user_name')=='' || $this->session->userdata('is_logged_in')==FALSE)
            {
                //if user should be logged in but is not logged in redirect to login page 
                redirect('service');
            }

        }
        else{
            
            if($this->session->userdata('is_logged_in')==TRUE)
            {
                //if user should be logged and trying to go to login page prevent him to do so
                redirect('tickets');
            }
        }

    }
    public function session_check_admin($sess)
    {
        if($sess == TRUE){
            if($this->session->userdata('admin_name')=='' || $this->session->userdata('is_logged_in_as_admin')==FALSE)
            {
                //if user should be logged in but is not logged in redirect to login page 
                redirect('service/admin_login_view');
            }

        }
        else{
            
            if($this->session->userdata('is_logged_in_as_admin')==TRUE)
            {
                //if user should be logged and trying to go to login page prevent him to do so
                redirect('service/admin_ticket_view');
            }
        }

    }
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    public function index()
	{
        //Controller for index.php page
        $data['session'] = 0;
        
        if($this->session->userdata('c_id')){
            $session_check = $this->session->userdata('c_id');
            $data['session'] = $session_check;
        }
        else{
            $session_check=0;
            $data['session'] = $session_check;
        }
        if($this->session->userdata('admin_name')){
            $data['adminsession']=$this->session->userdata('admin_name');
        }
        else{
            $data['adminsession']=0;
        }
        
		$this->load->view('index_header',$data);

	}
    public function customer_validation_ang()
    {
        $myData = json_decode($_POST['myData']);
        $this->load->model('customer_model'); 
        // $c = $this->input->post('c_email');
        // echo $c;
        // $postdata = file_get_contents('php://input');
        // var_dump($_POST);
        // $req = json_decode($postdata,true);

        $data = $this->customer_model->check_customer_details($myData->c_email,$myData->c_password);
        if ($data){
            //setting username as session username to 
            $this->session->set_userdata('c_id', $data['Customer_id']);
            $this->session->set_userdata(array('user_name' => $data['Customer_name'], 'is_logged_in' => TRUE));
            // redirect('service/customer_ticket_view');
            $myObj = new stdClass();
            $myObj->customer_id = $data['Customer_id'];

            $myJSON = json_encode($myObj);
            echo $myJSON;
        }
        else 
        {
            //if customer does no exist in the database
            echo "<br>Please sign up <a href='service/customer_sign_up'>HERE</a>" ;
        }
    }
    
    public function customer_ticket_load_ang()
    {   
        $this->session_check(TRUE);
        //supplying customer_id as a parameter to a model function
        $c_id = $this->session->userdata('c_id');
        $this->load->model('customer_model'); 
        $ticket_data = $this->customer_model->get_customer_tickets($c_id);
        //get tickets data and make a associative array of it so it can be passed onto a view
        echo json_encode($ticket_data);
    }
    public function customer_ticket_submit_ang()
    {
        $this->session_check(TRUE);
        //Submits a ticket to the database 
        $this->load->model('customer_model');
        $postdata = file_get_contents('php://input');
        // var_dump($_POST);
        $req = json_decode($postdata,true);
        $data = $this->customer_model->customer_ticket_submit_ang($req['title'],$req['description'],$req['file']);
        echo $data; // This is for xhr request the data echoed is returned as response text to xhr request
    }

    public function customer_details_submit_ang()
    {
        $this->session_check(FALSE);

        //Goes to success page where user must further login to continue submitting their ticket
        $this->load->model('customer_model'); 
        $data = $this->customer_model->customer_details_submit();
        if($data)
        {
            // $this->load->helper('emailapp');
            $myData = json_decode($_POST['myData']);
            $c_email = $myData->email;
            $c_name = $myData->name;
            $str=rand();
            $result = md5($str);
            $email_code=$result;
            $c_code_to_be_sent = $email_code;
            $check_if_inserted = $this->customer_model->insert_validation_code($c_email,$email_code);
            if($check_if_inserted)
            {
                echo TRUE;
                
                $ABC =& load_class('Hooks','core');

                $ABC->add_hook('post_controller',array(
                    'class'    => 'service',
                    'function' => 'send_validation_email',
                    'filename' => 'service.php',
                    'filepath' => 'controllers',
                    'params'    =>array(
                        'c_email'=>$c_email,
                        'c_name'=>$c_name,
                        'c_code'=>$email_code
                        )
                
                    ));

            }
        }
    }
    public function send_validation_email($param){

        $c_email_to_be_sent = $param['c_email'];
        $c_name_to_be_sent = $param['c_name'];
        $c_code_to_be_sent = $param['c_code'];
        $this->load->helper('emailapp');
        email($c_name_to_be_sent,$c_email_to_be_sent,$c_code_to_be_sent);
    }
    public function validate_email($email,$code)
    {
        $this->load->model('customer_model');
        $data = $this->customer_model->validate_email($email); 

        if($data!=FALSE)
        {
            if($data==$code)
            {
                $data = $this->customer_model->update_activation_status($email);
                $this->load->view('success');
            }
        }

    }

    public function customer_attachment_view()
    {
        $this->session_check(TRUE);
        $ticket_filename = $this->input->post('ticket_filename');
        $x = array('name'=>$ticket_filename);
        //supply ticket filname to the view so that it can be fetched from the folder on viewing
        $this->load->view('customer_attachment_view',$x);
    }

    public function admin_login_view()
    {
        $this->session_check_admin(FALSE);
        //$this->load->library('session');
	    $this->load->library('form_validation');    
        $this->session->set_userdata(array('is_admin' =>TRUE));
        $this->session->set_userdata(array('to_admin_login' =>FALSE));
        // echo "This is working";
        // $this->load->view('index_header');
        // $this->load->view('admin_login_view');
    }

    public function admin_validation_ang()
    {
        $this->load->model('admin_model'); 
        $data = $this->admin_model->check_admin_details();
        if ($data){
            $this->session->set_userdata(array('admin_name' => $data['Admin_name'], 'is_logged_in_as_admin' => TRUE));
            echo TRUE;
        }
        else
        {
            echo "<br>Your Access has been revoked or removed";
        } 
    }
    public function admin_ticket_view_ang()
    {
        $this->session_check_admin(TRUE);
        $this->load->model('admin_model'); 
        $ticket_data = $this->admin_model->get_tickets_for_admin();
        echo json_encode($ticket_data);
    }
    public function admin_attachment_view()
    {
        $this->session_check_admin(TRUE);
        $ticket_filename = $this->input->post('ticket_filename');
        $x = array('name'=>$ticket_filename);
        // $this->load->view('header');
        $this->load->view('admin_attachment_view',$x);
    }

    public function success()
    {
        $this->load->view('success');
    }

    public function logout()
    {
        $this->session->unset_userdata('c_id'); 
        //$this->load->library('session');
        $this->session->sess_destroy();
        $myObj = new stdClass();
        if($this->session->userdata('c_id')){
            $myObj->customer_id = $this->session->userdata('c_id');
            $myJSON = json_encode($myObj);
            echo $myJSON;
        }
        else{
            $myObj->customer_id=null;
            $myJSON = json_encode($myObj);
            echo $myJSON;
        }
        // null the session (just in case):  
        // redirect('service/');
    }
}
/* End of file service.php */
/* Location: ./application/controllers/service.php */