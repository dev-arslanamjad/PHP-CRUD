<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cruddb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $name = $marks = $email = $contact = '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM student WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $marks = $row['marks'];
        $email = $row['email'];
        $contact = $row['contact'];
    } else {
        echo "Record not found.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $marks = $_POST['marks'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $sql_update = "UPDATE student SET name='$name', marks=$marks, email='$email', contact='$contact' WHERE id=$id";
    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Record updated successfully')</script>";
        // header("location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <div class="container mt-4">
        <h2>Edit Student Record</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div>
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div>
                <label for="marks" class="form-label">Marks:</label>
                <input  type="number" class="form-control" id="marks" name="marks" value="<?php echo $marks; ?>" required>
            </div>
            <div>
                <label for="email" class="form-label">Email:</label>
                <input  type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div >
                <label for="contact" class="form-label">Contact:</label>
                <input  type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
