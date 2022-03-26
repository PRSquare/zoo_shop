<?php 
	// Покупка

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	
	session_start();

	if(!empty($_POST)) {
		// Подключение БД
		$db_link;
		try {
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
			header("Location: ".$_SERVER['HTTP_REFERER']."?status=failure");
		}


		$name = $_POST['name'];
		$sername = $_POST['sername'];
		$patr = isset($_POST['patr']) ? $_POST['patr'] : NULL;
		$phone_number = $_POST['phone_number'];
		$email = isset($_POST['email']) ? $_POST['email'] : NULL;
		$address = $_POST['address'];
		$date = $_POST['date'];

		if( !isset($_SESSION) ) {
			session_start();
		}
		if( !isset($_SESSION['basket']) ) {
			header("Location: /basket.php");
		}
		
		$all_prods = $_SESSION['basket'];
		$prods_id_and_count = "";
		$fin_price = 0;

		foreach ($all_prods as $prod) {
			$discount = safety_db_query( $db_link, "SELECT discount_size FROM stocks WHERE product_id = ? AND stock_end_date <= NOW()", "i", $prod['prod_id'] );
			if( !empty($discount) ) {
				$discount = $discount[0]['discount_size'];
			} else {
				$discount = 0;
			}
			$price = safety_db_query( $db_link, "SELECT price FROM products WHERE id = ?", "i", $prod['prod_id'] )[0]['price'];
			$price *= $prod['count'];
			$price *= 1-($discount/100);

			$fin_price += $price;

			$prods_id_and_count .= $prod['prod_id'].", ".$prod['count'].", ";
		}

		safety_db_query( $db_link, "INSERT INTO orders VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)", "sssssssss", 
			$sername, $name, $patr,
			$phone_number, $email, $address,
			$date, $fin_price, $prods_id_and_count );

		// Вычитание кол-ва купленого
		foreach ($all_prods as $prod) { 
			safety_db_query( $db_link, "UPDATE products SET count = count - ? WHERE id = ?", "ii", $prod['count'], $prod['prod_id'] );
		}

		$_SESSION['basket'] = []; // Очищаем корзину
		header("Location: /purchase_success.php"); // Перенаправление на предыдущюю страницу
	} else {
		header("Location: /purchase_failure.php");
	}
?>