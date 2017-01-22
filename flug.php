<?php

$data = file_get_contents("php://input");
$flugnummer = "";
$zielort = "";
$abflugort = "";


if(isset($_REQUEST["flugNummer"]))
    $flugnummer = $_REQUEST["flugNummer"];

if(isset($_REQUEST["abflugOrt"]))
    $abflugort = $_REQUEST["abflugOrt"];

if(isset($_REQUEST["zielOrt"]))
    $zielort = $_REQUEST["zielOrt"];

$myFlug1 = new Flug(1,"Madrid", "Berlin");
$myFlug2 = new Flug(2,"Muenchen", "Hamburg");
$myFlug3 = new Flug(3,"Madrid", "Hamburg");

$fluege = array($myFlug1,$myFlug2,$myFlug3);

$return_arr = [];

foreach($fluege as $key => $value){

    if(is_object($value)){
        if ($flugnummer != "" && strpos($value->id,$flugnummer) !== false) {
            $json_response = $value;
            $return_arr[] = $json_response;
        }

        if ($abflugort != "" && strpos($value->abflugort,$abflugort) !== false) {
            $json_response = $value;
            $return_arr[] = $json_response;
        }

        if ($zielort != "" && strpos($value->zielort, $zielort) !== false ){
            $json_response = $value;
            $return_arr[] = $json_response;
        }
    }
}

echo( json_encode($return_arr));

//$myFlug = new Flug(1, "Muenchen", "Hamburg");
//echo $json_response = json_encode($myFlug);

class Flug{

    public $id = "";
    public $date = "";
    public $abflugort = "";
    public $zielort = "";

    function __construct($id,$abflugort,$zielort)
    {
        $this->id = $id;
        $this->zielort = $zielort;
        $this->abflugort = $abflugort;
        $this->date = date("Y-m-d H:i:s");
    }

}

?>



