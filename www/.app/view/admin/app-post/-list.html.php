{{@layout layout/base-ajax}}

<?php LayoutRender::listAddon(Meta::get_url("list"), "#ajax-list"); ?>
<form action="{{:url list}}" method="post" class="ajax-form" data-ajax-target="#ajax-list">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("keyword")}}</span></span>
                <input class="form-control" <?php FormEcho::attr_nameVal("keyword"); ?> placeholder="{{__("please-input")}}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("category")}}</span></span>
                <select class="form-control" name="cl">
                    <?php foreach (AppKv::keyVal("app_post_cl") as $k => $v){ FormEcho::tag_option("cl", $k, $v); } ?> 
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <button type="submit" class="pull-right btn btn-primary">{{__("search")}}</button>
        </div>
    </div>
    <input type="hidden" id="page" <?php FormEcho::attr_nameVal("p"); ?>>
</form>

<div class="tb-row">
    <div class="tb-cell">
        <a class="btn btn-primary" href="{{:url add}}" >{{__("newadd")}}</a>
    </div>
    <div class="tb-cell-r"><small>{{*list-detail __("msg-list-detail")}}</small></div>
</div>
{{*if-has-list}}
<table class="table">
    <thead>
        <tr>
            <th>Status</th>
            <th>{{ __("title") }}</th>
            <th>{{ __("desc") }}</th>
            <th>Created</th>
            <th>Updated Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{@code $myId = Auth::getVal("id");}}
        {{*each-list $e}}
        {{@code $id = $e->id;}}
        <tr data-id="{{$id}}">
            <td>
                <?php if($e->status == 0){ ?>
                <span>Private</span>
                <?php }else{ ?>
                <span>Public</span>
                <?php } ?>
            </td>
            <td><a href="{{:url edit?id=[$id]}}">{{$e->title}}</a></td>
            <td style="max-width: 30vw;"><div class="ellipsis"><a href="{{:url edit?id=[$id]}}">{{$e->description}}</a></div></td>
            <td><small>{{$e->created_at}}</small></td>
            <td><small>{{$e->updated_at}}</small></td>
            <td class="action">
                <a class="ajax-modal action-item" href="{{:url del?id=[$id]}}" data-title="{{ __("delete") }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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