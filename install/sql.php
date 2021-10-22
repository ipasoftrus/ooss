<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     SQL queries for installation        **
 **                                         */
require_once '../config.php';
final class InstallSQL {
    public $crSettings = "CREATE TABLE `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."settings` "
            . "( `parameter` TEXT NOT NULL COMMENT 'Параметр' , `value` TEXT NOT NULL "
            . "COMMENT 'Значение' , UNIQUE `param` (`parameter`)) "
            . "ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'Таблица настроек';";
    public $crUsers = "CREATE TABLE `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."users` "
            . "( `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор' , "
            . "`pwd` TEXT NOT NULL COMMENT 'Пароль' , "
            . "`name` TEXT NOT NULL COMMENT 'Полное имя' , "
            . "`role` INT NOT NULL COMMENT 'Должность/права доступа' , "
            . "`email` TEXT NOT NULL COMMENT 'Электронная почта' , "
            . "`onDuty` INT NOT NULL COMMENT 'Работает или уволен' , "
            . "`address` TEXT NOT NULL COMMENT 'Адрес проживания' , "
            . "`picture` TEXT NOT NULL COMMENT 'URL аватарки' , "
            . "PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 "
            . "COLLATE utf8_general_ci COMMENT = 'Таблица пользователей';";
    public $crRepairLogs = "CREATE TABLE `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."repairlogs` "
            . "( `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор' , "
            . "`orderid` INT NOT NULL COMMENT 'Номер заказа' , "
            . "`whenstamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время изменения статуса' , "
            . "`user` INT NOT NULL COMMENT 'Кто изменил' , "
            . "`status` INT NOT NULL COMMENT 'Статус' , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    public $crServices = "CREATE TABLE `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."services` "
            . "( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор' , "
            . "`onDuty` INT UNSIGNED NOT NULL COMMENT 'Работает или закрыт' , "
            . "`address` TEXT NOT NULL COMMENT 'Местонахождение' , "
            . "`phones` TEXT NOT NULL COMMENT 'Список номеров телефонов' , "
            . "`owner` INT NOT NULL COMMENT 'ID владельца филиала (для письменных обращений)' , "
            . "`schedule` TEXT NOT NULL COMMENT 'График работы' , PRIMARY KEY (`id`)) "
            . "ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci "
            . "COMMENT = 'Список филиалов сервисных центров';";
    public $crZip = "CREATE TABLE `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."zip` "
            . "( `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор' , "
            . "`type` INT NOT NULL COMMENT 'Тип группа / изделие' , "
            . "`parent` INT NOT NULL COMMENT 'Родительская группа' , "
            . "`partnumber` TEXT NOT NULL COMMENT 'Артикул' , "
            . "`name` TEXT NOT NULL COMMENT 'Наименование' , "
            . "`descr` TEXT NOT NULL COMMENT 'Примечание' , "
            . "`cost` FLOAT NOT NULL COMMENT 'Стоимость' , "
            . "`hintend` FLOAT NOT NULL COMMENT 'При каком остатке докупать' , "
            . "`remains` TEXT NOT NULL COMMENT 'Остатки по филиалам' , "
            . "PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci "
            . "COMMENT = 'Каталог запасных частей';";
    public  $crZipLog = "CREATE TABLE `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."ziplog` "
            . "( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор' , "
            . "`userid` INT NOT NULL COMMENT 'Пользователь' , "
            . "`whenstamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время' , "
            . "`operation` TEXT NOT NULL COMMENT 'Описание операции' , "
            . "`description` TEXT NOT NULL COMMENT 'Примечание' , "
            . "PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci "
            . "COMMENT = 'История движения запчастей';";
    public $crMessages = "CREATE TABLE `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."messages` "
            . "( `id` INT NOT NULL AUTO_INCREMENT COMMENT 'ID сообщения' , "
            . "`fromid` INT NOT NULL COMMENT 'От кого' , "
            . "`toid` INT NOT NULL COMMENT 'Кому' , "
            . "`msg` TEXT NOT NULL COMMENT 'Текст' , "
            . "`whenstamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Когда отправлено' , "
            . "`unread` INT NOT NULL COMMENT 'Флаг \"не прочитано\"' , "
            . "`hidefrom` INT NOT NULL COMMENT 'Скрыть у отправителя' , "
            . "`hideto` INT NOT NULL COMMENT 'Скрыть у получателя' , "
            . "PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci "
            . "COMMENT = 'Личные сообщения';";
    public $crOrders = "CREATE TABLE `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."orders` "
            . "( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Номер заявки' , "
            . "`manager` INT NOT NULL COMMENT 'Кто принял' , "
            . "`master` INT NULL COMMENT 'Кто мастер' , "
            . "`zipids` TEXT NULL COMMENT 'Список ID запчастей' , "
            . "`zipquant` TEXT NULL COMMENT 'Кол-во каждой запчасти' , "
            . "`trouble` TEXT NOT NULL COMMENT 'Заявленная неисправность' , "
            . "`work` TEXT NULL COMMENT 'Что сделано' , "
            . "`warranty` INT NOT NULL COMMENT 'Гарантия дней' , "
            . "`service` INT NOT NULL COMMENT 'Филиал' , "
            . "`entered` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Поступил когда' , "
            . "`issued` DATETIME NULL COMMENT 'Выдали когда' , "
            . "PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci "
            . "COMMENT = 'Таблица заявок';";
}


