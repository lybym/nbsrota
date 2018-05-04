<?php
/*初始化参数*/
//连接数据库nbs
$dbms='mysql';          //数据库类型
$host='127.0.0.1';      //数据库主机名
$dbName='nbs';          //使用的数据库
$user='root';           //数据库连接用户名
$pass='e6aeef86f0';     //对应的密码
$dsn="$dbms:host=$host;dbname=$dbName";
try {
    //初始化一个PDO对象
    //默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
    $db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true)); 
    //echo "连接成功<br/>";
    $db->query('set names utf8');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
/*
$con = mysqli_connect("127.0.0.1","root","e6aeef86f0","nbs");
if (!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($con,"set names utf8");
*/
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
//下周日期生成
$next_day[]=array();
$next_day[1]=date('Y-m-d',strtotime("$now_start +7 days"));
$next_day[2] =date('Y-m-d',strtotime("$now_start +8 days"));  
$next_day[3] =date('Y-m-d',strtotime("$now_start +9 days"));
$next_day[4] =date('Y-m-d',strtotime("$now_start +10 days"));
$next_day[5] =date('Y-m-d',strtotime("$now_start +11 days"));
$next_day[6] =date('Y-m-d',strtotime("$now_start +12 days"));
$next_day[7] =date('Y-m-d',strtotime("$now_start +13 days"));

//星期汉字
$xingqihanzi=array("","一","二","三","四","五","六","日");

//初始化DATEID和WEEKNUM
$dateid=array();
$weeknum=(int)date('W',strtotime($next_day[1]));

//初始化人名数组
function Names($dateidstart){
    global $db;
    $names=array();
    foreach ($db->query('SELECT * FROM rota_bochuke_nameinfo') as $row) {
        if($row['retirement']=="" or dateidcreate($row['retirement'])>=$dateidstart){//如果退休日期大于dateid
            //array_push($names,$row['name_x']);
        }
    }
    return $names;
}

//初始化$rotabackview[]
$rotabackview=array();
$name_num=count(Names(1));
for($i=1;$i<=$name_num;$i++)
{
    for($j=1;$j<=5;$j++)
    {
        $rotabackview[$i*10+$j]=0;                //输出数组定义为0
    }
}

/*函数库*/
//从数据库读取符合条件，如果$target_col为""，则返回数组第一条
function ReadFromSql($tablename,$target_col,$row,$i){
    global $db;
    $row=$db->prepare("SELECT * from $tablename where $row=:num");
    $row->execute(array(':num' =>$i));
    $str=$row->fetch();
    if($target_col==""){
        return $str;
    }
    else{
        return $str["$target_col"];
    }
}

//读取数据库表最后一条内容数组
function latesttable($x)
{
    global $con;
    $result_maxid=mysqli_query($con,"SELECT max(id) from $x");
    $maxid=mysqli_fetch_array($result_maxid);
    return $maxid;
}

//获得数据库相应时间条目的类型
function getxingxi($x)
{
    global $con;
    $xingxi=mysqli_query($con,"SELECT * FROM rota_bochuke_luru where riqi='$x'");
    if($xingxi)
    {
        $xingxi=mysqli_fetch_array($xingxi);
    }
    else
    {
        mysqli_error($con);
    }
    return $xingxi;
}

//将XXXX-XX-XX格式日期转化为自2014/12/29以来的天数dateid
function dateidcreate($dateinfo){
    date_default_timezone_set('Asia/Shanghai');
    $d1=strtotime("2014-12-29");
    $d2=strtotime("$dateinfo");
    $d3=ceil(($d2-$d1)/60/60/24)+1;
    return $d3;
}

//将dateid转化为星期
function dateidtoweeknumber($dateid){
    $weeknumber=$dateid%7;
    if($weeknumber==0){
        $weeknumber=7;
    }
    return $weeknumber;
}

//排班条件判断大函数
function yesornojudgment($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum){
    $flag=1;//echo "flag=1<br>";
    if(!factor_1($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum))//条件1符合返回1
    {
        $flag=0;//echo "factor1<br>";
    }
    if(!factor_2($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum))//条件2符合返回1
    {
        $flag=0;//echo "factor2<br>";
    }
    if(!factor_3($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum))//条件3符合返回1
    {
        $flag=0;//echo "factor3<br>";
    }
    if(!factor_4($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum))//条件4符合返回1
    {
        $flag=0;//echo "factor4<br>";
    }
    if(!factor_5($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum))//条件5符合返回1
    {
        $flag=0;//echo "factor5<br>";
    }
    return $flag;
}

//排班条件1-检测是否具有当前班权限
function factor_1($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum){
    global $con;
    $quanxian=chr(64+$rotainfo2).(string)$rotainfo1;
    $lie=mysqli_query($con,"SELECT $quanxian FROM rota_bochuke_nameinfo WHERE id=$namenuminfo");
    $lie=mysqli_fetch_array($lie);
    $namenuminfo='name_'.$namenuminfo;
    $holiday=mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_holiday WHERE dateid=$dateid");
    $holiday=mysqli_fetch_array($holiday);
    if($lie[0]=='1' AND $holiday[0]==0)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

//排班条件2-检测当天个人是否重复
function factor_2($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum){
    global $con;
    $namenuminfo='name_'.$namenuminfo;
    $content=mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_statistic WHERE dateid=$dateid");
    $content=mysqli_fetch_array($content);
    if($content[0]=='')
    {
        return 1;
    }
    else
    {
        return 0;
    }

}

//排班条件3-检测夜班排班的合法性
function factor_3($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum){
    global $con;
    if($rotainfo1==1 AND $rotainfo2==3){
        $namenuminfo='name_'.$namenuminfo;
        $daynum=fmod($dateid,7);
        if($daynum==0){
            $daynum=7;
        }
        //第一部分,检测前一天是否有班
        $i=$dateid-1;
        @$str1=mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_statistic WHERE dateid=$i");
        @$str1 = mysqli_fetch_array($str1);
        if($str1[0]<>''){
            return 0;
            //echo $i."=".$namenuminfo.":".$str1[0]."<br>";
        }
        //第二部分,检测一周内是否还有夜班
        $enddaynum=$dateid-$daynum;
        for($j=$dateid;$j>$enddaynum;$j--){
            @$str2 = mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_statistic WHERE dateid=$j");
            @$str2 = mysqli_fetch_array($str2);
            //echo $j."=".$str2[0]."<br>";//测试行
            if($str2[0]=='13'){
                return 0;
            }
        }
        //第三部分，检测前一周是否有夜班
        $startdateid=$dateid-($daynum+6);
        $finishdateid=$dateid-$daynum;
        //echo $startdateid."->".$finishdateid."<br>";
        for($k=$startdateid;$k<=$finishdateid;$k++){
            @$str3 = mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_real_statistic WHERE dateid=$k");
            @$str3 = mysqli_fetch_array($str3);
            //echo $k.":".$namenuminfo."=".$str3[0]."<br>";//测试行
            if($str3[0]=='13'){
                return 0;
            }
        }
        return 1;
    }
    else{
        return 1;
    }
}


//排班条件4-检测早班和前一天晚班是否冲突
function factor_4($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum){
    global $con;
    if($rotainfo1==2)
    {
        $namenuminfo='name_'.$namenuminfo;
        $dateid=$dateid-1;
        $content=mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_statistic WHERE dateid=$dateid");
        $content=mysqli_fetch_array($content);
        $content[0]=substr($content[0],0,1);
        if($content[0]=='4')
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
    else
    {
        return 1;
    }
}

//排班条件5-检测一周同一种班不大于2次，总班数n不大于设定值
function factor_5($dateid,$rotainfo1,$rotainfo2,$namenuminfo,$weeknum){
    global $con;
    $rotainfo = array();
    $n = 0;
    $daynum = fmod($dateid, 7);
    if ($daynum == 0) {
        $daynum = 7;
    }
    $startdateid = $dateid - $daynum + 1;
    $finishdateid = $dateid;
    $lie=mysqli_query($con,"SELECT time FROM rota_bochuke_nameinfo WHERE id=$namenuminfo");
    $lie=mysqli_fetch_array($lie);
    $namenuminfo = 'name_' . $namenuminfo;
    for ($i = $startdateid; $i < $finishdateid; $i++) {
        $content = mysqli_query($con,"SELECT $namenuminfo FROM rota_bochuke_statistic WHERE dateid=$i");
        $content = mysqli_fetch_array($content);
        if ($content[0] <> '') {
            $rotainfo[$n] = $content[0];
            $n++;
        }
    }
    //echo "n=".$n.",lie=".$lie[0]."<br>";//测试行
    if($n==$lie[0])
    {
        //echo ",为1"."<br>";//测试行
        return 0;
    }
    //echo "rota:".$rotainfo1.$rotainfo2."<br>";
    //echo $dateid.":".$n;print_r($rotainfo);echo "<br>";
    $twotime = 0;
    $threetime = 0;
    $fourtime = 0;
    if ($n > 0) {
        for ($j = 0; $j < $n; $j++) {
            //echo $j."=".$n."=".$rotainfo[$j]."<br>";
            switch ((int)substr($rotainfo[$j], 0, 1)) {
                case 2:
                    $twotime++;
                    break;
                case 3:
                    $threetime++;
                    break;
                case 4:
                    $fourtime++;
                    break;
            }
        }
    }
    if($twotime>=1 AND $threetime>=1 AND $fourtime>=1){
        $twotime=0;
        $threetime=0;
        $fourtime=0;
    }
    switch((int)$rotainfo1){
        case 2:
            if($twotime>=1){
                return 0;
            }
            break;
        case 3:
            if($threetime>=1){
                return 0;
            }
            break;
        case 4:
            if($fourtime>=1){
                return 0;
            }
            break;
    }
    return 1;
}
//BUG--由于导入了上周的最后一天数据，在统计天数时多统计了一次，造成部分人当周少一次--
//每次排班班次数量上限N
function rotatimelimit($namenuminfo,$num){
    global $con;
    //$lie=mysqli_query($con,"SELECT time FROM rota_bochuke_nameinfo WHERE id=$namenuminfo");
    //$lie=mysqli_fetch_array($lie);
    $namenuminfo='name_'.$namenuminfo;
    $content=mysqli_query($con,"SELECT COUNT(*) FROM rota_bochuke_statistic WHERE $namenuminfo<>''");
    $content=mysqli_fetch_array($content);
    $lie=mysqli_query($con,"SELECT * from rota_bochuke_statistic LIMIT 1");
    $lie=mysqli_fetch_array($lie);
    $lie=$lie[$namenuminfo];
    $x=$content[0];
    if($lie<>''){
        $x=$content[0]-1;
    }

    //echo $namenuminfo.",content=".$content[0].",lie=".$lie.",x=".$x."<br>";//测试行
    if($x<$num)
    {
        //echo ",为1"."<br>";//测试行
        return 1;
    }
    else
    {
        //echo ",为0"."<br>";//测试行
        return 0;
    }
}

//从数据库读取信息转化成排班表
function ReadFromSqlToForm($tablename,$startdateid,$finishdateid){
    global $con;
    global $names;
    global $name_num;
    global $namedisplay;
    global $rotabackview;
    for($i=$startdateid;$i<=$finishdateid;$i++){
        for($j=1;$j<=$name_num;$j++){
            $namenuminfo='name_'.$j;
            $str=mysqli_query($con,"SELECT $namenuminfo FROM $tablename WHERE dateid=$i");
            $str=mysqli_fetch_array($str);
            if($str[0]<>""){
                $now_startdateid=$i%7;
                if($now_startdateid==0){
                    $now_startdateid=7;
                }
                $displaynum=(string)($now_startdateid).(string)substr($str[0],0,2);
                $namedisplay[$displaynum]=$names[$j];

                if((string)substr($str[0],2,1)=='0'){
                    //一人一天2班则格式改为XX0XX，判断第三位为0时读取4-5位
                    $displaynum=(string)($now_startdateid).(string)substr($str[0],3,2);
                    $namedisplay[$displaynum]=$names[$j];
                }
                //从数据库读取每个人的班次信息
                switch ((int)substr($str[0],0,1)) {
                    case 1:
                        $rotabackview[$j * 10 + 1]++;
                        $rotabackview[$j * 10 + 5]++;
                        break;
                    case 2:
                        $rotabackview[$j * 10 + 2]++;
                        $rotabackview[$j * 10 + 5]++;
                        break;
                    case 3:
                        $rotabackview[$j * 10 + 3]++;
                        $rotabackview[$j * 10 + 5]++;
                        break;
                    case 4:
                        $rotabackview[$j * 10 + 4]++;
                        $rotabackview[$j * 10 + 5]++;
                        break;
                    /*echo $str[0]."=".$displaynum."<br>";*/
                }
            }
        }
    }
}



//生成一组排班表的函数
function createrota($i,$j,$countname,$m){
    global $con;
    global $rotarowandcol;
    global $name_numbers;
    global $weeknum;
    global $names;
    global $dateid;
    global $countname;

    $rotainfo1 = intval($rotarowandcol[$j] / 10);//班次时间段
    $rotainfo2 = $rotarowandcol[$j] - $rotainfo1 * 10;//班次类型
    $displaynum = (string)$i . (string)$rotarowandcol[$j];//输出数组建立
    $name_num=count($name_numbers);

    $flag = 0;//溢出跳出循环还是正常跳出的判定
    for ($n = 0; $n < $name_num; $n++) {
        $namenuminfo = $name_numbers[$n];//依次加载不重复随机数
        //foreach($name_numbers as $key=>$value)echo $key."=>".$value."<br>";
        if (yesornojudgment($dateid[$i], $rotainfo1, $rotainfo2, $namenuminfo, $weeknum)) {
            if (rotatimelimit($namenuminfo, $m)) {
                $flag = 1;
                break;//符合判定函数，输出
            }
        }
    }
    //echo $i . $rotarowandcol[$j] . ":n=" . $n . ",namenuminfo=" . $namenuminfo . "<br>";
    if ($flag == 1) {
        $nameinfo = $names[$namenuminfo];
        $namenuminfo = 'name_' . $namenuminfo;
        mysqli_query($con,"UPDATE rota_bochuke_statistic SET $namenuminfo = $rotarowandcol[$j] WHERE dateid = $dateid[$i]");
        //$namedisplay[$displaynum]=$nameinfo;
        $countname++;
        //echo $countname . "<br>";
    }
    else {
        return 1;
    }
}

//判断班次表是否被填满
function rotanumjudgment($i,$j){
    global $con;
    global $rotarowandcol;
    global $name_num;
    global $dateid;
    $content = mysqli_query($con,"SELECT * FROM rota_bochuke_statistic WHERE dateid=$dateid[$i]");
    $content = mysqli_fetch_array($content);
    $flag=0;
    //echo $i.$rotarowandcol[$j].":";
    //echo $j.":";print_r($content);echo "<br>";
    for($i=2;$i<=($name_num+1);$i++){
        if($content[$i]==$rotarowandcol[$j]){
            //echo "有了<br>";
            $flag=1;
        }
    }
    return $flag;
}

//判断数据库中是否已经有此值
function sqldateidjudgment($tablename,$rowid,$i){
    global $con;
    $str=mysqli_query($con,"SELECT * FROM $tablename WHERE $rowid=$i");
    if (!$str) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
        }
    $str=mysqli_fetch_array($str);
    if($str[0]==$i){
        return 0;
    }
    else{
        return 1;
    }
}

//创建限定日期内的dayinfo数据表
function dayinfocreate($startdate,$finishdate){
    global $con;
    $start_dateid=dateidcreate($startdate);
    $finish_dateid=dateidcreate($finishdate);
    for($i=$start_dateid;$i<=$finish_dateid;$i++){
        if(sqldateidjudgment("rota_dayinfo","dateid",$i)){
            $nowday=29+$i-1;
            $second=mktime(0, 0, 0, 12, $nowday, 2014);
            $year=date("Y", $second);
            $month=date("m", $second);
            $day=date("d", $second);
            $weeknum=date('W',$second);
            $weeknumber=dateidtoweeknumber($i);
            mysqli_query($con,"INSERT INTO rota_dayinfo (dateid,year,month,day,weeknum,weeknumber) 
                        VALUES ($i,$year,$month,$day,$weeknum,$weeknumber)");
        }
    }
    mysqli_query($con,"SELECT * from rota_dayinfo ORDER BY dateid ASC");
}


//删除指定dateid的全部条目
function deletesql($tablename,$startrow,$endrow){
    global $con;
    for($i=$startrow;$i<=$endrow;$i++){
        mysqli_query($con,"DELETE FROM $tablename WHERE dateid = $i");
    }
}

//将dateid范围按月分段，返回分段数组，偶数位为开始，奇数为为结束，两个一组
function SegDateidOfMonth($StartDateid,$EndDateid){
    global $db;
    $SegArray=array();
    $SegArray[0]=$StartDateid;
    $i=1;//开始dateid放入数组第一位
    /*留着优化*/
    foreach ($db->query('SELECT dateid FROM rota_dayinfo WHERE day=1') as $row) {
        if($row[0]>$StartDateid && $row[0]<$EndDateid){//加=就会重复数组
            $SegArray[$i]=(int)$row[0]-1;
            $i++;
            $SegArray[$i]=(int)$row[0];
            $i++;
        }
    }
    $SegArray[$i]=$EndDateid;//结束dateid放入数组最后一位
    return $SegArray;
}


//通过dateid范围返回值班次数,namenum为名字顺序
function SearchRotaTimes($StartDateid,$EndDateid,$namenum){
    global $con;
    $AttendTimes=0;//初始化次数
    for($i=$StartDateid;$i<=$EndDateid;$i++){
        $namenuminfo='name_'.$namenum;
        $rotainfo=ReadFromSql("rota_bochuke_real_statistic",$namenuminfo,"dateid",$i);
        //echo $k.":".$rotainfo."<br>";
        if($rotainfo){
            $AttendTimes++;
        }
    }
    return $AttendTimes;
}

//返回dateid范围内的dutyinfo数组
function DutyInfo($dateid){
    global $db;
    $dutyinfo=array();
    $i=0;
    foreach ($db->query("SELECT * from rota_bochuke_dutyinfo where enable_dateid_start<=$dateid and enable_dateid_end>=$dateid") as $row) {
        $dutyinfo[$i][0]=$row['name'];
        $dutyinfo[$i][1]=$row['score'];
        $dutyinfo[$i][2]=$row['duration'];
        $dutyinfo[$i][3]=$row['coefficient'];
        $i++;
    }
    return $dutyinfo;
}

class RotaInfo {
    public $name_num;
    
    function __construct($num){//构造函数
        $this->name_num = $num;
    }

    function StillWork($dateid){//判断对于当前dateid是否退休，未退休返回1，已退休返回0
        $row=ReadFromSql("rota_bochuke_nameinfo","","name_x",$this->name_num);
        if($row['retirement']==""){
            return 1;
        }
        elseif(dateidcreate($row['retirement'])>=$dateid){
            return 1;
        }
        else{
            return 0;
        }
    }

    function Hoilday($dateid){//判断假日类型
        $dayinfo=$this->DBInfoArray("rota_dayinfo",$dateid);
        if($dayinfo['hoilday']==1){
            return "triday";
        }
        elseif(($dayinfo['weeknumber']==7 or $dayinfo['weeknumber']==6) && $dayinfo['hoilday']!=2){ 
            return "weekday";
        }
        else{
            return "weekend";
        }
    }

    function Name($dateid){//返回人名
        global $db;
        foreach ($db->query("SELECT * FROM rota_bochuke_nameinfo where name_x=$this->name_num") as $row) {
            if($this->StillWork($dateid)){
                return $row['renming'];
            }
        }
    }

    function DBInfoArray($tablename,$dateid){//根据dateid返回$tablename中的条目信息数组
        global $db;
        $dbinfo_array=ReadFromSql($tablename,"","dateid",$dateid);
        return $dbinfo_array;
    }

    function DutyNum($dateid){//返回值班数字数组
        global $db;
        $duty_num=array();
        $namenuminfo='name_'.($this->name_num);
        $str=ReadFromSql("rota_bochuke_real_statistic",$namenuminfo,"dateid",$dateid);
        if($str==""){
            array_push($duty_num,"");
        }
        else{
            for($i=0;$i<strlen($str);$i=$i+3){
                array_push($duty_num,substr($str,$i,2));
            }
        }
        return $duty_num;
    }

    /*
    根据$dateid返回符合条件的值班信息整个数组$array['key']
    `id`,`enable_dateid_start`,`enable_dateid_end`,`name`,`num`,`starttime`,`endtime`,`score`,`duration`,`coefficient`,`weekday_enable`,`name_enable`,`other`
    */
    function DutyInfoNameDisplay($dateid){
        global $db;
        $duty_num=array();
        $duty_info=array();
        $duty_num=$this->DutyNum($dateid);
        $dayinfo=$this->DBInfoArray("rota_dayinfo",$dateid);
        $i=0;
        foreach($duty_num as $row){
            if($row<>""){
                foreach ($db->query("SELECT * from rota_bochuke_dutyinfo where num=$row") as $dutyinfo) {
                    if(!(strpos($dutyinfo['weekday_enable'],$dayinfo['weeknumber'])===FALSE)){//字符位置在首位也会返回0，使用===代替==比较先比较类型，可区分FALSE和0
                        if($dutyinfo['enable_dateid_start']<=$dateid && $dutyinfo['enable_dateid_end']>=$dateid){
                            array_push($duty_info,$dutyinfo['name']);
                        }
                    }
                }
            }
            //else{
            //    $duty_info[0]="";
            //}
        }
        return $duty_info;
    }

    //生成某一dateid时间段name_X的排班数组
    function RotaInfoArray($start,$end){
        $rota_info=array();
        $namenuminfo='name_'.($this->name_num);
        for($i=$start;$i<=$end;$i++){
            //if($str<>""){
                $rota_info=array_merge($rota_info,$this->DutyInfoNameDisplay($i));
            //}
            
        }
        return $rota_info;
    }

    //统计某一dateid时间段排班信息数组
    function StatRotaInfoArray($start,$end){
        global $db;
        $dutyinfoname_array=array();
        $stat_array=array();
        foreach ($db->query("SELECT * from rota_bochuke_dutyinfo where enable_dateid_start<=$start && enable_dateid_end>=$start") as $row) {
            $a=$row['name'];
            $b=array("$a"=>0);
            $dutyinfoname_array=array_merge($dutyinfoname_array,$b);
        }
        $stat_array=array_count_values($this->RotaInfoArray($start,$end));
        $stat_array=array_merge($dutyinfoname_array,$stat_array);
        return $stat_array;
        //foreach($stat_array as $key=>$value){
        //    echo $key."=>".$value."\n";
        //}
    }

    function DutyInfoNameArray($dateid){
        global $db;
        $dutyinfo_name=array();
        foreach ($db->query("SELECT * from rota_bochuke_dutyinfo where enable_dateid_start<=$dateid && enable_dateid_end>=$dateid") as $row) {
            $a=$row['name'];
            $b=array("$a"=>0);
            $dutyinfo_name=array_merge($dutyinfo_name,$b);
        }
        return $dutyinfo_name;
    }


    function Duration($dateid){//返回当前dateid下班次持续时间信息,包括前一日的跨零点
        global $db;
        $dutyinfo=$this->DutyInfo($dateid);
        $y_time=0;
        if($this->DutyNum($dateid-1)<>""){
            $y_dutyinfo=$this->DutyInfo($dateid-1);
            $y_endtime = new DateTime($y_dutyinfo['endtime']);
            $y_zerotime = new DateTime("24:00");//
            if($y_endtime>$y_zerotime){//获得跨零点的部分
                $y_diff=$y_endtime->diff($y_zerotime);
                $y_hour=(float)$y_diff->format('%h');
                $y_minute=(float)$y_diff->format('%i');
                $y_time=$y_hour+$y_minute/60;
            }
        }
        $starttime = new DateTime($dutyinfo['starttime']);
        //echo $starttime->format('Y-m-d H:i:s')."<br>";
        $endtime = new DateTime($dutyinfo['endtime']);
        //echo $endtime->format('Y-m-d H:i:s');
        $zerotime = new DateTime("24:00");//
        if($endtime>=$zerotime){//去除跨零点的部分
            $endtime=$zerotime;
        }
        $diff=$endtime->diff($starttime);
        $hour=(float)$diff->format('%h');
        $minute=(float)$diff->format('%i');
        $time=$hour+$minute/60+$y_time;
        return $time;
    }
}

?>