<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     Main Index module                   **
 **                                         */

if (file_exists('config.php')) {
    require_once 'config.php';
}
else { // Если файла конфигурации не существует, вывести путь к установщику
    require_once './local/default.php';
    echo Language::errorConfigNotExists;
    die ("<a href=\"./install\">INSTALL</a>");
}

require_once './gears/dbAccess.php';
require_once './gears/docContent.php';

$dbAccess   = new DbAccess;

if (!$dbAccess->dbConnect()) {
    require_once './local/default.php';
    die (Language::errorDbConnect);
}
else {
    // К базе подключились успешно, прочесть настройки
    $param_lang = $dbAccess->getSettingByName("lang");
    $param_skin = $dbAccess->getSettingByName("skin");
    $param_name = $dbAccess->getSettingByName("scname");
    // Подключение языкового файла
    if (file_exists('./local/'.$param_lang.'.php')) {
        require_once './local/'.$param_lang.'.php'; 
    }
    else {
        require_once './local/default.php'; 
    }
    // Подключение класса контента
    require_once './gears/docContent.php';
    // Создание объекта и запуск конструктора
    $docContent = new DocContent;
    // Получение пути к файлам темы
    $docContent->skinPath = "./skins/".$param_skin."/";
    // Имя сервисного центра
    $docContent->header = $param_name;
    // Старт сессии
    require_once './gears/session.php';
    // Подключение HTML темы
    require_once $docContent->skinPath.'main.php'; 
}




