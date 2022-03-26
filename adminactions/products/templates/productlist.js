function checkAndSend(elId){
	var name = document.getElementById('product_name'+elId);
	var price = document.getElementById('product_price'+elId);

	var ok = true;

	if(!name.value){
		console.log("Name is empty!");
		ok = false;
	}
	if(!price.value){
		console.log("Price is NaN or empty!");
		ok = false;
	}

	if(ok){
		document.getElementById(elId).submit();
	}
}

function showHideChangeForm(id){
	var statinfo = document.getElementById("product_"+id);
	var changeForm = document.getElementById("changeform_"+id);
	if(statinfo.style.display == 'block'){
		statinfo.style.display = 'none';
		changeForm.style.display = 'block';
	}	
	else{
		statinfo.style.display = 'block';
		changeForm.style.display = 'none';
	}
}
function showHideCountChangeForm(id){
	var changeForm = document.getElementById("count_change_form_"+id);
	if(changeForm.style.display == 'block'){
		changeForm.style.display = 'none';
	}	else {
		changeForm.style.display = 'block';
	}
}
function searchProduct(){
  var prodName = document.getElementById("search_prod").value.toLowerCase();
  if(prodName != ''){
    var allProducts = document.getElementsByClassName('product_d');
    for( var i = 0; i < allProducts.length; ++i ){
      var name = allProducts[i].getElementsByClassName("prod_name")[0].innerHTML.toLowerCase();
      if(!name.includes(prodName))
        allProducts[i].style.display = 'none';
    }
  } else {
    var allProducts = document.getElementsByClassName('product_d');
    for( var i = 0; i < allProducts.length; ++i ){
      allProducts[i].style.display = 'block';
    }
  } 
}