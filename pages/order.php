<!-- проверка входа -->
<?php include_once '../php/check.php' ?>


<?php
$orderDetails = array();
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

if (isset($LOG_IN) && isset($_SESSION['ordered'])) {
    $orderDetails[0] = $_SESSION[$city];
    $orderDetails[1] = $_SESSION[$num_adults];
    $orderDetails[2] = $_SESSION[$num_teens];
    $orderDetails[3] = $_SESSION[$num_kids];
    $orderDetails[4] = $_SESSION[$food];
    $orderDetails[5] = $_SESSION[$events];
    $orderDetails[6] = $_SESSION[$auto] == 'да' ? 'Автопакет' : '';
}
//  else {
//     $orderFormValues[$F_NUMBER_OF_ADULT] = 0;
//     $orderFormValues[$F_NUMBER_OF_CHILD] = 0;
//     $orderFormValues[$F_NUMBER_OF_VERY_CHILD] = 0;
//     $orderFormValues[$F_TOUR_TYPE] = 'Хельсинки';
//     $orderFormValues[$F_FOOD] = 'Полупансион';
//     $orderFormValues[$F_EVENTS] = array();
//     $orderFormValues[$F_CAR] = '';
// }

function selected( $value, $remember){
    return
        $value == $remember ? 'selected' : null;
}

function checked( $value, $remember){
    return
        $value == $remember ? 'checked' : null;
}

function checked_checkbox( $value, $remember){
    return
        $value == in_array($value, $remember) ? 'checked' : null;
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
    <img src="img/top.jpg" width="769" height="127" /><br>
</header>
    <section>
    <?php include_once '../php/nav_bar.php' ?>
        <section>
    <header>
    <h1>
        Заказ круиза<br> <img src="../img/line.gif" width="402" height="2" align="right">
    </h1>
    </header>
            <div class="content">
                <?php if (isset($LOG_IN) && $LOG_IN): ?>
                    <form name="order_form" action="bill_1.php" method="post">
                        <div>
                            <div>Вид тура</div><br>
                            <input type="radio" name="orderForm[0]" <?=checked("Хельсинки",$orderDetails[0])?> value="Хельсинки">Хельсинки</input><br>
                            <input type="radio" name="orderForm[0]" <?=checked("Осло", $orderDetails[0])?> value="Осло">Осло</input><br>
                            <input type="radio" name="orderForm[0]" <?=checked("Гамбург", $orderDetails[0])?> value="Гамбург">Гамбург</input><br>
                        </div>

                        <div>
                            <p><label for="num-adult">Количетсво взрослых (от 17 до 1000 лет):</label><input name="orderForm[1]" required type="number" id="num-adult" value="<?=$orderDetails[1]?>"></p>
                            <p><label for="num-teens">Количетсво детей (от 12 до 17 лет):</label><input name="orderForm[2]" required type="number" id="num-teens" value="<?=$orderDetails[2]?>"></p>
                            <p><label for="num-kids">Количетсво детей (до 12 лет):</label><input name="orderForm[3]" required type="number" id="num-kids" value="<?=$orderDetails[3]?>"></p>
                        </div>
                        <div>
                            <div>Питание</div><br>
                            <select name="orderForm[4]" >
                                <option <?=selected("Полупансион",$orderDetails[4])?> value="Полупансион">Полупансион</option>
                                <option <?=selected("Завтрак",$orderDetails[4])?> value="Завтрак">Завтрак</option>
                                <option <?=selected("Ужин",$orderDetails[4])?> value="Ужин">Ужин</option>
                            </select>
                        </div>

                        <div>
                            <div>Экскурсии</div><br>
                            <input type="checkbox" <?=checked_checkbox("Старые замки",$orderDetails[5])?> name="orderForm[5][0]" value="Старые замки"> Старые замки</input><br>
                            <input type="checkbox" <?=checked_checkbox("Морская прогулка",$orderDetails[5])?> name="orderForm[5][1]" value="Морская прогулка">Морская прогулка</input><br>
                            <input type="checkbox" <?=checked_checkbox("Подземелье",$orderDetails[5])?> name="orderForm[5][2]" value="Подземелье">Подземелье</input><br>
                        </div>

                        <div>
                            <input type="checkbox" 
                            <?=checked("Автопакет", $orderDetails[6])?> 
                            name="orderForm[6]" value="Автопакет">
                                Автопакет
                            </input>
                            <br>
                        </div>
                        <p><input  name="next" type="submit" value="Далее"></p>
                    </form>


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

</div>
</body>
</html>