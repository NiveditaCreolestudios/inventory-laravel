angular.module('inventoryApp').factory('inventoryFactory', ['$http', '$rootScope',
    function($http, $rootScope) {
        return {

            Getinventory: function(data, page) {
                if (page === undefined) {
                    page = '1';
                }
                return $http({
                    method: 'POST',
                    data: data,
                    url: 'Getinventory?page=' + page
                }).then(function successCallback(response) {
                    return response;
                }, function errorCallback(response) {
                    return response;
                });
            },
        };
    }
]);
