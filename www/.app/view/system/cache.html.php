{{@layout layout/base}}

<style>
    form.cc{
        margin-bottom: 1em;
        padding-bottom: 1em;
        border-bottom: 1px solid #eee;
    }
    form.cc h2{
        font-size: 1.5rem;
        border-left: 5px solid #00f;
        padding-left: 1em;
    }
</style>

<form method="post" class="cc tb-row">
    <h2 class="tb-cell">view{{__("cache")}}</h2>
    <div class="tb-cell-r">
        <input type="hidden" name="op" value="view">
        <button type="submit" class="btn btn-default">{{__("clear")}}</button>
    </div>
</form>

<form method="post" class="cc tb-row">
    <h2 class="tb-cell">route{{__("cache")}}</h2>
    <div class="tb-cell-r">
        <input type="hidden" name="op" value="route">
        <button type="submit" class="btn btn-default">{{__("clear")}}</button>
    </div>
</form>
