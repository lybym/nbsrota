<?php
require('functionlib.php');
$current_file = basename(__FILE__);

$get_year=2018;
$get_month=3;

$d1=mktime(0, 0, 0, $get_month, 1, $get_year);//月初第一天
$SearchStartDay=date("Y-m-d", $d1);
$d2=mktime(0, 0, 0, $get_month+1, 1, $get_year)-1;//月+1第一天减一秒
$SearchFinishDay=date("Y-m-d", $d2);
//echo $SearchStartDay.'->'.$SearchFinishDay."<br>";
$sdateid=dateidcreate($SearchStartDay);
$edateid=dateidcreate($SearchFinishDay);

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
        
        </script>
    </head>

    <body>
        <p>日期：<input type="text" id="datepicker"></p>

        <script>
        $(function() {
            $( "#datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                minDate: new Date(2015, 1 - 1, 1), 
                maxDate: "+2Y"
            });
        });

        var sdateid='<?php echo $sdateid?>';
        var edateid='<?php echo $edateid?>';
        var dutynum='24';

        var allrotainfo
        $.getJSON('getrotainfo.php', {'sdateid': sdateid, 'edateid': edateid}, function(data) {
            allrotainfo=data;
            console.log(allrotainfo);
        });
        </script>
    </body>
</html>