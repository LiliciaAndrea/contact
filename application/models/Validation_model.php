<?php
class Validation_model extends CI_Model {
//Validation模型
//操作Validation数据表
//2015年9月20日 袁帅
	public function check_code($data)
	{
		//通过code与name获取数据
		$where = array('code' => $data['code'] , 'name' => $data['name']);
		$this->db->limit(1);
		$this->db->where($where);
		$query = $this->db->get('Validation_code');
		$array = $query->result_array();
		//验证
		if($array){
			if($array[0]['is_active'] != 1){
				$return = array('status' => '10' , 'message' => '激活码匹配成功' , 'data' => $array[0]);
				return $return;
			} else{
				$return = array('status' => '01' , 'message' => '该激活码已经被使用');
			}
		} else{
			$return = array('status' => '00' , 'message' => '激活码不匹配,可能是姓名与激活码不匹配');
			return $return;
		}
	}

	public function get_code_by_code($code)
	{
		$this->db->where('code',$code);
		$this->db->limit(1);
		$query = $this->db->get('Validation_code');
		$array = $query->result_array();
		return $array[0];
	}

	public function set_code_active($code)
	{
		$this->db->where('code' , $code);
		$this->db->limit(1);
		$update = array('is_active' => 1);
		return $this->db->update('Validation_code' , $update);
	}

	public function insert_validation_code($data = array()){
		//将生成的激活码、推荐人id、职务写入数据库
		return $this->db->insert('Validation_code',$data);
}
}