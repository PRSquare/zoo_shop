<style type="text/css">
	.order {
		background: white;
	}
	.ord_info {
		width: 50%;
		text-align: center;
		padding-bottom: 20px;
		margin: 0 auto;
		display: grid;
		grid-template-columns: 30% 50%;
	}
	.prods table {
		text-align: center;
		padding: 5px;
	}
</style>
<div class='order'>
	<div class="ord_info">
		<span>Фио: </span>
		<div>
			<span><?=$sername?></span>
			<span><?=$name?></span>
			<span><?=$patr?></span>
		</div>
		<span>Телефон: </span>
		<span><?=$phone?></span>
		<span>Email</span>
		<span><?=$email?></span>
		<span>Адрес: </span>
		<span><?=$address?></span>
		<span>Итоговая сумма: </span>
		<span><?=$price?> &#8381</span>
		<span>Список товаров: </span>
	</div>
	<div class="prods">
		<?=$prods?>
	</div>
</div>
<hr>