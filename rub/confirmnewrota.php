<?php 
require('header.php');
require('functionlib.php');


mysql_query("INSERT INTO rota_bochuke_real_statistic (dateid) VALUES ($weeknum)");
for($i=1;$i<=7;$i++)
{
    $dateid[$i]=dateidcreate($next_day[$i]);
    mysql_query("INSERT INTO rota_bochuke_real_statistic (dateid) VALUES ($dateid[$i])");
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
                        $dateid_preinsert=dateidcreate($next_day[1])+$i-1;
                        $namenuminfo='name_'.$name_preinsert;
                        $rotainfo_preinsert=(string)$j.(string)$k;
                        mysql_query("UPDATE rota_bochuke_real_statistic SET $namenuminfo = $rotainfo_preinsert WHERE dateid = $dateid_preinsert");
                    }
                }
            }   
        }
    }    
}

$read_startdateid=dateidcreate($next_day[1]);
$read_finishdateid=$read_startdateid+6;
readfromsqltoform("rota_bochuke_real_statistic",$read_startdateid,$read_finishdateid);
?>

<h4>电视播出部播出科值班表</h4>
<h4><?php echo date("Y"); ?>年 第<?php echo $weeknum; ?>周</h4>
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
        echo '<td align="center" rowspan="4">'.$next_day[$formnum].'<br>'."星期".$xingqihanzi[$formnum].'</td>';
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