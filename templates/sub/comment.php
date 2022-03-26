<div class="comment">
	<!-- Имя пользователя -->
	<b class="comment_b" ><?=$username?></b>
	<!-- Комментарий -->
	<p class="comment_p"><?=$comment['comment']?></p>
</div>
<!-- Удаление комментария -->
<?php 
	if($delete_comment){
		print("<form name='delete_comment_form' action='/postCatcher/deletecomment.php' method='POST'>
			<input type='hidden' name='del_comment_id' value='{$comment['id']}'>
			<input type='submit' name='del_button' value='Удалить' >
		</form>
		");
	}
?>
