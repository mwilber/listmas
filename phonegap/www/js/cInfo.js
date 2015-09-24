ggControllers.controller('InfoCtrl', ['$scope', '$http',
function($scope, $http) {


    $scope.ViewGZPage = function(){
        try{
            ga('send', 'event', 'button', 'click', 'gzprod', 0);
        }catch(exception){
            console.log("ga fail");
        }
        window.open('http://www.greenzeta.com/home/listing/product', '_system', 'location=no');
    };

    $scope.ViewGZHomePage = function(){
        try{
            ga('send', 'event', 'button', 'click', 'gzprod', 0);
        }catch(exception){
            console.log("ga fail");
        }
        window.open('http://www.greenzeta.com/', '_system', 'location=no');
    };



}]);
