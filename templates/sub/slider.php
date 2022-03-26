<link rel="stylesheet" href="templates/sub/slider.css">
<div class = "images">
  <!-- Стрелочки для перемотки изображений -->
  <div id="goFront">
    <img class='arrowImg' onclick="moveSlider(-1)" src="/resources/icons/arrowleft.png">
  </div>
  <div id="goBack">
    <img class='arrowImg' onclick="moveSlider(1)" src="/resources/icons/arrowright.png">
  </div>

  <!-- Одно изображение -->
  <a href='catalog.php?prod_types[]=3'>
    <div class="imgdiv">
      <img class='contImg' src="/resources/container/cat.jpg">
      <div class="textOnImg">
        <p>Товары для кошек</p>
      </div>
    </div>
  </a>
  <!---------------------->
  
  <a href='catalog.php?prod_types[]=1'>
    <div class="imgdiv">
      <img class='contImg' src="/resources/container/dog.jpg">
      <div class="textOnImg">
        <p>Товары для собак</p>
      </div>
    </div>
  </a>
  <a href='catalog.php?prod_types[]=4'>
    <div class="imgdiv">
      <img class='contImg' src="/resources/container/fish.jpg">
      <div class="textOnImg">
        <p>Товары для рыб</p>
      </div>
    </div>
  </a>
</div>
<script src="templates/sub/slider.js"></script>