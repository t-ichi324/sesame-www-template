<!--minify-->
<div id="to-page-top" style="display: none;">
    <a href="#" title="{{__("to-page-top")}}"><i class="fa fa-arrow-up"></i></a>
</div>

{{@sec js}}
<script>
$(window).scroll(function () {
    if ($(window).scrollTop() > 200) {
        $('#to-page-top').fadeIn();
    }else{
        $('#to-page-top').fadeOut();
    }
});
$('#to-page-top').click(function(){
    $('body,html').animate({
        scrollTop: 0
    }, 250);
    return false;
});
</script>
{{@endsec}}