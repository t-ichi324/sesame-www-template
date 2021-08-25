<?php
$gid = AppKv::getVal("g-analytics", "gid");
if(!empty($gid)){
?>
{{@sec css}}
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-{{$gid}}"></script>
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '{{$gid}}'); </script>
{{@endsec}}
<?php } ?>