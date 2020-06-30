<?php
require_once 'config/database.php';
class BaseModel{
	public $db;
	protected $fields;
	
	public function __construct() {
		$this->db = database::conectar();
	}

	public function insert($values){
		try{
			$fields = implode(',',$this->fields);
			$sql = "INSERT INTO {$this->table}($fields) VALUES($values);";
			$res = $this->db->query($sql);
			return ['ok' => $res, 'msg' => $this->db->error];
		}catch(Exception $e){
			return ['ok' => false, 'msg' => $e->getMessage()];
		}
	}
}