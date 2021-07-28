{{@layout layout/base-ajax}}
<?php LayoutRender::listAddon(Meta::get_url("list"), "#ajax-list"); ?>

<form action="{{@url list}}" method="post" class="ajax-form search" data-ajax-target="#ajax-list" id="search">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
            </div>
        </div>
    </div>
</form>

<div class="tb-row">
    <div class="tb-cell-r"><small>{{@list-detail __("msg-list-detail")}}</small></div>
</div>
<table class="table">
    <tbody>
        {{@each-list $e}}
        <?php
            $pub = Flags::isON($e->is_publish) ? __("public")  : __("private") ;
            $edit = Meta::get_action("edit")."?id=".$e->id; 
            $del = Meta::get_action("del")."?id=".$e->id;
            $edit_link = 'class="ajax-modal" data-width="800px" href="'.$edit.'"'
        ?>
        <tr data-id="{{$e->id}}">
            <td class="d"><a href="{{$edit}}">{{$pub}}</a></td>
            <td class="d">
                <div>{{$e->lastmod}}</div>
                <div>{{$e->changefreq}}</div>
                <div>{{$e->priority}}</div>
            </td>
            <td class="d"><a <?= $edit_link; ?>>{{$e->loc}}</a></td>
            <td class="d"><a <?= $edit_link; ?>>{{$e->title}}</a></td>
            <td class="d"><a <?= $edit_link; ?>>{{$e->tag}}</a></td>
            <td class="action">
                <a href="{{$del}}" class="btn btn-default ajax-modal">{{__("delete")}}</a>
            </td>
        </tr>
        {{@endeach}}
    </tbody>
</table>
{{@require layout/list/pager}}