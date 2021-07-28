{{@layout layout/base, layout/base-ajax}}

<form action="{{@url}}" method="post" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <?php FormEcho::tag_hidden("id"); FormEcho::tag_hidden("name"); ?>
    <p>{{__("admin.user-term", Form::Get("name"))}}</p>
    
    <div class="input-group">
        <span class="input-group-text">{{__("start")}}</span>
        <input class="form-control" id="term_start" type="date" <?php FormEcho::attr_nameVal("term_start"); ?>/>
        <span class="input-group-text">{{__("end")}}</span>
        <input class="form-control" id="term_end" type="date" <?php FormEcho::attr_nameVal("term_end"); ?>/>
    </div>
    <small>{{__("admin.tip-date")}}</small>
    
    <hr class="margin-sm">
    <div class="tb-row">
        <div class="tb-cell-r">
            <button type="submit" class="btn btn-primary">{{__("update")}}</button>
            {{@require layout/asset/modal-close}}
        </div>
    </div>
</form>