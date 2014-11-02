ggControllers.controller('SearchCtrl', ['$scope', '$filter', '$http', '$timeout', 'ggActiveList', 
function($scope, $filter, $http, $timeout, ggActiveList) {
    
   
    $scope.searchdata = [ ];
    $scope.searchterm = "Search";
    $scope.showHelp = false;
    
    $scope.db = openDatabase('listmas', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);


    
    $scope.UpdateSearchList = function(tx, response){
            console.log('Updating search results');
            
            
            
            $scope.$apply();
            
    };
    
    
    $scope.DoSearch = function () {
        var listName = $scope.formListText;
        if( listName != "" && typeof listName !== "undefined"){
            console.log('Searching For');
            console.log(listName);
            $http.get('https://mylistmas.herokuapp.com/reactor/jsonapi/azsearch/'+listName).success(function(response){
                console.log(response.data);
                //$scope.scanStatus = false;
                $scope.searchdata = response.data;
                $scope.$apply();
                
            });
        }
    };
    
    $scope.AddItem = function(pName, pPhoto, pUrl){
        $scope.db.transaction(function (tx) {
            console.log('Adding Product');
            console.log(pName);
            console.log(pUrl);
            tx.executeSql('INSERT INTO tblProd (prodName, prodPhoto, prodUrl, prodUpc) VALUES ( ?, ?, ?, ?)', [pName, pPhoto, pUrl, ''], function(tx, response){
                console.log('Inserting into prodlist: '+response.insertId);
                tx.executeSql('INSERT INTO tblProdlist (prodId,shoplistId) VALUES ( ?, ?)', [response.insertId,ggActiveList.GetActiveList()], app.navi.popPage()), function(result, error){console.log(error);}; //function(tx, response){
                
            }, function(result, error){console.log(error);});
        });
    };
    

    
    $scope.UpdateSearchList();
    
}]);