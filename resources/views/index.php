<!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="<?php echo csrf_token();?>" />
    <title>Lumen and AngularJS User Registration and Login</title>
    <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.min.css" />
    <link href="app-content/app.css" rel="stylesheet" />
</head>
<body>

    <div class="jumbotron">
        <div class="container">
        <toaster-container></toaster-container>
            <div class="col-sm-8 col-sm-offset-2">
                <div ng-class="{ 'alert': flash, 'alert-success': flash.type === 'success', 'alert-danger': flash.type === 'error' }" ng-if="flash" ng-bind="flash.message"></div>
                <div ng-view></div>
            </div>
        </div>
    </div>

    <script src="lib/jquery.js"></script>
    <script src="lib/angular.js"></script>
    <script src="lib/angular-route.js"></script>
    <script src="lib/angular-cookies.js"></script>
    <script src="lib/ng-file-upload/angular-file-upload.js"></script>
    <script src="lib/ng-file-upload/angular-file-upload-shim.min.js"></script>

    <link href="lib/toaster.css" rel="stylesheet" />
    <script src="lib/angular-animate.js" ></script>
    <script src="lib/toaster.js"></script>
    <script src="app.js"></script>
    <script src="app-services/authentication.service.js"></script>
    <script src="app-services/flash.service.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>

    <!-- Real user service that uses an api -->
    <!-- <script src="app-services/user.service.js"></script> -->

    <!-- Fake user service for demo that uses local storage -->
    <script src="app-services/user.service.js"></script>

    <script src="home/home.controller.js"></script>
    <script src="login/login.controller.js"></script>
     <script src="logout/logout.controller.js"></script>
    <script src="register/register.controller.js"></script>
</body>
</html>