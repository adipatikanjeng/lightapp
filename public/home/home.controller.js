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
			// loadCurrentUser();
			// loadAllUsers();
			// uploadFiles();
			// pagination();
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

			// $scope.$watch('files', function () {
			// 	$scope.upload($scope.files);
			// });

			$http.get('/file/lists').
			success(function(data, status, headers, config) {
				$scope.uploaded = data;
			});


			$scope.upload = function (files) {
				if (files && files.length) {
					for (var i = 0; i < files.length; i++) {
						var file = files[i];
						$upload.upload({
							url: '/file/upload',
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
				$http.get('/file/lists').
				success(function(data, status, headers, config) {
					$scope.uploaded = data;
				});
			};


			$scope.delete = function(name){
				$http.get('/file/delete/'+ name).
				success(function(data, status, headers, config) {
					$scope.getfiles();
				});
			};
		}

		function pagination()
		{
			$scope.itemsPerPage = 5;
			$scope.currentPage = 0;
			$scope.items = name;


			$scope.range = function() {
				var rangeSize = 3;
				var ret = [];
				var start;

				start = $scope.currentPage;
				if ( start > $scope.pageCount()-rangeSize ) {
					start = $scope.pageCount()-rangeSize+1;
				}

				for (var i=start; i<start+rangeSize; i++) {
					ret.push(i);
				}
				return ret;
			};

			$scope.prevPage = function() {
				if ($scope.currentPage > 0) {
					$scope.currentPage--;
				}
			};

			$scope.prevPageDisabled = function() {
				return $scope.currentPage === 0 ? "disabled" : "";
			};

			$scope.pageCount = function() {
				return Math.ceil($scope.items.length/$scope.itemsPerPage)-1;
			};

			$scope.nextPage = function() {
				if ($scope.currentPage < $scope.pageCount()) {
					$scope.currentPage++;
				}
			};

			$scope.nextPageDisabled = function() {
				return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
			};

			$scope.setPage = function(n) {
				$scope.currentPage = n;
			};

		}
	}

})();