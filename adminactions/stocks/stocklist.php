<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require($_SERVER['DOCUMENT_ROOT'].'/scripts/render_template.php');
	require($_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php');
	require($_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php');
	require($_SERVER['DOCUMENT_ROOT'].'/scripts/utils/get_user_page.php');

	// Подключение к бд
	$db_link;
	try{
		$db_link = connectToDB();
	}
	catch( Exception $e )
	{
		echo "Exception: ", $e->getMessage(), "\n";
	} 
	
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

	if($answer != 2){ // Проверка привелегий администратора
		header("Location: /account.php");
	}

	$user_page = getUserPage($db_link); // страничка пользователя

	$stocks = safety_db_query($db_link, "SELECT * FROM stocks"); // Список акций

	$content = renderTemplate('templates/stocklist.php', ['stocks'=>$stocks]); // Страница со списком аеций

	$layout_content = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php', ['title' => 'Список акций', 'user_page'=>$user_page, 'content' => $content]); // Вся страница

	print($layout_content); // Отображение страницы
 ?>