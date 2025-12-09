<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Functions Example</title>
</head>
<body>

<h2>1. Function to Add Two Numbers</h2>
<?php
function add($a, $b) {
    return $a + $b;
}

// Call the function
$num1 = 10;
$num2 = 15;
$sum = add($num1, $num2);
echo "Sum of $num1 and $num2 is: $sum";
?>

<hr>

<h2>2. Factorial Function Using Recursion</h2>
<?php
function factorial($n) {
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

// Call for value 5
$value = 5;
$result = factorial($value);
echo "Factorial of $value is: $result";
?>

<hr>

<h2>3. Function to Test Primality</h2>
<?php
function isPrime($num) {
    if ($num <= 1) return false;
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

// Test example
$testNum = 17;
if (isPrime($testNum)) {
    echo "$testNum is a prime number";
} else {
    echo "$testNum is not a prime number";
}
?>

</body>
</html>
