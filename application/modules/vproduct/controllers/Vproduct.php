<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vproduct extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('vproduct/vproduct_model');
            $this->load->model('helper/helper_model');
	}
    public function  index(){
        $this->vproductList();
    }
	public function vProductMaster($vProduct_id = ''){
            
                if($vProduct_id != ''){
                    $tableName = VPRODUCTMASTER;
                    $select = "*";
                    $column = array('SrNo'=> $vProduct_id);
                    $value = "";
                    $this->view_data['vProductdata'] = $this->vproduct_model->getData($select, $tableName, $column, $value);
                }
		$this->header->index();
		$this->load->view('vproductAdd',$this->view_data);
		$this->footer->index();
	}
	
	public function addvProduct()
	{
            $SrNo =  isset($_POST['SrNo']) ? $_POST['SrNo'] : '';
            $ProductName = isset($_POST['ProductName']) ? $_POST['ProductName'] : '';
            $ChartType = isset($_POST['ChartType']) ? $_POST['ChartType'] : '';
            $ChartTypeName = isset($_POST['ChartTypeName']) ?$_POST['ChartTypeName'] : '';
            $NoOfPlate = isset($_POST['NoOfPlate']) ?  $_POST['NoOfPlate']: '';
            $FID = isset($_POST['FID']) ?$_POST['FID']: '';
            $FormulaName = isset($_POST['FormulaName']) ?$_POST['FormulaName']: '';
            $Type = isset($_POST['Type']) ?$_POST['Type']: '';
            $TypeName = isset($_POST['TypeName']) ?$_POST['TypeName']: '';
            $Material = isset($_POST['Material']) ?$_POST['Material']: '';
            $FID1 = isset($_POST['FID1']) ?$_POST['FID1']: '';
            
            

            $data =array(
                'SrNo' => $SrNo,
                'ProductName'=> $ProductName,
                'ChartType'=> $ChartType,
                'ChartTypeName'=> $ChartTypeName,
                'NoOfPlate'=> $NoOfPlate,
                'FID'=> $FID,
                'FormulaName'=> $FormulaName,
                'Type'=> $Type,
                'TypeName'=> $TypeName,
                'Material'=> $Material,
                'FID1'=> $FID1,
            );
            
            $currency_table =  VPRODUCTMASTER;

            if($SrNo != ''){
                $columnName = "SrNo";$value = $SrNo;
                $SrNo = $this->vproduct_model->updateData($currency_table,$data,$columnName,$value);
            }else{
                $SrNo = $this->vproduct_model->saveData($currency_table,$data);
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

 	public function vproductList(){
 		$curency_table =  VPRODUCTMASTER;
 		$filds = "SrNo,ProductName,ChartType,ChartTypeName,NoOfPlate,FID,FormulaName,Type,TypeName,Material,FID1";
 		$this->view_data['list'] = $this->vproduct_model->getVproductList($filds,$curency_table);
                $this->header->index();
		$this->load->view('vproductList', $this->view_data);
		$this->footer->index();
 	}

}
