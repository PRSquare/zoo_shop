<style type="text/css">
	
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

<div class='filters_product sidebar_elem'>
	<div class="filters_header sidebar_elem__head" onclick="changeElemDisplayStyle('FF')">
		<span>Сортировка</span>
	</div>
	<div class="filters_form sidebar_elem__bod" id="FF">
		<form method="GET" action='catalog.php'>
			<span>Сортировать по:</span>
			<br>
			<select name='filter'>
				<option value="f_name">Имени</option>
				<option value="f_price">Цене</option>
				<option value="f_fb_count">Колличеству отзывов</option>
				<option value="f_n_count">Колличеству товара</option>
			</select>
			<br>
			<select name="filter_dir">
				<option value="inc">По возрастанию</option>
				<option value="dec">По Убыванию</option>
			</select>
			<br>
			<div class='submit_button'>
				<input type="submit" name="" value="Сортировать">
			</div>

			<?php
				if(isset($_GET['prod_name'])) {
					print ("<input type='hidden' name='prod_name' value='".$_GET['prod_name']."'>");
				}
				if(isset($_GET['price_min'])) {
					print ("<input type='hidden' name='price_min' value='".$_GET['price_min']."'>");
				}
				if(isset($_GET['price_max'])) {
					print ("<input type='hidden' name='price_max' value='".$_GET['price_max']."'>");
				}
				if(isset($_GET['prod_types'])) {
					foreach ($_GET['prod_types'] as $p_type) {
						print("<input type='hidden' name='prod_types[]' value='".$p_type."'>");
					}
				}
			?>

		</form>
	</div>
</div>