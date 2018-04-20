<?php 
require('header.php');
require('functionlib.php');
?>

<?php
mysql_query("truncate rota_bochuke_statistic");//清空表内容，不保存
mysql_query("truncate rota_bochuke_holiday");//清空表内容，不保存

$limitupdatecolnum = array(21, 31, 41, 23, 33, 43, 24, 34, 44, 25, 35, 45, 13);
for($i=1;$i<=$name_num;$i++) {
    for ($j = 0; $j < 13; $j++) {
        $newnamelimitnum = (string)$i . (string)$limitupdatecolnum[$j];
        if (@$_POST["$newnamelimitnum"] == "1") {//检测是否有修改信息送入
            for ($i = 1; $i <= $name_num; $i++) {
                for ($j = 0; $j < 13; $j++) {
                    $newnamelimitnum = (string)$i . (string)$limitupdatecolnum[$j];
                    if (@$_POST["$newnamelimitnum"] == "1") {
                        $namelimitinfo = 1;
                    } else {
                        $namelimitinfo = 0;
                    }
                    $colnum1 = intval($limitupdatecolnum[$j] / 10);//1,2,3,4
                    $colnum2 = $limitupdatecolnum[$j]-$colnum1*10;//A,B,C,D,E
                    $nameinfoupdate = chr(64 + $colnum2) . (string)$colnum1;
                    //echo $names[$i] . $newnamelimitnum . "=" . $namelimitinfo[$newnamelimitnum] . "=" . $nameinfoupdate . '<br>';
                    mysql_query("UPDATE rota_bochuke_nameinfo SET $nameinfoupdate = $namelimitinfo WHERE id = $i");
                }
            }
            break;
        }
    }
}


//读取上周最后一天的排班信息
$lastweekendday=dateidcreate($next_day[1])-1;
mysql_query("INSERT INTO rota_bochuke_statistic (dateid) VALUES ($lastweekendday)");
for($i=1;$i<=$name_num;$i++) {
    $namenuminfo = 'name_' . $i;
    $str = mysql_query("SELECT $namenuminfo FROM rota_bochuke_real_statistic WHERE dateid=$lastweekendday");
    $str = mysql_fetch_array($str);
    if ($str[0] <> "") {
        mysql_query("UPDATE rota_bochuke_statistic SET $namenuminfo = $str[0] WHERE dateid = $lastweekendday");
    }
}


mysql_query("INSERT INTO rota_bochuke_statistic (dateid) VALUES ($weeknum)");
mysql_query("INSERT INTO rota_bochuke_holiday (dateid) VALUES ($weeknum)");
for($i=1;$i<=7;$i++)
{
    $dateid[$i]=dateidcreate($next_day[$i]);
    mysql_query("INSERT INTO rota_bochuke_statistic (dateid) VALUES ($dateid[$i])");
    mysql_query("INSERT INTO rota_bochuke_holiday (dateid) VALUES ($dateid[$i])");
}


?>

<form action="createrota.php" method="post">
<h4>创建第<?php echo $weeknum; ?>周值班表：</h4>
<input type="button" value="个人班次权限设置" onclick="location.href='limit.php'" /><input type="submit" value="创建"><br/><br/>
    休假人员姓名:<input id="11" name="11" type="text" size="8" value="">
    开始于星期<input id="12" name="12" type="text" size="2" value="">
    结束于星期<input id="13" name="13" type="text" size="2" value="">
    <br/>
    休假人员姓名:<input id="21" name="21" type="text" size="8" value="">
    开始于星期<input id="22" name="22" type="text" size="2" value="">
    结束于星期<input id="23" name="23" type="text" size="2" value="">
    <br/>
    休假人员姓名:<input id="31" name="31" type="text" size="8" value="">
    开始于星期<input id="32" name="32" type="text" size="2" value="">
    结束于星期<input id="33" name="33" type="text" size="2" value="">
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
    <!--<th>备用1</th>
        <th>备用2</th>
        <th>备用3</th>
        <th>备用4</th>-->
    </tr>
        <?php
        $xingqihanzi=array("","一","二","三","四","五","六","日");
        for($formnum=1;$formnum<=7;$formnum++){
            echo '<tr>';
            echo '<td align="center" rowspan="4">'.$next_day[$formnum].'<br>'."星期".$xingqihanzi[$formnum].'</td>';
            echo '<td align="center">夜班</td>';
            echo '<td align="center"></td>';
            echo '<td align="center"><input id="'.($formnum*100+12).'" name="'.($formnum*100+12).'" type="text" size="14" value=""></td>';
            echo '<td align="center"><input id="'.($formnum*100+13).'" name="'.($formnum*100+13).'" type="text" size="14" value=""></td>';
            echo '<td align="center"></td>';
            echo '<td align="center"></td>';
            if($formnum*4-3<=$name_num){
                echo '<td align="center"><input type="button" id="'.$names[$formnum*4-3].'" value="'. $names[$formnum*4-3].'"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            }
           // echo '</tr>';

            echo '<tr>';
            echo '<td align="center">早班</td>';
            echo '<td align="center"><input id="'.($formnum*100+21).'" name="'.($formnum*100+21).'" type="text" size="14" value=""></td>';
            echo '<td align="center"></td>';
            echo '<td align="center"><input id="'.($formnum*100+23).'" name="'.($formnum*100+23).'" type="text" size="14" value=""></td>';
            echo '<td align="center"><input id="'.($formnum*100+24).'" name="'.($formnum*100+24).'" type="text" size="14" value=""></td>';
            echo '<td align="center"><input id="'.($formnum*100+25).'" name="'.($formnum*100+25).'" type="text" size="14" value=""></td>';
            if($formnum*4-3<=$name_num){
                echo '<td align="center"><input type="button" id="'.$names[$formnum*4-2].'" value="'. $names[$formnum*4-2].'"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            }
            //echo '</tr>';

            echo '<tr>';
            echo '<td align="center">中班</td>';
            echo '<td align="center"><input id="'.($formnum*100+31).'" name="'.($formnum*100+31).'" type="text" size="14" value=""></td>';
            echo '<td align="center"></td>';
            echo '<td align="center"><input id="'.($formnum*100+33).'" name="'.($formnum*100+33).'" type="text" size="14" value=""></td>';
            echo '<td align="center"><input id="'.($formnum*100+34).'" name="'.($formnum*100+34).'" type="text" size="14" value=""></td>';
            echo '<td align="center"><input id="'.($formnum*100+35).'" name="'.($formnum*100+35).'" type="text" size="14" value=""></td>';
            if($formnum*4-3<=$name_num){
                echo '<td align="center"><input type="button" id="'.$names[$formnum*4-1].'" value="'. $names[$formnum*4-1].'"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            }
            //echo '</tr>';

            echo '<tr>';
            echo '<td align="center">晚班</td>';
            echo '<td align="center"><input id="'.($formnum*100+41).'" name="'.($formnum*100+41).'" type="text" size="14" value=""></td>';
            echo '<td align="center"></td>';
            echo '<td align="center"><input id="'.($formnum*100+43).'" name="'.($formnum*100+43).'" type="text" size="14" value=""></td>';
            echo '<td align="center"><input id="'.($formnum*100+44).'" name="'.($formnum*100+44).'" type="text" size="14" value=""></td>';
            echo '<td align="center"><input id="'.($formnum*100+45).'" name="'.($formnum*100+45).'" type="text" size="14" value=""></td>';
            if($formnum*4-3<=$name_num){
                echo '<td align="center"><input type="button" id="'.$names[$formnum*4].'" value="'. $names[$formnum*4].'"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            }
            //echo '</tr>';
        }
        ?>
    </table>
<?php
require('footer.php');
?>