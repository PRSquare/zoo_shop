function showHide(elId, elStyle="block"){
  var el = document.getElementById(elId);
  
  if( el.style.display == "none" || el.style.display == '' )
    el.style.display = elStyle;
  else
    el.style.display = "none";
}