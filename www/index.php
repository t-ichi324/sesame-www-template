<?php
    /* If you change the core file, please change loader.php name */
    $sys = __DIR__."/../../.sesame/init.php";
    if(file_exists($sys)){
        include_once $sys; 
        Sesame::setConfig(__DIR__."/.app/conf.php");
        Sesame::Run();
    }else{
        echo "<h1>500 internal server error.</h1>";
        echo "<p>System cannot be loaded.</p>";
    }
?>