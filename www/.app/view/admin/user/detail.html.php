{{@layout layout/base, layout/base-ajax}}
{{@require layout/asset/user-prof}}

<hr class="margin-sm">
<div class="tb-row">
    <div class="tb-cell">
        <a class="btn btn-default" href="{{/admin/log/?user_id=[Form::getVal('id')]}}">{{__("admin.to-user-log")}}</a>
    </div>
    
    <div class="tb-cell-r">
        <a class="btn btn-default" href="{{/admin/user/edit?id=[Form::getVal('id')]}}">{{__("edit")}}</a>
        {{@require layout/asset/modal-close}}
    </div>
</div>
