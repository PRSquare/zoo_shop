<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require 'scripts/render_template.php';
	require 'scripts/mysql_connect.php';
	require 'scripts/utils/get_stock_list.php';
	require 'scripts/utils/get_user_page.php';

	// Подключение к БД
	$db_link;
	$db_link = connectToDB();

	$sql_params = '';
	$sql_params_chars = '';
	$params = [];
	
	$cur_href = 'catalog.php?';

	// ------------------ SEARCH ------------------

	if( isset($_GET['prod_name']) && !$_GET['prod_name'] == '' ){
		$sql_params .= ' AND ';
		$sql_params .= 'name LIKE ?';
		$sql_params_chars .= 's';
		array_push($params, '%'.$_GET['prod_name'].'%');

		$cur_href .= '&prod_name='.$_GET['prod_name'];

	}

	if( isset($_GET['prod_types']) && !$_GET['prod_types'] == '' ){
		$types = $_GET['prod_types'];
		$query_str = getStringsFromArray($types);
		$available_products = safety_db_query($db_link, "SELECT product_id FROM products_by_types WHERE type_id IN (".$query_str['qm'].")", 
			$query_str['i'], 
			...$types
		);

		$query_str = getStringsFromArray($available_products);
		$sql_params .= ' AND ';
		$sql_params .= 'id IN ('.$query_str['qm'].')';
		for( $i = 0; $i < count($available_products); ++$i ) {
			$sql_params_chars .= 's';
			array_push($params, $available_products[$i]['product_id']);
		}

		foreach( $types as $type ) {
			$cur_href .= '&prod_types[]='.$type;
		}
	}

	if( isset($_GET['price_min']) && !$_GET['price_min'] == '' ) {
		$sql_params .= ' AND ';
		$sql_params .= 'price > ?';
		$sql_params_chars .= 'i';
		array_push($params, $_GET['price_min']);

		$cur_href .= '&price_min='.$_GET['price_min'];
	}

	if( isset($_GET['price_max']) && !$_GET['price_max'] == '' ) {
		$sql_params .= ' AND ';
		$sql_params .= 'price < ?';
		$sql_params_chars .= 'i';
		array_push($params, $_GET['price_max']);

		$cur_href .= '&price_max='.$_GET['price_max'];
	}

	// ------------------ END SEARCH ------------------

	// ------------------ SORT ------------------
	$ord_by = '';
	if( isset($_GET['filter']) && !$_GET['filter'] == '' ) {
		
		$cur_href .= '&filter='.$_GET['filter'];
		
		switch ($_GET['filter']) {
			case 'f_name':
				$ord_by = ' ORDER BY name';
				break;
			case 'f_price':
				$ord_by = ' ORDER BY price';
				break;
			case 'f_fb_count':
				$ord_by = ' ORDER BY ( SELECT COUNT(*) FROM comments WHERE product_id = products.id )';
				break;
			case 'f_n_count':
				$ord_by = ' ORDER BY count';
				break;
			
			default:
				break;
		}
	}

	if( isset($_GET['filter_dir']) && !$_GET['filter_dir'] == '' ) {
		
		$cur_href .= '&filter_dir='.$_GET['filter_dir'];
		
		if ($_GET['filter_dir'] == 'inc') {

			$ord_by .= ' ASC';
		} else {
			$ord_by .= ' DESC';
		}
	}

	// ------------------ END SORT ------------------
	
	// ------------------ PAGE ------------------ 

	$page_number = 0;
	if( isset($_GET['page']) && !$_GET['page'] == '' ) {
		$page_number = $_GET['page'];
	}

	$prods_on_page = 16;
	$limit = ' LIMIT '.$page_number*$prods_on_page.','.$prods_on_page;

	// ------------------ END PAGE ------------------ 

	// Список продуктов
	$products = safety_db_query($db_link, "SELECT * FROM products WHERE count > 0".$sql_params.$ord_by.$limit, $sql_params_chars, ...$params); 

	$page_count = safety_db_query( $db_link, "SELECT COUNT(*) FROM products WHERE count > 0".$sql_params.$ord_by, $sql_params_chars, ...$params);
	if ( $page_count[0]['COUNT(*)'] % $prods_on_page == 0 ) {
		$page_count = $page_count[0]['COUNT(*)'] / $prods_on_page;
	} else {
		$page_count = (int)($page_count[0]['COUNT(*)'] / $prods_on_page) + 1;
	}

	$pages = '';
	$pages .= "<span style='text-align: center;'>Текущая страница ".($page_number + 1)."</span><br>";
	
	$pages .= "<style>.nav_hrefs a {margin: 0 3px; color: #dfddb7;}</style><div class='nav_hrefs' style='margin: 0 auto; padding: 0 20px; background: #334e2fcc;'>";

	if( $page_count > 7 ) {		

		$mid = (int)($page_count / 2);

		$pages .= "<a href='".$cur_href."&page=0'><<</a> ";
		if( $page_number > 0 ) {
			$pages .= "<a href='".$cur_href."&page=".($page_number - 1)."'><Назад</a> ";
		}

		$pages .= "<a href='".$cur_href."&page=0'>1</a> ";
		$pages .= "<a href='".$cur_href."&page=1'>2</a> ";

		$pages .= "<span>...</span> ";

		$pages .= "<a href='".$cur_href."&page=".$mid."'>".($mid+1)."</a> ";
		
		$pages .= "<span>...</span> ";

		$pages .= "<a href='".$cur_href."&page=".($page_count-2)."'>".($page_count-1)."</a> ";
		$pages .= "<a href='".$cur_href."&page=".($page_count-1)."'>".$page_count."</a> ";

		if( $page_number < $page_count-1 ) {
			$pages .= "<a href='".$cur_href."&page=".($page_number + 1)."'>Вперёд></a> ";
		}
		$pages .= "<a href='".$cur_href."&page=".($page_count-1)."'>>></a> ";

	} else {
		for( $i = 0; $i < $page_count; ++$i ){
			$pages .= "<a href='".$cur_href."&page=".$i."'>".(1 + $i)."</a> ";
		}
	}
	$pages .= "</div>";
	
	$stocks = []; // Список акций

	$user_page = getUserPage($db_link); // Аккаунт пользователя

	if( isset($_SESSION['user']) ){ // Если пользователь авторизирован
		$stock_list = get_stock_list($_SESSION['user'], $db_link); // Получение списка акций

		// Форматирование списка акций
		foreach($stock_list as $st)
			$stocks[$st['product_id']] = $st['discount_size'];
	}

	$types = safety_db_query($db_link, "SELECT * FROM product_types"); // Доступные типы товаров

	$sort = renderTemplate('templates/sub/sort.php', ['types' => $types]);

	$page_content = renderTemplate('templates/catalog.php', ['products'=> $products, 'stocks'=>$stocks, 'types'=>$types, 'sort' => $sort, 'pages' => $pages] ); // Рендер страницы каталога
 
	$layout_content = renderTemplate('templates/layout.php', ['title' => 'Каталог товаров', 'user_page'=>$user_page, 'content' => $page_content]); // Рендер всей страницы

	print($layout_content); // Отображение страницы
?>