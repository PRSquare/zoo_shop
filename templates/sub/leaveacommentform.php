<link rel="stylesheet" href="/templates/sub/leaveacommentform.css">
<div id="leave_a_comment">
	<!-- Форма отправки комментариев -->
	<form name='comment_form' action='/postCatcher/comment.php' method="POST" onsubmit="checkAndSend();">
		<!-- Ввод текста -->
		<label><p id="lac_txt">Оставить комментарий: <textarea id="comment_input" name="comment" placeholder="Ваш комментарий"></textarea></p></label>
		<!-- Скрытое поле id товара, к которому будет оставлен комментарий -->
		<input type="hidden" name='prod_id' <?="value=\"".$prod_id."\""?>>
	</form>
	<!-- Кнопка отправки комментария -->
	<button id="lac_button" onclick="checkAndSend();">Отправить</button>
</div>
<script src="/templates/sub/leaveacommentform.js"></script>