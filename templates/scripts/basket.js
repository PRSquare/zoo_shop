// Первоначальная установка цены товара цену
update();

// Проверка и отправка формы покупки
function checkAndBuy(){
  var form = document.getElementsByName("buy")[0];
  var count = document.getElementsByClassName("count_val");
  
  var allProdsArr = [];

  for( var i = 0; i < allProducts.length; ++i ){
    console.log[i];
    var pr = parseFloat( allProducts[i]['id'] );
    var c = parseInt(count[i].innerHTML );
    allProdsArr.push([pr, c]);
  }
  var summ = update();
  var all_prods=document.getElementById("all_prods");
  var fin_price=document.getElementById("fin_price");
  fin_price.value = summ;
  all_prods.value = allProdsArr;

  form.submit();
}

function increaceCount(id){
  
  console.log(prod_counts[id]);
  var count = document.getElementById("count_"+id);
  curVal = parseInt(count.innerHTML);
  if( curVal < prod_counts[id] ){
    count.innerHTML = curVal+1;
    update();  
  }
  
}
function decreaceCount(id){
  var count = document.getElementById("count_"+id);
  curVal = parseInt(count.innerHTML);
  if(curVal > 0){  
    count.innerHTML = curVal-1;
    update();
  }
}

// Функция обновления значения цены
function update(){
  var summ = document.getElementById("summ");
  var count = document.getElementsByClassName("count_val");
  var allPrices = document.getElementsByClassName("b_price");
  var prSumm = 0;
  for( var i = 0; i < allPrices.length; ++i ){
    var pr = parseFloat( allPrices[i].innerHTML );
    prSumm += isNaN(pr) ? 0 : pr*parseInt(count[i].innerHTML);
  }
  summ.innerHTML = "Итог: "+prSumm.toFixed(2)+" &#8381";
  return prSumm;
}