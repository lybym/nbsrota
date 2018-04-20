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



$d1=mktime(0, 0, 0, $_POST["month"], 1, $_POST["year"]);//月初第一天
$SearchStartDay=date("Y-m-d", $d1);
$d2=mktime(0, 0, 0, $_POST["month"]+1, 1, $_POST["year"])-1;//月+1第一天减一秒
$SearchFinishDay=date("Y-m-d", $d2);
//echo $SearchStartDay.'='.$SearchFinishDay."<br>";
$SearchStartDay=dateidcreate($SearchStartDay);
$SearchFinishDay=dateidcreate($SearchFinishDay);

/*
if(sqldateidjudgment("rota_bochuke_tongji_comments","dateid",$SearchStartDay)){
   mysqli_query($con,"INSERT INTO rota_bochuke_tongji_comments (dateid) VALUES ($SearchStartDay)");
}
*/

for($i=28;$i<=32;$i++){//检修28、补时29、加分30、日常31、假日32
    $dateidcontent=$SearchStartDay*100+$i;
    if(sqldateidjudgment("rota_bochuke_tongji","dateid",$dateidcontent)){
        mysqli_query($con,"INSERT INTO rota_bochuke_tongji (dateid) VALUES ($dateidcontent)");
    }
}


for ($i = 1; $i <= $name_num; $i++) {
    for($j=28;$j<=32;$j++){
        $namenuminfo = 'name_' . $i;
        $rotainfo=($i+10)*100+$j;
        $content = $_POST["$rotainfo"];
        $dateidcontent=$SearchStartDay.$j;
        mysqli_query($con,"UPDATE rota_bochuke_tongji SET $namenuminfo = $content WHERE dateid = $dateidcontent");
    }
}

/*
for($i=41;$i<=43;$i++){
    $rotainfo=$i*100+12;
    $content = $_POST["$rotainfo"];
    $rowcontent='comment_'.$rotainfo;
    if($content<>""){
        mysqli_query($con,"UPDATE rota_bochuke_tongji_comments SET $rowcontent = '$content' WHERE dateid = $SearchStartDay");
    }
}
*/

//echo $SearchStartDay.'='.$SearchFinishDay."<br>";
//从数据库读取信息转化成排班表
for($i=$SearchStartDay;$i<=$SearchFinishDay;$i++){
    //echo dateidtoweeknumber($i)."<br>";
    for($j=1;$j<=$name_num;$j++){
        $namenuminfo='name_'.$j;
        $str=mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_real_statistic WHERE dateid=$i");
        $str=mysqli_fetch_array($str);
        if($str[0]<>""){
            switch ((int)substr($str[0],0,2)) {
                //case 12:
                    //$statisticdata[$j][18]=$statisticdata[$j][18]+1;
                    //break;
                case 13:
                    $statisticdata[$j][17]=$statisticdata[$j][17]+1;
                    break;
                case 21:
                    if(dateidtoweeknumber($i)%2==1){
                        $statisticdata[$j][5]=$statisticdata[$j][5]+1;
                    }
                    else{
                        $statisticdata[$j][2]=$statisticdata[$j][2]+1;
                    }
                    break;
                case 23:
                    $statisticdata[$j][8]=$statisticdata[$j][8]+1;
                    break;
                case 24:
                    $statisticdata[$j][11]=$statisticdata[$j][11]+1;
                    break;
                case 25:
                    $statisticdata[$j][14]=$statisticdata[$j][14]+1;
                    break;
                case 31:
                    if(dateidtoweeknumber($i)%2==1){
                        $statisticdata[$j][6]=$statisticdata[$j][6]+1;
                    }
                    else{
                        $statisticdata[$j][3]=$statisticdata[$j][3]+1;
                    }
                    break;
                case 33:
                    $statisticdata[$j][9]=$statisticdata[$j][9]+1;
                    break;
                case 34:
                    $statisticdata[$j][12]=$statisticdata[$j][12]+1;
                    break;
                case 35:
                    $statisticdata[$j][15]=$statisticdata[$j][15]+1;
                    break;
                case 41:
                    $statisticdata[$j][4]=$statisticdata[$j][4]+1;
                    break;
                case 43:
                    $statisticdata[$j][10]=$statisticdata[$j][10]+1;
                    break;
                case 44:
                    $statisticdata[$j][13]=$statisticdata[$j][13]+1;
                    break;
                case 45:
                    $statisticdata[$j][16]=$statisticdata[$j][16]+1;
                    break;
                /*echo $str[0]."=".$displaynum."<br>";*/
            }
            if((string)substr($str[0],2,1)=='0'){
                switch ((int)substr($str[0],3,2)) {
                //case 12:
                    //$statisticdata[$j][18]=$statisticdata[$j][18]+1;
                    //break;
                case 13:
                    $statisticdata[$j][17]=$statisticdata[$j][17]+1;
                    break;
                case 21:
                    if(dateidtoweeknumber($i)%2==1){
                        $statisticdata[$j][5]=$statisticdata[$j][5]+1;
                    }
                    else{
                        $statisticdata[$j][2]=$statisticdata[$j][2]+1;
                    }
                    break;
                case 23:
                    $statisticdata[$j][8]=$statisticdata[$j][8]+1;
                    break;
                case 24:
                    $statisticdata[$j][11]=$statisticdata[$j][11]+1;
                    break;
                case 25:
                    $statisticdata[$j][14]=$statisticdata[$j][14]+1;
                    break;
                case 31:
                    if(dateidtoweeknumber($i)%2==1){
                        $statisticdata[$j][6]=$statisticdata[$j][6]+1;
                    }
                    else{
                        $statisticdata[$j][3]=$statisticdata[$j][3]+1;
                    }
                    break;
                case 33:
                    $statisticdata[$j][9]=$statisticdata[$j][9]+1;
                    break;
                case 34:
                    $statisticdata[$j][12]=$statisticdata[$j][12]+1;
                    break;
                case 35:
                    $statisticdata[$j][15]=$statisticdata[$j][15]+1;
                    break;
                case 41:
                    $statisticdata[$j][4]=$statisticdata[$j][4]+1;
                    break;
                case 43:
                    $statisticdata[$j][10]=$statisticdata[$j][10]+1;
                    break;
                case 44:
                    $statisticdata[$j][13]=$statisticdata[$j][13]+1;
                    break;
                case 45:
                    $statisticdata[$j][16]=$statisticdata[$j][16]+1;
                    break;
                /*echo $str[0]."=".$displaynum."<br>";*/
            }
            }
        }
    }
}

//从数据库读检修、补时、加分、日常、假日
for($i=18;$i<=22;$i++){
    $dateidcontent=$SearchStartDay*100+$i+10;
    for($j=1;$j<=$name_num;$j++){
        $namenuminfo='name_'.$j;
        $str=mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_tongji WHERE dateid=$dateidcontent");
        if (!$str) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
            }
        $str=mysqli_fetch_array($str);
        if($str[0]<>""){
            $statisticdata[$j][$i]=$str[0];
        }
    }
}

/*
for($i=31;$i<=33;$i++){
    $namenuminfo=($i+10)*100+12;
    $namenuminfo='comment_'.$namenuminfo;
    $str=mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_tongji_comments WHERE dateid=$SearchStartDay");
    $str=mysqli_fetch_array($str);
    if($str[0]<>""){
        $statisticdata[$i][2]=$str[0];
    }
}
*/



for($i=1;$i<=$name_num;$i++){
$statisticdata[$i][23]=$statisticdata[$i][2]+$statisticdata[$i][5]+$statisticdata[$i][8]+$statisticdata[$i][11]+$statisticdata[$i][14];//早班数
$statisticdata[$i][24]=$statisticdata[$i][3]+$statisticdata[$i][6]+$statisticdata[$i][9]+$statisticdata[$i][12]+$statisticdata[$i][15];//中班数
$statisticdata[$i][25]=$statisticdata[$i][4]+$statisticdata[$i][10]+$statisticdata[$i][13]+$statisticdata[$i][16];//晚班数
$statisticdata[$i][26]=$statisticdata[$i][23]+$statisticdata[$i][24]+$statisticdata[$i][25]+$statisticdata[$i][17];//总班数=早+中+晚+夜

for($j=2;$j<=17;$j++){
$statisticdata[$i][27]=$statisticdata[$i][27]+$statisticdata[$i][$j]*$scoredata[2+3*($j-2)]*$scoredata[3+3*($j-2)];//早中晚夜工作量
$statisticdata[$i][28]=$statisticdata[$i][28]+$statisticdata[$i][$j]*$scoredata[1+3*($j-2)];//早中晚夜量化分
}
$statisticdata[$i][27]=$statisticdata[$i][27]+$statisticdata[$i][19]+$statisticdata[$i][21]*$scoredata[53]*$scoredata[54];//补时+日常->工作量
$statisticdata[$i][28]=$statisticdata[$i][28]+$statisticdata[$i][20]+$statisticdata[$i][21]*$scoredata[52];//加分+日常->量化分
}



for($i=1;$i<=$name_num;$i++){
    for($j=2;$j<=28;$j++){
        $statisticdata[30][$j]=$statisticdata[30][$j]+$statisticdata[$i][$j];
    }
}



?>

<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 1px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:0px 1px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-s6z2{text-align:center}
    .tg .tg-yw4l{text-align:left}
</style>

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
        for($j=2;$j<=28;$j++){
            if($statisticdata[$i][$j]==0){
                $statisticdata[$i][$j]='';
            }
            echo '<td class="tg-s6z2">'.$statisticdata[$i][$j].'</td>';
        }
        echo $scoredisplay[$i];
        echo '</tr>';
    }
    ?>
    <tr>
        <td class="tg-s6z2" rowspan="3">说明</td>
        <td class="tg-yw4l" colspan="31">1、检修：<?php echo $statisticdata[31][2] ?></td>
    </tr>
    <tr>
        <td class="tg-yw4l" colspan="31">2、加分：<?php echo $statisticdata[32][2] ?></td>
    </tr>
    <tr>
        <td class="tg-yw4l" colspan="31">3、其它：<?php echo $statisticdata[33][2] ?></td>
    </tr>
</table>
</form>
</body>
</html>