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
        <a class="" href="{{@url add/[$p]}}">(+)</a>
    </div>
</div>
<?php if(!empty($tbls)){ ?>
<table class="table">
    <thead>
        <tr>
            <th colspan="1">TABLES</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tbls as $r){ 
            $p = $r["p"]; ?>
        <tr>
            <td><a href="{{@url edit/[$p]}}">{{$r["name"]}}</a></td>
        </tr>
        <?php } ?>
    </tbody>
<?php } ?>
<?php if(!empty($views)){ ?>
    <thead>
        <tr>
            <th colspan="1">VIEWS</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($views as $r){ 
            $p = $r["p"]; ?>
        <tr>
            <td><a href="{{@url edit/[$p]}}">{{$r["name"]}}</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>  
<?php } ?>
