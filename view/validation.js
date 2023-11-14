function validateForm() {
    var height = document.getElementById('height').value;
    var width = document.getElementById('width').value;
    var depth = document.getElementById('depth').value;
    var weight = document.getElementById('weight').value;
    var depart = document.getElementById('depart').value;
    var arrivee = document.getElementById('arrivee').value;
    var budget = document.getElementById('budget').value;
  
    // Reset error messages
    resetErrorMessages();
  
    // Check if height, width, and depth are valid floats
    if (!isValidFloat(height)) {
      displayError('heightError', 'Please enter a valid height (floating-point number).');
      
    }
  
    if (!isValidFloat(width)) {
      displayError('widthError', 'Please enter a valid width (floating-point number).');
      
    }
  
    if (!isValidFloat(depth)) {
      displayError('depthError', 'Please enter a valid depth (floating-point number).');
      
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
  
    return true;
  }
  
  function isValidFloat(value) {
    return !isNaN(parseFloat(value)) && isFinite(value);
  }
  
  function isValidString(value) {
    return typeof value === 'string' && value.trim() !== '';
  }
  
  function displayError(elementId, message) {
    var errorElement = document.getElementById(elementId);
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
  