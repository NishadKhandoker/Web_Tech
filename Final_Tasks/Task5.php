<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Class Example</title>
</head>
<body>

<h2>PHP Class Example: Book</h2>

<?php
// Define the Book class
class Book {
    public $title;
    public $author;
    public $year;

    // Constructor to initialize properties
    public function __construct($title, $author, $year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    // Method to get book details
    public function getDetails() {
        return "Title: " . $this->title . "<br>" .
               "Author: " . $this->author . "<br>" .
               "Year: " . $this->year . "<br>";
    }

    // Setters
    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setYear($year) {
        $this->year = $year;
    }
}

// Create an object of Book class
$myBook = new Book("The Alchemist", "Paulo Coelho", 1988);

// Call getDetails() method
echo "<strong>Book Details:</strong><br>";
echo $myBook->getDetails();

// Optionally, update properties using setters
$myBook->setTitle("The Pilgrimage");
$myBook->setYear(1987);

echo "<strong>Updated Book Details:</strong><br>";
echo $myBook->getDetails();
?>

</body>
</html>
