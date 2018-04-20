<?php 
require('header.php');
require('functionlib.php');
?>

<?php
//主程序
$name_numbers4times = range(5,$name_num);

//读取休假信息
$vacationnamenum=0;
for($i=1;$i<=3;$i++){
    $hoildayname=(string)$i.'1';
    $hoildaystartnum=(string)$i.'2';
    $hoildayfinishnum=(string)$i.'3';
    if(!(@$_POST["$hoildayname"]=='')){
        for ($name_preinsert=1;$name_preinsert<=$name_num;$name_preinsert++){
            $nameinfo_preinsert=$_POST["$hoildayname"];
            //echo $hoildayname.":".$name_preinsert."<br>";
            if ($nameinfo_preinsert==$names[$name_preinsert]){
                $vacationname[$vacationnamenum]=$name_preinsert;
                $vacationnamenum++;
                $dateid_preinsertstart=dateidcreate($next_day[1])+$_POST["$hoildaystartnum"]-1;
                if(!@($_POST["$hoildayfinishnum"]=='')){
                    $dateid_preinsertfinish=dateidcreate($next_day[1])+$_POST["$hoildayfinishnum"]-1;
                }
                else{
                    $dateid_preinsertfinish=$dateid_preinsertstart;
                }
                $namenuminfo='name_'.$name_preinsert;
                for($k=$dateid_preinsertstart;$k<=$dateid_preinsertfinish;$k++){
                    mysql_query("UPDATE rota_bochuke_holiday SET $namenuminfo = 1 WHERE dateid = $k");
                }
            }
        }
    }
}
//print_r($vacationname);echo "<br>";

//生成随机名单列表
$name_numbers = range(1,$name_num);
shuffle($name_numbers);//随机打乱$name_number[]
if($vacationnamenum>0){
    for($i=0;$i<$vacationnamenum;$i++){
        for($j=0;$j<$name_num;$j++){
            if($name_numbers[$j]==$vacationname[$i]){
                $change=$name_numbers[$i];
                $name_numbers[$i]=$name_numbers[$j];
                $name_numbers[$j]=$change;
            }
        }
    }
}
//print_r($name_numbers);

//从读取预排表文字信息，存入数据库
for($i=1;$i<=7;$i++)
{
    for ($j = 0; $j < 16; $j++) {
        $displaynum=(string)$i.(string)$rotarowandcol[$j];//输出数组建立
            //echo $displaynum."=".@$_POST["$displaynum"]."<br>";
            if(!(@$_POST["$displaynum"]=='')){    
                for ($name_preinsert=1;$name_preinsert<=$name_num;$name_preinsert++){
                    $nameinfo_preinsert=$_POST["$displaynum"];
                    //echo $displaynum.":".$name_preinsert."<br>";
                    if ($nameinfo_preinsert==$names[$name_preinsert]){
                        $dateid_preinsert=dateidcreate($next_day[1])+$i-1;
                        $namenuminfo='name_'.$name_preinsert;
                        //if($j==14 or $j==15){
                        //    mysql_query("UPDATE rota_bochuke_holiday SET $namenuminfo = 1 WHERE dateid = $dateid_preinsert");
                        //}
                        //else {
                            $rotainfo_preinsert = (string)$rotarowandcol[$j];
                            mysql_query("UPDATE rota_bochuke_statistic SET $namenuminfo = $rotainfo_preinsert WHERE dateid = $dateid_preinsert");
                        //}
                    }
                }
            }
        }
}


//第一次排布
$countname=0;
$bugstation=0;
for ($i = 1; $i <= 7; $i++) {
    $dateid[$i] = dateidcreate($next_day[$i]);
    for ($j = 0; $j < 13; $j++) {
        if($countname<$name_num) {
            if(rotanumjudgment($i,$j)==0){
                //echo $i.$rotarowandcol[$j]."COUNT".$countname."<".$name_num."<br>";
                $flag=createrota($i,$j,$countname,1);
                //echo $i.$rotarowandcol[$j].":".$flag."<br>";
                if($flag){
                    $bugnum1[$bugstation]=$i.$rotarowandcol[$j];
                    $bugstation++;
                }
            }
        }
    }
}
//if($bugstation>0){
//    echo "bugnum1";print_r($bugnum1);echo "<br>";
//}


//第二次排布
$countname=0;
$bugstation=0;
for ($i = 1; $i <= 7; $i++) {
        $dateid[$i] = dateidcreate($next_day[$i]);
        for ($j = 0; $j < 13; $j++) {
            if($countname<$name_num) {
                if(rotanumjudgment($i,$j)==0){
                    //echo $i.$rotarowandcol[$j]."COUNT".$countname."<".$name_num."<br>";
                    $flag=createrota($i,$j,$countname,2);
                    //echo $i.$rotarowandcol[$j].":".$flag."<br>";
                    if($flag){
                        $bugnum2[$bugstation]=$i.$rotarowandcol[$j];
                        $bugstation++;
                    }
                }
            }
        }
}
//if($bugstation>0){
//    echo "bugnum2";print_r($bugnum2);echo "<br>";
//}


//第三次排布
$countname=0;
$bugstation=0;
for ($i = 1; $i <= 7; $i++) {
    $dateid[$i] = dateidcreate($next_day[$i]);
    for ($j = 0; $j < 13; $j++) {
        if($countname<$name_num) {
            if(rotanumjudgment($i,$j)==0){
                //echo $i.$rotarowandcol[$j]."COUNT".$countname."<".$name_num."<br>";
                $flag=createrota($i,$j,$countname,3);
                //echo $i.$rotarowandcol[$j].":".$flag."<br>";
                if($flag){
                    $bugnum3[$bugstation]=$i.$rotarowandcol[$j];
                    $bugstation++;
                }
            }
        }
    }
}
//if($bugstation>0){
//    echo "bugnum3";print_r($bugnum3);echo "<br>";
//}


//第四次排布
$countname=0;
$bugstation=0;
//do{
for ($i = 1; $i <= 7; $i++) {
    $dateid[$i] = dateidcreate($next_day[$i]);
    for ($j = 0; $j < 13; $j++) {
        if($countname<$name_num) {
            if(rotanumjudgment($i,$j)==0){
                //echo $i.$rotarowandcol[$j]."COUNT".$countname."<".$name_num."<br>";
                $flag=createrota($i,$j,$countname,4);
                //echo $i.$rotarowandcol[$j].":".$flag."<br>";
                if($flag){
                    $bugnum4[$bugstation]=$i.$rotarowandcol[$j];
                    $bugstation++;
                }
            }
        }
    }
}
//}while($bugstation>0);
if($bugstation>0){
echo "存在没有排满的班次！<br>";
    //echo "bugnum4";
    print_r($bugnum4);echo "<br>";
}

/*
//第五次排布
$countname=0;
$bugstation=0;
for ($i = 1; $i <= 7; $i++) {
    $dateid[$i] = dateidcreate($next_day[$i]);
    for ($j = 0; $j < 13; $j++) {
        if($countname<$name_num) {
            if(rotanumjudgment($i,$j)==0){
                //echo $i.$rotarowandcol[$j]."COUNT".$countname."<".$name_num."<br>";
                $flag=createrota($i,$j,$countname,5);
                //echo $i.$rotarowandcol[$j].":".$flag."<br>";
                if($flag){
                    $bugnum5[$bugstation]=$i.$rotarowandcol[$j];
                    $bugstation++;
                }
            }
        }
    }
}
if($bugstation>0){
    echo "存在没有排满的班次！<br>";
    //echo "bugnum5";
    print_r($bugnum5);echo "<br>";
}


//第六次排布
$countname=0;
$bugstation=0;
for ($i = 1; $i <= 7; $i++) {
    $dateid[$i] = dateidcreate($next_day[$i]);
    for ($j = 0; $j < 13; $j++) {
        if($countname<$name_num) {
            if(rotanumjudgment($i,$j)==0){
                //echo $i.$rotarowandcol[$j]."COUNT".$countname."<".$name_num."<br>";
                $flag=createrota($i,$j,$countname,6);
                //echo $i.$rotarowandcol[$j].":".$flag."<br>";
                if($flag){
                    $bugnum6[$bugstation]=$i.$rotarowandcol[$j];
                    $bugstation++;
                }
            }
        }
    }
}
echo "bugnum6";print_r($bugnum6);echo "<br>";

*/

$read_startdateid=dateidcreate($next_day[1]);
$read_finishdateid=$read_startdateid+6;
readfromsqltoform("rota_bochuke_statistic",$read_startdateid,$read_finishdateid);

?>

<h4>生成第<?php echo $weeknum; ?>周值班表：</h4>
<form action="confirmnewrota.php" method="post">
<input type="button" value="重新生成" onclick="location.href='index.php'" /><input type="submit" value="确认生成">
    <table border="1">
        <tr>
            <th>日期</th>
            <th>班次</th>
            <th>值班长岗</th>
            <th>月检修</th>
            <th>新闻/教科</th>
            <th>娱乐/影视/少儿</th>
            <th>信息/十八/生活</th>
            <th>快捷录入</th>
            <th>早班</th>
            <th>中班</th>
            <th>晚班</th>
            <th>夜班</th>
            <th>总班</th>
        </tr>
        <?php
        $xingqihanzi=array("","一","二","三","四","五","六","日");
        for($formnum=1;$formnum<=7;$formnum++){
            echo '<tr>';
            echo '<td align="center" rowspan="4">'.$next_day[$formnum].'<br>'."星期".$xingqihanzi[$formnum].'</td>';
            echo '<td align="center">夜班</td>';
            echo '<td align="center"></td>';
            echo '<td align="center"><input id="'.($formnum*100+12).'" name="'.($formnum*100+12).'" type="text" size="14" value="'.$namedisplay[$formnum*100+12].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+13).'" name="'.($formnum*100+13).'" type="text" size="14" value="'.$namedisplay[$formnum*100+13].'"></td>';
            echo '<td align="center"></td>';
            echo '<td align="center"></td>';
            if($formnum*4-3<=$name_num){
                echo '<td align="center"><input type="button" id="'.$names[$formnum*4-3].'" value="'. $names[$formnum*4-3].'"></td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-3)*10+2].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-3)*10+3].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-3)*10+4].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-3)*10+1].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-3)*10+5].'</td>';
            }
            echo '</tr>';

            echo '<tr>';
            echo '<td align="center">早班</td>';
            echo '<td align="center"><input id="'.($formnum*100+21).'" name="'.($formnum*100+21).'" type="text" size="14" value="'.$namedisplay[$formnum*100+21].'"></td>';
            echo '<td align="center"></td>';
            echo '<td align="center"><input id="'.($formnum*100+23).'" name="'.($formnum*100+23).'" type="text" size="14" value="'.$namedisplay[$formnum*100+23].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+24).'" name="'.($formnum*100+24).'" type="text" size="14" value="'.$namedisplay[$formnum*100+24].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+25).'" name="'.($formnum*100+25).'" type="text" size="14" value="'.$namedisplay[$formnum*100+25].'"></td>';
            if($formnum*4-3<=$name_num){
                echo '<td align="center"><input type="button" id="'.$names[$formnum*4-2].'" value="'. $names[$formnum*4-2].'"></td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-2)*10+2].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-2)*10+3].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-2)*10+4].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-2)*10+1].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-2)*10+5].'</td>';
            }
            echo '</tr>';

            echo '<tr>';
            echo '<td align="center">中班</td>';
            echo '<td align="center"><input id="'.($formnum*100+31).'" name="'.($formnum*100+31).'" type="text" size="14" value="'.$namedisplay[$formnum*100+31].'"></td>';
            echo '<td align="center"></td>';
            echo '<td align="center"><input id="'.($formnum*100+33).'" name="'.($formnum*100+33).'" type="text" size="14" value="'.$namedisplay[$formnum*100+33].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+34).'" name="'.($formnum*100+34).'" type="text" size="14" value="'.$namedisplay[$formnum*100+34].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+35).'" name="'.($formnum*100+35).'" type="text" size="14" value="'.$namedisplay[$formnum*100+35].'"></td>';
            if($formnum*4-3<=$name_num){
                echo '<td align="center"><input type="button" id="'.$names[$formnum*4-1].'" value="'. $names[$formnum*4-1].'"></td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-1)*10+2].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-1)*10+3].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-1)*10+4].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-1)*10+1].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4-1)*10+5].'</td>';
            }
            echo '</tr>';

            echo '<tr>';
            echo '<td align="center">晚班</td>';
            echo '<td align="center"><input id="'.($formnum*100+41).'" name="'.($formnum*100+41).'" type="text" size="14" value="'.$namedisplay[$formnum*100+41].'"></td>';
            echo '<td align="center"></td>';
            echo '<td align="center"><input id="'.($formnum*100+43).'" name="'.($formnum*100+43).'" type="text" size="14" value="'.$namedisplay[$formnum*100+43].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+44).'" name="'.($formnum*100+44).'" type="text" size="14" value="'.$namedisplay[$formnum*100+44].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+45).'" name="'.($formnum*100+45).'" type="text" size="14" value="'.$namedisplay[$formnum*100+45].'"></td>';
            if($formnum*4-3<=$name_num){
                echo '<td align="center"><input type="button" id="'.$names[$formnum*4].'" value="'. $names[$formnum*4].'"></td>';
                echo '<td align="center">'.$rotabackview[($formnum*4)*10+2].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4)*10+3].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4)*10+4].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4)*10+1].'</td>';
                echo '<td align="center">'.$rotabackview[($formnum*4)*10+5].'</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>

<?php
require('footer.php');
?>