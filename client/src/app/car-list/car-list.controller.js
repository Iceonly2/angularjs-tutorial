/**
 * Created by Andreas on 24.01.2017.
 */

var app = angular.module("carList",['ui.router']).controller("CarListCtrl",function ($scope,$http,baseUrl){

    $scope.vm = new BuyCarControllerVM($http,baseUrl);
});

app.config(function($stateProvider,$urlRouterProvider){

    $stateProvider.state('carDetails',{
        url:"carDetails/:pNummer",
        templateUrl: 'src/views/car-info-detail.html',
        controller: function ($scope,$http, $stateParams){
                $scope.cardetail = {};
                var param = {}
                param = {id : $stateParams.pNummer};

                $http.get('../server/car.php', {params: param}).then(function (result) {

                    if(angular.isArray(result.data))
                    {
                        $scope.cardetail= result.data;
                    }
                    else{
                        $scope.cardetail = [result.data];
                    }


                }).catch(function (result) {
                    that.message = "Fehler: " + result.status + " " + result.statusText + " " + result.data.message;

                });
        }
    });
});

function BuyCarControllerVM($http,baseUrl)
{
    var that = this;
    that.title = "Autos Online kaufen";
    this.cars = new Array();

    this.LoadCars = function(){

        $http.get(baseUrl).then(function (result){
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
