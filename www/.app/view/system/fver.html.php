{{@layout layout/base}}

<form method="post">
    <table>
        <tr>
            <td>CSS</td><td><input type="text" class="form-control fver" <?php FormEcho::attr_nameVal("ver_css"); ?>></td>
        </tr>
        <tr>
            <td>JS</td><td><input type="text" class="form-control fver" <?php FormEcho::attr_nameVal("ver_js"); ?>></td>
        </tr>
        <tr>
            <td style="text-align: right" colspan="2"><button class="btn btn-default" type="button" id="auto">AUTO</button></td>
        </tr>
    </table>
    <hr>
    <button class="btn btn-primary">OK</button>
</form>
<hr>
<div>
１月　January →　a.<br>
２月　February →　b.<br>
３月　March →　c.<br>
４月　April →　d.<br>
５月　May →　e.<br>
６月　June →　f.<br>
７月　July →　g.<br>
８月　August →　h.<br>
９月　September →　i. <br>
10月　October →　j.<br>
11月　November →　k.<br>
12月　December →　l.<br>
+ day
</div>

{{@sec js}}
<script>
    var def = ["a","b","c","d","e","f","g","h","i","j","k","l"];
    $('#auto').click(function (){
        var today = new Date();
        var m = today.getMonth();
        var d = today.getDate();
        var mx = def[m];
        var fver = mx + "" + d;
        
        $('input.fver').val(fver);
    });
</script>
{{@endsec}}