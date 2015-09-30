<?php
class Log_model extends CI_Model {
//日志模型
//操作Log数据表
//袁帅,2015年9月20日
	public function insert_log($type,$level,$content,$username)
	{
		$data = array('username' => $username , 'type' => $type , 'level' => $level , 'content' => $content , 'ip'=>get_ip() ,'time' => time());
		return $this->db->insert('Log',$data);
	}
}