<link rel="stylesheet" href="/templates/inc/user_account.css">
<div class="user_info">
	<a href='/account.php' id="username"><?= $username; ?></a>
	<!-- Кнопка выхода -->
	<form name="logout" method="POST" action="/logout.php">
		<input id="exit_button" type="submit" name="send" value="Exit">
	</form>
</div>