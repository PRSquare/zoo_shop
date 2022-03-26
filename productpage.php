<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	
	require 'scripts/render_template.php';
	require 'scripts/mysql_connect.php';
	require 'scripts/prev_check.php';
	require 'scripts/utils/get_stock_list.php';
	require 'scripts/utils/get_user_page.php';

	$db_link = connectToDB(); // Получение БД

	$sql_comments_by_prod_id = "SELECT * FROM comments WHERE product_id = ?";
	$sql_name_by_id = "SELECT name FROM users WHERE id = ?";
	$sql_product_by_id = "SELECT * FROM products WHERE id = ?";

	$user_page = getUserPage($db_link);

	$prodid = (int)($_GET['id'] ?? 1);


	$product = safety_db_query($db_link, $sql_product_by_id, 'i', $prodid)[0]; // Получение информации о продукте

	$comments = safety_db_query($db_link, $sql_comments_by_prod_id, 'i', $prodid); // Комментарии к продукту
	$names = []; // Имена авторов комментариев
	foreach ($comments as $comment) {
		$username = safety_db_query( $db_link, $sql_name_by_id, 'i', $comment['user_id'] );
		$names[$comment['user_id']] = $username[0]['name'];
	}

	$delete_comment=false; // Доступна ли фунция удаления комментариев (Доступна только для админа см. ниже)

	$stock = 0; // Акция

	if( isset($_SESSION['user']) ){
		$leave_a_comm = renderTemplate('templates/sub/leaveacommentform.php', ['prod_id'=>$prodid]); // Форма оставить комментарий
		if( prev_check($_SESSION['user']) == 2 )
			$delete_comment = true; // Если админ - разрешаем удалять комментарии

		$stock_list = get_stock_list($_SESSION['user'], $db_link); 
		foreach($stock_list as $st){
			if((int)$st['product_id'] == $product['id']){
				$stock = $st['discount_size']; // Получение акции на товар
			}
		}
	} else {
		$leave_a_comm = renderTemplate('templates/sub/signinplease.php'); // Если пользователь не авторизирован - просим авторизироваться, чтобы оставлять комментарии
	}

	$page_content = renderTemplate('templates/productpage.php', ['product'=>$product, 'comments'=>$comments, 'names'=>$names, 'leave_a_comment_form'=>$leave_a_comm, 'delete_comment'=>$delete_comment, 'stock'=>$stock]);

	$layout_content = renderTemplate('templates/layout.php', ['title' => $product['name'], 'user_page'=>$user_page, 'content' => $page_content]);

	print($layout_content);
	

	mysqli_close($db_link);
 ?>
