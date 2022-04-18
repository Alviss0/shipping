<!-- проверка входа -->
<?php include_once '../php/check.php' ?>


<?php

$FORM_NAME = 'orderForm';

/*
0 - тип тура
1 - кол-во взрослых
2 - кол-во подростков
3 - кол-во детей
4 - тип еды
5 - экскурсии
6 - автопакет
*/

$city = 'city';
$num_adults = 'num_adults';
$num_teens = 'num_teens';
$num_kids = 'num_kids';
$food = 'food';
$events = 'events';
$auto = 'auto';
$cost = 'cost';

$ORDERED = false;

//обработка
if(isset($_REQUEST['next'])) {
    $_SESSION['ordered'] = true;
    $ORDERED = true;
    $_SESSION[$city] = $_REQUEST[$FORM_NAME][0];
    $_SESSION[$num_adults] = (int)$_REQUEST[$FORM_NAME][1];
    $_SESSION[$num_teens] = (int)$_REQUEST[$FORM_NAME][2];
    $_SESSION[$num_kids] = (int)$_REQUEST[$FORM_NAME][3];
    $_SESSION[$food] = $_REQUEST[$FORM_NAME][4];
    if (isset($_REQUEST[$FORM_NAME][5])) {
        $_SESSION[$events] = $_REQUEST[$FORM_NAME][5];
    } else {
        $_SESSION[$events] = array();
    }

    if (isset($_REQUEST[$FORM_NAME][6]) && $_REQUEST[$FORM_NAME][6] == 'Автопакет') {
        $_SESSION[$auto] = 'да';
    } else {
        $_SESSION[$auto] = 'нет';
    }
  
    $sum = 0;//стоимость поездки
    //подсчет кол-ва человек
    $total_people = $_SESSION[$num_adults] + $_SESSION[$num_teens] + $_SESSION[$num_kids];

    //учитываю направление круиза
    if ($_SESSION[$city] == "Хельсинки") {
        $sum += 1000 * $total_people;
    } else if ($_SESSION[$city] == "Осло") {
        $sum += 3000 * $total_people;
    } else if ($_SESSION[$city] == "Гамбург") {
        $sum += 2000 * $total_people;
    }

    //учитываю тип питания
    if ($_SESSION[$food] == "Полупансион") {
        $sum += 35 * $_SESSION[$num_adults] + 18 * $_SESSION[$num_teens]  + 10 * $_SESSION[$num_kids];
    } else if ($_SESSION[$food] == "Завтрак") {
        $sum += 12 * $_SESSION[$num_adults] + 6 * $_SESSION[$num_teens]  + 2 * $_SESSION[$num_kids];
    } 
    else if ($_SESSION[$food] == "Ужин") {
        $sum += 25 * $_SESSION[$num_adults] + 12 * $_SESSION[$num_teens]  + 6 * $_SESSION[$num_kids];
    }

    //учитываю выбранные экскурсии
    if (in_array("Старые замки", $_SESSION[$events])) {
        $sum += 20 * $total_people;
    }

    if (in_array("Морская прогулка", $_SESSION[$events])) {
        $sum += 50 * $total_people;
    }

    if (in_array("Подземелье", $_SESSION[$events])) {
        $sum += 30 * $total_people;
    }
    
    if ($_SESSION[$_S_CAR_KEY] == 'да') {
        $sum += 60;
    }


    $_SESSION[$cost] = $sum;
} 
else if (isset($LOG_IN) && isset($_SESSION['ordered'])) {
    $ORDERED = true;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Морские круизы</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../css/kruis.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<header>
    <img src="../img/top.jpg" width="769" height="127" /><br>
</header>

    <section>
    <?php include_once '../php/nav_bar.php' ?>
        <section>
        <header>
    <h1>
        Проверьте заказ<br> <img src="../img/line.gif" width="402" height="2" align="right">
    </h1>
    </header>
            <div class="content">
                <?php if (isset($LOG_IN) && $LOG_IN && $ORDERED): ?>
                    <p>Проверьте детали Вашего заказа</p>
                    <table>
                        <tr>
                            <td>
                                Тип тура
                            </td>
                            <td>
                                <?=$_SESSION[$city]?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Количество взрослых (от 17 лет)
                            </td>
                            <td>
                                <?=$_SESSION[$num_adults]?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Количетсво детей (от 12 до 17 лет)
                            </td>
                            <td>
                                <?=$_SESSION[$num_teens]?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Количетсво детей (до 12 лет)
                            </td>
                            <td>
                                <?=$_SESSION[$num_kids]?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Питание
                            </td>
                            <td>
                                <?=$_SESSION[$food]?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Экскурсии
                            </td>
                            <td>
                                <?= implode(', ', $_SESSION[$events])?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Автопакет
                            </td>
                            <td>
                                <?= $_SESSION[$auto]?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Общая стоимость
                            </td>
                            <td>
                                <?= $_SESSION[$cost]?>
                            </td>
                        </tr>
                    </table>
                    <form name="order_confirm_form" action="bill_2.php" method="post">
                        <p><input  name="continue" type="submit" value="Продолжить"></p>
                        <a href="order.php" style="color: black; border: 1px solid black; background: #AAAAAA">Назад</a>
                    </form>
                <?php endif; ?>
                <?php if (isset($LOG_IN) && $LOG_IN && !$ORDERED): ?>
                    <p>Заказ не сформирован</p>
                <?php endif; ?>

                <?php if (!isset($LOG_IN) || !$LOG_IN): ?>
                    <p>Заказ круиза доступен только авторизированным пользователям!</p>
                    <p>Пожалуйста, авторизируйтесь. </p>
                <?php endif; ?>
                        </div>
        </section>
    </section>
    <footer>
         Copyright&copy;2012&quot;Морские круизы&quot; 
    </footer>

</div>
</body>
</html>