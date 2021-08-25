{{@layout layout/base-ajax}}

<?php LayoutRender::listAddon(Meta::get_url("list"), "#ajax-list"); ?>
<form action="{{:url list}}" method="post" class="ajax-form search" data-ajax-target="#ajax-list" id="search">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("cate")}}</span></span>
                <select class="form-control" name="cl" id="sel-cl">
                    <?php
                        FormEcho::tag_option("cl", "", "--- ".__("please-select")." ---");
                        foreach (Model::get("cl_list", array()) as $k => $v){
                            FormEcho::tag_option("cl", $k, $v);
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
</form>
<form action="{{:url edit}}" method="post" id="editor" style="display: none">
    <?php FormEcho::tag_hidden("cl"); ?>
    <input type="hidden" name="sort" id="editor-sort" value="">
    <input type="hidden" name="key" id="editor-key" value="">
    <input type="hidden" name="val" id="editor-val" value="">
    <input type="hidden" name="attr" id="editor-attr" value="">
</form>

<?php $form = FormEcho::getFormObject(); ?>
<?php if(StringUtil::isNotEmpty($form->cl)){ ?>
<div class="tb-row">
    <div class="tb-cell-r"><small>{{*list-detail __("msg-list-detail")}}</small></div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>SORT</th>
            <th>KEY</th>
            <th>VAL</th>
            <th>ATTR</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="text" class="form-control" id="add-sort" value=""  style="width: 4em"/></td>
            <td><input type="tel" class="form-control" id="add-key" value=""/></td>
            <td><input type="text" class="form-control" id="add-val" value=""/></td>
            <td><input type="text" class="form-control" id="add-attr" value=""/></td>
            <td class="action"><button class="btn btn-primary" type="button" id="add">Add</button></td>
        </tr>
        {{*each-list $e}}
        <tr data-cl="{{$e->cl}}" data-key="{{$e->key}}">
            <td><input type="number" class="form-control edit e-sort" value="{{$e->sort}}" style="width: 4em"/> </td>
            <td><input type="tel" class="form-control" readonly value="{{$e->key}}"/> </td>
            <td><input type="text" class="form-control edit e-val" value="{{$e->val}}"/> </td>
            <td><input type="text" class="form-control edit e-attr" value="{{$e->attr}}"/> </td>
            <td class="action"><button class="btn btn-default del" type="button" data-url="{{:url /del?cl=[$e->cl]&key=[$e->key]}}">Del</button></td>
        </tr>
        {{@endeach}}
    </tbody>
</table>

{{@if Model::isNotEmpty("key-note")}}
<p style="color: #F00">{{Model::get("key-note")}}</p>
{{@endif}}
<p>{{__("system.kv-note")}}</p>
<?php }else{ ?>
<p>{{__("please-select")}}</p>
<?php } ?>