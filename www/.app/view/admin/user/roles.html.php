{{@layout layout/base, layout/base-ajax}}

<form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <?php FormEcho::tag_hidden("id"); FormEcho::tag_hidden("name"); ?>
    <p>{{__("admin.user-role", Form::get("name"))}}</p>
    
    <hr>
    <div class="global-role">
        <?php foreach (UserUtil::ROLE_MASTER() as $k => $v){  ?>
        <label class="checkbox"><input type="checkbox" <?php FormEcho::attr_nameValChecked("roles", $k, true) ?>><c>{{$v}}</c></label>
        <?php }  ?>
    </div>

    <hr class="margin-sm">
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">{{__("update")}}</button>
            {{@require layout/asset/modal-close}}
        </div>
    </div>
</form>
