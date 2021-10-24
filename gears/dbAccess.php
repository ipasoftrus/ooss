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
    
    // Найти ID пользователя по email или номеру телефона
    public function findUser($login) {
        // Опросить таблицу пользователей, по емэйлу
        $sql = "SELECT `id` FROM `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."users` WHERE `email` = '$login';";
        $result = $this->connection->query($sql);
        if ($result->num_rows) { // Если email нашелся
            $row = $result->fetch_row();
            return $row[0]; // Вернуть ID юзера
        }
        else { // Не нашли по email, ищем по номеру телефона
            $sql = "SELECT `user` FROM `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."phones` WHERE `number` = '$login';";
            $result = $this->connection->query($sql);
            if ($result->num_rows) { // Если телефон нашелся
                $row = $result->fetch_row();
                return $row[0]; // Вернуть ID юзера
            }
        }
        return 0; // Пользователь не найден
    }
    
    // Получить всю информацию о пользователе по его ID 
    public function getUserInfo($id) {
        // Забрать все поля с искомым id
        $sql = "SELECT * FROM `".OOSSConfig::dbName."`.`".OOSSConfig::dbPrfx."users` WHERE `id`='$id';";
        $result = $this->connection->query($sql);
        if ($result->num_rows) { // Проверка наличия результата
            $row = $result->fetch_assoc(); // Получить ассоциативный массив
            return $row; // Вернуть всю информацию о юзере
        }
        return null;
    }
}

