<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Common.php';

class Search extends Common {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //用于显示查找页面,暂无分页
        if(!$this->session->userdata('is_login')){
            redirect('Login/login');
            exit(0);
        }
        $search = $this->input->get('submitted',TRUE);
        $role = intval($this->input->get('role',TRUE));
        $sex = intval($this->input->get('sex',TRUE));
        if($search == NULL || $search == 0){
            $search = 0;
            if(($sex==0 && $role==0)){
                $this->load->model('User_model');
                $content = $this->User_model->search_by_all();
            }else{
                $this->load->model('User_model');
                $content = $this->User_model->select_user_by_role_and_sex($role,$sex);
            }
        }else{
            $this->load->model('User_model');
            $content = $this->User_model->search_by_all($search);
           
        }
        //开始分页
        if($this->input->get('now_page')){
        $now_page = $this->input->get('now_page');
        }else{
            $now_page = 1;
        }
        $limit = 5;
        $count = count($content);
        $data['page'] = $this->getPage($count , $limit , $now_page);
        $data['page']['url'] = base_url().'index.php/Search/index?role='.$role.'&sex='.$sex.'&submitted='.$search.'&now_page=';
        //分页结束
        $data['content'] = array_slice($content,$limit*($now_page-1),$limit);
        $data['role_kind'] = $this->User_model->get_all_role();
        $data['download'] = 'exportExcel?'.'submitted='.$search.'&role='.$role.'&sex='.$sex;
        $this->load->view('header');
        $this->load->view('Search/index',$data);
    }

    public function get_detail()
    {
        //用于显示详细信息
        if(!$this->session->userdata('is_login')){
            redirect('Login/login');
            exit(0);
        }
        $id = intval($this->input->get('id',TRUE));
        $this->load->model('User_model');
        $data = $this->User_model->get_detail_by_id($id);
        $data['role'] = $this->User_model->get_role_by_id($id);
        $data['pid_detail'] = $this->User_model->get_pid_detail_by_id($id);
        $data['pin_detail'] = $this->User_model->get_pin_detail_by_id($id);
        if($data!=FALSE){
            $this->load->view('header');
            $this->load->view('Search/detail',$data);
        }
        else{
            redirect('Search/index');
        }
    }


    public function exportExcel()
    {
        //用于输导出为Excel表格
        if(!$this->session->userdata('is_login')){
            redirect('Login/login');
            exit(0);
        }
        $search = $this->input->get('submitted',TRUE);
        $role = intval($this->input->get('role',TRUE));
        $sex = intval($this->input->get('sex',TRUE));
        if($search == NULL||$search==0){
             if(($sex==0 && $role==0)){
                $this->load->model('User_model');
                $data['content'] = $this->User_model->search_by_all();
            }else{
                $this->load->model('User_model');
                $data['content'] = $this->User_model->select_user_by_role_and_sex($role,$sex);
            }
        }else{
            $this->load->model('User_model');
            $content = $this->User_model->search_by_all($search);
        }
        $data['head'] = array(
                            'A1' => '工号',
                            'B1' => '姓名',
                            'C1' => '职务',
                            'D1' => '性别',
                            'E1' => '学号',
                            'F1' => '学院',
                            'G1' => '专业',
                            'H1' => '班级',
                            'I1' => '宿舍',
                            'J1'=>'电话',
                            'K1'=>'QQ号',
                            'L1'=>'邮箱'
            );
        $i = 2;
        foreach($content as $key => $row){
            $data['content']['A'.$i] = $row['id'];
            $data['content']['B'.$i] = $row['name'];
            $data['content']['C'.$i] = $row['role'];
            $data['content']['D'.$i] = $row['sex'];
            $data['content']['E'.$i] = $row['stuid'];
            $data['content']['F'.$i] = $row['college'];
            $data['content']['G'.$i] = $row['major'];
            $data['content']['H'.$i] = $row['class'];
            $data['content']['I'.$i] = $row['dormitory'];
            $data['content']['J'.$i] = $row['phone'];
            $data['content']['K'.$i] = $row['qq'];
            $data['content']['L'.$i] = $row['email'];
            $i++;
        }
        $this->export($data);
    }
}