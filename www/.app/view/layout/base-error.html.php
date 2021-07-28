<!DOCTYPE html>
<html lang="{{__("html-lang")}}">
<head>
{{@require layout/meta}}
{{@require layout/file-css}}
{{@yield css}}
</head>
<body class="pb-5">
{{@require layout/header}}
<div class="container pt-3">
{{@yield contents}}
{{@require layout/-debug-print}}
</div>
{{@require layout/footer}}
{{@require layout/file-js}}
{{@yield js}}
</body>
</html>