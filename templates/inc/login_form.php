<link rel="stylesheet" href="/templates/inc/login_form.css">
<div id="loginreg">
  <!-- Форма входа -->
  <form id='form' name="login" method="POST" action="/login.php">
    <div id="login">
      <!-- Логин -->
      <label for="login"></label>
      <p class="input">login: <input class="input" type="text" name="login"></p>
      <!-- Пароль -->
      <label for="password"></label>
      <p class="input">password: <input class="input" type="password" name="password"></p>
      <!-- Кнопка отправки формы -->
      <input class="sbutton" type="submit" name="sign in" value="sign in" style="margin-top: 10%;">
    </div>
  </form>
  <!-- Форма регистрации -->
  <form id='form' name="signup" method="POST" action="/postCatcher/signup.php">
    <div id="registrate">
      <!-- Email -->
      <label for="email"></label>
      <p class="input">email: <input class="input" type="text" name="email"></p>
      <!-- Логин -->
      <label for="sulogin"></label>
      <p class="input">login: <input class="input" type="text" name="sulogin"></p>
      <!-- Пароль -->
      <label for="supassword"></label>
      <p class="input">password: <input class="input" type="password" name="supassword"></p>
      <!-- Кнопка отправки формы -->
      <input class="sbutton" type="submit" name="sign up" value="sign up">
    </div>
  </form>
  <!-- Сделать форму фхода активной -->
  <div id='siButton' onmouseleave="stoplightingButton(0)" onmouseover="lightButton(0);" onclick="setSignInAsActive();">
    <p>Sign in</p>
  </div>
  <!-- Сделать форму регистрации активной -->
  <div id='suButton' onmouseleave="stoplightingButton(1)"onmouseover="lightButton(1);" onclick="setSignUpAsActive();">
    <p>Sign up</p>
  </div>
</div>
<script type="text/javascript" src="/templates/inc/login_form.js"></script>
