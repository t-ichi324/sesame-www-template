{{@layout layout/base}}

<form method="post" >
    <table class="table">
        <tbody>
        <label>{{__("email.from-addr")}}</label> <span style="color:#66f;margin-left: 1em;">{{__("admin.appmail-note-*", Request::getHost())}}</span>
            <input type="email" class="form-control" <?php FormEcho::attr_nameVal("sender_addr"); ?> required>    
            <label>{{__("email.sender")}}</label>
            <input type="name" class="form-control" <?php FormEcho::attr_nameVal("sender_name"); ?> required>
            <label>{{__("email.subject")}}</label>
            <input type="text" class="form-control" <?php FormEcho::attr_nameVal("subject"); ?> required>
            <label>{{__("email.body")}}</label>
            <span style="color:#66f;margin-left: 1em;">{{__("admin.appmail-hint")}}</span>
            <textarea class="form-control" style="min-height: 320px;" name="body" required><?php FormEcho::text("body"); ?></textarea>
        </tbody>
    </table>
    <hr>
    <div class="a-right">
        <?php FormEcho::tag_hidden("trigger","cl_name","cl_attr"); ?>
        <button class="btn btn-primary" type="submit">{{__("update")}}</button>
    </div>
</form>
