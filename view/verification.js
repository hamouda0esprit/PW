 // server.js



 
 
 // animation
 
 /*var percent = document.querySelector(".percent");
var progress = document.querySelector(".progress");
var count = 4 ;
var per = 4;
var loading = setInterval(Calcul,50);
function Calcul(){
  if(count == 100 && per == 100){
  clearInterval(loading);}
  else{
    per = per + 1;
    count = count + 1;
    progress.style.width = per + '%';
    percent.textContent = count ;
  } 
}*/

// validation

function validateForm() {
  var point = document.getElementById('point').value;


  // Reset error messages
 

  // Check if height, width, and depth are valid floats
  if (!isValidFloat(point)) {
    alert('Please enter a valid information');
    return false;
  }
  return true;
}

function isValidFloat(value) {
  return !isNaN(parseFloat(value)) && isFinite(value);
}
  