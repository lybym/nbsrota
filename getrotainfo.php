<?php
require('functionlib.php');
class rotaInfoGet {
    private $name_id;
    private $s_dateid;
    private $e_dateid;
    
    function __construct($nameid,$sdateid,$edateid){//构造函数
        $this->name_id = $nameid;
        $this->s_dateid=$sdateid;
        $this->e_dateid=$edateid;
    }

    function StillWork(){//判断对于当前dateid是否退休，未退休返回1，已退休返回0
        $row=ReadFromSql("rota_bochuke_nameinfo","","id",$this->name_id);
        if($row['retirement']==""){
            return 1;
        }
        elseif(dateidcreate($row['retirement'])>=$this->s_dateid){
            return 1;
        }
        else{
            return 0;
        }
    }
    function nameInfoGet(){//提取nameinfo数据库的信息
        $row=ReadFromSql("rota_bochuke_nameinfo","","id",$this->name_id);
        return $row;
    }

    function nameInfoNeed(){
        $arr=array();
        $row=$this->nameInfoGet();
        $arr["id"]=$row['id'];
        $arr["name_x"]=$row['name_x'];
        $arr["renming"]=$row['renming'];
        return $arr;
    }
    
    function name_XGet(){//根据id生成name_X
        $row=$this->nameInfoGet();
        $info='name_'.$row['name_x'];
        return $info;
    }

    function dutyNumArr($dateid){//返回name_X单个dateid的值班数字的信息数组
        $duty_num=array();
        $name_X=$this->name_XGet();
        $str=ReadFromSql("rota_bochuke_real_statistic",$name_X,"dateid",$dateid);
        if($str==""){
            array_push($duty_num,"0");
        }
        else{
            for($i=0;$i<strlen($str);$i=$i+3){
                array_push($duty_num,substr($str,$i,2));
            }
        }
        return $duty_num;
    }

    function RotaInfoArray(){//生成$s_dateid==>$e_dateid时间段的排班数组
        $rota_info=array();
        for($i=$this->s_dateid;$i<=$this->e_dateid;$i++){
            //if($str<>""){
                $rota_info[$i]=$this->dutyNumArr($i);
                //$rota_info=array_merge($rota_info,$this->DutyNum($i));
            //}
        }
        return $rota_info;
    }

}

//返回nameinfo的条目数
function nameNumGet($sdateid){
    global $db;
    $i=0;
    foreach ($db->query('SELECT * FROM rota_bochuke_nameinfo') as $row) {
        $i++;
    }
    return $i;
}

function dayInfoNeed($dateid){
    $arr=array();
    $row=ReadFromSql("rota_dayinfo","","dateid",$dateid);
    $arr["year"]=$row['year'];
    $arr["month"]=$row['month'];
    $arr["day"]=$row['day'];
    $arr["week"]=$row['weeknumber'];
    $arr["hoilday"]=$row['hoilday'];
    return $arr;
}

function dutyInfoNeed($sdateid,$edateid){
    global $db;
    $dutyinfo=array();
    $i=0;
    foreach ($db->query("SELECT * from rota_bochuke_dutyinfo 
                        where (enable_dateid_start<=$sdateid and enable_dateid_end>=$sdateid) 
                        or (enable_dateid_start<=$edateid and enable_dateid_end>=$edateid)") as $arr) {
        $dutyinfo[$i]["id"]=$arr['id'];
        $dutyinfo[$i]["enable_dateid_start"]=$arr['enable_dateid_start'];
        $dutyinfo[$i]["enable_dateid_end"]=$arr['enable_dateid_end'];
        $dutyinfo[$i]["num"]=$arr['num'];
        $dutyinfo[$i]["name"]=$arr['name'];
        $dutyinfo[$i]["starttime"]=$arr['starttime'];
        $dutyinfo[$i]["endtime"]=$arr['endtime'];
        $dutyinfo[$i]["score"]=$arr['score'];
        $dutyinfo[$i]["duration"]=$arr['duration'];
        $dutyinfo[$i]["coefficient"]=$arr['coefficient'];
        $dutyinfo[$i]["name_enable"]=$arr['name_enable'];
        $i++;
    }
    return $dutyinfo;
}

$sdateid = isset($_GET['sdateid']) ? htmlspecialchars($_GET['sdateid']) : '';
$edateid = isset($_GET['edateid']) ? htmlspecialchars($_GET['edateid']) : '';
$dayinfo=array();
$nameinfo=array();
$dutyinfo=array();
$rotainfo=array();
$allinfo=array();

$nameNum=nameNumGet($sdateid);

for($nameid=1;$nameid<=$nameNum;$nameid++){
    $info=new rotaInfoGet($nameid,$sdateid,$edateid);
    if($info->StillWork()){
        $nameinfo[$nameid]=$info->nameInfoNeed();
        $rotainfo[$nameid]=$info->RotaInfoArray();
    }
}

for($dateid=$sdateid;$dateid<=$edateid;$dateid++){
    $dayinfo[$dateid]=dayInfoNeed($dateid);
}
$allinfo['dayinfo']=$dayinfo;
$allinfo['nameinfo']=$nameinfo;
$allinfo['dutyinfo']=dutyInfoNeed($sdateid,$edateid);
$allinfo['rotainfo']=$rotainfo;
echo json_encode($allinfo);
//echo json_encode(dutyInfoNeed($sdateid,$edateid)); 

?>