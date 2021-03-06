<?php
$dt =  [ "INT","TINYINT", "VARCHAR","TEXT","LONGTEXT", "BOOLEAN", "FLOAT","DECIMAL", "DATE", "DATETIME", "TIMESTAMP"];
$flds = Model::get("flds");
foreach($flds as $e){
    FormEcho::set_bundle($e, "list[][", "]");
?>
<tr>
    <td><i class="fa fa-times fld-rem"></i></td>
    <td><i class="fa fa-arrow-up fld-up"></i><i class="fa fa-arrow-down fld-down"></i></td>
    <td><input class="f-txt" type="tel" <?php FormEcho::attr_nameVal("phy_name") ?> placeholder="---"></td>
    <td><input class="f-txt" type="text" <?php FormEcho::attr_nameVal("log_name") ?>></td>
    <td>
        <select class="f-sel" name="list[][data_type]">
            <?php foreach ($dt as $v){ FormEcho::tag_option("data_type", $v, $v); } ?>
        </select>
    </td>
    <td><input type="number" <?php FormEcho::attr_nameVal("data_size") ?>></td>
    <td><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_pk") ?>></td>
    <td><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_nn") ?>></td>
    <td><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_ix") ?>></td>
    <td><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_uq") ?>></td>
    <td><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_ai") ?>></td>
    <td><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_xi") ?>></td>
    <td><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_xu") ?>></td>
    <td><input type="text" <?php FormEcho::attr_nameVal("def") ?>></td>
    <td><input type="text" <?php FormEcho::attr_nameVal("comment") ?>></td>
</tr>
<?php FormEcho::end_bundle(); } ?>