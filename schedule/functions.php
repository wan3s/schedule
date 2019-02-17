<?php
	
	function printSchedule($day_of_week, $number_of_week, $group_id){
	
		require 'connect.php';
		
		$days = array("Понедельник" , "Вторник" , "Среда" , "Четверг" , "Пятница" , "Суббота" , "Воскресенье" );
		
		$query = "SELECT * FROM `WEEKS` WHERE `group_id` = '".$group_id."'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
		
		mysqli_free_result($result);
			
		$week_parity = ($number_of_week - $row['start_week']) % 2;
			
		$query = "SELECT * FROM `SUBJECTS` WHERE `group_id` = '".$group_id."' AND `day_of_week` = '".$day_of_week."' AND (`week_parity` = '".$week_parity."' OR `week_parity` = '2') ORDER BY `number`";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
		
		echo '<div class = "block">';
		echo '<h1>'.$days[$day_of_week - 1].':</h1>';
		
		if (empty($row)){
			echo 'У выбранной группы нет занятий в этот день<br>';
		} else {
			echo '<table cellspacing="0">';
			while ($row){
				echo '<tr><td>'.$row["number"].'</td><td>'.$row["name"].'</td><td>'.$row["classroom"].'</td><td><form action="subject_details.php" method="POST"><input type="hidden" name = "subject_id" value="'.$row['subject_id'].'"><input type="submit" name="go" value="подробнее"></form></td></tr>';
				$row = mysqli_fetch_array($result);
			}
			echo '</table>';
		}
		echo '</div>';
		
		mysqli_free_result($result);
		mysqli_close($link);
	}
	
	function selectGroup () {
		
		require 'connect.php';
		
		$query = "SELECT * FROM `GROUPS`";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (empty($row)){
			echo 'Нет групп';
		} else {
			echo '<form method="POST" action="select_group_handler.php">';
			echo 'группа: <select name = "groups">';
			while ($row){
				if (isset($_COOKIE["group_id"]) && $_COOKIE["group_id"] == $row["group_id"]){
					echo '<option value = "'.$row['group_id'].'" selected>'.$row['name'].'</option>';
				} else {
					echo '<option value = "'.$row['group_id'].'">'.$row['name'].'</option>';
				}
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			}
			echo '</select>';	
			echo '<input type = "submit" name = "select_group" value = "выбрать">';
			echo '<input type = "hidden" name = "page_name" value = "'.$_SERVER['SCRIPT_NAME'].'">';
			echo '</form><br>';
		}
		
		mysqli_close($link);
		mysqli_free_result($result);
		
	}
	
?>