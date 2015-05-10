var ggControllers = angular.module('ggControllers', []);

ggControllers.controller('ShopListCtrl', ['$scope', '$filter', '$timeout', 'ggActiveList', 
function($scope, $filter, $timeout, ggActiveList) {
    
   
    $scope.shoplists = [ ];
    $scope.checkoutTotal = 0;
    $scope.listDeleteName = "";
    $scope.listDeleteId = "";
    $scope.showHelp = false;
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    $scope.db.transaction(function (tx) {
        tx.executeSql("CREATE TABLE IF NOT EXISTS tblProd (prodId INTEGER PRIMARY KEY, prodRemoteId INTEGER, prodName TEXT, prodDescription TEXT, prodPhoto TEXT, prodUrl TEXT, prodUpc TEXT, prodTimeStamp INTEGER)");
        tx.executeSql("CREATE TABLE IF NOT EXISTS tblProdlist (prodlistId INTEGER PRIMARY KEY, prodlistRemoteId INTEGER, prodId INTEGER, shoplistId INTEGER, prodPrice REAL DEFAULT 0, prodQty REAL DEFAULT 0, prodlistTimeStamp INTEGER)");
        tx.executeSql("CREATE TABLE IF NOT EXISTS tblShoplist (shoplistId INTEGER PRIMARY KEY, shoplistRemoteId INTEGER, shoplistName TEXT, shoplistUrl TEXT, shoplistCheckoff INTEGER, storeId INTEGER, profileId INTEGER, shoplistTimeStamp INTEGER)");
    });
    
    if( localStorage.getItem("activeList") !== null ){
        ggActiveList.SetActiveList(localStorage.getItem("activeList"));
        app.navi.pushPage('list.html');
    }
    
    app.navi.on('postpush',function(event){
        try{
            console.log('push', event);
            ga('send', 'event', 'panel', 'push', event.enterPage.name);
        }catch(exception){
            console.log("ga fail");
        }
    });
    
    $scope.SetUpGA = function(){
        alert(device.uuid);
        ga('create', 'UA-76054-30', {
            'storage': 'none',
            'clientId':device.uuid
        });
        ga('send', 'pageview', {'page': '/index.html'});  
    };
    
    $scope.DoDelete = function(pId, pName){
       $scope.listDeleteName = pName;
       $scope.listDeleteId = pId;
       $scope.$apply();
       modal.show('modal'); 
    };
    
    $scope.DeleteList = function () {
        
        try{
            ga('send', 'event', 'button', 'click', 'list_delete', 0);
        }catch(exception){
            console.log("ga fail");
        }
        
        console.log("Deleting List", $scope.listDeleteId);
        $scope.db.transaction(function (tx) {
            tx.executeSql('DELETE FROM tblProdlist WHERE shoplistId=?', [$scope.listDeleteId], function(tx, response){
                tx.executeSql('DELETE FROM tblShoplist WHERE shoplistId=?', [$scope.listDeleteId], function(tx, response){
                    $scope.UpdateShopList();
                    modal.hide();
                });
            });
        });
        
        return false;
    };
    
    $scope.UpdateShopList = function(tx, response){
            console.log('Getting Shop Lists');
            if( response != undefined ) console.log(response.insertId);
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblShoplist', [], function(tx, result){
                    $scope.shoplists = [ ];
                    for( var idx = 0; idx < result.rows.length; idx++){
                        $scope.shoplists.push({
                            shoplistId: result.rows.item(idx).shoplistId,
                            shoplistName: result.rows.item(idx).shoplistName,
                        });
                    }
                    if($scope.shoplists.length > 0){ $scope.showHelp = false; }else{ $scope.showHelp = true; }
                    $scope.$apply();
                }, function(result, error){console.log(error);});
            });
    };
    
    
    $scope.AddList = function () {
        try{
            ga('send', 'event', 'button', 'click', 'list_add', 0);
        }catch(exception){
            console.log("ga fail");
        }
        //$scope.groceries.push({text:$scope.formGroceryText, purchased:false, price: 0});
        var listName = $scope.formListText;
        if( listName != "" && typeof listName !== "undefined"){
            $scope.db.transaction(function (tx) {
                console.log('Adding List');
                console.log(listName);
                tx.executeSql('INSERT INTO tblShoplist (shoplistName) VALUES ( ?)', [listName], function(tx, response){
                    $scope.UpdateShopList();
                    ggActiveList.SetActiveList(response.insertId);
                    app.navi.pushPage('list.html');
                });
            });
        }else{
            alert('Enter a name in the List Name field and then press the plus button.');
        }
        $scope.formListText = '';
    };
    
    $scope.SetActiveList = function(event){
        console.log('SetActiveList', event);
        ggActiveList.SetActiveList(event);
        //app.slidingMenu.setMainPage('list.html', {closeMenu: true});
        app.navi.pushPage('list.html');
    };
    
    $scope.UpdateShopList();
    
}]);