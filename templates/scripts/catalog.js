function searchProduct(){
  var prodName = document.getElementById("search_prod").value.toLowerCase();
  if(prodName != ''){
    var allProducts = document.getElementsByClassName('product');
    for( var i = 0; i < allProducts.length; ++i ){
      var name = allProducts[i].getElementsByClassName("prod_name")[0].innerHTML.toLowerCase();
      if(!name.includes(prodName))
        allProducts[i].style.display = 'none';
    }
  } else {
    var allProducts = document.getElementsByClassName('product');
    for( var i = 0; i < allProducts.length; ++i ){
      allProducts[i].style.display = 'block';
    }
  }
}