<style type="text/css">
	.price_from_to {
		width: 100%;
		display: flex;
	}
	.price_from_to input {
		width: 100%;
		margin: 0 5px;
	}

</style>

<script type="text/javascript">
	function changeElemDisplayStyle(elemId)
	{
		var el = document.getElementById(elemId);
		if(el.style.display == 'block')
			el.style.display = 'none';
		else
			el.style.display = 'block';
	}

</script>

<div class="search_product sidebar_elem">
	<div class="search_product__head sidebar_elem__head" onclick="changeElemDisplayStyle('SPD')">
		<span>Поиск товара</span>
	</div>
	<div class="search_product__details sidebar_elem__bod" id='SPD'>
		<form method="GET" action="catalog.php">
			<input type="text" name="prod_name" placeholder="Имя товара">
			<br>
			<?php 
				foreach ($types as $type) {
					print ("<input type='checkbox' name='prod_types[]' value='".$type['id']."'><span>".$type['product_type']."</span><br>");
				}
			?>
			<span>Цена:</span><br>
			<div class='price_from_to'>
				<input type="number" name="price_min" min='0' placeholder="От">
				<input type="number" name="price_max" min='0' placeholder="До">
			</div>
			<div class='submit_button'>
				<input class='submit_button' type="submit" name="" value="Найти товар">
			</div>
		</form>
	</div>
</div>