<?php
require('functionlib.php');

//$get_year=$_POST["year"];
//$get_month=$_POST["month"];
$get_year=2018;
$get_month=2;

$d1=mktime(0, 0, 0, $get_month, 1, $get_year);//月初第一天
$SearchStartDay=date("Y-m-d", $d1);
$d2=mktime(0, 0, 0, $get_month+1, 1, $get_year)-1;//月+1第一天减一秒
$SearchFinishDay=date("Y-m-d", $d2);
//echo $SearchStartDay.'->'.$SearchFinishDay."<br>";
$SearchStartDay=dateidcreate($SearchStartDay);
$SearchFinishDay=dateidcreate($SearchFinishDay);
$startdateid=$SearchStartDay;
$finishdateid=$SearchFinishDay;

$names=Names($startdateid);//数组为name_X依次存入，
$names_sum=count($names);
$dutyinfo=DutyInfo($startdateid);
$duty_num=count($dutyinfo);

for($i=0;$i<$names_sum;$i++){
    $name='name_'.($i+1);
    $$name=new RotaInfo($names[$i]);//创建名为name_x的实例，x从1开始
}

for($i=0;$i<=$names_sum;$i++){
    for($j=0;$j<$duty_num;$j++){
        $statisticdata[$i][$j]="";
    }
}


$scoredisplay = array(
    '<td class="tg-s6z2" colspan="4">跨零点<br></td>',
    '<td class="tg-s6z2"></td>
            <td class="tg-s6z2">昨日</td>
            <td class="tg-s6z2">当日</td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">主晚</td>
            <td class="tg-s6z2">0.5</td>
            <td class="tg-s6z2">6</td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">HD晚</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2">6</td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">新晚<br></td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2">6</td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">影晚</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2">5</td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">生晚</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2">5</td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">考勤</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">早</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">中</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">晚</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>',
    '<td class="tg-s6z2">夜</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>'
);

echo '<table class="tg">';
echo '<tr>';
echo '<th class="tg-content">姓名\日期</th>';
for($i=$startdateid;$i<=$finishdateid;$i++){
    $dayinfo=ReadFromSql("rota_dayinfo","","dateid",$i);
    if($dayinfo['hoilday']==1){
        echo '<th class="tg-weekend">'.$xingqihanzi[$dayinfo['weeknumber']]."<br>".$dayinfo['day'].'</th>';
    }
    else{
        if(($dayinfo['weeknumber']==7 or $dayinfo['weeknumber']==6) && $dayinfo['hoilday']!=2){ 
            echo '<th class="tg-weekend">'.$xingqihanzi[$dayinfo['weeknumber']]."<br>".$dayinfo['day'].'</th>';
        }
        else{
            echo '<th class="tg-weekday">'.$xingqihanzi[$dayinfo['weeknumber']]."<br>".$dayinfo['day'].'</th>';
        }
    }
    
}
echo '<th class="tg-signature">统计</th>';
echo '</tr>';
for($i=0;$i<$names_sum;$i++){
    $name='name_'.($i+1);
    echo '<tr>';
    echo '<td class="tg-content1">'.$$name->Name($startdateid).'</td>';
    for($j=$startdateid;$j<=$finishdateid;$j++){
        $duty_display=$$name->DutyInfoNameDisplay($j);
        echo '<td class="tg-content1">';
        foreach($duty_display as $duty_display_row){
            //$duty_display_row=mb_substr($duty_display_row,-1,2,'utf-8');
            //if($duty_display_row=="班"){
            //    $duty_display_row="夜";
            //}
            //echo mb_substr($duty_display_row,-1,2,'utf-8').'<br>';
            echo $duty_display_row.'<br>';
        }
        echo '</td>';
    }
    echo '<td class="tg-content1">';
    //print_r($$name->StatRotaInfoArray($startdateid,$finishdateid));
    echo '</td>';
    echo '</tr>';
}
echo '<tr>';
echo '<td class="tg-signature">说明</td>';
echo '<td class="tg-content2" colspan="32">';
echo '</td>';
echo '</tr>';
echo '</table>';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>播出科<?php echo $get_year ?>年<?php echo $get_month ?>月</title>
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <script src="libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="libs/jqueryui/datepicker-zh-CN.js"></script>
        <style>
            table {
    display: table;
    border-collapse: separate;
    border-spacing: 2px;
    border-color: gray;
}

.tg  {border-collapse:collapse;border-spacing:0;}
.tg .tg-content1{font-family:"宋体", Times, sans-serif;}
.tg .tg-content2{font-family:"仿宋", Times, sans-serif;}
.tg .tg-signature{font-family:"黑体", Times, sans-serif;font-weight: bold;}
.tg .tg-weekday{font-family:"Times New Roman", Times, sans-serif;}
.tg .tg-weekend{font-family:"Times New Roman", Times, sans-serif;text-decoration: underline;font-weight: bold;}

.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 1px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 1px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
.tg .tg-yw4l{text-align:left}

        </style>

        <script>

        </script>
    </head>
    <body>
    <h2>电视播出部播出科<?php echo $get_year ?>年<?php echo $get_month ?>月考勤表</h2>
    <table class="tg">
    <tr>
        <th class="tg-s6z2" colspan="<?php echo $duty_num+15; ?>"><?php echo $get_month ?>月班次明细表</th>
    </tr>
    <tr>
        <td class="tg-s6z2">姓名</td>
        <?php
        for($i=0;$i<$duty_num;$i++){
            echo '<td class="tg-s6z2">'.$dutyinfo[$i][0].'</td>';
        }
        ?>
        <td class="tg-s6z2">补时</td>
        <td class="tg-s6z2">加分</td>
        <td class="tg-s6z2">假日</td>
        <td class="tg-s6z2">早班数</td>
        <td class="tg-s6z2">中班数</td>
        <td class="tg-s6z2">晚班数</td>
        <td class="tg-s6z2">总班数</td>
        <td class="tg-s6z2">工作量</td>
        <td class="tg-s6z2">量化分</td>
        <td class="tg-s6z2">班次</td>
        <td class="tg-s6z2">分值</td>
        <td class="tg-s6z2">时长</td>
        <td class="tg-s6z2">系数</td>
    </tr>

    <?php
    for($i=0;$i<=$names_sum;$i++){
        echo '<tr>';
        if($i<$names_sum){
            $name='name_'.($i+1);
            echo '<td class="tg-s6z2">'.$$name->Name($startdateid).'</td>';
        }
        else{
            echo '<td class="tg-s6z2"></td>';
        }
        foreach($$name->StatRotaInfoArray($startdateid,$finishdateid) as $key=>$value){
            if($value==0){
                echo '<td class="tg-s6z2"></td>';
            }
            else{
                echo '<td class="tg-s6z2">'.$value.'</td>';
            }
        }
        for($j=0;$j<3;$j++){
            echo '<td class="tg-s6z2"></td>';
        }
        for($j=0;$j<6;$j++){
            echo '<td class="tg-s6z2">'.$i.'/'.$j.'</td>';
        }
        if($i<$duty_num){
            echo '<td class="tg-s6z2">'.$dutyinfo[$i][0].'</td>';
            echo '<td class="tg-s6z2">'.$dutyinfo[$i][1].'</td>';
            echo '<td class="tg-s6z2">'.$dutyinfo[$i][2].'</td>';
            echo '<td class="tg-s6z2">'.$dutyinfo[$i][3].'</td>';
        }
        //echo $scoredisplay[$i+1];
        echo '</tr>';
    }

    ?>
    <tr>
        <td class="tg-s6z2" rowspan="3">说明</td>
        <td class="tg-yw4l" colspan="31">1、检修：<?php  ?></td>
    </tr>
    <tr>
        <td class="tg-yw4l" colspan="31">2、加分：<?php  ?></td>
    </tr>
    <tr>
        <td class="tg-yw4l" colspan="31">3、其它：<?php  ?></td>
    </tr>
</table>

        <script>

        </script>
    </body>
</html>