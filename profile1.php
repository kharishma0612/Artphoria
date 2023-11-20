<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
    <link rel="manifest" href="../assets/site.webmanifest">
    <div class="header-content">
      <div class="logo">
      <a href="main.php">
          <img src="uploads/logoname.png" alt="Your Logo" style = '
border-radius:5%;
margin: 10px 10px;
width: 200px;
'>
      </a>
      </div>
  </div>
</head>
<body style="background-image: url('uploads/Background.jpeg');">
    <div class="box" style="background-color: #EBDEF0;">
        <div class="profile-container">
            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "trial";
            session_start(); 

            $conn = mysqli_connect($host, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_SESSION["user_id"])) {
                $userid = $_SESSION["user_id"];
                $picture_query = "SELECT profile_picture FROM users_table WHERE user_id = $userid";
                $picture_result = mysqli_query($conn, $picture_query);
                $picture_row = mysqli_fetch_assoc($picture_result);
                $picture = $picture_row['profile_picture'];
                $address_query = "SELECT address FROM users_table WHERE user_id = $userid";
                $address_result = mysqli_query($conn, $address_query);
                $address_row = mysqli_fetch_assoc($address_result);
                $address = $address_row['address'];
                $username_query = "SELECT username FROM users_table WHERE user_id = $userid";
                $username_result = mysqli_query($conn, $username_query);
                $username_row = mysqli_fetch_assoc($username_result);
                $username = $username_row['username'];
                $phno_query = "SELECT phone_number FROM users_table WHERE user_id = $userid";
                $phno_result = mysqli_query($conn, $phno_query);
                $phno_row = mysqli_fetch_assoc($phno_result);
                $phno = $phno_row['phone_number'];
                $email_query = "SELECT email FROM users_table WHERE user_id = $userid";
                $email_result = mysqli_query($conn, $email_query);
                $email_row = mysqli_fetch_assoc($email_result);
                $email = $email_row['email'];
                echo '
                    <div class="profile-picture">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="camera-icon">
                            <path d="M149.1 64.8L138.7 96H64C28.7 96 0 124.7 0 160V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H373.3L362.9 64.8C356.4 45.2 338.1 32 317.4 32H194.6c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/>
                        </svg>
                        <img id="profile-image" src="' . $picture . '">
                    </div>
                    <div class="update-button-container">
                        <form method="post" enctype="multipart/form-data" action="profile.php">
                            &nbsp&nbsp&nbsp&nbsp<input type="file" name="profile_image" id="file-input" accept="image/*" style = "justify-content :center;">
                            <br>
                            <br>
                            <p> Adress</p>
                            <input type="text" name="address" id="address" value="' . $address . '">
                            <br>
                            <br>
                            <p> Username</p>
                            <input type="text" name="username" id="username" value="' . $username . '">   
                            <br>
                            <br>
                            <p>Phone number</p>
                            <input type="tel" name="phno" id="phno" value="' . $phno . '">   
                            <br>
                            <br>
                            <p> Email</p>
                            <input type="email" name="email" id="email" value="' . $email . '">   
                            <br>
                            <br>
                            <input type="submit" class="update-button" name="submit" value="Save Changes" style = "background-color: #BB8FCE; font-size:10px; ">
                </form>';

            } else {
                echo "User ID is not set in the session.";
            }


            ?>
        </div>
    </div>
    <script src="profile.js"></script>
</body>