<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materialfarmula extends MX_Controller {
	private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('materialfarmula/materialfarmula_model');
				
			$this->load->model('profiledata/profiledata_model');
            $this->load->model('helper/helper_model');
            
            //get profile data 

			$eqprofile_table =  PROFILEDATA;
			$filds = 'ProfileName,ProfileId';
			$profiledata = $this->profiledata_model->getProfiledataList($filds,$eqprofile_table);
			$selectProfiledata = array();
			if(!empty($profiledata)){
				foreach($profiledata as $k =>$v){
					   $selectProfiledata[$v->ProfileName] = $v->ProfileName;
				}
			}
			$this->view_data['profilelist'] = $selectProfiledata;
	}
    public function  index(){
        $this->materialfarmulaList();
    }
	public function materialfarmulaMaster($materialid = ''){
            
                if($materialid != ''){
                    $tableName = MATERIALFARMULAMASTER;
                    $select = "*";
                    $column = array('SrNo'=> $materialid);
                    $value = "";
                    $this->view_data['materialfarmulaData'] = $this->materialfarmula_model->getData($select, $tableName, $column, $value);
                }
		$this->header->index();
		$this->load->view('materialfarmulaAdd',$this->view_data);
		$this->footer->index();
	}
	
	public function addmaterialfarmula()
	{
            $SrNo =  isset($_POST['SrNo']) ? $_POST['SrNo'] : '';
            $ProfileName = isset($_POST['ProfileName']) ? $_POST['ProfileName'] : '';
            $Material = isset($_POST['Material']) ? $_POST['Material'] : '';
            $FID = isset($_POST['FID']) ?$_POST['FID'] : '';
            

            $data =array(
                'SrNo' => $SrNo,
                'ProfileName'=> $ProfileName,
                'Material'=> $Material,
                'FID'=> $FID
            );
            $tablename =  MATERIALFARMULAMASTER;

            if($SrNo != ''){
                $columnName = "SrNo";$value = $SrNo;
                $SrNo = $this->materialfarmula_model->updateData($tablename,$data,$columnName,$value);
            }else{
                $SrNo = $this->materialfarmula_model->saveData($tablename,$data);
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

 	public function materialfarmulaList(){
 		$table =  MATERIALFARMULAMASTER;
 		$filds = "ProfileName,Material,FID,SrNo";
 		$this->view_data['list'] = $this->materialfarmula_model->getmaterialFarmulaList($filds,$table);
                $this->header->index();
		$this->load->view('materialfarmulaList', $this->view_data);
		$this->footer->index();
 	}
 	
 	public function delete($materialfid){
        $tablename =  MATERIALFARMULAMASTER;
        $resultMaster = $this->helper_model->delete($tablename,'SrNo',$materialfid);
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
