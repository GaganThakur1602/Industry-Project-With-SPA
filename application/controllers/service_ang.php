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
                redirect('service/index');
            }

        }
        else{
            
            if($this->session->userdata('is_logged_in')==TRUE)
            {
                //if user should be logged and trying to go to login page prevent him to do so
                redirect('service/customer_ticket_view');
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
        //$this->load->library('session');
        // $this->session->set_userdata(array('user_name' =>'', 'is_logged_in' =>FALSE));
        $this->session_check(FALSE);
        $this->load->library('form_validation'); 
		$this->load->view('index_header');
		$this->load->view('home');
		$this->load->view('footer');
	}
    public function customer_validation_ang()
    {
        $this->load->model('customer_model'); 
        // $c = $this->input->post('c_email');
        // echo $c;
        $postdata = file_get_contents('php://input');
        // var_dump($_POST);
        $req = json_decode($postdata,true);

        $data = $this->customer_model->check_customer_details($req['c_email'],$req['c_password']);
        if ($data){
            //setting username as session username to 
            $this->session->set_userdata('c_id', $data['Customer_id']);
            $this->session->set_userdata(array('user_name' => $data['Customer_name'], 'is_logged_in' => TRUE));
            // redirect('service/customer_ticket_view');
           echo TRUE;
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
        echo $ticket_data;
    }

    public function customer_ticket_view()
    {   
        $this->session_check(TRUE);
        //supplying customer_id as a parameter to a model function
        $c_id = $this->session->userdata('c_id');
        $this->load->model('customer_model'); 
        $ticket_data = $this->customer_model->get_customer_tickets($c_id);
        //get tickets data and make a associative array of it so it can be passed onto a view
        $x = array('tickets'=>$ticket_data) ;
        $this->load->view('header');
        $this->load->view('customer_ticket_view',$x);

    }
}
/* End of file service.php */
/* Location: ./application/controllers/service.php */