<?php 
session_start();
$fina= $_SESSION['fn'];
require_once 'db_conn.php';
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$sql="CREATE TABLE IF NOT EXISTS chemistry (
    `fname` VARCHAR(50),
    `score` int(3),
    `last_test_taken`date)";

$conn->query($sql);
$chemistry_answer = [
    '1' => 'Hydrogen',
    '2' => 'H2O',
    '3' => 'Proton',
    '4' => 'Hydrogen sulfide',
    '5' => 'Au',
    '6' => 'Condensation',
    '7' => '7',
    '8' => 'Chlorine',
    '9' => 'CO2',
    '10' => 'Helium',
    '11' => 'Atom',
    '12' => 'Vaporization',
    '13' => 'Calcite',
    '14' => 'CH4',
    '15' => 'Fe',
    '16' => 'Oxygen',
    '17' => 'NaCl',
    '18' => 'Covalent bond',
    '19' => 'Sublimation',
    '20' => 'Hydrochloric acid',
    '21' => 'Deposition',
    '22' => 'Carbon dioxide',
    '23' => 'H2SO4',
    '24' => 'Freezing',
    '25' => 'Oxygen'
];

$chemistry_question=[];  // Initialize a variable to keep track of the number of correct answers
$correctAnswers = 0;  // Populate the $chemistry_question array and check for correct answers
for ($i = 1; $i <= 25; $i++) 
{
    $answerKey = 'answer' . $i;
    $userAnswer = $_POST[$answerKey];
    $chemistry_question[$i] = $userAnswer;

    // Check if the user's answer matches the correct answer
    if ($userAnswer === $chemistry_answer[$i]) 
    {
        $correctAnswers++;
    }
}
$totalQuestions = 25;
$t_date=date('Y-m-d');
$score = ($correctAnswers / $totalQuestions) * 100;
echo("Your score is $score");
$sql="INSERT INTO chemistry values('$fina','$score','$t_date')";
if($conn->query($sql)===true)
{
    echo("row inserted ");
}
?>