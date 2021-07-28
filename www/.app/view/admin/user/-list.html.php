{{@layout layout/base-ajax}}

<?php LayoutRender::listAddon(Meta::get_url("list"), "#ajax-list"); ?>
<form action="{{@url list}}" method="post" class="ajax-form" data-ajax-target="#ajax-list">
    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("keyword")}}</span></span>
                <input class="form-control" <?php FormEcho::attr_nameVal("keyword"); ?> placeholder="{{__("please-input")}}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("role")}}</span></span>
                <select class="form-control" name="role">
                    <?php 
                        FormEcho::tag_option("role", "", __("all"));
                        foreach (Model::get("roles",array()) as $k => $v){
                            FormEcho::tag_option("role", $k, $v);
                        }
                    ?> 
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
        <a class="btn btn-primary ajax-replace" href="{{@url add}}" data-ajax-target="#ajax-edit" data-ajax-callback="openModal();">{{__("newadd")}}</a>
    </div>
    <div class="tb-cell-r"><small>{{@list-detail __("msg-list-detail")}}</small></div>
</div>
{{@if-has-list}}
<table class="table">
    <thead>
        <tr>
            <th>{{ __("prof.username") }}</th>
            <th>{{ __("prof.email") }}</th>
            <th>{{ __("prof.role") }}</th>
            <th>{{ __("prof.term") }}</th>
            <th>{{ __("setting") }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{@code $myId = Auth::getVal("id");}}
        {{@each-list $e}}
        {{@code $id = $e->id;}}
        <tr data-id="{{$id}}">
            <td><a class="ajax-modal" data-width="800px" data-title="{{ __("admin.menu-user-detail") }}" href="{{@url detail?id=[$id]}}">{{$e->name}}</a></td>
            <td>{{$e->email}}</td>
            <td><small><a class="ajax-modal action-item" data-title="{{ __("admin.menu-user-roles") }}" href="{{@url roles?id=[$id]}}">{{$e->getRoleName()}}</a></td>
            <td><small><a class="ajax-modal action-item" data-title="{{ __("admin.menu-user-term") }}" href="{{@url term?id=[$id]}}">{{$e->getTermName()}}</a></small></td>

            <td><small><a class="ajax-modal action-item" data-title="{{ __("admin.menu-user-setting") }}" href="{{@url setting?id=[$id]}}">{{$e->getSettingName()}}<div class="admin-remarks">{{$e->remarks}}</div></a></small></td>
            <td class="action">
                <a class="ajax-modal action-item" href="{{@url pw?id=[$id]}}">{{ __("edit-password") }}</a>
                
                {{@if $myId != $id}}
                <a class="ajax-modal action-item" href="{{@url del?id=[$id]}}">{{ __("delete") }}</a>
                {{@endif}}
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