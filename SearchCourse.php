<?php include 'db_connect.php';
$search_page = 'SearchCourse.php';
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
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">Course</strong>
                                    <span class="value"><?php echo $row['COURSE']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Description</strong>
                                    <span class="value"><?php echo $row['DESCRIPTION']; ?></span>
                                </div>
                            </div>
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