<?php 
session_start();
$fina= $_SESSION['fn'];
require_once 'db_conn.php';

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$sql="CREATE TABLE IF NOT EXISTS botany (
    `fname` VARCHAR(50),
    `score` int(3),
    `last_test_taken` date)";

$conn->query($sql);
$botany_answer = [
    '1' => 'Photosynthesis',
    '2' => 'Roots',
    '3' => 'Pistil',
    '4' => 'Transporting nutrients',
    '5' => 'Transpiration',
    '6' => 'Leaves',
    '7' => 'Pollination',
    '8' => 'Vascular tissue',
    '9' => 'Stamen',
    '10' => 'Auxin',
    '11' => 'Vegetative propagation',
    '12' => 'Mesophyll tissue',
    '13' => 'Self-pollination',
    '14' => 'Leaves',
    '15' => 'Vegetative propagation',
    '16' => 'Ethylene',
    '17' => 'Transpiration',
    '18' => 'Germination',
    '19' => 'Mesophyll tissue',
    '20' => 'Phototropism',
    '21' => 'Roots',
    '22' => 'Abscisic acid',
    '23' => 'Meristematic tissue',
    '24' => 'Vascular tissue',
    '25' => 'Pollen germination',
];

$botany_question=[]; // Initialize a variable to keep track of the number of correct answers
$correctAnswers = 0; // Populate the $botany_question array and check for correct answers

for ($i = 1; $i <= 25; $i++) {
    $answerKey = 'answer' . $i;
    $userAnswer = $_POST[$answerKey];
    $botany_question[$i] = $userAnswer;

    // Check if the user's answer matches the correct answer
    if ($userAnswer === $botany_answer[$i]) {
        $correctAnswers++;
    }
}
$totalQuestions = 25;
$t_date=date('Y-m-d');
$score = ($correctAnswers / $totalQuestions) * 100;
echo("Your score is $score");
$sql="INSERT INTO botany values('$fina','$score','$t_date')";
if($conn->query($sql)===true)
{
    $sql_1="UPDATE scores SET botany='$score' WHERE fname='$fina' ";
    $conn->query($sql_1); 
    echo("row inserted ");
}




?>