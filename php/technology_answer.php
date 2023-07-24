<?php 
session_start();
$fina= $_SESSION['fn'];
require_once 'db_conn.php';
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$sql="CREATE TABLE IF NOT EXISTS computer (
    `fname` VARCHAR(50),
    `score` int(3),
    `last_test_taken`date)";

$conn->query($sql);
$computer_answer = [
    '1' => 'Central Processing Unit',
    '2' => 'CPU',
    '3' => 'Cascade Style Sheets',
    '4' => '1010',
    '5' => 'Random Access Memory',
    '6' => 'JavaScript',
    '7' => 'Stack',
    '8' => 'Manage hardware components',
    '9' => 'Debugging',
    '10' => 'HTTPS',
    '11' => 'Hyper Text Markup Language',
    '12' => 'Compiling',
    '13' => 'Character',
    '14' => '11001',
    '15' => 'Structured Query Language',
    '16' => 'Merge Sort',
    '17' => 'Encapsulation',
    '18' => 'LAN',
    '19' => 'Penetration Testing',
    '20' => 'Linked List',
    '21' => 'Decomposition',
    '22' => 'Stack',
    '23' => 'Functional Programming',
    '24' => 'Two',
    '25' => 'While Loop',
];

$computer_question=[]; // Initialize a variable to keep track of the number of correct answers
$correctAnswers = 0;  // Populate the $computer_question array and check for correct answers
for ($i = 1; $i <= 25; $i++) 
{
    $answerKey = 'answer' . $i;
    $userAnswer = $_POST[$answerKey];
    $computer_question[$i] = $userAnswer;

    // Check if the user's answer matches the correct answer
    if ($userAnswer === $computer_answer[$i]) 
    {
        $correctAnswers++;
    }
}
$totalQuestions = 25;
$t_date=date('Y-m-d');
$score = ($correctAnswers / $totalQuestions) * 100;
echo("Your score is $score");
$sql="INSERT INTO computer values('$fina','$score','$t_date')";
if($conn->query($sql)===true)
{
    echo("row inserted ");
}
?>