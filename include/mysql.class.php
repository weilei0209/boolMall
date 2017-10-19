<?php 

	class mysql extends db{
		private static $ins = NULL;
		private $conn = NULL;
		private $conf = array();

		protected function __construct(){
			$this->conf = conf::getIns();

			$this->connect($this->conf->host,$this->conf->user,$this->conf->pwd);
			$this->select_db($this->conf->db);
			$this->setChar($this->conf->char);
		}
		public function __destruct(){
			mysqli_close($this->conn);
		}

		public static function getIns(){
			if (!(self::$ins instanceof self)){
				self::$ins = new self();
			}
			return self::$ins;
		}

		public function connect ($h,$u,$p){
			$this->conn = mysqli_connect($h,$u,$p);
			if(!$this->conn){
				$err = new Exception('Connection failed');
				throw $err;
			}
		}

		protected function select_db($db){
			$sql = 'use ' . $db;
			$this->query($sql);
		}

		protected function setChar($char){
			$sql = 'set names ' . $char;
			return $this->query($sql);
		}

		public function query($sql){
			if ($this->conf->debug){
				$this->log($sql);
			}

			$rs = mysqli_query($this->conn,$sql);

			if(!$rs){
				$this->log($this->error());
			}

			return $rs;
		}

		public function log($sql){
			log::write($sql);
		}

		public function autoExecute($arr,$table,$mode='insert',$where = 'where 1 limit 1'){
			if(!is_array($arr)){
				return false;
			}
			if($mode == 'update'){
				$sql = 'update' . $table . 'set';
				foreach ($arr as $key => $value) {
					# code...
					$sql .= $key . "='" .$value ."',";
				}
				$sql = rtrim($sql,',');
				$sql .= $where;

				return $this->query($sql);
			}
			$sql = 'insert ino' . $table . ' (' . implode(',',array_keys($arr)) . ')';
			$sql .=' values (\'';
			$sql .= implode("','",array_values($arr));
			$sql .= '\'';

			return $this->query($sql);
		}

		public function getAll($sql){
			$rs = $this->query($sql);
			$list = array();
			while($row = mysqli_fetch_assoc($rs)){
				$list[]=$row;
			}
			return $list;
		}

		public function getRow($sql){
			$rs = $this->query($sql);
			return mysqli_fetch_assoc($rs);
		}

		public function getOne($sql){
			$rs = $this->query($sql);
			$row =mysqli_fetch_row($rs);

			return $row[0];
		}

		public function affected_rows(){
			return mysqli_affected_rows($this->conn);
		}

		public function insert_id(){
			return mysqli_insert_id($this->conn);
		}
	}
?>