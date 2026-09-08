<?php
session_start();
include 'db_connect.php';
$search_page = 'SearchYear.php';
$message = "";

if (isset($_POST['btn_update'])) {
    $yearId = $_POST['year_id'];
    $yearlevel = $_POST['yearlevel_value'];
    $description = $_POST['yearlevel_description'];

    $updateYear = "UPDATE tbl_yearlevel SET yearlevel = '$yearlevel', description = '$description' WHERE ID = '$yearId'";
    if ($conn->query($updateYear)) {
        $_POST['SearchYear'] = $yearlevel;
        $message = "Year level successfully updated.";
    }
}

if (isset($_POST['btn_delete'])) {
    $yearId = $_SESSION['year_id'] ?? $_POST['year_id'];
    $deleteYear = "DELETE FROM tbl_yearlevel WHERE ID = '$yearId'";
    if ($conn->query($deleteYear)) {
        $message = "Year level successfully deleted.";
        unset($_SESSION['year_id'], $_SESSION['yearlevel_value'], $_SESSION['yearlevel_description']);
    }
}
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
                <?php echo $message; ?>
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
                            $_SESSION['year_id'] = $row['ID'];
                            $_SESSION['yearlevel_value'] = $row['YEARLEVEL'];
                            $_SESSION['yearlevel_description'] = $row['DESCRIPTION'];
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">ID</strong>
                                    <span class="value"><?php echo $row['ID']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Year Level</strong>
                                    <span class="value"><input type="text" name="yearlevel_value" value="<?php echo $row['YEARLEVEL']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Description</strong>
                                    <span class="value"><input type="text" name="yearlevel_description" value="<?php echo $row['DESCRIPTION']; ?>" required></span>
                                </div>
                            </div>
                            <input type="hidden" name="year_id" value="<?php echo $row['ID']; ?>">
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
