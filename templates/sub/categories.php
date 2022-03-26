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

<div class="categories sidebar_elem">
	<div class="cat_head sidebar_elem__head" onclick="changeElemDisplayStyle('PT')">
		<span>Категории товаров</span>
	</div>
	<div class="prodTypes sidebar_elem__bod" id="PT">
	      <a class="prodTypes" href='catalog.php'>&#128062 Все товары</a><br>
	      <?php 
		        foreach ($types as $type) {
		          print("<a class='prodTypes' href='catalog.php?prod_types[]=".$type['id']."'>&#128062 ".$type['product_type']."</a><br>");
		        }
	      ?>
    </div>
</div>