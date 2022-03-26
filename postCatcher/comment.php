<?php
	// Комментарий

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	session_start();
	if(!empty($_POST) and isset($_SESSION['user'])){
		// Подключение БД
		$db_link;
		try{
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
		}
		$user = $_SESSION['user']; // Id пользователя
		$pid = $_POST['prod_id']; // Id продукта
		$comment = $_POST['comment']; // Комментарий

		$sql = "INSERT INTO comments (user_id, product_id, comment) VALUES (?, ?, ?)";
		safety_db_query($db_link, $sql, 'iis', $user, $pid, $comment); // Записываем комментарий в БД
	}
	header("Location: ".$_SERVER['HTTP_REFERER']); // Перенаправление на предыдущюю страницу
?>