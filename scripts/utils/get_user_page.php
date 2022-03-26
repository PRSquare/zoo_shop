<?php 
	// Получение страницы пользователя
	function getUserPage($db_link){
		// Если сессия не запушена, то запускаем
		if(session_status() != PHP_SESSION_ACTIVE)
			session_start();
		
		$user_page = 0; // Страница пользователя
		if( isset($_SESSION['user']) ){ // Если пользователь авторизирован
			$username = safety_db_query($db_link, "SELECT name FROM users WHERE id=?", 'i', $_SESSION['user'])[0]['name'];
			$user_page = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/inc/user_account.php', ['username' => $username] );
		} else {
			$user_page = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/inc/login_form.php');
		}

		return $user_page;
	}

	// Получение имени пользователя
	function getUserName($db_link){
		// Если сессия не запушена, то запускаем
		if(session_status() != PHP_SESSION_ACTIVE)
			session_start();

		// Если пользователь авторизирован, то получаем имя
		if( isset($_SESSION['user']) )
			$username = safety_db_query($db_link, "SELECT name FROM users WHERE id=?", 'i', $_SESSION['user'])[0]['name'];
		else
			$username = null;
		return $username;
	}
?>