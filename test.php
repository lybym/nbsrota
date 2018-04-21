<?php
require('functionlib.php');
$current_file = basename(__FILE__);

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title><?php echo $current_file;?></title>
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <script src="libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="libs/jqueryui/datepicker-zh-CN.js"></script>
        <style>
            
        </style>

<script>
function echo(display){
    var x = document.getElementById("echo");
	x.innerHTML=display;
}

function dateidCreate(dateinfo){//将XXXX-XX-XX格式日期转化为自2014/12/29以来的天数dateid
    // Set the unit values in milliseconds.
    var msecPerMinute = 1000 * 60;
    var msecPerHour = msecPerMinute * 60;
    var msecPerDay = msecPerHour * 24;
    var dateidZero = new Date('2014-12-29');
    var dateidZeroMsec = dateidZero.getTime();
    var dateidNow=new Date(dateinfo);
    var dateidMsec=dateidNow.getTime();
    var dateid=(dateidMsec-dateidZeroMsec)/msecPerDay+1;//因为2014/12/29的dateid就是1
    return dateid;
}  

function mStartDate(dateinfo){//根据月份信息获取月初日期
    var str=dateinfo.substr(0,7);
    var mstart=str+'-01';
    return mstart;
}

function mEndDate(dateinfo){//根据月份信息获取月末的日期
    var str=mStartDate(dateinfo);
    var mEnd = new Date(str);
    mEnd.setMonth(mEnd.getMonth() + 1);
    mEnd.setDate(mEnd.getDate() - 1);
    return mEnd;
}

</script>
</head>

<body>
<div id=echo></div>
<p>请选择需要查询的日期：<input type="text" id="datepicker"></p>
<button id="btn1">提交</button>



<script>
$(document).ready(function(){
    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: new Date(2014,12-1,29), //起始从2015年1月1日开始
        maxDate: "+2Y" //多显示之后2年
    });

    $("#btn1").click(function(){
        var dpget = $("#datepicker").val();
        sdateid=dateidCreate(mStartDate(dpget));
        edateid=dateidCreate(mEndDate(dpget));
        console.log(sdateid);
        console.log(edateid);
        $.getJSON('getrotainfo.php', {'sdateid': sdateid, 'edateid': edateid}, function(data) {
            var allrotainfo=data;
            console.log(allrotainfo);
        });
    });
 

});
</script>
</body>
</html>