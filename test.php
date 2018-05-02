<?php
set_time_limit(5000);
require('sqllibs.php');
//require('functionlib.php');
$dutyarr=[21=>'1', 31=>'2', 41=>'3', 23=>'7', 33=>'8', 43=>'9', 24=>'10', 34=>'11', 44=>'12', 25=>'13', 35=>'14', 45=>'15', 13=>'16'];
//$dutyarr=[21=>'1', 31=>'2', 41=>'3', 23=>'7', 33=>'8', 43=>'9', 24=>'10', 34=>'11', 44=>'12', 25=>'13', 35=>'14', 45=>'15', 13=>'16'];
//print_r($dutyarr);
for($i=1000;$i<=1180;$i++){
    $str=ReadFromSql("rota_bochuke_real_statistic","","dateid",$i);
    $timenum=14197824+864*($i-1);
    if($str){
        echo $i.'-'.$timenum.':';
        for($j=1;$j<=26;$j++){
            $name='name_'.$j;
            if($str[$name]<>""){
                $duty_x='duty_'.$dutyarr[$str[$name]];
                if(existInSQL("rota_bochuke_data","timenum",$timenum)){
                    $db->exec("UPDATE rota_bochuke_data SET $duty_x='$j' WHERE timenum=$timenum");
                }
                else{
                    $db->exec("INSERT INTO rota_bochuke_data (timenum,$duty_x) VALUES ($timenum,'$j')");
                }
            }
        }
        //echo '<br>';
    }
}


?>