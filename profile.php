<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "trial";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['user_id'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone_number'];
        $userId = $_POST['user_id']; 

        $sql = "UPDATE user_profiles SET email=?, phone=? WHERE user_id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $email, $phone, $userId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Profile updated successfully!";
            } else {
                echo "Error updating profile: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the statement: " . mysqli_error($conn);
        }
    }

    if (isset($_FILES['profile_image']) && isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];
        $profileImage = $_FILES['profile_image']['name'];
        $targetPath = "uploads/" . $profileImage;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
            $sql = "UPDATE user_profiles SET profile_image=? WHERE user_id=?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "si", $profileImage, $userId);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Profile picture updated successfully!";
                } else {
                    echo "Error updating profile picture: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing the statement: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading profile picture.";
        }
    }
}

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    $sql = "SELECT * FROM user_profiles WHERE user_id=$userId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $phone = $row['phone'];
        $profileImage = $row['profile_image'];
    }
}

mysqli_close($conn);
?>
