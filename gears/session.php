<?php
/**     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     User session controller             **
 **                                         */

session_start();
$user_role = $_SESSION['user_role'] ?? 0; // Гость

