<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../sample/addvalues.php';

use PHPUnit\Framework\TestCase;

class AddValuesToArrayTest extends TestCase
{
    public function testAddValuesToArray()
    {
        $myArray = [1, 2, 3];
        $valuesToAdd = [4, 5, 6];
        $expectedResult = [1, 2, 3, 4, 5, 6];

        $resultArray = addValuesToArray($myArray, $valuesToAdd);

        $this->assertSame($expectedResult, $resultArray);
    }
}
