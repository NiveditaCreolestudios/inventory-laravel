angular.module('inventoryApp').controller('MainController', ['inventoryFactory','$location', '$http', '$scope', '$timeout', '$rootScope', '$filter', function(inventoryFactory, $location, $http, $scope, $timeout, $rootScope, $filter) {
    console.log('main controller loaded');

    $scope.InventoryData = function(searchTerm, page){
        inventoryFactory.Getinventory({'searchTerm':searchTerm} ,page).then(function(response){
            if(response.data.code==200)
            {
                $scope.inventories      = response.data.data.data;
                $scope.totalInventories = response.data.data.total;
                $scope.paginate         = response.data.data;
                $scope.currentPaging    = response.data.data.current_page;
                $scope.rangepage        = _.range(1, response.data.data.last_page + 1);
            }      
        });
    }
    $scope.searchTerm = undefined;
    $scope.InventoryData($scope.searchTerm,1);
    $scope.editInventory = {};
    $scope.Addinventory = function() {
        $scope.whatInventory = 'Add';
        $scope.editInventory = {};
        $('#inventoryForm').trigger("reset");
        $('#inventoryModal').modal('show');
    }
    $scope.Editinventory = function(inventory) {
        $('#inventoryForm').trigger("reset");
        $scope.editInventory = inventory;
        $scope.whatInventory = 'Edit';
        $('#inventoryModal').modal('show');
    }
    $(document).on('click', '.delete_inventory', function (a) {
        if (!confirm("Are you sure?")) {
            a.preventDefault();
        }
    });
    $scope.search = function(searchTerm){
        $scope.InventoryData(searchTerm,1);
    }
}]);