<?php
require('header.php');
require('functionlib.php');
?>
<h2>播出科排班管理系统</h2>
</p>今天是第<?php echo $weeknum; ?>周</p>
<p><?php echo $date ?><p>
<input type="button" value="自动生成排班表" onclick="location.href='rota.php'" /><br/>

<form action="attend2.php" method="post">
    <input type="submit" value="排班表统计">
    <select name="year">
        <option value="2015">2015年</option>
        <option value="2016">2016年</option>
        <option value="2017">2017年</option>
        <option value="2018"selected="selected">2018年</option>
        <option value="2019">2019年</option>
    </select>
    <select name="month">
        <option value="1">一月</option>
        <option value="2">二月</option>
        <option value="3">三月</option>
        <option value="4">四月</option>
        <option value="5">五月</option>
        <option value="6">六月</option>
        <option value="7">七月</option>
        <option value="8">八月</option>
        <option value="9">九月</option>
        <option value="10">十月</option>
        <option value="11">十一月</option>
        <option value="12">十二月</option>
    </select>
</form><br/>

<form action="attend.php" method="post">
    <input type="submit" value="考勤表统计">
    <select name="year">
        <option value="2015">2015年</option>
        <option value="2016">2016年</option>
        <option value="2017">2017年</option>
        <option value="2018"selected="selected">2018年</option>
        <option value="2019">2019年</option>
    </select>
    <select name="month">
        <option value="1">一月</option>
        <option value="2">二月</option>
        <option value="3">三月</option>
        <option value="4">四月</option>
        <option value="5">五月</option>
        <option value="6">六月</option>
        <option value="7">七月</option>
        <option value="8">八月</option>
        <option value="9">九月</option>
        <option value="10">十月</option>
        <option value="11">十一月</option>
        <option value="12">十二月</option>
    </select>
</form><br/>

<form action="hundredsafety.php" method="post">
    <input type="submit" value="百班统计">
    <select name="year">
        <option value="2015">2015年</option>
        <option value="2016">2016年</option>
        <option value="2017">2017年</option>
        <option value="2018" selected="selected">2018年</option>
        <option value="2019">2019年</option>
    </select>
    <select name="month">
        <option value="1">一月</option>
        <option value="2">二月</option>
        <option value="3">三月</option>
        <option value="4">四月</option>
        <option value="5">五月</option>
        <option value="6">六月</option>
        <option value="7">七月</option>
        <option value="8">八月</option>
        <option value="9">九月</option>
        <option value="10">十月</option>
        <option value="11">十一月</option>
        <option value="12">十二月</option>
    </select>
</form><br/>

<form action="record.php" method="post">
    <input type="submit" value="排班表录入修改">
    <select name="year">
        <option value="2015">2015年</option>
        <option value="2016">2016年</option>
        <option value="2017">2017年</option>
        <option value="2018" selected="selected">2018年</option>
        <option value="2019">2019年</option>
    </select>
    <select name="month">
        <option value="1">一月</option>
        <option value="2">二月</option>
        <option value="3">三月</option>
        <option value="4">四月</option>
        <option value="5">五月</option>
        <option value="6">六月</option>
        <option value="7">七月</option>
        <option value="8">八月</option>
        <option value="9">九月</option>
        <option value="10">十月</option>
        <option value="11">十一月</option>
        <option value="12">十二月</option>
    </select>
    <select name="day">
        <option value="1">01日</option>
        <option value="2">02日</option>
        <option value="3">03日</option>
        <option value="4">04日</option>
        <option value="5">05日</option>
        <option value="6">06日</option>
        <option value="7">07日</option>
        <option value="8">08日</option>
        <option value="9">09日</option>
        <option value="10">10日</option>
        <option value="11">11日</option>
        <option value="12">12日</option>
        <option value="13">13日</option>
        <option value="14">14日</option>
        <option value="15">15日</option>
        <option value="16">16日</option>
        <option value="17">17日</option>
        <option value="18">18日</option>
        <option value="19">19日</option>
        <option value="20">20日</option>
        <option value="21">21日</option>
        <option value="22">22日</option>
        <option value="23">23日</option>
        <option value="24">24日</option>
        <option value="25">25日</option>
        <option value="26">26日</option>
        <option value="27">27日</option>
        <option value="28">28日</option>
        <option value="29">29日</option>
        <option value="30">30日</option>
        <option value="31">31日</option>
    </select>

<?php
require('footer.php');
?>
