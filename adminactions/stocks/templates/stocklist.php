<div>
	<!-- Отображение вписка акций -->
	<?php 
	foreach ($stocks as $stock) {
		print(renderTemplate("templates/stock.php", ['stock'=>$stock]));
	}?>
</div>