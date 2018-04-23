var weekdayZH=new Array(7)
weekdayZH[1]="一"
weekdayZH[2]="二"
weekdayZH[3]="三"
weekdayZH[4]="四"
weekdayZH[5]="五"
weekdayZH[6]="六"
weekdayZH[7]="日"

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

function rotaidToDuty(rotaid,dateid,dutyinfo){//通过rotaid和dateid查找对应的dutyinfo数组信息
    for (x in dutyinfo){
        if(rotaid==dutyinfo[x].num){
            return dutyinfo[x].name;
        }
    }
}

function rotaidToSimpleDuty(rotaid){
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