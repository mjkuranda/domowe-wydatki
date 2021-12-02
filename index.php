<?php include_once('engine/connector.php'); ?>
<?php include_once('engine/manager.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="Marek Kurańda" />
        <meta name="description" content="Domowe Wydatki - dobry sposób na kontrolę wydatków!" />
        <meta name="creation-date" content="2020-12-18" />

        <link rel="stylesheet" href="assets/css/basic.css" />
        <link rel="stylesheet" href="assets/css/header.css" />
        <link rel="stylesheet" href="assets/css/footer.css" />
        <?php
            echo '<link rel="stylesheet" href="assets/css/' . $_GET['sub'] . '.css" />';
        ?>

        <script src="assets/js/lib/jquery-3.5.1.min.js"></script>
        <script src="assets/js/lib/jquery.cookie.js"></script>
        <script src="assets/js/manager.js"></script>
        <script src="assets/js/header.js"></script>
    </head>

    <body class="__col3">
        <div class="web-border __col0 flex-between">
            <div class="flex-center">
                <div class="flex-center sec-server-time">
                    <strong>Server time:</strong>&nbsp;<p><?php include_once('site/server_time.php'); ?></p>
                </div>
                &nbsp;|&nbsp;
                <div class="flex-center sec-client-time">
                    <strong>Client time:</strong>&nbsp;<div class="client-time"></div>,&nbsp;<div class="client-timezone"></div>
                </div>
            </div>

            <div class="flex-center">
                <a href="settings" class="flex-center"><?php include('assets/img/svg/settings.svg'); ?></a>
            </div>
        </div>
        <!-- Header -->
        <?php include_once('site/header.php'); ?>
        <!-- Center -->
        <?php
            switch ($_GET['sub']) {
                case 'main':
                case 'report':
                case 'form':
                case 'settings':
                case 'reg':
                    include_once('site/' . $_GET['sub'] . '.php');
                break;

                // Error 404
                default:
                    include_once('site/error404.php');
                break;
            }
        ?>
        <!-- Footer -->
        <?php include_once('site/footer.php'); ?>
        <div class="web-border __col0"></div>
    </body>
</html>

<?php include_once('engine/disconnector.php'); ?>