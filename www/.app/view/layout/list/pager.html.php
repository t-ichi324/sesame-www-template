<!--minify-->
{{*if-has-list}}
<?php
    $f = Form::getFormObject();
    $offset = 10;
    $max = $f->getMaxPage();
    $url = Meta::get_url();
?>
    {{@if $max>1}}
    <ul class="pagination justify-content-center mt-4">
        <li class="page-item top"><a title="{{__("to-first-page")}}"  href="{{Url::get($url, $f->getPagerQuery(1))}}" class="page-link" data-p="1">≪</a></li>
        <?php foreach($f->getPagerList('active disabled', 10) as $i => $v): ?>
        <li class="page-item {{$v}}">
            <a href="{{Url::get($url, $f->getPagerQuery($i))}}" class="page-link" data-p="{{$i}}">{{$i}}</a>
        </li>
        <?php endforeach; ?>
        <li class="page-item last"><a title="{{__("to-last-page")}}" href="{{Url::get($url, $f->getPagerQuery($max))}}" class="page-link" data-p="{{$max}}">≫</a></li>
    </ul>
    {{@endif}}
{{@endif}}