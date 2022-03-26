<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require 'scripts/render_template.php';
	require 'scripts/mysql_connect.php';
	require 'scripts/utils/get_stock_list.php';
	require 'scripts/utils/get_user_page.php';	

	$db_link = connectToDB(); // Получение БД

	
	$user_page = getUserPage($db_link); // Получение страничкипользователя
	$user = $_SESSION['user'] ?? null; // Id пользователя
	
	$products = []; // Список продуктов
	$stocks = []; // Список акций
	$form_basket = []; // Форматированый список продуктов в корзине
	$page_content = []; // Контент страницы

	if(!empty($_SESSION['basket'])){ // Если корзина не пуста
		$prod_ids = []; // Id продуктов
		foreach($_SESSION['basket'] as $sb){
			$prod_ids[] = $sb['prod_id']; // Получение id всех продуктов из корзины
		}
		$str = getStringsFromArray($prod_ids); // см. getStringsFromArray в scripts/utils/get_stock_list.php
		$products = safety_db_query($db_link, "SELECT * FROM products WHERE id IN (".$str['qm'].")", $str['i'], ...$prod_ids); // Получение списка продуктов

		$stock_list = get_stock_list($user, $db_link); // Получение списка акций
		
		foreach($stock_list as $st){
			$stocks[$st['product_id']] = $st['discount_size']; // Спиок процента скидки
		}

		$prod_counts = []; // Список кол-ва продуктов в корзине
		foreach($products as $prod){
			$prod_counts[$prod['id']] = $prod['count'];
		}

		$form_basket = []; // Форматированая корзина
		foreach($_SESSION['basket'] as $bs){
			$form_basket[$bs['prod_id']] = $bs['count'];
		}

		$page_content = renderTemplate('templates/basket.php', ['products'=>$products, 'stocks'=>$stocks, 'count'=>$form_basket, 'prod_counts'=>$prod_counts]); // Контент страницы

	} else {
		// Если корзина пуста
		$page_content = "<b>Корзина пуста!</b>";
	}

	// Рендер всей страницы
	$layout_content = renderTemplate('templates/layout.php', ['title' => 'Корзина', 'user_page'=>$user_page, 'content' => $page_content]);

	print($layout_content); // Отображение
?>