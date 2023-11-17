const forms = document.querySelector(".forms"),
pwShowHide = document.querySelectorAll(".eye-icon"),
links = document.querySelectorAll(".link");
pwShowHide.forEach(eyeIcon => {
eyeIcon.addEventListener("click", () => {
  let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
  
  pwFields.forEach(password => {
      if(password.type === "password"){
          password.type = "text";
          eyeIcon.classList.replace("bx-hide", "bx-show");
          return;
      }
      password.type = "password";
      eyeIcon.classList.replace("bx-show", "bx-hide");
  })
  
})
})


function validateemail(){
    var email = document.getElementById('email').value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert('Invalid email address. Please enter a valid email.');
      return false;
    }
    alert('Form is valid. Submitting...');
    return true;
}
function validatemdp(){
  var password = document.getElementById('newPassword').value;
  var email = document.getElementById('email').value;
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (password.length < 8 || !/\d/.test(password)) {
    alert('Password should be at least 8 characters long and contain at least one number.');
    return false;
  }
    if (!emailRegex.test(email)) {
      alert('Invalid email address. Please enter a valid email.');
      return false;
    }
    alert('Form is valid. Submitting...');
    return true;
}
function validateForm() {
    // Get the input values
    var name = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var numero = document.getElementById('numero').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    // Check if the name and prenom are not null
    if (!name || !prenom) {
      alert('Name and prenom cannot be empty.');
      return false;
    }

    // Check if the numero has more than 8 digits
    if (numero.length < 8) {
      alert('Numero should have more than 8 digits.');
      return false;
    }

    // Check if the email is valid
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert('Invalid email address. Please enter a valid email.');
      return false;
    }

    if (password.length < 8 || !/\d/.test(password)) {
        alert('Password should be at least 8 characters long and contain at least one number.');
        return false;
      }
    // Check if the password and confirm password match
    if (password !== confirmPassword) {
      alert('Password and confirm password do not match.');
      return false;
    }

    // Additional password strength checks can be added here if needed

    // If all checks pass, the form is valid
    alert('Form is valid. Submitting...');
    return true;
  }