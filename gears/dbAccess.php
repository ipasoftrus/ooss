<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     Data access module                  **
 **                                         */

require_once 'config.php';

final class DbAccess {
    private $connection;
    
    // Подключается к БД, возвращает true в случае успеха
    public final function dbConnect() {
        $this->connection = mysqli_connect(
                OOSSConfig::dbHost,
                OOSSConfig::dbUser,
                OOSSConfig::dbPass,
                OOSSConfig::dbName);
        if (!$this->connection) { // Если не подключились
            return false;
        }
        return true;
    }
}
?>
