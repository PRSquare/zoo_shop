function checkAndSend(){
	var discount = document.getElementsByName('discount_size')[0];
	var users = document.getElementsByName('user[]')[0];
	var date = document.getElementsByName('end_time')[0];

	var ok = true;

	if(!discount.value){
		console.log("Discount is empty!");
		ok = false;
	}
	if(!date.value){
		console.log("Date is empty!");
		ok = false;
	}
	if(!users.value){
		console.log("Users list is emty!");
		ok = false;
	}
	if(ok){
		document.getElementsByName('stock_creation')[0].submit();
	}
}