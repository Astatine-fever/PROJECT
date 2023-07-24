<?php 
session_start();
$fina= $_SESSION['fn'];
require_once 'db_conn.php';
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$sql="CREATE TABLE IF NOT EXISTS zoology (
    `fname` VARCHAR(50),
    `score` int(3),
    `last_test_taken`date)";

$conn->query($sql);
$zoology_answer = [
    '1' => 'Dolphin',
    '2' => 'Arthropoda',
    '3' => 'Snake',
    '4' => 'Chordata',
    '5' => 'Kangaroo',
    '6' => 'Aves',
    '7' => 'Blue Whale',
    '8' => 'Frog',
    '9' => 'Arthropoda',
    '10' => 'Crocodile',
    '11' => 'Echinodermata',
    '12' => 'Kangaroo',
    '13' => 'Actinopterygii',
    '14' => 'Lion',
    '15' => 'Salmon',
    '16' => 'Orangutan',
    '17' => 'Aves',
    '18' => 'Whale',
    '19' => 'Mollusca',
    '20' => 'Raccoon',
    '21' => 'Reptilia',
    '22' => 'Elephant',
    '23' => 'Chordata',
    '24' => 'Opossum',
    '25' => 'Mammalia'
];

$zoology_question=[]; // Initialize a variable to keep track of the number of correct answers
$correctAnswers = 0; // Populate the $zoology_question array and check for correct answers
for ($i = 1; $i <= 25; $i++) 
{
    $answerKey = 'answer' . $i;
    $userAnswer = $_POST[$answerKey];
    $zoology_question[$i] = $userAnswer;

    // Check if the user's answer matches the correct answer
    if ($userAnswer === $zoology_answer[$i]) 
    {
        $correctAnswers++;
    }
}
$totalQuestions = 25;
$t_date=date('Y-m-d');
$score = ($correctAnswers / $totalQuestions) * 100;
echo("Your score is $score");
$sql="INSERT INTO zoology values('$fina','$score','$t_date')";
if($conn->query($sql)===true)
{
    echo("row inserted ");
}
?>