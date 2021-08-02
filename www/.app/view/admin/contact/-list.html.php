{{@layout layout/base-ajax}}

<?php LayoutRender::listAddon(Meta::get_url("list"), "#ajax-list"); ?>

<form action="{{:url list}}" method="post" class="ajax-form" data-ajax-target="#ajax-list">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("cate")}}</span></span>
                <select class="form-control" name="cl">
                    <?php
                        FormEcho::tag_option("cl", "", __("all"));
                        foreach (ContactUtil::CL_MASTER() as $k=>$v){
                            FormEcho::tag_option("cl", $k, $v);
                        }
                    ?>
                </select>
                <button type="submit" class="input-group-btn btn btn-primary">{{__("search")}}</button>
            </div>
        </div>
    </div>
</form>

{{*if-has-list}}
<div class="tb-row margin-sm-top">
    <div class="tb-cell-r">
        <small>{{*list-detail __("msg-list-detail")}}</small><br>
        <small><a href="{{:url /del-checked}}" class="ajax-modal">{{__("admin.delete-readed")}}</a></small>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>{{__("status")}}</th>
            <th>{{__("cate")}}</th>
            <th>{{__("name")}}</th>
            <th>{{__("email")}}</th>
            <th>{{__("time")}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{*each-list $e}}
        {{@code $id = $e->id; $checked = $e->is_checked;}}
        <tr data-id="{{$id}}">
            <td>
                {{@if $checked == "1" }}
                <a class="btn btn-default btn-sm btn-request-check" href="{{:url check/?flag=0&id=[$id]}}">{{__("readed")}}</a>
                {{@else}}
                <a class="btn btn-warning btn-sm btn-request-check" href="{{:url check/?flag=1&id=[$id]}}">{{__("unreaded")}}</a>
                {{@endif}}
            </td>
            <td><a href="{{:url detail/?id=[$id]}}" data-width="800px" data-title="{{__("contact").__("detail")}}" class="ajax-modal">{{$e->cl_name}}</a></td>
            <td><a href="{{:url detail/?id=[$id]}}" data-width="800px" data-title="{{__("contact").__("detail")}}" class="ajax-modal">{{$e->name}}</a></td>
            <td><a href="{{:url detail/?id=[$id]}}" data-width="800px" data-title="{{__("contact").__("detail")}}" class="ajax-modal">{{$e->email}}</a></td>                  
            <td>{{$e->created_at}}</td>
            <td class="action">
                <a class="ajax-modal action-item" href="{{:url del/?id=[$id]}}">{{__("delete")}}</a>
            </td>
        </tr>
        {{@endeach}}
    </tbody>
</table>
{{@require layout/list/pager}}
{{@else}}
<hr>
<p>{{__("msg-list-notfound")}}</p>
{{@endif}}