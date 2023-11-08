<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $db = new mysqli("localhost", "root", "", "trial");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $query = "SELECT user_id, username, password FROM users_table WHERE username=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];
        echo '<script>window.location.href = "main.html";</script>';
        exit;
    } else {
        $error_message = "Invalid username or password";
    }
    $db->close();
}
?>
