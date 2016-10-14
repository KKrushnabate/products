<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eq_profile extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->view_data['controllername'] = $this->router->fetch_class();
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('eq_profile/eq_profile_model');
            $this->load->model('profiledata/profiledata_model');
            $this->load->model('helper/helper_model');
            
            //get profile data 
            
            $eqprofile_table =  PROFILEDATA;
            $filds = 'ProfileName,ProfileId';
            $profiledata = $this->profiledata_model->getProfiledataList($filds,$eqprofile_table);
            $selectProfiledata = array();
            if(!empty($profiledata)){
                foreach($profiledata as $k =>$v){
                       $selectProfiledata[$v->ProfileId] = $v->ProfileName;
                }
            }
            $this->view_data['profilelist'] = $selectProfiledata;
	}
        
        public function  index(){
            $this->eq_profileList();
        }
        
	public function eq_profileMaster($eq_profile_id = ''){    
            if($eq_profile_id != ''){
                $tableName = EQ_PROFILE;
                $select = "*";
                $column = array('SrNo'=> $eq_profile_id );
                $value = "";
                $this->view_data['eqprofiledata'] = $this->eq_profile_model->getData($select, $tableName, $column, $value);
            }
            $this->header->index();
            $this->load->view('eq_profileAdd',$this->view_data);
            $this->footer->index();
	}
	
	public function addeq_profile()
	{
            $id;
            $Profile;
            $CompanyName;
            $Equivalent;
            $ProfileID;

            $data =array(
                    'id' => $id,
                    'Profile'=> $Profile,
                    'CompanyName'=> $CompanyName,
                    'Equivalent' => $Equivalent,
                    'ProfileID' => $ProfileID
                );
            
            $eqprofile_table =  EQ_PROFILE;

            if($SrNo != ''){
                $columnName = "id";$value = $id;
                $id = $this->eq_profile_model->updateData($eqprofile_table,$data,$columnName,$value);
            }else{
                $id = $this->eq_profile_model->saveData($eqprofile_table,$data);
            }

            $response = array();
            if($id){
                $this->session->set_flashdata('successMsg', "Added Successfully.");
                $response['success'] = true;
            }else{
                $response['error_message'][] = "Please try again Later.";
                $response['success'] = false;
            }
            echo json_encode($response);exit();
 	}

 	public function eq_profileList(){
 		$eqprofile_table =  EQ_PROFILE;
 		$filds = 'id,Profile,CompanyName,Equivalent,ProfileID';
 		$this->view_data['list'] = $this->eq_profile_model->geteq_profileList($filds,$eqprofile_table);
                $this->header->index();
		$this->load->view('eq_profileList', $this->view_data);
		$this->footer->index();
 	}

}
