<?php
	// Регистрация

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	
	if(!empty($_POST) and 
	$_POST['sulogin'] != NULL and 
	$_POST['supassword'] != NULL and
	$_POST['email'] != NULL ){
		// Подключение БД
		$db_link;
		try{
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
		}
			
		$resultname = safety_db_query($db_link, "SELECT * FROM users WHERE name=?", 's', $_POST['sulogin']); // Имя
		$resultemail = safety_db_query($db_link, "SELECT * FROM users WHERE email=?",'s', $_POST['email']); // email
		if( $resultname != false or $resultemail != false ){
			// Если пользователь существует возвращаем на страницу регистрации
			header("Location: /login.php?status=failure");
		}
		else{
			safety_db_query($db_link, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)", 'sss', $_POST['sulogin'], $_POST['email'], password_hash($_POST['supassword'], PASSWORD_DEFAULT) );
			// Вносим пользователя в БД
			if (session_status() == PHP_SESSION_NONE) {
				session_start(); // Запуск сессии
			}

			$_SESSION['user'] = safety_db_query($db_link, "SELECT id FROM users WHERE name=?",'s', $_POST['sulogin'])[0]['id']; // Устанавливаем пользователя
		}
	}
	header("Location: /index.php"); // Перенаправление на главную
?>