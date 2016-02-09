<?php
/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 27/01/2016
 * Time: 14:32
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wine-store - Made With Love</title>
    <meta charset="utf-8">
    <meta name="description" content="1E-shop - Bootstrap Theme from angelostudio.net">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/admin.login.css" type="text/css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/modernizr.min.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<canvas id='c'></canvas>

<div style="padding-top: 30px;">
    <div style="background-color: white; padding: 20px; filter: alpha(opacity=80); opacity: 0.9; z-index: 1000; width: 600px; margin: 200px auto 0 auto;">
        <form class="myform">
            <div class="form-group">
                <div class="controls">
                    <img src="../img/winestorelogin.png" alt="#" class="img-responsive center-block" width="250" height="250" style="padding-top: 5px">
                </div>
            </div>
            <div class="form-group">
                <!--<label class="control-label" for="contact-mail">Email</label>-->
                <div class=" controls">
                    <input id="username" name="username" placeholder="Username" class="form-control input-lg requiredField" type="text" data-error-invalid="Invalid username" data-error-empty="Enter username">
                </div>
            </div>
            <div class="form-group">
                <!--<label class="control-label">password</label>-->
                <div class="controls">
                    <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                </div>
            </div>
            <div class="form-group">
                <button id="loginBtn" type="button" class="btn btn-block">LOG IN</button>
            </div>
        </form>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js" type="text/javascript"></script>
<script src='https://rawgit.com/akm2/simplex-noise.js/master/simplex-noise.js'></script>
<script src='http://dat-gui.googlecode.com/git/build/dat.gui.min.js'></script>
<!--<script type="text/javascript" src="../js/main.min.js"></script>-->
<script type="text/javascript" src="../js/admin.login.js"></script>
<script type="text/javascript" src="../controllers/admin_controller.js"></script>
</body>
</html>
