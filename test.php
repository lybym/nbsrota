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
    <link rel="stylesheet" href="css/user.css">

    <script src="libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="libs/jqueryui/datepicker-zh-CN.js"></script>

    <script src="libs/funclibs.js"></script>
    <style>
            
    </style>

<script>
function echo(display){
    var x = document.getElementById("echo");
	x.innerHTML=display;
}

</script>
</head>

<body>
<div id=echo></div>
<p>请选择需要查询的日期：<input type="text" id="datepicker"></p>
<button id="btn1">提交</button>

<div class="attend">
    <table class="attend-tab">
    </table>
</div>
<div class="statistic">
    <table class="statistic-tab">
    </table>
</div>






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
        //console.log(sdateid);
        //console.log(edateid);
        
        var allrotainfo;
        $.getJSON('getrotainfo.php', {'sdateid': sdateid, 'edateid': edateid}, function(data) {
            $(".attend-tab").empty();
            var allrotainfo=data;
            console.log(allrotainfo);
            var nameinfo=allrotainfo.nameinfo;
            

            $(".attend-tab").append('<tr class="attend-tab-date"><th class="tg-content">姓名日期</th></tr>');//日期行
            for(i=sdateid;i<=edateid;i++){
                $(".attend-tab-date").append('<th class="tg-weekday">'+ allrotainfo.dayinfo[i].day +'</th>');
            }

            Object.keys(nameinfo).forEach(function(key){//根据人名数确定列数
                var name_x=nameinfo[key].name_x;
                $(".attend-tab").append('<tr id=name_'+name_x+'></tr>');
                $('#name_'+name_x).append('<td>'+ nameinfo[key].renming +'</td>');
                for(j=sdateid;j<=edateid;j++){
                    $('#name_'+name_x).append('<td id=name_' + name_x + '-' + j +'></td>');
                }
            });
            
            //for(i=sdateid;i<=edateid;i++){
            //    $(".attend-tab-date").append('<th class="tg-weekday">'+allrotainfo.dayinfo[i].day+"</th>");
            //}
        });
        
        
        
    });
 

});
</script>
</body>
</html>