<?php
include 'db_connect.php';
$search_page = 'SearchYear.php';

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addyearlevel = "INSERT INTO tbl_yearlevel (yearlevel, description) VALUES ('$_POST[yearlevel]', '$_POST[description]')";
    
    if ($conn->query($addyearlevel)) {
        $success_message = "Year level successfully saved!";
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
    <title>Year</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>

        <div class="heading">
            <p>MANAGE</p>
            <h1>Year Level</h1>
            <p class="subtitle">Add a new year level to your academic system</p>
        </div>

        <div class="form">
            <form action="Yearlevel.php" method="POST">
                <label for="txt_yearlevel">Year Level:</label>
                <input type="text" id="txt_yearlevel" name="yearlevel" required>

                <label for="txt_description">Description:</label>
                <input type="text" id="txt_description" name="description" required>

                <button type="submit" name = "btn_submit" >Save</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>