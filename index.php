<?php 
	require('./include/init.php');


	$conf = conf::getIns();

	print_r($conf);
	
	echo "<hr />";
	echo $conf->host,'<br />';
	echo $conf->user;
 	
 	echo "<hr />";
 	$conf->template_dir = '/user/local/var/www/htdocs/boolMall';
 	echo $conf->template_dir;
 	
 	echo "<hr />";
 	log::write('record_1');
 	class mysql{
 		public function query($sql){
 			log::write($sql);
 		}
 	}
 	$mysql=new mysql();
 	for ($i=0;$i<5000;$i++){
 		$sql = 'select goods_id,goods_name,goods_id,goods_name,
 		goods_id,goods_name,goods_id,goods_name,goods_id,goods_name,goods_id,
 		goods_name,goods_id,goods_name,goods_id,goods_name,goods_id,
 		goods_name,goods_id,goods_name,shop_price from goods where goods_id' . mt_rand(1,1000);
 		$mysql->query($sql);
 	}
 	echo 'Task completed!'; 
 ?>