<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     Container class for whole document  **
 **                                         */

final class DocContent {
    public $skinPath;   // Путь к обложке
    
    public $title;      // Шапка документа
    public $meta;       // Метаданные
    public $header;     // Заголовок
    public $sidebar;    // Боковое меню
    public $content;    // Центральный контент
    
    private $pageid;
    private $pageNumber;
    private $pageError;

    // Конструктор класса контента документа
    function __construct() {
        $this->pageError = $_GET['er'] ?? "";
        $this->pageid = $_GET['p'] ?? 1;
        $this->pageNumber = $_GET['n'] ?? 1;
        $this->makeDocTitle();
        $this->makeDocAuth();
        $this->makeDocMenu();
    }
       
    // Формирует заголовок документа
    private function makeDocTitle() {
        switch ($this->pageid) {
            case 'adm': // Администрирование
                $this->title = Language::titleAdmin;
                break;
            default: // Страница по-умолчанию
                $this->title = Language::titleMain;
        }
    }
    
    // Формирует блок авторизации / деавторизации
    private function makeDocAuth() {
        global $session;
        include './forms/loginout.php'; // Форма входа / выхода
        if ($session->getId() == 0) { // Если гость на линии
            $this->sidebar = loginGetForm(); // Из loginout.php
                if ($this->pageError == "un") {
                    $this->sidebar .= "<div id=\"errorUser\">".Language::errorUserNotFound."</div>\r\n";
                }
                else if ($this->pageError == "pwd") {
                    $this->sidebar .= "<div id=\"errorUser\">".Language::errorPasswordWrong."</div>\r\n";
                }
        }
        else { // На линии пользователь
            $this->sidebar .= $this->getGreeting();
            $this->sidebar .= logoutGetForm(); // из loginout.php
        }
    }
    
    private function makeDocMenu() {
        global $session;
        if ($session->getRole() != 0) {
            $this->sidebar .= $this->getMenu();
        }
    }
    
    // Получить приветствие
    private function getGreeting() {
        global $session;
        $result = "";
        $nowhours = date("H");
        if (($nowhours >= 0)&&($nowhours <= 5)) {
            $result .= Language::signGoodNight;
        }
        else if (($nowhours >= 6)&&($nowhours <= 10)) {
            $result .= Language::signGoodMorning;
        }
        else if (($nowhours >= 11)&&($nowhours <= 17)) {
            $result .= Language::signGoodDay;
        }
        else if (($nowhours >= 18)&&($nowhours <= 23)) {
            $result .= Language::signGoodEvening;
        }
        $result .= ", <strong>".$session->getUserInfo()['name']."</strong>\r\n";
        $result .= $this->getAvatar();
        if ($session->getRole() > 1) {
            $result .= Language::signRole.": ".Language::roleDescriptions[$session->getRole()]."\r\n";
        }
        return $result;
    }
    
    // Получить изображение пользователя
    private function getAvatar() {
        global $session;
        $avatar = $session->getUserInfo()['picture'];
        $result = "<div id=\"avatar\">\r\n"
                . "<img src=\"$avatar\">\r\n"
                . "</div>\r\n";
        return $result;
    }
    
    // Получить меню (доступные действия)
    private function getMenu() {
        global $session;
        $result = "<div id=\"menu\">\r\n"
                . "<ul>\r\n"
                . "<li><a href=\"./index.php?p=profile\">".Language::menuProfile."</a></li>\r\n"
                . "<li id=\"menu_item_chats\"><a href=\"./index.php?p=chats\">".Language::menuChats."<b> (+6)</b></a></li>\r\n";
        if ($session->getRole() == 1) {
            $result .= $this->getSubmenuMessages();
            $result .= "<li id=\"menu_item_orders\"><a href=\"./index.php?p=status\">".Language::menuMyStatuses."</a></li>\r\n";
        }
        if ($session->getRole() > 1) { // Менеджерские права
            $result .= "<li><a href=\"./index.php?p=orders\">".Language::menuManageOrders."</a></li>\r\n";
            $result .= $this->getSubmenuOrders();
        }
        if ($session->getRole() == 4) { // Админские права
            $result .= "<li><a href=\"./index.php?p=admin\">".Language::menuSettings."</a></li>\r\n";
            $result .= $this->getSubMenuSettings();
        }
        $result .="</ul>\r\n"
                . "</div>\r\n";
        return $result;
    }
    
    // Получить подменю для пункта меню сообщения
    private function getSubmenuMessages() {
        $result .="<ul>\r\n"
                . "<li><a href=\"./index.php?p=chats\">".Language::menuChatsAll."</a></li>\r\n"
                . "<li><a href=\"./index.php?p=chats&write=manager\">".Language::menuToMyManager."</a></li>\r\n"
                . "<li><a href=\"./index.php?p=chats&write=master\">".Language::menuToMyMaster."</a></li>\r\n"
                . "<li><a href=\"./index.php?p=chats&write=director\">".Language::menuToMyDirector."</a></li>\r\n"
                . "</ul>\r\n";
        return $result;
    }
    
    // Получить подменю для пункта меню Управление заявками
    private function getSubmenuOrders() {
        $result ="<ul>\r\n"
                . "<li><a href=\"./index.php?p=orders\">".Language::menuManageOrdersAll."</a></li>\r\n"
                . "</ul>\r\n";
        return $result;
    }
    
    // Получить подменю для пункта Настройки
    private function getSubMenuSettings() {
        return
        "<ul>\r\n"
      . "<li><a href=\"./index.php?p=admin&mode=general\">".Language::menuSettingsGeneral."</a></li>\r\n"
      . "<li><a href=\"./index.php?p=admin&mode=users\">".Language::menuSettingsUser."</a></li>\r\n"
      . "</ul>\r\n";
    }
}