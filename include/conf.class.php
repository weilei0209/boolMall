<?php 
	class conf{
		protected static $ins = null;
		protected $data = array();

		final protected function __construct(){
			include(ROOT . 'include/config.inc.php');
			$this->data = $_CFG;
		}

		final protected function __clone(){

		}

		public static function getIns(){
			if(self::$ins instanceof self){
				return self::$ins;
			}else{
				self::$ins = new self();
				return self::$ins;
			}
		}

		public function __get($key){
			if(array_key_exists( $key,$this->data)){
				return $this->data[$key];
			}else{
				return null;
			}
		}

		public function __set($key,$value){
			$this->data[$key] = $value;
		}
	}

/*	$conf = conf::getIns();

	print_r($conf);
	echo "<hr />";
	echo $conf->host,'<br />';
	echo $conf->user;
 	echo "<hr />";
 	$conf->template_dir = '/user/local/var/www/htdocs/boolMall';
 	echo $conf->template_dir;
*/
?>