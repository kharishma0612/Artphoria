<!DOCTYPE html>
<html lang="en">
<head>
    <style>
         header {
    padding: 10px 0;
}
.container{
    margin-top:80px;
background-color: #E6D1F2;
margin-left:0px;
margin-bottom:100px;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.logo img {
    border-radius:5%;
    margin: 10px 10px;
    width: 200px;
}

.search-box {
    flex: 1;
    display: flex;
    justify-content: center;
}

.search-box input {
    width: 300px;
    padding: 5px;
    border: none;
    border-radius: 5px;
}

.search-box button {
    background-color: #555;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    margin-left: 5px;
    cursor: pointer;
}

.cart {
    font-size: 24px;
} 

.card {
    border: none;
    padding:10px;
    display: grid;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin: 80px;
    width: 100%;
    height:500px;
}
.card-title {
    font-size: 18px;
    margin: 10px 0;
}

.card-text {
    font-size: 14px;
    margin-bottom: 10px;
}

.card-price {
    font-size: 16px;
    color: #007BFF;
    font-weight: bold;
    margin-bottom: 10px;
}

.card-artist {
    font-size: 14px;
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
.buy-info {
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
    margin-bottom: 15px;
}
.image-style {
    width: 100%; 
    height: 300px;  
    object-fit: cover; 
}

</style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora&family=Montserrat+Alternates:wght@500&family=Poppins:wght@800&family=Roboto+Condensed&family=Roboto:wght@100&display=swap" rel="stylesheet">

<link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
<link rel="manifest" href="../assets/site.webmanifest">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
  
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
<link rel="manifest" href="../assets/site.webmanifest">
</head>
<body background="uploads/Background.jpeg">
    <div class="header">
        <div class="header-content">
            <div class="logo">
                <img src="uploads/logoname.png" alt="Your Logo">
            </div>
            <div class="search-box">
                <input type="search" id = "searchInput" placeholder="Search">
                <button id = "searchButton"><i class="fa fa-search"></i></button>
            </div>
            <div class="cart">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row justify-content-center">
                    <?php
                    $db_host = 'localhost';
                    $db_user = 'root';
                    $db_pass = '';
                    $db_name = 'trial';
                    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }
                    $select_query = "Select * from `artwork_entries` ORDER BY RAND() ";
                    $result_query = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $description = $row['description'];
                        $artwork_image = $row['artwork_image'];
                        $artist_name = $row['artist_name'];
                        $artwork_title = $row['artwork_title'];
                        $artwork_price = $row['artwork_price'];
                        $contact_info = $row['contact_info'];
                        $artwork = '' . $artwork_image;
                        echo "<div class='col-md-3 mb-4'>
                            <div class='card' style='background-color: #fff;'>
                                <div class='card-body' style='text-align: center;'>
                                    <div class='card-img'>
                                        <img src='$artwork' alt='$artwork_title' class='image-style'>
                                    </div>
                                    <p class='card-text'>$artwork_title</p>
                                    <p class='card-text'>$description</p>
                                    <p class='card-text'>Price : $artwork_price</p>
                                    <p class='card-text'>Artist : $artist_name</p>
                                    <a href='#' class='btn btn-info' style='margin-bottom: 10px;'>Buy now</a>
                                    <a href='#' class='btn btn-info' style='margin-bottom: 10px;'>Add to cart</a><br>
                                </div>
                            </div>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<script>
    document.getElementById('searchButton').addEventListener('click', function() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const cardTexts = document.querySelectorAll('.card-text');

        for (let index = 0; index < cardTexts.length; index++) {
            const cardText = cardTexts[index];
            const card = cardText.closest('.card');

            if (cardText.textContent.toLowerCase().includes(searchInput)) {
                card.style.border = '2px solid #007BFF';
                break;
            } else {
                card.style.border = 'none';
            }
        }
    });
</script>
</body>
</html>