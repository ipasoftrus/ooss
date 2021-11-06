<?php 
    global $docContent;
?>
<html>
    <head>
        <link rel="shortcut icon" href="<?php echo $docContent->skinPath; ?>images/favicon.png" type="image/png">
        <link rel="stylesheet" href="<?php echo $docContent->skinPath; ?>css/appearance.css">
        <script type="text/javascript" src="./js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#cssmenu li.has-sub > a').on('click', function(){
                    $(this).removeAttr('href');
                    var element = $(this).parent('li');
                    if (element.hasClass('open')) {
                        element.removeClass('open');
                        element.find('li').removeClass('open');
                        element.find('ul').slideUp();
                    }
                    else {
                        element.addClass('open');
                        element.children('ul').slideDown();
                        element.siblings('li').children('ul').slideUp();
                        element.siblings('li').removeClass('open');
                        element.siblings('li').find('li').removeClass('open');
                        element.siblings('li').find('ul').slideUp();
                    }
                });

            $('#cssmenu>ul>li.has-sub>a').append('<span class="holder"></span>');
            });
        </script>
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

