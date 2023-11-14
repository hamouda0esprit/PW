function validateForm() {
    var point = document.getElementById('point').value;

  
    // Reset error messages
    resetErrorMessages();
  
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
  