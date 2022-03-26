<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require 'scripts/render_template.php';
	require 'scripts/mysql_connect.php';
	require 'scripts/utils/get_stock_list.php';
	require 'scripts/utils/get_user_page.php';

	$db_link = connectToDB();
	
	$user_page = getUserPage($db_link);

	$curdate = date('Y-m-d');

	if(!isset($_SESSION)) {
		session_start();
	}
	
	if ( !isset($_SESSION['basket']) ) {
		header("Location: /basket.php");
		exit();
	}

	// Сохранение данных о колличестве покупок

	foreach ($_SESSION['basket'] as &$item) {
		$all_prods = explode(',', $_POST["all_prods"]);
		$elem_count = count($all_prods);
		for( $i = 0; $i < $elem_count; $i+=2 ) {
			if( $all_prods[$i] == $item['prod_id'] ) {
				$item['count'] = (int)$all_prods[$i+1];
			}
		}
	}

	$fin_price = $_POST['fin_price'];

	$page_content = renderTemplate('templates/checkout.php', ['curdate' => $curdate, 'fin_price' => $fin_price]);

	$layout_content = renderTemplate('templates/layout.php', ['title' => 'Petsburg', 'user_page'=>$user_page, 'content' => $page_content]);

	print($layout_content);

?>