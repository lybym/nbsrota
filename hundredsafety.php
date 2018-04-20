<?php
require('header.php');
require('functionlib.php');
?>
<h2>百班统计</h2>

<?php



$SearchStartDay=mktime(0, 0, 0, 1, 1, $_POST["year"]);//年初第一天
$SearchStartDay=date("Y-m-d", $SearchStartDay);
$SearchStartDateid=dateidcreate($SearchStartDay);
$SearchEndDay=mktime(0, 0, 0, $_POST["month"]+1, 1, $_POST["year"])-1;//月+1第一天减一秒
$SearchEndDay=date("Y-m-d", $SearchEndDay);
$SearchEndDateid=dateidcreate($SearchEndDay);

$names=Names($SearchStartDateid);
$name_num=count($names);
for($i=0;$i<$name_num;$i++){
    for($j=1;$j<=24;$j++){
        $hundredsafetydata[$i][$j]="";//初始化$hundredsafetydata[$i][$j]
    }
}

for($i=0;$i<$name_num;$i++){
    $SegArrayOfMonth=SegDateidOfMonth($SearchStartDateid,$SearchEndDateid);
    for($j=0;$j<count($SegArrayOfMonth);){
        $d1=$SegArrayOfMonth[$j];
        $j++;
        $d2=$SegArrayOfMonth[$j];
        $j++;
        $hundredsafetydata[$i][12+$j/2]=SearchRotaTimes($d1,$d2,$i+1);//names[]下标从0开始，所以需要$i+1
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
    <th class="tg-s6z2" rowspan="3">姓名</th>
    <th class="tg-s6z2" rowspan="3">去年<br>转入<br>班数</th>
    <th class="tg-s6z2" colspan="5"><?php echo $_POST["year"] ?>年度</th>
    <th class="tg-s6z2" rowspan="3">转入<br>明年<br>班数</th>
    <th class="tg-s6z2" colspan="3" rowspan="2">当前连续记录</th>
    <th class="tg-s6z2" colspan="2" rowspan="2">历史连续记录</th>
    <th class="tg-s6z2" colspan="12" rowspan="2">各月无事故班数</th>
  </tr>
  <tr>
    <td class="tg-s6z2" colspan="5">百班无事故轮次</td>
  </tr>
  <tr>
    <td class="tg-s6z2">连续</td>
    <td class="tg-s6z2">历史</td>
    <td class="tg-s6z2">全部</td>
    <td class="tg-s6z2">已奖</td>
    <td class="tg-s6z2">未奖</td>
    <td class="tg-s6z2" colspan="2">无事故时间段</td>
    <td class="tg-s6z2">班数</td>
    <td class="tg-s6z2">事故时间</td>
    <td class="tg-s6z2">班数</td>
    <td class="tg-s6z2">1月</td>
    <td class="tg-s6z2">2月</td>
    <td class="tg-s6z2">3月</td>
    <td class="tg-s6z2">4月</td>
    <td class="tg-s6z2">5月</td>
    <td class="tg-s6z2">6月</td>
    <td class="tg-s6z2">7月</td>
    <td class="tg-s6z2">8月</td>
    <td class="tg-s6z2">9月</td>
    <td class="tg-s6z2">10月</td>
    <td class="tg-s6z2">11月</td>
    <td class="tg-s6z2">12月</td>
  </tr>
<?php
for($i=0;$i<$name_num;$i++){
    echo '<tr>';
    echo '<td class="tg-s6z2">'.$names[$i].'</td>';
    for($j=1;$j<=24;$j++){
        echo '<td class="tg-s6z2">'.$hundredsafetydata[$i][$j].'</td>';
    }
    echo '</tr>';
    }
?>
</table>
<?php
require('footer.php');
?>
