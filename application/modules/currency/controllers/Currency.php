<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('user/currency_model');
            $this->load->model('helper/helper_model');
	}
        public function  index(){
            $this->currencyMaster();
        }
	public function currencyMaster(){
		$this->header->index();
		$this->load->view('currencyAdd');
		$this->footer->index();
	}
	
	public function addCurrency()
	{
				
		 $vendor_name = isset($_POST['vendor_name']) ? $_POST['vendor_name'] : "";
		 $vendor_mobile_number = isset($_POST['vendor_contact_number']) ? $_POST['vendor_contact_number'] : "";
		 $vendor_phone_number = isset($_POST['vendor_phone_number']) ? $_POST['vendor_phone_number'] : "";
		 $vendor_email = isset($_POST['vendor_email']) ? $_POST['vendor_email'] : "";
		 $vendor_notes = isset($_POST['vendor_notes']) ? $_POST['vendor_notes'] : "";
		 $vendor_service_regn = isset($_POST['vendor_service_regn']) ? $_POST['vendor_service_regn'] : "";
		 $vendor_pan_num = isset($_POST['vendor_pan_num']) ? $_POST['vendor_pan_num'] : "";
		 $vendor_section_code = isset($_POST['vendor_section_code']) ? $_POST['vendor_section_code'] : "";
		 $vendor_payee_name = isset($_POST['vendor_payee_name']) ? $_POST['vendor_payee_name'] : "";
		 $vendor_address = isset($_POST['vendor_address']) ? $_POST['vendor_address'] : "";

		 $vendor_vat = isset($_POST['vendor_vat']) ? $_POST['vendor_vat'] : "";
		 $vendor_cst = isset($_POST['vendor_cst']) ? $_POST['vendor_cst'] : "";
		 $vendor_gst = isset($_POST['vendor_gst']) ? $_POST['vendor_gst'] : "";

		 $data = array(
			'vendor_name' => $vendor_name,
			'vendor_contact_number' => $vendor_mobile_number,
			'vendor_phone_number' => $vendor_phone_number,
			'vendor_email' => $vendor_email,
			'vendor_notes' => $vendor_notes,
			'vendor_service_regn' => $vendor_service_regn,
			'vendor_pan_num' => $vendor_pan_num,
			'vendor_section_code' => $vendor_section_code,
			'vendor_payee_name' => $vendor_payee_name,
			'vendor_address' => $vendor_address,
			'vendor_vat' => $vendor_vat,
			'vendor_cst' => $vendor_cst,
			'vendor_gst' => $vendor_gst,
			'status' => '1',
			'added_by' => '1',
			'added_on' => date('Y-m-d h:i:s')
		);
 	$vendor_table =  ADMIN_USER;

 	$this->db->trans_begin();
 	 //driver record insertion
 	$vendor_id = $this->Vendor_model->saveData($vendor_table,$data);

 	//diver data insertion end

 	//Ledger data insertion start
 	if(isset($vendor_id) && !empty($vendor_id)) {
		$select = " ledger_account_id ";
		$ledgertable = LEDGER_TABLE ;
		$context = VENDOR_CONTEXT;
		$entity_type = GROUP_ENTITY;
		$where =  array('context' =>  $context, 'entity_type' => $entity_type);
 	 	$groupid = $this->Vendor_model->getGroupId($select,$ledgertable,$context,$entity_type,$where);
 	 	
 	 	$parent_data = $groupid->ledger_account_id;
 	 	$reporting_head = REPORT_HEAD_EXPENSE;
 	 	$nature_of_account = DR;
 	 	// ledger data preparation

 	 	$leddata = array(
		'ledger_account_name' => $vendor_name."_".$vendor_id,
		'parent_id' => $parent_data,	
		'report_head' => $reporting_head,
		'nature_of_account' => $nature_of_account,
		'context_ref_id' => $vendor_id,
		'context' => $context,
		'ledger_start_date' => date('Y-m-d h:i:s'),
		'behaviour' => $reporting_head,
		'entity_type' => 2,
		'defined_by' => 1,
		'status' => '1',
		'added_by' => '1',
		'added_on' => date('Y-m-d h:i:s'));
 	 	//Insert Ledger data with Deriver Id
 	 	$legertable =  LEDGER_TABLE;
 	 	$ledger_id = $this->Vendor_model->saveData($legertable,$leddata);

 	 	if(!isset($ledger_id) || empty($ledger_id)){
 	 		$this->db->trans_rollback();
 	 		$response['error'] = true;
 	 		$response['success'] = false;
			$response['errorMsg'] = "Error!!! Please contact IT Dept";
 	 	}


 	} else {
 		$this->db->trans_rollback();
 		$response['error'] = true;
 		$response['success'] = false;
		$response['errorMsg'] = "Error!!! Please contact IT Dept";
 	}

 	//Vndor update with ledger id start
 	$update_data =  array('vendor_ledger_id' => $ledger_id);
 	$updat_column_Name = "vendor_id";
 	$update_value = $vendor_id;
 	$update_id = $this->Vendor_model->updateData($vendor_table,$update_data,$updat_column_Name,$update_value);
 	//end


	if(isset($update_id) && !empty($update_id)){
		
		$this->db->trans_commit();
		$response['success'] = true;
		$response['error'] = false;
		$response['successMsg'] = "Vendor Added Successfully";

	}else{
		$this->db->trans_rollback();
 		$response['error'] = true;
 		$response['success'] = false;
		$response['errorMsg'] = "Error!!! Please contact IT Dept";
	}
	echo json_encode($response);
 	}


 	public function currencyList(){
 		$vendor_table =  VENDOR_TABLE;
 		$filds = "vendor_id,vendor_name,vendor_contact_number,vendor_address,vendor_email,vendor_pan_num,vendor_payee_name";
 		$data['list'] = $this->Vendor_model->getVendorLit($filds,$vendor_table);
 		//echo "<pre>";print_r($data['list']);
        $this->header->index();
		$this->load->view('vendorList', $data);
		$this->footer->index();
 	}

 	public function userDelete(){
        $vendor_id = $_POST['id'];
        $vendor_table =  VENDOR_TABLE;
        $resultMaster = $this->helper_model->delete($vendor_table,'vendor_id',$vendor_id);
        if($resultMaster != false){
        	$response['success'] = true;
			$response['successMsg'] = "Record Deleted";
        }else{
        	$response['success'] = false;
			$response['successMsg'] = "Something wrong please try again";
        }
        echo json_encode($response);
 	}

}