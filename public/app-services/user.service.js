(function () {
    'use strict';

    angular
    .module('app')
    .factory('UserService', UserService);

    UserService.$inject = ['$http', '$q'];
    function UserService($http, $q) {
        var service = {};

        service.GetAll = GetAll;
        service.GetById = GetById;
        service.GetByEmail = GetByEmail;
        service.Create = Create;
        service.Update = Update;
        service.Delete = Delete;

        return service;

        function GetAll() {
            return $http.get('/api/users').then(handleSuccess, handleError('Error getting all users'));
        }

        function GetById(id) {
            return $http.get('/api/users/' + id).then(handleSuccess, handleError('Error getting user by id'));
        }

        function GetByEmail(email) {
            return $http.get('/api/user/profile/' + email).then(handleSuccess);
        }

        function Create(user) {
            return $http.post('/api/auth/register', user).then(handleSuccess);
        }

        function Update(user) {
            return $http.put('/api/users/' + user.id, user).then(handleSuccess, handleError('Error updating user'));
        }

        function Delete(id) {
            return $http.delete('/api/users/' + user.id).then(handleSuccess, handleError('Error deleting user'));
        }

        // private functions

        function handleSuccess(data) {                               
           return data.data;                      
       }

       function handleError(error) {
        return function () {
            return { success: false, message: error };
        };
    }
}

})();