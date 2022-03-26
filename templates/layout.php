<!DOCTYPE html>
  <html lang="ru">
  <head>
    <title><?= $title; ?></title>
    <link rel="icon" href="/resources/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/templates/css/layout.css">
  </head>
  <body>
    <header class="main-header">
      <!-- Каталог -->
      <a id='menu_link' href="/catalog.php">Каталог</a>
      <!-- Название магазина -->
      <a href='/index.php' class="main-header">Petsburg</a>
      <div class='icons'>
        <!-- Иконка корзины -->
        <div class='menu_pic'>
          <a href="/basket.php"><img class='menu_pic' src="/resources/icons/shoping_cart.png"></a>
        </div>
        <!-- Иконка пользователя -->
        <div class='menu_pic' id="user_pic" onclick="showHide('user_page');">
          <img class='menu_pic' src="/resources/icons/account.png">
        </div>
      </div>
    </header>
    <!-- Страничка пользователя (всплывающая) -->
    <div id="user_page">
        <?= $user_page ?>
      </div>
    <!-- Контент страницы -->
    <div class="main-content">
      <main class="content"><?= $content; ?></main>
    </div>
    <footer class="main-footer">Petsburg. 2021</footer>
  </body>
</html>
<script src="/templates/scripts/layout.js"></script>