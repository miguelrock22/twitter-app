<?php
require_once 'BaseModel.php';

class User extends BaseModel{

	public $username;
	public $email;
	public $phone;
	public $password;

	public function __construct(){
		parent::__construct();
		$this->table = "users";
		$this->fields = array(
			'username',
			'email',
			'phone_number',
			'password',
		);
	}

	public function loadLogin($data){
		$sql = "SELECT * FROM users WHERE username = \"" . $data['username'] ."\" AND password = md5('".$data['password']. "');";
		$res = $this->db->query($sql);
		return $res;
	}

	public function store(){
		$values = "'{$this->username}','{$this->email}',{$this->phone},MD5('{$this->password}')";
		return $this->insert($values);
	}

	public function getByUsername(){
		$sql = "SELECT * FROM users WHERE username = '{$this->username}';";
		$res = $this->db->query($sql);
		$count = $res->num_rows;
		return $count;
	}

	public function getByEmail(){
		$sql = "SELECT * FROM users WHERE email = '{$this->email}';";
		$res = $this->db->query($sql);
		$count = false;
		if($res){
			$count = $res->num_rows;
		}
		return $count;
	}
}
