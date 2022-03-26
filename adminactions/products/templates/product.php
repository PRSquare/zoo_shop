<!-- Товар -->
<div class="product_d" <?= "id=\"product_".$product['id']."\"" ?> style="display: block;">
	<img class="product" src=<?= "\"".$product['path_to_img']."\"" ?>>
	<p class="prod_name"><?= $product['name'] ?></p>
	<p class="prod_cpunt"><?= $product['count'] ?> left</p>
	<p style="display: inline;" class="prod_price"><?= $product['price'] ?></p>
	<p style="display: inline;"> &#8381</p>
	<button <?= "onclick=\"showHideChangeForm(".$product['id'].");\"" ?>>Изменить</button>
	<button <?= "onclick=\"showHideCountChangeForm(".$product['id'].");\"" ?>>Пополнение</button>
	<form name="add_stock" method="GET" action="/adminactions/stocks/addstock.php">
		<input type="hidden" name="s_product_id" <?= "value=".$product['id'] ?>>
		<input type="submit" name="s_submit" value="Добавить акцию">
	</form>
</div>
<!-- Добавление кол-ва товара -->
<div class="count_change" style="display: none;" <?= "id=\"count_change_form_".$product['id']."\"" ?>>
	<form name="count_change" method="POST" action="actions/countchange.php">
		<input type="hidden" name="cc_product_id" <?= "value=".$product['id'] ?>>
		<input type="number" name="arrived_prod_count" placeholder="Колличество товара">
		<input type="submit" name="cc_submit" value="Подтвердить">
	</form>
</div>
<!-- Изменение товара -->
<div class="redact" <?= "id=\"changeform_".$product['id']."\"" ?> style="display: none;">
	<form  enctype="multipart/form-data" <?= "id=\"".$product['id']."\"" ?> <?= "name=\"".$product['id']."\"" ?> method="POST" action="actions/changeproduct.php">
		<input type="hidden" name="product_id" <?= "value=\"".$product['id']."\"" ?>>
		<label>Название товара: <input type="text" <?= "id=\"product_name".$product['id']."\"" ?> name="product_name" value=<?= "\"".$product['name']."\"" ?>></label><br>
		<label>Цена: <input type="number" step="0.01" <?= "id=\"product_price".$product['id']."\"" ?> name="product_price" value=<?= "\"".$product['price']."\"" ?>></label><br>
		<label>Описание: <textarea name="product_description"><?= $product['description'] ?></textarea></label><br>
		<label>Изображение: <input type="file" name="prod_image" accept=".png, .jpg, .jpeg, .gif, .webp"></label>
		<input type="button" name="send" <?= "onclick=\"checkAndSend(".$product['id'].");\"" ?> value="Обновить">
	</form>
	<form <?= "id=\"changeform_".$product['id']."\"" ?> method="POST" action="actions/deleteproduct.php">
		<input type="hidden" name="product_id" <?= "value=\"".$product['id']."\"" ?>>
		<input type="submit" id="deleteButton" <?= "onclick=\"deleteProdSend(".$product['id'].");\"" ?> style="color: red;" value="Удалить!">
	</form>
	<button <?= "onclick=\"showHideChangeForm(".$product['id'].");\"" ?>>Отменить</button>
</div>