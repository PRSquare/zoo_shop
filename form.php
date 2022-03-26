<?php 
	if(isset($_POST)){
		print("Имя: " . $_POST['name'] . '<br>');
		print("Email: " . $_POST['email'] . '<br>');
		print("Сообщение: " . $_POST['message'] . '<br>');
	}
?>
<html>
	<a href="index.php">HOME</a>
</html>