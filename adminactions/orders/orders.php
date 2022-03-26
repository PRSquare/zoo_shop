<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require ($_SERVER['DOCUMENT_ROOT'].'/scripts/render_template.php');
	require ($_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php');
	require ($_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php');
	require ($_SERVER['DOCUMENT_ROOT'].'/scripts/utils/get_user_page.php');

	// Подключение к БД
	$db_link;
	try{
		$db_link = connectToDB();
	}
	catch( Exception $e )
	{
		echo "Exception: ", $e->getMessage(), "\n";
	} 
	
	session_start(); // Запуск сессии
	if(!isset($_SESSION['user']))
		header("Location: /login.php");

	$answer;

	try {
		$answer = prev_check($_SESSION['user']);
	} catch (Exception $e) {
		print($e->getMessage());
	}

	if($answer != 2){ // Проверка привелегий (администратор)
		header("Location: /account.php");
	}

	$user_page = getUserPage($db_link); // Страница пользователя
	
	$ord_list = safety_db_query( $db_link, "SELECT * FROM orders" );
	$content = "";

	foreach ($ord_list as $ord) {
		$prods = explode(",", $ord['shopping_list']);
		array_pop($prods);
		$prods_temp = "<table border=1><th>Название товара</th><th>Колличество</th>";
		for( $i = 0; $i < count($prods); $i+=2 ) {
			$prods_temp .= "<tr>";
			$prod_name = safety_db_query( $db_link, "SELECT name FROM products WHERE id=?", "i", $prods[$i] )[0]['name'];
			$count = $prods[$i+1];

			$prods_temp .= "<td>".$prod_name."</td>";
			$prods_temp .= "<td>".$count."</td>";

			$prods_temp .= "</tr>";
		}
		$prods_temp .= "</table>";
		$c = renderTemplate('templates/order.php', [
			'sername' => $ord['sername'],
			'name' => $ord['name'],
			'patr' => $ord['patr'],
			'phone' => $ord['phone'],
			'email' => $ord['email'],
			'address' => $ord['address'],
			'date' => $ord['date'],
			'price' => $ord['price'],
			'prods' => $prods_temp
		]);	
		$content .= $c;
	}

	$layout_content = renderTemplate($_SERVER['DOCUMENT_ROOT'].'/templates/layout.php', ['title' => 'Список товаров', 'user_page'=>$user_page, 'content' => $content]);

	print($layout_content); // Отображение страницы
 ?>