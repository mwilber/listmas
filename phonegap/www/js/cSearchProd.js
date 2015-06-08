ggControllers.controller('SearchProdCtrl', ['$scope', '$http', 'ggSearchProd', 'ggActiveList', 'ggProStatus',   
function($scope, $http, ggSearchProd, ggActiveList, ggProStatus) {
   
    $scope.grocery = ggSearchProd.GetSearchProd();
    $scope.scanStatus = false;
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    
    console.log('Prod Details', $scope.grocery);
    
    $scope.SaveGrocery = function (pName, pPhoto, pUrl) {
        
        $scope.db.transaction(function (tx) {
            console.log('Adding Product');
            console.log(pName);
            console.log(pUrl);
            tx.executeSql('INSERT INTO tblProd (prodName, prodPhoto, prodUrl, prodUpc) VALUES ( ?, ?, ?, ?)', [pName, pPhoto, pUrl, ''], function(tx, response){
                console.log('Inserting into prodlist: '+response.insertId);
                tx.executeSql('INSERT INTO tblProdlist (prodId,shoplistId) VALUES ( ?, ?)', [response.insertId,ggActiveList.GetActiveList()], function(){ ggSearchProd.SetSearchProd({}); app.navi.popPage(); }), function(result, error){console.log(error);}; //function(tx, response){
                
            }, function(result, error){console.log(error);});
        });
        
        return false;
    };
    
    

}]);