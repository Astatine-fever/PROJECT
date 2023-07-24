<?php 
session_start();
$fina= $_SESSION['fn'];

require_once 'db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql="CREATE TABLE IF NOT EXISTS physics (
    `fname` VARCHAR(50),
    `score` int(3),
    `last_test_taken`date)";

$conn->query($sql);


$physics_answer=[
'1'=>'Second',
'2'=>'Temperature',
'3'=>'Friction',
'4'=>'Evaporation',
'5'=>'Conduction',
'6'=>'Law of Conservation of Energy',
'7'=>'Newton',
'8'=>'9.8 m/s²',
'9'=>'Proton',
'10'=>'Refraction',
'11'=>'Strong nuclear force',
'12'=>"Boyle's Law",
'13'=>"Newton's Third Law",
'14'=>'Diffraction',
'15'=>'Volt',
'16'=>'Watt',
'17'=>'Kinetic energy',
'18'=>"Newton's Second Law",
'19'=>'Weight',
'20'=>'Copper',
'21'=>'Photosynthesis',
'22'=>'Chemical energy',
'23'=>'Solid',
'24'=>'Potential energy',
'25'=>'Gravitational force',
];
$physics_question=[];


// Initialize a variable to keep track of the number of correct answers

$physics_question = [];
$correctAnswers = 0;

// Populate the $physics_question array and check for correct answers
for ($i = 1; $i <= 25; $i++) {
    $answerKey = 'answer' . $i;
    $userAnswer = $_POST[$answerKey];
    $physics_question[$i] = $userAnswer;

    // Check if the user's answer matches the correct answer
    if ($userAnswer === $physics_answer[$i]) {
        $correctAnswers++;
    }
}
$totalQuestions = 25;
$t_date=date('Y-m-d');
$score = ($correctAnswers / $totalQuestions) * 100;
echo("Your score is $score");
$sql="INSERT INTO physics values($fina,$score,$t_date)";
if($conn->query($sql)===true)
{
    echo("row inserted ");
}
?>