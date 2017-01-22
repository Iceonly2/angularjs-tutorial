/**
 * Created by Andreas on 20.01.2017.
 */

var app = angular.module("tutorialApp",[]);
app.constant('carServiceConf',"cars.json");
app.controller("MyPageCtrl",function ($scope,$http,carServiceConf){

    $scope.dm = new PageController($http,carServiceConf);

});

function PageController($http,carServiceConf)
{
    var that = this;
    that.title = "Hello World!";
    this.cars = new Array();

    this.LoadCars = function(){

    $http.get(carServiceConf).then(function (result){
        if(angular.isArray(result.data))
        {
            that.cars = result.data;
        }
        else{
            that.cars = [result.data];
        }


    }).catch(function (result){
        that.message = "Fehler: " + result.status + " " + result.statusText+ " " + result.data.message;

    });
    }

}

