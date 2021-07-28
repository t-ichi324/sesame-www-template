{{@layout layout/base, layout/base-ajax}}
{{@sec css}}
<style>
    .mail-tmp{ background-color: #eee; padding: 1em;margin-bottom: 1em; }
</style>
{{@endsec}}

<?php $f = Form::getFormObject(); ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <p>[ {{__("register")}} {{__("info")}} ]</p>
        <table class="table">
            <tbody>
                <tr><td>{{__("prof.name")}}</td><td>{{*name}}</td></tr>
                <tr><td>{{__("prof.email")}}</td><td>{{*to}}</td></tr>
                <tr><td>{{__("prof.password")}}</td><td>{{*password}}</td></tr>
            </tbody>
        </table>
    </div>
</div>

{{@if $f->has_template}}
<div class="row">
    <div class="col-md-8 mx-auto">
        <hr>
        <br>
        <p>{{__("email.to")}}</p>
        <div class="mail-tmp"><a href="mailto:{{*to}}">{{*to}}</a></div>
        <p>{{__("email.subject")}}</p>
        <div class="mail-tmp">{{*subject}}</div>
        
        <p>{{__("email.body")}}</p>
        <div><pre class="mail-tmp">{{*body}}</pre></div>
        
        
        <div class="tb-row">
            <div class="tb-cell">
                <form action="{{/admin/user/send-email}}" method="post">
                    <?php FormEcho::tag_hidden("_src"); ?>
                    <button class="btn btn-primary">{{__("sendmail")}}</button>
                </form>
            </div>
            <div class="tb-cell-r">
                <form action="{{/admin/user/save-email}}" method="post">
                    <?php FormEcho::tag_hidden("_src"); ?>
                    <button class="btn btn-default">{{__("download")}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{@endif}}