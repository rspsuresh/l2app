<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/css/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/css/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/css/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="<?php echo Yii::$app->request->baseUrl; ?>/css/mat/style.css" rel="stylesheet">
<!--    --><?php //$cs = Yii::$app->clientScript;
//    $cs->coreScriptPosition = CClientScript::POS_HEAD;
//    $cs->registerCoreScript('jquery');?>
</head>

<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">AI<b>Locker</b></a>
        <small>AI Based Locker</small>
    </div>
    <?php //echo "<pre>";print_r($model);die;?>
    <div class="card">
        <div class="body">
           <form id="sign_in" name="loginform" method="POST" autocomplete="off">
            <div class="msg">Sign in to start your session</div>
            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                <div class="form-line">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="" autofocus="" aria-required="true">
                </div>
            </div>
            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                <div class="form-line">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" autofocus="" aria-required="true">
                </div>
            </div>
               <div id="incorrect" class="error" style="display: none"><p class="text-center" >Incorrect Username and Password</p></div>
            <div class="row">
                <div class="col-xs-offset-8 col-xs-4">
         <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                </div>
            </div>
            <div class="row m-t-15 m-b--20">
                <div class="col-xs-offset-6 col-xs-6 align-right">
                    <a href="forgot-password.html">Forgot Password?</a>
                </div>
            </div>
           </form>
        </div>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="<?php echo Yii::$app->request->baseUrl; ?>/css/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="<?php echo Yii::$app->request->baseUrl; ?>/css/plugins/bootstrap/js/bootstrap.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="<?php echo Yii::$app->request->baseUrl; ?>/css/plugins/node-waves/waves.js"></script>
<!-- Validation Plugin Js -->
<script src="<?php echo Yii::$app->request->baseUrl; ?>/css/plugins/jquery-validation/jquery.validate.js"></script>
<!-- Custom Js -->
<script src="<?php echo Yii::$app->request->baseUrl; ?>/js/admin.js"></script>
<!--<script src="<?php //echo Yii::$app->request->baseUrl; ?>/js/pages/examples/sign-in.js"></script>-->
</body>
</html>
<script type="text/javascript">
    $(function () {
        $("#sign_in").on("submit", function (event) {
            event.preventDefault();
        }).validate({
            rules: {
                username: 'required',
                password: 'required'
            },
            messages: {
                username: 'Username Cannot be blank',
                password: 'Password Cannot be blank'
            },
            submitHandler: function (form, event) {
                event.preventDefault();
                var formData = new FormData($('#sign_in')[0]);
                var url='<?=Yii::$app->urlManager->createUrl(['site/login'])?>'
                $.ajax({
                    url: url,
                    type: "post",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (result) {
                        var obj = JSON.parse(result);
                        if (obj.flag === "S") {
                            window.location.href="<?=Yii::$app->urlManager->createUrl(['locker/index'])?>";
                        }else{

                            $("#incorrect").show();
                        }
                    }
                });
                return false;
            }
        });
    });
</script>