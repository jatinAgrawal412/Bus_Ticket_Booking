var mycontrol=angular.module("ctrl",[]);

mycontrol.controller("control",function($scope){
    $scope.checked=function(){
        $scope.check=false;
    }
    $scope.show1=function(){
        $scope.enbl1=true;
    }
    $scope.show2=function(){
        $scope.enbl2=true;
    }
    $scope.show3=function(){
        $scope.enbl3=true;
    }
    $scope.show4=function(){
        $scope.enbl4=true;
    }
    $scope.show5=function(){
        $scope.enbl5=true;
    }
    $scope.show6=function(){
        $scope.enbl6=true;
    }
});