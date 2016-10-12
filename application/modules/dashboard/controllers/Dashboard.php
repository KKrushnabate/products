<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {
    private $view_data = array();   
    function __construct() {
        parent::__construct();
        $this->load->module('header/header');
        $this->load->module('footer/footer');
        $this->load->model('dashboard/dashboard_model');
        $this->view_data['company_details'] = $this->config->item('company_details');
    }

    public function index(){
        //print_r($this->session->userdata());
        $this->header->index();
        $this->load->view('dashboard');
        $this->footer->index();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
