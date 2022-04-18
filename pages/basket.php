<!-- проверка входа -->
<?php include_once '../php/check.php' ?>
<?php

$FORM_NAME = 'confirmForm';


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


$ORDERED = false;

if(isset($_REQUEST['Confirm'])) {
    $_SESSION['confirmed'] = true;

    $_SESSION[$name] = $_REQUEST[$FORM_NAME][0];
    $_SESSION[$email] = $_REQUEST[$FORM_NAME][1];
    $_SESSION[$pay] = $_REQUEST[$FORM_NAME][2];
    

   if (!isset($_SESSION['mailed'])) {
       $body = "Добрый день, " . $_SESSION[$_S_NAME] . "!<br><br>Вы оформили заказ:<br><br><b>Почта:</b> " . $_SESSION[$_S_EMAIL];
       $body .= "<br><b>Тип тура:</b> " . $_SESSION[$city];
       $body .= "<br><b>Питание:</b> " . $_SESSION[$food];
       $body .= "<br><b>Экскурсии:</b> " . implode(', ', $_SESSION[$events]);
       $body .= "<br><b>Автопакет:</b> " . $_SESSION[$auto];
       $body .= "<br>------------------------------------------------------------------";
       $body .= "<br><b>Общая стоимость: " . $_SESSION[$cost] . " Евро.</b>";
       $body .= "<br><b>Оплата:</b> " . $_SESSION[$pay];

       $from = "mail@mail.ru";
       $to = $_SESSION[$email];
       $subj = "Подтверждение заказа!";
       $msg = $body;
       $hdr = "Content-type: text/html; charset=utf-8\r\n" . "From: $from" . "\r\n" . "Reply-To: $from" . "\r\n" . "X-Mailer: PHP/" . phpversion();
       mail($to, $subj, $msg, $hdr)
      $_SESSION['mailed'] = true;

      $file_name = $_SESSION[$name] . ' - ' . $_SESSION[$email] . '.txt';
      $filepath = $filename;
      $fp = fopen($filepath,"r");
      $file = fread($fp, filesize($filepath));

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
        Заказ оформлен<br> <img src="../img/line.gif" width="402" height="2" align="right">
    </h1>
    </header>
            <div class="content">
                <?php if (isset($LOG_IN) && $LOG_IN && $_SESSION['confirmed']): ?>
                    <p><?=  $_SESSION[$name]?>,<br>Ваш заказ на сумму  <?= $_SESSION[$cost]?> евро подтвержден, записан в файл и отправлен по почте</p>
                    <form name="download" action="../php/download_file.php" method="post">
                        <p><input  name="download" type="submit" value="Скачать файл"></p>
                    </form>
                    <?php endif; ?>

                <?php if (isset($LOG_IN) && $LOG_IN && !$_SESSION['confirmed']): ?>
                    <p>Заказ не подтвержден</p>
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
