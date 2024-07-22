<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cruddb";
$conn = new mysqli($servername, $username, $password, $dbname)
    or die("no connect" . mysqli_error($conn));
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $marks = trim($_POST['marks']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    if (empty($name) || $marks === '' || $email === '' || $contact === '') {
        echo "<script>alert('Please fill out all fields.')</script>";
    } else {
        // Insert data into database
        $sql = "INSERT INTO student (name, marks, email, contact) VALUES ('$name', '$marks', '$email', '$contact')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record inserted successfully.')</script>";
            // header("location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body{
            margin-top: 1%;
            margin-left: 25%;
        }
    </style>
        <link rel="stylesheet" href="style.css">

    <script>
        function validateForm() {
            let name = document.getElementById("name").value.trim();
            let marks = document.getElementById("marks").value.trim();
            let email = document.getElementById("email").value.trim();
            let contact = document.getElementById("contact").value.trim();

            if (name === "" || marks === "" || email === "" || contact === "") {
                alert("Please fill out all fields.");
                return false;
            }
            
            if (isNaN(marks) || isNaN(contact)) {
                alert("Marks and Contact must be numeric values.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container m-5">
    <h1>Add Information</h1>
        <form class="card w-50 d-flex justify-center text-start p-3" action="insert.php" method="POST"
            onsubmit="return validateForm()">
            
            <div>
                <label for="name"><h4>Name</h4></label>
                <input class="inpuuu" name="name" id="name" type="text" required><br>
            </div>
            <div>
                <label for="marks"><h4>Marks</h4></label>
                <input class="inpuuu" name="marks" id="marks" type="number"><br>
            </div>
            <div>
                <label for="email"><h4>Email</h4></label>
                <input class="inpuuu" name="email" id="email" type="email" required><br>
            </div>
            <div>
                <label for="contact"><h4>Contact</h4></label>
                <input class="inpuuu" name="contact" id="contact" type="number" required><br>
            </div>
            <br><button class="btn btn-primary submitty" type="submit">Submit <i class="fa-solid fa-paper-plane"></i></button>
            <a class="btn btn-primary seeall" href="index.php">See All <i class="fa-solid fa-users-viewfinder"></i></a>
        </form>
    </div>
    
</body>

</html>
