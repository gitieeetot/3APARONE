<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$search_page = 'SearchClass.php';
$success_message = "";
$error_message = "";

$courses = $conn->query("SELECT ID, COURSE FROM tbl_course ORDER BY COURSE ASC");
$yearLevels = $conn->query("SELECT ID, YEARLEVEL FROM tbl_yearlevel ORDER BY YEARLEVEL ASC");
$sections = $conn->query("SELECT ID, SECTION FROM tbl_section ORDER BY SECTION ASC");
$semesters = $conn->query("SELECT ID, TERM FROM tbl_term ORDER BY TERM ASC");
$schoolYears = $conn->query("SELECT ID, SCHOOLYEAR FROM tbl_schoolyear ORDER BY SCHOOLYEAR DESC");
$instructors = $conn->query("SELECT ID, Instructors FROM tbl_instructor ORDER BY Instructors ASC");
$title = $conn->query("SELECT ID, TITLE FROM tbl_subjects ORDER BY TITLE ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Class</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="page">
        <?php include 'messages.php'; ?>

        <div class="heading">
            <p>MANAGE</p>
            <h1>Class</h1>
            <p class="subtitle">Add a new class setup</p>
        </div>

        <div class="form">
            <form action="class.php" method="POST">
                <label for="sel_course">Course:</label>
                <select id="sel_course" name="course" required>
                    <option value="">Select Course</option>
                    <?php while ($row = $courses->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['COURSE'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row['COURSE'], ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="sel_year_level">Year Level:</label>
                <select id="sel_year_level" name="year_level" required>
                    <option value="">Select Year Level</option>
                    <?php while ($row = $yearLevels->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['YEARLEVEL'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row['YEARLEVEL'], ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="sel_section">Section:</label>
                <select id="sel_section" name="section" required>
                    <option value="">Select Section</option>
                    <?php while ($row = $sections->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['SECTION'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row['SECTION'], ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="sel_class_day">Class Schedule Day:</label>
                <select id="sel_class_day" name="class_day" required>
                    <option value="">Select Sync Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>

                <label for="time_start">Class Schedule Start Time:</label>
                <input type="time" id="time_start" name="start_time" step="1" required>

                <label for="time_end">Class Schedule End Time:</label>
                <input type="time" id="time_end" name="end_time" step="1" required>

                <label for="sel_instructor">Instructor Name:</label>
                <select id="sel_instructor" name="instructor" required>
                    <option value="">Select Instructor</option>
                    <?php while ($row = $instructors->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['Instructors'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($row['Instructors'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="sel_semester">Semester:</label>
                <select id="sel_semester" name="semester" required>
                    <option value="">Select Semester</option>
                    <?php while ($row = $semesters->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['TERM'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row['TERM'], ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="sel_academic_year">Academic Year:</label>
                <select id="sel_academic_year" name="academic_year" required>
                    <option value="">Select Academic Year</option>
                    <?php while ($row = $schoolYears->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['SCHOOLYEAR'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row['SCHOOLYEAR'], ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="sel_subject">Subject:</label>
                <select id="sel_subject" name="subject" required>
                    <option value="">Select Subject</option>
                    <?php while ($row = $title->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['TITLE'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row['TITLE'], ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="sel_async_day">Class Asynchronous Day:</label>
                <select id="sel_async_day" name="async_day">
                    <option value="">Select Async Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>

                <label for="time_async_start">Class Asynchronous Start Time:</label>
                <input type="time" id="time_async_start" name="async_start_time" step="1">

                <label for="time_async_end">Class Asynchronous End Time:</label>
                <input type="time" id="time_async_end" name="async_end_time" step="1">

                <button type="submit" name="btn_submit">Save</button>
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
