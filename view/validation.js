function validateForm() {
  var height = document.getElementById('height').value;
  var width = document.getElementById('width').value;
  var depth = document.getElementById('depth').value;
  var weight = document.getElementById('Weight').value;
  var depart = document.getElementById('depart').value;
  var arrivee = document.getElementById('arrivee').value;
  var budget = document.getElementById('budget').value;

  // Reset error messages
  resetErrorMessages();
 

  // Check if height, width, and depth are valid floats
  if (!isValidFloat(height)) {
    displayError('sizeError', 'Please enter a valid height (floating-point number).');
  
  }

  if (!isValidFloat(width)) {
    displayError('sizeError', 'Please enter a valid width (floating-point number).');
   
  }

  if (!isValidFloat(depth)) {
    displayError('sizeError', 'Please enter a valid depth (floating-point number).');
   
  }

  // Check if weight is a valid float
  if (!isValidFloat(weight)) {
    displayError('weightError', 'Please enter a valid weight (floating-point number).');
   
  }

  // Check if depart and arrivee are non-empty strings
  if (!isValidString(depart)) {
    displayError('departError', 'Please enter a valid departure location.');
    
  }

  if (!isValidString(arrivee)) {
    displayError('arriveeError', 'Please enter a valid arrival location.');
   
  }

  // Check if budget is a valid float
  if (!isValidFloat(budget)) {
    displayError('budgetError', 'Please enter a valid budget (floating-point number).');
   
  }

  
}

function isValidFloat(value) {
  return !isNaN(parseFloat(value)) && isFinite(value);
}

function isValidString(value) {
  return typeof value === 'string' && value.trim() !== '';
}

function displayError(elementId, message) {
  var errorElement = document.getElementById(elementId + 'Error'); // Corrected ID here
  if (errorElement) {
    errorElement.textContent = message;
  }
}

function resetErrorMessages() {
  var errorElements = document.querySelectorAll('.error-message');
  errorElements.forEach(function (element) {
    element.textContent = '';
  });
}
/*function HideClass() {
  var type = document.getElementById("type").value;
  var commande = document.getElementById("commande");
  
  if(type == "0" || type =="Technical"){
          document.querySelectorAll(".commande")[0].classList.add("hidden");
          commande.selectedIndex = 0;
      
          var event = new Event('change');
          commande.dispatchEvent(event);
      }else{
          document.querySelectorAll(".commande")[0].classList.remove("hidden");
  }
}*/