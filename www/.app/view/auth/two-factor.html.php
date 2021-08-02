{{@layout layout/base}}
<div class="row">
    <div class="{{col_xs_class()}}">
        <form method="post">
            <div class="margin-md text-center">
                <h2>{{__("auth.2fa")}}</h2>
            </div>
            <div class="margin-sm margin-md-top">
                <input type="number" class="form-control" name="token" value="" placeholder="{{__("auth.2fa-msg")}}">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">{{__("submit")}}</button>
            <?php FormEcho::tag_hidden("key"); ?>
            <?php FormEcho::tag_hidden("r"); FormEcho::tag_csrfToken(); ?>
        </form>
        <div class="guide-bottom center">
            <a class="btn btn-link" href="{{/auth}}">{{__("to-login")}}</a><br>
        </div>
    </div>
</div>
