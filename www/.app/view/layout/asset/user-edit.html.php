<?php AsyncUploadImg::rendForm("tmp_name", "img", ContentConf::DIR_USER, ContentConf::NO_AVATAR); ?>
<hr>

<label class="required">{{__("prof.name")}}</label>
<input class="form-control" type="text" required maxlength="100" <?php FormEcho::attr_nameVal("name"); ?> placeholder="{{__("prof.name-ex")}}"/>
<label class="required">{{__("prof.email")}}</label>
<input class="form-control" type="email" required maxlength="50" <?php FormEcho::attr_nameVal("email"); ?> />

<label class="required-none">{{__("prof.zipcode")}}</label>
<input class="form-control" type="text" <?php FormEcho::attr_nameVal("zip_code"); ?> />
<label class="required-none">{{__("prof.addr")}}</label>
<input class="form-control" type="text" <?php FormEcho::attr_nameVal("addr1"); ?> />

<label class="required-none">{{__("prof.tel")}}</label>
<input class="form-control" type="tel" valid="tel" maxlength="13" style="max-width: 13em"  <?php FormEcho::attr_nameVal("tel"); ?> />
