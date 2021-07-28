<!--minify-->
<nav class="navbar navbar-expand-md navbar-light bg-light" id="nav-head">
    <a class="navbar-brand" href="{{/}}">
        <!--
        <img src="{{/img/logo.png}}" class="logo-img">
        -->
        <span class="logo-text">{{Conf::SITE_NAME}}</span>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-top" aria-expanded="false" aria-controls="nav-top">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav-top">
        <ul class="navbar-nav ml-auto">
            {{@if Auth::hasRole("admin")}}
            <li class="nav-item"><a class="nav-link" href="{{/admin}}">[ADMIN]</a></li>
            {{@endif}}
            {{@if Auth::check()}}
            <li class="nav-item"><a class="nav-link" href="{{/home}}">{{__("home")}}</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::getVal("name")}}</a>
                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="{{/home}}">{{__("home")}}</a>
                     <a class="dropdown-item" href="{{/mypage}}">{{__("mypage")}}</a>
                     <a class="dropdown-item" href="{{/contact}}">{{__("contact")}}</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="{{/logout}}">{{__("logout")}}</a>
                   </div>
                </li>
            {{@else}}
            <li class="nav-item"><a class="nav-link" href="{{/register}}">{{__("register")}}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{/auth}}">{{__("login")}}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{/contact}}">{{__("contact")}}</a></li>
            {{@endif}}
        </ul>
    </div>
</nav>