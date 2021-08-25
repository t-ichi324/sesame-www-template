<!DOCTYPE html>
<html lang="{{__("html-lang")}}">
<head>
{{@require layout/meta}}
{{@require layout/file-css}}
{{@require layout/asset/g-analytics}}
{{@yield css}}
</head>
<body class="pb-5">
{{@require layout/header}}
<div class="container pt-3 pb-3">
{{@yield title}}
{{@require layout/breadcrumb}}
{{@require layout/alerts}}
{{@yield contents}}
{{@require layout/-debug-print}}
</div>
{{@require layout/footer}}
{{@require layout/file-js}}
{{@yield js}}
</body>
</html>