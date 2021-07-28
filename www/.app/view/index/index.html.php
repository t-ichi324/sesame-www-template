{{@layout layout/base}}

{{@sec css}}
<style>
</style>
{{@endsec}}

<h1 class="margin-sm">{{Conf::SITE_NAME}}</h1>

<p><a href="{{/sandbox}}">SandBox</a></p>


<nav class="navbar-expand-md fixed-bottom navbar-light bg-light" id="nav-foot">
    <ul style="display: flex; list-style: none;">
        <li style="margin: .5em;"><a href="{{/about}}">{{__("menu-about")}}</a> </li>
        <li style="margin: .5em;"><a href="{{/terms}}">{{__("menu-terms")}}</a> </li>
        <li style="margin: .5em;"><a href="{{/privacy}}">{{__("menu-privacy")}}</a> </li>
    </ul>
</nav>