<?php
session_start();
include 'db_connect.php';
$search_page = 'SearchCourse.php';
$message = "";

if (isset($_POST['btn_update'])) {
    $courseId = $_POST['course_id'];
    $course = $_POST['course_value'];
    $description = $_POST['course_description'];

    $updateCourse = "UPDATE tbl_course SET course = '$course', description = '$description' WHERE ID = '$courseId'";
    if ($conn->query($updateCourse)) {
        $_POST['SearchCourse'] = $course;
        $message = "Course successfully updated.";
    }
}

if (isset($_POST['btn_delete'])) {
    $courseId = $_SESSION['course_id'] ?? $_POST['course_id'];
    $deleteCourse = "DELETE FROM tbl_course WHERE ID = '$courseId'";
    if ($conn->query($deleteCourse)) {
        $message = "Course successfully deleted.";
        unset($_SESSION['course_id'], $_SESSION['course_value'], $_SESSION['course_description']);
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
        <div class="heading">
            <p>SEARCH</p>
            <h1>Course</h1>
            <p class="subtitle">Search for a course</p>
        </div>

        <div class="form">
            <form action="SearchCourse.php" method="POST">
                <label for="SearchCourse">Course:</label>
                <input type="text" id="SearchCourse" name="SearchCourse" placeholder="Enter course here">

                <button type="submit" name="btn_search">Search</button>
                <?php echo $message; ?>
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
                            $_SESSION['course_value'] = $row['COURSE'];
                            $_SESSION['course_description'] = $row['DESCRIPTION'];
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
                            <input type="hidden" name="course_id" value="<?php echo $row['ID']; ?>">
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