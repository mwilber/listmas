ggControllers.controller('DevCtrl', ['$scope', '$http', 'ggActiveList', 
function($scope, $http, ggActiveList) {
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    localStorage.removeItem('activeList');
    $scope.showUpc = localStorage.getItem("showUpc");
    
    
    $scope.ClearDb = function () {
        $scope.db.transaction(function (tx) {
            tx.executeSql("DROP TABLE IF EXISTS tblProd");
            tx.executeSql("DROP TABLE IF EXISTS tblProdlist");
            tx.executeSql("DROP TABLE IF EXISTS tblShoplist");
        });
    };
    
    $scope.AddJames = function () {
        var listName = "James";
        $scope.db.transaction(function (tx) {
            console.log('Adding List');
            console.log(listName);
            tx.executeSql('INSERT INTO tblShoplist (shoplistRemoteId, shoplistName) VALUES ( ?, ?)', [1, listName], function(tx, response){
                app.navi.resetToPage('lists.html', {})
            });
        });
    };
    
    $scope.ShowUpc = function() {
        if( localStorage.getItem("showUpc") == 1 ){
            localStorage.setItem("showUpc", 0);
        }else{
            localStorage.setItem("showUpc", 1);
        }
        $scope.showUpc = localStorage.getItem("showUpc");
        $scope.$apply();
    };

}]);