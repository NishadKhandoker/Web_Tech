<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Loops and Array Example</title>
</head>
<body>

<h2>Print 1 to 20 Using For Loop</h2>
<?php
for ($i = 1; $i <= 20; $i++) {
    echo $i . "<br>";
}
?>

<h2>Print 1 to 20 Using While Loop</h2>
<?php
$i = 1;
while ($i <= 20) {
    echo $i . "<br>";
    $i++;
}
?>

<h2>Fruits and Their Colors (Using foreach Loop)</h2>
<?php
$fruits = array( 
    "apple" => "red",
    "banana" => "yellow",
    "orange" => "orange"
);

echo "<strong>Using foreach loop:</strong><br>";
foreach ($fruits as $fruit => $color) {
    echo ucfirst($fruit) . " is " . $color . "<br>";
}
?>

<h2>Print First 5 Numbers Using For Loop and Break</h2>
<?php
for ($i = 1; $i <= 20; $i++) {
    echo $i . "<br>";
    if ($i == 5) { // stop after printing 5
        break;
    }
}
?>

</body>
</html>
