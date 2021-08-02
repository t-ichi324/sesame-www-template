{{@layout layout/base}}
<?php
    $f = Form::getFormObject();
    $f instanceof DbTblListForm;
    $p = "?sch_id=".$f->sch_id;
    
    $tbls = array();
    $views = array();
    foreach(Form::get("list",array()) as $e){
        $dt = [
                "name"=>$e->phy_name, 
                "log"=>$e->log_name, 
                "comment"=>$e->comment, 
                "p"=> $p."&tbl_id=".$e->tbl_id
            ];
        if(!Flags::isON($e->is_view)){
            $tbls[] = $dt;
        }else{
            $views[] = $dt;
        }
    }
?>
<div class="tb-row">
    <div class="tb-cell">
    </div>
    <div class="tb-cell-r">
        <a class="btn btn-primary" href="{{:url add/[$p]}}">{{__("newadd")}}</a>
        <a class="btn btn-primary" href="{{:url imjson/[$p]}}">fromJSON</a>
    </div>
</div>
<table class="table">
    <?php if(!empty($tbls)){ ?>
    <thead>
        <tr>
            <th colspan="4">TABLES</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tbls as $r){ 
            $p = $r["p"]; ?>
        <tr>
            <td><a href="{{:url edit/[$p]}}">{{$r["name"]}}</a></td>
            <td>{{$r["log"]}}</td>
            <td>{{$r["comment"]}}</td>
            <td>
                <a href="{{:url del/[$p]}}" class="ajax-modal" data-title="{{__("delete")}}"><i class="fa fa-trash-o"></i></a>
                <a href="{{:url exjson/[$p]}}" style="margin-left: 1rem;">JSON</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <?php } ?>
    <?php if(!empty($views)){ ?>
    <thead>
        <tr>
            <th colspan="4">VIEWS</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($views as $r){ 
            $p = $r["p"]; ?>
        <tr>
            <td><a href="{{:url edit/[$p]}}">{{$r["name"]}}</a></td>
            <td>{{$r["log"]}}</td>
            <td>{{$r["comment"]}}</td>
            <td>
                <a href="{{:url del/[$p]}}" class="ajax-modal" data-title="{{__("delete")}}"><i class="fa fa-trash-o"></i></a>
                <a href="{{:url exjson/[$p]}}" style="margin-left: 1rem;">JSON</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <?php } ?>
</table>

<div class="tb-row margin-md-top">
    <div class="tb-cell">
        <a href="{{:url gen-entity}}" class="btn btn-info">Entity.php.zip</a> 
        <a href="{{:url gen-create}}" class="btn btn-info">CreateSql.zip</a> 
        <a href="{{:url gen-xmlsql}}" class="btn btn-info">Sql.xml.zip</a>
    </div>
    <div class="tb-cell-r">
    </div>
</div>
