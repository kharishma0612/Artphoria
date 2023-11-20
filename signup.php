

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "trial";
    $db = new mysqli($hostname, $username, $password, $database);
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $email = $_POST['email'];
    $phno = $_POST['phno'];

    if ($password === $cpassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO users_table (username, password, email, phone_number) 
                        VALUES ('$username', '$hashedPassword', '$email', '$phno')";
        if ($db->query($insertQuery) === TRUE) {
            echo "Registration successful.";
            echo "<script>
                    alert('Registration successful. You can now login.');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        } else {
            echo "Error: " . $insertQuery . "<br>" . $db->error;
        }
    }
    $db->close();
}
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel = "stylesheet" href = "signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
<link rel="manifest" href="../assets/site.webmanifest">
</head>
<body background = "uploads/Background.jpeg">
    <div class="a" style = "margin-top:200px">
        <img width = "220" src="uploads/logoname.png" ><br>
        <div class="gap1"></div>
        <?php
        $errorMessage = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($password !== $cpassword) {
                $errorMessage = "Password and Confirm Password do not match.";
            }
        }
        ?>
        <form action="signup.php" method="POST">
            <p style="color: red;"><?php echo $errorMessage; ?></p>
            <input type="text" id="username" name="username" placeholder = "Username" required><br>
            <div class="gap1"></div>
            <input type="password" id="password" name="password" placeholder = "Password" required><br>
            <div class="gap1"></div>
            <input type ="password" id ="cpassword" name="cpassword" placeholder="Confirm Password" required>
            <div class = "gap1"></div>
            <input type="email" id="email" name="email" placeholder = "Email" required><br>
            <div class="gap1"></div>
            <input type="tel" id="phno" name="phno" placeholder = "Phone Number" required><br>
            <div class="gap2"></div>
            <input type="submit" value="Register"><br>
            <br>
        </form>                     
        <div class="divider">
            <span>OR</span>
        </div>
    </div> 
    <div class="b">
        Already have an account? <a style="font-weight:600; color:rgb(0,149,246)" href="login.php" class = "no-underline" >Login</a>
    </div>
</body>
</html>


