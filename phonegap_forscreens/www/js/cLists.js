ggControllers.controller('ShopListCtrl', ['$scope', '$rootScope', '$filter', '$timeout', '$http', 'ggActiveList', 'ggProStatus', 'ggNLW', 
function($scope, $rootScope, $filter, $timeout, $http, ggActiveList, ggProStatus, ggNLW) {
    
   
    $scope.shoplists = [ ];
    $scope.checkoutTotal = 0;
    $scope.listDeleteName = "";
    $scope.listDeleteId = "";
    $scope.showHelp = false;
    $scope.proStatus = "<error>";
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    $scope.db.transaction(function (tx) {
        tx.executeSql("CREATE TABLE IF NOT EXISTS tblProd (prodId INTEGER PRIMARY KEY, prodRemoteId INTEGER, prodName TEXT, prodDescription TEXT, prodPhoto TEXT, prodUrl TEXT, prodUpc TEXT, prodTimeStamp INTEGER)");
        tx.executeSql("CREATE TABLE IF NOT EXISTS tblProdlist (prodlistId INTEGER PRIMARY KEY, prodlistRemoteId INTEGER, prodId INTEGER, shoplistId INTEGER, prodPrice REAL DEFAULT 0, prodQty REAL DEFAULT 0, prodlistTimeStamp INTEGER)");
        tx.executeSql("CREATE TABLE IF NOT EXISTS tblShoplist (shoplistId INTEGER PRIMARY KEY, shoplistRemoteId INTEGER, shoplistName TEXT, shoplistDescription TEXT, shoplistUrl TEXT, shoplistImage TEXT, shoplistCustomImage TEXT, shoplistTheme TEXT, shoplistCheckoff INTEGER, storeId INTEGER, profileId INTEGER, shoplistTimeStamp INTEGER)");
        tx.executeSql('ALTER TABLE tblShoplist ADD COLUMN shoplistImage TEXT', [], function(tx, result){
            console.log('added image col to local db');
        }, function(result, error){console.log(error);});
        tx.executeSql('ALTER TABLE tblShoplist ADD COLUMN shoplistCustomImage TEXT', [], function(tx, result){
            console.log('added custom image col to local db');
        }, function(result, error){console.log(error);});
        tx.executeSql('ALTER TABLE tblShoplist ADD COLUMN shoplistTheme TEXT', [], function(tx, result){
            console.log('added theme col to local db');
        }, function(result, error){console.log(error);});
        tx.executeSql('ALTER TABLE tblShoplist ADD COLUMN shoplistDescription TEXT', [], function(tx, result){
            console.log('added description col to local db');
        }, function(result, error){console.log(error);});
    });
    
    if( localStorage.getItem("proStatus") !== null ){
        ggProStatus.SetProStatus(localStorage.getItem("proStatus"));
    }else{
        //TOTO: Set proStatus based on IAP
    }
    
    if( localStorage.getItem("activeList") !== null ){
        ggActiveList.SetActiveList(localStorage.getItem("activeList"));
        app.navi.pushPage('list.html');
        //app.navi.pushPage('share.html');
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
    
    $scope.UnlockImport = function(){
        $rootScope.unlockTitle = "Import List";
        mpro.show('modal');
    };
    
    $scope.SetPro = function(pPro){
        ggProStatus.SetProStatus(pPro);
        app.navi.resetToPage("lists.html");
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
            $scope.proStatus = ggProStatus.GetProStatus();
            console.log('Getting Shop Lists');
            if( response != undefined ) console.log(response.insertId);
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblShoplist', [], function(tx, result){
                    $scope.shoplists = [ ];
                    for( var idx = 0; idx < result.rows.length; idx++){
                        var tmpTheme = "cabin";
                        if(result.rows.item(idx).shoplistTheme){
                            if(result.rows.item(idx).shoplistTheme != ""){
                                tmpTheme = result.rows.item(idx).shoplistTheme;
                            }
                        }
                        $scope.shoplists.push({
                            shoplistId: result.rows.item(idx).shoplistId,
                            shoplistName: result.rows.item(idx).shoplistName,
                            shoplistTheme: tmpTheme,
                        });
                    }
                    if($scope.shoplists.length > 0){ $scope.showHelp = false; }else{ $scope.showHelp = false; app.navi.pushPage('nlwtitle.html');  }
                    $scope.$apply();
                }, function(result, error){console.log(error);});
            });
    };
    
    $scope.NewList = function(){
        try{
            ga('send', 'event', 'button', 'click', 'list_add', 0);
        }catch(exception){
            console.log("ga fail");
        }
        ggNLW.Clear();
        app.navi.pushPage('nlwtitle.html');
    };
    
    $scope.AddList = function () {
        try{
            ga('send', 'event', 'button', 'click', 'list_add', 0);
        }catch(exception){
            console.log("ga fail");
        }
        //$scope.groceries.push({text:$scope.formGroceryText, purchased:false, price: 0});
        var listName = $scope.formListText;
        
        if( listName == "" || typeof listName === "undefined"){
            listName = prompt("Give your list a name:");
        }
        
        console.log("listName", (listName===null));
        
        if( listName != "" && listName !== null && typeof listName !== "undefined"){
            $scope.db.transaction(function (tx) {
                console.log('Adding List');
                console.log(listName);
                tx.executeSql('INSERT INTO tblShoplist (shoplistName, shoplistCheckoff) VALUES ( ?, 0)', [listName], function(tx, response){
                    $scope.UpdateShopList();
                    ggActiveList.SetActiveList(response.insertId);
                    app.navi.pushPage('list.html');
                });
            });
        }else{
            alert('Enter a name in the List Name field and then press the plus button..');
        }
        $scope.formListText = '';
    };
    
    $scope.ShowXferModal = function(){
        mxfer.show('modal'); 
        var element = document.getElementById('xfer-input');
        if(element)
          element.focus();
    };
    
    $scope.RestoreList = function(){
        //if( ggProStatus.GetProStatus() == 1 ){
            var listpin = $scope.xferPin;
            mxfer.hide();
            $http.get('https://mylistmas.herokuapp.com/reactor/syncapi/restorelist/'+listpin).success(function(response){
            //$http.post('http://gibson.loc/listmas/reactor/syncapi/shoplist', pubData).success(function(response){
                console.log("restoring list...",response);
                console.log(response.list);
                if( response.list ){
                    $scope.db.transaction(function (tx) {
                        tx.executeSql('INSERT INTO tblShoplist (shoplistRemoteId,shoplistName,shoplistUrl,shoplistCheckoff,shoplistImage) VALUES ( ?, ?, ?, ?, ?)', 
                            [response.list.shopListId,response.list.shopListName,response.list.shopListCode,response.list.shopListCheckoff,response.list.shopListImage], 
                            function(tx, result){
                                
                                $scope.UpdateShopList();
                                ggActiveList.SetActiveList(result.insertId);
                                console.log("prod",response)
                                for( var idx=0; idx<response.prod.length; idx++){
                                    
                                    if( !response.prod[idx].prodDescription ) response.prod[idx].prodDescription = "";
                                    tx.executeSql('INSERT INTO tblProd (prodName, prodPhoto, prodUrl, prodUpc, prodDescription) VALUES ( ?, ?, ?, ?, ?)', 
                                        [response.prod[idx].prodName, response.prod[idx].prodPhoto, response.prod[idx].prodUrl, response.prod[idx].prodUpc, response.prod[idx].prodDescription], 
                                            function(blah){
                                                return function(tx, responseb){
                                                console.log("BLAH :P", blah);
                                                //$scope.UpdateGroceryList
                                                console.log('Inserting into prodlist: '+responseb.insertId);
                                                tx.executeSql('INSERT INTO tblProdlist (prodId, shoplistId, prodQty) VALUES ( ?, ?, ?)', 
                                                    [responseb.insertId,ggActiveList.GetActiveList(),blah], $scope.UpdateGroceryList), 
                                                    function(result, error){console.log(error);}; 
                                                };
                                            }(response.prod[idx].prodQty), function(result, error){console.log(error);});
                                    
                                    
                                }
                                //app.navi.pushPage('list.html');
                        }, function(result, error){console.log(error);});
                    });
                }else{
                    alert('Invalid transfer code. You can find this code by opening the list on the previous device.')
                }
    
            }).error(function(){
                $scope.UpdateShopList();
                alert('Something went wrong. Please try again. (3)');
            });
        //}else{
        //    mpro.show('modal'); 
        //}
    };
    
    $scope.SetActiveList = function(event){
        //return false;
        console.log('SetActiveList', event);
        ggActiveList.SetActiveList(event);
        //app.slidingMenu.setMainPage('list.html', {closeMenu: true});
        app.navi.pushPage('list.html');
    };
    
    $scope.UpdateShopList();
    
}]);