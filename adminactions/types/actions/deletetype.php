<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';

	session_start();
	if(prev_check($_SESSION['user']) == 2 and
	!empty($_POST)) { // Проверка POST запроса и превелегий пользователя
		$db_link = connectToDB(); // Подключение к БД

		$id = $_POST['type_id']; // Id продукта

		safety_db_query($db_link, "DELETE FROM product_types WHERE id=?", 's', $_POST['type_id']); // Удаление типа
	}
	header("Location: ".$_SERVER['HTTP_REFERER']); // Возврат на предыдущую страницу
?>