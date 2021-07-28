{{@layout layout/base, layout/base-ajax}}

{{@if-not-ajax}}<div class="row"><div class="col-md-8 mx-auto">{{@endif}}
<form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <?php FormEcho::tag_hidden("id"); ?>
    {{@require layout/asset/user-edit}}

    <hr class="margin-sm">
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">{{__("update")}}</button>
            {{@require layout/asset/modal-close}}
        </div>
    </div>
</form>
{{@if-not-ajax}}</div></div>{{@endif}}
