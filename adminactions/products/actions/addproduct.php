<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	require $_SERVER['DOCUMENT_ROOT'].'/scripts/mysql_connect.php';
	require $_SERVER['DOCUMENT_ROOT'].'/scripts/prev_check.php';
	
	session_start(); // Запуск сессии

	if(prev_check($_SESSION['user']) == 2 and
	!empty($_POST) and 
	isset($_POST['prod_name']) and 
	isset($_POST['count']) and 
	isset($_POST['price'])){ //  Проверка прав и полученных через POST запрос данных
		// Подключение БД
		$db_link;
		try {
			$db_link = connectToDB();
		} catch( Exception $e ) {
			echo "Exception: ", $e->getMessage(), "\n";
		}

		$path;
		$absImgPath='/resources/placeholder.png'; // Путь к изображению по умолчанию

		if(!empty($_FILES['prod_image']['name'])){ // Если было загружено изображение
			$path=$_SERVER['DOCUMENT_ROOT'].'/resources/'; // Путь к папке хранения ресурсов
			$path= $path.basename($_FILES['prod_image']['name']); // Путь к временному изображению
			$absImgPath='/resources/'.basename($_FILES['prod_image']['name']); // Путь к будующему расположению изображения

			if(!move_uploaded_file($_FILES['prod_image']['tmp_name'], $path)) // Перемещение файла изображения
				header("Location: /adminactions/products/addproduct.php?status=failure"); 
		}
		safety_db_query($db_link, "INSERT INTO products (name, count, price, description, path_to_img) VALUES (?, ?, ?, ?, ?)", 'siiss', $_POST['prod_name'], $_POST['count'], $_POST['price'], $_POST['description'], $absImgPath); // Внесение товара в БД
	}
	header("Location: /adminactions/products/addproduct.php?status=success"); // Переход на страницу добавления товара
?>