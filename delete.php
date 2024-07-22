<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cruddb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql_delete = "DELETE FROM student WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Successfully Deleted";
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
<body>
    <br>
<a class="btn btn-primary" href="index.php">See All Students</a>
</body>
</html>
        <?php
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
