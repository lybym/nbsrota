<?php
require('header.php');
require('functionlib.php');
$year=2018;
$month=1;
?>
<h2>电视播出部播出科<?php echo $year ?>年<?php echo $month ?>月考勤表</h2>

<style type="text/css">
table {
    display: table;
    border-collapse: separate;
    border-spacing: 2px;
    border-color: gray;
}
select {
    width: 50px; 
}
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 2px 5px 2px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-content{font-family:"宋体", Times, sans-serif;}
.tg .tg-week{font-family:"Times New Roman", Times, sans-serif;}
.tg .tg-weekend{font-family:"Times New Roman", Times, sans-serif;text-decoration: underline;font-weight: bold;}
</style>

<table class="tg">
<?php 

$attendarray=array(
    "",     //0
    "出勤",  //1
    "公出",  //2
    "迟到",  //3
    "早退",  //4
    "旷工",  //5
    "加班",  //6
    "事假",  //7
    "病假",  //8
    "公休",  //9
    "探亲",  //10
    "婚假",  //11
    "生育假",//12
    "丧假",  //13
    "" ,     //+14为对应的符号
    "√",
    "△",
    "C",
    "Z",
    "K",
    "+",
    "S",
    "B",
    "G",
    "T",
    "H",
    "Y",
    "L"); 


for($i=1;$i<=$name_num;$i++){
    for($j=1;$j<=33;$j++){
        $attenddata[$i][$j]="";//初始化$hundredsafetydata[$i][$j]
    }
}

$d1=mktime(0, 0, 0, $month, 1, $year);//月初第一天
$SearchStartDay=date("Y-m-d", $d1);
$d2=mktime(0, 0, 0, $month+1, 1, $year)-1;//月+1第一天减一秒
$SearchFinishDay=date("Y-m-d", $d2);
//echo $SearchStartDay.'->'.$SearchFinishDay."<br>";
$SearchStartDay=dateidcreate($SearchStartDay);
$SearchFinishDay=dateidcreate($SearchFinishDay);
//echo $SearchStartDay.'->'.$SearchFinishDay."<br>";

$startdateid=$SearchStartDay;
$finishdateid=$SearchFinishDay;
$month_num=$finishdateid-$startdateid+3;//姓名+月长度

echo '<tr>';
echo '<th class="tg-content">姓名\日期</th>';
for($i=$startdateid;$i<=$finishdateid;$i++){
    $daynum_info=(int)ReadFromSql("rota_dayinfo","day","dateid",$i);
    $weeknum_info=(int)ReadFromSql("rota_dayinfo","weeknumber","dateid",$i);
    if($weeknum_info==7 or $weeknum_info==6){
        echo '<th class="tg-weekend">'.$daynum_info.'</th>';
    }
    else{
        echo '<th class="tg-weekday">'.$daynum_info.'</th>';
    }
}
echo '</tr>';
for($i=1;$i<=$name_num;$i++){
    echo '<tr>';
    for($j=1;$j<$month_num;$j++){
        if($j==1){
            echo '<td class="tg-content">'.$names[$i].'</td>';
        }
        else{
            echo '<td class="tg-content">';
            echo '<select name="'.$i."0".$j.'">';
            for($select_num=0;$select_num<=13;$select_num++){
                echo '<option value="'.$select_num.'">'.$attendarray[$select_num].$attendarray[$select_num+14].'</option>';
            }
            echo '</select>';
            echo '</td>';
        }
    }
    echo '</tr>';
}
?>

</table>


<?php
//生成下拉菜单，$name为区块名,$value为内容数组
function SelectCreate($name,$value){
    
}

?>

<?php
require('footer.php');
?>

