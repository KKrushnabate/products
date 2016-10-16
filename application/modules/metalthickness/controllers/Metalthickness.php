<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metalthickness extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('metalthickness/metalthickness_model');
            $this->load->model('helper/helper_model');
	}
    public function  index(){
        $this->metalthicknessList();
    }
	public function metalthicknessMaster($metalthisckness_id = ''){
            
                if($metalthisckness_id != ''){
                    $tableName = METALTHICKNESS;
                    $select = "*";
                    $column = array('SrNo'=> $metalthisckness_id);
                    $value = "";
                    $this->view_data['metalthickness'] = $this->metalthickness_model->getData($select, $tableName, $column, $value);
                }
		$this->header->index();
		$this->load->view('metalthicknessAdd',$this->view_data);
		$this->footer->index();
	}
	
	public function addmetalthickness()
	{
            $SrNo =  isset($_POST['SrNo']) ? $_POST['SrNo'] : '';
            $ODFrom = isset($_POST['ODFrom']) ? $_POST['ODFrom'] : '';
            $ODTo = isset($_POST['ODTo']) ? $_POST['ODTo'] : '';
            $THK = isset($_POST['THK']) ?$_POST['THK'] : '';

            $data =array(
                'SrNo' => $SrNo,
                'ODFrom'=> $ODFrom,
                'ODTo'=> $ODTo,
                'THK'=> $THK
            );
            
            $tablename =  METALTHICKNESS;

            if($SrNo != ''){
                $columnName = "SrNo";$value = $SrNo;
                $SrNo = $this->metalthickness_model->updateData($tablename,$data,$columnName,$value);
            }else{
                $SrNo = $this->metalthickness_model->saveData($tablename,$data);
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

 	public function metalthicknessList(){
 		$table =  METALTHICKNESS;
 		$filds = "SrNo,ODFrom,ODTo,THK";
 		$this->view_data['list'] = $this->metalthickness_model->getmetalthicknessList($filds,$table);
        $this->header->index();
		$this->load->view('metalthicknessList', $this->view_data);
		$this->footer->index();
 	}
 	
 	public function delete($metalthickness){
        $tablename =  METALTHICKNESS;
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
