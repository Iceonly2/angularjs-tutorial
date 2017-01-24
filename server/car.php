<?php
/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 24.01.2017
 * Time: 17:41
 * Liest die Json Datei aus und gibt das Ergebnis anhand der ID als Array zurück
 */

class Car
{

    protected $path = "../client/cars.json";

    public function getCar()
    {

        $ID = "";

        if (isset($_REQUEST["id"]))
            $ID = $_REQUEST["id"];

        $json = file_get_contents($this->path);

        $obj = json_decode($json);

        $return_arr = [];

        foreach ($obj as $key => $value) {

            if (is_object($value)) {
                if ($ID != "" && strpos($value->ID, $ID) !== false) {
                    $return_arr[] = $value;
                }
            }
        }

        return json_encode($return_arr);

    }

}

$detailCar = new Car();
echo $detailCar->getCar();

?>


