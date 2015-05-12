(function () {
    'use strict';

    angular
        .module('app')
        .controller('HomeController', HomeController);

    HomeController.$inject = ['UserService', '$rootScope', '$scope', '$upload', '$http'];
    function HomeController(UserService, $rootScope, $scope, $upload, $http) {
        var vm = this;

        vm.user = null;
        vm.allUsers = [];
        vm.deleteUser = deleteUser;

        initController();

        function initController() {
            loadCurrentUser();
            loadAllUsers();
            uploadFiles();
        }

        function loadCurrentUser() {
            UserService.GetByEmail($rootScope.globals.currentUser.email)
                .then(function (user) {
                    vm.user = user;
                });
        }

        function loadAllUsers() {
            UserService.GetAll()
                .then(function (users) {
                    vm.allUsers = users;
                });
        }

        function deleteUser(id) {
            UserService.Delete(id)
            .then(function () {
                loadAllUsers();
            });
        }

        function uploadFiles()
        {
            $scope.uploaded = [];

            $scope.$watch('files', function () {
                $scope.upload($scope.files);
            });

            $http.get('/list').
            success(function(data, status, headers, config) {
                $scope.uploaded = data;
            });


            $scope.upload = function (files) {
                if (files && files.length) {
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        $upload.upload({
                            url: '/file',
                            file: file
                        }).progress(function (evt) {
                            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                            console.log('progress: ' + progressPercentage + '% ' + evt.config.file.name);
                        }).success(function (data, status, headers, config) {
                            console.log('file ' + config.file.name + 'uploaded. Response: ' + data);
                            $scope.getfiles();
                        });
                    }
                }
            };


            $scope.getfiles = function(){
                $http.get('/list').
                success(function(data, status, headers, config) {
                    $scope.uploaded = data;
                });
            };


            $scope.delete = function(name){
                $http.get('/delete/'+ name).
                success(function(data, status, headers, config) {
                    $scope.getfiles();
                });
            };
        }
    }

})();