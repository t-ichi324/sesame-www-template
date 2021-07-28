{{@layout layout/base}}

{{@sec css}}
<style>
    .tip{
        background-color: #eee;
        padding: 1rem;
    }
    .red{
        color: #f00;
    }
</style>
{{@endsec}}

<div class="tip">
    <p>1. Create Html</p>
    <p>/.app/view/sandbox/<span class="red">[anyname].html.php</span></p>

    <p>2. Enter Url</p>
    <p>{{/sandbox}}/<span class="red">[anyname]</span></p>
</div>

<table class="table">
<tbody>
{{@each Model::get("pages") as $p}}
<tr>
    <td>{{$p}} - .app/viww/sandbox/{{$p}}.html.php</td>
    <td><a href="{{/sandbox}}/{{$p}}">Open</a></td>
    <td><a href="{{/sandbox}}/{{$p}}?breadcrumb=on"> Open(breadcrumb)</a></td>
</tr>
{{@endeach}}
</tbody>
</table>
