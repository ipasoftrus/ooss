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
    public $content;     // Центральный контент
    
    private $pageid;
    private $pageNumber;
    private $userRole;

    // Конструктор класса контента документа
    function __construct() {
        $this->pageid = $_GET['p'] ?? 1;
        $this->pageNumber = $_GET['n'] ?? 1;
        $this->userRole = $_SESSION['user_role'] ?? 0;
        switch ($this->pageid) {
            case 1: // Страница по-умолчанию
                $this->title = Language::titleMain;
                break;
            case 2: // Администрирование
                $this->title = Language::titleAdmin;
                break;
        }
        if ($this->userRole == 0) { // Если гость на линии
            $this->sidebar = ""
                    . "<form action=\"./gears/auth.php\" method=\"post\">\r\n"
                    . "<div id=\"signin\">\r\n"
                    . "<span id=\"userNameSpan\">".Language::signLogin."</span>\r\n"
                    . "<input type=\"text\" name=\"un\" required>\r\n"
                    . "<span id=\"userNameSpan\">".Language::signPassword."</span>\r\n"
                    . "<input type=\"password\" name=\"pwd\" required>\r\n"
                    . "<input type=\"submit\">\r\n"
                    . "</div>\r\n"
                    . "</form>\r\n";
        }
    }
}