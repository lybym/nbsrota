<?php 
require('header.php');
require('functionlib.php');

$record_start=$_POST["recordstart"];
$record_day=array();
$record_day[1] =$record_start;
$record_day[2] =date('Y-m-d',strtotime("$record_start +1 days"));
$record_day[3] =date('Y-m-d',strtotime("$record_start +2 days"));
$record_day[4] =date('Y-m-d',strtotime("$record_start +3 days"));
$record_day[5] =date('Y-m-d',strtotime("$record_start +4 days"));
$record_day[6] =date('Y-m-d',strtotime("$record_start +5 days"));
$record_day[7] =date('Y-m-d',strtotime("$record_start +6 days"));
$recordweeknum=date('W',strtotime($record_day[1]))+1;


if(sqldateidjudgment("rota_bochuke_real_statistic","dateid",$recordweeknum)){
    mysqli_query($con,"INSERT INTO rota_bochuke_real_statistic (dateid) VALUES ($recordweeknum)");
}
for($i=1;$i<=7;$i++)
{
    $dateid[$i]=dateidcreate($record_day[$i]);
    if(sqldateidjudgment("rota_bochuke_real_statistic","dateid",$dateid[$i])){
        mysqli_query($con,"INSERT INTO rota_bochuke_real_statistic (dateid) VALUES ($dateid[$i])");
    }
    if(sqldateidjudgment("rota_bochuke_real_statistic_dayinfo","daynum",$dateid[$i])){
        mysqli_query($con,"INSERT INTO rota_bochuke_real_statistic_dayinfo (daynum,dateid) VALUES ($dateid[$i],$recordweeknum)");
    }
    for($j=1;$j<=$name_num;$j++){
        $deletename='name_'.$j;
        mysqli_query($con,"UPDATE rota_bochuke_real_statistic SET $deletename = '' WHERE dateid = $dateid[$i]");
    }

    //将假日和检修信息清空
    mysqli_query($con,"UPDATE rota_bochuke_real_statistic_dayinfo SET hoilday = '0' WHERE daynum = $dateid[$i]");
    mysqli_query($con,"UPDATE rota_bochuke_real_statistic_dayinfo SET jianxiu = '0' WHERE daynum = $dateid[$i]");
}
//录入假日信息
if(isset($_POST["hoilday"])){
    $hoilday=$_POST["hoilday"];
        foreach($hoilday as $x=>$x_value) {
            mysqli_query($con,"UPDATE rota_bochuke_real_statistic_dayinfo SET hoilday = '1' WHERE daynum = $dateid[$x_value]");
        }
}
//录入检修信息
if(isset($_POST["jianxiu"])){
    $jianxiu=$_POST["jianxiu"];
        foreach($jianxiu as $x=>$x_value) {
            mysqli_query($con,"UPDATE rota_bochuke_real_statistic_dayinfo SET jianxiu = '1' WHERE daynum = $dateid[$x_value]");
        }
}

for($i=1;$i<=7;$i++)
{
    for($j=1;$j<=4;$j++)
    {
        for($k=1;$k<=5;$k++)
        {   
            $displaynum=(string)$i.(string)$j.(string)$k;//输出数组建立
            if(!(@$_POST["$displaynum"]=='')){    
                for ($name_preinsert=1;$name_preinsert<=$name_num;$name_preinsert++){
                    $nameinfo_preinsert=$_POST["$displaynum"];
                    if ($nameinfo_preinsert==$names[$name_preinsert]){
                        $dateid_preinsert=dateidcreate($record_day[1])+$i-1;
                        $namenuminfo='name_'.$name_preinsert;
                        $rotainfo_preinsert=(string)$j.(string)$k;
                        mysqli_query($con,"UPDATE rota_bochuke_real_statistic SET $namenuminfo = $rotainfo_preinsert WHERE dateid = $dateid_preinsert");
                    }
                }
            }   
        }
    }    
}

$read_startdateid=dateidcreate($record_day[1]);
$read_finishdateid=$read_startdateid+6;
readfromsqltoform("rota_bochuke_real_statistic",$read_startdateid,$read_finishdateid);
?>

<h4>录入成功</h4>
<table border="1">
    <tr>
        <th>日期</th>
        <th>班次</th>
        <th>值班长岗</th>
        <th>月检修</th>
        <th>新闻/教科</th>
        <th>娱乐/影视/少儿</th>
        <th>信息/十八/生活</th>
    </tr>
    <?php
    $xingqihanzi=array("","一","二","三","四","五","六","日");
    for($formnum=1;$formnum<=7;$formnum++){
        echo '<tr>';
        echo '<td align="center" rowspan="4">'.$record_day[$formnum].'<br>'."星期".$xingqihanzi[$formnum].'</td>';
        echo '<td align="center">夜班</td>
              <td align="center"></td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+12].'</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+13].'</td>';
        echo '<td align="center"></td>
              <td align="center"></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="center">早班</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+21].'</td>';
        echo '<td align="center"></td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+23].'</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+24].'</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+25].'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="center">中班</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+31].'</td>';
        echo '<td align="center"></td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+33].'</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+34].'</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+35].'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="center">晚班</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+41].'</td>';
        echo '<td align="center"></td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+43].'</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+44].'</td>';
        echo '<td align="center">'.$namedisplay[$formnum*100+45].'</td>';
        echo '</tr>';
    }
    ?>

</table>

<?php
require('footer.php');
?>