<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title> Расписание на всю неделю </title>
    <!-- Отображать страницу в масштабе 100% на маленьких экранах -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Инструкция для старых версий IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Собственные стили -->
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all">
</head>
<body>

<?php
	require_once 'header.php';
?>

<div class="content">

<?php
	require 'connect.php';
	require_once 'functions.php';
	
	selectGroup();
	
	if (!isset($_COOKIE["group_id"])){
		echo 'выберите группу<br>';
	} else {
		$group_id = $_COOKIE["group_id"];
		
		$query = "SELECT * FROM `GROUPS` WHERE `group_id` = '".$group_id."'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
		
		mysqli_free_result($result);
		
		if (empty($row)){
			echo 'выбрана некорректная группа<br>';
		} else {
			$number_of_week = date('W');
			for ($day_of_week = 1; $day_of_week <= 7; $day_of_week++){
		    	printSchedule($day_of_week, $number_of_week, $group_id);
		    }
		}
	}
	mysqli_close($link);
?>
</div>

<?php
	require_once 'footer.php';
?>

</body>
</html>