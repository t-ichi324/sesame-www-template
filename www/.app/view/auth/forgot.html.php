{{@layout layout/base}}

<div class="row">
    <div class="{{col_sm_class()}}">
        <div class="guide">
            <p>{{__("auth.forgot-msg1")}}</p>
            <p>{{__("auth.forgot-msg2")}}</p>
        </div>
        <form method="post">
            <div class="margin-sm">
                <input type="email" class="form-control" <?php FormEcho::attr_nameVal("email") ?> placeholder="{{__("email")}}" required autofocus />
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">{{__("submit")}}</button>
            <?php FormEcho::tag_csrfToken(); ?>
        </form>
        <div class="guide-bottom center">
            <a class="btn btn-link" href="{{/auth}}">{{__("to-login")}}</a><br>
        </div>
    </div>
</div>