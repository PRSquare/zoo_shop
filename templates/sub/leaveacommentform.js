function checkAndSend(){
	var comment = document.getElementsByName('comment')[0];
	var prod_id = document.getElementsByName('prod_id')[0];
	if( comment.value != [] && prod_id.value != []){
		commForm = document.getElementsByName('comment_form')[0];
		commForm.submit();
	} else {
		alert("Empty comment!");
	}
}