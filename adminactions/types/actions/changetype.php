<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';

	if(!empty($_POST)){
		// Подключение к БД
		$db_link;
		try {
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
		}

		foreach ($_POST['products'] as $product) {
			 if(!safety_db_query($db_link, "SELECT * FROM products_by_types WHERE type_id = ? AND product_id = ?", 'ii', $_POST['type_id'], $product )) // Если записи не существует
				safety_db_query($db_link, "INSERT INTO products_by_types (type_id, product_id) VALUES (?, ?)", 'ii', $_POST['type_id'], $product ); // Добавляем
		}
		
	}
	header("Location: /adminactions/types/typeslist.php?status=success"); // Возврат на предыдущую страницу
?>

