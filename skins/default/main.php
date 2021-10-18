<?php 
    global $docContent;
?>
<html>
    <head>
        <link rel="shortcut icon" href="<?php echo $docContent->skinPath; ?>images/favicon.png" type="image/png">
        <link rel="stylesheet" href="<?php echo $docContent->skinPath; ?>css/appearance.css">
        <link href="./js/jquery-3.6.0.min.js" rel="stylesheet">
        <title>
            <?php echo $docContent->title; ?>
        </title>
    </head>
    <body>
        <div class="header">
            <h1><?php echo $docContent->header; ?></h1>
        </div>
        <div class="sidebar">
            <?php echo $docContent->sidebar; ?>
        </div>
        <div class="content">
            Content
        </div>
        <div class="footer">
            <?php echo "Все права защищены &copy; ".date("Y"); ?>
        </div>
    </body>
</html>

