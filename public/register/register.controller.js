(function () {
    'use strict';

    angular
        .module('app')
        .controller('RegisterController', RegisterController);

    RegisterController.$inject = ['UserService', '$location', '$rootScope', 'toaster'];
    function RegisterController(UserService, $location, $rootScope, toaster) {
        var vm = this;

        vm.register = register;

        function register() {
            vm.dataLoading = true;          
            UserService.Create(vm.user)
                .then(function (response) {
                    console.log(response);
                    if (response.success) {                       
                        toaster.pop(response.type, response.title, response.message);
                        $location.path('/login');
                    } else {                       
                        toaster.pop(response.type, response.title, response.message);
                        vm.dataLoading = false;
                    }
                });
        }
    }

})();
