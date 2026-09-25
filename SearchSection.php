<?php include 'db_connect.php';
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username']))
{
	header ("Location:login.php");
	exit;
}

$search_page = 'SearchSection.php';
$success_message = "";
$error_message = "";

if (isset($_POST['btn_update'])) {
    $section = $_POST['section_value'];
    $description = $_POST['section_description'];

    $updateSection = "UPDATE tbl_section SET section = '$section', description = '$description' WHERE ID = '$_SESSION[section_id]'";
    if ($conn->query($updateSection)) {
        $_POST['SearchSection'] = $section;
        $success_message = "Section has been updated.";
    } else {
        $error_message = "Section has not been updated.";
    }
}

if (isset($_POST['btn_delete'])) {
    $deleteSection = "DELETE FROM tbl_section WHERE ID = '$_SESSION[section_id]'";
    if ($conn->query($deleteSection)) {
        $success_message = "Section has been deleted.";
        unset($_SESSION['section_id'], $_SESSION['section_value'], $_SESSION['section_description']);
    } else {
        $error_message = "Section has not been deleted.";
    }
}
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
        <?php include 'messages.php'; ?>
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
                    $selectSearchSection = "SELECT * FROM tbl_section WHERE section ='$_POST[SearchSection]'";
                    $resultSearchSection = $conn->query($selectSearchSection);
                    if ($resultSearchSection->num_rows > 0)
                        {
                        while ($row = $resultSearchSection->fetch_assoc())
                        {
                            $_SESSION['section_id'] = $row['ID'];
                            $_SESSION['section_value'] = $row['SECTION'];
                            $_SESSION['section_description'] = $row['DESCRIPTION'];
                            ?>
                            <div class="table">
                                <div class="row">
                                    <strong class="label">ID</strong>
                                    <span class="value"><?php echo $row['ID']; ?></span>
                                </div>
                                <div class="row">
                                    <strong class="label">Section</strong>
                                    <span class="value">
                                        <input type="text" name="section_value" value="<?php echo $row['SECTION']; ?>" required>
                                    </span>
                                </div>
                                <div class="row">
                                    <strong class="label">Description</strong>
                                    <span class="value">
                                        <input type="text" name="section_description" value="<?php echo $row['DESCRIPTION']; ?>" required>
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" name="section_id" value="<?php echo $row['ID']; ?>">
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
