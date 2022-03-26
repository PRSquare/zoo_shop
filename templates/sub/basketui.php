<!-- Изменение кол-ва товара в корзине -->
<div class='count'>
	<!-- Кол-во товара сейчас -->
	<?="<p id='count_".$id."' class='count_val' style='display: inline;'>".$count[$id]."</p>"?>
	<button <?="onclick='increaceCount(".$id.");'"?>>+</button>
	<button <?="onclick='decreaceCount(".$id.");'"?>>-</button>
</div>