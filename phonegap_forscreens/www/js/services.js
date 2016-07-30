var ggServices = angular.module('ggServices', []);

ggServices.service('ggProStatus', [
    function(){
        
        var proStatus = 0;

        return {
            GetProStatus: function () {
                return localStorage.getItem("proStatus");
            },
            SetProStatus: function(value) {
                localStorage.setItem("proStatus", value);
            },
            BuyPro: function(){
                if( window.store ){
                    store.order('com.greenzeta.listmas.pro');
                }else{
                    alert('In App Purchasing currently available only in iTunes App Store and Google Play Store.')
                }
            },
            Restore: function(){
                //alert('restoring');
                store.refresh();
            }
        };
    }
]);

ggServices.service('ggNLW', [
    function(){
        
        var db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
        var id = -1;
        var title = "";
        var desc = "";
        var photo = "";
        var theme = "";

        return {
            Clear: function(){
                id = -1;
                title = "";
                desc = "";
                photo = "";
                theme = "";
            },
            SetAll: function(pId, pTitle, pDesc, pPhoto, pTheme){
                id = pId;
                title = pTitle;
                desc = pDesc;
                photo = pPhoto;
                theme = pTheme;
            },
            GetId: function () {
                return id;
            },
            GetTitle: function () {
                return title;
            },
            SetTitle: function(value) {
                title = value;
                console.log('title: '+title,'desc: '+desc,'photo: ','theme: '+theme);
            },
            GetDesc: function () {
                return desc;
            },
            SetDesc: function(value) {
                desc = value;
                console.log('title: '+title,'desc: '+desc,'photo: ','theme: '+theme);
            },
            GetPhoto: function () {
                return photo;
            },
            SetPhoto: function(value) {
                photo = value;
                console.log('title: '+title,'desc: '+desc,'photo: ','theme: '+theme);
            },
            GetTheme: function () {
                return theme;
            },
            SetTheme: function(value) {
                theme = value;
                console.log('title: '+title,'desc: '+desc,'photo: ','theme: '+theme);
            },
            AddUpdate: function(){
                
                return new Promise(function(resolve, reject) {
                    try{
                        ga('send', 'event', 'button', 'click', 'list_add', 0);
                    }catch(exception){
                        console.log("ga fail");
                    }
                    
                    if( title != "" && title !== null && typeof title !== "undefined"){
                        db.transaction(function (tx) {
                            console.log('Adding List');
                            console.log(title);
                            if(id > 0){
                                // TODO: UPDATE HERE
                                tx.executeSql('UPDATE tblShoplist SET shoplistName=?, shoplistDescription=?, shoplistCustomImage=?, shoplistTheme=? WHERE shoplistId=?', 
                                                [title, desc, photo, theme, id], function(tx, response){
                                    //console.log('UPDATE response',response);
                                    resolve(id);
                                });
                            }else{
                                tx.executeSql('INSERT INTO tblShoplist (shoplistName, shoplistDescription, shoplistCustomImage, shoplistTheme, shoplistCheckoff) VALUES ( ?, ?, ?, ?, 0)', 
                                                [title, desc, photo, theme], function(tx, response){
                                    resolve(response.insertId);
                                });
                            }
                        });
                    }else{
                        //alert('Enter a name in the List Name field and then press the plus button..');
                        reject("no title found");
                    }
                });
            },
        };
    }
]);

ggServices.service('ggActiveList', ['$http', 'ggProStatus', 
    function($http, ggProStatus){
        
        var activeList = 0;
        var listDirty = false;
        var db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);

        return {
            GetActiveList: function () {
                return activeList;
            },
            SetActiveList: function(value) {
                activeList = value;
                listDirty = false;
                localStorage.setItem("activeList", activeList);
            },
            MarkDirty: function(){
                //alert('setting dirty');
                listDirty = true;
            },
            MarkClean: function(){
                listDirty = false;
            },
            IsDirty: function(){
                return listDirty;
            },
            Publish: function(){
                
                
                return new Promise(function(resolve, reject) {
                
                    try{
                        ga('send', 'event', 'button', 'click', 'publish', 0);
                    }catch(exception){
                        console.log("ga fail");
                    }
                    
                    console.log('Publishing...');
                    var pubData = {
                        list:{
                            shoplistId:0,
                            shoplistName:"",
                            shoplistEnhanced:ggProStatus.GetProStatus(),
                            shareImage:"",
                            shoplistTheme:""
                        },
                        prod:[],
                    };
                    db.transaction(function (tx) {
                        tx.executeSql('SELECT * FROM tblProdlist JOIN tblShoplist ON tblProdlist.shoplistId=tblShoplist.shoplistId JOIN tblProd ON tblProdlist.prodId=tblProd.prodId WHERE tblProdlist.shoplistId=?', [activeList], function(tx, result){
                            pubData.list.shoplistId = result.rows.item(0).shoplistRemoteId;
                            pubData.list.shoplistRemoteId = result.rows.item(0).shoplistId;
                            pubData.list.shoplistName = result.rows.item(0).shoplistName;
                            pubData.list.shoplistTheme = result.rows.item(0).shoplistTheme;
                            pubData.list.shoplistCheckoff = result.rows.item(0).shoplistCheckoff;
                            for( var idx = 0; idx < result.rows.length; idx++){
                                pubData.prod.push({
                                    prodId: result.rows.item(idx).prodId,
                                    prodName: result.rows.item(idx).prodName,
                                    prodPhoto: result.rows.item(idx).prodPhoto,
                                    prodDescription: result.rows.item(idx).prodDescription,
                                    prodUrl: result.rows.item(idx).prodUrl,
                                    prodUpc: result.rows.item(idx).prodUpc,
                                    prodQty: result.rows.item(idx).prodQty,
                                });
                            }
                            console.log(pubData);
                            $http.post('https://mylistmas.herokuapp.com/reactor/syncapi/shoplist', pubData).success(function(response){
                            //$http.post('http://gibson.loc/listmas/reactor/syncapi/shoplist', pubData).success(function(response){
                                console.log("Saving list...",response);
                                //$scope.publishStatus = false;
                                if( response.error.type == -2 ){
                                    alert('This list was transferred to another device and can no longer be published from here.');
                                }else{
                                    if (typeof response.data.shoplistUrl === "undefined") {
                                        //$scope.publishStatus = false;
                                        //$scope.UpdateListDetails();
                                        reject('Something went wrong. Please try again.');
                                    }else{
                        		        db.transaction(function (tx) {
                				            tx.executeSql("UPDATE tblShopList SET shoplistRemoteId=?, shoplistUrl=?, shoplistImage=?, shoplistCheckoff=? WHERE shoplistId=?", 
                				                [response.data.shoplistId, response.data.shoplistUrl, response.data.shareImage, response.data.shoplistCheckoff, response.data.shoplistRemoteId], function(){
                                                    //ggActiveList.MarkClean();
                                                    listDirty = false;
                                                    // TODO: Add check for upgrade here
                                                    resolve("Your list has been published to mylistmas.com!");
                                                    //pubresult.show('modal');
                                                    //$scope.UpdateListDetails();
                                                }, function(result, error){
                                                    //$scope.publishStatus = false;
                                                    //$scope.UpdateListDetails();
                                                    reject('Something went wrong. Please try again.');
                                                });
                				        });
                                    }
                                }
                            }).error(function(){
                                //$scope.publishStatus = false;
                                //$scope.UpdateListDetails();
                                reject('Something went wrong. Please try again.');
                            });
                            
                        }, function(result, error){ reject('Something went wrong. Please try again.'); /*$scope.UpdateListDetails();*/ console.log(error);});
                    });
                
                });
                
                
                
                
                
                
                
                
                
                
                
                
            },
        };
    }
]);

ggServices.service('ggActiveProd', [
    function(){
        
        var activeProd = {};

        return {
            GetActiveProd: function () {
                return activeProd;
            },
            SetActiveProd: function(value) {
                activeProd = value;
            }
        };
    }
]);

ggServices.service('ggSearchProd', [
    function(){
        
        var searchProd = {};

        return {
            GetSearchProd: function () {
                return searchProd;
            },
            SetSearchProd: function(value) {
                searchProd = value;
            }
        };
    }
]);

ggServices.service('ggDb', [
    function(){
        //alert('service start');
        this.SQL_CREATE_TABLE_PRODUCT = "CREATE TABLE IF NOT EXISTS tblProd (prodId INTEGER PRIMARY KEY, prodName TEXT, unitId INTEGER, prodSize REAL, prodUpc TEXT, prodDateAdded INTEGER)";
        this.SQL_DROP_TABLE_PRODUCT = "DROP TABLE IF EXISTS tblProd";
        this.SQL_INSERT_PRODUCT = "INSERT INTO tblProd (prodName) VALUES ( ?)";
        
        this.db = openDatabase('ggamer', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
        this.db.transaction(function (tx) {
            tx.executeSql(this.SQL_CREATE_TABLE_PRODUCT);
            //tx.executeSql('INSERT INTO tblProd (prodName) VALUES ( ?)', ['gisp3']);
        });
        
        this.ClearDb = function(){
            alert('clearing tblProd');
            this.db.transaction(function (tx) {
                tx.executeSql(this.SQL_DROP_TABLE_PRODUCT);
                //tx.executeSql(this.SQL_CREATE_TABLE_PRODUCT);
            });
        };
        
        this.TestInsert = function(){
            this.db.transaction(function (tx) {
                tx.executeSql('INSERT INTO tblProd (prodName) VALUES ( ?)', ['gisp4']);
            });
        };
        
        this.AddProd = function(pProd, pReturn){
            console.log('Adding Product');
            console.log(pProd);
            this.db.transaction(function (tx) {
                tx.executeSql('INSERT INTO tblProd (prodName) VALUES ( ?)', [pProd.name], pReturn);
            });
        };
        
        this.GetProds = function(pReturn){
            console.log('Getting Product List');
            this.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblProd', [], pReturn, function(result){alert('error'); console.log(result);});
            });
        };
    }
]);