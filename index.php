<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require 'scripts/render_template.php';
	require 'scripts/mysql_connect.php';
	require 'scripts/utils/get_user_page.php';
	
	$db_link = connectToDB();
	
	$user_page = getUserPage($db_link);

	$pords_count = 4; // Колличество выводимых продуктов
	$products = safety_db_query( $db_link, "SELECT * FROM products WHERE count > 0 ORDER BY rand() LIMIT ?", "i", $pords_count);

	$desc_header = str_replace( "\n", "<br>", implode ( file('resources/text/header.txt') ) );
	$desc_body = str_replace( "\n", "<br>", implode ( file('resources/text/mainpage.txt') ) );

	$page_content = renderTemplate('templates/mainpage.php', [
		'products' => $products, 'desc_header' => $desc_header, 'desc_body' => $desc_body 
	]);

	$layout_content = renderTemplate('templates/layout.php', ['title' => 'Petsburg', 'user_page'=>$user_page, 'content' => $page_content]);

	print($layout_content);
 ?>
