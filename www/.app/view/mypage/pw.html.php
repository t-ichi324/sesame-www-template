{{@layout layout/base, layout/base-ajax}}

{{@if-not-ajax}}<div class="row"><div class="{{col_md_class()}}">{{@endif}}
    <form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-form" data-ajax-target="#ajax-pw" <?php } ?>>
        <?php FormEcho::tag_hidden("name"); ?>
        <p>{{__("edit-password")}}</p>
        <label>{{__("password-new")}}</label>
        <input class="form-control" type="password" autocomplete="off" name="pw" value="">
        <small class="input-guide"><?= Validator::PASSWORD_GUIDE(); ?></small><br>
        <label>{{__("password-cnf")}}</label>
        <input class="form-control" type="password" autocomplete="off" name="confirm" value="">
        
        <hr class="margin-sm">
        <div class="tb-row">
            <div class="tb-cell-r">
                <button type="submit" class="btn btn-primary">{{__("update")}}</button>
                {{@require layout/asset/modal-close}}
            </div>
        </div>
    </form>
{{@if-not-ajax}}</div></div>{{@endif}}
