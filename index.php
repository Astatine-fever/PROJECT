<?php
// Establish database connection (adjust these values according to your database configuration)
require_once 'php/db_conn.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL queries for database and table creation
$sql_db_creation = "CREATE DATABASE IF NOT EXISTS shine";
$sql_tb_creation = "CREATE TABLE IF NOT EXISTS enquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    phone VARCHAR(50),
    dob DATE,
    education VARCHAR(50),
    addr VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Select the 'shine' database
$conn->select_db('shine');

// Execute database and table creation queries
$conn->query($sql_db_creation);
$conn->query($sql_tb_creation);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHINE IT EDUCATION</title>
    <link rel="icon" href="assets/icons/art.png">
    <link rel="stylesheet" href="css/home.css">
    <!-- Include JavaScript file -->
    <script src="../tcps/script/button_drop.js"></script>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="assets/icons/art.png" alt="icon">
            <h1 class="hea">SHINE IT EDUCATION</h1>
        </div>
        <nav>
            <ul class="navigation">
                <li class="dropdown">
                    <a href="#"><img src="assets/icons/menu.png" class="ico" alt="user"></a>
                    <div class="dropdown-content">
                        <a href="html/signup.html">Courses</a>
                        <a href="html/login.html">About us</a>
                        <a href="html/login.html">Contact us</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <table class="table1 table2">
                <tr>
                    <th class="th1"><h2><b>What is Astaverse?</b></h2></th>
                    <th class="th1"><h2><b>Why Astaverse?</b></h2></th>
                    <th class="th1"><h2><b>How we Work?</b></h2></th>
                </tr>
                <tr>
                    <td class="td1"><p>Astaverse is an online platform focusing on learning STEM subjects. Our idea is to introduce STEM concepts to children aged 7 and above.</p></td>
                    <td class="td1"><p>Astaverse is an Indian company run by teachers, grad students, and professors, providing students with a better understanding of STEM concepts.</p></td>
                    <td class="td1"><p>Unlike other online platforms, we encourage our students to experiment with scientific concepts and teach them new concepts using practical and real-life examples.</p></td>
                </tr>
            </table>
        </section>

        <section>
            <h2>What is STEM?</h2>
            <p>STEM stands for Science, Technology, Engineering, and Mathematics. STEM subjects refer to academic disciplines that focus on these four areas of study.</p>
            <!-- More content here -->
        </section>

        <section class="grid-container">
            <!-- Course grid items -->
        </section>
    </main>
</body>
</html>
