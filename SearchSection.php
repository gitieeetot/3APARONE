<?php include 'db_connect.php';
$search_page = 'SearchSection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Section</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="page">
        <div class="heading">
            <p>SEARCH</p>
            <h1>Section</h1>
            <p class="subtitle">Search for a section</p>
        </div>
        <div class="form">
            <form action="SearchSection.php" method="POST">
                <label for="SearchSection">Section:</label>
                <input type="text" id="SearchSection" name="SearchSection" placeholder="Enter section here">

                <button type="submit" name="btn_search">Search</button>
                <?php
                if (($_POST['SearchSection'] ?? '') == "")
                {
                    echo "Section is Required";
                } else {
                    $selectSection = "SELECT * FROM tbl_section WHERE section ='$_POST[SearchSection]'";
                    $resultSection = $conn->query($selectSection);
                    if ($resultSection->num_rows > 0)
                        {
                        while ($row = $resultSection->fetch_assoc())
                        {
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">Section</strong>
                                    <span class="value"><?php echo $row['SECTION']; ?></span>
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
