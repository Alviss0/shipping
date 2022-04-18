<?php include_once 'check.php' ?>
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

function file_download($file) {
    if (file_exists($file)) {
        if (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
}

if(isset($_REQUEST['download'])) {

    $file_name = $_SESSION[$name] . ' - ' . $_SESSION[$email] . '.txt';

    $file_data = "Имя: " . $_SESSION[$name] . "\nПочта: " . $_SESSION[$email];
    $file_data .= "\nТип тура: " . $_SESSION[$city];
    $file_data .= "\nПитание: " . $_SESSION[$food];
    $file_data .= "\nЭкскурсии: " . implode(', ', $_SESSION[$events]);
    $file_data .= "\nАвтопакет: " . $_SESSION[$auto];
    $file_data .= "\n---------------------------";
    $file_data .= "\nОбщая стоимость: " . $_SESSION[$cost];

    file_put_contents($file_name, $file_data);

    echo $file_name;
    echo $file_data;

    file_download($file_name);
    unlink($file_name);
}