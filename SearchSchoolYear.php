<?php include 'db_connect.php';
$search_page = 'SearchSchoolYear.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search School Year</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="page">
        <div class="heading">
            <p>SEARCH</p>
            <h1>School Year</h1>
            <p class="subtitle">Search for a school year</p>
        </div>
        <div class="form">
            <form action="SearchSchoolYear.php" method="POST">
                <label for="SearchSchoolYear">School Year:</label>
                <input type="text" id="SearchSchoolYear" name="SearchSchoolYear" placeholder="Enter school year here">

                <button type="submit" name="btn_search">Search</button>
                <?php
                if (($_POST['SearchSchoolYear'] ?? '') == "")
                {
                    echo "School Year is Required";
                } else {
                    $selectSchoolYear = "SELECT * FROM tbl_schoolyear WHERE schoolyear ='$_POST[SearchSchoolYear]'";
                    $resultSchoolYear = $conn->query($selectSchoolYear);
                    if ($resultSchoolYear->num_rows > 0)
                        {
                        while ($row = $resultSchoolYear->fetch_assoc())
                        {
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">School Year</strong>
                                    <span class="value"><?php echo $row['SCHOOLYEAR']; ?></span>
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
