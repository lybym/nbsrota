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

function existInSQL($tablename,$row,$i){//判断此条数据数据库内是否存在
    global $db;
    $row=$db->prepare("SELECT * from rota_bochuke_data where $row=$i");
    $row->execute();
    $str=$row->fetch();
    if($str){
        return 1;
    }
    else{
        return 0;
    }
}


?>