{{@layout layout/base, layout/base-ajax}}

<div class="tb-row">
    <div class="tb-cell">
        <ul>
            <li><a href="{{/sitemap.xml}}" target="_blank">sitemap.xml</a></li>
            <li><a href="{{/robots.txt}}" target="_blank">robots.txt</a></li>
        </ul>
    </div>
    <div class="tb-cell-r">
        <a href="{{@url /add}}" class="btn btn-primary ajax-modal">ADD</a>
    </div>
</div>

<div id="ajax-list">{{@require-vp -list}}</div>

{{@sec js}}
<script>
    function refreshList(){ $('#x-reflesh-form').submit(); }
</script>
{{@endsec}}