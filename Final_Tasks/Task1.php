<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
$user_name = "Nishad";
$user_age = 24;
$product_price = 95.50;
$is_checked = true;

$num1 = 60;
$num2 = 20;

echo "User Name: $user_name <br>";
echo "User Age: $user_age <br>";
echo "Product Price: $product_price <br>";
echo "Is Checked: $is_checked <br>";

echo "Addition Result: " . ($num1 + $num2) . "<br>";
echo "Subtraction Result: " . ($num1 - $num2) . "<br>";
echo "Multiplication Result: " . ($num1 * $num2) . "<br>";
echo "Division Result: " . ($num1 / $num2) . "<br>";
print "sum of two number: " . (4 + 7) . "<br>";
function get_datatype($var) {
    return gettype($var);
}
echo "Type of \$user_name: " . get_datatype($user_name) . "<br>";
echo "Type of \$user_age: " . get_datatype($user_age) . "<br>";
echo "Type of \$product_price: " . get_datatype($product_price) . "<br>";
echo "Type of \$is_checked: " . get_datatype($is_checked) . "<br>";

?>
</body>
</html>