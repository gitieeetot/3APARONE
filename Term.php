<?php
include 'db_connect.php';
$search_page = 'SearchTerm.php';

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addterm = "INSERT INTO tbl_term (term, description) VALUES ('$_POST[term]', '$_POST[description]')";
    
    if ($conn->query($addterm)) {
        $success_message = "Term successfully saved!";
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
    <title>Term</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>

        <div class="heading">
            <p>MANAGE</p>
            <h1>Term</h1>
            <p class="subtitle">Add a new term</p>
        </div>

        <div class="form">
            <form action="Term.php" method="POST">
                <label for="txt_term">Term:</label>
                <input type="text" id="txt_term" name="term" required>

                <label for="txt_description">Description:</label>
                <input type="text" id="txt_description" name="description" required>

                <button type="submit" name = "btn_submit" >Save</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>