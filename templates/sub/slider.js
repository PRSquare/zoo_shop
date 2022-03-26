var imgs = document.getElementsByClassName("imgdiv");
var positions = ['0', '-1000px', '1000px'];
var zindexes = ['1', '-1', '-1'];
var curPos = 0;
var poscount = 3
moveSlider(1);
var tranistionBlocked = false;

var scroll = setInterval(()=>moveSlider(1), 5000);


function moveSlider(dir){
  if(!tranistionBlocked) {
    if(dir == 1){
      curPos++;
      if(curPos > poscount-1)
        curPos = 0;
    } else {
      curPos--;
      if(curPos < 0)
        curPos = 2;
    }
    for(var i = 0; i < poscount; ++i){
        imgs[i].style.left = positions[ i+curPos < poscount ? i+curPos : i+curPos-poscount ];
        imgs[i].style.zIndex = zindexes[ i+curPos < poscount ? i+curPos : i+curPos-poscount ];
      }
      tranistionBlocked = true;
      setTimeout( ()=>{
        tranistionBlocked = false; 
        clearInterval(scroll); 
        scroll = setInterval(()=>moveSlider(1), 5000);
      }, 2000);
  }
}