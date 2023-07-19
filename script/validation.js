// Function to validate the form
function validateForm() {
  // Get the form inputs
  var fnameInput = document.getElementById('fname');
  var lnameInput = document.getElementById('lname');
  var emailInput = document.getElementById('email');
  var phoneInput = document.getElementById('phone');
  var ddInput = document.getElementById('dd');
  var educationInput = document.getElementById('education');
  var eduIdInput = document.getElementById('edu_id');
  var passwordInput = document.getElementById('password');
  var confirmPasswordInput = document.getElementById('confirm-password');
  var errorMessage = document.getElementById('error-message');

  // Reset the error message
  errorMessage.textContent = '';

  // Validate the First Name
  if (fnameInput.value.trim() === '') {
    errorMessage.textContent = 'First Name cannot be empty.';
    return false;
  }

  // Validate the Last Name
  if (lnameInput.value.trim() === '') {
    errorMessage.textContent = 'Last Name cannot be empty.';
    return false;
  }

  // Validate the Email
  var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!emailRegex.test(emailInput.value)) {
    errorMessage.textContent = 'Please enter a valid email address.';
    return false;
  }

  // Validate the Phone
  var phoneRegex = /^\d{10}$/;
  if (!phoneRegex.test(phoneInput.value)) {
    errorMessage.textContent = 'Phone number should be 10 digits.';
    return false;
  }

  // Validate the Date of Birth
  var minDate = new Date('1900-01-01');
  var maxDate = new Date('2010-01-01');
  var selectedDate = new Date(ddInput.value);

  if (selectedDate < minDate || selectedDate > maxDate) {
    errorMessage.textContent = 'Date of Birth should be between 01-01-1900 to 01-01-2010.';
    return false;
  }

  // Validate the Educational Institute
  if (eduIdInput.value.trim() === '') {
    errorMessage.textContent = 'Educational Institute cannot be empty.';
    return false;
  }

  // Validate the Password
  if (passwordInput.value !== confirmPasswordInput.value) {
    errorMessage.textContent = 'Passwords do not match.';
    return false;
  }

  return true;
}

// Add form submit event listener
document.addEventListener('DOMContentLoaded', function() {
  var form = document.getElementById('general-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();
    if (validateForm()) {
      this.submit();
    }
  });
});
