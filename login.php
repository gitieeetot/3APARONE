<?php include 'db_connect.php';
Session_start();

if (isset($_POST['btn_submit'])) {
	$searchUN = "SELECT * From tbl_userreg WHERE username ='$_POST[username]'";
	$result = $conn -> query ($searchUN);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			if (password_verify($_POST['password'], $row['password'])) {
                $_SESSION['username'] = $row['username'];
			header("location: index.php");
			exit();
		} else {
            $error_message = "Invalid password.";
        }
        }
    } else {
        $error_message = "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body>

    <main class="page">

        <div class="heading">
            <p>LOGIN</p>
        </div>

        <div class="form">
            <?php include 'messages.php'; ?>
            <form action="login.php" method="POST">
                <label for="txt_username">Username:</label>
                <input type="text" id="txt_username" name="username" required>

                <label for="txt_password">Password:</label>
                <input type="password" id="txt_password" name="password" required>

                <button type="submit" name = "btn_submit" >Login</button>
				
                <br>
                <button type="button" onclick="location.href='register.php'">Register</button>
            </form>
        </div>
    </main>
               
</body>
</html>