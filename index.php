<?php
// Establish database connection (adjust these values according to your database configuration)
require_once 'php/db_conn.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_db_creation="CREATE DATABASE IF NOT EXISTS shine";
$sql_tb_creation="CREATE TABLE IF NOT EXISTS user_db (
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(50) PRIMARY KEY,
    phone VARCHAR(50),
    dob DATE,
    education VARCHAR(50),
    Addr VARCHAR(100),
    username VARCHAR(50) UNIQUE,
    pwd VARCHAR(200),
    created_at TIMESTAMP
)";
$conn->select_db('astaverse');
$conn->query($sql_db_creation);
$conn->query($sql_tb_creation);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astaverse</title>
    <link rel="icon" href="assets/icons/art.png">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <table class="table1">
    <tr>
        <td class="td1">
            <img src="assets/icons/art.png" alt="icon">
        </td>
        <td class="td1">
            <h1 class="hea">Astaverse </h1>
        </td>
        <td class="td1">
            <nav>
                <ul>
                    
                    <li class="dropdown">
                        <a href="#"><img src="assets/icons/mail.png" class="ico" alt="phone"></a>
                        <div class="dropdown-content">
                            <a href="mailto:smarterthannewton@gmail.com">Customer Service : customersupport@asti.com </a>
                        </div>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#"><img src="assets/icons/user.png" class="ico" alt="user"></a>
                        <div class="dropdown-content">
                        <a href="html/signup.html"><img src="assets/icons/signup.png" class="ico" > Signup </a>
                        <a href="html/login.html"><img src="assets/icons/login.png" class="ico" > Login </a>
                        </div>
                    </li>
                    
                </ul>
                </nav>
        </td>
    </tr>    
    </table>
    <br>
    <br>
    <div>
        <table class="table1 table2">
            <tr>
                <th class="th1"> <h2> <b> What is Astaverse ?</b></h2></th>
                <th class="th1"> <h2> <b> Why Astaverse? </b></h2></th>
                <th class="th1"> <h2> <b> How we Work? </b></h2></th>
            </tr>
            <tr>
                <td class="td1"> <p> Astaverse is an online platform focusing on learn stem subjects, Our Idea is to introduce concepts of early stem conepts to children of age 7 and above</p></td>
                <td class="td1"> <p> Astaverse is an Indian company run by teachers,grad students and professors providing students with better understanding of STEM concepts.</p></td>
                <td class="td1"> <p> Unlike other online platforms, we encourage our students to experiment with scientific concepts and teach them new concepts using practical and real life examples. </p></td>
            </tr>
        </table>
        <br>
    <br>
    </div>
    
    <div>
        <h2> What is STEM ?</h2><br>
        <p> STEM stands for Science, Technology, Engineering, and Mathematics. STEM subjects refer to academic disciplines that focus on these four areas of study. Here's a brief overview of each STEM subject:</p><br>
        <ol>
            <li class="oli"><b>Science: </b> Science involves the study of the natural world, including physical, biological, and environmental sciences. It encompasses subjects such as physics, chemistry, biology, astronomy, geology, and more.
            </li>
            <li class="oli"><b>Technology: </b> Technology refers to the application of scientific knowledge for practical purposes. It includes the study of computer science, information technology, software development, data analysis, electronics, telecommunications, and other related fields.
            </li>
            <li class="oli"><b>Engineering: </b> Engineering involves the application of scientific and mathematical principles to design, develop, and build structures, systems, machines, and processes. It covers disciplines such as civil engineering, mechanical engineering, electrical engineering, chemical engineering, aerospace engineering, and more.
            </li>
            <li class="oli"><b>Mathematics: </b> Mathematics is the study of numbers, quantity, structure, space, and patterns. It includes areas such as algebra, geometry, calculus, statistics, probability, number theory, and mathematical modeling.
            </li>
        </ol>
        
        <p>
            STEM subjects are often interconnected, and they play a crucial role in driving innovation, technological advancements, and scientific discoveries. They provide a foundation for various career paths, from scientific research and engineering to computer programming and data analysis.
            
            STEM education emphasizes problem-solving, critical thinking, creativity, and collaboration skills. It aims to prepare students with a strong foundation in these subjects to meet the demands of a rapidly evolving world driven by technology and scientific advancements.</p>
        </p>
    </div>


    <div class="grid-container">
        <div class="grid-item">
            <img src="assets/products/Science/physics.png" alt="physics">
            <h1> Physics </h1> 
        </div>
        <div class="grid-item">
            <img src="assets/products/Science/chemistry.png" alt="chemistry">
            <h1> Chemistry </h1>
        </div>
        <div class="grid-item">
            <img src="assets/products/Science/botany.png" alt="botany">
            <h1> Botany </h1>
        </div>
        <div class="grid-item">
            <img src="assets/products/Science/zoology.png" alt="zoology">
            <h1> Zoology </h1>
        </div>
        <div class="grid-item">
            <img src="assets/products/Technology/technology.png" alt="technology">
            <h1> Technology </h1>
        </div>
        <div class="grid-item">
            <img src="assets/products/Engineering/engineering.png" alt="engineering">
            <h1> Engineering </h1>
        </div>
        <div class="grid-item">
            <img src="assets/products/Maths/maths.png" alt="maths">
            <h1> Mathematics </h1>
        </div>
    </div>
    
</body>
</html>