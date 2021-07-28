<!--minify-->
{{@if Message::has()}}
{{@code $cflg = Message::isCloseable(); }}
{{@if Message::hasInfo()}}
<div class="alert alert-success" role="alert">
    {{@if $cflg}}<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>{{@endif}}
    <ul class="msg">{{@each Message::getInfo() as $__m}}<li>{{$__m}}</li>{{@endeach}}</ul>
</div>
{{@endif}}
{{@if Message::hasSuccess()}}
<div class="alert alert-info" role="alert">
    {{@if $cflg}}<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>{{@endif}}
    <ul class="msg">{{@each Message::getSuccess() as $__m}}<li>{{$__m}}</li>{{@endeach}}</ul>
</div>
{{@endif}}
{{@if Message::hasWarning()}}
<div class="alert alert-warning" role="alert">
    {{@if $cflg}}<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>{{@endif}}
    <ul class="msg">{{@each Message::getWarning() as $__m}}<li>{{$__m}}</li>{{@endeach}}</ul>
</div>
{{@endif}}
{{@if Message::hasError()}}
<div class="alert alert-danger" role="alert">
    {{@if $cflg}}<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>{{@endif}}
    <ul class="msg">{{@each Message::getError() as $__m}}<li>{{$__m}}</li>{{@endeach}}</ul>
</div>
{{@endif}}
<?php Message::clearAll(); ?>
{{@endif}}
