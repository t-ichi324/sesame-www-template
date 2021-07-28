<!--minify-->
{{@if-not-ajax}}
<?php
    $breadcrumb = Meta::get_breadcrumb();;
    if(!empty($breadcrumb)){
?>
<nav aria-label="breadcrumb" class="nav-title">
<ol class="breadcrumb">
<?php
    $mx = count($breadcrumb) - 1;
    foreach ($breadcrumb as $i => $r){
        $title = $r["title"];
        $url = $r["url"];
        if($title == Conf::SITE_HOME_NAME){ $title = __("home"); }
        if($i >= $mx){
?>
<li class="breadcrumb-item" aria-current="page"><h1>{{$title}}</h1></li>
<?php }else{ ?>
<li class="breadcrumb-item"><a href="{{$url}}">{{$title}}</a></li>
<?php }} ?>
</ol></nav>
<?php } ?>
{{@endif}}