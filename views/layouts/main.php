<!DOCTYPE html>
<html>
<head>
    <?php //echo \Yii::getAlias('@web');die;?>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Locker App</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="<?php echo Yii::$app->request->baseUrl ?>/css/mat/style.css" rel="stylesheet">
    <link href="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo Yii::$app->request->baseUrl ?>/css/mat/themes/all-themes.css" rel="stylesheet" />
    <!-- Jquery Core Js -->
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- Select Plugin Js -->
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/node-waves/waves.js"></script>
    <!-- Custom Js
       <!-- Wait Me Plugin Js -->
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/waitme/waitMe.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl ?>/js/admin.js"></script>
    <!-- Demo Js -->
    <script src="<?php echo Yii::$app->request->baseUrl ?>/js/demo.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/sweetalert/sweetalert.min.js"></script>
    <link href="<?php echo Yii::$app->request->baseUrl ?>/css/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
</head>

<body class="theme-red">
<?php require_once('header.php')?>
<?php if(isset($_SESSION['username']) && !empty($_SESSION)){ ?>
    <?php require_once('sidebar.php')?>
<?php } ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2><?=$content?></h2>
        </div>
    </div>
</section>
</body>
</html>
