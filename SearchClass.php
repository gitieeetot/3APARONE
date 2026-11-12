<?php include 'db_connect.php';
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username']))
{
    header("Location:login.php");
    exit;
}

$search_page = 'SearchClass.php';
$success_message = "";
$error_message = "";

if (isset($_POST['btn_update'])) {
    $course = $_POST['class_course'];
    $yearlevel = $_POST['class_yearlevel'];
    $section = $_POST['class_section'];
    $class_day = $_POST['class_day'];
    $class_start_time = $_POST['class_start_time'];
    $class_end_time = $_POST['class_end_time'];
    $instructor = $_POST['class_instructor'];
    $semester = $_POST['class_semester'];
    $academic_year = $_POST['class_academic_year'];
    $subject = $_POST['class_subject'];
    $async_day = $_POST['class_async_day'];
    $async_start_time = $_POST['class_async_start_time'];
    $async_end_time = $_POST['class_async_end_time'];

    $updateClass = "UPDATE tbl_class SET 
        `COURSE` = '$course', 
        `YEARLEVEL` = '$yearlevel', 
        `SECTION` = '$section', 
        `Class Schedule Day` = '$class_day', 
        `Class Schedule Start Time` = '$class_start_time', 
        `Class Schedule End Time` = '$class_end_time', 
        `Instructor` = '$instructor', 
        `Semester` = '$semester', 
        `Academic Year` = '$academic_year', 
        `Subject` = '$subject', 
        `Class Asynchronous Day` = '$async_day', 
        `Class Asynchronous Start Time:` = '$async_start_time', 
        `Class Asynchronous End Time:` = '$async_end_time' 
        WHERE ID = '$_SESSION[class_id]'";
    if ($conn->query($updateClass)) {
        $_POST['SearchClass'] = $subject;
        $success_message = "Class has been updated.";
    } else {
        $error_message = "Class has not been updated.";
    }
}

if (isset($_POST['btn_delete'])) {
    $deleteClass = "DELETE FROM tbl_class WHERE ID = '$_SESSION[class_id]'";
    if ($conn->query($deleteClass)) {
        $success_message = "Class has been deleted.";
        unset($_SESSION['class_id']);
    } else {
        $error_message = "Class has not been deleted.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>
        <div class="heading">
            <p>SEARCH</p>
            <h1>Class</h1>
            <p class="subtitle">Search for a class</p>
        </div>

        <div class="form">
            <form action="SearchClass.php" method="POST">
                <label for="SearchClass">Subject:</label>
                <input type="text" id="SearchClass" name="SearchClass" placeholder="Enter subject here">

                <button type="submit">Search</button>
                <?php
                if (($_POST['SearchClass'] ?? '') == "")
                {
                    echo "Subject is Required";
                } else {
                    $selectClass = "SELECT * FROM tbl_class WHERE `Subject` ='$_POST[SearchClass]'";
                    $resultClass = $conn->query($selectClass);
                    if ($resultClass->num_rows > 0)
                        {
                        while ($row = $resultClass->fetch_assoc())
                        {
                            $_SESSION['class_id'] = $row['ID'];
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">ID</strong>
                                    <span class="value"><?php echo $row['ID']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Course</strong>
                                    <span class="value">
                                        <input type="text" name="class_course" value="<?php echo $row['COURSE']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Year Level</strong>
                                    <span class="value">
                                        <input type="text" name="class_yearlevel" value="<?php echo $row['YEARLEVEL']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Section</strong>
                                    <span class="value">
                                        <input type="text" name="class_section" value="<?php echo $row['SECTION']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Class Schedule Day</strong>
                                    <span class="value">
                                        <input type="text" name="class_day" value="<?php echo $row['Class Schedule Day']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Class Schedule Start Time</strong>
                                    <span class="value">
                                        <input type="time" name="class_start_time" value="<?php echo $row['Class Schedule Start Time']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Class Schedule End Time</strong>
                                    <span class="value">
                                        <input type="time" name="class_end_time" value="<?php echo $row['Class Schedule End Time']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Instructor</strong>
                                    <span class="value">
                                        <input type="text" name="class_instructor" value="<?php echo $row['Instructor']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Semester</strong>
                                    <span class="value">
                                        <input type="text" name="class_semester" value="<?php echo $row['Semester']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Academic Year</strong>
                                    <span class="value">
                                        <input type="text" name="class_academic_year" value="<?php echo $row['Academic Year']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Subject</strong>
                                    <span class="value">
                                        <input type="text" name="class_subject" value="<?php echo $row['Subject']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Class Asynchronous Day</strong>
                                    <span class="value">
                                        <input type="text" name="class_async_day" value="<?php echo $row['Class Asynchronous Day']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Class Asynchronous Start Time</strong>
                                    <span class="value">
                                        <input type="time" name="class_async_start_time" value="<?php echo $row['Class Asynchronous Start Time:']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Class Asynchronous End Time</strong>
                                    <span class="value">
                                        <input type="time" name="class_async_end_time" value="<?php echo $row['Class Asynchronous End Time:']; ?>" required>
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