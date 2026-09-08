<?php
session_start();
include 'db_connect.php';
$search_page = 'SearchSchoolYear.php';
$message = "";

if (isset($_POST['btn_update'])) {
    $schoolyearId = $_POST['schoolyear_id'];
    $schoolyear = $_POST['schoolyear_value'];
    $description = $_POST['schoolyear_description'];

    $updateSchoolYear = "UPDATE tbl_schoolyear SET schoolyear = '$schoolyear', description = '$description' WHERE ID = '$schoolyearId'";
    if ($conn->query($updateSchoolYear)) {
        $_POST['SearchSchoolYear'] = $schoolyear;
        $message = "School year successfully updated.";
    }
}

if (isset($_POST['btn_delete'])) {
    $schoolyearId = $_SESSION['schoolyear_id'] ?? $_POST['schoolyear_id'];
    $deleteSchoolYear = "DELETE FROM tbl_schoolyear WHERE ID = '$schoolyearId'";
    if ($conn->query($deleteSchoolYear)) {
        $message = "School year successfully deleted.";
        unset($_SESSION['schoolyear_id'], $_SESSION['schoolyear_value'], $_SESSION['schoolyear_description']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search School Year</title>
    <link rel="stylesheet" href="style.css?v=3">
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
                 <?php echo $message; ?>
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
                            $_SESSION['schoolyear_id'] = $row['ID'];
                            $_SESSION['schoolyear_value'] = $row['SCHOOLYEAR'];
                            $_SESSION['schoolyear_description'] = $row['DESCRIPTION'];
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">ID</strong>
                                    <span class="value"><?php echo $row['ID']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">School Year</strong>
                                    <span class="value">
                                        <input type="text" name="schoolyear_value" value="<?php echo $row['SCHOOLYEAR']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Description</strong>
                                    <span class="value">
                                        <input type="text" name="schoolyear_description" value="<?php echo $row['DESCRIPTION']; ?>" required>
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" name="schoolyear_id" value="<?php echo $row['ID']; ?>">
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
