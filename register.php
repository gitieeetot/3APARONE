<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css?v=4">
</head>
<body>

    <main class="page">

        <div class="heading">
            <p>REGISTER</p>
        </div>

        <div class="form">
            <form action="login.php" method="POST">
                <label for="txt_usertype">Usertype:</label>
                <select id="cbo_usertype" name="cbo_usertype" required>
                <option value="" disabled selected>Select UserType</option>
                </select>
                <label for="txt_username">Username:</label>
                <input type="text" id="txt_username" name="username" required>

                <label for="txt_password">Password:</label>
                <input type="text" id="txt_password" name="password" required>

                <label for="txt_retypepassword">Retype Password:</label>
                <input type="text" id="txt_retypepassword" name="retypepassword" required>

                <label for="txt_firstname">First Name:</label>
                <input type="text" id="txt_firstname" name="firstname" required>

                <label for="txt_middlename">Middle Name:</label>
                <input type="text" id="txt_middlename" name="middlename" required>

                <label for="txt_lastname">Last Name:</label>
                <input type="text" id="txt_lastname" name="lastname" required>

                <label>Gender:</label>
                   <div class="gender-options">
                <label for="gender_male">
                   <input type="radio" id="gender_male" name="gender" value="Male" required> 
                    Male
                </label>

                <label for="gender_female">
                   <input type="radio" id="gender_female" name="gender" value="Female" required> 
                    Female
                </label>
                    </div>

                <button type="submit" name = "btn_submit" >Register</button>
                <br>
                <button type="button" onclick="location.href='login.php'">Cancel</button>
                
            </form>
            
        </div>
    </main>

</body>
</html>