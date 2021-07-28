{{@layout layout/base}}
<div class="row">
    <div class="{{col_xs_class()}}">
        <form method="post" action="{{/auth}}">
            <div class="margin-md text-center">
                <h2>Login - {{Conf::SITE_NAME}}</h2>
            </div>
            <div class="margin-sm margin-md-top">
                <input type="email" valid="auth" class="form-control" <?php FormEcho::attr_nameVal("loginId"); ?>  placeholder="{{__("email")}}" required autofocus />
                <input type="password" class="form-control" <?php FormEcho::attr_nameVal("password"); ?> placeholder="{{__("password")}}" required />
            </div>
            <div class="margin-sm">
                <label class="checkbox"><input type="checkbox" <?php FormEcho::attr_nameValChecked("remember"); ?>/>{{__("auth.remember")}}</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">{{__("auth.send-login")}}</button>
            <?php FormEcho::tag_hidden("r");FormEcho::tag_csrfToken(); ?>
        </form>
        <div class="guide-bottom center">
            <a class="btn btn-link" href="{{/auth/forgot}}">{{__("auth.to-forgot")}}</a>
            
        </div>
    </div>
</div>
