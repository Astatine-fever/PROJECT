<?php
// Include the database connection file
session_start();
require_once('../php/db_conn.php');


$firstname_array = $_SESSION['firstname_array'];
$lastname_array = $_SESSION['lastname_array'];
$total_unique_users = count(array_unique($firstname_array));
// Scores data (assuming these are your $_SESSION arrays)
$subjects = array(
  'physics' => $_SESSION['physics_array'],
  'chemistry' => $_SESSION['chemistry_array'],
  'botany' => $_SESSION['botany_array'],
  'zoology' => $_SESSION['zoology_array'],
  'technology' => $_SESSION['technology_array'],
  'engineering' => $_SESSION['engineering_array'],
);


function generateUserTableRows($firstnames, $lastnames)
{
  $tableRows = '';
  $totalUsers = count($firstnames); // Assuming both arrays have the same length
  for ($i = 0; $i < $totalUsers; $i++) {
    $tableRows .= "<tr><td>{$firstnames[$i]}</td><td>{$lastnames[$i]}</td></tr>";
  }
  return $tableRows;
}

$query = "SELECT fname, (physics + chemistry + botany + zoology + technology + engineering) AS total_score FROM scores ORDER BY total_score DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result) {
  $row = mysqli_fetch_assoc($result);

  if ($row) {
    // Step 2: Get the first name and last name of the user with the highest score
    $highest_score_first_name = $row['fname'];
    $highest_score_total_score = $row['total_score'];

    // Fetch the last name of the user from the user_db table based on their first name
    $user_query = "SELECT lastname FROM user_db WHERE firstname = '$highest_score_first_name'";
    $user_result = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);

    $highest_score_last_name = $user_row['lastname'];
  }
}

function findHighestScore($subject, $scores, $firstnames, $lastnames)
{
  // Check if $scores is an array
  if (!is_array($scores)) {
    return ['highest_score' => 0, 'highest_score_user' => ''];
  }

  for ($i = 0; $i < count($scores); $i++) {
    if ($scores[$i][$subject] > $highest_score) {
      $highest_score = $scores[$i][$subject];
      $highest_score_user = $firstnames[$i] . ' ' . $lastnames[$i];
    }
  }

  return ['highest_score' => $highest_score, 'highest_score_user' => $highest_score_user];
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    @font-face {
      font-family: urban;
      src: url(../assets/fonts/urbanist.ttf);
    }

    @font-face {
      font-family: wo;
      src: url(../assets/fonts/wireone.ttf);
    }

    @font-face {
      font-family: dba;
      src: url(../assets/fonts/darbots.otf);
    }


    /* Text Styling*/
    h1 {
      font-family: urban;
      text-align: center;
      margin-top: 0;
    }

    h2 {
      font-family: dba;
      font-size: 2vw;
      color: black;
    }

    h3 {
      font-family: urban;
    }

    /* CSS for vertical tabs */
    .tab {
      overflow: hidden;
      border-radius: 5px;
      background-color: #f1f1f1;
      width: 200px;
      float: left;
    }

    .tab button {
      background-color: inherit;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 10px 16px;
      transition: background-color 0.3s;
      width: 100%;
      text-align: left;
    }

    .tab button:hover {
      background-color: #8fb2ff;
    }

    .tab button.active {
      background-color: rgb(253, 217, 14);
      filter: invert(1);
    }

    .tabcontent {
      display: none;
      float: left;
      padding: 20px;
      width: 80%;
      border-left: none;
      height: 300px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-family: urban;
    }

    /* Media query for mobile devices */
    @media only screen and (max-width: 700px) {
      .tab {
        width: 100%;
        display: flex;
        flex-direction: row;
        overflow-x: auto;
      }

      .tab button {
        flex: 1;
        white-space: nowrap;
      }
    }

    /* Grid */
    .grid-container {
      display: grid;
      border-radius: 25px;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      grid-gap: 10px;
    }

    /* Style for grid items */
    .grid-item {
      border-radius: 25px;
      padding: 20px;
      text-align: center;
    }

    /* Style for grid items on hover */
    .grid-item:hover {
      border-color: black;
      background-color: rgb(253, 217, 14);
      filter: invert(1);
    }

    /* ... Your existing CSS styles ... */

    /* Style for the container that wraps the user table */
    .grid-item table {
      width: 100%;
      /* Make the table take up the full width of the container */
      border-collapse: collapse;
      margin: 0 auto;
      /* Center the table horizontally */
    }

    /* Style for the table header */
    .grid-item table thead tr {
      background-color: #f1f1f1;
    }

    /* Style for the table cells (header and data) */
    .grid-item table th,
    .grid-item table td {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      text-align: center;
      font-family: urban;
      /* Apply the 'urban' font-family to the table cells */
    }

    /* Style for alternating rows */
    .grid-item table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }


/* Style for tables */
.table1 {
  border-collapse: collapse !important;
  border-spacing: 0 !important;
  width: 100% !important;
  border-radius: 10px !important;
  border:none !important;
}



/* Style for table headers and cells */
.th1,
.td1 {
  text-align: left !important;
  padding: 8px !important;
}



    /* Common styles for the table */
.table2 {
  width: 100%;
  border-collapse: collapse;
  margin: 0 auto;
  /* Center the table horizontally */
}

/* Style for the table header */
.thead2 .tr2 {
  background-color: #f1f1f1;
}

/* Style for the table cells (header and data) */
.th2,
.td2 {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  text-align: center;
  font-family: urban;
  font-size: 2vw;
  /* Apply the 'urban' font-family to the table cells */
}

/* Style for alternating rows */
.tbody2 .tr2:nth-child(even) {
  background-color: #f9f9f9;
}

img {
  border: 2px;
  width: 5vw;
  height: 5vw;
}

/* Responsive styles for the table */
@media screen and (max-width: 768px) {
  /* Adjust table cells for smaller screens */
  .th2,
  .td2 {
    padding: 5px; /* Reduce padding for smaller screens */
    font-size: 1.5vw; /* Reduce font size for smaller screens */
  }
}

@media screen and (max-width: 480px) {
  /* Further adjust table cells for even smaller screens */
  .th2,
  .td2 {
    padding: 2px; /* Reduce padding for smaller screens */
    font-size: 1.5vw; /* Reduce font size for smaller screens */
  }
}

  </style>


</head>

<body>
<table class="table1">
    <tr>
        <td class="td1">
            <img src="../assets/icons/art.png" alt="logo">
        </td>
        <td class="td1">
            <h1 class="hea">Dashboard </h1>
        </td>
        <td class="td1">
            <img src="../assets/icons/logout.png" onclick="logout()" alt="logout">
        </td>
    </tr>    
    </table>

  <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'tab0')">
      <h2>USERS</h2>
    </button>
    <button class="tablinks" onclick="openTab(event, 'tab1')">
      <h2>TESTS</h2>
    </button>
    <button class="tablinks" onclick="openTab(event, 'tab2')">
      <h2>DATA CHARTS</h2>
    </button>
  </div>

  <div id="tab0" class="tabcontent">
    <div class="grid-container">
      <div class="grid-item">
        <h2> Total Number of UserS </h2><br>
        <h1>
          <?php echo ($total_unique_users); ?> / 100
        </h1>
      </div>
      <div class="grid-item ">
        <h2> All Users' Names </h2><br>
        <table>
          <thead>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
            </tr>
          </thead>
          <tbody>
            <?php echo generateUserTableRows($firstname_array, $lastname_array); ?>
          </tbody>
        </table>
      </div>
      <div class="grid-item ">
        <h2> User LIST Rankwise </h2><br>
        <h1>
          <?php
          echo "<div class='grid-item'>";
          echo "<h2> Highest Score </h2><br>";
          echo "<h1> {$highest_score_first_name} {$highest_score_last_name}</h1>";
          echo "</div>";
          ?>
        </h1>
      </div>

    </div>

  </div>

  <div id="tab1" class="tabcontent">
    <h1 align="center"> Exam Scores </h1><br>
    <table class="table2">
      <thead class="thead2">
        <tr class="tr2">
          <th class="th2">First Name</th>
          <th class="th2">Last Name</th>
          <th class="th2">Physics</th>
          <th class="th2">Chemistry</th>
          <th class="th2">Botany</th>
          <th class="th2">Zoology</th>
          <th class="th2">Engineering</th>
          <th class="th2">Technology</th>
        </tr>
      </thead>
      <tbody class="tbody2">
        <?php
        // Get the unique users from user_db
        $uniqueUsers = array_unique(array_combine($_SESSION['firstname_array'], $_SESSION['lastname_array']));

        foreach ($uniqueUsers as $firstName => $lastName) {
          echo '<tr class="tr2">';
          echo '<td class="td2">' . $firstName . '</td>';
          echo '<td class="td2">' . $lastName . '</td>';
          echo '<td class="td2">' . getScore($firstName, $lastName, 'Physics') . '</td>';
          echo '<td class="td2">' . getScore($firstName, $lastName, 'Chemistry') . '</td>';
          echo '<td class="td2">' . getScore($firstName, $lastName, 'Botany') . '</td>';
          echo '<td class="td2">' . getScore($firstName, $lastName, 'Zoology') . '</td>';
          echo '<td class="td2">' . getScore($firstName, $lastName, 'Engineering') . '</td>';
          echo '<td class="td2">' . getScore($firstName, $lastName, 'Technology') . '</td>';
          echo '</tr>';
        }

        function getScore($firstName, $lastName, $subject)
        {
          // Retrieve the session variable for the specified subject
          $subjectScores = $_SESSION[strtolower($subject) . '_array'];

          // Find the index of the user in the first name and last name arrays
          $index = array_search($firstName, $_SESSION['firstname_array']);

          // Check if the user exists in the array
          if ($index !== false && $_SESSION['lastname_array'][$index] === $lastName) {
            // Return the score for the specified subject
            return $subjectScores[$index];
          }

          // If the user does not have a score for the specified subject, return a default value
          return 'N/A';
        }
        ?>
      </tbody>
    </table>
  </div>

  <div id="tab2" class="tabcontent">
    <h3>DATA ANALYSIS</h3>

  </div>

  <script>
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

    <!-- JavaScript to generate the bar charts -->

document.addEventListener("DOMContentLoaded", function () {
  // Function to calculate the average score for a given subject
  function calculateAverage(scores) {
    var total = scores.reduce(function (acc, score) {
      return acc + score;
    }, 0);
    return (total / scores.length).toFixed(2);
  }

  // Function to calculate the total score for a given subject
  function calculateTotal(scores) {
    return scores.reduce(function (acc, score) {
      return acc + score;
    }, 0);
  }

  // Get the unique users from user_db
  var uniqueUsers = <?php echo json_encode(array_values(array_unique(array_map(function($first, $last) { return $first . ' ' . $last; }, $_SESSION['firstname_array'], $_SESSION['lastname_array'])))); ?>;

  // Get the scores for each subject
  var physicsScores = <?php echo json_encode($_SESSION['physics_array']); ?>;
  var chemistryScores = <?php echo json_encode($_SESSION['chemistry_array']); ?>;
  var botanyScores = <?php echo json_encode($_SESSION['botany_array']); ?>;
  var zoologyScores = <?php echo json_encode($_SESSION['zoology_array']); ?>;
  var engineeringScores = <?php echo json_encode($_SESSION['engineering_array']); ?>;
  var technologyScores = <?php echo json_encode($_SESSION['technology_array']); ?>;

  // Create a dataset for subject scores
  var datasets = [
    { label: "Physics", data: physicsScores, backgroundColor: "rgba(54, 162, 235, 0.8)" },
    { label: "Chemistry", data: chemistryScores, backgroundColor: "rgba(255, 99, 132, 0.8)" },
    { label: "Botany", data: botanyScores, backgroundColor: "rgba(75, 192, 192, 0.8)" },
    { label: "Zoology", data: zoologyScores, backgroundColor: "rgba(255, 206, 86, 0.8)" },
    { label: "Engineering", data: engineeringScores, backgroundColor: "rgba(153, 102, 255, 0.8)" },
    { label: "Technology", data: technologyScores, backgroundColor: "rgba(255, 159, 64, 0.8)" }
  ];

  // Create the bar chart for subject scores
  var ctx = document.createElement("canvas").getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: uniqueUsers.map(function (user) {
        return user.split(' ')[0]; // Extract the first name
      }),
      datasets: datasets
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: true,
        position: "top"
      },
      scales: {
        x: {
          stacked: true,
          grid: {
            display: false
          }
        },
        y: {
          stacked: true,
          grid: {
            display: true,
            color: "rgba(0, 0, 0, 0.1)"
          }
        }
      }
    }
  });

  // Append the chart to the "tab2" div
  var tab2 = document.getElementById("tab2");
  tab2.appendChild(ctx.canvas);

  // Function to create and append the bar chart to a given container
  function appendBarChart(containerId, chartData, chartLabel) {
    var container = document.getElementById(containerId);
    var chartCtx = document.createElement("canvas").getContext("2d");
    var chart = new Chart(chartCtx, {
      type: "bar",
      data: {
        labels: ["Physics", "Chemistry", "Botany", "Zoology", "Engineering", "Technology"],
        datasets: [
          {
            label: chartLabel,
            data: chartData,
            backgroundColor: "rgba(54, 162, 235, 0.8)"
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: true,
          position: "top"
        },
        scales: {
          x: {
            stacked: true,
            grid: {
              display: false
            }
          },
          y: {
            stacked: true,
            grid: {
              display: true,
              color: "rgba(0, 0, 0, 0.1)"
            }
          }
        }
      }
    });

    container.appendChild(chartCtx.canvas);
  }

  // Get the average scores for each subject
  var averagePhysics = calculateAverage(<?php echo json_encode($_SESSION['physics_array']); ?>);
  var averageChemistry = calculateAverage(<?php echo json_encode($_SESSION['chemistry_array']); ?>);
  var averageBotany = calculateAverage(<?php echo json_encode($_SESSION['botany_array']); ?>);
  var averageZoology = calculateAverage(<?php echo json_encode($_SESSION['zoology_array']); ?>);
  var averageEngineering = calculateAverage(<?php echo json_encode($_SESSION['engineering_array']); ?>);
  var averageTechnology = calculateAverage(<?php echo json_encode($_SESSION['technology_array']); ?>);

  // Create and append the chart for average scores
  appendBarChart("tab2", [averagePhysics, averageChemistry, averageBotany, averageZoology, averageEngineering, averageTechnology], "Average Scores");

  // Get the total scores for each subject
  var totalPhysics = calculateTotal(<?php echo json_encode($_SESSION['physics_array']); ?>);
  var totalChemistry = calculateTotal(<?php echo json_encode($_SESSION['chemistry_array']); ?>);
  var totalBotany = calculateTotal(<?php echo json_encode($_SESSION['botany_array']); ?>);
  var totalZoology = calculateTotal(<?php echo json_encode($_SESSION['zoology_array']); ?>);
  var totalEngineering = calculateTotal(<?php echo json_encode($_SESSION['engineering_array']); ?>);
  var totalTechnology = calculateTotal(<?php echo json_encode($_SESSION['technology_array']); ?>);

  // Create and append the chart for total scores
  appendBarChart("tab2", [totalPhysics, totalChemistry, totalBotany, totalZoology, totalEngineering, totalTechnology], "Total Scores");
});

function logout() 
        {
            // Send a request to the logout.php file using Fetch API
            fetch("admin_logout.php")
            .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Handle the response here if needed
            // For example, you can redirect the user to the login page after successful logout
            window.location.href = "admin_login.html"; // Replace "login.php" with the page you want to redirect to
            })
            .catch(error => {
            // Handle errors or other status codes here
            });
        }
</script>

</body>

</html>