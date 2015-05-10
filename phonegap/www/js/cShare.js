ggControllers.controller('ShareCtrl', ['$scope', '$http', 'ggActiveList', 
function($scope, $http, ggActiveList) {
   
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
        description:"Make your #wishlist with Listmas"
    };
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
    
    //console.log('Prod Details', $scope.grocery);
    
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
                        console.log($scope.list.shoplistUrl);
                    }
                    //console.log('sharing:',$scope.list.length);
                    if(typeof $scope.list.shoplistUrl === 'undefined'){ $scope.showHelp = true; $scope.publishCopy = "Publish"; }else{ $scope.showHelp = false; $scope.publishCopy = "Update"; }
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
                        if (typeof response.data.shoplistUrl === "undefined") {
                            $scope.publishStatus = false;
                            $scope.UpdateListDetails();
                            alert('Something went wrong. Please try again.');
                        }else{
        			        $scope.db.transaction(function (tx) {
    				            tx.executeSql("UPDATE tblShopList SET shoplistRemoteId=?, shoplistUrl=? WHERE shoplistId=?", 
    				                [response.data.shoplistId, response.data.shoplistUrl, response.data.shoplistRemoteId], function(){
                                        $scope.publishStatus = false;
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
                    }).error(function(){
                        $scope.publishStatus = false;
                        $scope.UpdateListDetails();
                        alert('Something went wrong. Please try again.');
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
        var fbcontent = "https://www.facebook.com/dialog/feed?app_id=360989144063992&link="+escape($scope.shareUrlRoot+$scope.list.shoplistUrl)+"&picture="+escape($scope.metadata.image)+"&name="+escape($scope.metadata.title)+"&message="+escape($scope.metadata.message)+"&description="+escape($scope.metadata.description)+"&redirect_uri=https://facebook.com/";
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
        var pncontent = "https://pinterest.com/pin/create/button/?url="+escape($scope.shareUrlRoot+$scope.list.shoplistUrl)+"&media="+escape('http://www.mylistmas.com/icons/icon_512.png')+"&description="+escape($scope.metadata.title)+escape('! ')+escape($scope.metadata.description)+escape('.');
        window.open(pncontent, '_system');
        return false;
    };
    
    $scope.UpdateListDetails();
    $scope.$apply();

}]);