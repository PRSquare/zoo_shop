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

		// Удаление товаров из типа
		foreach ($_POST['products'] as $product) {
			safety_db_query($db_link, "DELETE FROM products_by_types WHERE product_id = ? AND type_id = ?", 'ii', $product, $_POST['type_id']);
		}
		
	}
	header("Location: /adminactions/types/typeslist.php?status=success"); // Возврат на предыдущую страницу
?>

