<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/render_template.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';

	// Запуск сессии
	session_start();
	if(!isset($_SESSION['user']))
		header("Location: /login.php"); // Перенаправление на страницу входа, если пользователь не авторизирован

	$answer;

	try {
		$answer = prev_check($_SESSION['user']);
	} catch (Exception $e) {
		print($e->getMessage());
	}

	if($answer != 2 or empty($_GET['s_product_id'])){ // Проверка привелегий администратора
		header("Location: /account.php"); 
	}

	$db_link = connectToDB(); // Подключение к БД

	$all_users = safety_db_query($db_link, "SELECT * FROM users"); // Список пользователей

	$product_id = $_GET['s_product_id']; // Id продукта

	$add_form = renderTemplate('templates/addstock.php', ['product_id'=>$product_id, 'users'=>$all_users]); // Контент страницы

	$content = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php', ['title'=>'Добавление акции', 'content'=>$add_form]); // Страница целиком

	print($content); // Отображение страницы

	mysqli_close($db_link); // Закрытие соединения с БД
?>