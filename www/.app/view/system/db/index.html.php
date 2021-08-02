{{@layout layout/base}}

<p>スキーマ一覧</p>
<div class="tb-row">
    <div class="tb-cell-r">
        <a class="btn btn-primary" href="{{:url add}}">{{__("newadd")}}</a>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Type</th>
            <th>{{__("system.phy_name")}}</th>
            <th>{{__("system.log_name")}}</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (Form::get("list",array()) as $e){ ?>
        <?php
            $p = "?sch_id=".$e->getId();
            $open = Meta::get_url("tbl" ,$p);
            $edit = Meta::get_url("edit" ,$p);
            $del = Meta::get_url("del" ,$p);
        ?>
        <tr>
            <td><a href="{{$open}}">{{$e->db_type}}</a></td>
            <td><a href="{{$open}}">{{$e->phy_name}}</a></td>
            <td>{{$e->log_name}}</td>
            <td>{{$e->comment}}</td>
            <td style="text-align: right">
                <a href="{{$del}}" class="ajax-modal"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>