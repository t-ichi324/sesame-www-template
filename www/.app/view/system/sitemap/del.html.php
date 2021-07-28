{{@layout layout/base, layout/base-ajax}}

{{@if !Flags::isOn(Model::get("is_deleted")) }}
<form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <?php FormEcho::tag_hidden("id"); ?>
    <p>{{__("delete-cnf-*", Form::get("loc"))}}</p>
    <hr>
    <div class="a-right">
        <button type="submit" class="btn btn-primary">{{__("ok")}}</button>
        {{@if-ajax}}<button type="button" class="btn btn-default" onclick="closeModal();">{{__("cancel")}}</button>{{@endif}}
    </div>
</form>
{{@else}}
    {{@if-ajax}}<div class="a-right"><button type="button" class="btn btn-default" onclick="closeModal();">{{__("close")}}</button></div>{{@endif}}
{{@endif}}
