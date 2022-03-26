<!-- Форма добавления акции -->
<form name="stock_creation" method="POST" action="actions/addstock.php"><br>
	<label>Описание: <textarea name="description"></textarea></label><br>
	<label>Скидка %: <input type="number" name="discount_size"></label><br>
	<label>Время окончания акции: <input type="datetime-local" name="end_time"></label><br>
	<!-- Скрытое поле с id товара -->
	<input type="hidden" name="prod_id" <?= "value=".$product_id ?>>
	
	<select size=10 multiple name="user[]">
		<option disabled>Выберите пользователей</option>
		<option value="all_users">Выбрать всех</option>
		<?php 
			foreach ($users as $user) {
				print("<option value=".$user['id'].">".$user['name']."</option>");
			}
		?>
	</select>
	<input type="button" name="send" onclick="checkAndSend();" value="Добавить">
</form>
<script src="templates/addstock.js"></script>