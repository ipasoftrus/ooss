<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     User authorization module           **
 **                                         */

require_once './../config.php';
require_once './dbAccess.php';
require_once './session.php';

$userName = $_POST['un'] ?? "";
$userPassword = $_POST['pwd'] ?? "";
if (($userName == "") || ($userPassword == "")) { // Ошибочный вызов модуля авторизации
    die("then...");
}
echo $userName.":".$userPassword;
$dbAccess = new DbAccess;
if ($dbAccess->dbConnect()) { // Если успешно подключились
    
}