<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/render_template.php';
	require ($_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php');
	require ($_SERVER['DOCUMENT_ROOT'].'/scripts/utils/get_user_page.php');

	$db_link = connectToDB();

	session_start(); // Запуск сессии
	if(!isset($_SESSION['user']))
		header("Location: /login.php"); // Страница регистрации, если пользователь не авторизирован

	$answer;

	try {
		$answer = prev_check($_SESSION['user']); 
	} catch (Exception $e) {
		print($e->getMessage());
	}

	if($answer == 2){ // Проверка прав (админ)
		print('OK!');
	} else {
		header("Location: /account.php");
	}

	$userpage = getUserPage($db_link);

	$add_form = renderTemplate('templates/addproduct.php'); // Рендер формы создания товара

	$content = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php', ['title'=>'Добавление товара', 'content'=>$add_form, 'user_page'=>$userpage]); // Рендер страницы

	$success = $_GET['status'] ?? ''; // Проверка успеха предыдущего запроса
	if($success == "success"){
		print("<p style=\"color: green;\">Запись добавлена!</p>");
	}
	if($success == "failure"){
		print("<p style=\"color: red;\">Запись не добавлена!</p>");
	}

	print($content); // Отображение страницы
?>