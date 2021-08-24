{{@sec css}}
<link href="{{/css/trix.css}}" rel="stylesheet">
<style>
    trix-editor{
        min-height: 20em;
    }
</style>
{{@endsec}}

<form action="{{@url}}" id="edtor-form" method="post">
    <div class="row">
        <div class="col-md-9">
            <input type="text" class="form-control" id="send-title" <?php FormEcho::attr_nameVal("title"); ?> placeholder="Post title"/>
            <hr>
            <div class="edit-wraxp">
                <trix-editor id="trix-editor" input="send-content"></trix-editor>
            </div>
            <hr>
            <div class="tb-row">
                <div class="tb-cell"><label>Description</label></div>
                <div class="tb-cell-r"><button type="button" class="btn btn-default" id="btn-auto-description">Auto Create</button></div>
            </div>
            <textarea class="form-control" id="send-desc" name="description">{{*description}}</textarea>
        </div>

        <div class="col-md-3">
            <div style="text-align: right;">
                <button type="submit" id="edit-save" class="btn btn-primary">{{__("save")}}</button>
            </div>
            <hr>
            <label>Status / Category</label>
            <select class="form-control" name="status">
                <?php FormEcho::tag_option("status",  0, __("private")) ?>
                <?php FormEcho::tag_option("status",  1, __("public")) ?>
            </select>
            <select class="form-control" name="cl">
                <?php foreach (AppKv::keyVal("app_post_cl") as $k => $v){ FormEcho::tag_option("cl", $k, $v); } ?> 
            </select>
            <hr>
            <label>OG:Image</label>
            <?php AsyncUploadImg::rendForm("tmp_name", "img", ContentConf::DIR_POST, ContentConf::NO_IMAGE); ?>
        </div>
    </div>
    <input type="hidden" id="send-content" <?php FormEcho::attr_nameVal("content"); ?>>
    <?php FormEcho::tag_hidden("id"); ?>
</form>

{{@sec js}}
<script src="{{/js/trix.js}}"></script>
<script>
$('#btn-auto-description').click(function(){
    $('#send-desc').val( $('#trix-editor').text() );
});

(function() {
  var HOST = "{{:action}}/attachment";
  
  addEventListener("trix-attachment-add", function(event) {
    if (event.attachment.file) {
      uploadFileAttachment(event.attachment)
    }
  })

  function uploadFileAttachment(attachment) {
    uploadFile(attachment.file, setProgress, setAttributes)

    function setProgress(progress) {
      attachment.setUploadProgress(progress)
    }

    function setAttributes(attributes) {
      attachment.setAttributes(attributes)
    }
  }

  function uploadFile(file, progressCallback, successCallback) {
    var formData = createFormData(file)
    var xhr = new XMLHttpRequest()

    xhr.open("POST", HOST, true)

    xhr.upload.addEventListener("progress", function(event) {
      var progress = event.loaded / event.total * 100
      progressCallback(progress)
    })

    xhr.addEventListener("load", function(event) {
      if (xhr.status == 200) {
        var json = JSON.parse(xhr.responseText);
        if(json.err == 0){
            var attributes = {
              url: json.url,
              href:json.url + "?content-disposition=attachment"
            }
            successCallback(attributes)
        }
      }
    })
    xhr.send(formData)
  }
  function createFormData(file) {
    var data = new FormData()
    data.append("Content-Type", file.type)
    data.append("file", file)
    return data
  }
})();
</script>
{{@endsec}}
