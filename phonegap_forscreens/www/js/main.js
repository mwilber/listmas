var ggControllers = angular.module('ggControllers', []);

ggControllers.controller('MainCtrl', ['$scope', '$rootScope', '$http', 'ggActiveList', 'ggProStatus', 
function($scope, $rootScope, $http, ggActiveList, ggProStatus) {
   
    
    $scope.BuyPro = function(){
        ggProStatus.BuyPro();
        mpro.hide();
    };
    
    $rootScope.unlockTitle = "Unlock Listmas";


    

    

}]);