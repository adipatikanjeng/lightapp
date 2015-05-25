(function () {
    'use strict';

    angular
        .module('app')
        .controller('LoginController', LoginController);

    LoginController.$inject = ['$location', 'AuthenticationService', 'FlashService', '$http'];
    function LoginController($location, AuthenticationService, FlashService, $http) {
        var vm = this;

        vm.login = login;

        (function initController() {
            // reset login status
            $http.get('logout');
            AuthenticationService.ClearCredentials();
        })();

        function login() {
            vm.dataLoading = true;
            AuthenticationService.Login(vm.email, vm.password, vm.remember, function (response) {
                if (response.success) {
                    AuthenticationService.SetCredentials(vm.email, vm.password);
                    $location.path('/');
                } else {
                    FlashService.Error(response.message);
                    vm.dataLoading = false;
                }
            });
        };
    }

})();
