<!-- Акция -->
<div style="border-bottom: 3px dotted;">
	<!-- Описание акции -->
	<p><?=$stock['description']?></p>
	<!-- Скидка -->
	<p><?=$stock['discount_size']?>%</p>
	<!-- Вреия окончания акции -->
	<p><?=$stock['stock_end_date']?></p>
	<!-- Форма удаления акции -->
	<form name="deleteStock" method="POST" action="actions/deletestock.php">
		<!-- Скрытое поле с id акции -->
		<input type="hidden" name="stock_id" <?="value='".$stock['id']."'"?>>
		<!-- Кнопка подтверждения -->
		<input type="submit" name="sub" value="Удалить" style="color: red;">
	</form>
</div>