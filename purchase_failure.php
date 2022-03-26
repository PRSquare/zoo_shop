<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require 'scripts/render_template.php';
	require 'scripts/mysql_connect.php';
	require 'scripts/utils/get_user_page.php';
	
	$db_link = connectToDB();
	
	$user_page = getUserPage($db_link);

	$page_content = renderTemplate('templates/purchase_failure.php');

	$layout_content = renderTemplate('templates/layout.php', ['title' => 'Petsburg', 'user_page'=>$user_page, 'content' => $page_content]);

	print($layout_content);
 ?>
