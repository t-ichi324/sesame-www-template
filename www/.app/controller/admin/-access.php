<?php
Meta::roles("admin");

Meta::vprefix("admin");

Meta::breadcrumb( __("admin.menu"),  "admin");

Model::set("view-dash-menu", true);
?>