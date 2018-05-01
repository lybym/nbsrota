<?php
$current_file = basename(__FILE__);
require('sqllibs.php');

$json = $_POST['updata'];
//$json='{"15250176":{"13":["6"],"21":["16"],"23":["14"],"24":["24"],"25":["13"],"31":["23"],"33":["21"],"34":["12"],"35":["15"],"41":["2"],"43":["11"],"44":["5"],"45":["22"]},"15251040":{"13":["7"],"21":["9"],"23":["6"],"24":["15"],"25":["12"],"31":["10"],"33":["14"],"34":["24"],"35":["18"],"41":["16"],"43":["11"],"44":["25"],"45":["8"]},"15251904":{"13":["13"],"21":["3"],"23":["10"],"24":["18"],"25":["5"],"31":["19"],"33":["20"],"34":["22"],"35":["6"],"41":["4"],"43":["23"],"44":["24"],"45":["7"]},"15252768":{"13":["25"],"21":["2"],"23":["14"],"24":["15"],"25":["17"],"31":["9"],"33":["21"],"34":["5"],"35":["8"],"41":["20"],"43":["6"],"44":["19"],"45":["13"]},"15253632":{"13":["11"],"21":["10"],"23":["8"],"24":["12"],"25":["7"],"31":["3"],"33":["21"],"34":["25"],"35":["22"],"41":["23"],"43":["16"],"44":["18"],"45":["14"]},"15254496":{"13":["9"],"21":["4"],"23":["5"],"24":["25"],"25":["13"],"31":["2"],"33":["17"],"34":["22"],"35":["18"],"41":["10"],"43":["19"],"44":["15"],"45":["12"]},"15255360":{"13":["6"],"21":["16"],"23":["11"],"24":["21"],"25":["24"],"31":["9"],"33":["20"],"34":["7"],"35":["14"],"41":["3"],"43":["23"],"44":["8"],"45":["17"]}}';
$info=json_decode($json, true);


$timenum_array=array_keys($info);
$stimenum=current($timenum_array);
$etimenum=end($timenum_array); 
$dutyx=dutyInfoNeed($stimenum,$etimenum);
function dutyInfoNeed($stimenum,$etimenum){
    global $db;
    $dutyinfo=array();
    $i=0;
    foreach ($db->query("SELECT * from rota_bochuke_dutyinfo 
                        where (stimenum<=$stimenum and etimenum>=$stimenum) 
                        or (stimenum<=$etimenum and etimenum>=$etimenum)") as $arr) {
        $x=$arr['num'];
        $dutyinfo[$x]=$arr['dutyx'];
        $i++;
    }
    return $dutyinfo;
}


foreach ($info as $timestamp => $value1) {
    $timeNum=substr($timestamp,0,8);
    //echo $timeNum.'=><br>';
    foreach ($value1 as $dutyNum => $value2) {
        $duty_x='duty_'.$dutyx[$dutyNum];
        if(count($value2)==0){
            $db->exec("UPDATE rota_bochuke_data SET $duty_x='' WHERE timenum=$timeNum");
        }
        else{
            foreach ($value2 as $nameid) {
                if(existInSQL("rota_bochuke_data","timenum",$timeNum)){
                    //$db->exec("DELETE FROM rota_bochuke_data WHERE dateid=$dateid");
                    $db->exec("UPDATE rota_bochuke_data SET $duty_x='$nameid' WHERE timenum=$timeNum");
                }
                else{
                    $db->exec("INSERT INTO rota_bochuke_data (timenum,$duty_x) VALUES ($timeNum,'$nameid')");
                }
            }
        }
        
    }
}


?>

