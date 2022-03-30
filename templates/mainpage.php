<style type="text/css">
  .prods {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    width: 80%;
    margin: 0 auto;
  }


  .product {
      margin: 10%;
      box-shadow: 0 10px 10px #0005;
      padding: 1%;
      overflow: hidden;
      transition: 0.1s;
      background-color: #cfcda7;
  }
  .product:hover{
      transform: scale(1.01);
      transition: 1;
      z-index: 1;
  }
  .div_prod_image {
      display: flex;
      background-color: #fff;
      max-height: 15em;
      cursor: pointer;
      overflow: hidden;
      border-radius: 10px;
  }
  .prod_image{
      display: block;
      height: 100%;
      width: 100%;
      max-width: 300px;
      max-height: 300px;

      border-radius: 10px;
  }
  .prod_name{
      color: black;
      transition: 0.1s;
      text-decoration: none;
  }
  .prod_name:hover{
      color: #334e2f;
      transition: 0.1s;
  }
  p.prod_desc{
      cursor: default;
  }
  .prod_text{
      text-align: center;
      height: 5em;
      overflow: hidden;
  }


  .desc_header {
    text-align: center;
  }
  .desc_body {
    width: 80%;
    margin: 0 auto;
  }
</style>

<div class="content__main-col">
  <?=renderTemplate("templates/sub/slider.php")?> 

  <div class="site_descripion">
    <div class="desc_header">
      <h1>
        <?=$desc_header?>
      </h1>
    </div>
    <div class="desc_body">
      <p>
        <?=$desc_body?>
      </p>
    </div>
  </div>

  <div class='prods'>
    <?php 
      foreach ($products as $product) {
        $prod = renderTemplate("templates/sub/product.php", ['product'=>$product, 'discount'=>($stocks[$product['id']] ?? 0)]);
        print($prod);
      }
    ?>
  </div>
</div>
</script>