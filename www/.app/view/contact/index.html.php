{{@layout layout/base}}

{{@sec css}}
<?php if(Env::isReal()){ ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php } ?>
{{@endsec}}

<div class="row">
    <div class="{{col_md_class()}}">
        <form action="{{/contact/}}" method="post">
            <div class="form-group">
                <label>{{__("name")}}</label>
                <input class="form-control" type="text" <?php FormEcho::attr_nameVal("name"); ?> required>
            </div>
            <div class="form-group">
                <label>{{__("email")}}</label>
                <input class="form-control" type="email" <?php FormEcho::attr_nameVal("email"); ?> required>
            </div>
            
            <div class="form-group">
                <label>{{__("cate")}}</label>
                <select class="form-control" name="cl" required>
                    <?php
                        foreach (ContactUtil::CL_MASTER() as $k=>$v){
                            FormEcho::tag_option("cl", $k, $v);
                        }
                    ?>
                </select>            
            </div>
            
            <div class="form-group">
                <label>{{__("etc.contact-body")}}</label>
                <textarea class="form-control" rows="6" <?php FormEcho::attr_name("body"); ?> required>{{*body}}</textarea>
            </div>
            
            <div class="checkbox margin-sm">
                <?php if(Env::isReal()){ ?>
                <div class="g-recaptcha" data-sitekey="{{AppKv::getVal("recaptcha", "public-key")}}"></div>
                <?php } ?>
            </div>
            <div class="tb-row">
                <div class="tb-cell-r">
                    <button class="btn btn-primary" type="submit">{{__("submit")}}</button>
                </div>
            </div>
            <?php FormEcho::tag_csrfToken(); ?>
        </form>
    </div>
</div>