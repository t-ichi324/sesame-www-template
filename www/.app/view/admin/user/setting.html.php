{{@layout layout/base, layout/base-ajax}}

<form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <?php FormEcho::tag_hidden("id","name"); ?>
    <!--
    <p>{{__("notif")}}</p>
    <?php FormEcho::tag_textarea("notice", ["class"=>"form-control"]) ?>
    <hr>
    -->
    
    <p>{{__("setting")}}</p>
    <div class="row">
        <div class="col-md-6">
            <label class="checkbox"><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_tfa") ?>><c>{{__("admin.is_tfa")}}</c></label>
        </div>
        <div class="col-md-6">
            <label class="checkbox"><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_single") ?>><c>{{__("admin.is_single")}}</c></label>
        </div>
        {{@if Auth::getVal("id") != Form::getVal("id")}}
        <div class="col-md-6">
            <label class="checkbox"><input type="checkbox" <?php FormEcho::attr_nameValChecked("is_ban") ?>><c>{{__("admin.is_ban")}}</c></label>
        </div>
        {{@endif}}
    </div>
    
    <hr>
    <p>{{__("remarks")}}</p>
    <?php FormEcho::tag_textarea("remarks", ["class"=>"form-control"]) ?>
    
    <hr class="margin-sm">
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">{{__("update")}}</button>
            {{@require layout/asset/modal-close}}
        </div>
    </div>
</form>
