<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diemaster extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('diemaster/diemaster_model');
            $this->load->model('helper/helper_model');
	}
        public function  index(){
			$this->diemasterList();
        }
 	public function diemasterList(){
		$diemastertable =  MASTERDIEMASTER;
 		$filds = 'die_id, ProductType,ID,OD,THK,Material,Remark,ShoulderTHK,TotalTHK';
 		$this->view_data['list'] = $this->diemaster_model->getDiemasterList($filds,$diemastertable);
                $this->header->index();
		$this->load->view('diemasterList', $this->view_data);
		$this->footer->index();
 	}

}
