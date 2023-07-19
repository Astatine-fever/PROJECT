function submitGeneralForm() {
    var form = document.getElementById('general-form');
    if (form.checkValidity()) {
      var formData = new FormData(form);
      formData.append('token', '<?php echo $tk; ?>');
  
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../php/settings_data.php', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onload = function () {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          console.log(response); // Handle the response as needed
        }
      };
      xhr.send(formData);
    } else {
      document.getElementById('error-message-general').textContent = 'Please fill in all the required fields.';
    }
  }
  
  function submitEducationForm() {
    var form = document.getElementById('education-form');
    if (form.checkValidity()) {
      var formData = new FormData(form);
      formData.append('token', '<?php echo $tk; ?>');
  
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../php/settings_data.php', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onload = function () {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          console.log(response); // Handle the response as needed
        }
      };
      xhr.send(formData);
    } else {
      document.getElementById('error-message-education').textContent = 'Please fill in all the required fields.';
    }
  }
  
  function submitSecurityForm() {
    var form = document.getElementById('security-form');
    if (form.checkValidity()) {
      var formData = new FormData(form);
      formData.append('token', '<?php echo $tk; ?>');
  
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../php/settings_data.php', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onload = function () {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          console.log(response); // Handle the response as needed
        }
      };
      xhr.send(formData);
    } else {
      document.getElementById('error-message-security').textContent = 'Please fill in all the required fields.';
    }
  }
  