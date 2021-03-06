{{@layout layout/base}}
<div class="tb-row margin-sm-top">
    <div class="tb-cell-r">
        <a class="btn btn-default ajax-modal" href="{{:url ../flds-copy}}">COPY</a>
        <button class="btn btn-default" type="button" onclick="add_fld();">ADD</button>
    </div>
</div>
<div style="width:inherit;">
    <table id="fld-tbl" class="etbl">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>{{__("system.phy_name")}}</th>
                <th>{{__("system.log_name")}}</th>
                <th>TYPE</th>
                <th>SIZE</th>
                <th>PK</th>
                <th>NN</th>
                <th>IX</th>
                <th>UQ</th>
                <th>AI</th>
                <th>xI</th>
                <th>xU</th>
                <th>DEF</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            <?php Model::set("flds", Form::get("list",array())); ?>
            {{:require tab/flds-tr}}
        </tbody>
    </table>
</div>