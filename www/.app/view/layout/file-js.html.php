<!--minify-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="{{/js/common.js}}{{vCSS()}}" crossorigin="anonymous"></script>
<script src="{{/js/ajax.js}}{{vCSS()}}" crossorigin="anonymous"></script>
<script src="{{/js/site.js}}{{vCSS()}}" crossorigin="anonymous"></script>
<?php if(Auth::check()){ ?>
<script src="{{/js/modal.js}}{{vCSS()}}" crossorigin="anonymous"></script>
<script src="{{/api/auth/keep.js}}{{vCSS()}}" crossorigin="anonymous"></script>
<?php } ?>
