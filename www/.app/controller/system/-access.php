<?php
Meta::roles("dev");
Meta::vprefix("system");

Meta::breadcrumb( __("admin.menu") , "admin");
Meta::breadcrumb( __("system.menu") , "system");

Model::set("view-dash-menu", true);
?>