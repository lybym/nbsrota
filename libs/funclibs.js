var weekdayZH=new Array(7)
weekdayZH[1]="一"
weekdayZH[2]="二"
weekdayZH[3]="三"
weekdayZH[4]="四"
weekdayZH[5]="五"
weekdayZH[6]="六"
weekdayZH[0]="日"

function timeNumArrayCreate(sdtimeNum,edtimeNum){//创建timeNum的循环数组，用来遍历
    var timeNumArray=[];
    while (sdtimeNum<=edtimeNum)
    {
        timeNumArray.push(sdtimeNum);
        sdtimeNum+=864;
    }
    return timeNumArray;
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

function wStartDate(dateinfo){//根据月份信息获取周一的日期
    var wStart=new Date(dateinfo);
    var weeknum=wStart.getDay();
    if(weeknum==0){//周日为0
        weeknum=7;
    }
    wStart.setDate(wStart.getDate()-weeknum+1);
    return wStart;
}

function wEndDate(dateinfo){//根据月份信息获取周末的日期
    var str=wStartDate(dateinfo);
    var wEnd = new Date(str);
    wEnd.setDate(wEnd.getDate() + 6);
    return wEnd;
}

function dutyxToDuty(dutyx,timeNum,dutyinfo){//通过dutyx和timeNum查找对应的dutyinfo数组信息
    for (index in dutyinfo){
        if(timeNum>=dutyinfo[index].stimenum && timeNum<=dutyinfo[index].etimenum){
            return dutyinfo[dutyx];
        }
    }
}

function dutyxToSimpleDuty(dutyx,dateid,dutyinfo){
    for (x in dutyinfo){
        rotaid=dutyinfo[dutyx].num;
    }
    var str=rotaid.substr(0,1);
    var simplerota='';
    switch(str){
        case '1':
        simplerota='夜';
        break;
        case '2':
        simplerota='早';
        break;
        case '3':
        simplerota='中';
        break;
        case '4':
        simplerota='晚';
        break;
        default:
        simplerota='无';
    }
    return simplerota;
}

function nameidToReming(nameid,nameinfo){//通过nameid查找nameinfoJSON中的renming
    var renming=nameinfo[nameid].renming;
    return renming;
}

function isHoilday(timeNum,dayinfo){//判断是否为假日
    var isHoilday=0;
    time=new Date(timeNum*100000);
    if(dayinfo[timeNum]=='3'){//三倍工资日
        isHoilday=3;
    }
    if(dayinfo[timeNum]=='1'){//国务院法定假日
        isHoilday=1;
    }
    else{
        if((time.getDay()==0 || time.getDay()==6) && dayinfo[timeNum]!='2'){
            isHoilday=2;//普通假日
        }
    }
    return isHoilday;
}

function dutySum(nameid,dutyx,timeNumLoop,rotainfo){//计算nameid在dutyx班次rotainfo里的的总和
    var sum=0;
    for(i=0;i<timeNumLoop.length;i++){
        if(rotainfo[timeNumLoop[i]][dutyx]==nameid){
            sum++;
        }
    }
    if(sum==0){
        sum='';
    }
    return sum;
}

function dutyStat(nameid,dayinfo,dutyinfo,timeNumLoop,rotainfo){//统计数组生成
    var stat={"BS":0,"JF":0,"JR":0,"ye":0,"zao":0,"zhong":0,"wan":0,"sum":0,"time":0,"score":0};
    var dura=[];
    for(i=0;i<=timeNumLoop.length;i++){
        dura[i]=0;
    }
    for(i=0;i<timeNumLoop.length;i++){
        timenum=timeNumLoop[i];
        Object.keys(rotainfo[timenum]).forEach(function(dutyx){
            if(rotainfo[timenum][dutyx]==nameid){
                dstat=durationStat(dutyx,dutyinfo);
                dura1=dura[i];
                dura2=dura[i+1];
                dura[i]=math.eval(dura1+dstat[0]);
                dura[i+1]=math.eval(dura2+dstat[1]);
                stat.score+=math.eval(dutyinfo[dutyx].score);
                var duration=dutyinfo[dutyx].duration;
                var coefficient=dutyinfo[dutyx].coefficient;
                stat.time+=math.eval(duration*coefficient);
                var str=dutyinfo[dutyx].num;
                str=str.substr(0,1);
                switch(str){
                    case '1':
                    stat.ye+=1;
                    break;
                    case '2':
                    stat.zao+=1;
                    break;
                    case '3':
                    stat.zhong+=1;
                    break;
                    case '4':
                    stat.wan+=1;
                    break;
                }
            }
        });
    }
    for(i=0;i<timeNumLoop.length;i++){
        timenum=timeNumLoop[i];
        if(isHoilday(timenum,dayinfo)==3){
            stat.JR+=dura[i];
        }
    }
    console.log(dura);
    stat.time=math.round(stat.time,1);
    stat.sum=stat.ye+stat.zao+stat.zhong+stat.wan;
    Object.keys(stat).forEach(function(i){
        if(stat[i]==0){
            stat[i]='';
        }
    });
    return stat;
}

function durationStat(dutyx,dutyinfo){//目前只能做到一个数组，分别记录当天和第二天的,月初问题没解决
    var duration=[];
    if(dutyinfo[dutyx].etime=='24:30'){
        duration[0]='6';
        duration[1]='0.5';
    }
    else{
        duration[0]=dutyinfo[dutyx].duration;
        duration[1]='0';
    }
    return duration;
}