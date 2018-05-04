<?php
require('sqllibs.php');
class rotaInfoGet {
    private $s_timenum;
    private $e_timenum;
    
    function __construct($sdtimeNum,$edtimeNum){//构造函数
        $this->s_timenum=$sdtimeNum;
        $this->e_timenum=$edtimeNum;
    }

    function dutyInfoNeed(){
        global $db;
        $dutyinfo=array();
        foreach ($db->query("SELECT * from rota_bochuke_dutyinfo 
                            where (stimenum<=$this->s_timenum and etimenum>=$this->s_timenum) 
                            or (stimenum<=$this->e_timenum and etimenum>=$this->e_timenum)") as $arr) {
            $duty_x=$arr['dutyx'];              
            $dutyinfo[$duty_x]["stimenum"]=$arr['stimenum'];
            $dutyinfo[$duty_x]["etimenum"]=$arr['etimenum'];
            $dutyinfo[$duty_x]["name"]=$arr['name'];
            $dutyinfo[$duty_x]["num"]=$arr['num'];
            $dutyinfo[$duty_x]["stime"]=$arr['stime'];
            $dutyinfo[$duty_x]["etime"]=$arr['etime'];
            $dutyinfo[$duty_x]["score"]=$arr['score'];
            $dutyinfo[$duty_x]["duration"]=$arr['duration'];
            $dutyinfo[$duty_x]["coefficient"]=$arr['coefficient'];
            $dutyinfo[$duty_x]["weekday"]=$arr['weekday'];
        }
        return $dutyinfo;
    }

    function nameidArr($timenum){//返回duty_X单个timenum的值班人员nameid的信息数组
        $nameid=array();
        $str=ReadFromSql("rota_bochuke_data","","timenum",$timenum);
        for($i=1;$i<=20;$i++){
            $duty_X='duty_'.$i;
            if($str["$duty_X"]<>""){
                $nameid["$i"]=$str["$duty_X"];
            }
        }
        return $nameid;
    }

    function RotaInfoArray(){//生成$s_timenum==>$e_timenum时间段的排班数组
        $rota_info=array();
        $timeNumLoop=timeNumArrayCreate($this->s_timenum,$this->e_timenum);
        for($i=0;$i<count($timeNumLoop);$i++){
            //if($str<>""){
                $timeNum=$timeNumLoop[$i];
                $rota_info[$timeNum]=$this->nameidArr($timeNum);
                //$rota_info=array_merge($rota_info,$this->DutyNum($i));
            //}
        }
        return $rota_info;
    }
}

$sdtimeNum = isset($_GET['sdtimeNum']) ? htmlspecialchars($_GET['sdtimeNum']) : '';
$edtimeNum = isset($_GET['edtimeNum']) ? htmlspecialchars($_GET['edtimeNum']) : '';


$dayinfo=array();
$nameinfo=array();
$dutyinfo=array();
$rotainfo=array();
$getinfo=array();

$info=new rotaInfoGet($sdtimeNum,$edtimeNum);
    
$getinfo['dayinfo']=dayInfoNeed($sdtimeNum,$edtimeNum);
$getinfo['nameinfo']=nameinfoGet($sdtimeNum);
$getinfo['dutyinfo']=$info->dutyInfoNeed();
$getinfo['rotainfo']=$info->RotaInfoArray();
echo json_encode($getinfo);
//echo json_encode(dutyInfoNeed($sdtimeNum,$edtimeNum)); 

?>