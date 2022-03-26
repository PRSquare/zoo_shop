<div class="product">
	<!-- Изображение товара -->
	<div class="div_prod_image">
		<a <?="href=/productpage.php?id=".$product['id']?>><img class="prod_image" <?= "src=\"".$product['path_to_img']."\""?>></a>
	</div>
	<!-- Название и описание товара -->
	<div class="prod_text">
		<a class="prod_name" <?="href=/productpage.php?id=".$product['id']?>><?=$product['name']?></a>
		<p class='prod_desc'><?=$product['description']?></p>
	</div>
	<!-- Кнопка добавления в корзину -->
	<a class="tobasket_hr" style="text-decoration: none; color: black;" <?="href='/postCatcher/addtobasket.php?prodId=".$product['id']."'"?>>
		<div class="buy_button"><p class='b_text'>В корзину</p><br>
			<!-- Цена -->
			<b class="b_price" <?php
					if($discount > 0){
						print("class='discount'");
					}
				?>><?=round($product['price'] - $product['price']*($discount/100), 2);?>
			</b><b> &#8381</b>
			<!-- Скидка (если есть) -->
			<?=($discount>0) ? "<p class='discount' style='display: inline;'>-".$discount."%</p>" : '';?>
		</div>
	</a>
</div>
