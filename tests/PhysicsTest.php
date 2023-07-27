<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \PHPUnit\Framework\TestCase;

class PhysicsTest extends TestCase
{
    // Function to test the calculation of the score
    public function testCalculateScore()
    {
        $_POST = [
            'answer1' => 'Second',
            'answer2' => 'Temperature',
            // Add other answers for all 25 questions here...
        ];

        // Add the logic to calculate the expected score here...
        $expectedScore = 76.0; // Replace this value with the expected score based on the provided answers.

        // Include the original PHP code here to perform the score calculation
        ob_start();
        include __DIR__ . '/../php/physics_answer.php';
        $output = ob_get_clean();

        // Extract the actual score from the output using regular expressions
        preg_match('/Your score is (\d+(\.\d+)?)/', $output, $matches);
        
        // Check if the score is found in the output
        if (isset($matches[1])) {
            $actualScore = (float) $matches[1];
        } else {
            $this->fail('The score was not found in the output: ' . $output);
            return;
        }

        // Perform the test and provide a custom failure message if the test fails
        $this->assertEquals($expectedScore, $actualScore, 'The calculated score does not match the expected score.');
    }
}
