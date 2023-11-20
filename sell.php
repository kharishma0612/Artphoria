<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'trial';
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artistName = $_POST["artistName"];
    $artworkTitle = $_POST["artworkTitle"];
    $artworkPrice = $_POST["artworkPrice"];
    $description = $_POST["description"];
    $contactInfo = $_POST["contactInfo"];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["artworkImage"]["name"]);
    $sql = "INSERT INTO artwork_entries (artist_name,artwork_title, artwork_price, description, contact_info, artwork_image) VALUES ('$artistName','$artworkTitle', '$artworkPrice','$description', '$contactInfo', '$targetFile')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                    alert('Form submitted successfully!');
                    window.location.href = 'main.php';
                  </script>";
            exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
