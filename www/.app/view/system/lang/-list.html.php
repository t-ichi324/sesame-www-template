{{@layout layout/base-ajax}}

<?php LayoutRender::listAddon(Meta::get_url("list"), "#ajax-list"); ?>
<form action="{{:url list}}" method="post" class="ajax-form search" data-ajax-target="#ajax-list" id="search">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-prepend"><span class="input-group-text">{{__("lang")}}</span></span>
                <select class="form-control" name="lang" id="sel-lang">
                    <?php
                        FormEcho::tag_option("lang", "", "--- ".__("please-select"). " ---");
                        foreach (Model::get("lang_list", array()) as $k => $v){
                            FormEcho::tag_option("lang", $k, $v);
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
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
    <?php FormEcho::tag_hidden("lang"); ?>
    <?php FormEcho::tag_hidden("cl"); ?>
    <input type="hidden" name="key" id="editor-key" value="">
    <input type="hidden" name="val" id="editor-val" value="">
</form>

<?php $form = FormEcho::getFormObject(); ?>
<?php if(StringUtil::isNotEmpty($form->cl)){ ?>
<div class="tb-row">
    <div class="tb-cell-r"><small>{{*list-detail __("msg-list-detail")}}</small></div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>KEY</th>
            <th>VAL</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="tel" class="form-control" id="add-key" value=""/></td>
            <td><input type="text" class="form-control" id="add-val" value=""/></td>
            <td class="action"><button class="btn btn-primary" type="button" id="add">Add</button></td>
        </tr>
        {{*each-list $k => $v}}
        <tr data-key="{{$k}}">
            <td><input type="text" class="form-control edit e-val"  readonly value="{{$k}}"/> </td>
            <td><input type="text" class="form-control edit e-attr" value="{{$v}}"/> </td>
            <td class="action"><button class="btn btn-default del" type="button" data-url="{{:url /del?cl=[$k]&key=[$k]}}">Del</button></td>
        </tr>
        {{@endeach}}
    </tbody>
</table>
<?php }else{ ?>
<p>{{__("please-select")}}</p>
<?php } ?>