<?php
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "trial";
    $db = new mysqli($hostname, $username, $password, $database);
    $errorMessage = '';
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $loginInput = $_POST['username']; 
    $password = $_POST['password'];
    $loginQuery = "SELECT * FROM users_table 
                   WHERE username = '$loginInput' 
                      OR phone_number = '$loginInput' 
                      OR email = '$loginInput'";
    
    $result = $db->query($loginQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
          
            header("Location: main.php");
            exit();
        } 
    } else {
        echo "User not found.";
    }

    $db->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Artphoria</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
<link rel="manifest" href="../assets/site.webmanifest">

</head>
<body background ="uploads/Background.jpeg" >
<div class="a">
    <img width="220" src="uploads/logoname.png" alt="Logo"><br><br>
    <?php
        $errorMessage = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!(password_verify($password, $hashedPassword)))  {
                $errorMessage = "wrong password";
            }
        }
        ?>
    <form action="login.php" method="POST">
        <p style="color: red;"><?php  echo $errorMessage; ?></p>
        <input type="text" id="Phone" name="username" placeholder="Phone number, username, or email"><br>
        <div class="gap1"></div>
        <input type="password" id="Pwd" name="password" placeholder="Password">
        <div class="gap2"></div>
		<a href =  "main.html">
        <button type="submit">Log in</button><br>
		</a>
    </form>
    <br>
    <div class="divider">
        <span>OR</span>
    </div>
    <br>
<div class="b">
    Don't have an account? <a style="font-weight: 600; color: rgb(0, 149, 246)" href="signup.php" class="no-underline">Sign up</a>
</div>
</body>
</html>

