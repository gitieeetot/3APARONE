<?php include 'db_connect.php';
$search_page = 'SearchSubjects.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Subjects</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="page">
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
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">Course</strong>
                                    <span class="value"><?php echo $row['COURSE']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Yearlevel</strong>
                                    <span class="value"><?php echo $row['YEARLEVEL']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Term</strong>
                                    <span class="value"><?php echo $row['TERM']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Code</strong>
                                    <span class="value"><?php echo $row['CODE']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Title</strong>
                                    <span class="value"><?php echo $row['TITLE']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Lecture</strong>
                                    <span class="value"><?php echo $row['LECTURE']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Laboratory</strong>
                                    <span class="value"><?php echo $row['LABORATORY']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Credit</strong>
                                    <span class="value"><?php echo $row['CREDIT']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Grade</strong>
                                    <span class="value"><?php echo $row['GRADE']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Pre_Requisite</strong>
                                    <span class="value"><?php echo $row['PRE_REQUISITE']; ?></span>
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
