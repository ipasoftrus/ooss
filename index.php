<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     Main Index module                   **
 **                                         */

require_once 'config.php';
require_once './gears/dbAccess.php';
require_once './gears/docContent.php';

$dbAccess   = new DbAccess;

if (!$dbAccess->dbConnect()) {
    require_once './local/default.php';
    die (Language::errorDbConnect);
}
else {
    // К базе подключились успешно, прочесть настройки
    require_once './gears/docContent.php';
    $docContent = new DocContent;
    $docContent->skinPath = "./skins/".$dbAccess->getSettingByName("skin")."/";
    require_once $docContent->skinPath.'main.php'; // Подключение HTML темы
    
}




