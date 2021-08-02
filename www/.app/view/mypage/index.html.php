{{@layout layout/base}}

{{@sec css}}
<style>
    td.lbl{width: 20%; max-width: 10em; font-weight: 600; color: #10707f; }
</style>
{{@endsec}}

<p>{{__("prof.menu-info")}}</p>
<table class="table margin-sm-bottom">
    <tbody>
        <tr>
            <td class="lbl">{{__("prof.name")}}</td>
            <td>{{*name}}</td>
        </tr>
        <tr>
            <td class="lbl">{{__("prof.company")}}</td>
            <td>{{*company}}</td>
        </tr>
        <tr>
            <td class="lbl">{{__("prof.email")}}</td>
            <td>{{*email}}</td>
        </tr>
        <tr>
            <td class="lbl">{{__("prof.role")}}</td>
            <td>{{*roles_name}}</td>
        </tr>
        <tr>
            <td class="lbl">{{__("prof.expired")}}</td>
            <td>{{*expired}}</td>
        </tr>
    </tbody>
</table>

<p>{{__("menu")}}</p>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{:url /edit}}">{{__("prof.menu-edit")}}</a></div>
            <div class="card-body">{{__("prof.desc-edit")}}</div>
        </div>
    </div>
    <div class="col-md-4">
        
        <div class="card">
            <div class="card-header"><a href="{{:url /pw}}">{{__("prof.menu-pw")}}</a></div>
            <div class="card-body">{{__("prof.desc-pw")}}</div>
        </div>
    </div>
</div>
