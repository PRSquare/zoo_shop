<link rel="stylesheet" href="/templates/css/productpage.css">
<!-- Продукт -->
<div>
	<?=
		// Необходимо передать зеачения переменным $product, $comments, $names, $leave_a_comment_form)
		renderTemplate("templates/sub/product.php", ['product'=>$product, 'discount'=>$stock]);
	?>
</div>
<!-- Секция комментариев -->
<div>
	<div id="comments">
	<?php
		foreach ($comments as $comment) {
			$comm = renderTemplate("templates/sub/comment.php", ['comment'=>$comment, 'username'=>$names[$comment['user_id']], 'delete_comment'=>$delete_comment ]);
			print($comm);
		}
	?>
	</div>
</div>
<!-- Форма отправки комментариев -->
<?php print($leave_a_comment_form)?>
<script src="/templates/scripts/productpage.js"></script>