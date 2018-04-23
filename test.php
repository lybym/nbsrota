<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>统计</title>
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
var weekdayZH=new Array(7)
weekdayZH[1]="一"
weekdayZH[2]="二"
weekdayZH[3]="三"
weekdayZH[4]="四"
weekdayZH[5]="五"
weekdayZH[6]="六"
weekdayZH[7]="日"
</script>
</head>

<body>
<div id=echo></div>
<p>请选择需要查询的日期：<input type="text" id="datepicker"></p>
<button id="btn1">提交</button>

<div class="attend">
    <table class="tg" id="attend-tab">
    </table>
</div>
<div class="statistic">
    <table class="tg" id="statistic-tab">
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
            $("#attend-tab").empty();
            var allrotainfo=data;
            console.log(allrotainfo);
            var dayinfo=allrotainfo.dayinfo;
            var nameinfo=allrotainfo.nameinfo;
            var dutyinfo=allrotainfo.dutyinfo;
            $("#attend-tab").append('<tr id="attend-tab-date"><th class="tg-content1">姓名日期</th></tr>');//日期行
            for(i=sdateid;i<=edateid;i++){
                if(dayinfo[i].hoilday==1){
                    $("#attend-tab-date").append('<th><div>'+ weekdayZH[dayinfo[i].week]+'</div><div class="tg-weekend">'+dayinfo[i].day +'</div></th>');
                }
                
                else{
                    if((dayinfo[i].week=='7' || dayinfo[i].week=='6') && dayinfo[i].hoilday!='2'){
                        $("#attend-tab-date").append('<th><div>'+ weekdayZH[dayinfo[i].week]+'</div><div class="tg-weekend">'+dayinfo[i].day +'</div></th>');
                        //echo '<th class="tg-weekend">'.$xingqihanzi[$dayinfo['weeknumber']]."<br>".$dayinfo['day'].'</th>';
                    }
                    else{
                        $("#attend-tab-date").append('<th><div>'+ weekdayZH[dayinfo[i].week]+'</div><div class="tg-weekday">'+dayinfo[i].day +'</div></th>');
                        //echo '<th class="tg-weekday">'.$xingqihanzi[$dayinfo['weeknumber']]."<br>".$dayinfo['day'].'</th>';
                    }
                }
                
            }

            Object.keys(nameinfo).forEach(function(nameid){//根据人名数确定列数
                var name_x=nameinfo[nameid].name_x;
                $("#attend-tab").append('<tr id=name_'+name_x+'></tr>');
                $('#name_'+name_x).append('<td class="tg-content1">'+ nameinfo[nameid].renming +'</td>');
                for(j=sdateid;j<=edateid;j++){
                    var eachdateidinfo=allrotainfo.rotainfo[nameid][j];
                    var eachdateiddisplay='';
                    for (x in eachdateidinfo){//遍历每个内容数组
                        var rotaid=eachdateidinfo[x];
                        if(rotaid=='0'){
                        rotaid='';
                        }
                        else{
                            //rotaid=rotaidToDuty(rotaid,j,dutyinfo);
                            for (val in dutyinfo){
                                if(rotaid==dutyinfo[val].num){
                                    rotaid=dutyinfo[val].name;
                                }
                            }
                        }
                    eachdateiddisplay+=rotaid+'<br>';//输出遍历的结果
                    }
                    $('#name_'+name_x).append('<td class="tg-content1" id=name_' + name_x + '-' + j +'>' +eachdateiddisplay+ '</td>');
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