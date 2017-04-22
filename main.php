<?php
error_reporting(E_ALL);

if (!empty($_GET["pageType"])) {
    $typeOfPage = $_GET["pageType"];

    if ($typeOfPage == "1") {
        $head = "Главная страница";
        $fieldsetClass = "main-container-fieldset__start";
    } else
        if ($typeOfPage == "2") {
            $head = "Адреса JSON";
            $fieldsetClass = "main-container-fieldset-info";
        }
}
else
{
    $head = "Главная страница";
    $fieldsetClass = "main-container-fieldset-pic";
}
$title = "JSON";

$content = file_get_contents('data.json');

$response = json_decode($content,true);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>JSON:)</title>
</head>
<body>
<header class="header-container">
    <div class="header-container__h1">
        <h1 class="header-container__h1__text"><?php echo $head; ?></h1>
        <a class="header-container-link" href="main.php?pageType=1">Главная</a>
        <a class="header-container-link" href="main.php?pageType=2">Адреса JSON</a>
    </div>
</header>
<div class="main-container">
    <fieldset class="<?php echo $fieldsetClass?>">
        <?php if ($_GET["pageType"] == 2) { ?>
        <table class="main-container-table">
            <tr class="table-row">
                <td class="table-cell">Фамилия</td>
                <td class="table-cell">Имя</td>
                <td class="table-cell">Адрес</td>
                <td class="table-cell">Телефон</td>
            </tr>
            <?php for ($i=0; $i<count($response); $i++) { ?>
            <tr class="table-row">
                <td class="table-cell"><?= $response[$i]['firstName'];?></td>
                <td class="table-cell"><?= $response[$i]['lastName'];?></td>
                <td class="table-cell"><?= $response[$i]['address'];?></td>
                <td class="table-cell"><?= $response[$i]['phoneNumber'];?></td>
            </tr>
        <?php } ?>
        </table>
        <?php } else { ?>
            <h1 class="main-container-fieldset__start__text-high"><?php echo $head; ?></h1>
            <p class="main-container-fieldset__start__pic-low"><img src="json.png" width="500" height="200"></p>
            <p class="main-container-fieldset__start__pic-low"><a href="main.php?pageType=2"><img  class="main-container-fieldset__start__pic-arrow" src="arrow.png"></a></p>
        <?php } ?>
    </fieldset>
</div>
</body>
</html>