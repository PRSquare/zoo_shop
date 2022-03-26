var login = document.getElementById('login');
var registration = document.getElementById('registrate');
var suButton = document.getElementById('suButton');
var siButton = document.getElementById('siButton');

var maindiv = document.getElementById('loginreg');
var position = suButton.getBoundingClientRect();
maindiv.style.height = position.buttom - position.top + 'px';

login.style.display = 'block';
registration.style.display = 'none';

function setSignInAsActive(){
  login.style.display = 'block';
  registration.style.display = 'none';
  siButton.style = 'background-color: #334e2fcc';
  suButton.style = 'background-color: #787';
}
function setSignUpAsActive(){
  registration.style.display = 'block';
  login.style.display = 'none';
  siButton.style = 'background-color: #787';
  suButton.style = 'background-color: #334e2fcc';
}
function lightButton(button){
  if(button == 1 && registration.style.display == 'none') {
    suButton.style = 'background-color: #898';
  }
  if(button == 0 && login.style.display == 'none') {
    siButton.style = 'background-color: #898';
  }
}

function stoplightingButton(button){
  if(button == 1 && registration.style.display == 'none') {
    suButton.style = 'background-color: #787';
  }
  if(button == 0 && login.style.display == 'none') {
    siButton.style = 'background-color: #787';
  }
}

window.addEventListener('resize', event=>{
  position = suButton.getBoundingClientRect();
  maindiv.style.height = position.buttom - position.top + 'px';
}, false)