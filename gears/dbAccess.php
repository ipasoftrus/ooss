<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     Data access module                  **
 **                                         */

final class DbAccess {
    private $connection;
    
    // Подключается к БД, возвращает true в случае успеха
    public final function dbConnect() {
        $this->connection = new mysqli(
                OOSSConfig::dbHost,
                OOSSConfig::dbUser,
                OOSSConfig::dbPass,
                OOSSConfig::dbName);
        if (!$this->connection) { // Если не подключились
            return false;
        }
        return true;
    }
    
    // Получить настройку из таблицы настроек
    public function getSettingByName($paramName) {
        $sql = "SELECT `value` FROM `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."settings` WHERE `parameter`='$paramName';";
        $result = $this->connection->query($sql);
        if ($result->num_rows) { // Если результат вернулся
            $row = $result->fetch_row();
            return $row[0];
        }
        return null;
    }
}

