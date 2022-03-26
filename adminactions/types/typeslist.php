<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require($_SERVER['DOCUMENT_ROOT'].'/scripts/render_template.php');
	require($_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php');
	require($_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php');
	require($_SERVER['DOCUMENT_ROOT'].'/scripts/utils/get_user_page.php');

	// Подключение к БД
	$db_link;
	try{
		$db_link = connectToDB();
	}
	catch( Exception $e )
	{
		echo "Exception: ", $e->getMessage(), "\n";
	} 
	
	session_start(); // Запуск сессии
	if(!isset($_SESSION['user']))
		header("Location: /login.php"); // Проверка авторизации

	$answer;

	try {
		$answer = prev_check($_SESSION['user']);
	} catch (Exception $e) {
		print($e->getMessage());
	}

	if($answer != 2){ // Проверка превелегий пользователя
		header("Location: /account.php");
	}

	$user_page = getUserPage($db_link); // Страничка пользователя

	$products = safety_db_query($db_link, "SELECT * FROM products"); // Список продуктов
	$types = safety_db_query($db_link, "SELECT * FROM product_types"); // Список типов продуктов

	$content = renderTemplate('templates/createtype.php'); // Форма создвния типа

	$content = $content.renderTemplate('templates/typeslist.php', ['types'=>$types, 'products'=>$products]); // Контент страницы

	$layout_content = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php', ['title' => 'Список типов товаров', 'user_page'=>$user_page, 'content' => $content]); // Страница целиком

	print($layout_content); // Отображение
 ?>