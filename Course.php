<?php
include 'db_connect.php';
$search_page = 'SearchCourse.php';
$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkCourse = "SELECT course FROM tbl_course WHERE course = '$_POST[course]'";
    $resultCourse = $conn->query($checkCourse);

    if ($resultCourse->num_rows > 0) {
        $error_message = "Course already exists.";
    } else {
        $addcourse = "INSERT INTO tbl_course (course, description) VALUES ('$_POST[course]', '$_POST[description]')";

        if ($conn->query($addcourse)) {
            $success_message = "Course successfully saved!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SearchCourse</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>

        <div class="heading">
            <p>MANAGE</p>
            <h1>Course</h1>
            <p class="subtitle">Add a new course</p>
        </div>

        <div class="form">
            <form action="Course.php" method="POST">
                <label for="txt_course">Course:</label>
                <input type="text" id="txt_course" name="course" required>

                <label for="txt_description">Description:</label>
                <input type="text" id="txt_description" name="description" required>

                <button type="submit" name = "btn_submit" >Save</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>