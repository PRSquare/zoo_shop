<link rel="stylesheet" href="/templates/css/catalog.css">


<div class='catalog__all_content'>
  <div class='catalog__products'>
    <!-- Товары -->
    <div class="content__main-col">
      <?php 
        foreach ($products as $product) {
          $prod = renderTemplate("templates/sub/product.php", ['product'=>$product, 'discount'=>($stocks[$product['id']] ?? 0)]);
          print($prod);
        }
      ?>
    </div>
  </div>

  <div class="sidebar">    
    <?= renderTemplate('templates/sub/search.php', ['types' => $types]); ?>
    <?= $sort ?>
    <?= renderTemplate('templates/sub/categories.php', ['types' => $types]); ?>
  </div>
  <?=$pages?>
</div>
<script src="templates/scripts/catalog.js"></script>
<!-- Слайдер с фотографиями -->
<?php//renderTemplate("templates/sub/slider.php")
print(' ');?>