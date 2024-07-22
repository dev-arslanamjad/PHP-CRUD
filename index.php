<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cruddb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from student order by id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Records</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container mt-4">
            <h1 class="mb-3 text-center">Students Data Entry System</h1>
            <a class="btn btn-primary mb-3 toleft" href="insert.php">Add Student  <i class="fa-solid fa-plus"></i></a>
            <div class="table-responsive">
                <table class="table" id="mytable">
                    <thead class="table-dark">
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Marks</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['marks']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary truebtns"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger truebtns"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#mytable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            "pageLength": 5,
            "ordering": true,
            "searching": true
        });

        // Store page length in sessionStorage when it changes
        $('#mytable').on('length.dt', function(e, settings, len) {
            sessionStorage.setItem('mytable_pageLength', len);
        });

        // Set initial page length from sessionStorage if available
        var storedPageLength = sessionStorage.getItem('mytable_pageLength');
        if (storedPageLength) {
            table.page.len(storedPageLength).draw();
        }
    });
</script>
    </body>

    </html>
    <?php
} else {
    echo "No records found";
    ?>
    <a class="btn btn-primary" href="insert.php"><button>Add One First</button></a>
    <?php
}

$conn->close();
?>
