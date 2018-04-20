<?php 
require('header.php');
require('functionlib.php');
$scoredisplay = array('',
'<td class="tg-s6z2">主早</td>
            <td class="tg-s6z2">'.$scoredata[1].'</td>
            <td class="tg-s6z2">'.$scoredata[2].'</td>
            <td class="tg-s6z2">'.$scoredata[3].'</td>',
'<td class="tg-s6z2">主中</td>
            <td class="tg-s6z2">'.$scoredata[4].'</td>
            <td class="tg-s6z2">'.$scoredata[5].'</td>
            <td class="tg-s6z2">'.$scoredata[6].'</td>',
'<td class="tg-s6z2">主晚</td>
            <td class="tg-s6z2">'.$scoredata[7].'</td>
            <td class="tg-s6z2">'.$scoredata[8].'</td>
            <td class="tg-s6z2">'.$scoredata[9].'</td>',
'<td class="tg-s6z2">HD早</td>
            <td class="tg-s6z2">'.$scoredata[10].'</td>
            <td class="tg-s6z2">'.$scoredata[11].'</td>
            <td class="tg-s6z2">'.$scoredata[12].'</td>',
'<td class="tg-s6z2">HD中</td>
            <td class="tg-s6z2">'.$scoredata[13].'</td>
            <td class="tg-s6z2">'.$scoredata[14].'</td>
            <td class="tg-s6z2">'.$scoredata[15].'</td>',
'<td class="tg-s6z2">HD晚</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>',
'<td class="tg-s6z2">新早</td>
            <td class="tg-s6z2">'.$scoredata[19].'</td>
            <td class="tg-s6z2">'.$scoredata[20].'</td>
            <td class="tg-s6z2">'.$scoredata[21].'</td>',
'<td class="tg-s6z2">新中</td>
            <td class="tg-s6z2">'.$scoredata[22].'</td>
            <td class="tg-s6z2">'.$scoredata[23].'</td>
            <td class="tg-s6z2">'.$scoredata[24].'</td>',
'<td class="tg-s6z2">新晚</td>
            <td class="tg-s6z2">'.$scoredata[25].'</td>
            <td class="tg-s6z2">'.$scoredata[26].'</td>
            <td class="tg-s6z2">'.$scoredata[27].'</td>',
'<td class="tg-s6z2">影早</td>
            <td class="tg-s6z2">'.$scoredata[28].'</td>
            <td class="tg-s6z2">'.$scoredata[29].'</td>
            <td class="tg-s6z2">'.$scoredata[30].'</td>',
'<td class="tg-s6z2">影中</td>
            <td class="tg-s6z2">'.$scoredata[31].'</td>
            <td class="tg-s6z2">'.$scoredata[32].'</td>
            <td class="tg-s6z2">'.$scoredata[33].'</td>',
'<td class="tg-s6z2">影晚</td>
            <td class="tg-s6z2">'.$scoredata[34].'</td>
            <td class="tg-s6z2">'.$scoredata[35].'</td>
            <td class="tg-s6z2">'.$scoredata[36].'</td>',
'<td class="tg-s6z2">生早</td>
            <td class="tg-s6z2">'.$scoredata[37].'</td>
            <td class="tg-s6z2">'.$scoredata[38].'</td>
            <td class="tg-s6z2">'.$scoredata[39].'</td>',
'<td class="tg-s6z2">生中</td>
            <td class="tg-s6z2">'.$scoredata[40].'</td>
            <td class="tg-s6z2">'.$scoredata[41].'</td>
            <td class="tg-s6z2">'.$scoredata[42].'</td>',
'<td class="tg-s6z2">生晚</td>
            <td class="tg-s6z2">'.$scoredata[43].'</td>
            <td class="tg-s6z2">'.$scoredata[44].'</td>
            <td class="tg-s6z2">'.$scoredata[45].'</td>',
'<td class="tg-s6z2">夜班</td>
            <td class="tg-s6z2">'.$scoredata[46].'</td>
            <td class="tg-s6z2">'.$scoredata[47].'</td>
            <td class="tg-s6z2">'.$scoredata[48].'</td>',
'<td class="tg-s6z2">检修</td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2"></td>
            <td class="tg-s6z2">'.$scoredata[51].'</td>',
'<td class="tg-s6z2">日常</td>
            <td class="tg-s6z2">'.$scoredata[52].'</td>
            <td class="tg-s6z2">'.$scoredata[53].'</td>
            <td class="tg-s6z2">'.$scoredata[54].'</td>',
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

?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 1px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 1px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
.tg .tg-yw4l{text-align:left}
</style>
    <form action="statistic.php" method="post"><input type="submit" style="width:150px; height:50px;font-size:30px;" value="统计">
    <select name="year" style="width:150px; height:50px;font-size:30px;">
        <option value="2015">2015年</option>
        <option value="2016">2016年</option>
        <option value="2017" selected="selected">2017年</option>
        <option value="2018">2018年</option>
    </select>
    <select name="month" style="width:150px; height:50px;font-size:30px;">
        <option value="1">一月</option>
        <option value="2">二月</option>
        <option value="3">三月</option>
        <option value="4">四月</option>
        <option value="5">五月</option>
        <option value="6">六月</option>
        <option value="7">七月</option>
        <option value="8">八月</option>
        <option value="9">九月</option>
        <option value="10">十月</option>
        <option value="11">十一月</option>
        <option value="12">十二月</option>
    </select>
<table class="tg">
<tr>
    <th class="tg-s6z2" colspan="32">班次明细表</th>
</tr>
<tr>
    <td class="tg-s6z2">姓名</td>
    <td class="tg-s6z2">主早</td>
    <td class="tg-s6z2">主中</td>
    <td class="tg-s6z2">主晚</td>
    <td class="tg-s6z2">HD早</td>
    <td class="tg-s6z2">HD中</td>
    <td class="tg-s6z2">HD晚</td>
    <td class="tg-s6z2">新早</td>
    <td class="tg-s6z2">新中</td>
    <td class="tg-s6z2">新晚</td>
    <td class="tg-s6z2">影早</td>
    <td class="tg-s6z2">影中</td>
    <td class="tg-s6z2">影晚</td>
    <td class="tg-s6z2">生早</td>
    <td class="tg-s6z2">生中</td>
    <td class="tg-s6z2">生晚</td>
    <td class="tg-s6z2">夜班</td>
    <td class="tg-s6z2">检修</td>
    <td class="tg-s6z2">补时</td>
    <td class="tg-s6z2">加分</td>
    <td class="tg-s6z2">日常</td>
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
for($i=1;$i<=30;$i++){
    echo '<tr>';
    if($i<=$name_num){
        echo '<td class="tg-s6z2">'.$names[$i].'</td>';
    }
    else{
        echo '<td class="tg-s6z2"></td>';
    }
    for($j=2;$j<=17;$j++){
        echo '<td class="tg-s6z2"></td>';
    }
    for($j=18;$j<=22;$j++){
        if($i<=$name_num){
            $contentidname=($i+10)*100+($j+10);//ID号行列各+10开始
            echo '<td class="tg-s6z2"><input id="'.$contentidname.'" name="'.$contentidname.'" type="text" size="1" value=""></td>';
        }
        else{
            echo '<td class="tg-s6z2"></td>';
        }
    }
    for($j=23;$j<=28;$j++){
        echo '<td class="tg-s6z2"></td>';
    }
    echo $scoredisplay[$i];
    echo '</tr>';
}
?>
<tr>
    <td class="tg-s6z2" rowspan="3">说明</td>
    <td class="tg-yw4l" colspan="31">1、检修：<input id=4112 name=4112 type="text" size="150" value=""></td>
</tr>
<tr>
    <td class="tg-yw4l" colspan="31">2、加分：<input id=4212 name=4212 type="text" size="150" value=""></td>
</tr>
<tr>
    <td class="tg-yw4l" colspan="31">3、其它：<input id=4312 name=4312 type="text" size="150" value=""></td>
</tr>
</table>

<?php
require('footer.php');
?>