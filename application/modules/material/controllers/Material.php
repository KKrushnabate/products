<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('material/material_model');
            $this->load->model('helper/helper_model');
	}
    public function  index(){
        $this->materialList();
    }
	public function materialMaster($materialid = ''){
            
                if($materialid != ''){
                    $tableName = MATERIALLISTNEW;
                    $select = "*";
                    $column = array('SrNo'=> $materialid);
                    $value = "";
                    $this->view_data['materialData'] = $this->material_model->getData($select, $tableName, $column, $value);
                }
		$this->header->index();
		$this->load->view('materialAdd',$this->view_data);
		$this->footer->index();
	}
	
	public function addmaterial()
	{
            $SrNo =  isset($_POST['SrNo']) ? $_POST['SrNo'] : '';
            $MaterialName = isset($_POST['MaterialName']) ? $_POST['MaterialName'] : '';
            $Density = isset($_POST['Density']) ? $_POST['Density'] : '';
            $PerKG = isset($_POST['PerKG']) ?$_POST['PerKG'] : '';
            

            $data =array(
                'SrNo' => $SrNo,
                'MaterialName'=> $MaterialName,
                'Density'=> $Density,
                'PerKG'=> $PerKG
            );
            $tablename =  MATERIALLISTNEW;

            if($SrNo != ''){
                $columnName = "SrNo";$value = $SrNo;
                $SrNo = $this->material_model->updateData($tablename,$data,$columnName,$value);
            }else{
                $SrNo = $this->material_model->saveData($tablename,$data);
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

 	public function materialList(){
 		$curency_table =  MATERIALLISTNEW;
 		$filds = "SrNo,MaterialName,Density,PerKG";
 		$this->view_data['list'] = $this->material_model->getVproductList($filds,$curency_table);
                $this->header->index();
		$this->load->view('materialList', $this->view_data);
		$this->footer->index();
 	}
 	
 	public function delete($material){
        $tablename =  MATERIALLISTNEW;
        $resultMaster = $this->helper_model->delete($tablename,'SrNo',$material);
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
