<?php
	//
	// НЕ ИСПОЛЬЗУЕТСЯ!
	//

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/render_template.php';

	session_start();
	if(!isset($_SESSION['user']))
		header("Location: /login.php");

	$answer;

	try {
		$answer = prev_check($_SESSION['user']);
	} catch (Exception $e) {
		print($e->getMessage());
	}

	if($answer == 2){ // Проверка превелегий пользователя
		print('OK!');
	} else {
		header("Location: /account.php");
	}

	$add_form = renderTemplate('templates/createtype.php');

	$content = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php', ['title'=>'Создание типа товаров', 'content'=>$add_form]);

	$success = $_GET['status'] ?? '';
	if($success == "success"){
		print("<p style=\"color: green;\">Запись добавлена!</p>");
	}
	if($success == "failure"){
		print("<p style=\"color: red;\">Запись не добавлена!</p>");
	}

	print($content);
?>