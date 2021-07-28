<!--minify-->
<?php
$id = "x-reflesh-form";
$rep = Model::get("__list_addon_replacetarget__");
$url = Model::get("__list_addon_url__");
$rend = StringUtil::isNotEmpty($rep) && StringUtil::isNotEmpty($url);
if($rend){
    echo FormEcho::tag_refresh_form($url, $rep, $id);
}
?>
{{@section js}}
<?php
if($rend){
    echo "<script>";
    echo "function refreshList(){ $('#".$id."').submit();}";
    echo "function closeModal(){refreshList(); modal.close();}";
    echo "</script>";
}
?>
{{@endsection}}
