ggControllers.controller('ShareCtrl', ['$scope', '$http', 'ggActiveList', 
function($scope, $http, ggActiveList) {
   
    $scope.list = {};
    $scope.activeShopListId = 0;
    $scope.scanstatus = "SCAN";
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    
    console.log('Prod Details', $scope.grocery);
    
    $scope.UpdateListDetails = function(tx, response){
            console.log('Getting List', ggActiveList.GetActiveList());
            if( response != undefined ) console.log(response.insertId);
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblShoplist WHERE tblShoplist.shoplistId=?', [ggActiveList.GetActiveList()], function(tx, result){
                    console.log(result);
                    $scope.list = {};
                    if( result.rows.length > 0 ){
                        $scope.list.shoplistName = result.rows.item(0).shoplistName;
                        $scope.list.shoplistUrl = result.rows.item(0).shoplistUrl;
                    }
                    console.log('sharing:',$scope.list);
                    $scope.$apply();
                }, function(result, error){console.log(error);});
            });
    };
    
    $scope.ViewWebPage = function(){
        window.open('http://mylistmas.herokuapp.com/index.php?l='+$scope.list.shoplistUrl, '_system');
    };
    
    $scope.DoPublish = function(){
            console.log('Publishing...');
            var pubData = {
                list:{
                    shoplistId:0,
                    shoplistName:"",
                },
                prod:[],
            };
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblProdlist JOIN tblShoplist ON tblProdlist.shoplistId=tblShoplist.shoplistId JOIN tblProd ON tblProdlist.prodId=tblProd.prodId WHERE tblProdlist.shoplistId=?', [ggActiveList.GetActiveList()], function(tx, result){
                    pubData.list.shoplistId = result.rows.item(0).shoplistRemoteId;
                    pubData.list.shoplistRemoteId = result.rows.item(0).shoplistId;
                    pubData.list.shoplistName = result.rows.item(0).shoplistName;
                    for( var idx = 0; idx < result.rows.length; idx++){
                        pubData.prod.push({
                            prodId: result.rows.item(idx).prodId,
                            prodName: result.rows.item(idx).prodName,
                            prodPhoto: result.rows.item(idx).prodPhoto,
                            prodDescription: result.rows.item(idx).prodDescription,
                            prodUrl: result.rows.item(idx).prodUrl,
                            prodUpc: result.rows.item(idx).prodUpc,
                        });
                    }
                    console.log(pubData);
                    $http.post('https://mylistmas.herokuapp.com/reactor/syncapi/shoplist', pubData).success(function(response){
                    //$http.post('http://gibson.loc/listmas/reactor/syncapi/shoplist', pubData).success(function(response){
                        console.log("Saving list...",response);
    			        $scope.db.transaction(function (tx) {
				            tx.executeSql("UPDATE tblShopList SET shoplistRemoteId=?, shoplistUrl=? WHERE shoplistId=?", 
				                [response.data.shoplistId, response.data.shoplistUrl, response.data.shoplistRemoteId], function(){alert("saved!");}, function(result, error){console.log(error);});
				        });
                    });
                    
                }, function(result, error){alert('error'); console.log(error);});
            });
    };
    
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
    
    $scope.UpdateListDetails();

}]);