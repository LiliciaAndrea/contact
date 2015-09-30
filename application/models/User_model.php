<?php
class User_model extends CI_Model {
//用户模型
//操作User数据表
//袁帅,2015年9月20日
	public function check_login($username , $password)
	{
		$this->db->limit(1);
		$where = array( 'username' => $username , 'password' => md5($password) , 'is_delete' => 0);
		$this->db->where($where);
		$query = $this->db->get('User_info');
		if($query->num_rows() > 0){
			$data = $query->result_array();
			$result = array( 'status' => '10' , 'message' => '验证成功' , 'data' => $data[0]);
		}else{
			$result = array( 'status' => '00' , 'message' => '验证失败');
		}
		return $result;
	}

	public function create_user($array)
	{
		//获取工号
		$last = $this->get_last_id();
		if($last)
			$username = sprintf("%04d",500 + $last['id']);
		else
			$username = sprintf("%04d",500);
		//插入信息
		$data = array(
						'username' => $username , 'password' => md5($array['password']) , 'role' => $array['role'] ,
						'time' => time() , 'is_delete' => 0
					  );
		if(isset($array['pid'])){
			$data['pid'] = $array['pid'];
		}
		//插入info表
		$result = $this->db->insert('User_info',$data);
		if(!$result){
			$return = array('status' => '02' , 'message' => $username.'在注册时发生了数据库错误!');
			return $return;
		} else{
			//插入detail表
			$detail = array(
							'name' => $array['name'] , 'sex' => $array['sex'] , 'stuid' => $array['stuid'] ,
							'college' => $array['college'] , 'major' => $array['major'] , 'class' => $array['class'] ,
							'dormitory' => $array['dormitory'] , 'phone' => $array['phone'] , 'qq' => $array['qq'] ,
							'email' => $array['email']
						   );
			$result = $this->db->insert('User_detail',$detail);
			if(!$result){
				$this->db->delete_userdetal_by_username($username);
				$return = array('status' => '02' , 'message' => $username.'在注册时成功插入了info表,但在插入detail表时发生了错误!');
				return $return;
			} else{
				$user = $this->get_user_by_username($username);
				$return = array('status' => '10' , 'message' => $username.'使用了'.$this->session->userdata('code').'注册成功');
				$return['user'] = $user;
				return $return;
			}
		}
	}

	protected function get_last_id()
	{
		$this->db->limit(1);
		$this->db->order_by('id DESC');
		$query = $this->db->get('User_info');
		$array = $query->result_array();
		if($array){
			return $array[0];
		} else{
			return FALSE;
		}
	}

	protected function delete_userdetal_by_username($username)
	{
		$this->db->limit(1);
		$this->db->where('username',$username);
		return $this->db->delete('User_detail');
	}

	public function get_user_by_username($username)
	{
		$this->db->limit(1);
		$this->db->where('username',$username);
		$this->db->from('User_info');
		$this->db->join('User_detail' , 'User_detail.id = User_info.id');
		$query = $this->db->get();
		$array = $query->result_array();
		if($array){
			return $array[0];
		} else{
			return FALSE;
		}
	}

	public function get_role_by_rid($rid)
	{
		$this->db->limit(1);
		$this->db->where('id',$rid);
		$query = $this->db->get('User_role');
		$array = $query->result_array();
		if($array){
			return $array[0]['name'];
		} else{
			return FALSE;
		}
	}

	public function get_detail_by_id($id){
		$this->db->limit(1);
		$this->db->where('id',$id);
		$query = $this->db->get('User_detail');
		$array = $query->result_array();
		if($array){
			return $array[0];
		}else{
			return FALSE;
		}
	}

	public function get_role_by_id($id){
		$this->db->limit(1);
		$this->db->where('id',$id);
		$query = $this->db->get('User_info');
		$array = $query->result_array();
		$rid = $array[0]['role'];
		return $this->get_role_by_rid($rid);
	}

	public function get_pid_detail_by_id($id){
		$this->db->limit(1);
		$this->db->where('id',$id);
		$query = $this->db->get('User_info');
		$array = $query->result_array();
		$pid = $array[0]['pid'];
		$result = array();
		if($pid){
			$role = $array[0]['role'];
			$result = $this->get_detail_by_id($pid);
			$pid = $result['id'];
			$result['role'] = $this->get_role_by_id($pid);
	    }
		return $result;
	}

	public function get_pin_detail_by_id($id){
		//$this->db->where('is_active',1);
		$this->db->where('uid',$id);
		$query = $this->db->get('Validation_code');
		$result = array();
		foreach($query->result_array() as $key => $row){
			if($row['is_active'] == 0){
				$result[$key]['id'] = 0; 
			}else{
				$this->db->where('name',$row['name']);
				$array = $this->db->get('User_detail')->result_array();
				$result[$key]['id'] = $array[0]['id'];
			}
			$result[$key]['code'] = $row['code'];
			$result[$key]['name'] = $row['name'];
		}
		return $result;
	}

	public function search_by_all($search = FALSE){
		$result = array();
		if($search == FALSE){
			$query = $this->db->get('User_detail');
			$array = $query->result_array();
		}else{
			$this->db->where('stuid',$search);
			$this->db->or_where('college',$search);
			$this->db->or_where('major',$search);
			$this->db->or_where('name',$search);
			$query = $this->db->get	('User_detail');
			$array = $query->result_array();
		}
		$result = $array;
		foreach($array as $key => $value){
			if($value['sex']==1){
				$result[$key]['sex'] = '男';
			}else{
				$result[$key]['sex'] = '女';
			}
		}

		foreach($array as $key => $value){
			//通过ID获取工号
			$this->db->where('id',$value['id']);
			$this->db->limit(1);
			$query = $this->db->get('User_info');
			$row = $query->row();
			$result[$key]['work_num'] = $row->username;
			//通过ROLE获取职务
			
			$result[$key]['role'] = $this->get_role_by_rid($row->role);

		}

		return $result;
	}

	public function select_user_by_role_and_sex($role = 0,$sex = 0 ){
		$array = array();
		$result = array();
		if(intval($sex) <= 0 || intval($sex) > 2){
			if(intval($role)==0){
			//加载全部成员
				$query = $this->db->get('User_detail');
				$array = $query->result_array();
			}else{
			//筛选职务
				if($this->get_role_pid_by_id($role)==0){
					$this->db->where('role',$role);
					$this->db->from('User_info');
					$this->db->join('User_detail','User_detail.id = User_info.id');
					$query = $this->db->get();
					$array = $query->result_array();
				}else{
					$i=0;
					$this->db->where('role',$role);
						$this->db->from('User_info');
						$this->db->join('User_detail','User_detail.id = User_info.id');
						foreach($this->db->get()->result_array() as $row){
							$array[$i] = $row;
							$i++;
						}
					$pid_role = $this->get_role_id_by_pid($role);
					foreach($pid_role as $role_id){
						$this->db->where('role',$role_id['id']);
						$this->db->from('User_info');
						$this->db->join('User_detail','User_detail.id = User_info.id');
						foreach($this->db->get()->result_array() as $row){
							$array[$i] = $row;
							$i++;
						}
					}
				}
			}			
		}else{
			//筛选职务、性别
			if(intval($role)==0){
				$this->db->where('sex',$sex);
				$query = $this->db->get('User_detail');
				$array = $query->result_array();
			}else{
				if($this->get_role_pid_by_id($role)==0){
					$this->db->where('role',$role);
					$this->db->from('User_info');
					$this->db->join('User_detail','User_detail.id = User_info.id');
					$query = $this->db->get();
					$i=0;
					foreach($query->result_array() as $row){
						if($row['sex'] == $sex){
							$array[$i] = $row;
							$i++;
						}
					}
				}else{
					$i=0;
					$this->db->where('role',$role);
					$this->db->from('User_info');
					$this->db->join('User_detail','User_detail.id = User_info.id');
					foreach($this->db->get()->result_array() as $row){
						$array[$i] = $row;
						$i++;
					}
					$pid_role = $this->get_role_id_by_pid($role);
					foreach($pid_role as $role_id){
						$this->db->where('role',$role_id['id']);
						$this->db->from('User_info');
						$this->db->join('User_detail','User_detail.id = User_info.id');
						$query = $this->db->get();
						foreach($query->result_array() as $row){
							if($row['sex'] == $sex){
								$array[$i] = $row;
								$i++;
							}
						}
					}
				}
			}
		}
		$result = $array;
		foreach($array as $key => $value){
			if($value['sex']==1){
				$result[$key]['sex'] = '男';
			}else{
				$result[$key]['sex'] = '女';
			}
		}

		foreach($array as $key => $value){
			//通过ID获取工号
			$this->db->where('id',$value['id']);
			$this->db->limit(1);
			$query = $this->db->get('User_info');
			$row = $query->row();
			$result[$key]['work_num'] = $row->username;
			//通过ROLE获取职务

			$result[$key]['role'] = $this->get_role_by_rid($row->role);
		}

		return $result;
	}

	public function get_all_role(){
		$this->db->where('is_delete',0);
		$array = $this->db->get('User_role')->result_array();
		return $array;
	}

	public function get_role_pid_by_id($id){
		$this->db->where('id',$id);
		$this->db->limit(1);
		$array = $this->db->get('User_role')->result_array();
		if($array){
			return $array[0]['pid'];
		}else{
			return FALSE;
		}
	}

	public function get_role_id_by_pid($pid){
		$this->db->where('pid',$pid);
		$this->db->where('is_delete',0);
		$array = $this->db->get('User_role')->result_array();
		if($array){
			return $array;
		}else{
			return FALSE;
		}
	}

	public function update_userdata($data,$id){
		$this->db->where('id',$id);
		if($this->db->update('User_detail',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}