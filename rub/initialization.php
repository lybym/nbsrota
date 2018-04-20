<?php
/*初始化参数*/
//连接数据库nbs
$con = mysql_connect("127.0.0.1","root","e6aeef86f0");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("nbs", $con);
mysql_query("set names utf8");

//生成本周和下周的日期
date_default_timezone_set('Asia/Shanghai');
//当周日期生成
$date=date('Y-m-d');  //当前日期
$first=1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期
$w=date('w',strtotime($date));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6 
$now_start=date('Y-m-d',strtotime("$date -".($w ? $w - $first : 6).'days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
$now_day=array();
$now_day[1] =$now_start;
$now_day[2] =date('Y-m-d',strtotime("$now_start +1 days"));  
$now_day[3] =date('Y-m-d',strtotime("$now_start +2 days"));
$now_day[4] =date('Y-m-d',strtotime("$now_start +3 days"));
$now_day[5] =date('Y-m-d',strtotime("$now_start +4 days"));
$now_day[6] =date('Y-m-d',strtotime("$now_start +5 days"));
$now_day[7] =date('Y-m-d',strtotime("$now_start +6 days"));
$next_day[]=array();
$next_day[1]=date('Y-m-d',strtotime("$now_start +7 days"));
$next_day[2] =date('Y-m-d',strtotime("$now_start +8 days"));  
$next_day[3] =date('Y-m-d',strtotime("$now_start +9 days"));
$next_day[4] =date('Y-m-d',strtotime("$now_start +10 days"));
$next_day[5] =date('Y-m-d',strtotime("$now_start +11 days"));
$next_day[6] =date('Y-m-d',strtotime("$now_start +12 days"));
$next_day[7] =date('Y-m-d',strtotime("$now_start +13 days"));

//初始化names[],从nameinfo获得人名，从names[1]开始存入
$names=array();
$renming_num=1;
$readrenming=mysql_query("SELECT renming FROM rota_bochuke_nameinfo");
while($row=mysql_fetch_array($readrenming))
{
    $names[$renming_num]=$row[0];
    $renming_num++;
}
$name_num=$renming_num-1;//nameinfo中名字的数量

//初始化$namedisplay[]
$namedisplay=array();
for($i=1;$i<=7;$i++)
{
    for($j=1;$j<=4;$j++)
    {
        for($k=1;$k<=5;$k++)
        {
            $displaynum=(string)$i.(string)$j.(string)$k;//输出数组建立
            $namedisplay[$displaynum]='';                //输出数组定义为空
        }
    }
}

//初始化$rotabackview[]
$rotabackview=array();
for($i=1;$i<=$name_num;$i++)
{
    for($j=1;$j<=4;$j++)
    {
        $rotabackview[$i*10+$j]=0;                //输出数组定义为0
    }
}

?>