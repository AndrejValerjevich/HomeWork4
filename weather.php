<?php
error_reporting(E_ALL);

if (!empty($_POST['city']))
{
    $city = $_POST['city'];
    if (!@file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=ae3e6ed4183035e6877bc1b3949325af") == false) {
        $current_weather_content = @file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=ae3e6ed4183035e6877bc1b3949325af");

        $response = json_decode($current_weather_content, true);

        $city = $response['name'];
        $temp = $response['main']['temp'];
        $sky = $response['weather'][0]['main'];

        $wind_speed = $response['wind']['speed'];
        $pressure = $response['main']['pressure'];
        $humidity = $response['main']['humidity'];
        $sunrise = $response['sys']['sunrise'];
        $sunset = $response['sys']['sunset'];

        #region//Перевод погоды на русский
        if ($sky == 'Clear') $rus_weather = 'Ясно';
        elseif ($sky == 'Clouds') $rus_weather = 'Облачно';
        elseif ($sky == 'Rain') $rus_weather = 'Дождь';
        elseif ($sky == 'Mist') $rus_weather = 'Туман';
        elseif ($sky == 'Snow') $rus_weather = 'Снег';
        elseif ($sky == 'Drizzle') $rus_weather = 'Переменная облачность;';
        #endregion
    }
    else {
        $_POST['city'] = null;
        $message = "Такого города не существует, попробуйте заново:)";
    }
}
else {
    $message = "Город еще не выбран, поэтому посмотрите пока что на эту красоту!";
    $city = "выберите!";
    $weather = "Выбрите город!";
}

function get_sunrise_date($sunrise)
{
    $date = date("H:i", $sunrise);
    date_default_timezone_set('UTC');

    return $date;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Погода: <?= $city?></title>
</head>
<body>
<video autoplay loop muted class="bgvideo" id="bgvideo">
    <source src="Fishermen-Resting.mp4" type="video/mp4">
</video>
<header class="navigation clearfix">
    <ul class="navigation__ul">
        <li class="navigation__ul__item"><a class="navigation__ul__item__logo" href="main.php"><img class="navigation__ul__item__logo" src="image.png" alt="Главная страница"></a></li>
        <li class="navigation__ul__item"><a class="navigation__ul__item__link" href="main.php">Главная</a></li>
        <li class="navigation__ul__item"><a class="navigation__ul__item__link" href="main.php">О сервисе</a></li>
        <li class="navigation__ul__item-last">Город:<span class="navigation__ul__item__link__city"><?= $city?></span></li>
    </ul>
</header>

<div class="weather-container">
    <div class="weather-container__search-area">
        <div class="weather-container__search-area__search">
            <form class="weather-container__search-area__search__form" action="weather.php" method="post">
                <input type="text" name="city" placeholder="Введите город" class="weather-container__search-area__search__form__text">
                <input type="submit" class="weather-container__search-area__search__form__button">
            </form>
        </div>
    </div>
    <?php if(!empty($_POST['city'])) {?>
    <div class="weather-container__content-area">
        <h1 class="weather-container__content-area__header">Текущая погода:</h1>
        <div class="weather-container__content-area__content clearfix">
            <div class="weather-container__content-area__content-left">
                <h2 class="weather-container__content-area__text-h2"><?= $city?></h2>
                <table class="weather-container__content-area__content-left__table">
                    <tr class="weather-container__content-area__content-left__table-row">
                        <td class="weather-container__content-area__content-left__table-firstcell">Погода</td>
                        <td class="weather-container__content-area__content-left__table-cell"><?= $rus_weather?></td>
                    </tr>
                    <tr class="weather-container__content-area__content-left__table-row">
                        <td class="weather-container__content-area__content-left__table-firstcell">Скорость ветра</td>
                        <td class="weather-container__content-area__content-left__table-cell"><?= $wind_speed?> м/с</td>
                    </tr>
                    <tr class="weather-container__content-area__content-left__table-row">
                        <td class="weather-container__content-area__content-left__table-firstcell">Давление</td>
                        <td class="weather-container__content-area__content-left__table-cell"><?= round($pressure * (0.750062))?> мм рт.ст.</td>
                    </tr>
                    <tr class="weather-container__content-area__content-left__table-row">
                        <td class="weather-container__content-area__content-left__table-firstcell">Влажность</td>
                        <td class="weather-container__content-area__content-left__table-cell"><?= $humidity?>%</td>
                    </tr>
                    <tr class="weather-container__content-area__content-left__table-row">
                        <td class="weather-container__content-area__content-left__table-firstcell">Восход</td>
                        <td class="weather-container__content-area__content-left__table-cell"><?= get_sunrise_date($sunrise);?></td>
                    </tr>
                    <tr class="weather-container__content-area__content-left__table-row">
                        <td class="weather-container__content-area__content-left__table-firstcell">Закат</td>
                        <td class="weather-container__content-area__content-left__table-cell"><?= date('H:i',$sunset)?></td>
                    </tr>
                </table>
            </div>
            <div class="weather-container__content-area__content-right">
                <p class="weather-container__content-area__image"><img src="<?=$sky?>.png" width="250" height="250"></p>
                <p class="weather-container__content-area__text"><?= round($temp-273,1) ?>&degC</p>
                </div>
        </div>
    </div>
    <?php } else {?>
    <div class="weather-container__content-area">
        <p class="weather-container__content-area__text-empty"><?= $message?></p>
        <p class="weather-container__content-area__image"><img src="sea.jpg"></p>
    </div>
    <?php }?>
</div>
</body>
</html>
