document.addEventListener("DOMContentLoaded", function() {
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
  
    function showTab(n) {
      var x = document.querySelectorAll(".tab");
      x[n].style.display = "block";
  
      var prevBtn = document.querySelector("#prevBtn");
      var nextBtn = document.querySelector("#nextBtn");
  
      if (n == 0) {
        prevBtn.style.display = "none";
      } else {
        prevBtn.style.display = "inline";
      }
  
      if (n == (x.length - 1)) {
        nextBtn.innerHTML = "Submit";
      } else {
        nextBtn.innerHTML = "Next";
      }
  
      fixStepIndicator(n);
    }
  
    function nextPrev(n) {
      var x = document.querySelectorAll(".tab");
      if (n == 1 && !validateForm()) return false;
  
      x[currentTab].style.display = "none";
      currentTab = currentTab + n;
  
      if (currentTab >= x.length) {
        event.preventDefault(); // Prevent form submission
        document.getElementById("regForm").submit();
        return false;
      }
  
      showTab(currentTab);
    }
  
    function validateForm() {
      var x, y, i, valid = true;
      x = document.querySelectorAll(".tab");
      y = x[currentTab].getElementsByTagName("input");
  
      for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
          y[i].className += " invalid";
          valid = false;
        }
      }
  
      if (valid) {
        document.querySelectorAll(".step")[currentTab].className += " finish";
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
  
    prevBtn.addEventListener("click", function() {
      nextPrev(-1);
    });
  
    nextBtn.addEventListener("click", function() {
      nextPrev(1);
    });
  });
  