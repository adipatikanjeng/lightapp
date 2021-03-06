<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <script src="lib/ng-file-upload/angular-file-upload-shim.min.js"></script>
    <script src="lib/angularjs/angular.js"></script>
    <script src="lib/ng-file-upload/angular-file-upload.js"></script>
    <script src="js/app.js"></script>

    <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.css">

    <title>Lumen file repo</title>
</head>



<body  ng-app="fileApp">
<style>
    .drop-box {
        background: #F8F8F8;
        border: 2px dashed #DDD;
        height:300px;
        text-align: center;
        padding-top: 25px;
        margin: auto;
    }
    .dragover {
        border: 1px dashed #5e5e5e;
    }
</style>

<div class="container" ng-controller="fileController">
    <div class="row">
        <div ng-file-drop ng-model="files" ng-file-accept=".jpg" class="col-lg-12 drop-box"
             drag-over-class="dragover" ng-multiple="true" allow-dir="true"
             accept="*">Drop files here
        </div>

        <table class="table">
            <tr ng-repeat="name in uploaded">
                    <td><a href="/view/{{name}}"><img width="40" ng-src="/view/{{name}}" alt=""></a></td>
                <td><button class="btn btn-default" ng-click="delete(name)"><span class="glyphicon glyphicon-trash"></span> Del</button></td></tr>
        </table>
    </div>
</div>








</body>
</html>