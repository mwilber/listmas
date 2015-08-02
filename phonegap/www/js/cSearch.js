ggControllers.controller('SearchCtrl', ['$scope', '$filter', '$http', '$timeout', 'ggActiveList', 'ggSearchProd', 
function($scope, $filter, $http, $timeout, ggActiveList, ggSearchProd) {
    
   
    $scope.searchdata = [ ];
    $scope.searchterm = "Search";
    $scope.showHelp = false;
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);


    
    $scope.UpdateSearchList = function(tx, response){
            console.log('Updating search results');
            
            
            
            $scope.$apply();
            
    };
    
    
    $scope.DoSearch = function () {
        $scope.scanStatus = true;
        var listName = $scope.formListText;
        if( listName != "" && typeof listName !== "undefined"){
            console.log('Searching For');
            console.log(listName);
            $http.get('https://mylistmas.herokuapp.com/reactor/jsonapi/azsearch/'+listName).success(function(response){
                console.log(response.data);
                //$scope.scanStatus = false;
                $scope.searchdata = response.data;
                $scope.scanStatus = false;
                $scope.$apply();
                
            });
        }
    };
    
    $scope.ShowDetail = function(pSearchProd){
        ggSearchProd.SetSearchProd(pSearchProd);
        app.navi.pushPage('searchprod.html');
    };
    
    
    
    $scope.AddItem = function(pName, pPhoto, pUrl){
        $scope.db.transaction(function (tx) {
            console.log('Adding Product');
            console.log(pName);
            console.log(pUrl);
            tx.executeSql('INSERT INTO tblProd (prodName, prodPhoto, prodUrl, prodUpc) VALUES ( ?, ?, ?, ?)', [pName, pPhoto, pUrl, ''], function(tx, response){
                console.log('Inserting into prodlist: '+response.insertId);
                tx.executeSql('INSERT INTO tblProdlist (prodId,shoplistId) VALUES ( ?, ?)', [response.insertId,ggActiveList.GetActiveList()], app.navi.popPage()), function(result, error){console.log(error);}; //function(tx, response){
                ggActiveList.MarkDirty();
            }, function(result, error){console.log(error);});
        });
    };
    

    
    $scope.UpdateSearchList();
    
}]);