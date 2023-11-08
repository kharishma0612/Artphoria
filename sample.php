<?php
  

    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "trial";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        die("Connection Failed: ". $conn->connect_error);
    }

    if(isset($_SESSION["user_id"])){

        $userid = $_SESSION["user_id"];
        $sql = "select content from notes where user_id = $userid";

        $result = mysqli_query($conn, $sql);
        $noteNumber = 1;
    echo "<div class='note-container'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='note-box'>" ;
        echo "<p>Note $noteNumber</p>";
        echo "<p>" . $row['content'] . "</p>";
        echo "</div>";
        $noteNumber++;
    }
    echo "</div>";
    } else{
        echo "User ID is not set in the session.";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .note-container {
            width :400px;
            flex-direction: column;
            align-items: center;
        }

        .note-box {
            background-color:#fff;
            border: 1px solid #000;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
</body>
</html>