<?php
	//$check = setcookie("group_id", "2", time() + 60 * 60 * 24 * 90); // 90 дней
	
	unset($_COOKIE["group_id"]);
	echo $_COOKIE["group_id"];
	
	/*if (isset($_COOKIE["group_id"])){
		echo 'cookie настроены';
	} else {
		echo 'cookie не настроены';
	}
	print_r($_COOKIE["group_id"]);*/
?>