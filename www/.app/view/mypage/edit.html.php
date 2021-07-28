{{@layout layout/base, layout/base-ajax}}

{{@if-not-ajax}}<div class="row"><div class="{{col_md_class()}}">{{@endif}}
<form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    {{@require layout/asset/user-edit}}
    
    <hr class="margin-sm">
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">{{__("edit")}}</button>
            {{@require layout/asset/modal-close}}
        </div>
    </div>
</form>
{{@if-not-ajax}}</div></div>{{@endif}}
