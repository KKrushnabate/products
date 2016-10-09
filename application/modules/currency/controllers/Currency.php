<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency extends MX_Controller {
        private $view_data = array();
	function __construct() {
	    parent::__construct();
            $this->view_data['company_details'] = $this->config->item('company_details');
            $this->load->helper('form');
            $this->load->module('header/header');
            $this->load->module('footer/footer');
            $this->load->model('currency/currency_model');
            $this->load->model('helper/helper_model');
	}
        public function  index(){
            $this->currencyList();
        }
	public function currencyMaster($currency_id = ''){
            
                if($currency_id != ''){
                    $tableName = MASTERCURRENCY;
                    $select = "*";
                    $column = array('SrNo'=> $currency_id );
                    $value = "";
                    $this->view_data['currencydata'] = $this->currency_model->getData($select, $tableName, $column, $value);
                }
		$this->header->index();
		$this->load->view('currencyAdd',$this->view_data);
		$this->footer->index();
	}
	
	public function addCurrency()
	{
            $SrNo =  isset($_POST['SrNo']) ? $_POST['SrNo'] : '';
            $CurrencyName = isset($_POST['CurrencyName']) ? $_POST['CurrencyName'] : '';
            $CurrencyDescription = isset($_POST['CurrencyDescription']) ? $_POST['CurrencyDescription'] : '';
            $CurrencySign = isset($_POST['CurrencySign']) ?$_POST['CurrencySign'] : '';
            $RoundValue = isset($_POST['RoundValue']) ?  $_POST['RoundValue']: '';
            $PurchaseRate = isset($_POST['PurchaseRate']) ?$_POST['PurchaseRate']: '';
            $SalesRate = isset($_POST['SalesRate']) ?$_POST['SalesRate']: '';
            

            $data =array(
                'SrNo' => $SrNo,
                'CurrencyName'=> $CurrencyName,
                'CurrencyDescription'=> $CurrencyDescription,
                'CurrencySign'=> $CurrencySign,
                'RoundValue'=> $RoundValue,
                'PurchaseRate'=> $PurchaseRate,
                'SalesRate'=> "$SalesRate",
            );
            
            $currency_table =  MASTERCURRENCY;

            if($SrNo != ''){
                $columnName = "SrNo";$value = $SrNo;
                $SrNo = $this->currency_model->updateData($currency_table,$data,$columnName,$value);
            }else{
                $SrNo = $this->currency_model->saveData($currency_table,$data);
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

 	public function currencyList(){
 		$curency_table =  MASTERCURRENCY;
 		$filds = "SrNo,CurrencyName,CurrencyDescription,CurrencySign,RoundValue,PurchaseRate,SalesRate";
 		$this->view_data['list'] = $this->currency_model->getCurrencyList($filds,$curency_table);
                $this->header->index();
		$this->load->view('currencyList', $this->view_data);
		$this->footer->index();
 	}

}
