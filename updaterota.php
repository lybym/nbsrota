<?php
$current_file = basename(__FILE__);
require('sqllibs.php');

$json = '{"2":{"1182":["0"],"1183":["0"]},"3":{"1182":["21"],"1183":["0"]}}';

$a=json_decode($json, true);
//print_r($a);
//print_r($a[2][1161][0]);
foreach ($a as $namex => $value1) {
    $name_x='name_'.$namex;
    foreach ($value1 as $dateid => $value2) {
        foreach ($value2 as $rota) {
            //echo $name_x.':'.$dateid.':'.$rota.'<br>';
            if(existInSQL("rota_bochuke_data","dateid",$dateid)){
                $db->exec("UPDATE rota_bochuke_data SET $name_x='$rota' WHERE dateid=$dateid");
            }
            else{
                $db->exec("INSERT INTO rota_bochuke_data (dateid,$name_x) VALUES ($dateid,'$rota')");
            }
        }
    }
}


?>