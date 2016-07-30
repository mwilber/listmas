ggControllers.controller('InfoCtrl', ['$scope', '$http', 'ggProStatus', 
function($scope, $http, ggProStatus) {
    
    $scope.proStatus = ggProStatus.GetProStatus();
    $scope.restoreStatus = false;
   
    
    $scope.ViewGZPage = function(){
        try{
            ga('send', 'event', 'button', 'click', 'gzprod', 0);
        }catch(exception){
            console.log("ga fail");
        }
        window.open('http://apps.greenzeta.com/', '_system', 'location=no');
    };
    
    $scope.ViewGZHomePage = function(){
        try{
            ga('send', 'event', 'button', 'click', 'gzprod', 0);
        }catch(exception){
            console.log("ga fail");
        }
        window.open('http://www.greenzeta.com/', '_system', 'location=no');
    };
    
    $scope.RestorePurchase = function(){
        //alert('trying');
        $scope.restoreStatus = true;
        ggProStatus.Restore();
    };
    
    

}]);