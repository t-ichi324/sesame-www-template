{{@layout layout/base}}

<div class="row">
    <div class="{{col_sm_class()}}">
        <p><?php echo h(Model::get("msg"));?></p>
        <p>{{__("auth.please-check-mailbox")}}</p>
        <div class="guide-bottom center">
            <a class="btn btn-link" href="{{/auth}}">{{__("to-login")}}</a><br>
        </div>
    </div>
</div>