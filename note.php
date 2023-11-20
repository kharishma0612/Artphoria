
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="note.css">
<div class="header">
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
    </div>
</head>
<body background ="uploads/Background.jpeg" ></body>
    <div class="container" style="background-color: #ebdef0;">
        <h1>Notes and Drawings</h1>
        <div class="input-section">
            <textarea id="noteText" rows="5" cols="40" placeholder="Write your note..."></textarea>
        </div>
        <div class="buttons">
            <button id="saveNoteButton" style="background-color: #bb8fce; color: #fff;">Save Note</button>
        </div>
            <form id="artworkForm" action="sample.php" method="post" enctype="multipart/form-data">
                <div class="input-image" style = " width: 100%;
    border: 1px solid #fff;
    border-radius: 5px;
    background-color:#fff">
                    <p style = 'text-align:center;margin-top:10px;'>Save your Image</p>
                    <br>
                    <input type="file" id="artworkImage" name="artworkImage" accept="image/*" style ='display:flex;justify-content:center;';>
                </div>
        <div class="buttons">
            <button id="saveDrawingButton" style="background-color: #bb8fce; color: #fff;">Save Drawing</button>

        </div>
        </form>
        <div class="notes-list" >
            <h2>Your Notes and Drawings</h2>
            <?php include('sample.php'); ?>
        </div>
    </div>
    <script src="note.js"></script>
</body>
</html>
