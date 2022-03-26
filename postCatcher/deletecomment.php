<?php
	// Удаление комментария

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';

	session_start();
	if(!empty($_POST['del_comment_id']) and isset($_SESSION['user']) and 
		prev_check($_SESSION['user']) == 2){ // Если админ
		// Подключение к бд
		$db_link;
		try{
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
		}

		$sql = "DELETE FROM comments WHERE id = ?"; // Запрос
		
		
		safety_db_query($db_link, $sql, 'i', (int)$_POST['del_comment_id']); // Удаление комментария из БД
	}
	header("Location: ".$_SERVER['HTTP_REFERER']); // Перенаправление на предыдущюю страницу
?>