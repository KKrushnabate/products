<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header extends MX_Controller {
        private $view_data = array();   
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
	}
	
	public function index()
	{
		$this->load->view('header',$this->view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */