{{@layout layout/base}}

<strong style="color:#f00;font-size:1.5em;">
<p>{{__("warning")}}!</p>
<p>{{__("system.dump-note")}}</p>
</strong>
<br>
<form action="{{:url}}" method="post" style="margin-bottom: 40px">
    <button type="submit">{{__("system.run-backup")}}</button><label style="margin-left: 20px"><input type="checkbox" value="1" required> {{__("agree")}}</label>
</form>
<hr>
<a data-toggle="collapse" href="#dumps-hist" role="button" aria-expanded="false"><strong>{{__("system.pre-backup")}}</strong></a>
<div class="collapse" id="dumps-hist" >
    {{@if Model::isEmpty("dumps")}}
    <small>{{__("msg-list-notfound")}}<small>
    {{@else}}
    <small>
    {{__("system.dump-tip1")}}<br>
    {{__("system.dump-tip2")}}
    </small>
    {{@endif}}
    <ul style="padding-top: 20px">
    {{@each Model::get("dumps") as $n}}
    <li><a href="{{:url /download?n=[$n]}}">{{$n}}</a></li>
    {{@endeach}}
    </ul>
</div>