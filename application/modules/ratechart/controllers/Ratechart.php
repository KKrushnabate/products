<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ratechart extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
	    
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('ratechart/ratechart_model');
            $this->load->model('helper/helper_model');
	}
    public function  index(){
        $this->ratechartList();
    }
	public function ratechartMaster($rateChartid = ''){
        if($rateChartid != ''){
            $tableName = RATECHARGE;
            $select = "*";
            $column = array('SrNo'=> $rateChartid);
            $value = "";
            $this->view_data['ratechart'] = $this->ratechart_model->getData($select, $tableName, $column, $value);
        }
		$this->header->index();
		$this->load->view('ratechargeAdd',$this->view_data);
		$this->footer->index();
	}
	
	public function addratechart()
	{
		
        $SRNo =  isset($_POST['SRNo']) ? $_POST['SRNo'] : '';
        $RateSrNo =  isset($_POST['RateSrNo']) ? $_POST['RateSrNo'] : '';
        $ChartType =  isset($_POST['ChartType']) ? $_POST['ChartType'] : '';
        $OdFrom =  isset($_POST['OdFrom']) ? $_POST['OdFrom'] : '';
        $ODTo =  isset($_POST['ODTo']) ? $_POST['ODTo'] : '';
        $ThkFrom =  isset($_POST['ThkFrom']) ? $_POST['ThkFrom'] : '';
        $ThkTo =  isset($_POST['ThkTo']) ? $_POST['ThkTo'] : '';
        $QtyFrom =  isset($_POST['QtyFrom']) ? $_POST['QtyFrom'] : '';
        $QtyTo =  isset($_POST['QtyTo']) ? $_POST['QtyTo'] : '';
        $OldDie =  isset($_POST['OldDie']) ? $_POST['OldDie'] : '';
        $NewDie =  isset($_POST['NewDie']) ? $_POST['NewDie'] : '';
            
            

            $data =array(
                'SRNo' => $SRNo,
                'RateSrNo' => $RateSrNo,
                'ChartType' => $ChartType,
                'OdFrom' => $OdFrom,
                'ODTo' => $ODTo,
                'ThkFrom' => $ThkFrom,
                'ThkTo' => $ThkTo,
                'QtyFrom' => $QtyFrom,
                'QtyTo' => $QtyTo,
                'OldDie' => $OldDie,
                'NewDie' => $NewDie,
            );
            
            $tablename =  RATECHARGE;

            if($SRNo != ''){
                $columnName = "SRNo";$value = $SRNo;
                $SrNo = $this->ratechart_model->updateData($tablename,$data,$columnName,$value);
            }else{
                $SrNo = $this->ratechart_model->saveData($tablename,$data);
            }

            $response = array();
            if($SRNo){
                $this->session->set_flashdata('successMsg', "Added Successfully.");
                $response['success'] = true;
            }else{
                $response['error_message'][] = "Please try again Later.";
                $response['success'] = false;
            }
            echo json_encode($response);exit();
 	}

 	public function ratechartList(){
 		$table_name =  RATECHARGE;
 		$filds = "SRNo,RateSrNo,ChartType,OdFrom,ODTo,ThkFrom,ThkTo,QtyFrom,QtyTo,OldDie,NewDie";
 		$this->view_data['list'] = $this->ratechart_model->getrateList($filds,$table_name);
        $this->header->index();
		$this->load->view('ratechargeList', $this->view_data);
		$this->footer->index();
 	}
 	
 	public function delete($rate_id){
        $tablename =  RATECHARGE;
        $resultMaster = $this->helper_model->delete($tablename,'SRNo',$rate_id);
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
