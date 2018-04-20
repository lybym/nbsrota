<?php
require('header.php');
require('functionlib.php');
?>
<h2>电视播出部播出科<?php echo $_POST["year"] ?>年<?php echo $_POST["month"] ?>月考勤表</h2>
<p><p>


<style type="text/css">
table {
    display: table;
    border-collapse: separate;
    border-spacing: 2px;
    border-color: gray;
}

.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-content1{font-family:"宋体", Times, sans-serif;}
.tg .tg-content2{font-family:"仿宋", Times, sans-serif;}
.tg .tg-signature{font-family:"黑体", Times, sans-serif;font-weight: bold;}
.tg .tg-week{font-family:"Times New Roman", Times, sans-serif;}
.tg .tg-weekend{font-family:"Times New Roman", Times, sans-serif;text-decoration: underline;font-weight: bold;}
</style>

<table class="tg">
<?php 
for($i=1;$i<=$name_num;$i++){
    for($j=1;$j<=33;$j++){
        $attenddata[$i][$j]="";//初始化$attenddata[$i][$j]
    }
}

$d1=mktime(0, 0, 0, $_POST["month"], 1, $_POST["year"]);//月初第一天
$SearchStartDay=date("Y-m-d", $d1);
$d2=mktime(0, 0, 0, $_POST["month"]+1, 1, $_POST["year"])-1;//月+1第一天减一秒
$SearchFinishDay=date("Y-m-d", $d2);
//echo $SearchStartDay.'->'.$SearchFinishDay."<br>";
$SearchStartDay=dateidcreate($SearchStartDay);
$SearchFinishDay=dateidcreate($SearchFinishDay);
//echo $SearchStartDay.'->'.$SearchFinishDay."<br>";

$startdateid=$SearchStartDay;
$finishdateid=$SearchFinishDay;
$month_num=$finishdateid-$startdateid+3;//姓名+月长度+签名

for($i=1;$i<=$name_num;$i++){
    $flag=2;
    for($j=$startdateid;$j<=$finishdateid;$j++){
        $namenuminfo='name_'.$i;
        $str=ReadFromSql("rota_bochuke_real_statistic",$namenuminfo,"dateid",$j);
        if($str[0]<>""){
            //根据第1位数字判断班次
            switch ((string)substr($str[0],0,1)) {
                case 1:
                $attenddata[$i][$flag]="夜";
                $flag++;
                break;
                case 2:
                $attenddata[$i][$flag]="早";
                $flag++;
                break;
                case 3:
                $attenddata[$i][$flag]="中";
                $flag++;
                break;
                case 4:
                $attenddata[$i][$flag]="晚";
                $flag++;
                break;
            }
            /*
            if((string)substr($str[0],2,1)=='0'){
                //一人一天2班则格式改为XX0XX，判断第三位为0时读取4-5位
                //根据第4位数字判断班次
                switch ((string)substr($str[0],3,1)) {
                case 1:
                    echo "夜";
                    break;
                case 2:
                    echo "早";
                    break;
                case 3:
                    echo "中";
                    break;
                case 4:
                    echo "晚";
                    break;
                }
            }
            */
        }
        else{
            $attenddata[$i][$flag]="";
            $flag++;
        }
    }
}

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
echo '<th class="tg-signature">本人签名</th>';
echo '</tr>';
for($i=1;$i<=$name_num;$i++){
    echo '<tr>';
    for($j=1;$j<=$month_num;$j++){
        if($j==1){
            echo '<td class="tg-content1">'.$names[$i].'</td>';
        }
        else{
            echo '<td class="tg-content1">'.$attenddata[$i][$j].'</td>';
        }
    }
    echo '</tr>';
}
?>
  <tr>
    <td class="tg-signature">说明</td>
    <td class="tg-content2" colspan="32">
    1、请各部门实事求是，如实填写此表；<br>
    2、考勤范围为与集团签订正式劳动合同人员；<br>
    3、迟到、早退时间以标准工作时间为准；<br>
    4、出勤：√、公出：△、迟到：C、早退：Z、旷工：K、加班：+、事假：S、病假：B、公休：G、探亲：T、婚假：H、生育假：Y、丧假：L；<br>
    5、参加考勤的人员须在考勤表上签字确认；<br>
    6、各部门请于每月8日前将上月考勤表及考勤汇总表报送组织人事部审核、备案，方可发放上月绩效工资。</td>
  </tr>
</table>


<?php

?>

<?php
require('footer.php');
?>
