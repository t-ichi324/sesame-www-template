<table class="etbl w-100 margin-sm-top">
    <tbody>
        <tr>
            <th>{{__("entity_name")}}</th>
            <th>collation</th>
        </tr>
        <tr>
            <td><input type="tel" <?php FormEcho::attr_nameVal("ent_name"); ?> /></td>
            <td>
                <select name="collation">
                <?php FormEcho::tag_option("collation", "", "-- Sch Default --") ?>
                <?php FormEcho::tag_option("collation", "utf8_general_ci", "utf8_general_ci") ?>
                </select>
            </td>
        </tr>
        <tr>
            <th colspan="2">Comment</th>
        </tr>
        <tr>
            <td colspan="2"><input type="text" <?php FormEcho::attr_nameVal("comment"); ?> /></td>
        </tr>
    </tbody>
</table>