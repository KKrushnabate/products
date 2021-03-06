<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Factor extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('factor/factor_model');
            $this->load->model('helper/helper_model');
	}
	
	public function  index(){
		$this->factorList();
	}
	
	public function factorMaster($factor_id = ''){        
                if($factor_id != ''){
                    $tableName = FACTOR;
                    $select = "*";
                    $column = array('SrNo'=> $factor_id );
                    $value = "";
                    $this->view_data['factordata'] = $this->factor_model->getData($select, $tableName, $column, $value);
                }
		$this->header->index();
		$this->load->view('factorAdd',$this->view_data);
		$this->footer->index();
	}
	
	public function addfactor()
	{
            $SrNo =  isset($_POST['SrNo']) ? $_POST['SrNo'] : '';
            $ODFrom = isset($_POST['ODFrom']) ? $_POST['ODFrom'] : '';
            $ODTo = isset($_POST['ODTo']) ?$_POST['ODTo'] : '';
            $QtyFrom = isset($_POST['QtyFrom']) ?  $_POST['QtyFrom']: '';
            $QtyTo = isset($_POST['QtyTo']) ?$_POST['QtyTo']: '';
            $Factor = isset($_POST['Factor']) ?$_POST['Factor']: '';
            

            $data =array(
                       'SrNo'=>$SrNo,
						'ODFrom' => $ODFrom,
						'ODTo' => $ODTo,
						'QtyFrom' => $QtyFrom,
						'QtyTo' => $QtyTo,
						'Factor' => $Factor
            );
            
            $table_name =  FACTOR;

            if($SrNo != ''){
                $columnName = "SrNo";$value = $SrNo;
                $SrNo = $this->factor_model->updateData($table_name,$data,$columnName,$value);
            }else{
                $SrNo = $this->factor_model->saveData($table_name,$data);
            }

            $response = array();
            if($SrNo){
                $response['success_message'][] = "Added Successfully.";
                $response['success'] = true;
            }else{
                $response['error_message'][] = "Please try again Later.";
                $response['success'] = false;
            }
            echo json_encode($response);exit();
 	}

 	public function factorList(){
 		$tablenamw =  FACTOR;
 		$filds = "SrNo,ODFrom,ODTo,QtyFrom,QtyTo,Factor";
 		$this->view_data['list'] = $this->factor_model->getfactorList($filds,$tablenamw);
		$this->header->index();
		$this->load->view('factorList', $this->view_data);
		$this->footer->index();
 	}
 	public function delete($factor_id){
        $tablename =  FACTOR;
        $resultMaster = $this->helper_model->delete($tablename,'SrNo',$factor_id);
        if($resultMaster != false){
                $this->session->set_flashdata('successMsg', "Record Deleted");
                $response['success'] = true;
        }else{
                $response['error_message'][] = "Something wrong please try again";
                $response['success'] = false;
        }
        echo json_encode($response);exit();
    }

}
