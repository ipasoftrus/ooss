<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     Main Index module                   **
 **                                         */
require_once './gears/dbAccess.php';

$dbAccess = new DbAccess;
if (!$dbAccess->dbConnect()) {
    require_once './local/default.php';
    die (Language::errorDbConnect);
}

?>

