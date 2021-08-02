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

<table class="table">
<tbody>
{{@each Model::get("pages") as $p}}
<tr>
    <td><a href="{{:url $p}}">{{$p}}</a></td>
</tr>
{{@endeach}}
</tbody>
</table>
