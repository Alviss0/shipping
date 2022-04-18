<!-- проверка входа -->
<?php include_once '../php/check.php' ?>

<?php

$FORM_NAME = 'orderForm';

$city = 'city';
$num_adults = 'num_adults';
$num_teens = 'num_teens';
$num_kids = 'num_kids';
$food = 'food';
$events = 'events';
$auto = 'auto';
$cost = 'cost';


$name = 'name_user';
$email = 'email_user';
$pay = 'pay';

$confirmFormValues = array();
$confirmFormValues[0] = "";
$confirmFormValues[1] = "";

$ORDERED = false;

if(isset($_REQUEST['continue'])) {
             $ORDERED = true;
} else if (isset($LOG_IN) && isset($_SESSION['ordered'])) {
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
        Подтверждение заказа<br> <img src="../img/line.gif" width="402" height="2" align="right">
    </h1>
    </header>
            <div class="content">
                <?php if (isset($LOG_IN) && $LOG_IN && $ORDERED): ?>
                    <p>Проверьте заказ</p>
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
                                <?= $_SESSION[$auto] ."Евро" ?>
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

                    <form name="order_confirm_form" action="basket.php" method="post">
                        <div>
                            <p><label for="f-name">Ваше имя:</label><input name="confirmForm[0]" required type="text" id="f-name" placeholder = "Иван Иванов" value="<?=$confirmFormValues[$F_NAME]?>"></p>
                        </div>
                        <div>
                            <p><label for="f-email">Ваша почта:</label><input name="confirmForm[1]" required type="email" id="f-email" placeholder = "name@email.com" value="<?=$confirmFormValues[$F_EMAIL]?>"></p>
                        </div>
                        <div>
                            <div>Форма оплаты</div><br>
                            <input type="radio" name="confirmForm[2]" checked value="Карта">Карта</input><br>
                            <input type="radio" name="confirmForm[2]" value="Наличные">Наличные</input><br>

                        </div>
                        <p><input  name="Confirm" type="submit" value="Подтвердить заказ"></p>
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