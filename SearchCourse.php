<?php
session_start();
include 'db_connect.php';
$search_page = 'searchCourse.php';
$success_message = "";
$error_message = "";

if (isset($_POST['btn_update'])) {
    $course = $_POST['course_value'];
    $description = $_POST['course_description'];

    $updateCourse = "UPDATE tbl_course SET course = '$course', description = '$description' WHERE ID = '$_SESSION[course_id]'";
    if ($conn->query($updateCourse)) {
        $_POST['SearchCourse'] = $course;
        $success_message = "Course has been updated.";
    } else {
        $error_message = "Course has not been updated.";
    }
}

if (isset($_POST['btn_delete'])) {
    $deleteCourse = "DELETE FROM tbl_course WHERE ID = '$_SESSION[course_id]'";
    if ($conn->query($deleteCourse)) {
        $success_message = "Course has been deleted.";
        unset($_SESSION['course_id']);
    } else {
        $error_message = "Course has not been deleted.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>
        <div class="heading">
            <p>SEARCH</p>
            <h1>Course</h1>
            <p class="subtitle">Search for a course</p>
        </div>

        <div class="form">
            <form action="searchCourse.php" method="POST">
                <label for="SearchCourse">Course:</label>
                <input type="text" id="SearchCourse" name="SearchCourse" placeholder="Enter course here">

                <button type="submit">Search</button>
                <?php
                if (($_POST['SearchCourse'] ?? '') == "")
                {
                    echo "Course is Required";
                } else {
                    $selectCourse = "SELECT * FROM tbl_course WHERE course ='$_POST[SearchCourse]'";
                    $resultCourse = $conn->query($selectCourse);
                    if ($resultCourse->num_rows > 0)
                        {
                        while ($row = $resultCourse->fetch_assoc())
                        {
                            $_SESSION['course_id'] = $row['ID'];
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">ID</strong>
                                    <span class="value"><?php echo $row['ID']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Course</strong>
                                    <span class="value">
                                        <input type="text" name="course_value" value="<?php echo $row['COURSE']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Description</strong>
                                    <span class="value">
                                        <input type="text" name="course_description" value="<?php echo $row['DESCRIPTION']; ?>" required>
                                    </span>
                                </div>
                            </div>
                            <br>
                            <button type="submit" name="btn_update">Update</button>
                            <br>
                            <button type="submit" name="btn_delete">Delete</button>
                            <?php
                        }
                    } else {
                        echo "No results found.";
                    }
                }
            ?>
       </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>