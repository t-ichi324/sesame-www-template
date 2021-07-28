{{@layout layout/base, layout/base-ajax}}

{{@if !Flags::isOn(Model::get("is_deleted")) }}
<form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <p>{{__("admin.contact-cnf-delete-readed")}}</p>
    
    <hr class="margin-sm">
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">{{__("ok")}}</button>
            {{@require layout/asset/modal-close}}
        </div>
    </div>
    
</form>
{{@else}}
    <hr class="margin-sm">
    <div class="tb-row">
        <div class="tb-cell-r">
            {{@require layout/asset/modal-close}}
        </div>
    </div>
{{@endif}}
