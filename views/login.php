<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>GCS - Grease Control System</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

<link href="<?php echo BASE_URL;?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASE_URL;?>/assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BASE_URL;?>/assets/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

<link href="<?php echo BASE_URL;?>/assets/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URL;?>/assets/css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="navbar navbar-fixed-top">
    <div class="linha"></div>

    <div class="navbar-inner">

        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a class="brand" href="<?php echo BASE_URL; ?>">
                <img src="<?php echo BASE_URL; ?>assets/img/gm.png">
            </a>

            <div class="nav-collapse">
                <ul class="nav pull-right">

                </ul>

            </div><!--/.nav-collapse -->

        </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

</div> <!-- /navbar -->



<div class="account-container">

    <div class="content clearfix">

        <form action="" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo md5(time()); ?>">
            <h1>Acesso restrito</h1>
            <?php if (isset($_SESSION['erro'])) : ?>
            <p class="alert alert-danger"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  <?php echo $_SESSION['erro']; ?> </p>
            <?php
            unset($_SESSION['erro']);
            endif; ?>

            <div class="login-fields">

                <p>Preencha com seus dados</p>

                <div class="field">
                    <label for="username">Nome de usuário</label>
                    <input type="text" id="username" name="username" value="" placeholder="Nome de Usuário" class="login username-field" />
                </div> <!-- /field -->

                <div class="field">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" value="" placeholder="Senha" class="login password-field"/>
                </div> <!-- /password -->

            </div> <!-- /login-fields -->

            <div class="login-actions">

                <span class="login-checkbox">
                    <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                    <label class="choice" for="Field">Mantenha-me conectado</label>
                </span>

                <button class="button btn btn-success btn-large">Acessar</button>

            </div> <!-- .actions -->



        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="<?php echo BASE_URL;?>/assets/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo BASE_URL;?>/assets/js/bootstrap.js"></script>

<script src="<?php echo BASE_URL;?>/assets/js/signin.js"></script>

</body>

</html>
