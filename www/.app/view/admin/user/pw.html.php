{{@layout layout/base, layout/base-ajax}}

<form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <?php FormEcho::tag_hidden("id"); FormEcho::tag_hidden("name"); ?>
    <p>{{__("admin.user-password", Form::get("name"))}}</p>
    <label>{{__("password-new")}}</label>
    <input class="form-control" type="password" <?php FormEcho::attr_nameVal("pw"); ?>>
    <small class="input-guide"><?= Validator::PASSWORD_GUIDE(); ?></small><br>
    <label>{{__("password-cnf")}}</label>
    <input class="form-control" type="password" <?php FormEcho::attr_nameVal("confirm"); ?>>
    

    <hr class="margin-sm">
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">{{__("update")}}</button>
            {{@require layout/asset/modal-close}}
        </div>
    </div>
</form>
