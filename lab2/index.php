<?php
session_start();

// Task 2: Book Class Definition
class Book
{
    private $title;
    private $author;
    private $year;

    public function __construct($title, $author, $year)
    {
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setYear($year);
    }

    public function setTitle($title)
    {
        if (empty($title)) {
            throw new Exception("Title cannot be empty.");
        }
        $this->title = $title;
    }

    public function setAuthor($author)
    {
        if (empty($author)) {
            throw new Exception("Author cannot be empty.");
        }
        $this->author = $author;
    }

    public function setYear($year)
    {
        if (!is_numeric($year) || $year < 0) {
            throw new Exception("Invalid year.");
        }
        $this->year = $year;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function displayBook()
    {
        return "<tr><td class='border px-4 py-2 text-center'>{$this->getTitle()}</td><td class='border px-4 py-2 text-center'>{$this->getAuthor()}</td><td class='border px-4 py-2 text-center'>{$this->getYear()}</td></tr>";
    }
}

if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

// Task 1 & 3
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $year = $_POST['year'];

        if (empty($title) || empty($author) || empty($year)) {
            throw new Exception("All fields must be filled out.");
        }

        // Task 2
        $book = new Book($title, $author, $year);

        $_SESSION['books'][] = $book;
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humber Library</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Enter Book Information</h2>

            <!-- Display error message if any -->
            <?php if (!empty($errorMessage)): ?>
                <p class="text-red-500 mb-4"><?php echo $errorMessage; ?></p>
            <?php endif; ?>

            <form action="" method="POST">
                <label for="title" class="block mb-2">Title:</label>
                <input type="text" name="title" id="title" class="border w-full p-2 mb-4" autocomplete="off">

                <label for="author" class="block mb-2">Author:</label>
                <input type="text" name="author" id="author" class="border w-full p-2 mb-4" autocomplete="off">

                <label for="year" class="block mb-2">Publication Year:</label>
                <input type="number" name="year" id="year" class="border w-full p-2 mb-4" autocomplete="off">

                <input type="submit" value="Submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 cursor-pointer">
            </form>
        </div>

        <div class="max-w-lg mx-auto mt-8 bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Book List</h2>

            <?php
            // Display Book List in a Table
            if (!empty($_SESSION['books'])) {
                echo "<table class='table-auto w-full'>
                    <thead>
                        <tr>
                            <th class='px-4 py-2'>Title</th>
                            <th class='px-4 py-2'>Author</th>
                            <th class='px-4 py-2'>Publication Year</th>
                        </tr>
                    </thead>
                    <tbody>";
                foreach ($_SESSION['books'] as $book) {
                    echo $book->displayBook();
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='text-gray-500'>No books have been added yet.</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>