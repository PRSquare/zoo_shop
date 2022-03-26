<link rel="stylesheet" href="/templates/css/basket.css">
<div id="basket">
      <?php 
      foreach ($products as $product) {
        print("<div class='prod_in_basket'>");
        // Товар в корзине
        $prod = renderTemplate("templates/sub/product.php", ['product'=>$product, 'discount'=>($stocks[$product['id']] ?? 0)]);
        // Управление кол-вом товара
        $ui = renderTemplate("templates/sub/basketui.php", ['count'=>$count, 'id'=>$product['id']]);
        print($prod);
        print($ui);
        print("</div>");
      }
    ?>
    <hr>
    <!-- Итоговая сумма -->
    <b id="summ"> </b>
    <!-- Форма покупки товаров -->
    <form name="buy" onsubmit="checkAndBuy();" method="POST" action="checkout.php">
      <!-- Кнопка отправки формы -->
      <input type="submit" style="float: right;" value="Купить">
      <!-- Список покупаемых товаров -->
      <input type="hidden" name="all_prods" id="all_prods">
      <!-- Итоговая цена -->
      <input type="hidden" name="fin_price" id="fin_price">
    </form>
</div>
<script>
  // Некоторые переменные, определённые через PHP
  <?php print("var allProducts=".json_encode($products).";");?>;
  <?php print("var prod_counts=".json_encode($prod_counts).";");?>;
</script>
<script src="templates/scripts/basket.js"></script>