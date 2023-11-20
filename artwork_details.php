<!DOCTYPE html>
<html>
<head>
<style>
.enlarged-artwork {
    background-color: #E6D1F2;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    width: 80%;
    margin: 0 auto;
}
.btn-info {
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
    margin-bottom: 15px;
    
}

.enlarged-image {
    width: 50%;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 20px;
}

.logo img {
    border-radius: 5%;
    margin: 10px 10px;
    width: 200px;
}

</style>
</head>
<body background="uploads/Background.jpeg">
    <div class="header">
        <div class="header-content">
            <div class="logo">
                <img src="uploads/logoname.png" alt="Your Logo">
            </div>
        </div>
    </div>
    <?php
    session_start();

    if (isset($_GET['artwork_id'])) {
        $artwork_id = $_GET['artwork_id'];

        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'trial';
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $select_query = "SELECT * FROM `artwork_entries` WHERE `id` = $artwork_id";
        $result_query = mysqli_query($conn, $select_query);

        if ($row = mysqli_fetch_assoc($result_query)) {
            $description = $row['description'];
            $artwork_image = $row['artwork_image'];
            $artist_name = $row['artist_name'];
            $artwork_title = $row['artwork_title'];
            $artwork_price = $row['artwork_price'];
            $artwork = '' . $artwork_image;

            echo "<div class='enlarged-artwork'>
                    <form method='post' action='buy.php'>
                        <img src='$artwork' alt='$artwork_title' class='enlarged-image'>
                        <p class='card-text'>$artwork_title</p>
                        <p class='card-text'>$description</p>
                        <p class='card-price'>Price: $artwork_price</p>
                        <p class='card-artist'>Artist: $artist_name</p>
                        <input type='hidden' name='artwork_id' value='$artwork_id'>
                        <input type='hidden' name='artwork_title' value='$artwork_title'>
                        <input type='hidden' name='artwork_description' value='$description'>
                        <input type='hidden' name='artwork_price' value='$artwork_price'>
                        <input type='hidden' name='artist_name' value='$artist_name'>
                        <input type='hidden' name='artwork_image' value='$artwork_image'>
                        <button type='submit' name='add_to_cart' class='btn btn-info'>Add to Cart</button>
                        <button type='submit' name='buy_now' class='btn btn-info'>Buy Now</button>
                    </form>
                </div>";
        } else {
            echo "Artwork not found.";
        }
    } 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['add_to_cart'])) {
        $artwork_id = $_POST['artwork_id'];
        $user_id = $_SESSION['user_id'];

        $check_query = "SELECT * from sample_cart where artwork_id = $artwork_id and user_id = $user_id";
        $check_query_result = $conn->query($check_query);

        if ($check_query_result->num_rows === 0) {
            $insert_query = "INSERT INTO sample_cart (artwork_id, user_id) 
                             VALUES ('$artwork_id', '$user_id')";

            if ($conn->query($insert_query)) {
                echo "<script>
                        alert('Added to cart successfully!');
                        window.location.href = 'buy.php';
                      </script>";
            } else {
                die('Error: ' . mysqli_error($conn));
            }
        }
    }

    if (isset($_POST['buy_now'])) {
        $artwork_id = $_POST['artwork_id'];
        $user_id = $_SESSION['user_id'];
        

        $check_query = "SELECT * from buy where artwork_id = $artwork_id and user_id = $user_id";
        $check_query_result = $conn->query($check_query);

        if ($check_query_result->num_rows === 0) {
            $insert_query = "INSERT INTO buy (user_id, artwork_id) 
                             VALUES ('$user_id', '$artwork_id')";

            if ($conn->query($insert_query)) {
                echo "<script>
                        alert('Added to buy successfully!');
                        window.location.href = 'buy.php';
                      </script>";
            } else {
                die('Error: ' . mysqli_error($conn));
            }
        }
    } else {
        echo "Artwork ID not provided.";
    }}
    ?>
</body>
</html>
