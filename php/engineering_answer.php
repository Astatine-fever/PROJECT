<?php 
session_start();
$fina= $_SESSION['fn'];
require_once 'db_conn.php';
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$sql="CREATE TABLE IF NOT EXISTS engg (
    `fname` VARCHAR(50),
    `score` int(3),
    `last_test_taken`date)";

$conn->query($sql);

$engg_answer = [
    
    '1' => 'To change the direction or magnitude of a force',
    '2' => 'To regulate current flow',
    '3' => 'Mimicking natural processes and structures in engineering',
    '4' => 'Light energy to electrical energy',
    '5' => 'Lever',
    '6' => 'Light Emitting Diode',
    '7' => 'Measuring wind speed',
    '8' => 'Arch bridge',
    '9' => 'Convert sound waves to electrical signals',
    '10' => 'Geothermal energy',
    '11' => 'Wind energy',
    '12' => 'Direct Current',
    '13' => 'Civil Engineering',
    '14' => 'To change the speed and torque of rotational motion',
    '15' => 'To detect motion and orientation',
    '16' => 'Copper',
    '17' => 'Computer-Aided Design',
    '18' => 'A working model used for testing and evaluation',
    '19' => 'To measure temperature differences using voltage changes',
    '20' => 'Electrical Engineer',
    '21' => 'To reduce friction between moving parts',
    '22' => 'Science, Technology, Engineering, and Mathematics',
    '23' => 'To prevent excessive pressure buildup and ensure safety',
    '24' => 'Meeting the needs of the present without compromising the ability of future generations to meet their own needs',
    '25' => 'To display and analyze electrical signals over time',
];

$engg_question=[]; // Initialize a variable to keep track of the number of correct answers
$correctAnswers = 0;

// Populate the $engg_question array and check for correct answers
for ($i = 1; $i <= 25; $i++) 
{
    $answerKey = 'answer' . $i;
    $userAnswer = $_POST[$answerKey];
    $engg_question[$i] = $userAnswer;

    // Check if the user's answer matches the correct answer
    if ($userAnswer === $engg_answer[$i]) 
    {
        $correctAnswers++;
    }
}
$totalQuestions = 25;
$t_date=date('Y-m-d');
$score = ($correctAnswers / $totalQuestions) * 100;
echo("Your score is $score");
$sql="INSERT INTO engg values('$fina','$score','$t_date')";
if($conn->query($sql)===true)
{
    echo("row inserted ");
}
?>