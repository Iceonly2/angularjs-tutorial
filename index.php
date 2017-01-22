<html>

<head>
    <link rel="stylesheet" href="css/bootstrap.css"></link>
    <link rel="stylesheet" href="css/styles.css" media="all"></link>
    <script type="application/javascript" src="js/angular.min.js"></script>
    <script type="application/javascript" src="js/script.js"></script>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6">

                <div ng-app="flug">
                    <div  ng-controller="FlugBuchenCtrl">

                        <h2>Flug auswählen</h2>
                        <div ng-show="vm.message">

                            {{vm.message}}
                        </div>
                        <div class="form-group">
                             <label>Flugnummer</label>
                             <input ng-model="vm.flugNummerFilter" class="form-control">
                         </div>

                        <div class="form-group">
                            <label>Von:</label>
                            <input ng-model="vm.flugVonFilter" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nach</label>
                            <input ng-model="vm.flugNachFilter" class="form-control">
                        </div>

                       <div class="form-group">
                           <input type="button" value="suchen" ng-click="vm.loadFluege()" class="btn">
                       </div>

                        <div class="panel">
                            <div class="panel-heading">



                            </div>

                            <div class="panel-body">

                                <div class="form-group">
                                    <label>Von</label>
                                    <input ng-model="flugVonClientFilter">
                                </div>

                                <div class="form-group">
                                    <label>Nach</label>
                                    <input ng-model="flugNachClientFilter">
                                </div>
                            </div>

                        </div>

                        <table ng-show="vm.fluege.length > 0">
                            <tr>
                               <th><a ng-click="vm.setSortColumn('id')">Id</a></th>
                                <th><a ng-click="vm.setSortColumn('datum.getTime()')">Datum</a></th>
                                <th><a ng-click="vm.setSortColumn('abflugort')">Abflugort</a></th>
                                <th><a ng-click="vm.setSortColumn('zielort')">Zielort</a></th>
                                <th>Aktion</th>
                            </tr>
                            <tr ng-repeat="f in vm.fluege |filter: {abflugort:flugVonClientFilter,zielort:flugNachClientFilter} |
                                             orderBy:vm.sortColumn:vm.sortDirection" ng-class="{info: f.id === vm.selectedFlug.id}">
                                        <td>{{f.id}}</td>
                                        <td>{{f.datum | date : 'shortDate'}}</td>
                                        <td>{{f.abflugort}}</td>
                                        <td>{{f.zielort}}</td>
                                        <td><a href="" ng-click="vm.selectFlug(f)">Auswählen</a> </td>
                            </tr>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">


        </div>
    </div>
</div>
</body>
</html>


<?php
interface iTemplate
{
    public function setVariable($name, $var);
    public function getHtml($template);
}

class Calculator  implements iTemplate{

    /**
     * @param $start
     * @param $end
     * @return string
     */
    public function getNumber($start,$end){

        $result = '';

        for($i = $start;$i<=$end;$i++){

            if( $i % 2 === 0){

                $result .= $i.",";
            }

        }

        return $result;
    }


    public function setVariable($name, $var){}
    public function getHtml($template){}
}

//echo Calculator::getNumber(0,10);

$myCalculator = new Calculator();
echo $myCalculator->getNumber(0,10);



$a = '1';
$b = &$a;
$b = "2$a";

echo $a;
?>
