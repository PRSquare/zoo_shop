<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	
	session_start();

	if(!empty($_GET) and 
	isset($_GET['prodId'])) {

		$is_in_basket = false;
		// Проходим по списку товаров. Если есть, то увеличиваем кол-во
		foreach ($_SESSION['basket'] as &$bas) {
			if($bas['prod_id'] == $_GET['prodId']){
				$bas['count']++;
				$is_in_basket = true;
				break;
			}
		}
		if(!$is_in_basket){ // Если товара нет в корзине, то добавляем
			$_SESSION['basket'][] = [
					'prod_id' => (int)$_GET['prodId'],
					'count' => 1
				];
		}

		header("Location: ".$_SERVER['HTTP_REFERER']."?status=success"); // Перенаправление на предыдущюю страницу
	} else {
		header("Location: ".$_SERVER['HTTP_REFERER']."?status=failure");
	}
?>