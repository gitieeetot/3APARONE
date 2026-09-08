<?php
session_start();
include 'db_connect.php';
$search_page = 'SearchTerm.php';
$success_message = "";
$error_message = "";

if (isset($_POST['btn_update'])) {
    $term = $_POST['term_value'];
    $description = $_POST['term_description'];

    $updateTerm = "UPDATE tbl_term SET term = '$term', description = '$description' WHERE ID = '$_SESSION[term_id]'";
    if ($conn->query($updateTerm)) {
        $_POST['SearchTerm'] = $term;
        $success_message = "Term has been updated.";
    } else {
        $error_message = "Term has not been updated.";
    }
}

if (isset($_POST['btn_delete'])) {
    $deleteTerm = "DELETE FROM tbl_term WHERE ID = '$_SESSION[term_id]'";
    if ($conn->query($deleteTerm)) {
        $success_message = "Term has been deleted.";
        unset($_SESSION['term_id'], $_SESSION['term_value'], $_SESSION['term_description']);
    } else {
        $error_message = "Term has not been deleted.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Term</title>
    <link rel="stylesheet" href="style.css?v=3">
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
                <?php include 'messages.php'; ?>
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
                            $_SESSION['term_id'] = $row['ID'];
                            $_SESSION['term_value'] = $row['TERM'];
                            $_SESSION['term_description'] = $row['DESCRIPTION'];
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">ID</strong>
                                    <span class="value"><?php echo $row['ID']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Term</strong>
                                    <span class="value"><input type="text" name="term_value" value="<?php echo $row['TERM']; ?>" required></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Description</strong>
                                    <span class="value"><input type="text" name="term_description" value="<?php echo $row['DESCRIPTION']; ?>" required></span>
                                </div>
                            </div>
                            <input type="hidden" name="term_id" value="<?php echo $row['ID']; ?>">
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
