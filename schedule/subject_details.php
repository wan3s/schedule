<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title> Подробнее о предмете </title>
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
<div class="block">
<?php
	if (isset($_POST['go'])){
		
		$week_parity = array("Нечётная", "Чётная", "Любая");
		$days = array("Понедельник" , "Вторник" , "Среда" , "Четверг" , "Пятница" , "Суббота" , "Воскресенье" );
		
		require 'connect.php';
		
		$query = "SELECT * FROM `SUBJECTS` WHERE `subject_id` = '".$_POST['subject_id']."'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
		
		echo '<h1>Подробнее:</h1>';
		echo '<table cellspacing = "0" class="details">';
		echo '<tr><td class = "property_name">Название предмета: </td><td class="property_value">'.$row['name'].'</td></tr>';
		echo '<tr><td class = "property_name">Преподаватель: </td><td class="property_value">'.$row['teacher'].'</td></tr>';
		echo '<tr><td class = "property_name">Аудитория: </td><td class="property_value">'.$row['classroom'].'</td></tr>';
		echo '<tr><td class = "property_name">Начало: </td><td class="property_value">'.$row['start_time'].'</td></tr>';
		echo '<tr><td class = "property_name">Конец: </td><td class="property_value">'.$row['end_time'].'</td></tr>';
		echo '<tr><td class = "property_name">День недели: </td><td class="property_value">'.$days[$row['day_of_week'] - 1].'</td></tr>';
		echo '<tr><td class = "property_name">Чётность недели: </td><td class="property_value">'.$week_parity[$row['week_parity']].'</td></tr>';
		echo '</table>';
		
		echo '<br><br><a onclick="javascript:history.back(); return false;"> &larr; Назад</a>';
		mysqli_free_result($result);
		mysqli_close($link);
	}
?>
</div>
</div>
<?php
	require_once 'footer.php';
?>

</body>
</html>