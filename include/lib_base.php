<?php 
	function _addslashes($arr){
		foreach ($arr as $k => $v) {
			if(is_string($v)){
				$arr[$k] = addcslashes($v);
			}elseif (is_array($v)) {
				# code...
				$arr[$k]=_addslashes($v);
			}
		}

		return $arr;
	}

 ?>