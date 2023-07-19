document.addEventListener("DOMContentLoaded", function() {
  var currentTab = 0;
  showTab(currentTab);

  function showTab(n) {
    var x = document.querySelectorAll(".tab");
    x[n].style.display = "block";

    var prevBtn = document.querySelector("#prevBtn");
    var nextBtn = document.querySelector("#nextBtn");
    var submitBtn = document.querySelector("#submitBtn");

    if (n === 0) {
      prevBtn.style.display = "none";
    } else {
      prevBtn.style.display = "inline";
    }

    if (n === x.length - 1) {
      nextBtn.innerHTML = "Submit";
    } else {
      nextBtn.innerHTML = "Next";
    }

    fixStepIndicator(n);
  }

  function nextPrev(n) {
    var x = document.querySelectorAll(".tab");
    if (n === 1 && !validateForm()) return false;

    x[currentTab].style.display = "none";
    currentTab += n;

    if (currentTab >= x.length) {
      event.preventDefault();
      document.getElementById("regForm").submit();
      return false;
    }

    showTab(currentTab);
  }

  function validateForm() {
    var x, y, i, valid = true;
    x = document.querySelectorAll(".tab");
    y = x[currentTab].querySelectorAll("input");

    for (i = 0; i < y.length; i++) {
      if (y[i].value === "") {
        y[i].classList.add("invalid");
        valid = false;
      } else {
        y[i].classList.remove("invalid");
      }
    }

    if (currentTab === 1) {
      var emailField = document.forms["regForm"]["email"];
      var phoneField = document.forms["regForm"]["phone"];

      if (emailField.value === "" || !emailField.value.includes("@") || !emailField.value.endsWith(".com")) {
        emailField.classList.add("invalid");
        valid = false;
      } else {
        emailField.classList.remove("invalid");
      }

      if (phoneField.value === "" || phoneField.value.length !== 10 || isNaN(phoneField.value)) {
        phoneField.classList.add("invalid");
        valid = false;
      } else {
        phoneField.classList.remove("invalid");
      }
    }

    if (currentTab === 2) {
      var dobField = document.forms["regForm"]["dd"];
      var dobValue = new Date(dobField.value);
      var minDate = new Date("01-01-1900");
      var maxDate = new Date("01-01-2010");

      if (dobField.value === "" || dobValue < minDate || dobValue > maxDate) {
        dobField.classList.add("invalid");
        valid = false;
      } else {
        dobField.classList.remove("invalid");
      }
    }

    if (currentTab === 4) {
      var unameField = document.forms["regForm"]["uname"];
      var pwordField = document.forms["regForm"]["pword"];

      if (unameField.value.length !== 8) {
        unameField.classList.add("invalid");
        valid = false;
      } else {
        unameField.classList.remove("invalid");
      }

      if (pwordField.value.length < 8 || pwordField.value.length > 16) {
        pwordField.classList.add("invalid");
        valid = false;
      } else {
        pwordField.classList.remove("invalid");
      }
    }

    if (valid) {
      document.querySelectorAll(".step")[currentTab].classList.add("finish");
    }

    return valid;
  }

  function fixStepIndicator(n) {
    var i, x = document.querySelectorAll(".step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    x[n].className += " active";
  }

  var prevBtn = document.querySelector("#prevBtn");
  var nextBtn = document.querySelector("#nextBtn");
  var submitBtn = document.querySelector("#submitBtn");

  prevBtn.addEventListener("click", function() {
    nextPrev(-1);
  });

  nextBtn.addEventListener("click", function() {
    nextPrev(1);
  });

  // Real-time validation for email field
  var emailField = document.forms["regForm"]["email"];
  emailField.addEventListener("input", function() {
    if (this.value === "" || !this.value.includes("@") || !this.value.endsWith(".com")) {
      this.classList.add("invalid");
    } else {
      this.classList.remove("invalid");
    }
  });

  // Real-time validation for phone field
  var phoneField = document.forms["regForm"]["phone"];
  phoneField.addEventListener("input", function() {
    if (this.value === "" || this.value.length !== 10 || isNaN(this.value)) {
      this.classList.add("invalid");
    } else {
      this.classList.remove("invalid");
    }
  });

  // Real-time validation for date of birth field
  var dobField = document.forms["regForm"]["dd"];
  dobField.addEventListener("input", function() {
    var dobValue = new Date(this.value);
    var minDate = new Date("01-01-1900");
    var maxDate = new Date("01-01-2010");

    if (this.value === "" || dobValue < minDate || dobValue > maxDate) {
      this.classList.add("invalid");
    } else {
      this.classList.remove("invalid");
    }
  });

  // Real-time validation for username field
  var unameField = document.forms["regForm"]["uname"];
  unameField.addEventListener("input", function() {
    if (this.value.length !== 8) {
      this.classList.add("invalid");
    } else {
      this.classList.remove("invalid");
    }
  });

  // Real-time validation for password field
  var pwordField = document.forms["regForm"]["pword"];
  pwordField.addEventListener("input", function() {
    if (this.value.length < 8 || this.value.length > 16) {
      this.classList.add("invalid");
    } else {
      this.classList.remove("invalid");
    }
  });
});
