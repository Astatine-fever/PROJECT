<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../sample/scores_test.php';

use PHPUnit\Framework\TestCase;

class scoresTest extends TestCase
{
    public function testCalculateScore()
    {
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

        $expectedScore = 76.0; // Replace this with the expected score based on the provided answers.

        $result = score($answers);
        $this->assertEquals($expectedScore, $result, 'The calculated score does not match the expected score.');
    }
}
