{{@if Auth::hasRole('dev') }}
<div class="-x-dev-print">
    {{@code $rid = rand() }}
    <a data-toggle="collapse" href="#hist-{{$rid}}" role="button" aria-expanded="false" aria-controls="collapseExample">[...]</a>
    <div class="collapse" id="hist-{{$rid}}">
        <hr>
        <p>TIME: {{_X_RESPONSE_TIME()}} sec</p>
        <p>MEM: <?php echo memory_get_usage() / (1024 * 1024)."MB"; ?> (<?php echo memory_get_peak_usage() / (1024 * 1024)."MB"; ?> )</p>
        <hr>
        <p><?php echo Request::getMethod(); ?>: <?php print_r(Request::getFormValues()); ?></p>
        <?php if(ErrorStack::has()){ echo "<hr>"; } ?>
        <pre>{{ErrorStack::echoAll()}}</pre>
        <?php if(HistoryStack::has()){ echo "<hr>"; } ?>
        <pre>{{HistoryStack::echoAll()}}</pre>
    </div>
</div>
{{@endif}}