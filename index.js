
var cont1=document.querySelector('.content1');
var cont2=document.querySelector('.content2');
var cont3=document.querySelector('.content3');

var btn1=document.querySelector('#btn1');
var btn2=document.querySelector('#btn2');
var btn3=document.querySelector('#btn3');


btn1.addEventListener('click',function(){

  cont1.style.transform="translateX(0)";
  cont2.style.transform="translateX(100%)";
  cont3.style.transform="translateX(100%)";
  btn2.setAttribute('style','background-color:#4a69bd')
  btn1.setAttribute('style','background-color:#1e3799');
  btn3.setAttribute('style','background-color:#4a69bd');
  cont1.style.transtionDelay='0.3s';
  cont2.style.transitionDelay='0s';
  cont3.style.transitionDelay='0s';
});


btn2.addEventListener('click',function(){
  cont1.style.transform="translateX(100%)";
  cont3.style.transform="translateX(100%)";
  cont2.style.transform="translateX(0)";
  btn1.setAttribute('style','background-color:#4a69bd')
  btn2.setAttribute('style','background-color:#1e3799');
  btn3.setAttribute('style','background-color:#4a69bd');
  cont1.style.transtionDelay='0s';
  cont2.style.transitionDelay='0.3s';
  cont3.style.transitionDelay='0s';
  
});

btn3.addEventListener('click',function(){
  cont1.style.transform="translateX(100%)";
  cont2.style.transform="translateX(100%)";
  cont3.style.transform="translateX(0)";
  btn1.setAttribute('style','background-color:#4a69bd')
  btn2.setAttribute('style','background-color:#4a69bd');
  btn3.setAttribute('style','background-color:#1e3799');
  cont1.style.transtionDelay='0s';
  cont2.style.transitionDelay='0s';
  cont3.style.transitionDelay='0.3s';
});

// function openCont1(){
  
 
// }

// function openCont2(){
  
// }
let delete1 = document.getElementsByClassName('delete');
Array.from(delete1).forEach((element) => {
  element.addEventListener('click', (element) => {
    let srno=element.target.id;
    if(confirm("Are you sure? You want to delete this record")){
             console.log(srno);

             window.location=`/srs work/index.php?delete=${srno}`;
    }
    else{
           // console.log("NO");
    }
  })
});

//fixing bugs

// function clearText(){
// var form = document.getElementById("searchstr");
//   form.val='';
// }

