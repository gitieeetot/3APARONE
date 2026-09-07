<?php
include 'db_connect.php';
$search_page = 'SearchSection.php';

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addsection = "INSERT INTO tbl_section (section, description) VALUES ('$_POST[section]', '$_POST[description]')";
    
    if ($conn->query($addsection)) {
        $success_message = "Section successfully saved!";
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
    <title>Section</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>

        <div class="heading">
            <p>MANAGE</p>
            <h1>Section</h1>
            <p class="subtitle">Add a new section</p>
        </div>

        <div class="form">
            <form action="Section.php" method="POST">
                <label for="txt_section">Section:</label>
                <input type="text" id="txt_section" name="section" required>

                <label for="txt_description">Description:</label>
                <input type="text" id="txt_description" name="description" required>

                <button type="submit" name = "btn_submit" >Save</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>