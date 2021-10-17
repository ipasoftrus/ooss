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
    public $menu;       // Строка меню
    public $sidebar;    // Боковое меню
    public $middle;     // Центральный контент
}