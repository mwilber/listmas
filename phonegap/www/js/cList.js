ggControllers.controller('GroceryListCtrl', ['$scope', '$filter', '$timeout', '$http', 'ggActiveList', 'ggActiveProd', 
function($scope, $filter, $timeout, $http, ggActiveList, ggActiveProd) {
    
    // if the active list isn't set. redirect to the list menu
    if( ggActiveList.GetActiveList() == 0 ) app.slidingMenu.setMainPage('lists.html', {closeMenu: true});
   
    $scope.groceries = [ ];
    $scope.checkoutTotal = 0;
    $scope.activeShopListId = 0;
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    
    $scope.UpdateGroceryList = function(tx, response){
            console.log('Getting Product List', ggActiveList.GetActiveList());
            if( response != undefined ) console.log(response.insertId);
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblProdlist LEFT JOIN tblProd ON tblProdlist.prodId=tblProd.prodId WHERE tblProdlist.shoplistId=?', [ggActiveList.GetActiveList()], function(tx, result){
                    $scope.groceries = [ ];
                    for( var idx = 0; idx < result.rows.length; idx++){
                        $scope.groceries.push({
                            prodId: result.rows.item(idx).prodId,
                            prodName: result.rows.item(idx).prodName,
                            prodSize: result.rows.item(idx).prodSize,
                            prodUnit: result.rows.item(idx).prodUnit,
                            prodPrice: result.rows.item(idx).prodPrice,
                            prodlistId: result.rows.item(idx).prodlistId,
                        });
                    }
                    $scope.$apply();
                    $scope.UpdateTotal();
                }, function(result, error){alert('error a'); console.log(error);});
            });
    };
    
    $scope.getTotalGroceries = function () {
        return $scope.groceries.length;
    };
    
    
    $scope.AddGrocery = function () {
        //$scope.groceries.push({text:$scope.formGroceryText, purchased:false, price: 0});
        var prodName = $scope.formGroceryText;
        $scope.db.transaction(function (tx) {
            console.log('Adding Product');
            console.log(prodName);
            tx.executeSql('INSERT INTO tblProd (prodName) VALUES ( ?)', [prodName], function(tx, response){
                //$scope.UpdateGroceryList
                console.log('Inserting into prodlist: '+response.insertId);
                tx.executeSql('INSERT INTO tblProdlist (prodId,shoplistId) VALUES ( ?, ?)', [response.insertId,ggActiveList.GetActiveList()], $scope.UpdateGroceryList);
            });
        });
        $scope.formGroceryText = '';
    };
    
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
        $http.get('http://mylistmas.herokuapp.com/reactor/jsonapi/upcscan/'+pUpc).success(function(response){
            console.log(response);
            var prodName = response.data.prodName;
            var prodUpc = response.data.prodUpc;
            $scope.db.transaction(function (tx) {
                console.log('Adding Product');
                console.log(prodName);
                console.log(prodUpc);
                tx.executeSql('INSERT INTO tblProd (prodName, prodUpc) VALUES ( ?, ?)', [prodName, prodUpc], function(tx, response){
                    //$scope.UpdateGroceryList
                    console.log('Inserting into prodlist: '+response.insertId);
                    tx.executeSql('INSERT INTO tblProdlist (prodId,shoplistId) VALUES ( ?, ?)', [response.insertId,ggActiveList.GetActiveList()], $scope.UpdateGroceryList);
                });
            });
            $scope.formGroceryText = '';
        });
    };
    
    $scope.UpdateTotal = function(){
        
        $scope.checkoutTotal = 0;
        for( var idx=0; idx<$scope.groceries.length; idx++){
            $scope.checkoutTotal += parseFloat($scope.groceries[idx].prodPrice);
        }
    };
    
    $scope.ClearPurchased= function () {
        $scope.groceries = $filter('filter')($scope.groceries, function(grocery){
            return !grocery.done;
        });
        $scope.groceries = $filter('filter')($scope.groceries, function(grocery){
            return grocery.price==0;
        });
    };
    
    $scope.TestDb = function () {
        $scope.db.transaction(function (tx) {
            tx.executeSql("DROP TABLE IF EXISTS tblProd");
            tx.executeSql("DROP TABLE IF EXISTS tblProdlist");
            tx.executeSql("DROP TABLE IF EXISTS tblShoplist");
        });
    };
    
    $scope.ShowDetails = function (pDetail){
        
        console.log("Detail", pDetail);
        ggActiveProd.SetActiveProd(pDetail);
        //TODO: Add new detail page here
        app.slidingMenu.setMainPage('prod.html', {closeMenu: true});
        //modal.show();
    };
    
    $scope.UpdateGroceryList();
}]);


ggControllers.controller('GroceryListing', ['$scope', '$filter', '$timeout',
function($scope, $filter, $timeout) {
    
    $scope.timeout;
    
    $scope.SavePrice = function(newVal, oldVal) {
        if (newVal != oldVal) {
        console.log("Saving updates to item #" + ($scope.$index + 1) + "...", $scope.grocery);
        $scope.db.transaction(function (tx) {
            tx.executeSql("UPDATE tblProdlist SET prodPrice=? WHERE prodlistId=?", 
                [$scope.grocery.prodPrice, $scope.grocery.prodlistId], $scope.UpdateTotal);
        });
            
        }
        $scope.UpdateTotal();
    };
    
    $scope.DebounceUpdates = function(pCallback) {
        return function(newVal, oldVal){
            if (newVal != oldVal) {
                if ($scope.timeout) $timeout.cancel($scope.timeout);
                $scope.timeout = $timeout(pCallback, 1000);  // 1000 = 1 second
            }
        };
    };
    
    
    $scope.$watch('grocery.prodPrice', $scope.SavePrice, true);
    
}]);

ggControllers.controller('GroceryDetail', ['$scope', 'ggActiveProd',
function($scope, ggActiveProd) {
    $scope.gd = ggActiveProd.GetActiveProd();
    
    $scope.CommTest = function(){
        alert("success");
    };
}]);

//{prodId: 2, prodName: "FL Cerial", prodSize: 0, unitId: null, prodPrice: 3…}