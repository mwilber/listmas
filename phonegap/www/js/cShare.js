ggControllers.controller('ShareCtrl', ['$scope', '$http', 'ggActiveList', 'ggProStatus', 
function($scope, $http, ggActiveList, ggProStatus) {
   
    $scope.list = {};
    $scope.activeShopListId = 0;
    $scope.publishStatus = false;
    $scope.publishResultTxt = "";
    $scope.showHelp = false;
    $scope.publishCopy = "Publish";
    $scope.shareUrlRoot = "http://www.mylistmas.com/l/";
    $scope.metadata = {
        title:"Check Out My List", 
        link:"http://www.mylistmas.com", 
        image:"http://www.mylistmas.com/icons/icon_256.png",
        message:"My Listmas",
        description:"Create, Publish and Share your #wishlist with Listmas."
    };
    
    $scope.activeTheme="cabin";
    $scope.showReminder=false;
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    
    //console.log('Prod Details', $scope.grocery);
    //console.log('DA LIST', list.shoplistUrl);
    
    // Update the local database
    $scope.db.transaction(function (tx) {
        tx.executeSql('ALTER TABLE tblShoplist ADD COLUMN shoplistImage INTEGER', [], function(tx, result){
            console.log('added image col to local db');
            //$scope.$apply();
            //setTimeout(function(){$scope.$apply();}, 1000);
        }, function(result, error){console.log(error);});
        tx.executeSql('ALTER TABLE tblShoplist ADD COLUMN shoplistTheme INTEGER', [], function(tx, result){
            console.log('added theme col to local db');
            //$scope.$apply();
            //setTimeout(function(){$scope.$apply();}, 1000);
        }, function(result, error){console.log(error);});
    });
    
    $scope.UpdateListDetails = function(){
            //console.log('Getting List', ggActiveList.GetActiveList());
            //if( response != undefined ) console.log(response.insertId);
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblShoplist WHERE tblShoplist.shoplistId=?', [ggActiveList.GetActiveList()], function(tx, result){
                    //console.log(result.rows.length);
                    $scope.list = {};
                    //console.log("checking length");
                    if( result.rows.length > 0 ){
                        console.log(result.rows.item(0).shoplistName);
                        $scope.list.shoplistName = result.rows.item(0).shoplistName;
                        console.log($scope.list.shoplistName);
                        console.log(result.rows.item(0).shoplistUrl);
                        $scope.list.shoplistUrl = result.rows.item(0).shoplistUrl;
                        console.log(result.rows.item(0).shoplistUrl);
                        $scope.list.shareImage = result.rows.item(0).shoplistImage;
                        console.log($scope.list.shareImage);
                    }
                    //console.log('sharing:',$scope.list.length);
                    
                    if(!$scope.list.shareImage) $scope.list.shareImage = $scope.metadata.image;
                    
                    console.log('image:',$scope.list.shareImage);
                    
                    if(!$scope.list.shoplistUrl){ 
                        //alert('unpublished');
                        $scope.showHelp = true; $scope.publishCopy = "Publish"; 
                    }else{ 
                        //alert('published');
                        $scope.showHelp = false; $scope.publishCopy = "Update";
                        if(ggActiveList.IsDirty()){
                            ggActiveList.MarkClean();
                            mdirty.show('modal');
                        }
                    }
                    //if($scope.showHelp){
                    //    console.log("showing help");
                    //}else{
                    //    console.log("not showing help");
                    //}
                    //console.log('scope.showHelp:',$scope.showHelp);
                    $scope.$apply();
                    //setTimeout(function(){$scope.$apply();}, 1000);
                }, function(result, error){console.log(error);$scope.$apply();});
                $scope.$apply();
            });
    };
    
    $scope.ViewWebPage = function(){
        try{
            ga('send', 'event', 'button', 'click', 'viewlist', 0);
        }catch(exception){
            console.log("ga fail");
        }
        window.open('http://www.mylistmas.com/l/'+$scope.list.shoplistUrl, '_system', 'location=no');
    };
    
    $scope.DoPublish = function(){
        try{
            ga('send', 'event', 'button', 'click', 'publish', 0);
        }catch(exception){
            console.log("ga fail");
        }
            $scope.publishStatus = true;
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
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblProdlist JOIN tblShoplist ON tblProdlist.shoplistId=tblShoplist.shoplistId JOIN tblProd ON tblProdlist.prodId=tblProd.prodId WHERE tblProdlist.shoplistId=?', [ggActiveList.GetActiveList()], function(tx, result){
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
                    //$http.post('https://mylistmas.herokuapp.com/reactor/syncapi/shoplist', pubData).success(function(response){
                    $http.post('http://gibson.loc/listmas/reactor/syncapi/shoplist', pubData).success(function(response){
                        console.log("Saving list...",response);
                        $scope.publishStatus = false;
                        if( response.error.type == -2 ){
                            alert('This list was transferred to another device and can no longer be published from here.');
                        }else{
                            if (typeof response.data.shoplistUrl === "undefined") {
                                $scope.publishStatus = false;
                                $scope.UpdateListDetails();
                                alert('Something went wrong. Please try again.');
                            }else{
            			        $scope.db.transaction(function (tx) {
        				            tx.executeSql("UPDATE tblShopList SET shoplistRemoteId=?, shoplistUrl=?, shoplistImage=?, shoplistCheckoff=? WHERE shoplistId=?", 
        				                [response.data.shoplistId, response.data.shoplistUrl, response.data.shareImage, response.data.shoplistCheckoff, response.data.shoplistRemoteId], function(){
                                            ggActiveList.MarkClean();
                                            $scope.publishResultTxt = "Your list has been published to mylistmas.com!";
                                            pubresult.show('modal');
                                            $scope.UpdateListDetails();
                                        }, function(result, error){
                                            $scope.publishStatus = false;
                                            $scope.UpdateListDetails();
                                            alert('Something went wrong. Please try again.');
                                        });
        				        });
                            }
                        }
                    }).error(function(){
                        $scope.publishStatus = false;
                        $scope.UpdateListDetails();
                        alert('Something went wrong. Please try again.');
                    });
                    
                }, function(result, error){ $scope.UpdateListDetails(); console.log(error);});
            });
            $scope.UpdateListDetails();
    };
    
    $scope.PickTheme = function(){
        
        if( ggProStatus.GetProStatus() == 1 ){
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblShoplist WHERE shoplistId=?', [ggActiveList.GetActiveList()], function(tx, result){
                    $scope.activeTheme = result.rows.item(0).shoplistTheme;
                    $scope.$apply();
                }, function(result, error){console.log(error);});
                
            });
            
            mtheme.show('modal');
        }else{
            mpro.show('modal'); 
        }
        
    };
    
    $scope.ChangeTheme = function(pTheme){
        
        
        if( pTheme != $scope.activeTheme ){
            
            $scope.activeTheme=pTheme;
            $scope.$apply();
            
            $scope.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblShoplist WHERE shoplistId=?', [ggActiveList.GetActiveList()], function(tx, result){
                    if( $scope.activeTheme == result.rows.item(0).shoplistTheme ){
                        $scope.showReminder=false;
                    }else{
                        $scope.showReminder=true;
                    }
                }, function(result, error){console.log(error);});
                
            });
        }
        
    };
    
    $scope.ShowReminder = function(){
        mtheme.hide();
        if( $scope.showReminder ){
            $scope.db.transaction(function (tx) {
                tx.executeSql("UPDATE tblShopList SET shoplistTheme=? WHERE shoplistId=?", 
                    [$scope.activeTheme, ggActiveList.GetActiveList()], function(){
                        $scope.publishResultTxt = "Theme set!";
                        mpreminder.show('modal');
                        $scope.showReminder=false;
                    }, function(result, error){
                        alert('Something went wrong. Please try again.');
                    });
            });
        }
    };
    
    $scope.WarnXfer = function(){
        if( ggProStatus.GetProStatus() == 1 ){
            xferwarn.show('modal');
        }else{
            mpro.show('modal'); 
        }
    };
    
    $scope.DoXfer = function(){
        try{
            ga('send', 'event', 'button', 'click', 'xfer', 0);
        }catch(exception){
            console.log("ga fail");
        }

        console.log('Xferring...');
        var pubData = {
            list:{
                shoplistId:0,
                shoplistName:"",
                shoplistEnhanced:ggProStatus.GetProStatus(),
                shareImage:""
            },
            prod:[],
        };
        
        $scope.db.transaction(function (tx) {
            tx.executeSql('SELECT * FROM tblShoplist WHERE shoplistId=?', [ggActiveList.GetActiveList()], function(tx, result){
                pubData.list.shoplistId = result.rows.item(0).shoplistRemoteId;
                pubData.list.shoplistRemoteId = result.rows.item(0).shoplistId;
                pubData.list.shoplistName = result.rows.item(0).shoplistName;
                console.log(pubData);
                $http.post('https://mylistmas.herokuapp.com/reactor/syncapi/xferlist', pubData).success(function(response){
                //$http.post('http://gibson.loc/listmas/reactor/syncapi/shoplist', pubData).success(function(response){
                    console.log("Xferring list...",response);
                    response.data.shopListCheckoff = -(parseInt(response.data.shopListCheckoff, 10));
                        console.log("SQL UPDATE", response.data.shopListCheckoff, response.data.shopListRemoteId);
        		        $scope.db.transaction(function (tx) {
        		            tx.executeSql("UPDATE tblShopList SET shoplistCheckoff=? WHERE shoplistId=?", 
        		                [response.data.shopListCheckoff, ggActiveList.GetActiveList()], function(){
                                    app.navi.resetToPage('lists.html');
                                }, function(result, error){
                                    $scope.UpdateListDetails();
                                    alert('Something went wrong. Please try again. (2)');
                                });
        		        });

                }).error(function(){
                    $scope.publishStatus = false;
                    $scope.UpdateListDetails();
                    alert('Something went wrong. Please try again. (3)');
                });
            }, function(result, error){ $scope.UpdateListDetails(); console.log(error);});
        });


        $scope.UpdateListDetails();
    };
    
    $scope.FbShare = function(){
        try{
            ga('send', 'event', 'button', 'click', 'share_fb', 0);
        }catch(exception){
            console.log("ga fail");
        }
        var fbcontent = "https://www.facebook.com/dialog/feed?app_id=360989144063992&link="+escape($scope.shareUrlRoot+$scope.list.shoplistUrl)+"&picture="+escape($scope.list.shareImage)+"&name="+escape($scope.metadata.title)+"&message="+escape($scope.metadata.message)+"&description="+escape($scope.metadata.description)+"&redirect_uri=https://facebook.com/";
        window.open(fbcontent, '_system');
        return false;
    };
    
    $scope.TwShare = function(){
        try{
            ga('send', 'event', 'button', 'click', 'share_tw', 0);
        }catch(exception){
            console.log("ga fail");
        }
        var twurl = "https://mobile.twitter.com/compose/tweet?status="+escape($scope.metadata.title)+escape(": ")+escape($scope.shareUrlRoot+$scope.list.shoplistUrl)+escape(" ")+escape($scope.metadata.description);
        window.open(twurl, '_system');
        return false;
    };
    
    $scope.EmShare = function(){
        try{
            ga('send', 'event', 'button', 'click', 'share_em', 0);
        }catch(exception){
            console.log("ga fail");
        }
        var emurl = "mailto:?subject="+escape($scope.metadata.title)+"&body="+escape($scope.metadata.message)+escape(": ")+escape($scope.shareUrlRoot+$scope.list.shoplistUrl)+"%0D%0A%0D%0A"+escape($scope.metadata.description)+" "+escape($scope.metadata.link);
        window.open(emurl, '_system');
        return false;
    };
    
    $scope.GpShare = function(){
        try{
            ga('send', 'event', 'button', 'click', 'share_gp', 0);
        }catch(exception){
            console.log("ga fail");
        }
        var gpcontent = "https://plus.google.com/share?url="+escape($scope.shareUrlRoot+$scope.list.shoplistUrl)+"&description="+escape($scope.metadata.description);
        window.open(gpcontent, '_system');
        return false;
    };
    
    $scope.PnShare = function(){
        try{
            ga('send', 'event', 'button', 'click', 'share_pn', 0);
        }catch(exception){
            console.log("ga fail");
        }
        var pncontent = "https://pinterest.com/pin/create/button/?url="+escape($scope.shareUrlRoot+$scope.list.shoplistUrl)+"&media="+escape($scope.list.shareImage)+"&description="+escape($scope.metadata.title)+escape('! ')+escape($scope.metadata.description)+escape('.');
        window.open(pncontent, '_system');
        return false;
    };
    
    $scope.UpdateListDetails();
    $scope.$apply();
    

}]);