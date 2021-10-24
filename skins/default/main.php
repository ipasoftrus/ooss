<?php 
    global $docContent;
?>
<html>
    <head>
        <link rel="shortcut icon" href="<?php echo $docContent->skinPath; ?>images/favicon.png" type="image/png">
        <link rel="stylesheet" href="<?php echo $docContent->skinPath; ?>css/appearance.css">
        <script type="text/javascript" src="./js/jquery-3.6.0.min.js"></script>
        <title>
            <?php echo 'OOSS - '.$docContent->title."\r\n"; ?>
        </title>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <?php echo $docContent->header."\r\n"; ?>
            </div>
            <div id="sidebar">
                <?php echo $docContent->sidebar."\r\n"; ?>
            </div>
            <div id="content">
                <?php echo $docContent->content."\r\n"; ?>
            </div>
            <div id="clear"></div>
            <div id="footer">
                <?php echo "Все права защищены &copy; ".date("Y")."\r\n"; ?>
            </div>
        </div>
    </body>
</html>

