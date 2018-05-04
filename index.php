<?php require('functionlib.php');?>
<h2>播出科排班管理系统</h2>
</p>今天是第<?php echo $weeknum; ?>周</p>
<p><?php echo $date ?><p>



<form action="rotaC.html" method="post">
    <input type="submit" value="排班表录入修改">
</form><br/>

<form action="stat.html" method="post">
    <input type="submit" value="绩效统计表">
</form><br/>

<form action="attend.html" method="post">
    <input type="submit" value="考勤签字表">
</form>

