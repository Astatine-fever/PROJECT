<?php
session_start();
$fn = $_SESSION['fn'];
require_once 'db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql="CREATE TABLE IF NOT EXISTS scores (
    `fname` VARCHAR(50),
    `physics` int(3),
    `chemistry` int(3), 
    `botany` int(3),
    `zoology` int(3),
    `technology` int(3),
    `engineering` int(3))";

$conn->query($sql);

$sql = " CREATE TABLE IF NOT EXISTS course_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(100) NOT NULL,
    most_visited_tab VARCHAR(50) NOT NULL,
    least_visited_tab VARCHAR(50) NOT NULL,
    allpagevisited BOOLEAN NOT NULL,
    most_visit_number INT NOT NULL,
    least_visit_number INT NOT NULL,
    UNIQUE KEY unique_fname (fname)
)";

$conn->query($sql);


$query = "SELECT * FROM scores WHERE fname = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $fn);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row !== null) 
{
    
    $_SESSION['phy'] = $row['physics'];
    $_SESSION['chem'] = $row['chemistry'];
    $_SESSION['engg'] = $row['engineering'];
    $_SESSION['bot'] = $row['botany'];
    $_SESSION['zoo'] = $row['zoology'];
    $_SESSION['tech'] = $row['technology'];
}
?>
<!DOCTYPE html>
<html lang="en">
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astaverse</title>
    <link rel="icon" href="../assets/icons/art.png">
    <link rel="stylesheet" href="../css/hps.css">
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="logo">
            <img src="../assets/icons/art.png" alt="Company Logo" class="company_icon">
            <h1 class="heb"> Hi <?php echo($fn); ?> !!! </h1>
        </div>
        <div class="icons">
        <nav>
                <ul>
                    <li class="dropdown">
                        <a href="settings.php"><img src="../assets/icons/settings.png" class="ico" alt="settings"></a>
                    </li>  
                    
                    <li class="dropdown">
                        <a href="#"><img src="../assets/icons/logout.png" onclick="logout()" class="ico" alt="logout"></a>
                    </li>

                    <li class="dropdown">
                        <a href="settings.php"><img src="../assets/icons/test.png" class="ico" alt="settings"></a>
                        <div class="dropdown-content">
                            <a href="../test/botany_test.html"> Botany MCQ TEST  </a>
                            <a href="../test/chemistry_test.html"> Chemistry MCQ TEST  </a>
                            <a href="../test/engineering_test.html"> Engineering MCQ TEST  </a>
                            <a href="../test/physics_test.html"> Physics MCQ TEST  </a>
                            <a href="../test/technology_test.html"> Technology MCQ TEST  </a>
                            <a href="../test/zoology_test.html"> Zoology MCQ TEST  </a>
                        </div>
                    </li>
                    
                </ul>
                </nav>
</div>
    </header>

    <!-- Main Content Section -->
    <div class="grid-container">
        <div class="grid-item grid-item-tooltip">
            <a href="physics.php">
                <img src="../assets/products/Science/physics.png" alt="physics">
                </a>
                <h1> Physics </h1> 
        </div>
        <div class="grid-item grid-item-tooltip">
            <img src="../assets/products/Science/chemistry.png" alt="chemistry">
            <h1> Chemistry </h1>
        </div>
        <div class="grid-item grid-item-tooltip">
            <img src="../assets/products/Science/botany.png" alt="botany">
            <h1> Botany </h1>
        </div>
        <div class="grid-item grid-item-tooltip">
            <img src="../assets/products/Science/zoology.png" alt="zoology">
            <h1> Zoology </h1>
        </div>
        <div class="grid-item">
        <a href="../source/computer_learning.php"><img src="../assets/products/Technology/technology.png" alt="technology"></a>
            <h1> Technology </h1>
        </div>
        <div class="grid-item grid-item-tooltip">
            <img src="../assets/products/Engineering/engineering.png" alt="engineering">
            <h1> Engineering </h1>
        </div>
    </div>
    <!-- Details Section -->
    <section class="details">
        <h1 align="center" > Exam Scores  </h1><br>
    <div class="grid-container">
        <div class="grid-item">
           <h2> Botany  </h2><br>
           <h1> <?php echo($_SESSION['bot']);?> / 100</h1>
        </div>
        <div class="grid-item ">
            <h2> Zoology </h2><br>
            <h1> <?php echo($_SESSION['zoo']);?> / 100</h1>
        </div>
        <div class="grid-item ">
            <h2> Chemistry </h2><br>
            <h1> <?php echo($_SESSION['chem']);?> / 100 </h1>
        </div>
        <div class="grid-item">
           <h2> Physics </h2><br>
           <h1> <?php echo($_SESSION['phy']);?> / 100</h1>
          
        </div>
        <div class="grid-item ">
            <h2> Technology </h2><br>
            <h1> <?php echo($_SESSION['tech']);?> / 100</h1>
        </div>
        <div class="grid-item ">
            <h2> Engineering </h2><br>
            <h1> <?php echo($_SESSION['engg']);?> / 100</h1>
        </div>
        
    </div>
    </section>
    <script>
        function logout() 
        {
            // Send a request to the logout.php file using Fetch API
            fetch("../php/logout.php")
            .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Handle the response here if needed
            // For example, you can redirect the user to the login page after successful logout
            window.location.href = "../html/login.html"; // Replace "login.php" with the page you want to redirect to
            })
            .catch(error => {
            // Handle errors or other status codes here
            });
        }
    </script>
</body>
</html>
