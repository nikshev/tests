<?php
/**
 * Register feature
 */

require_once("user.php");
$user=new User();
?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
    <html>
    <head>
        <title>Test task (User login) - Eugene Shkurnikov</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="Lawsuit and calculation" content="Lawsuit and calculation">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="/forge/js/main.js"></script>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../datetime/css/bootstrap-datetimepicker.min.css"/>
        <script src="../datetime/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#datetimepicker1').datetimepicker({
                    language: 'pt-BR'
                });
            });
        </script>
    </head>
    <body>
    <div class="container">
        <div class="row clearfix">

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6  column col-sm-offset-0 col-md-offset-2 col-lg-offset-3">
                <a href="http://api.hostinger.com.ua/redir/5450818" target="_blank"><img src="http://hostinger.com.ua/banners/ru/hostinger-728x90-1.gif" alt="Бесплатный Хостинг" border="0" width="728" height="90" /></a>

                <legend><?php echo$user->get_lang_constant('test_task');?></legend>
                <a href="http://ua.linkedin.com/pub/eugene-shkurnikov/79/b13/124"><?php echo$user->get_lang_constant('about');?></a> / <a href="/forge/switch.php"><?php echo$user->get_lang_constant('switch_lang');?></a>

<?php
if (!$user->is_authorized()) {
    $user->signin_form();
} else
    header("Location:/forge/index.php");
?>


            </div>
        </div>
    </div>
    </body>
</html>