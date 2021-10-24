<?php
/*********************************************
 **     ipaSoft Electronics (c) 2021        **
 **     Online Order Status Script          **
 **     Logout form                         **
 ********************************************/

function logoutGetForm() {
    return 
    "<form action=\"./gears/auth.php\" method=\"post\">"
  . "    <div id=\"signout\">"
  . "    <input type=\"hidden\" name=\"d\" value=\"exit\">"
  . "    <input type=\"submit\" value=\"".Language::signSignOut."\">"
  . "    </div>"
  . "</form>";
}

function loginGetForm() {
    return
    "<form action=\"./gears/auth.php\" method=\"post\">\r\n"
  . "<div id=\"signin\">\r\n"
  . "<span id=\"userNameSpan\">".Language::signLogin."</span>\r\n"
  . "<input type=\"text\" name=\"login\" required>\r\n"
  . "<span id=\"userNameSpan\">".Language::signPassword."</span>\r\n"
  . "<input type=\"password\" name=\"password\" required>\r\n"
  . "<input type=\"submit\">\r\n"
  . "</div>\r\n"
  . "</form>\r\n";
}



