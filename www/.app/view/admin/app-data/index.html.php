{{@layout layout/base}}

<p>{{__("admin.desc-appdata")}}</p>
<table class="table">
    <tbody>
        <?php foreach(Model::get("kv", array()) as $e){ ?>
        <tr>
            <td>{{$e->val}}</td>
            <td style="text-align: right;"><a href="{{@url /edit/?key=[$e->key]}}">{{$e->attr}} {{__("setting")}}</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
