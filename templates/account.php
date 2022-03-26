<link rel="stylesheet" href="/templates/css/account.css">
<div id='menu'>
	<!-- Имя пользователя -->
	<h3><?=$name?></h3>
	<!-- Список акций доступных пользователю -->
	<p id="show_hide" onclick="changeElemDisplayStyle('actions_list');">
		Список акций
	</p> 
	<div id="actions_list">
		<?php
			foreach ($stocks as $stock) {
				print("<div class='stock'><p class='st_desc'>".$stock['description']."</p><p class='st_disc_size'>-".$stock['discount_size']."%</p></div>");
			}
		?>
	</div>
</div>
<script src="/templates/scripts/account.js"></script>