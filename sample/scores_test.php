<?php
function score(array $answers): float
{
    $totalQuestions = 25;
    $correctAnswers = 0;
    $physics_answer = [
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
        '17'=>'Kinetic Energy',
        '18'=>"Newton's Second Law",
        '19'=>'Weight',
        '20'=>'Copper',
        '21'=>'Photosynthesis',
        '22'=>'Chemical Energy',
        '23'=>'Solid',
        '24'=>'Potential Energy',
        '25'=>'Gravitational force',
        ];

        


    foreach ($answers as $questionNumber => $userAnswer) {
        if (isset($physics_answer[$questionNumber]) && $physics_answer[$questionNumber] === $userAnswer) {
            $correctAnswers++;
        }
    }

    return ($correctAnswers / $totalQuestions) * 100;
}

// Example usage:

$answers = [
    '1'=>'Kilogram',
    '2'=>'Temperature',
    '3'=>'Gravitation',
    '4'=>'Evaporation',
    '5'=>'Conduction',
    '6'=>"Coulomb's Law",
    '7'=>'Newton',
    '8'=>'9.8 m/s²',
    '9'=>'Proton',
    '10'=>'Refraction',
    '11'=>'Strong nuclear force',
    '12'=>"Pascal's Law",
    '13'=>"Newton's Third Law",
    '14'=>'Diffraction',
    '15'=>'Volt',
    '16'=>'Watt',
    '17'=>'Kinetic Energy',
    '18'=>"Newton's Third Law",
    '19'=>'Weight',
    '20'=>'Copper',
    '21'=>'Photosynthesis',
    '22'=>'Chemical Energy',
    '23'=>'Solid',
    '24'=>'Potential Energy',
    '25'=>'Tension force',
];


$score = score($answers);
echo "Your score is: $score";
