<!-- Тип -->
<div class="type" <?= "id=\"type_".$type['id']."\"" ?> style="display: block;">
	<!-- Имя типа -->
	<p class="type" id="name"><?= $type['product_type'] ?></p>
	<!-- Кнопка изменения типа -->
	<button <?= "onclick=\"showHideChangeForm(".$type['id'].");\"" ?>>Изменить</button>
	<!-- Кнопка удаления из типа -->
	<form method="POST" action="deletefromtype.php">
		<!-- Скрытое поле id продукта -->
		<input type="hidden" name="type_id" <?= "value=\"".$type['id']."\"" ?>>
		<input type="submit" name="sub" value="Удалить товары из типа" style="color: #700">
	</form>
</div>
<!-- Формы редактирования -->
<div class="redact" <?= "id=\"changeform_".$type['id']."\"" ?> style="display: none;">
	<!-- Изменение типа -->
	<form  <?= "id=\"".$type['id']."\"" ?> <?= "name=\"".$type['id']."\"" ?> method="POST" action="actions/changetype.php">
		<input type="hidden" name="type_id" <?= "value=\"".$type['id']."\"" ?>>
		<label>Название типа: <input type="text" <?= "id=\"type_name".$type['id']."\"" ?> name="type_name" value=<?= "\"".$type['product_type']."\"" ?>></label><br>
		<select size=10 multiple name="products[]">
			<option disabled>Выберите товары</option>
			<?php 
				foreach ($products as $product) {
					print("<option value=".$product['id'].">".$product['name']."</option>");
				}
			?>
		</select>
		<input type="button" name="send" <?= "onclick=\"checkAndSend(".$type['id'].");\"" ?> value="Обновить">
	</form>
	<!-- Удаление типа -->
	<form <?= "id=\"changeform_".$type['id']."\"" ?> method="POST" action="actions/deletetype.php">
		<input type="hidden" name="type_id" <?= "value=\"".$type['id']."\"" ?>>
		<input type="submit" id="deleteButton" <?= "onclick=\"deleteProdSend(".$type['id'].");\"" ?> style="color: red;" value="Удалить!">
	</form>
	<button <?= "onclick=\"showHideChangeForm(".$type['id'].");\"" ?>>Отменить</button>
</div>
<hr>