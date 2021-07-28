{{@layout layout/base-error, layout/base-ajax}}
<div class="row">
    <div class="col-md-12 mx-auto">
        <h2>{{Model::get("code", 500)}} {{Model::get("em1", __("error.default"))}}</h2>
        <p>{{Model::get("em2", __("error.default-msg"))}}</p>
        <hr>
        <a href="{{/}}">{{__("to-home")}}</a>
    </div>
</div>