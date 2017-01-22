/**
 * Created by Andreas on 18.01.2017.
 */

function Konto($name,$bic){

    self.name = $name;
    self.bic = $bic;
    this._guthaben = 0;
    this._protokoll = [];
}

Konto.prototype.einzahlen = function ($betrag,$text) {

    this._guthaben += $betrag;
    this._protokoll.push({

            action : "ein",
            betrag : $betrag,
            text : $text
        }

    );
}

Konto.prototype.getProtokoll = function (){

     this._protokoll.forEach(function (item) {

     });

}

var myKonto = new Konto("Sparkasse",1234);
myKonto.einzahlen(100,"Auto");
myKonto.getProtokoll();




function Flug(id,abflugort, zielort, datum)
{
    this.id = id;
    this.abflugort = abflugort;
    this.zielort = zielort;
    this.datum = datum;
}
/**
 * Liest die Formularfelder aus die mit ng-model gebunden wurden
 * Erstellt ein Objekt param mit den Eingebaewerten und übergibt diese per htttp Request an die
 * Service Schnittstelle
 * Service gibt ein Array oder ein Obect mit den jeweiligen Resultset zurück
 * @param $http
 * @constructor
 */
function FlugBuchenVM($http){
    var that = this;

    this.fluege = new Array();
    this.selectedFlug = null;
    this.message = "";

    this.flugNummerFilter = "";
    this.flugVonFilter = "";
    this.flugNachFilter = "";

    this.flugVonClientFilter = "";
    this.flugNachClientFilter = "";

    this.sortColumn = "id";
    this.sortDirection = false;


    var params = {};

    this.loadFluege = function(){

        var params = {};

        if(that.flugNummerFilter){
            params =  {flugNummer: that.flugNummerFilter}
        }
        else{
            params = {
                abflugOrt: that.flugVonFilter,
                zielOrt: that.flugNachFilter};
        }

        $http.get('flug.php',{params:params})
        .then(function(result){
            if(angular.isArray(result.data)){
                that.fluege =  result.data;
            }
            else{
                that.fluege = result.data;
            }
        }).catch(function (result){
            that.message = "Fehler: " + result.status + " " + result.statusText+ " " + result.data.message;

        });

        //this.fluege.push(new Flug(1,"Berlin", "Madrid",new Date()));
        //this.fluege.push(new Flug(2,"Bremen", "Hamburg",new Date()));
    }

    this.selectFlug = function(f){
        this.seclectedFlug = f;
    }

    this.setSortColumn = function (colName){
        this.sortColumn = colName;
    }

    this.comparator = function(actual,expected){

        if(!expexted) return true;
        if(actuel.length < expected.length) return false;
        return actual.substr(0,expected.length) === expected;


    }
}

var app = angular.module("flug",[]);
app.controller("FlugBuchenCtrl", function ($scope, $http){
    $scope.vm = new FlugBuchenVM($http);
});

var commonFilter = angular.module("common.filter",[]);
commonFilter.filter("FlugNr", function(){


});

var flugDetail = angular.module("flug.detail",["commonFilter"]);
flugDetail.controller("FlugCtrl",function ($scope) {
    $scope.flug = new Flug(1,"")
})