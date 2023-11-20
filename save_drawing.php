<?php
header("Content-Type: application/json");
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "trial";
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    $response = ["success" => false, "error" => "Database connection failed"];
    echo json_encode($response);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        if (isset($data["drawingDataUrl"]) && isset($data["user_id"])) {
            $drawingDataUrl = $data["drawingDataUrl"];
            $userID = $data["user_id"];
            $stmt = $conn->prepare("INSERT INTO drawings (user_id, image_data) VALUES (?, ?)");
            $stmt->bind_param("is", $userID, $drawingDataUrl);

            if ($stmt->execute()) {
                $response = ["success" => true, "message" => "Drawing saved successfully"];
                echo json_encode($response);
            } else {
                $response = ["success" => false, "error" => "Error saving the drawing"];
                echo json_encode($response);
            }

            $stmt->close();
        } else {
            $response = ["success" => false, "error" => "Drawing data or user ID not provided"];
            echo json_encode($response);
        }
    } else {
        $response = ["success" => false, "error" => "Invalid data"];
        echo json_encode($response);
    }
}

$conn->close();
?>

