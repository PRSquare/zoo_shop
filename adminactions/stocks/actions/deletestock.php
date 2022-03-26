<?php 
	// Удаление акции

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';

	if(!empty($_POST)){
		$db_link = connectToDB(); // Подключение к БД

		$id = $_POST['stock_id']; // Id продукта
		safety_db_query($db_link, "DELETE FROM stocks WHERE id=?", 'i', $id); // Удаление акции из БД
	}
	header("Location: /adminactions/stocks/stocklist.php?status=success"); // Перенаправление на передидущую
?>