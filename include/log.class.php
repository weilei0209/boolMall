<?php 
	class log{
		
		const LOGFILE = 'curr.log';

		public static function write($cont){
			$cont = $cont . "\r\n";
			$log  = self::isBak();

			$fh = fopen($log,'ab');
			fwrite($fh, $cont);
			fclose($fh);
		}

		public static function bak(){
			$log = ROOT . 'data/log/' . self::LOGFILE;
			$bak = ROOT .'data/log/' . date('ymd') .'_' . mt_rand(10000,99999) . 'bak';
			rename($log,$bak);
		}

		public static function isBak(){
			$log = ROOT . 'data/log/' . self::LOGFILE;

			if(!file_exists($log)){
				touch($log);
				return $log;
			}

			//clear the cache of file information

			clearstatcache(true,$log);

			$size = filesize($log);
			if($size < 1024*1024){
				return $log;
			}
			if(!self::bak()){
				return $log;
			}else{
				touch($log);
				return $log ;
			}
		}

	}
 ?>