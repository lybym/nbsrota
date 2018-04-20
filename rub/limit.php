<?php 
require('header.php');
require('functionlib.php');
?>

<?php
function checkboxreadview($formnum,$col){
    global $names;
    $colinfo2=intval($col/10);
    $colinfo1=$col-intval($col/10)*10;
    $quanxian=chr(64+$colinfo1).(string)$colinfo2;
    $lie=mysql_query("SELECT $quanxian FROM rota_bochuke_nameinfo WHERE id=$formnum");
    $lie=mysql_fetch_array($lie);
    if($lie[0]=='1')
    {
        echo 'checked="checked"';
    }
}


?>

<form action="index.php" method="post">
<h4>修改个人班次的权限</h4>
<input type="submit" value="确认修改">
    <table border="1">
    <tr>
        <th>姓名</th>
        <th>值班长岗</th>
        <th>新闻/教科</th>
        <th>娱乐/影视/少儿</th>
        <th>信息/十八/生活</th>
        <th>夜班</th>
    </tr>
        <?php
        for($formnum=1;$formnum<=$name_num;$formnum++) {
            echo '<tr>';
            echo '<td align="center">' . $names[$formnum] . '</td>';

            echo '<td align="center">
                      <input type="checkbox" name="'.$formnum.'21" value="1"';
            checkboxreadview($formnum,21);
            echo '>早 <input type="checkbox" name="'.$formnum.'31" value="1"';
            checkboxreadview($formnum,31);
            echo '>中 <input type="checkbox" name="'.$formnum.'41" value="1"';
            checkboxreadview($formnum,41);
            echo '>晚 </td>';

            echo '<td align="center">
                      <input type="checkbox" name="'.$formnum.'23" value="1"';
            checkboxreadview($formnum,23);
            echo '>早 <input type="checkbox" name="'.$formnum.'33" value="1"';
            checkboxreadview($formnum,33);
            echo '>中 <input type="checkbox" name="'.$formnum.'43" value="1"';
            checkboxreadview($formnum,43);
            echo '>晚 </td>';

            echo '<td align="center">
                      <input type="checkbox" name="'.$formnum.'24" value="1"';
            checkboxreadview($formnum,24);
            echo '>早 <input type="checkbox" name="'.$formnum.'34" value="1"';
            checkboxreadview($formnum,34);
            echo '>中 <input type="checkbox" name="'.$formnum.'44" value="1"';
            checkboxreadview($formnum,44);
            echo '>晚 </td>';

            echo '<td align="center">
                      <input type="checkbox" name="'.$formnum.'25" value="1"';
            checkboxreadview($formnum,25);
            echo '>早 <input type="checkbox" name="'.$formnum.'35" value="1"';
            checkboxreadview($formnum,35);
            echo '>中 <input type="checkbox" name="'.$formnum.'45" value="1"';
            checkboxreadview($formnum,45);
            echo '>晚 </td>';

            echo '<td align="center">
                      <input type="checkbox" name="'.$formnum.'13" value="1"';
            checkboxreadview($formnum,13);
            echo '></td>';
            echo '</tr>';
        }
        ?>
    </table>

<?php
require('footer.php');
?>