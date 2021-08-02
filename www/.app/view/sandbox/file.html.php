{{@layout layout/base}}

{{@sec css}}
<style>
    #dragarea{
        background-color: #fafafa;
        padding: 2rem;
        border: 3px dotted #bbb;
        text-align: center;
    }
    #dragarea.dragover{
        border-color: #66f;
    }
</style>
{{@endsec}}

<h2>FileUpload</h2>
<p>this is test page.</p>

<table id="uploads" class="table">
    <tbody>
    </tbody>
</table>

<div id='dragarea'>Please Drop Here</div>

<p>
    hello,
</p>
<p>
please drp@
</p>
{{@sec js}}
<script src="{{/js/upload.js}}" crossorigin="anonymous"></script>
<script>
    upload.init('{{/api/upload}}', 'dragarea', function(ret){
        try{
            var json = JSON.parse(ret);
            if(json.err == 0){
                var tr = "<tr><td><input value="+json.tmp_name+"></td><td>"+json.name+"</td><td>";
                if(json.ext == ".jpg" || json.ext == ".jpeg" || json.ext == ".png"){
                    tr += "<img style='max-width:50px;' src='"+json.tmp_url+"'>";
                }
                tr += "</td></tr>";
                $('#uploads tbody').append(tr);
            }
            upload.close();
        }catch(ex){
            upload.showError("Error!!");
        }
    });
</script>
{{@endsec}}