function checkAndSend(){
	var name = document.getElementsByName('prod_name')[0];
	var count = document.getElementsByName('count')[0];
	var price = document.getElementsByName('price')[0];

	var ok = true;

	if(!name.value){
		console.log("Name is empty!");
		ok = false;
	}
	if(!count.value){
		console.log("Count is NaN or empty!");
		ok = false;
	}
	if(!price.value){
		console.log("Price is NaN or empty!");
		ok = false;
	}
	if(ok){
		document.getElementsByName('product_creation')[0].submit();
	}
}