<link rel="stylesheet" href="templates/productlist.css">
<div id="productlist">
	<p>Найти товар:
	  <input id="search_prod" type="text" placeholder="Имя товара" oninput="searchProduct();">
	</p>
	<?php 
	foreach ($products as $product) {
		print( renderTemplate("templates/product.php", ['product'=>$product]) );
	}?>
</div>
<script src="templates/productlist.js">
	
</script>