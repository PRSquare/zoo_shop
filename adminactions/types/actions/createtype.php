<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';
	
	session_start();

	if(prev_check($_SESSION['user']) == 2 and
	!empty($_POST) and 
	isset($_POST['type_name_f'])) { // Проверка POST запроса и прав пользователя
		// Подключение к бд
		$db_link;
		try {
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
			header("Location: /adminactions/types/typeslist.php?status=failure"); // Возврат на предыдущую страницу
		}
		// Добавление товара
		$sdq =safety_db_query($db_link, "INSERT INTO product_types SET product_type = ?", 's', $_POST['type_name_f']);
		if( !$sdq )
			header("Location: /adminactions/types/typeslist.php?status=failure"); // Возврат на предыдущую страницу
	}

	//header("Location: /adminactions/types/typeslist.php?status=success"); // Возврат на предыдущую страницу
?>