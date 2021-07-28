{{@layout layout/base, layout/base-ajax}}

{{@sec css}}
<style>
    #f-user label{
        margin-top: 0.5em;
        margin-bottom: 0.2em;
    }
</style>
{{@endsec}}

<form method="post" id="f-user" <?php if(Request::isAjax()){?>class="ajax-modal-form" data-ajax-callback="refreshList();" <?php } ?>>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <label class="required">{{__("prof.role")}}</label>
            <div>
                <select class="form-control" name="roles">
                    <?php foreach (UserUtil::ROLE_MASTER() as $k => $v){
                        FormEcho::tag_option("roles", $k, $v);
                    }  ?>
                </select>
            </div>
            
            <label>{{__("prof.expired")}}</label>
            <div class="input-group">
                <span class="input-group-text">{{__("start")}}</span>
                <input class="form-control" id="term_start" type="date" <?php FormEcho::attr_nameVal("term_start"); ?>/>
                <span class="input-group-text">{{__("end")}}</span>
                <input class="form-control" id="term_end" type="date" <?php FormEcho::attr_nameVal("term_end"); ?>/>
            </div>
            <small>{{ __("admin.tip-date") }}</small>
            <hr>
            
            {{@require layout/asset/user-edit}}
            
            <hr>
            <label class="required">{{__("password")}}</label>
            <input class="form-control" type="tel" maxlength="20" autocomplete="off" required <?php FormEcho::attr_nameVal("pw"); ?>/>
            <small class="input-guide"><?= Validator::PASSWORD_GUIDE(); ?></small><br>
            <label class="required">{{__("password-cnf")}}</label>
            <input class="form-control" type="tel" maxlength="20" autocomplete="off" required <?php FormEcho::attr_nameVal("confirm"); ?>/>


            <hr class="margin-sm">
            <div class="tb-row">
                <div class="tb-cell-r">
                    <button type="submit" class="btn btn-primary">{{__("register")}}</button>
                    {{@require layout/asset/modal-close}}
                </div>
            </div>
        </div>
    </div>
</form>
