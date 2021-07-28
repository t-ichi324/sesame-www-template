{{@layout layout/base}}

<p>{{__("system.menu")}}</p>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url log}}">{{__("system.menu-log")}}</a></div>
            <div class="card-body">{{__("system.desc-log")}}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url /log/db}}">{{__("system.menu-log-db")}}</a></div>
            <div class="card-body">{{__("system.desc-log-db")}}</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url /kv}}">{{__("system.menu-kv")}}</a></div>
            <div class="card-body">{{__("system.desc-log")}}</div>
        </div>
    </div>
    <!---
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url /lang}}">{{__("system.menu-lang")}}</a></div>
            <div class="card-body">{{__("system.desc-lang")}}</div>
        </div>
    </div>
    -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url sitemap}}">{{__("system.menu-sitemap")}}</a></div>
            <div class="card-body">{{__("system.desc-log")}}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url fver}}">{{__("system.menu-fver")}}</a></div>
            <div class="card-body">{{__("system.desc-fver")}}</div>
        </div>
    </div>
    <?php if(Auth::hasRole("dev")){ ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url dump}}">{{__("system.menu-dump")}}</a></div>
            <div class="card-body">{{__("system.desc-dump")}}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url cache}}">{{__("system.menu-cache")}}</a></div>
            <div class="card-body">{{__("system.desc-cache")}}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url db}}">{{__("system.menu-db")}}</a></div>
            <div class="card-body">{{__("system.desc-db")}}</div>
        </div>
    </div>
    <?php } ?>
</div>
<hr>
<p>ENV: <span style="color:#007bff;">{{Env::name();}}</span></p>
<p>TIME-ZONE: <span style="color:#007bff;">{{date_default_timezone_get()}} @ {{now()}}</span></p>
<p>SESSION-TIMEOUT: <span style="color:#007bff;"><?= ini_get("session.gc_maxlifetime")."sec"; ?></span></p>