<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature & Day Check</title>
</head>
<body>

<?php
// Temperature variable
$temperature = 18; // change the value to test

// Check temperature
if ($temperature < 10) {
    echo "Temperature: It's cold<br>";
} elseif ($temperature >= 10 && $temperature <= 25) {
    echo "Temperature: It's warm<br>";
} else {
    echo "Temperature: It's hot<br>";
}

// Day variable
$day = 3; // change the value (1 to 7)

// Check day using switch
echo "Day: ";
switch ($day) {
    case 1:
        echo "Monday";
        break;
    case 2:
        echo "Tuesday";
        break;
    case 3:
        echo "Wednesday";
        break;
    case 4:
        echo "Thursday";
        break;
    case 5:
        echo "Friday";
        break;
    case 6:
        echo "Saturday";
        break;
    case 7:
        echo "Sunday";
        break;
    default:
        echo "Invalid day number";
        break;
}
?>

</body>
</html>
