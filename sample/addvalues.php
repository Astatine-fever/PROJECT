<?php 
function addValuesToArray(array $originalArray, array $valuesToAdd): array {
    // Loop through the values to add and append them to the original array
    foreach ($valuesToAdd as $value) {
        $originalArray[] = $value;
    }
    
    return $originalArray;
}

// Example usage:
$myArray = [1, 2, 3];
$valuesToAdd = [4, 5, 6];
$resultArray = addValuesToArray($myArray, $valuesToAdd);
print_r($resultArray); // Output: Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 )
?>

