<?php
	if (isset($_POST['select_group'])){
		setcookie("group_id", $_POST['groups'], time() + 60 * 60 * 24 * 90); // 90 дней
		echo $_POST['groups'];
	}
	header('Location: '.$_POST['page_name']);
?>
