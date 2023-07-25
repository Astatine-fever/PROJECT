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
    `maths` int(3),
    `botany` int(3),
    `zoology` int(3),
    `technology` int(3),
    `engineering` int(3))";

$conn->query($sql);



?>
<!DOCTYPE html>
<html lang="en">
<head>
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
        <a href="../source/computer_learning.html"><img src="../assets/products/Technology/technology.png" alt="technology"></a>
            <h1> Technology </h1>
        </div>
        <div class="grid-item grid-item-tooltip">
            <img src="../assets/products/Engineering/engineering.png" alt="engineering">
            <h1> Engineering </h1>
        </div>
        <div class="grid-item grid-item-tooltip">
            <img src="../assets/products/Maths/maths.png" alt="maths">
            <h1> Mathematics </h1>
        </div>
    </div>

    <!-- Details Section -->
    <section class="details">
        <p>Time Spent on Site: 2 hours</p>
        <p>Dashboard Features:</p>
        <ul>
            <li>Feature 1</li>
            <li>Feature 2</li>
            <li>Feature 3</li>
        </ul>
    </section>
</body>
</html>
