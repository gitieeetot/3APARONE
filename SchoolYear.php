<?php
include 'db_connect.php';
$search_page = 'SearchSchoolYear.php';

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addschoolyear = "INSERT INTO tbl_schoolyear (schoolyear, description) VALUES ('$_POST[schoolyear]', '$_POST[description]')";
    
    if ($conn->query($addschoolyear)) {
        $success_message = "School year successfully saved!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Year</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>

        <div class="heading">
            <p>MANAGE</p>
            <h1>School Year</h1>
            <p class="subtitle">Add a new school year</p>
        </div>

        <div class="form">
            <form action="SchoolYear.php" method="POST">
                <label for="txt_schoolyear">School Year:</label>
                <input type="text" id="txt_schoolyear" name="schoolyear" required>

                <label for="txt_description">Description:</label>
                <input type="text" id="txt_description" name="description" required>

                <button type="submit" name = btn_submit >Save</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>