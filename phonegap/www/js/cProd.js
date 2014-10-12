ggControllers.controller('ProdDetailCtrl', ['$scope', '$http', 'ggActiveProd', 
function($scope, $http, ggActiveProd) {
   
    $scope.grocery = ggActiveProd.GetActiveProd();
    $scope.scanstatus = "SCAN";
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    
    console.log('Prod Details', $scope.grocery);
    
    $scope.ScanBarcode = function(){
        //$scope.GetBarcode('016000275836');
        //return false;
        window.plugins.barcodeScanner.scan( function(result) {
                    //alert("We got a barcode\n" +
                    //          "Result: " + result.text + "\n" +
                    //          "Format: " + result.format + "\n" +
                    //          "Cancelled: " + result.cancelled);
                    $scope.GetBarcode(result.text);
                }, function(error) {
                    alert("Scanning failed: " + error);
                }
          );
    }
    
    $scope.GetBarcode = function(pUpc){
        $scope.scanstatus = "checking";
        //$http.get('http://gibson.loc/grocerygamer/reactor/jsonapi/upcscan/'+pUpc).success(function(response){
        $http.get('http://grocerygamer.herokuapp.com/reactor/jsonapi/upcscan/'+pUpc).success(function(response){
            console.log(response);
            $scope.grocery.prodName = response.data.prodName;
            $scope.grocery.prodSize = parseFloat(response.data.prodSize);
            $scope.grocery.prodUnit = response.data.prodUnit;
            $scope.grocery.prodUpc = response.data.prodUpc;
        });
    };
    
    $scope.SaveGrocery = function () {
        
        console.log("Saving updates...", $scope.grocery);
        $scope.db.transaction(function (tx) {
            tx.executeSql("UPDATE tblProd SET prodName=?, prodDescription=?, prodUrl=? WHERE prodId=?", 
                [$scope.grocery.prodName, $scope.grocery.prodDescription, $scope.grocery.prodUrl, $scope.grocery.prodId], app.slidingMenu.setMainPage('list.html', {closeMenu: true}));
        });
        
        return false;
    };
    
    $scope.DeleteGrocery = function () {
        
        console.log("Deleting Grocery", $scope.grocery);
        $scope.db.transaction(function (tx) {
            tx.executeSql('DELETE FROM tblProd WHERE prodId=?', [$scope.grocery.prodId], function(tx, response){
                //$scope.UpdateGroceryList
                console.log('Deleting from prodlist: '+$scope.grocery.prodId);
                tx.executeSql('DELETE FROM tblProdlist WHERE prodId=?', [$scope.grocery.prodId], app.slidingMenu.setMainPage('list.html', {closeMenu: true}));
            });
        });
        
        return false;
    };
    
    

}]);