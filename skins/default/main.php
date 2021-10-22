<?php 
    global $docContent;
?>
<html>
    <head>
        <link rel="shortcut icon" href="<?php echo $docContent->skinPath; ?>images/favicon.png" type="image/png">
        <link rel="stylesheet" href="<?php echo $docContent->skinPath; ?>css/appearance.css">
        <link href="./js/jquery-3.6.0.min.js" rel="stylesheet">
        <title>
            <?php echo 'OOSS - '.$docContent->title; ?>
        </title>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <?php echo $docContent->header; ?>
            </div>
            <div id="sidebar">
                <?php echo $docContent->sidebar; ?>
            </div>
            <div id="content">
                <?php echo $docContent->content; ?>
            </div>
            <div id="clear"></div>
            <div id="footer">
                <?php echo "Все права защищены &copy; ".date("Y"); ?>
            </div>
        </div>
    </body>
</html>

