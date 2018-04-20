<?php 
require('header.php');
require('functionlib.php');
?>

<?php
$recordyear=$_POST["year"];
$recordmonth=$_POST["month"];
$recordday=$_POST["day"];
$recorddate=$recordyear.'-'.$recordmonth.'-'.$recordday;
$first=1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期
$w=date('w',strtotime($recorddate));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
$record_start=date('Y-m-d',strtotime("$recorddate -".($w ? $w - $first : 6).'days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
$record_day=array();
$record_day[1] =$record_start;
$record_day[2] =date('Y-m-d',strtotime("$record_start +1 days"));
$record_day[3] =date('Y-m-d',strtotime("$record_start +2 days"));
$record_day[4] =date('Y-m-d',strtotime("$record_start +3 days"));
$record_day[5] =date('Y-m-d',strtotime("$record_start +4 days"));
$record_day[6] =date('Y-m-d',strtotime("$record_start +5 days"));
$record_day[7] =date('Y-m-d',strtotime("$record_start +6 days"));
$recordweeknum=date('W',strtotime($record_day[1]))+1;
$read_startdateid=dateidcreate($record_day[1]);
$read_finishdateid=$read_startdateid+6;
readfromsqltoform("rota_bochuke_real_statistic",$read_startdateid,$read_finishdateid);
?>

<script>
</script>

<h4>修改<?php echo $recordyear; ?>年第<?php echo $recordweeknum; ?>周值班表：</h4>
<form action="confirmrecord.php" method="post">
    <input type="submit" value="确认修改">
    <table border="1">
    <tr>
        <th>日期</th>
        <th>班次</th>
        <th>值班长岗</th>
        <th>月检修</th>
        <th>新闻/教科</th>
        <th>娱乐/影视/少儿</th>
        <th>信息/十八/生活</th>
        <!--<th>快捷录入</th>
        <th>备用1</th>
        <th>备用2</th>
        <th>备用3</th>
        <th>备用4</th>-->
    </tr>
        <?php
        for($formnum=1;$formnum<=7;$formnum++){
            //$checkflag="";
            //if($formnum=6 or $formnum=7){
            //    $checkflag="checked";
            //}
            echo '<tr>';
            echo '<td align="center" rowspan="4"><input type="checkbox" name="hoilday[]" value="'.$formnum.'"/><br>'.$record_day[$formnum].'<br>'."星期".$xingqihanzi[$formnum].'</td>';
            echo '<td align="center">夜班</td>';
            echo '<td align="center">/\/\/\/\/\/\/\/\</td>';
            echo '<td align="center">/\/\/\</td>';
            echo '<td align="center"><input id="'.($formnum*100+13).'" name="'.($formnum*100+13).'" type="text" size="14" value="'.$namedisplay[$formnum*100+13].'"></td>';
            echo '<td align="center">/\/\/\/\/\/\/\/\</td>';
            echo '<td align="center">/\/\/\/\/\/\/\/\</td>';
            //if($formnum*4-3<=$name_num){
            //    echo '<td align="center">'.$names[$formnum*4-3].'</td>';
            //}
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            // echo '</tr>';

            echo '<tr>';
            echo '<td align="center">早班</td>';
            echo '<td align="center"><input id="'.($formnum*100+21).'" name="'.($formnum*100+21).'" type="text" size="14" value="'.$namedisplay[$formnum*100+21].'"></td>';
            echo '<td align="center">/\/\/\</td>';
            echo '<td align="center"><input id="'.($formnum*100+23).'" name="'.($formnum*100+23).'" type="text" size="14" value="'.$namedisplay[$formnum*100+23].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+24).'" name="'.($formnum*100+24).'" type="text" size="14" value="'.$namedisplay[$formnum*100+24].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+25).'" name="'.($formnum*100+25).'" type="text" size="14" value="'.$namedisplay[$formnum*100+25].'"></td>';
            //if($formnum*4-3<=$name_num){
            //   echo '<td align="center">'.$names[$formnum*4-2].'</td>';
            //}
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '</tr>';

            echo '<tr>';
            echo '<td align="center">中班</td>';
            echo '<td align="center"><input id="'.($formnum*100+31).'" name="'.($formnum*100+31).'" type="text" size="14" value="'.$namedisplay[$formnum*100+31].'"></td>';
            echo '<td align="center">/\/\/\</td>';
            echo '<td align="center"><input id="'.($formnum*100+33).'" name="'.($formnum*100+33).'" type="text" size="14" value="'.$namedisplay[$formnum*100+33].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+34).'" name="'.($formnum*100+34).'" type="text" size="14" value="'.$namedisplay[$formnum*100+34].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+35).'" name="'.($formnum*100+35).'" type="text" size="14" value="'.$namedisplay[$formnum*100+35].'"></td>';
            //if($formnum*4-3<=$name_num){
            //    echo '<td align="center">'.$names[$formnum*4-1].'</td>';
            //}
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '</tr>';

            echo '<tr>';
            echo '<td align="center">晚班</td>';
            echo '<td align="center"><input id="'.($formnum*100+41).'" name="'.($formnum*100+41).'" type="text" size="14" value="'.$namedisplay[$formnum*100+41].'"></td>';
            echo '<td align="center"><input type="checkbox" name="jianxiu[]" value="'.$formnum.'"/></td>';
            echo '<td align="center"><input id="'.($formnum*100+43).'" name="'.($formnum*100+43).'" type="text" size="14" value="'.$namedisplay[$formnum*100+43].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+44).'" name="'.($formnum*100+44).'" type="text" size="14" value="'.$namedisplay[$formnum*100+44].'"></td>';
            echo '<td align="center"><input id="'.($formnum*100+45).'" name="'.($formnum*100+45).'" type="text" size="14" value="'.$namedisplay[$formnum*100+45].'"></td>';
            //if($formnum*4-3<=$name_num){
            //    echo '<td align="center">'.$names[$formnum*4].'</td>';
            //}
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '<td align="center"></td>';
            //echo '</tr>';
        }
        ?>
    </table>
    <?php echo '开始于<input id="recordstart" name="recordstart" type="text" size="7" value="'.$record_start.'"><br/>';?>
<?php
require('footer.php');
?>

