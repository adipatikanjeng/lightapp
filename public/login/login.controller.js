(function () {
    'use strict';

    angular
        .module('app')
        .controller('LoginController', LoginController);

    LoginController.$inject = ['$location', 'AuthenticationService', '$http', 'toaster'];
    function LoginController($location, AuthenticationService, $http, toaster ) {
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
                    toaster.pop('warning', "Warning", response.message);
                    vm.dataLoading = false;
                }
            });
        };
    }

})();
