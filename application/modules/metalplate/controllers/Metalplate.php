<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metalplate extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('metalplate/metalplate_model');
            $this->load->model('helper/helper_model');
	}
    public function  index(){
        $this->metalplateList();
    }
	public function metalplateMASTER($metalplate_id = ''){
            
                if($metalplate_id != ''){
                    $tableName = METALPLATEMASTER;
                    $select = "*";
                    $column = array('SrNo'=> $metalplate_id);
                    $value = "";
                    $this->view_data['metalPlatedata'] = $this->metalplate_model->getData($select, $tableName, $column, $value);
                }
		$this->header->index();
		$this->load->view('metalplateAdd',$this->view_data);
		$this->footer->index();
	}
	
	public function addmetalplate()
	{
            $SrNo =  isset($_POST['SrNo']) ? $_POST['SrNo'] : '';
            $ProfileName = isset($_POST['ProfileName']) ? $_POST['ProfileName'] : '';
            $NoOfPlateRU = isset($_POST['NoOfPlateRU']) ? $_POST['NoOfPlateRU'] : '';
            $NoOfPlatePU = isset($_POST['NoOfPlatePU']) ?$_POST['NoOfPlatePU'] : '';
            $NoOfMetal = isset($_POST['NoOfMetal']) ?  $_POST['NoOfMetal']: '';
            $NoWastage = isset($_POST['NoWastage']) ?$_POST['NoWastage']: '';
            $CupSpring = isset($_POST['CupSpring']) ?$_POST['CupSpring']: '';
            
            $data =array(
                'SrNo' => $SrNo,
                'ProfileName'=> $ProfileName,
                'NoOfPlateRU'=> $NoOfPlateRU,
                'NoOfPlatePU'=> $NoOfPlatePU,
                'NoOfMetal'=> $NoOfMetal,
                'NoWastage'=> $NoWastage,
                'CupSpring'=> $CupSpring,
            );
            
            $tablename =  METALPLATEMASTER;

            if($SrNo != ''){
                $columnName = "SrNo";$value = $SrNo;
                $SrNo = $this->metalplate_model->updateData($tablename,$data,$columnName,$value);
            }else{
                $SrNo = $this->metalplate_model->saveData($tablename,$data);
            }

            $response = array();
            if($SrNo){
                $this->session->set_flashdata('successMsg', "Added Successfully.");
                $response['success'] = true;
            }else{
                $response['error_message'][] = "Please try again Later.";
                $response['success'] = false;
            }
            echo json_encode($response);exit();
 	}

 	public function metalplateList(){
 		$tablename =  METALPLATEMASTER;
 		$filds = "SrNo,ProfileName,NoOfPlateRU,NoOfPlatePU,NoOfMetal,NoWastage,CupSpring";
 		$this->view_data['list'] = $this->metalplate_model->getmetalplateList($filds,$tablename);
        $this->header->index();
		$this->load->view('metalplateList', $this->view_data);
		$this->footer->index();
 	}
 	
 	public function delete($metalplate){
        $tablename =  METALPLATEMASTER;
        $resultMaster = $this->helper_model->delete($tablename,'SrNo',$metalplate);
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
