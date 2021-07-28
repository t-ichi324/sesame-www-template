{{@layout layout/base-ajax}}

<?php LayoutRender::listAddon(Meta::get_url("list"), "#ajax-list"); ?>
<form action="{{@url list}}" method="post" class="ajax-form" data-ajax-target="#ajax-list">
    <div class="row">
        <div class="col-md-7">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("from-to")}}</span></span>
                <input class="form-control" type="date" id="sd"<?php FormEcho::attr_nameVal("sd"); ?>>
                <span class="input-group-prepend"><span class="input-group-text">～</span></span>
                <input class="form-control" type="date" id="ed" <?php FormEcho::attr_nameVal("ed"); ?>>
                <button class="btn btn-default" type="button" id="date-claer"><i class="fa fa-trash-o"></i></button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("cate")}}</span></span>
                <select class="form-control" <?php FormEcho::attr_name("cl"); ?>>
                    <?php FormEcho::tag_option("cl", "", __("all")) ?>
                    <?php FormEcho::tag_option("cl", "dl", __("download")) ?>
                    <?php FormEcho::tag_option("cl", "login,logout,login-error", __("login")) ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="a-right">
                <?php FormEcho::tag_hidden("user_id") ?>
                <button type="submit" class="btn btn-primary">{{__("search")}}</button>
            </div>
        </div>
    </div>
</form>

{{@if-has-list}}
<div class="tb-row">
    <div class="tb-cell">
        <a class="btn btn-default" href="{{@url /download.csv[Model::get("dl-query")]}}">Download</a>
        {{@if !empty(Form::get("user_id")) }}
        <a class="btn btn-default ajax-modal" data-width="800px" href="{{/admin/user/detail/?id=[Form::get("user_id")]}}">{{__("admin.to-user-prof")}}</a>
        {{@endif}}
    </div>
    <div class="tb-cell-r">
        <small>
            <small>{{@list-detail __("msg-list-detail")}}</small><br>
            <form action="{{@url /del}}" method="post">
                <?php FormEcho::tag_hidden("user_id","cl","ed","sd") ?>
                <?php
                    if(Form::isAllEmpty("user_id","cl","ed", "sd")){
                        $msg = __("admin.log-delete-cnf-all");
                    }else{
                        $msg = __("admin.log-delete-cnf-cond");
                    }
                 ?>
                <button type="submit" class="btn btn-link btn-sm" onclick="return window.confirm('{{$msg}}');">{{__("admin.log-delete")}}</button>
            </form>
        </small>
    </div>
</div>
<table class="log-table">
    <tbody>
        {{@each-list $e}}
        <tr>
            <td class="at">{{$e->created_at}}</td>
            <td><a href="{{@url ?user_id=[$e->user_id]}}">{{$e->name}}</a></td>
            <td>{{$e->cl}}</td>
            <td class="url"><a target="_blank" href="{{$e->url}}">{{$e->url}}</a></td>
            <td title="{{$e->user_agent}}">{{$e->getBrowser()}}</td>
            <td title="{{$e->session_id}}" class="session">{{$e->session_id}}</td>
            <td title="{{$e->ip}}" class="ip">{{$e->ip}}</td>
        </tr>
        {{@endeach}}
    </tbody>
</table>
{{@require layout/list/pager}}
{{@else}}
<hr>
<p>{{__("msg-list-notfound")}}</p>
{{@endif}}