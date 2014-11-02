ggControllers.controller('SyncCtrl', ['$scope', '$http', 
function($scope, $http) {
    
    $scope.prods = [ ];
    
    $scope.db = openDatabase('ggamer', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    
    $scope.DoSync = function(){
            console.log('Getting Prods');
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblProd', [], function(tx, result){
                    $scope.prods = [ ];
                    for( var idx = 0; idx < result.rows.length; idx++){
                        $scope.prods.push({
                            prodName: result.rows.item(idx).prodName,
                            unitId: result.rows.item(idx).unitId,
                            prodSize: result.rows.item(idx).prodSize,
                            prodUpc: result.rows.item(idx).prodUpc,
                        });
                    }
                    console.log($scope.prods);
                    $http.post('http://grocerygamer.herokuapp.com/reactor/syncapi/prod', $scope.prods).success(function(response){console.log(response);});
                    
                }, function(result, error){alert('error'); console.log(error);});
            });
    };
    
}]);