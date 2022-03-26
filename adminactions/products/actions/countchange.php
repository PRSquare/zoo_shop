<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';

	session_start();
	if(prev_check($_SESSION['user']) == 2 and
	!empty($_POST) and 
	!empty($_POST['cc_product_id'] and 
	!empty($_POST['arrived_prod_count']))) { // Проверка полученных через POST запрос данных и проав пользователя
		// Подключение к БД
		$db_link = connectToDB();

		$sdq = safety_db_query($db_link, "UPDATE products SET count = count+? WHERE id=?", 'ii', $_POST['arrived_prod_count'], $_POST['cc_product_id']); // Изменение кол-ва товара
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>