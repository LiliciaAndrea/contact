<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Common.php';

class Activate extends Common {
//用户激活类
//激活,填写注册信息
//袁帅,2015年9月20日
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//读取
		$this->load->library('form_validation');
		$this->load->model('Validation_model');
		//表单验证
		$this->form_validation->set_rules('name', '姓名', 'min_length[1]|max_length[20]|required');  
		$this->form_validation->set_rules('code', '激活码', 'min_length[1]|max_length[30]|required');
		if($this->form_validation->run()!= FALSE){
			$post = array('name' => $this->input->post('name',TRUE) , 'code' => $this->input->post('code',TRUE));
			$code = $this->Validation_model->check_code($post);
			switch($code['status']){
				//激活码不匹配
				case '00' :
					$data['message'] = array('content' => $code['message'] , 'type' => 'warning');
					$this->load->view('Activate/index',$data);
					break;
				//激活码已经使用
				case '01' :
					$data['message'] = array('content' => $code['message'] , 'type' => 'warning');
					$this->load->view('Activate/index',$data);
					break;
				//激活码匹配成功
				case '10' :
					$session = array('code' => $this->input->post('code' , TRUE) , 'name' => $this->input->post('name' , TRUE) , 'pid' => $code['data']['uid']);
					$this->session->set_userdata($session);
					redirect('Activate/regist');
					break;
				default :
					$data['message'] = array('content' => '未知错误' , 'type' => 'danger');
					$this->saveLog(20 , 8 , $this->input->post('name',TRUE).'在使用激活码'.$this->input->post('code' , TRUE).'发生了未知错误' , $this->input->post('name'));
					$this->load->view('Activate/index',$data);
					break;
			}
		} else{
			if(!validation_errors()){
				//初始化数据
				$data['message'] = array('content' => '请输入您的姓名与对应的激活码' , 'type' => 'warning');
				$this->load->view('Activate/index',$data);
			} else{
				//表单验证不通过的返回数据
				$data['message'] = array('content' => validation_errors() , 'type' => 'danger');
				$this->load->view('Activate/index',$data);
			}
		}
	}

	public function regist()
	{
		if(!$this->session->userdata('code') || !$this->session->userdata('name')){
			redirect('Activate/index');
			exit(0);
		}
		//读取
		$this->load->library('form_validation');
		$this->load->model('User_model');
		$this->load->model('Validation_model');
		$this->form_validation->set_rules('stuid', '学号', 'min_length[4]|max_length[20]|required');  
		$this->form_validation->set_rules('sex', '性别', 'greater_than[0]|less_than[3]|required');
		$this->form_validation->set_rules('college', '学院', 'min_length[3]|max_length[20]|required');
		$this->form_validation->set_rules('major', '专业', 'min_length[2]|max_length[20]|required');
		$this->form_validation->set_rules('class', '班级', 'min_length[2]|max_length[20]|required');
		$this->form_validation->set_rules('dormitory', '寝室信息', 'min_length[3]|max_length[20]|required');
		$this->form_validation->set_rules('phone', '手机号码', 'min_length[3]|max_length[20]');
		$this->form_validation->set_rules('qq', 'QQ号码', 'min_length[3]|max_length[20]');
		$this->form_validation->set_rules('email', 'E-mail', 'valid_email');
		$this->form_validation->set_rules('password', '登陆密码', 'min_length[6]|max_length[20]|required');
		$this->form_validation->set_rules('rpassword', '重复密码', 'matches[password]');
		if($this->form_validation->run()!= FALSE){
			//通过code获取职位信息
			$roleid = intval(substr($this->session->userdata('code') , 0 ,3));
			$role = $this->User_model->get_role_by_rid($roleid);
			if($role){
				//创建用户
				$array = array(
								'password' => $this->input->post('password' , TRUE) , 'role' => $roleid , 'name' => $this->session->userdata('name') , 'pid' => $this->session->userdata('pid') ,
								'sex' => $this->input->post('sex' , TRUE) , 'stuid' => $this->input->post('stuid' , TRUE) , 'college' => $this->input->post('college' , TRUE) ,
								'major' => $this->input->post('major' , TRUE) , 'class' => $this->input->post('class' , TRUE) , 'dormitory' => $this->input->post('dormitory' , TRUE) ,
								'phone' => $this->input->post('phone' , TRUE) , 'qq' => $this->input->post('qq' , TRUE) , 'email' => $this->input->post('email' , TRUE)
							   );
				$result = $this->User_model->create_user($array);
				switch($result['status']){
					case '02' :
						$this->saveLog(21 , 8 , $result['message'] , $this->session->userdata('name'));
						$data['message'] = array('content' => '系统繁忙,请稍后再试' , 'title'=>'警告' ,'type' => 'warning');
						$this->load->view('Activate/result',$data);
						break;
					case '10' :
						$this->saveLog(21 , 3 , $result['message'] , $this->session->userdata('name'));
						$this->Validation_model->set_code_active($this->session->userdata('code'));
						$this->session->sess_destroy();
						$data['message'] = array('content' => '注册成功,您已经成功成为千年弦歌的一员啦!' , 'title' => '注册成功' , 'type' => 'success');
						$data['user'] = $result['user'];
						$data['user']['role'] = $role;
						$this->load->view('Activate/result',$data);
						break;
					default :
						$this->saveLog(21 , 8 , $this->session->userdata('name').'在注册时发生了未知的错误' , $this->session->userdata('name'));
						$data['message'] = array('content' => '未知错误!' , 'title' => '错误' , 'type' => 'danger');
						$this->load->view('Activate/result',$data);
						break;
				}
			} else{
				$this->saveLog(21 , 8 , $this->session->userdata('name').'在使用'.$this->session->userdata('code').'时,找不到对应的职位信息' , $this->session->userdata('name'));
				$data['message'] = array('content' => '找不到您的激活码相对应的职位信息,请联系提供激活码的推荐人' , 'title' =>'警告' , 'type' => 'danger');
				$this->load->view('Activate/result',$data);
			}
		} else{
			if(!validation_errors()){
				//初始化数据
				$data['message'] = array('content' => '请完整填写以下信息,完成千年弦歌的成员注册' , 'type' => 'success');
				$this->load->view('Activate/regist',$data);
			} else{
				//表单验证不通过的返回数据
				$data['message'] = array('content' => validation_errors() , 'type' => 'danger');
				$this->load->view('Activate/regist',$data);
			}
		}
	}
}