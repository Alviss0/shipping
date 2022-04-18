
<?php //панель навигации
    if(!isset($LOG_IN))
    {
        $LOG_IN = false;
        $NAME_USER = "USER";
    }
?>

  <aside>
                <ul>
                    <li>
                        <img id='about' src="../img/menu_01.gif" width="23" height="24" align="absmiddle">&nbsp;&nbsp;&nbsp;<a
                            href="../index.php" class="over">ГЛАВНАЯ </a></li>
                    <li>
                        <img id='price' src="../img/menu_02.gif" width="23" height="24" align="absmiddle">&nbsp;&nbsp;&nbsp;<a
                            href="#">Цены</a></li><li>
                                <img id='services' src="../img/menu_03.gif" width="23" height="24" align="absmiddle">&nbsp;&nbsp;&nbsp;<a
                                    href="../pages/order.php">Заказ круиза</a></li><li>
                                        <img id='gallery' src="../img/menu_04.gif" width="23" height="24" align="absmiddle">&nbsp;&nbsp;&nbsp;<a
                                            href="#">Страхование грузов</a></li><li>
                                                <img id='where' src="../img/menu_05.gif" width="23" height="24" align="absmiddle">&nbsp;&nbsp;&nbsp;<a
                                                    href="#">Грузовые перевозки</a></li></ul>
    </aside>

<?php
    if(!$LOG_IN):
?>

<li>
    <p>АВТОРИЗАЦИЯ</p>
    <form name = "auth_form" action = "../index.php" method = "post">
        <div>
                <p>
                    <label for = "login_form">
                        Логин
                    </label>
                    <input name="Arr_form[0]" required type="text" id="login_form" value="
                    <?
                    =$formValues[0]
                    ?>
                    ">
                </p>

                <p>
                    <label for="password_form">
                        Пароль
                    </label>
                    <input name="Arr_form[1]" required type="password" id="password_form" value="
                    <?
                    =$formValues[1]
                    ?>">
                    </p>

        </div>
        <p>
            <input  name="login" type="submit" value="Войти">
        </p>
</li>

<?php endif; ?>

<?php if ($LOG_IN) :?>

<li>
    <p>
        Вы вошли как админ
    </p>
    <form name="auth_form" action="../index.php" method="post">
    <p>
        <input  name="logout" type="submit" value="Выйти">
    </p>
    </form>
</li>
        
<?php 
    endif; 
?>