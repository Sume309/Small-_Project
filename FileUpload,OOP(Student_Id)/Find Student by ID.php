<?php
class Student {
    public $id;
    public $name;
    public $batch;

    function __construct($id, $name, $batch) {
        $this->id = $id;
        $this->name = $name;
        $this->batch = $batch;
    }

    function display() {
        echo "<h3>Student Info:</h3>";
        echo "ID: " . htmlspecialchars($this->id) . "<br>";
        echo "Name: " . htmlspecialchars($this->name) . "<br>";
        echo "Batch: " . htmlspecialchars($this->batch) . "<br>";
    }
}

$foundStudent = null;

  


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchId = trim($_POST['id']);

    // student.txt থেকে সব লাইন পড়া
    if (file_exists("student.txt")) {
        $lines = file("student.txt");
        foreach ($lines as $line) {
            $line = trim($line);
            list($id, $name, $batch) = explode(",", $line);

            if ($id == $searchId) {
                $foundStudent = new Student($id, $name, $batch);
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Find Student by ID</title>
</head>
<body>

<h2>Search Student Info</h2>
<form method="post" action="">
    Enter Student ID: <input type="text" name="id" required> <br>
    <input type="submit" value="Search">
</form>

<?php
if ($foundStudent) {
    $foundStudent->display();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p style='color:red;'>Student not found.</p>";
}
?>

</body>
</html>
