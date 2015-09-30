<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Common.php';

class Login extends Common {
    public function __construct()
    {
        parent::__construct();
    }

	public function login()
	{
        //读取
        $this->load->library('form_validation');
        $this->load->model('User_model');
        //表单验证
        $this->form_validation->set_rules('username', '工号', 'required');  
        $this->form_validation->set_rules('password', '密码', 'required');
        if($this->form_validation->run()!= FALSE){
            $check = $this->User_model->check_login($this->input->post('username',TRUE),$this->input->post('password',TRUE));
            switch($check['status']){
                //登陆成功
                case '10' :
                    $session = array('username' => $this->input->post('username' , TRUE) , 'role' => $check['data']['role'] , 
                        'is_login' => 1 , 'id' =>$check['data']['id']);
                    $this->saveLog(30 , 3 ,$this->input->post('username',TRUE).'登陆成功',$this->input->post('username',TRUE));
                    $this->session->set_userdata($session);
                    redirect('Login/index');
                    break;
                //账号密码不匹配
                case '00' :
                    $data['message'] = array('content' => $check['message'] , 'type' => 'warning');
                    $this->load->view('Login/login',$data);
                    break;
                default :
                    $data['message'] = array('content' => '未知错误' , 'type' => 'danger');
                    $this->saveLog(30 , 8 , $this->input->post('username',TRUE).'在登陆时发生了未知错误' , $this->input->post('username',TRUE));
                    $this->load->view('Login/login',$data);
                    break;
            }
        } else{
            if(!validation_errors()){
                //初始化数据
                $data['message'] = array('content' => '请输入您的工号和密码' , 'type' => 'warning');
                $this->load->view('Login/login',$data);
            } else{
                //表单验证不通过的返回数据
                $data['message'] = array('content' => validation_errors() , 'type' => 'danger');
                $this->load->view('Login/login',$data);
            }
        }
    }

    public function index()
    {
        if(!$this->session->userdata('username') || !$this->session->userdata('role') || !$this->session->userdata('is_login')){
            redirect('Login/login');
            exit(0);
        }
        $this->load->model('User_model');
        $data = $this->User_model->get_detail_by_id($this->session->userdata('id'));
        $data['role'] = $this->User_model->get_role_by_rid($this->session->userdata('role'));
        $data['pid_detail'] = $this->User_model->get_pid_detail_by_id($this->session->userdata('id'));
        $data['pin_detail'] = $this->User_model->get_pin_detail_by_id($this->session->userdata('id'));
        if($data!=FALSE){
            $this->load->view('header');
            $this->load->view('Login/index',$data);
        }
        else{
            $this->saveLog(32 , 9 , $this->input->post('username',TRUE).'在登陆后发生了未知错误' , $this->input->post('username',TRUE));
            redirect('Login/login');
        }
    }

    public function add(){
        //生成、添加PIN
        if(!$this->session->userdata('username') || !$this->session->userdata('role') || !$this->session->userdata('is_login')){
            redirect('Login/login');
            exit(0);
        }
        $this->load->library('form_validation');
        $this->load->model('User_model');        
        //表单验证
        $this->form_validation->set_rules('name', '姓名', 'required');  
        $this->form_validation->set_rules('role', '岗位', 'required');
        if($this->form_validation->run()!= FALSE){
            $name = $this->input->post('name',TRUE);
            $role = $this->input->post('role',TRUE);
            $roleid = sprintf("%03d",$role);
            $pid = sprintf("%04d",$this->session->userdata('role'));
        //生成激活码
            $code = $roleid.$pid.date("ymd").substr(microtime(),2,4).rand(0,9);
            $data = array(
                'code' => $code,
                'uid' => $this->session->userdata('id'),
                'name' => $name,
                'is_active' => 0
            );
            $this->load->model('Validation_model');
            if($this->Validation_model->insert_validation_code($data)){
                $this->saveLog(33 , 5 , $this->input->post('username',TRUE).'创建了激活码' , $this->input->post('username',TRUE)); 
                $array = array(
                    'name' => $name,
                    'code' => $code,
                    'role' => $this->User_model->get_role_by_rid($role)
                );
                $this->load->view('header');
                $this->load->view('Login/add_success',$array);
            }else{
               $this->saveLog(33 , 8 , $this->input->post('username',TRUE).'在创建激活码时发生了未知错误' , $this->input->post('username',TRUE)); 
            }
        }else{
            if(!validation_errors()){
            //加载页面
                $data['role_kind'] = $this->User_model->get_all_role();
                $this->load->view('header');
                $this->load->view('Login/add',$data);
            }else{
                //表单验证不通过的返回数据
                $data['message'] = array('content' => validation_errors());
                $this->load->view('header');
                $this->load->view('Login/add',$data);
            }
        }
    }

    public function update(){
        if(!$this->session->userdata('username') || !$this->session->userdata('role') || !$this->session->userdata('is_login')){
            redirect('Login/login');
            exit(0);
        }
        $this->load->library('form_validation');
        $this->load->model('User_model');        
        //表单验证
        $this->form_validation->set_rules('stuid', '学号', 'required');  
        $this->form_validation->set_rules('major', '专业', 'required');
        if($this->form_validation->run()!= FALSE){
            $array = array(
                'phone' => $this->input->post('phone',TRUE),
                'qq' => $this->input->post('qq',TRUE),
                'email' => $this->input->post('email',TRUE),
                'stuid' => $this->input->post('stuid',TRUE),
                'major' => $this->input->post('major',TRUE),
                'dormitory' => $this->input->post('dormitory',TRUE)
                );
            if($this->User_model->update_userdata($array,$this->session->userdata('id'))){
                $this->saveLog(34 , 5 , $this->input->post('username',TRUE).'修改了个人信息' , $this->input->post('username',TRUE));
                redirect('Login/index');
            }else{
                $this->saveLog(34 , 8 , $this->input->post('username',TRUE).'在修改个人信息时发生了未知错误' , $this->input->post('username',TRUE));
                redirect('Login/update');
            }
        }else{
            if(!validation_errors()){
                //初始化数据
                $data = $this->User_model->get_detail_by_id($this->session->userdata('id'));
                $data['role'] = $this->User_model->get_role_by_rid($this->session->userdata('role'));
                $this->load->view('header');
                $this->load->view('Login/update',$data);
            } else{
                //表单验证不通过的返回数据
                $data = $this->User_model->get_detail_by_id($this->session->userdata('id'));
                $data['role'] = $this->User_model->get_role_by_rid($this->session->userdata('role'));
                $data['message'] = array('content' => validation_errors());
                $this->load->view('header');
                $this->load->view('Login/update',$data);
            }
        }
    }
}