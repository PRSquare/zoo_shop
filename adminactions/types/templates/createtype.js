function checkAndSend_delete(){
	var name = document.getElementsByName('type_name_f')[0];
	
	var ok = true;

	if(!name.value){
		console.log("Name is empty!");
		ok = false;
	}
	if(ok){
		document.getElementsByName('product_creation')[0].submit();
	}
}