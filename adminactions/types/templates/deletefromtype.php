<!-- Удаление товаров из типа -->
<div>
	<form name="deletefromtype" method="POST" action="actions/deletefromtype.php">
		<input type="hidden" name="type_id" <?= "value=\"".$typeid."\"" ?>>
		<select size=10 multiple name="products[]">
			<option disabled>Выберите товары, который будут удалены</option>
			<?php 
				foreach ($products as $product) {
					print("<option value=".$product['id'].">".$product['name']."</option>");
				}
			?>
		</select>
		<input type="submit" name="send" value="Удалить" style="color: red">
	</form>
	<a href="typeslist.php">Отмена</a>
</div>