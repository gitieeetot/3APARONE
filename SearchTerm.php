<?php include 'db_connect.php';
$search_page = 'SearchTerm.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Term</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="page">
        <div class="heading">
            <p>SEARCH</p>
            <h1>Term</h1>
            <p class="subtitle">Search for a term</p>
        </div>
        <div class="form">
            <form action="SearchTerm.php" method="POST">
                <label for="SearchTerm">Term:</label>
                <input type="text" id="SearchTerm" name="SearchTerm" placeholder="Enter term here">

                <button type="submit" name="btn_search">Search</button>
                <?php
                if (($_POST['SearchTerm'] ?? '') == "")
                {
                    echo "Term is Required";
                } else {
                    $selectTerm = "SELECT * FROM tbl_term WHERE term ='$_POST[SearchTerm]'";
                    $resultTerm = $conn->query($selectTerm);
                    if ($resultTerm->num_rows > 0)
                        {
                        while ($row = $resultTerm->fetch_assoc())
                        {
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">Term</strong>
                                    <span class="value"><?php echo $row['TERM']; ?></span>
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
