function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    // Hide all tab content
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    // Remove the 'active' class from all tab buttons
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // Display the selected tab content and add the 'active' class to the button
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }