<?php
session_start();
include 'db_connect.php';
$search_page = 'SearchSubjects.php';
$success_message = "";
$error_message = "";

if (isset($_POST['btn_update'])) {
    $course = $_POST['course'];
    $yearlevel = $_POST['yearlevel'];
    $term = $_POST['term'];
    $code = $_POST['code'];
    $title = $_POST['title'];
    $lecture = $_POST['lecture'];
    $laboratory = $_POST['laboratory'];
    $credit = $_POST['credit'];
    $grade = $_POST['grade'];
    $preRequisite = $_POST['pre_requisite'];

    $updateSubjects = "UPDATE tbl_subjects SET course = '$course', yearlevel = '$yearlevel', term = '$term', code = '$code', title = '$title', lecture = '$lecture', laboratory = '$laboratory', credit = '$credit', grade = '$grade', pre_requisite = '$preRequisite' WHERE ID = '$_SESSION[subjects_id]'";
    if ($conn->query($updateSubjects)) {
        $_POST['SearchSubjects'] = $code;
        $success_message = "Subject has been updated.";
    } else {
        $error_message = "Subject has not been updated.";
    }
}

if (isset($_POST['btn_delete'])) {
    $deleteSubjects = "DELETE FROM tbl_subjects WHERE ID = '$_SESSION[subjects_id]'";
    if ($conn->query($deleteSubjects)) {
        $success_message = "Subject has been deleted.";
        unset($_SESSION['subjects_id']);
    } else {
        $error_message = "Subject has not been deleted.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Subjects</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="page">
        <?php include 'messages.php'; ?>
        <div class="heading">
            <p>SEARCH</p>
            <h1>Subjects</h1>
            <p class="subtitle">Search by subject code</p>
        </div>
        <div class="form">
            <form action="SearchSubjects.php" method="POST">
                <label for="SearchSubjects">Subject Code:</label>
                <input type="text" id="SearchSubjects" name="SearchSubjects" placeholder="Enter subject code here">

                <button type="submit" name="btn_search">Search</button>
                <?php
                if (($_POST['SearchSubjects'] ?? '') == "")
                {
                    echo "Subject Code is Required";
                } else {
                    $selectSubjects = "SELECT * FROM tbl_subjects WHERE code ='$_POST[SearchSubjects]'";
                    $resultSubjects = $conn->query($selectSubjects);
                    if ($resultSubjects->num_rows > 0)
                        {
                        while ($row = $resultSubjects->fetch_assoc())
                        {
                            $_SESSION['subjects_id'] = $row['ID'];
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">ID</strong>
                                    <span class="value"><?php echo $row['ID']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Course</strong>
                                    <span class="value"><input type="text" name="course" value="<?php echo $row['COURSE']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Yearlevel</strong>
                                    <span class="value"><input type="text" name="yearlevel" value="<?php echo $row['YEARLEVEL']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Term</strong>
                                    <span class="value"><input type="text" name="term" value="<?php echo $row['TERM']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Code</strong>
                                    <span class="value"><input type="text" name="code" value="<?php echo $row['CODE']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Title</strong>
                                    <span class="value"><input type="text" name="title" value="<?php echo $row['TITLE']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Lecture</strong>
                                    <span class="value"><input type="text" name="lecture" value="<?php echo $row['LECTURE']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Laboratory</strong>
                                    <span class="value"><input type="text" name="laboratory" value="<?php echo $row['LABORATORY']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Credit</strong>
                                    <span class="value"><input type="text" name="credit" value="<?php echo $row['CREDIT']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Grade</strong>
                                    <span class="value"><input type="text" name="grade" value="<?php echo $row['GRADE']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Pre_Requisite</strong>
                                    <span class="value"><input type="text" name="pre_requisite" value="<?php echo $row['PRE_REQUISITE']; ?>" required></span>
                                </div>
                            </div>
                            <input type="hidden" name="subjects_id" value="<?php echo $row['ID']; ?>">
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
