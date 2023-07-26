<?php
// Include the database connection file
session_start();

$tk = $_SESSION['fn'];


require_once 'db_conn.php';
$query = "SELECT * FROM user_db WHERE firstname = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tk);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $fnn = $row['firstname'];
    $lnn = $row['lastname'];
    $ema = $row['email'];
    $pn = $row['phone'];
    $db = $row['dob'];
    $grd = $row['education'];
    $un = $row['edu_institute'];
    if ($row !== null) {
        // User exists, verify the password
        $storedPassword = $row['pwd'];

        if (password_verify($password, $storedPassword)) {
            // Password is correct, redirect to the desired page
            session_start();
            $_SESSION['fn'] = $row['firstname'];
        }
        
      }


?>
<!DOCTYPE html>
<html>
<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-4WS7B93E00"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-4WS7B93E00');
    </script>
    <script type="text/javascript">
      (function(c,l,a,r,i,t,y){
          c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
          t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
          y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
      })(window, document, "clarity", "script", "i51hbqpqx6");
  </script>
  <title>Settings Page</title>
  <link rel="stylesheet" href="../css/settings.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
</head>
<body>
  <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'tab0')"><h2>General</h2></button>
    <button class="tablinks" onclick="openTab(event, 'tab1')"><h2>Education</h2></button>
    <button class="tablinks" onclick="openTab(event, 'tab2')"><h2>Security</h2></button>
  </div>

  <div id="tab0" class="tabcontent">
    <h3>General Settings</h3>
    <form id="general-form" data-parsley-validate>
      <label for="fname">FirstName:</label>
      <input type="text" id="fname" name="fname" placeholder="<?php echo($fnn); ?>" required data-parsley-trigger="change" data-parsley-required-message="First Name is required.">

      <label for="lname">LastName:</label>
      <input type="text" id="lname" name="lname" placeholder="<?php echo($lnn); ?>" required data-parsley-trigger="change" data-parsley-required-message="Last Name is required.">

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="<?php echo($ema); ?>" required data-parsley-trigger="change" data-parsley-required-message="Email is required." data-parsley-type-message="Please enter a valid email address.">

      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone" placeholder="<?php echo($pn); ?>" required data-parsley-trigger="change" data-parsley-required-message="Phone number is required." data-parsley-pattern="^\d{10}$" data-parsley-pattern-message="Phone number should be 10 digits.">

      <label for="dd">Date: <?php echo($db); ?> </label>
      <input type="date" id="dd" name="dd" placeholder="Enter your date" required data-parsley-trigger="change" data-parsley-required-message="Date of Birth is required." data-parsley-date="true" data-parsley-date-format="YYYY-MM-DD" data-parsley-date-message="Date of Birth should be between 01-01-1900 to 01-01-2010." data-parsley-date-max="2010-01-01" data-parsley-date-min="1900-01-01">

      <div id="error-message-general" class="error-message"></div>

      <button type="button" onclick="submitGeneralForm()">Save</button>
    </form>
  </div>

  <div id="tab1" class="tabcontent">
    <h3>Education</h3>
    <form id="education-form" data-parsley-validate>
      <label for="education">Select category: <?php echo($grd); ?></label>
      <select id="education" name="education" required data-parsley-trigger="change" data-parsley-required-message="Category is required.">
        <option value="">Select an option></option>
        <option value="midschool">Midschool</option>
        <option value="highschool">Highschool</option>
        <option value="ug">Undergraduate</option>
        <option value="pg">Postgraduate</option>
      </select>

      <label for="edu_id">Educational Institute:</label>
      <input type="text" id="edu_id" name="edu_id" placeholder="<?php echo($un); ?>" required data-parsley-trigger="change" data-parsley-required-message="Educational Institute is required.">

      <div id="error-message-education" class="error-message"></div>

      <button type="button" onclick="submitEducationForm()">Save</button>
    </form>
  </div>

  <div id="tab2" class="tabcontent">
    <h3>Security Settings</h3>
    <form id="security-form" data-parsley-validate>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required data-parsley-trigger="change" data-parsley-required-message="Password is required.">

      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required data-parsley-trigger="change" data-parsley-required-message="Confirm Password is required." data-parsley-equalto="#password" data-parsley-equalto-message="Passwords do not match.">

      <div id="error-message-security" class="error-message"></div>

      <button type="button" onclick="submitSecurityForm()">Save</button>
    </form>
  </div>

  <script src="../script/settings.js"></script>
  <script src="../script/validation.js"></script>
  <script src="../script/submitForm.js"></script>
</body>
</html>
