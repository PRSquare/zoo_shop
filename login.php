<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require 'scripts/mysql_connect.php';
	require 'scripts/render_template.php';

	session_start(); // Запуск сессии
	if( isset($_SESSION['user']) ) // Если пользователь уже авторизирован - перенаправляем на главную
		header("Location: /index.php");

	// Обработка POST запроса
	if(!empty($_POST) and 
	$_POST['login'] != NULL and 
	$_POST['password'] != NULL ){
		$db_link = connectToDB(); // Получение БД
		$result = mysqli_query($db_link, "SELECT * FROM users WHERE name=\"" . $_POST['login'] . "\";"); // Спсок аккаунтов с тем же логином
		if( $result != false ){
			while( $row = mysqli_fetch_array($result) ) {
				if(password_verify($_POST['password'], $row['password'])){ // Сверка паролей
					$_SESSION["user"] = $row['id']; // Сохранение id пользователя
					header("Location: /index.php"); // Перенаправление на главную
				}
			}
			header("Location: /login.php?status=failure"); // Если пароли не совпадают
		}
		else{
			header("Location: /login.php?status=failure"); // Если не нашлось пользователя
		}
	}

	$user_page = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/inc/login_form.php');


	$content = "<div style='text-align: center;'><p>Чтобы зарегистрироваться или войти нажмите на значок <img src='/resources/icons/account.png' style='width: 2em;'> в правом верхнем углу экрана</p></div>";
	
	if(!empty($_GET['status'])){
		if($_GET['status'] == 'failure'){
			$content = "<b style='color: red;'>Не удалось зарегистрироваться или войти</b><br>".$content;
		}
	}
	
	$layout_content = renderTemplate('templates/layout.php', ['title' => 'Регистрация/Вход', 'user_page'=>$user_page, 'content' => $content]);
	
	print($layout_content);
?>