<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/render_template.php';
	require($_SERVER['DOCUMENT_ROOT'].'/scripts/utils/get_user_page.php');
	require($_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php');

	if(!empty($_POST)){
		// подключение к бд
		$db_link;
		try {
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
		}

		session_start();

		$answer;
		
		try {
			$answer = prev_check($_SESSION['user']);
		} catch (Exception $e) {
			print($e->getMessage());
		}

		if($answer != 2){ // Проверка превелегий пользователя
			header("Location: /account.php");
		}

		$products = safety_db_query($db_link, "SELECT * FROM products WHERE id IN (SELECT product_id FROM products_by_types WHERE type_id = ?)", 'i', $_POST['type_id']); // Список продуктов

		$user_page = getUserPage($db_link); // Страница пользователя

		$content = renderTemplate('templates/deletefromtype.php', ['products'=>$products, 'typeid'=>$_POST['type_id']]);

		$layout_content = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php', ['title' => 'Удаление товаров из типа', 'user_page'=>$user_page, 'content' => $content]);

		print($layout_content);
	}
?>