<?php
header("Content-Type: application/json");

session_start(); 

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $response = ["user_id" => $user_id];
    echo json_encode($response);
} else {
    $response = ["error" => "User ID not found in the session"];
    echo json_encode($response);
}
?>