{{@layout layout/base, layout/base-ajax}}

<table class="table table-light">
    <colgroup style="width:10em">
    <tbody>
        <tr><th>{{__("name")}}</th><td>{{*name}}</td></tr>
        <tr><th>{{__("email")}}</th><td>{{*email}}</td></tr>
        <tr><th>{{__("cate")}}</th><td>{{*cl_name}}</td></tr>
        <tr><th colspan="2">{{__("email.body")}}</th></tr> 
        <tr><td colspan="2" style="padding-left:2em;"><pre>{{*body}}</pre></td></tr>
    </tbody>
</table>
<div class="margin-sm">
    <small>{{*created_at}}<br>IP:{{*ip}}<br>UA:{{*user_agent}}</small>
</div>

<div class="tb-row">
    <div class="tb-cell-r">
        {{@require layout/asset/modal-close}}
    </div>
</div>