<?php include 'db_connect.php';
$search_page = 'SearchYear.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Year Level</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="page">
        <div class="heading">
            <p>SEARCH</p>
            <h1>Year Level</h1>
            <p class="subtitle">Search for a year level</p>
        </div>
        <div class="form">
            <form action="SearchYear.php" method="POST">
                <label for="SearchYear">Year Level:</label>
                <input type="text" id="SearchYear" name="SearchYear" placeholder="Enter year level here">

                <button type="submit" name="btn_search">Search</button>
                <?php
                if (($_POST['SearchYear'] ?? '') == "")
                {
                    echo "Year Level is Required";
                } else {
                    $selectYear = "SELECT * FROM tbl_yearlevel WHERE yearlevel ='$_POST[SearchYear]'";
                    $resultYear = $conn->query($selectYear);
                    if ($resultYear->num_rows > 0)
                        {
                        while ($row = $resultYear->fetch_assoc())
                        {
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">Year Level</strong>
                                    <span class="value"><?php echo $row['YEARLEVEL']; ?></span>
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
