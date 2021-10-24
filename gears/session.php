<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     User session controller             **
 **                                         */

final class OOSSSession {
    
    private $id;
    private $key;
    private $role;
    private $userInfo;
    
    public function __construct() {
        global $dbAccess;
        if (!$dbAccess) return; // Если доступа к БД нет, никаких проверок
        session_start();
        $this->id = $_SESSION['id'] ?? 0;
        $this->key = $_SESSION['key'] ?? "";
        $this->role = $_SESSION['role'] ?? 0;
        if ($this->id != 0) { // Какой-то реальный пользователь
            // Сверить пароль
            $this->userInfo = $dbAccess->getUserInfo($this->id);
            if ($this->userInfo['pwd'] != $this->key) { // Не подходит пароль
                $this->id = 0;
                $this->key = "";
                $this->role = 0;
                return;
            }
            // Допустим, пароль верный. Сверить полномочия
            if ($this->userInfo['role'] != $this->role) { // Подмена полномочий
                $this->role = $this->userInfo['role']; // Ставим на место
                return;
            }
        }
        // Сами данные сессии мы не трогаем, 
        // пусть их трогает модуль авторизации
    }
    
    public function setSes($id, $key, $role) {
        $this->id = $id;
        $this->key = $key;
        $this->role = $role;
        $_SESSION['id'] = $id;
        $_SESSION['key'] = $key;
        $_SESSION['role'] = $role;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function getUserInfo() {
        return $this->userInfo;
    }
   
    public function destroy() {
        session_start();
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }
}


