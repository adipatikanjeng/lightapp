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
                        // FlashService.Success(response.message, true);
                        toaster.pop('success', "Success", response.message);
                        $location.path('/login');
                    } else {                       
                        toaster.pop('warning', "Warning", response.message);
                        vm.dataLoading = false;
                    }
                });
        }
    }

})();
