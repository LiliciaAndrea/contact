<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {
//公用类
//记录日志,上传,分页,下载,权限
//袁帅,2015年9月20日
	public function __construct()
	{
		parent::__construct();
	}

	protected function saveLog($type , $level , $content , $name='')
	{
		$this->load->model('Log_model');
		//处理用户名
		if($name != '')
			$username = $name;
		elseif($this->session->userdata('username'))
			$username = $this->session->userdata('username');
		elseif($this->input->post('username'))
			$username = $this->input->post('username');
		else
			$username = 'ERROR!';
		//插入日志信息
		try{
			return $this->Log_model->insert_log($type,$level,$content,$username);
		} catch(Exception $e){
			$type = 10;
			$level = 8;
			$content = $e->getMessage();
			$username = 'LogSystem';
			$this->Log_model->insert_log($type,$level,$content,$username);
			return FALSE;
		}
	}
	protected function getPage($count , $limit , $now_page)
	{
		$page = array('last_page' => NULL , 'next_page' => NULL , 'lpage1' => NULL , 'lpage2' => NULL , 'npage1' => NULL , 'npage2' => NULL);
		$page['count_page'] = ceil($count/$limit);
		$page['all_count'] = $count;
		$page['offset'] = ($now_page-1) * $limit;
		$page['limit'] = $limit;
		$page['now_page'] = $now_page;
		if($now_page - 4 > 0)
			$page['last_page'] = $now_page - 4;
		if($now_page + 4 <= $page['count_page'])
			$page['next_page'] = $now_page +　4;
		if($now_page - 1 > 0)
			$page['lpage1'] = $now_page - 1;
		if($now_page - 2 > 0)
			$page['lpage2'] = $now_page - 2;
		if($now_page + 1 <= $page['count_page'])
			$page['npage1'] = $now_page + 1;
		if($now_page + 2 <= $page['count_page'])
			$page['npage2'] = $now_page + 2;
		return $page;
	}
	protected function checkUser($array)
	{
		
	}
	protected function _upload()
	{
		
	}

	 protected function export($data){
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
        ob_clean();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator($this->session->userdata('username'))
                                    ->setLastModifiedBy($this->session->userdata('username'))
                                    ->setTitle("qnxg tongxunlu")
                                    ->setSubject("qnxg tongxunlu")
                                    ->setDescription("qnxg tongxunlu")
                                    ->setKeywords("qnxg tongxunlu")
                                    ->setCategory("tongxunlu Excel");
        $head = $data['head'];
        foreach($head as $key => $row){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($key,$row);
        }
        $content = $data['content'];
        foreach($content as $key => $row){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($key,$row);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit($key,$row,PHPExcel_Cell_DataType::TYPE_STRING);
        }
        $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
        $objPHPExcel->setActiveSheetIndex(0);
        $filename = $this->session->userdata('username').date('mdHi',time()).".xls";
        $objWriter = IOFactory::createWriter($objPHPExcel,'Excel5');
        $filename = iconv('utf-8','gb2312',$filename);
        header('Content-Type: application/vnd.ms-excel');   
        header('Cache-Control: max-age=0');
        header('Content-Disposition:attachment;filename="'.$filename.'"');
        header('Pargma:public');
        
        $objWriter->save('php://output');
        exit;
    }
}