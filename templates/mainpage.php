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

  .pets_text {
    background: #fffd;
    padding: 10px 20px;
    margin: 0 auto;
    overflow: hidden;
    width: 80%;
    font-family: Tahoma, sans-serif;
  }
  .pets_text p {
    text-align: justify;
    font-size: 1.3em;
  }
  .pets_text h2 {
    text-align: center;
  }
  .intext_image {
    display: block;
    width: 30%;
  }
  .intext_image_left {
    float: left;
    padding-right: 10px;
    padding-bottom: 10px;
  }
  .intext_image_right {
    float: right;
    padding-left: 10px;
    padding-bottom: 10px;
  }

</style>

<div class="content__main-col">
  <?=renderTemplate("templates/sub/slider.php")?> 

  <!-- <div class="site_descripion">
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
  </div> -->

  <div class="pets_text">
    <h2>Основные правила
необходимы как для питомца, так и для самого хозянна</h2>
    <img class="intext_image intext_image_left" src="resources/text/cat.jpg">
    <p>Животное - не игрушка, это живое существо. Оно хочетесть, пить, спать, периодически болеет, регулярно испражняется, нуждается в выгулах, заботе, ласке, внимании. Хозяин берет не игрушку, ему придется заботиться о новом члене семьи вне зависимости от того, устал он, есть ли унего желание или настроение. С начала пребывания в доме животное вынуждено подчиняться базовым правилам. Именно они способствуют социализации питомца, напрямую воздействуя на его характер и воспитание. Забывать о правилах иельзя: слабина может испортить малыша. Перекладывать исполнение правил со дня на день недопустимо: чем старше питомец, тем сложнее будет его воспитывать. У животного обязано быть собственное место.Хозяйская кровать, диван, кресло не станут его альтернативой. Животное, которое берут в кровать, со временем начинает считать, что это его место. Если в детском возрасте оно еще и признает авторитет хозяина, то в более старшем будет считать себя вожаком. А вожак может делать все, что захочет. Подстилка (клетка, домик, вольер) и миски с едой должны содержаться в чистоте. Нельзя допускать, чтобы в помещении распространялся неприятный запах. Если питомец разрывает свою подстроку, ее меняют. Если она загрязнилась, ее чистят. Место животных, которых невозможно приучить к лотку, чистят чаще.
    </p>
    
    <h2>Общение</h2>
    <img class="intext_image intext_image_right" src="resources/text/dog.jpg">
    <p>Питомец нуждается в ласке и внимании. С ним необходимо разговаривать, общаться. Питомец без общения и заботы чувствует себя никому не нужным. Контакт необходим, ведь именно он позволяет приручить зверька, помочь ему адаптироваться в новых условиях, почувствовать себя нужным. Даже ежики, привыкнув к своим хозяевам, позволяют себя ласкать и гладить. Однако общение может проходить по-разному. Если, например, некоторые экзотические животные избегают резкого шума, а другие могут быть своенравны, то собаки всегда готовы принять ласку. Они обожают, когда их гладят, любят играть со своими хозяевами, часто вместе играют в спортивные игры, плывут наперегонки. Многие питомцы ждут своих хозяев с работы, выглядывая в окна, а затем ожидая у входной двери.</p>

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