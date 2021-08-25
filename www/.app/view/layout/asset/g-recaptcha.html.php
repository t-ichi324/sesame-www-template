<?php
$public_key = AppKv::getVal("g-recaptcha", "public-key");
if(!empty($public_key)){
?>
{{@sec css}}<script src='https://www.google.com/recaptcha/api.js'></script>{{@endsec}}
<div class="g-recaptcha" data-sitekey="{{$public_key}}"></div>
<?php } ?>