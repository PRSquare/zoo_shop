<form enctype="multipart/form-data" name="product_creation" method="POST" action="actions/addproduct.php"><br>
	<label>Название товара: <input type="text" name="prod_name"></label><br>
	<label>Цена: <input type="number" step="0.01" name="price"></label><br>
	<label>Описание: <textarea name="description"></textarea></label><br>
	<label>Колличество: <input type="number" name="count"></label><br><br>
	<label>Изображение: <input type="file" name="prod_image" accept=".png, .jpg, .jpeg, .gif, .webp"></label>
	<input type="button" name="send" onclick="checkAndSend();" value="Добавить">
</form>
<script src="templates/addproduct.js"></script>