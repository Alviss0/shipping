<!-- проверка входа -->
<?php 
    session_start();
?>

<?php
//массив для хранения
$formValues = array();

$formValues[0] = "";
$formValues[1] = "";
$FORM_FIELDS_NAME = "Arr_form";

$NAME_USER = "";

$LOG_IN = false;

if (isset($_SESSION['name_user'])) 
{
    $LOG_IN = true;
    $NAME_USER = $_SESSION['name_user'];
}

//проверяю корректность логина и пароля при входе
if (isset($_REQUEST['login'])) 
{
    $NAME_USER = $_REQUEST[$FORM_FIELDS_NAME][0];
    $USER_PASSWORD = $_REQUEST[$FORM_FIELDS_NAME][1];

    if ($NAME_USER == "admin" && $USER_PASSWORD == "123") {
        $LOG_IN = true;
        $_SESSION['name_user'] = $NAME_USER;
    }
    else{
        $_SESSION['log_fail'] = 'Ошибка входа, повторите попытку';
        header('Location: ../index.php');
    }
}

//если пользователь выходит, завершаем сессию
if (isset($_REQUEST['logout'])) 
{
    $LOG_IN = false;
    session_destroy();
}
?>