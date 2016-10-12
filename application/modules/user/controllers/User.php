<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller {
    private $view_data = array();
    function __construct() {
        parent::__construct();
        $this->view_data['company_details'] = $this->config->item('company_details');
        $this->view_data['controllername'] = $this->router->fetch_class();
        $this->load->helper('form');
        $this->load->module('header/header');
        $this->load->module('footer/footer');
        $this->load->model('user/user_model');
        $this->load->model('helper/helper_model');
    }
    
    public function  index(){
        $this->userMaster();
    }
    
    public function userMaster($user_id = ''){
        $this->header->index();
        if(($user_id != '') && isset($user_id)){
            $tableName = USER_MASTER;
            $select = "*";
            $column = array('user_id'=> $user_id, 'status'=> 1, );
            $value = "";
            $this->view_data['userdata'] = $this->user_model->getData($select, $tableName, $column, $value);
        }

        $this->load->view('UserAdd',$this->view_data);

        $this->footer->index();
    }

    public function login()
    {
        $this->load->view('login',$this->view_data);
    } 
	
    public function login_process(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $data = array();
        if ($this->form_validation->run() == FALSE) {
            $data['error_messages'] = validation_errors();
            $data['success'] = false;
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            //get data from db   USER_MASTER 
            $arrCondition = array("user_name"=> $username,"password"=> $password, "status"=> 1, "approved_by_admin"=> 1);
            $arrresult = $this->helper_model->selectGroupId("*",USER_MASTER,$arrCondition);

            if ($arrresult['total_rows'] > 0) {
                $table_data = $arrresult['table_data'];

                $sess_data = array(
                    'username' => $table_data->user_name,
                    'userid' => $table_data->user_id,
                    'role' => $table_data->user_roles
                );
                $this->session->set_userdata('logged_in', $sess_data);
                $data['success'] = true;
            } else {
                $data['error_message'][] = "Invalid Username or Password.";
                $data['success'] = false;
            }
        }

        echo json_encode($data);exit();
    }
	 
    public function adduser()
    {
        $userdata = $this->session->userdata('logged_in');
        $user_id =  isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
        $resusername = isset($_POST['resusername']) ? $_POST['resusername'] : '';
        $passward = isset($_POST['password']) ?$_POST['password'] : '';
        $repeat_passward = isset($_POST['repeat_password']) ?  $_POST['repeat_password']: '';
        $email_id = isset($_POST['email_id']) ?$_POST['email_id']: '';
        $phone_number = isset($_POST['phone_number']) ?$_POST['phone_number']: '';
        $added_by = ( isset($_POST['added_by']) || ($_POST['added_by']!= '') || !empty($_POST['added_by'])) ?$_POST['added_by']: isset($userdata['userid']) ? 0 : '' ;
        $added_on = (isset($_POST['added_by']) || ($_POST['added_on'] != '') || !empty($_POST['added_on'])) ? $_POST['added_on']: date("Y:m:d H:i:s");
        $allowed = isset($_POST['approved_by_admin']) ? $_POST['approved_by_admin']: '0';
        $modified_by = isset($userdata['userid']) ? $userdata['userid'] : 0;

        $data =array(
            'user_id' => $user_id,
            'user_full_name'=> $fullname,
            'user_name'=> $resusername,
            'password'=> $passward,
            'user_email_id'=> $email_id,
            'user_phone_number'=> $phone_number,
            'user_roles'=> "admin",
            'approved_by_admin'=> $allowed,
            'status'=> 1,
            'added_on'=> $added_on,
            'added_by'=>  $added_by,
            'modified_on'=> date("Y:m:d H:i:s"),
            'modified_by'=> $modified_by
        );
        $user_table =  USER_MASTER;
       
        if($user_id != ''){
            $columnName = "user_id";$value = $user_id;
            $user_id = $this->user_model->updateData($user_table,$data,$columnName,$value);
        }else{
            $user_id = $this->user_model->saveData($user_table,$data);
        }
        
        $response = array();
        if($user_id){
            $this->session->set_flashdata('successMsg', "Added Successfully.");
            $response['success'] = true;
        }else{
            $response['error_message'][] = "Please try again Later.";
            $response['success'] = false;
        }
        echo json_encode($response);exit();
    }

    public function userList(){
        $user_table =  USER_MASTER;
        $filds =array('user_id','user_full_name','user_name','password','user_email_id',"approved_by_admin",'user_phone_number','user_roles');//'user_id,user_full_name,user_name,password,user_email_id,user_phone_number,user_roles';//
        $columnName = array("status" => 1);
        $value = array();
        $this->view_data['list'] = $this->user_model->getData($filds,$user_table,$columnName,$value);

        $this->header->index();
        $this->load->view('userList', $this->view_data);
        $this->footer->index();
    }

    public function delete($user_id){
        $user_table =  USER_MASTER;
        $resultMaster = $this->helper_model->delete($user_table,'user_id',$user_id);
        if($resultMaster != false){
                $this->session->set_flashdata('successMsg', "Record Deleted");
                $response['success'] = true;
        }else{
                $response['error_message'][] = "Something wrong please try again";
                $response['success'] = false;
        }
        echo json_encode($response);exit();
    }
    
    public function logout(){
        $this->session->unset_userdata('logged_in');
        redirect('/user/login');
        
    }
}
