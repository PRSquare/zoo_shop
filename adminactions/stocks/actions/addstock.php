<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	
	if(!empty($_POST) and 
	isset($_POST['discount_size']) and 
	isset($_POST['prod_id']) and 
	isset($_POST['user'])){ // Проверка POST запроса
		// Подключение к БД
		$db_link;
		try {
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
		}

		$end_date = $_POST['end_time'] ?? "000000000000"; // Время окончания акции
		$end_date = $end_date.'00';
		$end_date = preg_replace('~\D+~', '', $end_date); // Удаление мз строки времени всех символов кроме цифр
		safety_db_query($db_link, "INSERT INTO stocks (product_id, description, stock_end_date, discount_size) VALUES (?, ?, ?, ?)", 'issi', $_POST['prod_id'], $_POST['description'] ?? '', $end_date, $_POST['discount_size']); // добавление акции

		$stock_id = safety_db_query($db_link, "SELECT LAST_INSERT_ID()")[0]['id']; // Получаем id только что добавленной акции
		
		$users = $_POST['user']; // Список пользователей, к которым относится акция
		if ($users[0] == 'all_users'){  // Если выбрана опция "все пользователи"
			$all_us = safety_db_query($db_link, "SELECT id FROM users"); // Получаем id всех пользователей
			$users = [];
			foreach ($all_us as $us) {
				$users[] = $us['id'];
			}
		}


		foreach ($users as $user) {
			safety_db_query($db_link, "INSERT INTO personal_stocks (user_id, stock_id) VALUES (?, ?)", 'ii', $user, $stock_id); // Добавляем акции
		}
	}
	header("Location: /adminactions/products/productlist.php"); // Перенаправление на прошлую
?>

