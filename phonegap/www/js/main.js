var ggControllers = angular.module('ggControllers', []);

ggControllers.controller('MainCtrl', ['$scope', '$http', 'ggActiveList', 'ggProStatus', 
function($scope, $http, ggActiveList, ggProStatus) {
   
    
    $scope.BuyPro = function(){
        ggProStatus.BuyPro();
        mpro.hide();
    };
    



    

    

}]);