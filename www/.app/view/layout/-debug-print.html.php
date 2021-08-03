{{@if Auth::hasRole('dev') }}
<div class="-x-dev-print">
    <?php
        $hasErr = ErrorStack::has(); 
        $hasTrack = HistoryStack::has();
        $err_style = ($hasErr ? " style='color:#f00;'" : "");
    ?>
    {{@code $rid = rand() }}
    <a data-toggle="collapse" href="#hist-{{$rid}}" role="button" aria-expanded="false" aria-controls="collapseExample"<?= $err_style; ?>>[...]</a>
    <div class="collapse" id="hist-{{$rid}}">
        <hr>
        <p>TIME: {{_X_RESPONSE_TIME()}} sec</p>
        <p>MEM: <?php echo memory_get_usage() / (1024 * 1024)."MB"; ?> (<?php echo memory_get_peak_usage() / (1024 * 1024)."MB"; ?> )</p>
        <hr>
        <p><?php echo Request::getMethod(); ?>: <?php print_r(Request::getFormValues()); ?></p>
        <?php if($hasErr){ echo "<hr>"; } ?>
        <pre<?= $err_style; ?>>{{ErrorStack::echoAll()}}</pre>
        <?php if($hasTrack){ echo "<hr>"; } ?>
        <pre>{{HistoryStack::echoAll()}}</pre>
    </div>
</div>
{{@endif}}