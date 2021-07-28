{{@layout layout/base}}
<p>Account</p>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url user}}">{{ __("admin.menu-user") }}</a></div>
            <div class="card-body">{{ __("admin.desc-user") }}</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url log}}">{{ __("admin.menu-userlog") }}</a></div>
            <div class="card-body">{{ __("admin.desc-userlog") }}</div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url contact}}">{{ __("admin.menu-contact") }}</a>
                {{@if Model::get("contact_nocheck") > 0 }}
                    <span class="badge badge-pill badge-danger float-right">{{Model::get("contact_nocheck")}}</span>
                {{@endif}}
            </div>
            <div class="card-body">{{ __("admin.desc-contact") }}</div>
        </div>
    </div>
</div>

<p>Contents</p>
<div class="row">
    <!--
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{/cms}}">{{ __("admin.menu-cms") }}</a></div>
            <div class="card-body">{{ __("admin.desc-cms") }}</div>
        </div>
    </div>
    -->
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url app-data}}">{{ __("admin.menu-appdata") }}</a></div>
            <div class="card-body">{{ __("admin.desc-appdata") }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{@url app-mail}}">{{ __("admin.menu-appmail") }}</a></div>
            <div class="card-body">{{ __("admin.desc-appmail") }}</div>
        </div>
    </div>
    <?php if(Auth::hasRole("dev")){ ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><a href="{{/system}}">{{ __("admin.menu-system") }}</a></div>
            <div class="card-body">{{ __("admin.desc-system") }}</div>
        </div>
    </div>
    <?php } ?>
</div>
