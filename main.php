<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Погода</title>
</head>
<body>
<video autoplay loop muted class="bgvideo" id="bgvideo">
    <source src="Fishermen-Resting.mp4" type="video/mp4">
</video>

<div class="main-container">
    <p class="fieldset-image"><img src="image.png" width="400" height="400"></p>
    <h1 class="main-container__h1">WEATHER</h1>
    <form method="post" action="weather.php">
        <p class="main-container-p__button"><button class="main-container__button">GO</button></p>
    </form>

</div>
</body>
</html>