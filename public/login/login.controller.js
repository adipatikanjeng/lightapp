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
            $http.get('api/auth/logout').success(function(response){
                if(response.action)
                {
                    toaster.pop( response.type, response.title, response.message);
                }
            });
            AuthenticationService.ClearCredentials();
        })();

        function login() {
            vm.dataLoading = true;
            AuthenticationService.Login(vm.email, vm.password, vm.remember, function (response) {
                if (response.type == 'success') {
                    AuthenticationService.SetCredentials(vm.email, vm.password);
                    toaster.pop( response.type, response.title, response.message);
                    $location.path('/');
                } else {                    
                    toaster.pop( response.type, response.title, response.message);
                    vm.dataLoading = false;
                }
            });
        };
    }

})();
