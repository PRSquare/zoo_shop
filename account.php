<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require 'scripts/render_template.php';
	require 'scripts/mysql_connect.php';
	require 'scripts/prev_check.php';
	require 'scripts/utils/get_stock_list.php';
	require 'scripts/utils/get_user_page.php';

	// Подключение базы данных
	$db_link = connectToDB();

	// Получение аккаунта пользователя
	$user_page = getUserPage($db_link);

	// id пользователя
	$user = $_SESSION['user'] ?? null;;
	
	// Если ползователь не авторизирован - перенаправляем на страницу входа/регистрации
	if($user == null)
		header("Location: /login.php");

	// Получение имени пользователя
	$username = '';
	$username = safety_db_query($db_link, "SELECT name FROM users WHERE id=?", 'i', $user)[0]['name'];

	// Получение спмска акций доступных пользователю
	$stock_list = get_stock_list($_SESSION['user'], $db_link);

	// Страница аккаунта
	$page_content = renderTemplate('templates/account.php', ['name'=>$username, 'stocks'=>$stock_list]);
	
	// Если админ - показываем страничку администрации
	if( prev_check($user) == 2 )
		$page_content = $page_content."<hr>".renderTemplate('templates/adminaccount.php');
		
	// Страница целиком
	$layout_content = renderTemplate('templates/layout.php', ['title' => 'Страница пользователя '.$username, 'user_page'=>$user_page, 'content' => $page_content]);

	// Отображение страницы
	print($layout_content);
 ?>
