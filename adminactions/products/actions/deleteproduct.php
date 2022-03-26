<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';

	session_start();
	if(prev_check($_SESSION['user']) == 2 and
	!empty($_POST)) { //  // Проверка полученных через POST запрос данных и проав пользователя
		// Подключение к БД
		$db_link = connectToDB();

		$id = $_POST['product_id']; // Id продукта
		$imgpath = safety_db_query($db_link, "SELECT path_to_img FROM products WHERE id=?", 'i', $_POST['product_id'])[0]['path_to_img']; // Путь к изображению
		$imgcount = count(safety_db_query($db_link, "SELECT * FROM products WHERE path_to_img = ?", 's', $imgpath)); // Подсчет кол-ва товаров с тем же изображением

		if(!stripos($imgpath, "placeholder.png") and $imgcount == 1) // Если последний товар и не placeholder
			if( file_exists($_SERVER['DOCUMENT_ROOT'].$imgpath) )
				unlink($_SERVER['DOCUMENT_ROOT'].$imgpath); // Удаление изображения

		$sdq = safety_db_query($db_link, "DELETE FROM products WHERE id=?", 'i', $_POST['product_id']); // Удаление товара из БД
	}
	header("Location: ".$_SERVER['HTTP_REFERER']."?status=success");
?>