<?php
require('header.php');
require('functionlib.php');
?>
<h2>播出科排班管理系统</h2>
</p>今天是第<?php echo $weeknum; ?>周</p>
<p><?php echo $date ?><p>

<form action="attend.html" method="post">
    <input type="submit" value="排班表统计">
</form><br/>

<form action="rotaC.html" method="post">
    <input type="submit" value="排班表录入修改">

<?php
require('footer.php');
?>
