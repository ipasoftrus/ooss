<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     User authorization module           **
 **                                         */

require_once './../config.php';
require_once './dbAccess.php';
require_once './session.php';

$userName = $_POST['login'] ?? "";
$userPassword = $_POST['password'] ?? "";
$logoutflag = $_POST['d'] ?? "";

if (($userName == "") && ($userPassword == "") && ($logoutflag == "")) { // Ошибочный вызов модуля авторизации
    die("then...");
}

if ($logoutflag == "exit") { // выход из системы
    require_once './session.php';
    $session = new OOSSSession();
    $session->destroy();
    // Сессия уничтожена
    header('Location: ./../index.php');
    exit();
}

$dbAccess = new DbAccess;
if (!$dbAccess->dbConnect()) { // Подключение к БД
    require_once './local/default.php';
    die (Language::errorDbConnect);
}
// Ищем пользователя в БД
$id = $dbAccess->findUser($userName);
if ($id == 0) { // Если пользователь не найден
    header('Location: ./../index.php?er=un');
    exit();
}
else {
    // получение полной информации о пользователе
    $info = $dbAccess->getUserInfo($id);
    // Проверка введенного пароля
    if ($userPassword != $info['pwd']) { // Неверный пароль
        header('Location: ./../index.php?er=pwd');
        exit();
    }
    else { // Все верное. Создаем сессию
        require_once './session.php';
        $session = new OOSSSession();
        $session->setSes($info['id'], $info['pwd'], $info['role']);
        // Сессия готова, авторизация прошла успешно
        header('Location: ./../index.php');
        exit();
    }
}
