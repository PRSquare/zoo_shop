<link rel="stylesheet" href="/templates/css/adminaccount.css">
<div id='menu'>
	<!-- Меню управления товарами -->
	<p class = 'sh' id='prodButton' onclick="changeElemDisplayStyle('products');">Товары</p>
	<div class='hideable' id='products'>
		<a href='adminactions/products/productlist.php'>Список товаров</a><br>
		<a href="adminactions/products/addproduct.php">Добавить товар</a>
	</div>
	<!-- Меню управления акциями -->
	<p class = 'sh' id='stocksButton' onclick="changeElemDisplayStyle('stocks');">Акции</p>
	<div class='hideable' id="stocks">
		<a href='adminactions/stocks/stocklist.php'>Список акций</a><br>
	</div>
	<!-- Меню управления типами товаров -->
	<p class = 'sh' id='typesButton' onclick="changeElemDisplayStyle('types');">Типы товаров</p>
	<div class='hideable' id="types">
		<a href='adminactions/types/typeslist.php'>Список типов товаров</a>
	</div>
	<!-- Меню управления пользователями -->
	<p class = 'sh' id='usersButton' onclick="changeElemDisplayStyle('users');">Пользователи</p>
	<div class='hideable' id="users">
		<a>Список пользователей</a>
	</div>
	<!-- Меню заказов -->
	<a href="adminactions/orders/orders.php">Список заказов</a>
</div>
<script src="/templates/css/adminaccount.css"></script>