<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';

	session_start();

	if(prev_check($_SESSION['user']) == 2 and 
	!empty($_POST) and 
	isset($_POST['product_name']) and 
	isset($_POST['product_price'])){ // Проверка полученных через POST запрос данных и проав пользователя
		// Подключение к БД
		$db_link;
		try {
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
		}

		// Изменение изображения
		$path;
		$absImgPath= safety_db_query($db_link, "SELECT path_to_img FROM products WHERE id=?", 'i', $_POST['product_id'])[0]['path_to_img']; // Путь к текущему изображению

		if( isset($_FILES) and !empty($_FILES['prod_image']['name']) ){ // Если было загружено новое изобраение
			$path=$_SERVER['DOCUMENT_ROOT'].'/resources/'; // Путь к рарке с ресурсами
			$path= $path.basename($_FILES['prod_image']['name']); // Путь к загруженному изображению
			$tempPath = $absImgPath; // Путь к текущему изображению
			$absImgPath='/resources/'.basename($_FILES['prod_image']['name']); // Будующий путь к изображению
			$imgcount = count(safety_db_query($db_link, "SELECT * FROM products WHERE path_to_img = ?", 's', $tempPath)); // Кол-во товаров с таким же изображением


			if(!move_uploaded_file($_FILES['prod_image']['tmp_name'], $path)) // Перемещение изображения в папку ресурсов
				header("Location: ".$_SERVER['HTTP_REFERER']."?status=failure"); 

			if(!stripos($imgpath, "placeholder.png") and $imgcount == 1) // Если изображение не placeholder и дишь один товар с этим изображением
				if( file_exists($_SERVER['DOCUMENT_ROOT'].$imgpath) )
					unlink($_SERVER['DOCUMENT_ROOT'].$imgpath); // Удаление изображения
		}
		mysqli_query($db_link, "UPDATE products SET name=\"".$_POST['product_name']."\", price=\"".$_POST['product_price']."\", description=\"".$_POST['product_description']."\", path_to_img=\"".$absImgPath."\" WHERE id=\"".$_POST['product_id']."\";"); // Изменение значений в таблице
	}
	header("Location: ".$_SERVER['HTTP_REFERER']."?status=success");
?>