<?php include 'db_connect.php';
$search_page = 'SearchSubjects.php';

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $addsubjects = "INSERT INTO tbl_subjects (course, yearlevel, term, code, title, lecture, laboratory, credit, grade, pre_requisite)
        VALUES ('$_POST[cbo_course]', '$_POST[cbo_yearlevel]', '$_POST[cbo_term]', '$_POST[code]', '$_POST[title]', '$_POST[lecture]', '$_POST[laboratory]', '$_POST[credit]', '$_POST[grade]', '$_POST[cbo_pre_requisite]')";

    if ($conn->query($addsubjects)) {
        $success_message = "Subject successfully saved!";
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
    <title>Subjects</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>

        <div class="heading">
            <p>MANAGE</p>
            <h1>Subjects</h1>
            <p class="subtitle">Add a new subject</p>
        </div>

        <div class="form">
            <form action="Subjects.php" method="POST">
                <label for="txt_course">Course:</label>
                <select id="cbo_course" name="cbo_course" required>
                    <option value="" disabled selected>Select Course</option>

                    <?php
                    $selectCourse = "SELECT * FROM tbl_course";
                    $resultCourse = $conn->query($selectCourse);
                    if ($resultCourse->num_rows > 0) {
                        while ($row = $resultCourse->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['COURSE']; ?>"><?php echo $row['COURSE']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>

                <label for="txt_yearlevel">Year Level:</label>
                <select id="cbo_yearlevel" name="cbo_yearlevel" required>
                    <option value="" disabled selected>Select Year Level</option>

                    <?php
                    $selectYearLevel = "SELECT * FROM tbl_yearlevel";
                    $resultYearLevel = $conn->query($selectYearLevel);
                    if ($resultYearLevel->num_rows > 0) {
                        while ($row = $resultYearLevel->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['YEARLEVEL']; ?>"><?php echo $row['YEARLEVEL']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>

                <label for="txt_term">Term:</label>
                <select id="cbo_term" name="cbo_term" required>
                    <option value="" disabled selected>Select Term</option>

                    <?php
                    $selectTerm = "SELECT * FROM tbl_term";
                    $resultTerm = $conn->query($selectTerm);
                    if ($resultTerm && $resultTerm->num_rows > 0) {
                        while ($row = $resultTerm->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['TERM']; ?>"><?php echo $row['TERM']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>

                <label for="txt_code">Code:</label>
                <input type="text" id="txt_code" name="code" required>

                <label for="txt_title">Title:</label>
                <input type="text" id="txt_title" name="title" required>

                <label for="txt_lecture">Lecture:</label>
                <input type="text" id="txt_lecture" name="lecture" required>

                <label for="txt_laboratory">Laboratory:</label>
                <input type="text" id="txt_laboratory" name="laboratory" required>

                <label for="txt_credit">Credit:</label>
                <input type="text" id="txt_credit" name="credit" required>

                <label for="txt_grade">Grade:</label>
                <input type="text" id="txt_grade" name="grade" required>

                <label for="txt_pre_requisite">Pre_Requisite:</label>
                <select id = "cbo_pre_requisite" name = "cbo_pre_requisite" required>
                    <option value = "" disabled selected>Select Value</option>
                    <option value = "None">None</option>
                <?php
                $selectpre_requisite = "SELECT * FROM tbl_subjects";
                $resultpre_requisite = $conn->query($selectpre_requisite);

                    while ($row = $resultpre_requisite->fetch_assoc()) {
                        ?>
                    <option value="<?php echo $row['TITLE']; ?>"><?php echo $row['TITLE']; ?></option>
                            <?php
                        }
                    ?>
                </select>
                <button type="submit" name = "btn_submit" value = "Save">Save</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>