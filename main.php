<!DOCTYPE html>
<html lang="en">
<style>
html{
background-color: #E6D1F2;
}
</style>
<head>
    <title>Artphoria: Where creativity takes flight</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar with Toggle</title>
    <link rel="stylesheet" href="main.css">
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



</head>
<body background ="uploads/Background.jpeg" ></body>
    <div class="top-icons">
        <a href="note.php"><i class="fa fa-pencil-alt"></i></a> 
        <a href="cart.php"><i class="fa fa-shopping-cart"></i></a> 
        
    </div>
    <div class="intro">
	<h1>Artphoria</h1><br>
        <h1>Where creativity takes flight.</h1>
    </div>
    <div class="menu-toggle" id="menu-toggle">&#9776;</div>
    <nav class="vertical-nav">
        <ul class="menu">
            <li><a href="#"></a></li>;
<br>
            <li><a href="sell.html">Sell&nbsp&nbsp</a></li>
            <li><a href="buy.php">Buy&nbsp&nbsp</a></li>
            <li><a href="tutorial.html">Learn&nbsp&nbsp</a></li>
        </ul>
    </nav>
    <section class="news">
        <?php
        function limitWords($text, $limit) {
            $words = explode(' ', $text);
            if (count($words) > $limit) {
                return implode(' ', array_slice($words, 0, $limit)) . '...';
            }
            return $text;
        }
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'trial';
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT title, image, info FROM news_articles";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<article class="news-article">';
                echo '<div class="article-header">';
                echo '<div class="logo">';
                echo '<img src="uploads/logo.jpg" alt="Artphoria Logo">';
                echo '</div>';
                echo '<div class="sender-info">';
                echo '<p class="sender">Artphoria Team</p>';
                echo '<p class="article-date" id="article-date"></p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="article-content">';
                echo '<h3>' . $row['title'] . '</h3>';
                echo '<img src="' . $row['image'] . '" alt="Article Image">';
                echo '<br><br>';
                echo '<p class="initial-content">' . limitWords($row['info'], 40) . '</p>';
                echo '<p class="hidden-content" style="display: none;">' . substr($row['info'], strpos($row['info'], limitWords($row['info'], 40)) + strlen(limitWords($row['info'], 40))) . '</p>';
                echo '<a href="#" class="read-more-link" id="readMoreBtn">Read More</a>';
                echo '</div>';
                echo '</article>';
            }
        }
        $conn->close();
        ?>
    </section>
    
    <div class="profile-toggle" id="profile-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg></div>
    <nav class="profile-nav">
        <ul class="profile-menu">
            <br>
            <li><a href="profile1.php">Profile</a></li>
            <li><a href="orders.php">Your Orders</a></li>
            <li><a href="index.html">Logout</a></li>
        </ul>
    </nav>
    <script>
    var readMoreLinks = document.querySelectorAll('.read-more-link');
    readMoreLinks.forEach(function (readMoreLink) {
        readMoreLink.addEventListener('click', function (event) {
            event.preventDefault();
            var articleContent = event.target.parentElement;
            var initialContent = articleContent.querySelector('.initial-content');
            var hiddenContent = articleContent.querySelector('.hidden-content');

            if (hiddenContent.style.display === 'none') {
                initialContent.innerHTML += hiddenContent.innerHTML;
                hiddenContent.style.display = 'block';
                readMoreLink.textContent = 'Read Less';
            } else {
                hiddenContent.style.display = 'none';
                readMoreLink.textContent = 'Read More';
            }
        });
    });
</script>
    <script src="main.js"></script>
</body>
</html>
